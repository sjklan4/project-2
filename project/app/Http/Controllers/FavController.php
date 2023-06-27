<?php

namespace App\Http\Controllers;

use App\Models\FavDiet;
use App\Models\FavDietFood;
use App\Models\FoodInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class FavController extends Controller
{
    
    public function favdiet($id = '0'){ //유저의 자주찾는 식단 정보를 가져오게 하는 구문
        
        $user_id = Auth::user()->user_id;
        $favname = FavDiet::select('fav_name','fav_id')
                        ->where('user_id',$user_id)
                        ->get();

        // var_dump($favname->count());
        // exit;

        $arr = [];
        for ($i=0; $i < $favname->count(); $i++) { 
            $favfood = FoodInfo::select('food_infos.food_name')
                            ->join('fav_diet_food','food_infos.food_id','fav_diet_food.food_id')
                            ->join('fav_diets','fav_diet_food.fav_id','fav_diets.fav_id')
                            ->where('fav_diet_food.fav_id', $favname[$i]->fav_id)
                            ->whereNull('fav_diets.deleted_at')
                            ->get();
            $arr[] = $favfood;
            
        }
    
    
        if($id > 0){
            $foodinfo = FoodInfo::select('fav_diet_food.fav_f_id','food_infos.food_id','food_infos.food_name', 'food_infos.kcal', 'food_infos.carbs', 'food_infos.protein', 'food_infos.fat', 'food_infos.sugar', 'food_infos.sodium')
                                    ->join('fav_diet_food','fav_diet_food.food_id','food_infos.food_id')
                                    ->join('fav_diets','fav_diet_food.fav_id', 'fav_diets.fav_id')
                                    ->where('fav_diets.fav_id',$id)
                                    ->whereNull('fav_diet_food.deleted_at')
                                    ->get();
                                    
            return view('favdiet')->with('favname',$favname)->with('favfood', $arr)->with('foodinfo', $foodinfo);
        }

        return view('favdiet')->with('favname',$favname)->with('favfood', $arr);
        }   
            
        public function intakeupdate(Request $req){
            
            $food_id = $req->input('food_id'); //input에 있는 food_id를 받아온다.
            $intake = $req->input('intake'); //input에 있는 intake값을 받아온다.

            foreach($food_id as $key => $food_id){ //food_id 에 있는 키값($index)에 food_id를 포함해서 가져온다.
                DB::table('fav_diet_food') // 테이블을 지정
                ->where('food_id', $food_id) //조건은 food_id갑을 받아 온다.
                ->update(['fav_f_intake' => $intake[$key]]); //intake에 있는 input값을 fav_f_intake 컬럼에 업데이트 시킨다.
            }

            return redirect()->route('fav.favdiet');
        }

        public function favdietDel($id){
            $favtable = FavDietFood::find($id);
            $favtable->delete();
            return redirect()->route('fav.favdiet');
        }

        
        
        public function favfoodDel($id){
            $favtable = FavDietFood::find($id);
            $favtable->delete();
            return redirect()->route('fav.favdiet');
        }
    }

     // if($req->intake !== $favditefood->food_id){
                //     $arrkey[]='intake';
                // }

                //     foreach($arrkey as $val){
                //         $favditefood->$val = $req->$val;
                //     }
                // $favditefood->save();


// UPDATE fav_diet_food SET fav_f_intake = 2 WHERE food_id = 1245;
        // var_dump($arr);
        // exit;
    
    // SELECT food_name, kcal, carbs, protein, fat, sugar, sodium
    // FROM food_infos
    // JOIN fav_diet_food
    // ON fav_diet_food.food_id = food_infos.food_id
    // JOIN fav_diets
    // ON fav_diet_food.fav_id = fav_diets.fav_id
    // WHERE fav_diets.fav_id = 3;




            // SELECT fav_diet_food.fav_id, food_infos.food_name
            // FROM food_infos
            // JOIN fav_diet_food ON food_infos.food_id = fav_diet_food.food_id
            // WHERE fav_diet_food.fav_id = 4;
            



    // $favfoodinfo = DB::select(' SELECT i.food_name,i.kcal,i.carbs,i.protein,i.fat,i.sugar,i.sodium
    //                             FROM fav_diets d
    //                             JOIN fav_diet_food f
    //                                 ON d.fav_id = f.fav_id
    //                             JOIN food_infos i
    //                                 ON i.food_id = f.food_id
    //                             WHERE d.fav_id = ?',[$id]);                                                  

        
   
// group by의 정석은 select 컬럼과 맞춰서 사용해야는것이 정상 mysql과 mariadb자체에서는 허용가능
    
    // public function favfoodinfo(Request $req){
    //     $user = Auth::user()->user_id;
    //     $fav_id = $req->input('fav_id');
    //     $favfoodinfo = DB::select(' SELECT i.food_name,i.kcal,i.carbs,i.protein,i.fat,i.sugar,i.sodium
    //             FROM fav_diets d
    //                 JOIN fav_diet_food f
    //                     ON d.fav_id = f.fav_id
    //                 JOIN food_infos i
    //                     ON i.food_id = f.food_id
    //             WHERE d.user_id = ? AND d.fav_id = ?',[$user, $fav_id]);
          
    //     // return redirect()->with('favfoodinfo', $favfoodinfo);
    //     // return redirect()->route('fav.favfoodinfo', ['fav_id' => $fav_id]);
    //     return view('favdiet',['favfoodinfo' => $favfoodinfo])
    // }



                            
        // $favfoodinfo = FoodInfo::select('')
        
        
        // var_dump($favfood);
        // exit;
        // join('fav_diet_food', 'fav_diets.fav_id', 'fav_diet_food.fav_id')
        //     ->join('food_infos', 'fav_diet_food.food_id', 'food_infos.food_id')
        //     ->select('fav_diets.fav_id', 'fav_diets.fav_name', 'food_infos.food_name')
        //     ->where('fav_diets.user_id', $user)
        //     ->get();
            
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


  // if($req->intake !== $favditefood->food_id){
                //     $arrkey[]='intake';
                // }

                //     foreach($arrkey as $val){
                //         $favditefood->$val = $req->$val;
                //     }
                // $favditefood->save();