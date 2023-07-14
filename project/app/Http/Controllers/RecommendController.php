<?php

namespace App\Http\Controllers;

use App\Models\FoodInfo;
use App\Models\KcalInfo;
use App\Models\RecomDiet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RecommendController extends Controller
{
    public function rview() {
        $id = Auth::user()->user_id;
        $userinfo = KcalInfo::select('goal_kcal')
        ->where('user_id', $id)
        ->get();
        $userkcal = $userinfo[0]['goal_kcal']; // 레이아웃 출력 구별용 데이터
        return view('recommend')->with('userkcal', $userkcal);
    }

    public function recommned(Request $req) {
        // 유저 id 획득
        $id = Auth::user()->user_id;

        $result = KcalInfo::select('goal_kcal', 'user_activity')
        ->where('user_id', $id)
        ->get();

        // 유지칼로리 계산
        // if($result[0]['goal_kcal'] != null){ // 목표 칼로리 데이터가 설정되어 있는 경우
        //     if($result[0]['user_activity'] == 0){
        //         $tdee = $result[0]['goal_kcal'] * 1.375;
        //     }else if($result[0]['user_activity'] == 1){
        //         $tdee = $result[0]['goal_kcal'] * 1.55;
        //     }else{
        //         $tdee = $result[0]['goal_kcal'] * 1.725;
        //     };
        // }else{ // 목표 칼로리 데이터가 설정되어 있지 않은 경우
        //     // 기초 대사량 계산식 -> 해리스 베네딕트 방정식
        //     if($req->gender == 0){ // 남자
        //         $bmr = round(
        //             66 
        //             + (13.7 * (int)$req->weight) 
        //             + (5 * (int)$req->height) 
        //             - (6.8 * $req->age)
        //         );
        //     }else{ // 여자
        //         $bmr = round(
        //             655 
        //             + (9.6 * (int)$req->weight) 
        //             + (1.7 * (int)$req->height) 
        //             - (4.7 * $req->age)
        //         );
        //     }
            
        //     // 유저가 선택한 활동량에 따라 계산 > 유지 칼로리 계산
        //     if($req->activity == 0){ // 활동량 적음
        //         $tdee = round($bmr * 1.375);
        //     }else if($req->activity == 1){ // 활동량 보통
        //         $tdee = round($bmr * 1.55);
        //     }else{ // 활동량 많음
        //         $tdee = round($bmr * 1.725);
        //     }
        // }
        
        // // 식단 유형에 따라 계산 
        // // ! 탄수 1g : 4kcal | 단백질 1g : 4kcal | 지방 : 1g : 9kcal
        // // ! 감량 비율 3:5:2 | 증량 비율 6:3:1 | 일반 5:3:2
        // $diffkcal = round($tdee * (0.2));
        // if($req->dietcate == 0){ // 감량 3:5:2 / 20% 적게
        //     $total = $tdee - $diffkcal;
        //     $kcal = $total * 0.3;
        //     $protein = $total * 0.5;
        //     $fat = $total * 0.2;
        //     $totalkcal = round($kcal / 4);
        //     $totalprotein = round($protein / 4);
        //     $totalfat = round($fat / 9);
        // }else if($req->dietcate == 1){ // 증량 6:3:1 / 20% 더
        //     $total =  $tdee + $diffkcal;
        //     $kcal = $total * 0.6;
        //     $protein = $total * 0.3;
        //     $fat = $total * 0.1;
        //     $totalkcal = round($kcal / 4);
        //     $totalprotein = round($protein / 4);
        //     $totalfat = round($fat / 9);
        // }else{ // 일반(건강) 5:3:2 / 변화 없음
        //     $total = $tdee;
        //     $kcal = $total * 0.5;
        //     $protein = $total * 0.3;
        //     $fat = $total * 0.2;
        //     $totalkcal = round($kcal / 4);
        //     $totalprotein = round($protein / 4);
        //     $totalfat = round($fat / 9);
        // }

        if($req->dietcate == 0){ // 감량 식단
            $dietcount = DB::select('select count(recom_d_id) as count from recom_diets where recom_flg = 0'); // 감량 식단 count 조회용
            $dietid = DB::select('select recom_d_id from recom_diets where recom_flg = 0'); // 감량 식단 식단 id 조회용
            $randomFood = mt_rand(0, $dietcount[0]->count-1); // 식단 추천용 랜덤 번호(-> recom_d_id 갯수만큼) 추출

            // 식단 랜덤 추천 쿼리
            $remfood = DB::table('recom_diet_food')
            ->join('food_infos', 'recom_diet_food.food_id', 'food_infos.food_id')
            ->where('recom_diet_food.recom_d_id', $dietid[$randomFood]->recom_d_id)
            ->get();

        }else if($req->dietcate == 1){
            $dietcount = DB::select('select count(recom_d_id) as count from recom_diets where recom_flg = 1');
            $dietid = DB::select('select recom_d_id from recom_diets where recom_flg = 1'); // 감량 식단 식단 id 조회용
            $randomFood = mt_rand(0, $dietcount[0]->count-1); // 식단 추천용 랜덤 번호(-> recom_d_id 갯수만큼) 추출

            // var_dump($dietcount[0]->count);
            // var_dump($dietid);

            // 식단 랜덤 추천 쿼리
            $remfood = DB::table('recom_diet_food')
            ->join('food_infos', 'recom_diet_food.food_id', 'food_infos.food_id')
            ->where('recom_diet_food.recom_d_id', $dietid[$randomFood]->recom_d_id)
            ->get();

            var_dump($remfood);
            
        }else{
            $dietcount = DB::select('select count(recom_d_id) as count from recom_diets where recom_flg = 2');
            $dietid = DB::select('select recom_d_id from recom_diets where recom_flg = 2'); // 감량 식단 식단 id 조회용
            $randomFood = mt_rand(0, $dietcount[0]->count-1); // 식단 추천용 랜덤 번호(-> recom_d_id 갯수만큼) 추출

            // var_dump($dietcount[0]->count);
            // var_dump($dietid);

            // 식단 랜덤 추천 쿼리
            $remfood = DB::table('recom_diet_food')
            ->join('food_infos', 'recom_diet_food.food_id', 'food_infos.food_id')
            ->where('recom_diet_food.recom_d_id', $dietid[$randomFood]->recom_d_id)
            ->get();

            var_dump($remfood);

        }
        // $randomFood = mt_rand(1, $foodcount); // 임의의 food_id 획득
        // echo $dietcount; 
        // var_dump($dietcount);
        // foodid를 배열로 담아서 마지막에 foreach를 통해 foodid에 대한 정보 출력
        // $sumkcal = 0;
        // $sumprotein = 0;
        // $sumfat = 0;
        
        // return view('recommend');
    }
}
