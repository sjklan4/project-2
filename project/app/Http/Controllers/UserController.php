<?php

namespace App\Http\Controllers;

use App\Models\KcalInfo;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(){
        return view('login');
    }

    public function loginpost(Request $req){
        // $req->validate([
        //     'email'    =>  'required|email|max:30'
        //     ,'password' =>  'required|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{1,20}$/'
        // ]);
        
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
            return redirect()->intended(route('home', ['id' => $user->user_id])); //intended사용시 앞전 데이터를 없에고 redirect시킨다.
        } else{
            $error = '인증작업 에러.';
            return redirect()->back()->with('error',$error);
        }
        
    }

    public function regist(){
        return view('regist');
    }

    public function registpost(Request $req){

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

    public function logout() {
        Session::flush(); // 세션 파기
        Auth::logout(); // 로그아웃
        return redirect()->route('user.login');
    }



}

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
