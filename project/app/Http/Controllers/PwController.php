<?php

namespace App\Http\Controllers;

use App\Mail\FindEmail;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PwController extends Controller
{
    public function findpwget(){
        return view('findpw');
    }

    public function findpwpost(Request $req){

        $user_email = $req->user_email;
        $user = UserInfo::where('user_email', $user_email)->first();

        Mail::to($user->user_email)->send(new FindEmail($user));

        $message = '이메일을 확인해주세요';

        return redirect()->route('findpw.get')->with('message',$message);

    }
}
