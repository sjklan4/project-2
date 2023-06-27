<?php

namespace App\Http\Controllers;

use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ApiUserController extends Controller
{
    public function chdeckEmail($user_email){

        $arrData = [ "flg" => "0"];

        $user = UserInfo::where('user_email', $user_email)->first();
        
    

        // 유저 유무 체크
        if($user !== null) {
            $arrData["flg"] = "1";
            $arrData["msg"] = "입력하신 Email이 사용중입니다."; 
        }
        // return response()->json($arrData);
        return $arrData;
    }

    public function chdeckpassword(Request $req){
        $arrmsg = ["flg" => "0"];
        $baseUser = Auth::User(); //기존 데이터 획득
        if(!Hash::check($req->bpassword, $baseUser->password)){
            $arrmsg["flg"]="1";
            $arrmsg["msg"]="비밀번호를 확인해 주세요";
        }
        else{
            $arrmsg["msg"]="확인 되었습니다.";
        }
        return $arrmsg;
    }

}

