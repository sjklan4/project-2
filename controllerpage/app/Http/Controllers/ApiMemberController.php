<?php

namespace App\Http\Controllers;

use App\Models\BoardReply;
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

    // public function bulkDelete(Request $request)
    // {
    //     $arr = [
    //         'errorcode' => '0'
    //         ,'msg'      => ''
    //     ];
        
    //     if($request->has('delchk')) {
    //         // 'delchk' will be an array of comment IDs to delete
    //         BoardReply::destroy($request->delchk);

            
    //     $arr['errorcode'] = '0';
    //     $arr['msg'] = '댓글 삭제';
    //     }
        
    //     return $arr;
    // }


}
