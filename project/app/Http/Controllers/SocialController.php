<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect() {
        return Socialite::driver('kakao')->redirect();
    }

    public function back() {
        $user = Socialite::driver('kakao')->user();
        return var_dump($user);
    }
}
