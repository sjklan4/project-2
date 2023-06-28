<?php
/****************************
 * 컨트롤러명   : SearchController
 * 디렉토리     : Contrllers
 * 파일명       : SearchController.php
 * 이력         : v001 0615 채수지 new
 *                v002 0616 채수지 add (검색 기능 추가)
 *                v003 0619 채수지 add (탭 기능 추가, 식단 정보 불러오기)
 *                v004 0620 채수지 update (sql 수정)
 *                v005 0621 채수지 update (음식 검색 기능 수정)
 *                v006 0622 채수지 update (선택된 음식 불러오기)
 *                v007 0624 채수지 update (음식 입력 추가)
 *                v008 0626 채수지 update ()
 *                v009 0627 채수지 update (식단 입력 추가)
*****************************/
namespace App\Http\Controllers;

use App\Models\Diet;
use Illuminate\Http\Request;
// v001 add
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

class SearchController extends Controller
{
    // ! 검색 및 데이터 조회
    // v002, v003 add : 음식 검색 기능 추가
    public function searchselect(Request $req, $id) {
        $usersearch = $req->search_input;

        // v004, v005
        // 저장된 식단 정보
        $dietnames = DB::table('fav_diets')
        ->select('fav_id', 'fav_name', 'user_id')
        ->where('user_id', $id)
        ->whereNull('deleted_at')
        ->get();
        // ->Paginate(10);

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

        // todo : 최근 먹은 음식 쿼리 수정 필요
        // $recent = DB::table('diets')
        // ->select('diets.user_id', 'diet_food.food_id', 'diet_food.created_at')
        // ->join('diet_food', 'diets.d_id', 'diet_food.d_id')
        // ->whereRaw('created_at <= DATE_ADD(now(), INTERVAL -7 DAY)')
        // ->where('diets.user_id', $id)
        // ->get();

        // todo : 0.5인분 일 경우에는 /0.5 그 이상일 경우 *@ 
        // foreach ($dietfoods as $key) {
        //     if($key->fav_f_intake === 0.5){
        //         $total_nutrient[] = [
        //             // intval($key->kcal * 0.5),
        //             // intval($key->carbs * 0.5),
        //             // intval($key->protein * 0.5),
        //             // intval($key->fat * 0.5),
        //             // intval($key->sugar * 0.5),
        //             // intval($key->sodium * 0.5)
        //             'kcal' => intval($key->kcal * 0.5),
        //             'carbs' => intval($key->carbs * 0.5),
        //             'protein' => intval($key->protein * 0.5),
        //             'fat' => intval($key->fat * 0.5),
        //             'sugar' => intval($key->sugar * 0.5),
        //             'sodium' => intval($key->sodium * 0.5),
        //         ];
                
        //     }else if($key->fav_f_intake === 1){
        //         $total_nutrient[] = [
        //             // intval($key->kcal),
        //             // intval($key->carbs),
        //             // intval($key->protein),
        //             // intval($key->fat),
        //             // intval($key->sugar),
        //             // intval($key->sodium)
        //             'kcal' => intval($key->kcal),
        //             'carbs' => intval($key->carbs),
        //             'protein' => intval($key->protein),
        //             'fat' => intval($key->fat),
        //             'sugar' => intval($key->sugar),
        //             'sodium' => intval($key->sodium),
        //         ];
        //     }else{
        //         $total_nutrient[] = [
        //             // intval($key->kcal * $key->fav_f_intake),
        //             // intval($key->carbs * $key->fav_f_intake),
        //             // intval($key->protein * $key->fav_f_intake),
        //             // intval($key->fat * $key->fav_f_intake),
        //             // intval($key->sugar * $key->fav_f_intake),
        //             // intval($key->sodium * $key->fav_f_intake)
        //             'kcal' => intval($key->kcal * $key->fav_f_intake),
        //             'carbs' => intval($key->carbs * $key->fav_f_intake),
        //             'protein' => intval($key->protein * $key->fav_f_intake),
        //             'fat' => intval($key->fat * $key->fav_f_intake),
        //             'sugar' => intval($key->sugar * $key->fav_f_intake),
        //             'sodium' => intval($key->sodium * $key->fav_f_intake),
        //         ];
        //     }
        // }
        // var_dump($total_nutrient);
        // exit;
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

            // v004
            // 유저가 등록한 음식이 있을 경우
            if(!empty($id)){
                $foods = FoodInfo::select('food_id', 'user_id', 'food_name', 'kcal', 'carbs', 'protein', 'fat', 'sugar', 'sodium')
                ->where('food_name', 'like', '%'.$usersearch.'%')
                ->where('userfood_flg', '0')
                ->orWhere('user_id', $id)
                ->get();
                // ->Paginate(10);

                return view('FoodList')
                ->with('uinput', $usersearch)
                ->with('foods', $foods)
                ->with('dietname', $dietnames)
                ->with('dietfood', $dietfoods)
                ->with('seleted', $seleted)
                ->with('seleted_diet', $seleted_diet)
                // ->with('recent', $recent)
                // ->with('total', $total_nutrient)
                ->with('data', $data);
            }

            // v005
            $foods = FoodInfo::select('food_id', 'user_id', 'food_name', 'kcal', 'carbs', 'protein', 'fat', 'sugar', 'sodium')
            ->where('food_name', 'like', '%'.$usersearch.'%')
            ->where('userfood_flg', '0')
            ->get();
            // ->Paginate(10);

            return view('FoodList')
            ->with('uinput', $usersearch)
            ->with('foods', $foods)
            ->with('dietname', $dietnames)
            ->with('dietfood', $dietfoods)
            ->with('seleted', $seleted)
            ->with('seleted_diet', $seleted_diet)
            // ->with('recent', $recent)
            // ->with('total', $total_nutrient)
            ->with('data', $data);
        }
        return view('FoodList')
        ->with('uinput', $usersearch)
        ->with('dietname', $dietnames)
        ->with('dietfood', $dietfoods)
        ->with('seleted', $seleted)
        ->with('seleted_diet', $seleted_diet)
        // ->with('recent', $recent)
        // ->with('total', $total_nutrient)
        ->with('data', $data);
    }

    // ! ===================================================================================
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
        // collection 객체로 반환됨 -> 어떻게 중복 값 찾을 지 몰라서 그냥 일반 배열로 바꿈
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
            // todo : 계산 전 값이 입력되지 않도록 하기
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
                // todo : 여러 개의 음식 선택 후 입력 버튼을 누를 시 계산이 안 된 첫 번째 값과 계산이 된 값 두 개가 데이터베이스에 저장됨
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
        // FoodCart::destroy($id);
        return redirect()->route('home');
    }

    // ! 선택한 음식 탭에서 음식 삭제
    public function fooddelete(Request $req, $f_id){
        $id = Auth::user()->user_id;

        $data = [
            'date' => $req->date,
            'time' => $req->time
        ];
        // var_dump($data);

        DB::table('food_carts')->where('user_id', $id)->where('food_id', $f_id)->delete();
        // todo : route('home') -> route('search ... ')
        return redirect()->route('home');
        // return redirect()->route('search.list.get', ['id' => Auth::user()->user_id])->with('data', $data);
        // return redirect()->back()->with('data', $data);
    }

    // ! 선택한 음식 탭에서 자주먹는 식단 삭제
    public function dietdelete(Request $req, $d_id){
        $id = Auth::user()->user_id;

        $data = [
            'date' => $req->date,
            'time' => $req->time
        ];

        DB::table('food_carts')->where('user_id', $id)->where('fav_id', $d_id)->delete();
        // todo : route('home') -> route('search ... ')
        return redirect()->route('home');
    }

    // ! 취소 버튼 누를 시 임시 저장 데이터베이스 내용 삭제
    public function searchdelete() {
        $id = Auth::user()->user_id;

        DB::table('food_carts')->where('user_id', $id)->delete();
        // FoodCart::destroy($id);
        return redirect()->route('home');
    }

}
