<?php

namespace App\Http\Controllers;

use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
}
