<?php

namespace App\Http\Controllers;

use App\Models\KcalInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecommendController extends Controller
{
    public function pview() {
        $id = Auth::user()->user_id;
        $userinfo = KcalInfo::select('goal_kcal')
        ->where('user_id', $id)
        ->get();
        return view('recommend')->with('userinfo', $userinfo);
    }

    public function recommned(Request $req) {
        // 유저 id 획득
        $id = Auth::user()->user_id;

        $result = KcalInfo::select('goal_kcal', 'user_activity')
        ->where('user_id', $id)
        ->get();

        // ! 탄수 1g : 4kcal | 단백질 1g : 4kcal | 지방 : 1g : 9kcal
        // 유지칼로리 계산
        if($result){ // 목표 칼로리 데이터가 설정되어 있는 경우
            if($result[0]['user_activity'] == 0){
                $tdee = $result[0]['goal_kcal'] * 1.375;
            }else if($result[0]['user_activity'] == 1){
                $tdee = $result[0]['goal_kcal'] * 1.55;
            }else{
                $tdee = $result[0]['goal_kcal'] * 1.725;
            };
        }else{ // 목표 칼로리 데이터가 설정되어 있지 않은 경우
            if($req->gender == 1){ // 남자
                $bmr = round(
                    66 
                    + (13.7 * (int)$req->weight) 
                    + (5 * (int)$req->height) 
                    - (6.8 * $req->age)
                );
            }else{ // 여자
                $bmr = round(
                    655 
                    + (9.6 * (int)$req->weight) 
                    + (1.7 * (int)$req->height) 
                    - (4.7 * $req->age)
                );
            }
        }
    }
}
