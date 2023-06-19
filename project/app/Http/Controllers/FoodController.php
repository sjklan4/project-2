<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Models\FoodInfo;

class FoodController extends Controller
{
    public function index($id = '0') {
        if(auth()->guest()) {
            return redirect()->route('user.login');
        }
        
        $user_id = session('user_id');

        // 사용자 등록 음식 목록
        $result = DB::table('food_infos')
        ->select('food_name', 'food_id', 'user_id')
        ->where('user_id', $user_id)
        ->get();

        // todo 사용자 id가 다른 음식 수정 방지
        // if ($result->user_id !== $user_id) {
        //     return redirect()->route('food.index');
        // }

        

        return view('/foodManage')->with('data', $result);
    }


    public function create() {
        if(auth()->guest()) {
            return redirect()->route('user.login');
        }

        return view('/foodCreate');
    }

    public function store(Request $req) {

        if(auth()->guest()) {
            return redirect()->route('user.login');
        }

        // todo 유효성 검사, 영양 정보 값이 없으면 0으로 처리

        $id = session('user_id');

        // 음식 정보 테이블 인서트
        DB::table('food_infos')
            ->insert([
                'user_id'       => $id
                ,'food_name'    => $req->foodName
                ,'kcal'         => $req->kcal
                ,'carbs'        => $req->carbs
                ,'protein'      => $req->protein
                ,'fat'          => $req->fat
                ,'sugar'        => $req->sugar
                ,'sodium'       => $req->sodium
                ,'serving'      => $req->serving
                ,'ser_unit'     => $req->ser_unit
                ,'created_at'   => now()
            ]);

        return redirect()->route('food.index');
    }
}
