<?php

/*****************************************************
 * 프로젝트명   : project-2 controllerpage
 * 디렉토리     : Controllers
 * 파일명       : ManagerController.php
 * 이력         :  v002 0727 SJ.Park new
 *****************************************************/


namespace App\Http\Controllers;

use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ManagerController extends Controller
{
    public function login(){
        // if(Auth::check(true)){
        //     return redirect()->intended(route('test'));
        // }
        return view('login');
    }

    public function loginpost(Request $req){

        // 관리자 정보 습득
        $user = Manager::where('mng_email',$req->email)->first();
        
        if(!$user || $req->password !== $user->password){
            $error = '아이디와 비밀번호를 확인해 주세요.';
            return redirect()->back()->with('error', $error);
        }

        // 유저 인증작업
        Auth::login($user);

        if(Auth::check()){
            session($user->only('mng_id')); // 세션에 인증된 회원 pk등록
            return redirect()->intended(route('user.food')); // intended사용시 앞전 데이터를 없에고 redirect시킨다.
        } else{
            $error = '인증작업 에러.';
            return redirect()->back()->with('error',$error);
        }

    }

    public function logout() {
        Session::flush(); // 세션 파기
        Auth::logout(); // 로그아웃
        return redirect()->route('login.get');
    }
}
