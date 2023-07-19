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
    public function checkEmail($user_email){

        $arrData = [
            "errorcode" => "0"
            ,"msg"      => ""
        ];

        $user = UserInfo::where('user_email', $user_email)->first();
        
        // 유저 유무 체크
        if($user !== null) {
            $arrData["errorcode"] = "1";
            $arrData["msg"] = "사용중인 Email입니다."; 
        }
        
        // return response()->json($arrData);
        return $arrData;
    }

    public function checkNkname($nkname){

        $arrData = [
            "errorcode" => "0"
            ,"msg"      => ""
        ];

        $user = UserInfo::where('nkname', $nkname)->first();

        if($user !== null){
            $arrData["errcode"] = "1";
            $arrData["msg"] = "사용중인 닉네임 입니다.";
        }
        return $arrData;
    }

    public function checkPhone($user_phone_num){

        $arrData = [
            "errorcode" => "0"
            ,"msg"      => ""
        ];

        $user = UserInfo::where('user_phone_num', $user_phone_num)->first();

        if($user !== null){
            $arrData["errcode"] = "1";
            $arrData["msg"] = "사용중인 전화번호 입니다.";
        }
        return $arrData;
    }

    public function checkPassword(Request $req){
        $arr = [
            'errorcode' => '0'
            ,'msg'      => ''
        ];

        $user = UserInfo::find($req->value2);

        return $user;

        if(!Hash::check($req->value1, $user->password)){
            $arr["errorcode"] = "1";
            $arr["msg"]="비밀번호 불일치";
        }
        else{
            $arr["msg"]="비밀번호 일치";
        }
        return $arr;
    }

    public function userdrawing(Request $req){

        $arr = [
            'errorcode' => '0'
            ,'msg'      => ''
        ];

        $userinfo = UserInfo::find($req->user_id);

        if(Auth::id() != $userinfo->user_id){
            $arr["errorcode"] = "1";
            $arr["msg"] = "권한이 없는 요청입니다.(로그인을 확인해주세요)";
        }
        UserInfo::destroy($userinfo->user_id);

        return response()->json(['errorcode' => '0']);
    }

}

