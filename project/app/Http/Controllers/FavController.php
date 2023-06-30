<?php

/*****************************************************
 * 프로젝트명   : project-2
 * 디렉토리     : Controllers
 * 파일명       : FavController.php
 * 이력         : v001 0526 SJ.Park new
 *****************************************************/

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
        
        $user_id = Auth::user()->user_id; //로그인된 유저 정보를 확인하기 위한 기능
        $favname = FavDiet::select('fav_name','fav_id') // fav_diets테이블의 fav_name, fav_id 컬럼 값을 select
                        ->where('user_id',$user_id) // $user_id(로그인된 유저)의 user_id값과 같은 값을 찾도록 조건을 준다.
                        ->whereNull('fav_diets.deleted_at') //deleted컬럼이 널입 값만 가져오도록 한다. - softdelete된 값을 제외 시키기 위한 구문
                        ->get();//조회한 데이터를 get으로 가져온다(전부 가져오기)

        // var_dump($favname->count());


        // exit;

        //빈배열을 준비 : 아래 조건에 맞는 food_name 정보를 배열로 받아서 넣을 준비용
        $arr = [];
        // favname에 담겨 있는 데이터 수 만큼 반복 문을 진행 한다.
        for ($i=0; $i < $favname->count(); $i++) {  
            $favfood = FoodInfo::select('food_infos.food_name') // food_infos테이블에서 food_name을 찾는다
                            ->join('fav_diet_food','food_infos.food_id','fav_diet_food.food_id') //fav_diet_food 테이블의 food_id와 food_infos의 food_id를 연결 해서 같은 food_id에 있는 food_name을 찾는다.
                            ->join('fav_diets','fav_diet_food.fav_id','fav_diets.fav_id') // fav_diets테이블의 fav_id와 fav_diet_food의 fav_id와 같은 값을 찾는다.
                            ->where('fav_diet_food.fav_id', $favname[$i]->fav_id) //위에서 받은 favname의 i번째 fav_id를 조회 한다.(ex : fav_id안에 40번 유저의 3,4,5식단이 들어 있을시 3번 식단의 음식 이름들을 전부 조회해서 가져오고 그다음 4번, 5번 식으로 반복해서 음식 이름들을 각각 전부 가져온다.)
                            ->whereNull('fav_diet_food.deleted_at')
                            ->get();
            // $favfood에 들어온 모든 값들을 빈배열에 담는다.
            $arr[] = $favfood;
            
        }
    
    //
        if($id > 0){
            $foodinfo = FoodInfo::select('fav_diet_food.fav_f_id','food_infos.food_id','fav_diet_food.fav_f_intake','food_infos.food_name', 'food_infos.kcal', 'food_infos.carbs', 'food_infos.protein', 'food_infos.fat', 'food_infos.sugar', 'food_infos.sodium')
                                    ->join('fav_diet_food','fav_diet_food.food_id','food_infos.food_id')
                                    ->join('fav_diets','fav_diet_food.fav_id', 'fav_diets.fav_id')
                                    ->where('fav_diets.fav_id',$id)
                                    ->whereNull('fav_diet_food.deleted_at')
                                    ->get();
                                    
            return view('favdiet')->with('favname',$favname)->with('favfood', $arr)->with('foodinfo', $foodinfo)->with('id',$id);
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
            $favdiet = FavDiet::find($id);
            $favtable = FavDietFood::where('fav_id',$id)->delete();
            if($favdiet){
                $favdiet->delete();
            }
            // if ($favtable){
            //     $favtable->delete();
            // }
        
            return redirect()->route('fav.favdiet');
        }

        
        
        public function favfoodDel($id){
            $favtable = FavDietFood::find($id);
            $favtable->delete();
            return redirect()->route('fav.favdiet');
        }
    }