<?php

namespace App\Http\Controllers;

use App\Models\UserInfo;
use Illuminate\Http\Request;

class ApiMemberController extends Controller
{
    public function memberreturn(Request $req){
        $arr = [
            'errorcode' => '0'
            ,'msg'      => ''
        ];
        


        UserInfo::where('user_id', $req->user_id)
        ->update(['user_status' => '1']);

        $arr['errorcode'] = '0';
        $arr['msg'] = '정지 해제';

        return $arr;
    }


}
