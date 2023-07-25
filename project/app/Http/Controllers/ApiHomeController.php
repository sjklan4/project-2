<?php

namespace App\Http\Controllers;

use App\Models\DietFood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ApiHomeController extends Controller
{
    // public function intakeupdate(Request $req, $df_id){


    // $dietfood = DietFood::find($df_id);
    // $dietfood->df_intake = $req->df_intake;

    // $dietfood->save();

    // // 수정 후 해당 날짜에 해당하는 식단을 출력하기 위해 세션에 날짜를 담음

    //     return response()->json(['staus' => '섭취량변경']);
    // }

    public function intakeupdate(Request $req, $df_id){
        
        $arr = [
            'errorcode' => '0'
            ,'msg'      => ''
        ];


        $requestBody = json_decode($req->getContent());

        $dietfood = DietFood::find($df_id);
        $dietfood->df_intake = $requestBody->df_intake;

        $dietfood->save();

        $arr['errocode'] = '1';
        $arr['msg'] = '섭취량 변경';

        
        return $arr;
    }
    
    
    public function intakedel(Request $req){

        $arr = [
            'errorcode' => '0'
            ,'msg'      => ''
        ];

        
        DietFood::destroy($req->df_id);
        
        $arr['errocode'] = '1';
        $arr['msg'] = '음식 삭제';

        return $arr;
    }
    
}
