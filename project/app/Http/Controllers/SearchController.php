<?php
/****************************
 * 컨트롤러명   : SearchController
 * 디렉토리     : Contrllers
 * 파일명       : SearchController.php
 * 이력         : v001 0615 채수지 new
 *                v002 0616 채수지 add (검색 기능 추가)
 *                v003 0619 채수지 add (탭 기능 추가, 식단 정보 불러오기)
*****************************/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
// v001 add
use Illuminate\Support\Facades\Http;
use App\Models\FoodInfo;
use App\Models\FavDiet;
use App\Models\FavDietFood;
use Illuminate\support\Facades\Session;
use Illuminate\Support\Eloquent\SoftDeletes;
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
    // v002, v003 add : 음식 검색 기능 추가
    public function searchselect(Request $req, $id) {
        $usersearch = $req->search_input;

        $diets = DB::table('fav_diets')
        ->select('fav_diets.fav_name', 'fav_diet_food.food_id', 'fav_diet_food.fav_f_intake',
        'food_infos.food_name', 'food_infos.kcal', 'food_infos.carbs', 'food_infos.protein',
        'food_infos.fat', 'food_infos.sugar', 'food_infos.sodium')
        ->join('fav_diet_food', 'fav_diet_food.fav_id', '=', 'fav_diets.fav_id')
        ->join('food_infos', 'food_infos.food_id', '=', 'fav_diet_food.food_info')
        ->where('fav_diets.user_id', $id);

        if(!empty($usersearch)){
            $foods = FoodInfo::select('food_id', 'user_id', 'food_name')
            ->where('food_name', 'like', '%'.$usersearch.'%')
            ->where('userfood_flg', '0')
            // ->whereNull('deleted_at')
            ->get();
            return view('FoodList')->with('foods', $foods)->with('diet', $diets);
        }

        return view('FoodList')->with('diet', $diets);
        // return view('FoodList')->with('foods', $foods);
    }

    public function favdiets($id) {
        $favdiets = FavDiet::select('fav_id', 'user_id', 'fav_name')
        ->where('user_id', $id)
        // ->whereNull('deleted_at')
        ->get();

        return view('FoodList')->with('fav_diets', $favdiets);
    }

    public function userchoice(Request $req) {
        var_dump($req);
        $food_id = $req->usercheck;

        $select = FoodInfo::select('food_id', 'food_name')
        ->where('food_id', $food_id)
        ->get();

        return view("FoodList")->with('select_food', $select);
    
    }
}
