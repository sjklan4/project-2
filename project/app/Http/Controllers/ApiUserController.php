<?php
/*****************************************************
 * 프로젝트명   : project-2
 * 디렉토리     : Controllers
 * 파일명       : ApiUsercontroller.php
 * 이력         : v001 0526 SJ.Park new
 *****************************************************/

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

    public function chdecknkname($nkname){
        $arrData = [ "flg" => "0"];

        $usernk = UserInfo::where('nkname', $nkname)->first();

        if($usernk !== null){
            $arrData["flg"] = "1";
            $arrData["msg"] = "사용중인 닉네임 입니다.";
        }
        return $arrData;
    }

    public function chdeckphone($user_phone_num){
        $arrData = [ "flg" => "0"];

        $userphon = UserInfo::where('user_phone_num', $user_phone_num)->first();

        if($userphon !== null){
            $arrData["flg"] = "1";
            $arrData["msg"] = "사용중인 전화번호 입니다.";
        }
        return $arrData;
    }

    public function chdeckpassword(Request $req){
        $arr = [
            'errorcode' => '0'
            ,'msg'      => ''
        ];

        $user = UserInfo::find($req->value2);

        if(!Hash::check($req->value1, $user->password)){
            $arr["errorcode"] = "1";
            $arr["msg"]="비밀번호 불일치";
        }
        else{
            $arr["msg"]="비밀번호 일치";
        }
        return $arr;
    }

}

