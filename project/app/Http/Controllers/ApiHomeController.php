<?php

namespace App\Http\Controllers;

use App\Models\DietFood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ApiHomeController extends Controller
{
    public function intakeupdate(Request $req, $id){

        // 사용자 인증 작업
        if(!Auth::user()) {
            return redirect()->route('user.login');
        }

        $dietfood = DietFood::find($id);
        $dietfood->df_intake = $req->df_intake;
        $dietfood->save();

        // 수정 후 해당 날짜에 해당하는 식단을 출력하기 위해 세션에 날짜를 담음
        Session::put('d_date',$req->d_date);

        // Alert::success('수정완료', '');

        return redirect()->route('home.post');
    }
}
