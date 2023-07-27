<?php

/*****************************************************
 * 프로젝트명   : project-2
 * 디렉토리     : Controllers
 * 파일명       : SocialController.php
 * 이력         : v001 0718 AR.Choe new
 *****************************************************/

namespace App\Http\Controllers;

use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect($social) {
        return Socialite::driver($social)->redirect();
    }

    public function back($social) {
        $user = Socialite::driver($social)->user();

        // 카카오 이메일과 일치하는 유저정보 획득
        $userBase = UserInfo::where('user_email', $user->getEmail())->first();
        
        // 가입된 유저인 경우 로그인 진행
        if(isset($userBase)) {
            Auth::login($userBase);
            if(Auth::check()){
                session($userBase->only('user_id')); // 세션에 인증된 회원 pk등록
                return redirect()->intended(route('home'));
            } else{
                $error = '인증작업 에러.';
                return redirect()->back()->with('error',$error);
            }
        }
        
        // 가입 안된 유저인 경우 회원가입 페이지로 이동
        $userInfo = [
            'email'   => $user->getEmail(),
            'name'    => $user->getNickname(),
            'social'  => '0',
        ];

        // 세션에 유저 정보 저장
        session()->flash('userInfo', $userInfo);

        return redirect()->route('user.regist');
    }
}
