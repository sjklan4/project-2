<?php

namespace App\Http\Controllers;

use App\Models\KcalInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecommendController extends Controller
{
    public function pview() {
        return view('recommend');
    }

    public function recommned() {
        // 유저 id 획득
        $id = Auth::user()->user_id;

        $result = KcalInfo::select('goal_kcal', 'user_activity')
        ->where('user_id', $id)
        ->get();


        // ! 탄수 1g : 4kcal | 단백질 1g : 4kcal | 지방 : 1g : 9kcal
        // 유지칼로리 계산
        if($result[0]['user_activity'] == 0){
            $tdee = $result[0]['goal_kcal'] * 1.375;
        }else if($result[0]['user_activity'] == 1){
            $tdee = $result[0]['goal_kcal'] * 1.55;
        }else{
            $tdee = $result[0]['goal_kcal'] * 1.725;
        };
    }
}
