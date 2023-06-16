<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Models\FoodInfo;

class FoodController extends Controller
{
    public function index() {
        return view('/foodInsertManager');
    }


    public function create() {
        return view('/foodCreate');
    }

    public function store(Request $req) {
        // todo 로그인 확인

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
