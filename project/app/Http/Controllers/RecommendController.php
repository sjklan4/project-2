<?php

namespace App\Http\Controllers;

use App\Models\FavDiet;
use App\Models\FavDietFood;
use App\Models\KcalInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RecommendController extends Controller
{
    public function rview() {
        $recomFood = [];
        return view('recommend')->with('recomFood', $recomFood);
    }

    public function recommned(Request $req) {
        $id = Auth::user()->user_id;
        $dietcount = DB::select('select count(recom_d_id) as count from recom_diets where recom_flg = ?', [$req->dietcate]); // 각 식단별 count 조회용

        // todo : 목표칼로리 구간에 따른 식단 추천 (if) 
        // todo : 저장된 식단이 없을 경우 식단 추천을 유도하는 멘트..?도 생각해보기
        // 1000~1800 총합 칼로리 제일 낮은 식단 추천
        // 1800~2500 총합 칼로리 중간
        // 2500~ 총합 칼로리 높음 

        // php artisan storage:link
        $kacaInfo = KcalInfo::find($id);

        if($kacaInfo->goal_kcal > 1000 || $kacaInfo->goal_kcal < 1800){
            echo 'ddaadd';
        }elseif($kacaInfo->goal_kcal > 1800 || $kacaInfo->goal_kcal < 2500) {
            echo 'ddsdd';
        }elseif($kacaInfo->goal_kcal > 2500) {
            echo 'dddsdd';
        }else{
            return redirect()->route('user.prevateinfo');
        }
        
        if($req->dietcate == 0){ // 감량 식단
            $dietid = DB::select('select recom_d_id from recom_diets where recom_flg = 0'); // 감량 식단 식단 id 조회용
            $randomFood = mt_rand(0, $dietcount[0]->count-1); // 식단 추천용 랜덤 번호(-> recom_d_id 갯수만큼) 추출

            // 감량 식단 랜덤 추천 쿼리
            $recomFood = DB::table('recom_diet_food')
            ->join('food_infos', 'recom_diet_food.food_id', 'food_infos.food_id')
            ->where('recom_diet_food.recom_d_id', $dietid[$randomFood]->recom_d_id)
            ->get();

        }else if($req->dietcate == 1){ // 증량 식단
            $dietid = DB::select('select recom_d_id from recom_diets where recom_flg = 1'); // 감량 식단 식단 id 조회용
            $randomFood = mt_rand(0, $dietcount[0]->count-1); // 식단 추천용 랜덤 번호(-> recom_d_id 갯수만큼) 추출

            // 증량 식단 랜덤 추천 쿼리
            $recomFood = DB::table('recom_diet_food')
            ->join('food_infos', 'recom_diet_food.food_id', 'food_infos.food_id')
            ->where('recom_diet_food.recom_d_id', $dietid[$randomFood]->recom_d_id) // mt_rand로 뽑은 숫자로 dietid 찾기
            ->get();
        }else{ // 일반 식단
            $dietid = DB::select('select recom_d_id from recom_diets where recom_flg = 2'); // 감량 식단 식단 id 조회용
            $randomFood = mt_rand(0, $dietcount[0]->count-1); // 식단 추천용 랜덤 번호(-> recom_d_id 갯수만큼) 추출

            // 일반 식단 랜덤 추천 쿼리
            $recomFood = DB::table('recom_diet_food')
            ->join('food_infos', 'recom_diet_food.food_id', 'food_infos.food_id')
            ->where('recom_diet_food.recom_d_id', $dietid[$randomFood]->recom_d_id)
            ->get();
        }

        $nutkcal = 0;
        $nutcarbs = 0;
        $nutprotein = 0;
        $nutfat = 0;

        foreach ($recomFood as $food) {
            $nutkcal += $food->kcal * $food->recom_intake;
            $nutcarbs += $food->carbs * $food->recom_intake;
            $nutprotein += $food->protein * $food->recom_intake;
            $nutfat += $food->fat * $food->recom_intake;
        }

        $totalnutri = [
            'kcal' => '칼로리 : '.round($nutkcal), 
            'carbs' => '탄수화물 : '.round($nutcarbs), 
            'protein' => '단백질 : '.round($nutprotein), 
            'fat' => '지방 : '.round($nutfat)
        ];
        return view('recommend')->with('recomFood', $recomFood)->with('totalnut', $totalnutri);
    }

    public function setdiet(Request $req) {
        $id = Auth::user()->user_id;
        $recomFood = json_decode($req->recomfood);

        $getsetFav = DB::table('fav_diets')->insertGetId([
            'user_id' => $id,
            'fav_name' => $req->fav_name
        ]);

        foreach ($recomFood as $value) {
            $setFavFood = new FavDietFood([
                'fav_id' => $getsetFav,
                'food_id' => $value->food_id,
                'fav_f_intake' => $value->recom_intake
            ]);
            $setFavFood->save();
        }
        return redirect()->route('fav.favdiet');
    }
}
