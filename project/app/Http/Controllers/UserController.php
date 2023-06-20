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
    public function login(){
        return view('login');
    }

    // 라라벨에서 제공하는 기본 이름과 테이블 이름이 다름으로 인해서 model, config/app/userinfo의 users의 model경로 수정( 'model' => App\Models\UserInfo::class,)
    public function loginpost(Request $req){  
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
            return redirect()->intended(route('home.post')); //intended사용시 앞전 데이터를 없에고 redirect시킨다.
        } else{
            $error = '인증작업 에러.';
            return redirect()->back()->with('error',$error);
        }
        
    }

    //회원가입 화면 이동
    public function regist(){
        return view('regist');
    }

    //이메일 중복체크 - js에서는 브라우져에서만 유효성 검사를 실시 함으로 서버측도 같은 형식의 검사를 진행하도록 유효성체크
    public function chdeckEmail(Request $request) {
        $rules = ['user_email' => 'required|unique:user_infos'];
    
        $validator = Validator::make($request->only('user_email'), $rules);
    
        if ($validator->fails()) {
            return response()->json(['exists' => 1]);
        }
        return response()->json(['exists' => 0]);
    }


    // 순서 확인 : 
    public function registpost(Request $req){

        $rules = [  'user_name'  => 'required|regex:/^[a-zA-Z가-힣]+$/|min:2|max:30'
            ,'password' => 'same:passwordchk|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,30}$/'
            ,'user_email'    => 'required|email|max:20'
            ,'nkname'   => 'required|regex:/^[a-zA-Z가-힣0-9]{1,60}$/'
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
        
        $userid = DB::table('user_infos')->insertGetId($data);
    
        $data1 = [
            'user_birth' => $req->user_birth
            ,'user_gen' => $req->gender
            ,'user_id'  =>  $userid
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