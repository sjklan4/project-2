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
    
    // ! php artisan storage:link > 사진 업로드
    // todo : 저장된 식단이 없을 경우 식단 추천을 유도하는 멘트..?도 생각해보기
    
    public function recommned(Request $req) {
        $id = Auth::user()->user_id;
        $kcalInfo = KcalInfo::find($id);
        
        // todo 목표칼로리가 1000이 넘지 않을 때 목표 칼로리 설정 페이지로 리턴 > js 함수로 변경
        if($kcalInfo->goal_kcal < 1000){
            return redirect()->route('user.prevateinfo');
        }

        // 목표칼로리 구간에 따른 식단 분류용 if
        if($kcalInfo->goal_kcal > 1000 && $kcalInfo->goal_kcal < 1800){ // 총합 칼로리 제일 낮은 식단 추천
            $minmax = 0;
        }elseif($kcalInfo->goal_kcal > 1800 && $kcalInfo->goal_kcal < 2500) { // 총합 칼로리 중간 식단 추천
            $minmax = 1;
        }elseif($kcalInfo->goal_kcal > 2500) { // 총합 칼로리 제일 높은 식단 추천
            $minmax = 2;
        }

        $dietcount = DB::select('select recom_d_id from recom_diets WHERE recom_flg = ? AND minmax_flg = ?', [$req->dietcate, $minmax]); // 각 식단별 count 조회용
        foreach ($dietcount as $item) {
            $diet_id[] = $item->recom_d_id;
        }

        
        // 목표칼로리에 따른 식단 추천
            if($req->dietcate == 0){ // 감량 식단
                $randomFood = array_rand($diet_id, 1); // 식단 추천용 랜덤 번호
    
                // 감량 식단 랜덤 추천 쿼리
                $recomFood = DB::table('recom_diet_food')
                ->join('food_infos', 'recom_diet_food.food_id', 'food_infos.food_id')
                ->where('recom_diet_food.recom_d_id', $diet_id[$randomFood])
                ->get();
    
            }else if($req->dietcate == 1){ // 증량 식단
                $randomFood = array_rand($diet_id, 1); // 식단 추천용 랜덤 번호
    
                // 증량 식단 랜덤 추천 쿼리
                $recomFood = DB::table('recom_diet_food')
                ->join('food_infos', 'recom_diet_food.food_id', 'food_infos.food_id')
                ->where('recom_diet_food.recom_d_id', $diet_id[$randomFood]) // mt_rand로 뽑은 숫자로 dietid 찾기
                ->get();
            }else{ // 일반 식단
                $randomFood = array_rand($diet_id, 1); // 식단 추천용 랜덤 번호

                // 일반 식단 랜덤 추천 쿼리
                $recomFood = DB::table('recom_diet_food')
                ->join('food_infos', 'recom_diet_food.food_id', 'food_infos.food_id')
                ->where('recom_diet_food.recom_d_id', $diet_id[$randomFood])
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
        
        // todo : 영양성분이 0인 데이터 수정하기
        $totalnutri = [
            'kcal' => '칼로리 : '.round($nutkcal), 
            'carbs' => '탄수화물 : '.round($nutcarbs), 
            'protein' => '단백질 : '.round($nutprotein), 
            'fat' => '지방 : '.round($nutfat)
        ];
        return view('recommend')->with('recomFood', $recomFood)
        ->with('totalnut', $totalnutri);
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
