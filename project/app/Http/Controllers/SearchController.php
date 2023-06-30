<?php
/****************************
 * 컨트롤러명   : SearchController
 * 디렉토리     : Contrllers
 * 파일명       : SearchController.php
 * 이력         : v001 0615 채수지 new
*****************************/
namespace App\Http\Controllers;

use App\Models\Diet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\FoodInfo;
use App\Models\FavDiet;
use App\Models\FavDietFood;
use App\Models\DietFood;
use Illuminate\support\Facades\Session;
use Illuminate\Support\Eloquent\SoftDeletes;
use App\Models\FoodCart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{
    // ! 검색 및 데이터 조회
    // v002, v003 add : 음식 검색 기능 추가
    public function searchselect(Request $req, $id) {
        $usersearch = $req->search_input;

        $req->flashOnly('search_input');
        
        // v004, v005
        // 저장된 식단 정보
        $dietnames = DB::table('fav_diets')
        ->select('fav_id', 'fav_name', 'user_id')
        ->where('user_id', $id)
        ->whereNull('deleted_at')
        ->get();

        $dietfoods = DB::table('food_infos')
        ->select('fav_diet_food.fav_id', 'fav_diet_food.fav_f_intake', 'food_infos.food_name', 'food_infos.kcal', 'food_infos.carbs', 'food_infos.protein', 'food_infos.fat', 'food_infos.sugar', 'food_infos.sodium')
        ->join('fav_diet_food', 'food_infos.food_id', '=', 'fav_diet_food.food_id')
        ->join('fav_diets', 'fav_diets.fav_id', '=', 'fav_diet_food.fav_id')
        ->where('fav_diets.user_id', $id)
        ->get();

        // 선택된 음식
        $seleted = DB::table('food_carts')
        ->select('food_carts.user_id', 'food_carts.amount', 'food_infos.food_name', 'food_carts.food_id')
        ->join('food_infos', 'food_carts.food_id', '=', 'food_infos.food_id')
        ->where('food_carts.user_id', $id)
        ->get();

        $seleted_diet = DB::table('food_carts')
        ->select('food_carts.user_id', 'food_carts.fav_id', 'fav_diets.fav_name')
        ->join('fav_diets', 'fav_diets.fav_id', '=', 'food_carts.fav_id')
        ->where('food_carts.user_id', $id)
        ->get();

        $data = [
            'date' => $req->date,
            'time' => $req->time
        ];

        session([
            'date' => $req->date,
            'time' => $req->time
        ]);

        // v002 
        // 검색 정보
        if(!empty($usersearch)){
            $foods = DB::table('food_infos')
            ->select('food_id', 'user_id', 'food_name', 'kcal', 'carbs', 'protein', 'fat', 'sugar', 'sodium')
            ->where('food_name', 'like', '%'.$usersearch.'%')
            // ->where(function($query2) use($usersearch){
            //     $query2->where('food_name', 'like', $usersearch)
            //     ->orwhere('food_name', 'like', '%'.$usersearch.'%');
            // })
            ->where(function($query) use($id){
                $query->where('user_id', $id)
                ->orWhere('user_id', 0);
            })
            ->get();

            return view('FoodList')
            ->with('foods', $foods)
            ->with('dietname', $dietnames)
            ->with('dietfood', $dietfoods)
            ->with('seleted', $seleted)
            ->with('seleted_diet', $seleted_diet)
            ->with('data', $data);
        }
        return view('FoodList')
        ->with('dietname', $dietnames)
        ->with('dietfood', $dietfoods)
        ->with('seleted', $seleted)
        ->with('seleted_diet', $seleted_diet)
        ->with('data', $data);
    }

    // ! 선택한 음식 입력
    // v006
    public function searchinsert($date, $time) {
        $id = Auth::user()->user_id;

        Session::put('d_date',$date);
        $cart = DB::table('food_carts')
        ->select('amount', 'food_id')
        ->where('user_id', $id)
        ->get()
        ->toArray();

        $diet_food = DB::select('SELECT food_infos.food_id, food_carts.fav_id, fav_diet_food.fav_f_intake FROM food_carts INNER JOIN fav_diet_food ON fav_diet_food.fav_id = food_carts.fav_id INNER JOIN food_infos ON fav_diet_food.food_id = food_infos.food_id WHERE fav_diet_food.food_id = food_infos.food_id AND food_carts.user_id = ?', [$id]);

        foreach ($diet_food as $key) {
            $arraydiet[] = [
                $key->fav_id,
                $key->food_id,
                $key->fav_f_intake
            ];
        }

        // v007
        // * collection 객체로 반환됨 -> foreach를 통해 2차원 배열로 바꿈]
        // ? 2차원 배열의 이유 : 1차원 배열으로 할 경우 값이 여러 개 담기지 않고 마지막 값만 배열에 담김
        foreach ($cart as $key) {
            $arr_cart[] = [$key->food_id, $key->amount];
        }
        $selectD = Diet::select('d_id', 'user_id', 'd_flg', 'd_date')
        ->where('user_id', $id)
        ->get();

        foreach ($selectD as $key) {
            $arrayd = [
                $key->d_id,
                $key->user_id,
                $key->d_date,
                $key->d_flg
            ];
        }

        // ! 식단 입력
        // v00
        if($arr_cart[0][0] === 0 && $arr_cart[0][1] === '0.0'){
            if($arrayd[1] === $id && $arrayd[2] === $date && $arrayd[3] === $time){
                for($e=0; $e<count($arraydiet); $e++){
                    $insertDF = new DietFood([
                        'food_id' => $arraydiet[$e][1],
                        'd_id' => $arrayd[0],
                        'df_intake' => $arraydiet[$e][2]
                    ]);
                    $insertDF->save();
                }
            }else{
                $insertD = new Diet([
                    'user_id' => $id,
                    'd_date' => $date,
                    'd_flg' => $time
                ]);
                $insertD->save();
        
                $selectD = Diet::select('d_id')
                ->where('user_id', $id)
                ->get();
        
                foreach ($selectD as $key) {
                    $selete_d_id = $key->d_id;
                }

                for($e=0; $e<count($arraydiet); $e++){
                    $insertDF = new DietFood([
                        'food_id' => $arraydiet[$e][1],
                        'd_id' => $selete_d_id,
                        'df_intake' => $arraydiet[$e][2]
                    ]);
                    $insertDF->save();
                }
            }
        }else{
        // ! 음식 입력
        if($arrayd[1] === $id && $arrayd[2] === $date && $arrayd[3] === $time){
            $sum = $arr_cart[0][1];
            for ($i=0; $i < count($arr_cart); $i++) { 
                for ($z=1; $z <= $i; $z++) {
                    if($arr_cart[$i] == $arr_cart[$z]){
                        $sum += $arr_cart[$i][1];
                        if($arr_cart[$i] !== $arr_cart[$z]){
                            $sum += $arr_cart[$i][1];
                        }
                    }else{
                        if($arr_cart[$i][0] !== $arr_cart[$z][0] && empty($arr_cart[$i][0])){
                            $insertDF = new DietFood([
                                'food_id' => $arr_cart[$i][0],
                                'd_id' => $arrayd[0],
                                'df_intake' => $sum
                            ]);
                            $insertDF->save();
                        }
                        $sum = 0;
                    }
                }
                $insertDF = new DietFood([
                    'food_id' => $arr_cart[$i][0],
                    'd_id' => $arrayd[0],
                    'df_intake' => $sum
                ]);
                $insertDF->save();
            }
        }else{
            $insertD = new Diet([
                'user_id' => $id,
                'd_date' => $date,
                'd_flg' => $time
            ]);
            $insertD->save();
    
            $selectD = Diet::select('d_id')
            ->where('user_id', $id)
            ->get();
    
            foreach ($selectD as $key) {
                $selete_d_id = $key->d_id;
            }
    
            $sum = $arr_cart[0][1];
            // ? 인분 수 계산식
            for ($i=0; $i < count($arr_cart); $i++) { 
                for ($z=1; $z <= $i; $z++) {
                    if($arr_cart[$i] == $arr_cart[$z]){
                        $sum += $arr_cart[$i][1];
                        if($arr_cart[$i] !== $arr_cart[$z]){
                            $sum += $arr_cart[$i][1];
                        }
                    }else{
                        if($arr_cart[$i][0] !== $arr_cart[$z][0] && empty($arr_cart[$i][0])){
                            $insertDF = new DietFood([
                                'food_id' => $arr_cart[$i][0],
                                'd_id' => $selete_d_id,
                                'df_intake' => $sum
                            ]);
                            $insertDF->save();
                        }
                        $sum = 0;
                    }
                }
    
                // ? 데이터베이스 입력
                $insertDF = new DietFood([
                    'food_id' => $arr_cart[$i][0],
                    'd_id' => $selete_d_id,
                    'df_intake' => $sum
                ]);
                $insertDF->save();
            }
        }
    }
        
        DB::table('food_carts')->where('user_id', $id)->delete();
        return redirect()->route('home');
    }

    // ! 취소 버튼 누를 시 임시 저장 데이터베이스 내용 삭제
    public function searchdelete() {
        $id = Auth::user()->user_id;

        DB::table('food_carts')->where('user_id', $id)->delete();
        return redirect()->route('home');
    }
}
