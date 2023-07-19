<?php

namespace App\Http\Controllers;

use App\Mail\FindEmail;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PwController extends Controller
{
    public function findpwget(){
        return view('findpw');
    }

    public function findpwpost(Request $req){
        // 유효성 검사
        $rules = [
            'user_email'    => 'required|email|min:2|max:50'
        ];

        $validate = Validator::make($req->only('user_email'),$rules,[
            'user_email'            => '이메일 형식에 맞춰서 입력해주세요.'
        ]);

        if ($validate->fails()) {
            $errors = $validate->errors();
            return redirect()->back()->withErrors($errors)->withInput();
        }

        $user_email = $req->user_email;

        $user = UserInfo::where('user_email', $user_email)->first();

        // 랜덤 문자열(임시비밀번호) 생성
        function getRandStr($length = 10) {
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^*-';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }

            // 영문자, 숫자, 특수문자 각각 1개 이상을 보장하기 위한 추가 로직
            $randomString .= $characters[rand(0, 25)]; // 영문자 (소문자)
            $randomString .= $characters[rand(26, 51)]; // 영문자 (대문자)
            $randomString .= $characters[rand(52, 61)]; // 숫자
            $randomString .= $characters[rand(62, strlen($characters) - 1)]; // 특수문자

            return $randomString;
        }

        $temporaryPw = getRandStr(10);

        $user->temporary_pw = $temporaryPw;
        $user->password = Hash::make($temporaryPw);

        $user->save();

        // 임시비밀번호 변경

        if($user){
            Mail::to($user->user_email)->send(new FindEmail($user));
            $message = '이메일을 확인해주세요';
            return redirect()->route('findpw.get')->with('message',$message);
        }
        else{
            $error = '가입되지않은 이메일입니다.';
            return redirect()->back()->with('message',$error);
        }

    }
}
