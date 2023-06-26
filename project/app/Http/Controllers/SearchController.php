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
 *                v007 0624 채수지 update (insert 기능 추가)
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
    // v001 new
    public function apisearch() {
        $numofrows = 20;
        for ($pagenum=1; $pagenum<20; $pagenum++) {
            // xml 
            // $foodinfo = Http::get('https://apis.data.go.kr/1471000/FoodNtrIrdntInfoService1/getFoodNtrItdntList1?serviceKey=bmFaWcRSgAvoTtX4icXz1GOdbD7o%2FMS%2BrX8nxsazgSgkLHja%2Bm7UT3I2BGnyAxapTRLBhq1IUH%2B%2BaykFTHQevg%3D%3D&pageNo='.$pagenum.'&numOfRows='.$numofrows);
            // https://curl.haxx.se/ca/cacert.pem > 에서 인증서(cacert.pem) 다운로드
            // php.ini > 1946행 주석 해제 후 "C:\cacert.pem" 추가 curl.cainfo = "C:\cacert.pem"
            // $xml = simplexml_load_string($foodinfo);
            // $json = json_encode($xml);
            // $array = json_decode($json, TRUE);

            // 값 조회 (xml)
            // for ($i=0; $i <count($array); $i++) { 
            //     echo $i." : ".$array['body']['items']['item'][$i]['DESC_KOR'].", "
            //     .$array['body']['items']['item'][$i]['SERVING_WT'].", "
            //     .$array['body']['items']['item'][$i]['NUTR_CONT1'].", "
            //     .$array['body']['items']['item'][$i]['NUTR_CONT2'].", "
            //     .$array['body']['items']['item'][$i]['NUTR_CONT3'].", "
            //     .$array['body']['items']['item'][$i]['NUTR_CONT4'].", "
            //     .$array['body']['items']['item'][$i]['NUTR_CONT5'].", "
            //     .$array['body']['items']['item'][$i]['NUTR_CONT6'].", <br>";
            // }

            // xml DB 저장
            // for($i=0; $i<$numofrows; $i++) {
            //     if(!empty($array['body']['items']['item'][$i]['DESC_KOR'])){
            //         $foods = new FoodInfo([
            //             'food_name' => $array['body']['items']['item'][$i]['DESC_KOR']
            //             , 'serving' => $array['body']['items']['item'][$i]['NUTR_CONT2'] === 'N/A' ? '0' : round($array['body']['items']['item'][$i]['SERVING_WT'])
            //             , 'kcal' => $array['body']['items']['item'][$i]['NUTR_CONT2'] === 'N/A' ? '0' : round($array['body']['items']['item'][$i]['NUTR_CONT1'])
            //             , 'carbs' => $array['body']['items']['item'][$i]['NUTR_CONT2'] === 'N/A' ? '0' : round($array['body']['items']['item'][$i]['NUTR_CONT2'])
            //             , 'protein'=> $array['body']['items']['item'][$i]['NUTR_CONT3'] === 'N/A' ? '0' : round($array['body']['items']['item'][$i]['NUTR_CONT3'])
            //             , 'fat' => $array['body']['items']['item'][$i]['NUTR_CONT4'] === 'N/A' ? '0' : round($array['body']['items']['item'][$i]['NUTR_CONT4'])
            //             , 'sugar' => $array['body']['items']['item'][$i]['NUTR_CONT5'] === 'N/A' ? '0' : round($array['body']['items']['item'][$i]['NUTR_CONT5'])
            //             , 'sodium' => $array['body']['items']['item'][$i]['NUTR_CONT6'] === 'N/A' ? '0' : round($array['body']['items']['item'][$i]['NUTR_CONT6'])
            //             , 'userfood_flg' => 0
            //         ]);
            //         $foods->save();
            //     }
            // } 
            
            // json
            $foodinfo = Http::get('https://apis.data.go.kr/1471000/FoodNtrIrdntInfoService1/getFoodNtrItdntList1?serviceKey=bmFaWcRSgAvoTtX4icXz1GOdbD7o%2FMS%2BrX8nxsazgSgkLHja%2Bm7UT3I2BGnyAxapTRLBhq1IUH%2B%2BaykFTHQevg%3D%3D&pageNo='.$pagenum.'&numOfRows='.$numofrows.'&type=json');
            $array = json_decode($foodinfo, TRUE);

            // 값 조회 (json)
            for ($i=0; $i <count($array); $i++) { 
                echo $i." : ".$array['body']['items']['item'][$i]['DESC_KOR'].", "
                .$array['body']['items']['item'][$i]['SERVING_WT'].", "
                .$array['body']['items']['item'][$i]['NUTR_CONT1'].", "
                .$array['body']['items']['item'][$i]['NUTR_CONT2'].", "
                .$array['body']['items']['item'][$i]['NUTR_CONT3'].", "
                .$array['body']['items']['item'][$i]['NUTR_CONT4'].", "
                .$array['body']['items']['item'][$i]['NUTR_CONT5'].", "
                .$array['body']['items']['item'][$i]['NUTR_CONT6']."<br>";
            }

            // for($i=0; $i<$numofrows; $i++) {
            //     if(!empty($array['body']['items'][$i]['DESC_KOR'])){
            //         $foods = new FoodInfo([
            //             'food_name' => $array['body']['items'][$i]['DESC_KOR']
            //             , 'serving' => $array['body']['items'][$i]['NUTR_CONT2'] === 'N/A' ? '0' : round($array['body']['items'][$i]['SERVING_WT'])
            //             , 'kcal' => $array['body']['items'][$i]['NUTR_CONT2'] === 'N/A' ? '0' : round($array['body']['items'][$i]['NUTR_CONT1'])
            //             , 'carbs' => $array['body']['items'][$i]['NUTR_CONT2'] === 'N/A' ? '0' : round($array['body']['items'][$i]['NUTR_CONT2'])
            //             , 'protein'=> $array['body']['items'][$i]['NUTR_CONT3'] === 'N/A' ? '0' : round($array['body']['items'][$i]['NUTR_CONT3'])
            //             , 'fat' => $array['body']['items'][$i]['NUTR_CONT4'] === 'N/A' ? '0' : round($array['body']['items'][$i]['NUTR_CONT4'])
            //             , 'sugar' => $array['body']['items'][$i]['NUTR_CONT5'] === 'N/A' ? '0' : round($array['body']['items'][$i]['NUTR_CONT5'])
            //             , 'sodium' => $array['body']['items'][$i]['NUTR_CONT6'] === 'N/A' ? '0' : round($array['body']['items'][$i]['NUTR_CONT6'])
            //             , 'userfood_flg' => 0
            //         ]);
            //         $foods->save();
            //     }
            // } 
                /* print_r -> json
                Array ( 
                    [header] => Array 
                        ( 
                            [resultCode] => 00 
                            [resultMsg] => NORMAL SERVICE.
                        ) 
                    [body] => Array 
                        ( 
                            [pageNo] => 1 
                            [totalCount] => 22602 
                            [numOfRows] => 20 
                            [items] => Array 
                                ( 
                                [0] => Array 
                                    ( 
                                        [DESC_KOR] => 고량미,알곡 
                                        [SERVING_WT] => 0 
                                        [NUTR_CONT1] => 0.00 
                                        [NUTR_CONT2] => 0.00 
                                        [NUTR_CONT3] => 0.00 
                                        [NUTR_CONT4] => 0.00 
                                        [NUTR_CONT5] => N/A 
                                        [NUTR_CONT6] => 0.00 
                                        [NUTR_CONT7] => N/A 
                                        [NUTR_CONT8] => N/A 
                                        [NUTR_CONT9] => N/A 
                                        [BGN_YEAR] => 2001 
                                        [ANIMAL_PLANT] => 
                                    )
                */
            }
        exit();
    }

    // ! 검색 및 데이터 조회
    // v002, v003 add : 음식 검색 기능 추가
    public function searchselect(Request $req, $id) {
        $usersearch = $req->search_input;

        // v004, v005
        // 저장된 식단 정보
        $dietnames = DB::table('fav_diets')
        ->select('fav_id', 'fav_name', 'user_id')
        ->where('user_id', $id)
        ->Paginate(10);

        $dietfoods = DB::table('food_infos')
        ->select('fav_diet_food.fav_id', 'fav_diet_food.fav_f_intake', 'food_infos.food_name', 'food_infos.kcal', 'food_infos.carbs', 'food_infos.protein', 'food_infos.fat', 'food_infos.sugar', 'food_infos.sodium')
        ->join('fav_diet_food', 'food_infos.food_id', '=', 'fav_diet_food.food_id')
        ->join('fav_diets', 'fav_diets.fav_id', '=', 'fav_diet_food.fav_id')
        ->where('fav_diets.user_id', $id)
        ->get();

        $seleted = DB::table('food_carts')
        ->select('food_carts.user_id', 'food_carts.amount', 'food_infos.food_name', 'food_carts.food_id')
        ->join('food_infos', 'food_carts.food_id', '=', 'food_infos.food_id')
        ->where('food_carts.user_id', $id)
        ->get();

        // todo : 최근 먹은 음식 쿼리 수정 필요
        // $recent = DB::table('diets')
        // ->select('diets.user_id', 'diet_food.food_id', 'diet_food.created_at')
        // ->join('diet_food', 'diets.d_id', 'diet_food.d_id')
        // ->whereRaw('created_at <= DATE_ADD(now(), INTERVAL -7 DAY)')
        // ->where('diets.user_id', $id)
        // ->get();

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
                ->Paginate(10);
                return view('FoodList')->with('foods', $foods)
                ->with('dietname', $dietnames)
                ->with('dietfood', $dietfoods)
                ->with('seleted', $seleted)
                // ->with('recent', $recent)
                ->with('data', $data);
            }

            // v005
            $foods = FoodInfo::select('food_id', 'user_id', 'food_name', 'kcal', 'carbs', 'protein', 'fat', 'sugar', 'sodium')
            ->where('food_name', 'like', '%'.$usersearch.'%')
            ->where('userfood_flg', '0')
            ->Paginate(15);
            return view('FoodList')
            ->with('foods', $foods)
            ->with('dietname', $dietnames)
            ->with('dietfood', $dietfoods)
            ->with('seleted', $seleted)
            // ->with('recent', $recent)
            ->with('data', $data);
        }
        return view('FoodList')
        ->with('dietname', $dietnames)
        ->with('dietfood', $dietfoods)
        ->with('seleted', $seleted)
        // ->with('recent', $recent)
        ->with('data', $data);
    }

    // ! 선택한 음식 입력
    // v006
    public function searchinsert($date, $time) {
        $id = Auth::user()->user_id;

        $cart = DB::table('food_carts')
        ->select('amount', 'food_id')
        ->where('user_id', $id)
        ->get()
        ->toArray();

        // v007
        // collection 객체로 반환됨 -> 어떻게 중복 값 찾을 지 몰라서 그냥 일반 배열로 바꿈
        foreach ($cart as $key) {
            $arr_cart[] = [$key->food_id, $key->amount];
        }
        // var_dump($arr_cart);

        $insertD = new Diet([
            'user_id' => $id,
            'd_date' => $date,
            'd_flg' => $time
        ]);
        $insertD->save();

        $selectD = Diet::select('d_id')
        ->where('user_id', $id)
        ->get();

        // var_dump($selectD);
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
        
        return redirect()->route('home');
        // return redirect()->route('search.list.get', ['id' => Auth::user()->user_id])->with('data', $data);
        // return redirect()->back()->with('data', $data);
    }

    // ! 취소 버튼 누를 시 임시 저장 데이터베이스 내용 삭제
    public function searchdelete() {
        $id = Auth::user()->user_id;

        DB::table('food_carts')->where('user_id', $id)->delete();
        // FoodCart::destroy($id);
        return redirect()->route('home');
    }

}
