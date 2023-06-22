<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavController extends Controller
{
    
    public function favdiet(){ //유저의 자주찾는 식단 정보를 가져오게 하는 구문
        
        $user = Auth::user()->user_id;
        $favfood = DB::select('select d.fav_name, group_concat(i.food_name) as food_name
                                from fav_diets d
                                join fav_diet_food f
                                    on d.fav_id = f.fav_id
                                join food_infos i
                                    on f.food_id = i.food_id 
                                where d.user_id = ? group by d.fav_name', [$user]);
                            var_dump($favfood);
                            exit;
        return view('favdiet')->with('favfood', $favfood);
    }

    public function favfoodinfo(){
        $user = Auth::user()->user_id;
        $favfoodinfo = DB::select('
            SELECT i.food_name,i.kcal,i.carbs,i.protein,i.fat,i.sugar,i.sodium
                FROM fav_diets d
            	JOIN fav_diet_food f
            	ON d.fav_id = f.fav_id
             	JOIN food_infos i
             	ON i.food_id = f.food_id
                WHERE d.user_id = ? AND d.fav_id = ?',[$user, $fav_id]);
        return view('favdiet')->with('favfood', $favfoodinfo);
    }

}



// SELECT *
// FROM fav_diets d
// 	JOIN fav_diet_food f
// 	ON d.fav_id = f.fav_id
// 	JOIN food_infos i
// 	ON i.food_id = f.food_id
// WHERE d.user_id = 40;

// SELECT i.food_name,i.kcal,i.carbs,i.protein,i.fat,i.sugar,i.sodium
// FROM fav_diets d
// 	JOIN fav_diet_food f
// 	ON d.fav_id = f.fav_id
// 	JOIN food_infos i
// 	ON i.food_id = f.food_id
// WHERE d.user_id = 40 AND d.fav_id = 3;