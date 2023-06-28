<?php

namespace App\Http\Controllers;

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

class UserController extends Controller
{
    //로그인 페이지 이동, 로그인시 홈으로 이동 아니면 로그인 페이지로
    public function login(){
        Log::debug('LoginGet : 인증 확인');
        if(Auth::check(true)){
            Log::debug('LoginGet : 인증 상태 : 홈으로');
            return redirect()->intended(route('home'));
        }
        Log::debug('LoginGet : 미인증 상태 : 로그인으로');
        return view('login');
    }
    

    // 라라벨에서 제공하는 기본 이름과 테이블 이름이 다름으로 인해서 model, config/app/userinfo의 users의 model경로 수정( 'model' => App\Models\UserInfo::class,)
    public function loginpost(Request $req){
        Log::debug('LoginPost : 로그인처리 시작', $req->all());
        $rules = [
            'email'    =>  'required|email|max:20'
            ,'password' =>  'required|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,30}$/'
        ];

        $validate = Validator::make($req->only('email','password'),$rules,[
            'email' => 'email형식에 맞춰주세요',
            'password' => '비밀번호를 확인해주세요'
        ]);

        if ($validate->fails()) {
            $errors = $validate->errors();
            return redirect()->back()->withErrors($errors)->withInput();
        }
        
        // var_dump($req);
        // exit;
        //유저 정보 습득
        $user = UserInfo::where('user_email',$req->email)->first();
        
        if(!$user || !(Hash::check($req->password,$user->password))){
            $error = '아이디와 비밀번호를 확인해 주세요.';
            return redirect()->back()->with('error',$error);
        }

        // 유저 인증작업
        Auth::login($user);
        if(Auth::check()){
            session($user->only('user_id')); //세션에 인증된 회원 pk등록
            return redirect()->intended(route('home')); //intended사용시 앞전 데이터를 없에고 redirect시킨다.
        } else{
            $error = '인증작업 에러.';
            return redirect()->back()->with('error',$error);
        }
        
    }

    //회원가입 화면 이동
    public function regist(){
        return view('regist');
    }




    // 회원 가입 부분
    public function registpost(Request $req){

        $rules = [  'user_name'  => 'required|regex:/^[a-zA-Z가-힣]+$/|min:2|max:30' //영문대소, 한글만 허용, 최소 2자 최대 30자 까지 
            ,'password' => 'same:passwordchk|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,30}$/' //영문대소, 특수문자, 숫자포함 8자리 이상 30자리까지 허용
            ,'user_email'    => 'required|email|max:20' //email형식에 맞춰서 작성하도록 라라벨 자체 정규식 사용
            ,'nkname'   => 'required|regex:/^[a-zA-Z가-힣0-9]+$/|min:2|max:30' //영문대소문자, 한글, 숫자로 최소1자 최대20자
            ,'user_phone_num'  => 'required|regex:/^01[0-9]{9,10}$/'];

        $validate = Validator::make($req->only('user_name','password','user_email','nkname','user_phone_num','passwordchk'),$rules,[
                'user_name' => '한영(대소문자)로 2자 이상 20자 이내만 가능합니다.',
                'password' => '영문(대소문자)와 숫자, 특수문자로 최소 8자 이상 10자 이내로 해주세요',
                'user_email' => 'email형식에 맞춰주세요',
                'nkname' => '공백 없이 한영(대소문자)로 2자이상 20자 이내만 가능합니다.',
                'user_phone_num' => '01포함 9~10자리의 숫자만 입력',
            ]);
    
        if ($validate->fails()) {
            $errors = $validate->errors();
            return redirect()->back()->withErrors($errors)->withInput();
        }

            $data = [
                'user_email' => $req->user_email
                ,'user_name' => $req->user_name
                ,'password' => Hash::make($req->password)
                ,'nkname' => $req->nkname
                ,'user_phone_num' => $req->user_phone_num
                ,'created_at' => now()
            ];
        
        $userid = DB::table('user_infos')->insertGetId($data); //user_infos 테이블에 data값들을 넣고 그 데이터들의 id값을 가져와서 아래 데이터들이 들어가야 되는 ID값을 줄 수 있다.
    
        $data1 = [
            'user_birth' => $req->user_birth
            ,'user_gen' => $req->gender
            ,'user_id'  =>  $userid   //insertGetId를 통해서 가져온 ID를 지정해서 일자와, 성별을 넣을 수 있다.
        ];
        
        KcalInfo::create($data1);
        
        return view('login');
        
    }

    //유저 기존데이터 출력
    public function userinfoedit(){
        $id = session('user_id');
        $userinfo = UserInfo::FindOrFail($id);

        return view('Userinfoupdate')->with('data',$userinfo);
    }
    
    // 유저 정보 변경post
    public function userinfoeditPost(Request $req){
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

        return redirect()->route('user.userinfoedit');
    }

    public function userKcalup(Request $req){ //유저정보 변경중 칼로정보 입력을 위한 기본자료 수정 버튼 동작 구문
        $arrKey = [];
        $baseUser = KcalInfo::find(Auth::User()->user_id);

        if($req->user_birth !== $baseUser->user_birth){
            $arrKey[] = 'user_birth';
        }
        //나이가 필요한 칼로리 계산 구문은 js로 별도 수행
        if($req->user_tall !== $baseUser->user_tall){
            $arrKey[] = 'user_tall';
        }
      
        if($req->user_weight !== $baseUser->user_weight){
            $arrKey[] = 'user_weight';
        }
          // 0 : 1.2 / 1 : 1.55 / 2 : 1.9 으로 계산한다.
        if($req->user_weight !== $baseUser->user_weight){
            $arrKey[] = 'user_activity';
        }
        foreach($arrKey as $val) {
        
            $baseUser->$val = $req->$val;
        }
        $baseUser->save(); // update
        return redirect()->route('user.userinfoedit');

    }

    //유저 Email찾기 구문
    public function userfindE(){
        return view('userfind');
    }

    //유저 Email찾기 요청하는 구문
    public function userfindEPost(Request $req){
        Log::debug('메일 찾기: 이메일 확인', $req->all());
        $rules = [
            'user_name'  => 'required|regex:/^[a-zA-Z가-힣]+$/|min:2|max:30'
            ,'user_phone_num'  => 'required|regex:/^01[0-9]{9,10}$/'
        ];
        $validate = Validator::make($req->only('user_name','user_phone_num'),$rules,[
            'user_name' => '한영(대소문자)로 2자 이상 20자 이내만 가능합니다.',
            'password' => '영문(대소문자)와 숫자, 특수문자로 최소 8자 이상 10자 이내로 해주세요',
        ]);

        if ($validate->fails()) {
            $errors = $validate->errors();
            return redirect()->back()->withErrors($errors)->withInput();
        }

        // $data = [
        //     'user_name' => $req->user_name
        //     ,'user_phone_num' => $req->user_phone_num
        // ];

        $findemail = DB::table('user_infos')
        ->where('user_name', $req->user_name)
        ->where('user_phone_num', $req->user_phone_num)
        ->value('user_email');

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
        Log::debug('userpsedit : 비밀번호 확인');
    }
   
    

    public function userpseditpost(Request $req){ //변경 비밀번호를 업데이트 하기위한 구문
       
    
        $basepassword = UserInfo::find(Auth::User()->password); //기존 데이터에서 비밀번호를 가져오기 위해서 회원 정보를 가져옴
  
        if(!Hash::check($req->newpassword, $basepassword->password)){ //전달받은 값을 hash화 해서 비교하기 위함
            $newpassword = $req->newpassword; //다르면 작성된 신규비밀번호를 사용
        }
        else{   //같으면 아래의 오류를 보여주고 다시 작성하게 한다.
            $error = '기존 비밀번호와 다른 비밀번호로 해주세요';
            return redirect()->back()->with('error',$error);
        }

        $rules = [    //유효성 검사 규칙 준비.
        'newpassword' => 'same:newpasswordchk|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,20}$/'
        ]; //유효성 검사 조건을 셋팅(신규비밀번호와 신규비밀번호 유효성 및 같은지 확인할 준비)

        $validator = Validator::make($req->all(), $rules, [
            'newpassword.same' => '비밀번호를 확인해주세요',
            'newpassword.regex' => '숫자영문특부문자 조합으로 해주세요'
        ]);

        if ($validator->fails()){ //유효성 검사 결과에 따른 결과 값 출력 - 유효성검사 불일치 일시 비밀번호 확인 메시지출력
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $basepassword->password = Hash::make($newpassword);
        $basepassword->save(); // 비밀번호 저장
        return redirect()->route('user.login');
    }
    
    public function userKcalinfo(){//유저의 식단과 목표칼로리 변경 페이지로 이동
        $id = session('user_id');
        $userdinfo = KcalInfo::FindOrFail($id);
        return view('prevateinfo')->with('data',$userdinfo);
    }
    
    
    public function userKcaledit(Request $req){  //유저가 입력한 식단과 목표 칼로리를 적용 시키는 기능 - 오류 출력이 안됨.
    $KcalInfo = KcalInfo::find(Auth::user()->user_id); //로그인 된 유저id를 kcaliinfo테이블에서 찾아서 그 번호를 반환한다.
    $KcalInfo->goal_kcal = $req->goal_kcal;

        if($req->nutrition_ratio === ""){
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






    


}







// ----------------------------------------------쓰레기통(보지마세요)--------------------------------------------
// $table->char('user_gen',1);
// $table->date('user_birth');

// 'name'      => 'required|regex:/^[ㄱ-ㅎ가-힣a-zA-Z]*$/|min:2|max:20' 
// ,'password' => 'required_with:passwordchk|same:passwordchk|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,20}$/' //두 값을 비교해서 같은지 확인해 주는 구문
// ,'email'    =>  'required|email|max:100'
// ,'nkname' => 'required|regex:/^[ㄱ-ㅎ가-힣a-zA-Z0-9]*$/|min:2|max:20' 

// ,'callnum' => 'required|regex:/^01[0-9]{9,11}$/'


     // $req->validate([
        //     'name'      => 'require'
        //     ,'password' => 'required_with:passwordchk|same:passwordchk|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,20}$/'
        //     ,'email'    => 'require'
        //     ,'nkname'   => 'require'
        //     ,'birthdate'    =>  'require'
        //     ,'callnum'  => 'require'
        //     ,'gender'   =>  'require'
        // ]);


                // if($req->fails()){
        //     return redirect('user.regist')
        //     ->withErrors($req)
        //     ->withInput();
        // }

        // $vali = Validator::make($req->only('user_name','password','user_email','nkname','user_phone_num'),$rules,[
        //     'user_name' => '한영(대소문자)로 2자 이상 20자 이내만 가능합니다.',
        //     'password' => '한영(대소문자)와 숫자, 특수문자로 최소 8자 이상 20자 이내로 해주세요',
        //     'user_email' => 'email형식에 맞춰주세요',
        //     'nkname' => '한영(대소문자)로 2자이상 20자 이내만 가능합니다.',
        //     'user_phone_num' => '본문은 최소 :min 글자 이상이 필요합니다.',
        // ]);



                // $req->validate([
        //     'user_name'      => 'required|regex:/^[a-zA-Z가-힣]{2,20}$/'
        //     ,'password' => 'required_with:passwordchk|same:passwordchk|regex:/^[a-zA-Z!@#$%^*0-9]{8,20}$/'
        //     ,'user_email'    => 'required|email|max:30'
        //     ,'nkname'   => 'required|regex:/^(?=.*[a-zA-Z])(?=.*[가-힣])+$.{2,20}$/'
        //     ,'user_phone_num'  => 'required|regex:/^01[0-9]{9,10}$/'
        // ]);


        // $data['user_name'] = $req->user_name;
        // $data['password'] = Hash::make($req->password);
        // $data['user_email'] = $req->user_email;
        // $data['nkname'] = $req->nkname;
        // $data['user_phone_num'] = $req->user_phone_num;
        // $data['created_at'] = now();



        // $req->validate([
        //     'email'    =>  'required|email|max:20'
        //     ,'password' =>  'required|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,30}$/'
        // ]);



        // $rules = [  
        //     'user_email'   => 'required|unique:user_infos'
        //    ];
    
        //    $validatedup = Validator::make($req->only('user_email'),$rules,[
    
        //     'user_email' => '가입되어 있는 Email입니다.'
        // ]);
    
        
    
        // if ($validatedup->fails()) {
        //     return response()->json(['exists' => 1]);
        // }
        // return response()->json(['exists' => 0]);



            //이메일 중복체크 - js에서는 브라우져에서만 유효성 검사를 실시 함으로 서버측도 같은 형식의 검사를 진행하도록 유효성체크 : api를 php단에서 직접 사용시 사용하는 구문 blade body에서 직접 라우트를 url로 지정해서 사용해야 아래 구문을 사용할 수 있음
    // public function chdeckEmail(Request $request) {
    //     $rules = ['user_email' => 'required|unique:user_infos'];
    
    //     $validator = Validator::make($request->only('user_email'), $rules);
    
    //     if ($validator->fails()) {
    //         return response()->json(['exists' => 1]);
    //     }
    //     return response()->json(['exists' => 0]);
    // }