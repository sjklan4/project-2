<?php

/*****************************************************
 * 프로젝트명   : project-2
 * 디렉토리     : Controllers
 * 파일명       : Usercontroller.php
 * 이력         : v001 0526 SJ.Park new
 *                v002 0717 AR.Choe add, delete
 *****************************************************/

namespace App\Http\Controllers;

use App\Mail\MyMail;
use App\Models\KcalInfo;
use App\Models\UserInfo;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\emailverify;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Component\Mailer\Messenger\SendEmailMessage;

class UserController extends Controller
{
    //로그인 페이지 이동, 로그인시 홈으로 이동 아니면 로그인 페이지로
    public function login(){
        if(Auth::check(true)){
            return redirect()->intended(route('home'));
        }
        return view('login');
    }
    

    // 라라벨에서 제공하는 기본 이름과 테이블 이름이 다름으로 인해서 model, config/app/userinfo의 users의 model경로 수정( 'model' => App\Models\UserInfo::class,)
    public function loginpost(Request $req){
        $rules = [
            'email'    =>  'required|email|max:20'
            ,'password' =>  'required|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,30}$/'
        ];

        $validate = Validator::make($req->only('email','password'), $rules, [
            'email.required' => '이메일을 입력해주세요',
            'email' => 'email형식에 맞춰주세요',
            'password' => '비밀번호를 확인해주세요'
        ]);

        if ($validate->fails()) {
            $errors = $validate->errors();
            return redirect()->back()->withErrors($errors)->withInput();
        }
        

        //유저 정보 습득
        $user = UserInfo::where('user_email',$req->email)->first();
        
        if(!$user || !(Hash::check($req->password,$user->password))){
            $error = '아이디와 비밀번호를 확인해 주세요.';
            return back()->withErrors(['idpw' => $error])
                ->withInput();;

        }

        // 유저 인증작업
        Auth::login($user);
        if(Auth::check()){
            session($user->only('user_id')); // 세션에 인증된 회원 pk등록
            return redirect()->intended(route('home')); // intended사용시 앞전 데이터를 없에고 redirect시킨다.
        } else{
            $error = '인증작업 에러.';
            return redirect()->back()->with('error',$error);
        }
        
    }

    //회원 이메일 인증 요청 부분
    public function emailverifypage(){
        return view('emailVerify');
    }

    //이메일 인증 절차 부분
    public function emailverifypost(Request $req){
        $req->validate([
            'email'    => 'required|email|max:100'
        ]);
        $data['email'] = $req->email;
        $user = emailverify::create($data);

        if(!$user){
            return redirect()
                ->route('user.emailverify');
        }
        $verification_code = Str::random(30); // 인증 코드 생성
        $validity_period = now()->addMinutes(5); // 유효기간 설정

        $user->verification_code = $verification_code;
        $user->validity_period = $validity_period;
        $user->save();

        Mail::to($user->email)->send(new MyMail($user));
        return redirect()->route('users.login')->with('email');
    }
    

    // 회원가입 화면 이동
    public function regist(){
        return view('regist');
    }

    // 회원 가입 부분
    public function registpost(Request $req){

        // 유효성 검사
        $rules = [
            // 영문대소, 한글만 허용, 최소 2자 최대 30자 까지
            'user_name'  => 'required|regex:/^[a-zA-Z가-힣]+$/|min:2|max:30'

            // 영문대소, 특수문자, 숫자포함 8자리 이상 30자리까지 허용
            ,'password' => 'required|same:passwordchk|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,30}$/'

            // email형식에 맞춰서 작성하도록 라라벨 자체 정규식 사용
            ,'user_email'    => 'required|unique:user_infos,user_email|email|min:2|max:20'
            ,'nkname'   => 'required|unique:user_infos,nkname|regex:/^[a-zA-Z가-힣0-9]+$/|min:2|max:20'
            ,'user_phone_num'  => 'required|unique:user_infos,user_phone_num|regex:/^01[0-9]{9,10}$/'
            ,'user_id'    => 'required|regex:/^[0-9]+$'
            ,'user_gen'   => 'required|regex:/^[01]{0,1}$'
            ];

        $messages = [
            'user_name.required'    => '이름은 필수 입력 사항입니다.',
            'user_name.regex'       => '한글과 영문만 허용합니다.',
            'user_name.max'         => ':max자까지 입력 가능합니다.',
            'user_name.min'         => ':min자 이상 입력 가능합니다.',
            'password.same'         => '비밀번호 확인과 일치하지 않습니다.',
            'password.required'     => '비밀번호는 필수 입력 사항입니다.',
            'password.regex'        => '영문 대소문자,특수문자,숫자를 포함한 8~30자리로 입력해주세요.',
            'user_email'            => 'email형식에 맞춰주세요.',
            'user_email.unique'     => '이미 사용중인 email 입니다.',
            'nkname.required'       => '닉네임은 필수 입력 사항입니다.',
            'nkname.unique'         => '이미 사용중인 닉네임 입니다.',
            'nkname.regex'          => '영문 대소문자, 한글, 숫자로 구성하여 입력해주세요.',
            'nkname.max'            => ':max자까지 입력 가능합니다.',
            'user_phone_num.required'=> '전화번호는 필수입력사항 입니다.',
            'user_phone_num.unique'  => '입력하신 연락처로 가입한 이메일이 존재합니다.',
            'user_phone_num.regex'  => '전화번호 형식에 맞추어 입력해주세요.'
        ];

        $validate = Validator::make($req->only('user_name','password','user_email','nkname','user_phone_num','passwordchk'), $rules, $messages);

        // $validate = Validator::make($req->only('user_name','password','user_email','nkname','user_phone_num','passwordchk'),$rules,[
        //         'user_name' => '한영(대소문자)로 2자 이상 20자 이내만 가능합니다.',
        //         'password' => '영문(대소문자)와 숫자, 특수문자로 최소 8자 이상 10자 이내로 해주세요',
        //         'user_email' => 'email형식에 맞춰주세요',
        //         'nkname' => '공백 없이 한영(대소문자)로 2자이상 20자 이내만 가능합니다.',
        //         'user_phone_num' => '입력하신 연락처로 가입한 이메일이 존재합니다.',
        //     ]);

        // todo 유효성 검사 부분 확인
        // if ($validate->fails()) {
        //     // $errors = $validate->errors();
        //     return redirect()->back()->withErrors($validate)->withInput();
        // }

        Log::debug('유효성 검사 완료');
        
        $data = [
            'user_email' => $req->user_email
            ,'user_name' => $req->user_name
            ,'password' => Hash::make($req->password)
            ,'nkname' => $req->nkname
            ,'user_phone_num' => $req->user_phone_num
            ,'created_at' => now()
        ];
        
        // user_infos 테이블에 data값들을 넣고 그 데이터들의 id값을 가져와서 아래 데이터들이 들어가야 되는 ID값을 줄 수 있다.
        // todo 트랜잭션
        $user_id = DB::table('user_infos')
        ->insertGetId($data,'user_id');
        
        // if($user_id < 0 || $user_id > 1){
            //     $error = '시스템 에러가 발생하여, 회원가입에 실패했습니다.잠시 후에 다시 시도해주세요.';
            //     return redirect()->route('user.regist')->with('error', $error);
            // }
        
        $data1 = [
            'user_birth' => $req->user_birth
            ,'user_gen' => $req->gender
            ,'user_id'  =>  $user_id
        ];
        
        // insert
        $kcalInfo = KcalInfo::create($data1);
        
        // $kcalInfo = false; // 에러 확인용
        
        if(!$kcalInfo){
            $error = '시스템 에러가 발생하여, 회원가입에 실패했습니다.잠시 후에 다시 시도해주세요.';
            return redirect()->route('user.regist')->with('error', $error);
        }
        Log::debug('유저 칼로리 테이블 인서트 완료');
        
        // return view('login');
        return redirect()->route('user.login')->with('success','회원가입을 완료했습니다.');
    }

    // 회원 정보 기존데이터 출력
    public function userinfoedit(){
        // 사용자 인증 작업
        if(!Auth::user()) {
            return redirect()->route('user.login');
        }

        $id = session('user_id');

        $userinfo = UserInfo::FindOrFail($id);
        $userkcalinfo = KcalInfo::FindOrFail($id);

        return view('Userinfoupdate')->with('data',$userinfo)->with('userKcal',$userkcalinfo);
    }
    
    // 회원 정보 변경 post
    public function userinfoeditPost(Request $req){
        // 유효성 검사
        $rules = [
            'user_name'  => 'required|regex:/^[a-zA-Z가-힣]+$/|min:2|max:30'
            // ,'user_email'    => 'required|unique:user_infos,user_email|email|min:2|max:20'
            ,'nkname'   => 'required|unique:user_infos,nkname|regex:/^[a-zA-Z가-힣0-9]+$/|min:2|max:20'
            ,'user_phone_num'  => 'required|unique:user_infos,user_phone_num|regex:/^01[0-9]{9,10}$/'
            // ,'user_tall'    => 'regex:/^[0-9]+$|max:5'
            // ,'user_weight'   => 'regex:/^[0-9]+$|max:5'
            ];

        $messages = [
            'user_name.required'    => '이름은 필수 입력 사항입니다.',
            'user_name.regex'       => '한글과 영문만 허용합니다.',
            'user_name.max'         => ':max자까지 입력 가능합니다.',
            'user_name.min'         => ':min자 이상 입력 가능합니다.',
            // 'user_email'            => 'email형식에 맞춰주세요.',
            // 'user_email.unique'     => '이미 사용중인 email 입니다.',
            'nkname.required'       => '닉네임은 필수 입력 사항입니다.',
            'nkname.unique'         => '이미 사용중인 닉네임 입니다.',
            'nkname.regex'          => '영문 대소문자, 한글, 숫자로 구성하여 입력해주세요.',
            'nkname.max'            => ':max자까지 입력 가능합니다.',
            'user_phone_num.required'=> '전화번호는 필수입력사항 입니다.',
            'user_phone_num.unique'  => '입력하신 연락처로 가입한 이메일이 존재합니다.',
            'user_phone_num.regex'  => '전화번호 형식에 맞추어 입력해주세요.',
            // 'user_tall'             => '입력하신 키를 다시 확인해주세요.',
            // 'user_weight'           => '입력하신 몸무게를 다시 확인해주세요.',
        ];

        $validate = Validator::make($req->only('user_name','nkname','user_phone_num'),$rules, $messages);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // $rules = [  'user_name'  => 'required|regex:/^[a-zA-Z가-힣]+$/|min:2|max:30' //영문대소, 한글만 허용, 최소 2자 최대 30자 까지 
        // ,'nkname'   => 'required|regex:/^[a-zA-Z가-힣0-9]+$/|min:2|max:20' //영문대소문자, 한글, 숫자로 최소1자 최대20자
        // ,'user_phone_num'  => 'required|regex:/^01[0-9]{9,10}$/'];

        // $validate = Validator::make($req->only('user_name','nkname','user_phone_num'),$rules,[
        //     'user_name' => '한영(대소문자)로 2자 이상 20자 이내만 가능합니다.',
        //     'nkname' => '공백 없이 한영(대소문자)로 2자이상 20자 이내만 가능합니다.',
        //     'user_phone_num' => '01포함 9~10자리의 숫자만 입력',
        // ]);
        // if ($validate->fails()) {
        //     $errors = $validate->errors();
        //     return redirect()->back()->withErrors($errors)->withInput();
        // }

        $arrKey = [];

        $baseUser = UserInfo::find(Auth::User()->user_id);

        if($req->user_name !== $baseUser->user_name){
            $arrKey[] = 'user_name';
        }
        if($req->nkname !== $baseUser->nkname){
            $arrKey[] = 'nkname';
        }
        if($req->user_phone_num !== $baseUser->user_phone_num){
            $arrKey[] = 'user_phone_num';
        }

         // 수정할 데이터 셋팅
        foreach($arrKey as $val) {
            $baseUser->$val = $req->$val;
        }

        $baseUser->save(); // update

        $changemsg = "변경 완료되었습니다.";

        return redirect()->route('user.userinfoedit')->with('changemsg',$changemsg);
    }

    // public function userKcalup(Request $req){ //유저정보 변경중 칼로정보 입력을 위한 기본자료 수정 버튼 동작 구문
    //     $arrKey = [];
    //     $baseUser = KcalInfo::find(Auth::User()->user_id);

    //     if($req->user_birth !== $baseUser->user_birth){
    //         $arrKey[] = 'user_birth';
    //     }
    //     //나이가 필요한 칼로리 계산 구문은 js로 별도 수행
    //     if($req->user_tall !== $baseUser->user_tall){
    //         $arrKey[] = 'user_tall';
    //     }

    //     if($req->user_weight !== $baseUser->user_weight){
    //         $arrKey[] = 'user_weight';
    //     }
    //       // 0 : 1.2 / 1 : 1.55 / 2 : 1.9 으로 계산한다.
    //     if($req->user_weight !== $baseUser->user_weight){
    //         $arrKey[] = 'user_activity';
    //     }
    //     foreach($arrKey as $val) {
        
    //         $baseUser->$val = $req->$val;
    //     }
    //     $baseUser->save(); // update
    //     return redirect()->route('user.userinfoedit');

    // }


    //유저 Email찾기 구문
    public function userfindE(){
        return view('userfind');
    }

    //유저 Email찾기 요청하는 구문
    // post방식으로 받아온 회원의 정보(이름, 폰번호)를 받아온다.
    public function userfindEPost(Request $req){
        $rules = [ //유효성 검사 룰을 배열로 준비
            'user_name'  => 'required|regex:/^[a-zA-Z가-힣]+$/|min:2|max:30'
            ,'user_phone_num'  => 'required|regex:/^01[0-9]{9,10}$/'
        ];
    //유효성 검사 실시 하는 구문
        $validate = Validator::make($req->only('user_name','user_phone_num'),$rules,[
            'user_name' => '한영(대소문자)로 2자 이상 20자 이내만 가능합니다.',
            'user_phone_num' => '전화번호 형식에 맞춰서 숫자 0~9까지 숫자만 입력해주세요',
        ]);
    // 유효성 검사진행후 bool값이 fail면 오류 값을 리턴시킨다.
        if ($validate->fails()) {
            $errors = $validate->errors();
            return redirect()->back()->withErrors($errors)->withInput();
        }

        // $data = [
        //     'user_name' => $req->user_name
        //     ,'user_phone_num' => $req->user_phone_num
        // ];

    // 유효성 검사를 통과하면 userinfos테이블에서 사용자의 이름과 전화번호가 같은 email을 찾아서 값을 반환
        $findemail = DB::table('user_infos')
        ->where('user_name', $req->user_name)
        ->where('user_phone_num', $req->user_phone_num)
        ->value('user_email');

    //email이 있으면 그 값(data)를 반환하고 없으면 error메시지 출력
        if ($findemail) {
            return redirect()->route('user.userfindE')->with('data', $findemail);
        } else {
            $error = '일치하는 사용자를 찾을 수 없습니다.';
            return redirect()->back()->with('data',$error);
        }
    }
    // redirect()->back()->withErrors($error)->withInput();
//     SELECT user_email
// FROM user_infos
// WHERE user_name = "수정확인" AND user_phone_num = 01078451296;


    //유저 비밀번호 변경출력
    public function userpsedit(){ //비밀전호 변경 페이지로 이동
        return view('UserPasswordedt');
    }

    

    public function userpseditpost(Request $req){ // 변경 비밀번호를 업데이트 하기위한 구문
    
        // todo 유효성검사

        $user_id = Auth::user()->user_id; //로그인된(인증된유저의 user_id(id)를 받아오는 부분) - 로그인된 유저의 pk를 참조해서 데이터를 전부 가져옴

        $basepassword = UserInfo::where('user_id', $user_id)->first();// 기존 데이터에서 비밀번호를 가져오기 위해서 회원 정보를 가져옴
        if(!Hash::check($req->bpassword, $basepassword->password)){
            $error_chk = '비밀번호가 일치하지 않습니다.';
            return redirect()->back()->with('error_chk',$error_chk);
        }
        else{
            if(!Hash::check($req->newpassword, $basepassword->password)){ // 전달받은 값을 hash화 해서 비교하기 위함
                $newpassword = $req->newpassword; // 다르면 작성된 신규비밀번호를 사용

            }
            else{   //같으면 아래의 오류를 보여주고 다시 작성하게 한다.
                $error = '기존 비밀번호와 다른 비밀번호로 해주세요'; 
                return redirect()->back()->with('error',$error);
            }
        // 변경된 신규 비밀번호를 hash화 해서 저장 하는 구문
        $basepassword->password = Hash::make($newpassword);
        
        $basepassword->save(); // 비밀번호 저장
        $success = '비밀번호가 변경 되었습니다.';
        return redirect()->route('user.userpsedit')->with('success',$success);
        }
    }

    public function userKcalinfo(){//유저의 식단과 목표칼로리 변경 페이지로 이동
        $id = session('user_id'); //session에 있는 유저 정보를 id에 담는다.
        $userdinfo = KcalInfo::FindOrFail($id); // user_id값을 kcalinfo테이블에있는 레코드 정보를 전부 찾아온다.
        return view('prevateinfo')->with('data',$userdinfo);
    }
    
    
    public function userKcaledit(Request $req){  //유저가 입력한 식단과 목표 칼로리를 적용 시키는 기능 - 오류 출력이 안됨.
    $KcalInfo = KcalInfo::find(Auth::user()->user_id); //로그인 된 유저id를 kcaliinfo테이블에서 찾아서 그 번호를 반환한다.
    $KcalInfo->goal_kcal = $req->goal_kcal;//kcalinfo테이블에 goal_kcal의 값에 input에 입력된 goal_kcal을 입력

        if($req->nutrition_ratio === ""){ //선택한 식단을 입력 하는 구문 - 선택값이 빈값이면 아래 오류 출력 값이 있으면 선택 값의 value를 반환 
            return redirect()->route('user.prevateinfo')->withErrors(['error' => '식단을 선택해주세요']);
        } else {
            $KcalInfo->nutrition_ratio = $req->nutrition_ratio;
            $KcalInfo->save();
            return redirect()->route('user.prevateinfo');
        }
}

    public function logout() {
        Session::flush(); // 세션 파기
        Auth::logout(); // 로그아웃
        return redirect()->route('user.login');
    }

    //회원 탈퇴 부분
    //탈퇴 페이지 이동
public function userwithdraw(){
    return view('Userdraw');
}   










}







