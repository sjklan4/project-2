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
        $requestBody = json_decode($req->getContent());

        $dietfood = DietFood::find($df_id);
        $dietfood->df_intake = $requestBody->df_intake;

        $dietfood->save();

        // todo 리턴값 수정
        return response()->json(['staus' => '섭취량변경']);
    }
    
    
    public function intakedel(Request $req){
        
        DietFood::destroy($req->df_id);
        
        // todo 리턴값 수정
        return response()->json(['status' => 'success']);
    }
    
}
