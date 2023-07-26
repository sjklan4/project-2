<?php

/*****************************************************
 * 컨트롤러명   : SearchController
 * 디렉토리     : Contrllers
 * 파일명       : ApiController.php
 * 이력         : v001 0615 채수지 new
 *                v002 0713 최아란 add, delete
 *****************************************************/

namespace App\Http\Controllers;

use App\Models\DietFood;
use Illuminate\Http\Request;
use App\Models\FoodCart;
use Illuminate\Support\Facades\Auth;
use App\Models\FavDiet;
use App\Models\FavDietFood;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    // v001 new
    public function apisearch() {
        $numofrows = 20;
        for ($pagenum=1; $pagenum<20; $pagenum++) {
            // ! https://curl.haxx.se/ca/cacert.pem > 에서 인증서(cacert.pem) 다운로드
            // ! php.ini > 1946행 주석 해제 후 "C:\cacert.pem" 추가 curl.cainfo = "C:\cacert.pem"
            // ? xml 
            // $foodinfo = Http::get('https://apis.data.go.kr/1471000/FoodNtrIrdntInfoService1/getFoodNtrItdntList1?serviceKey=bmFaWcRSgAvoTtX4icXz1GOdbD7o%2FMS%2BrX8nxsazgSgkLHja%2Bm7UT3I2BGnyAxapTRLBhq1IUH%2B%2BaykFTHQevg%3D%3D&pageNo='.$pagenum.'&numOfRows='.$numofrows);
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
            //             , 'serving' => $array['body']['items']['item'][$i]['NUTR_CONT2'] === 'N/A' ? '0' : intval($array['body']['items']['item'][$i]['SERVING_WT'])
            //             , 'kcal' => $array['body']['items']['item'][$i]['NUTR_CONT2'] === 'N/A' ? '0' : intval($array['body']['items']['item'][$i]['NUTR_CONT1'])
            //             , 'carbs' => $array['body']['items']['item'][$i]['NUTR_CONT2'] === 'N/A' ? '0' : intval($array['body']['items']['item'][$i]['NUTR_CONT2'])
            //             , 'protein'=> $array['body']['items']['item'][$i]['NUTR_CONT3'] === 'N/A' ? '0' : intval($array['body']['items']['item'][$i]['NUTR_CONT3'])
            //             , 'fat' => $array['body']['items']['item'][$i]['NUTR_CONT4'] === 'N/A' ? '0' : intval($array['body']['items']['item'][$i]['NUTR_CONT4'])
            //             , 'sugar' => $array['body']['items']['item'][$i]['NUTR_CONT5'] === 'N/A' ? '0' : intval($array['body']['items']['item'][$i]['NUTR_CONT5'])
            //             , 'sodium' => $array['body']['items']['item'][$i]['NUTR_CONT6'] === 'N/A' ? '0' : intval($array['body']['items']['item'][$i]['NUTR_CONT6'])
            //             , 'userfood_flg' => 0
            //         ]);
            //         $foods->save();
            //     }
            // } 
            
            // ! json
            $foodinfo = Http::get('https://apis.data.go.kr/1471000/FoodNtrIrdntInfoService1/getFoodNtrItdntList1?serviceKey=bmFaWcRSgAvoTtX4icXz1GOdbD7o%2FMS%2BrX8nxsazgSgkLHja%2Bm7UT3I2BGnyAxapTRLBhq1IUH%2B%2BaykFTHQevg%3D%3D&pageNo='.$pagenum.'&numOfRows='.$numofrows.'&type=json');
            $array = json_decode($foodinfo, TRUE);

            // 값 조회 (json)
            // for ($i=0; $i <count($array); $i++) { 
            //     echo $i." : ".$array['body']['items']['item'][$i]['DESC_KOR'].", "
            //     .$array['body']['items']['item'][$i]['SERVING_WT'].", "
            //     .$array['body']['items']['item'][$i]['NUTR_CONT1'].", "
            //     .$array['body']['items']['item'][$i]['NUTR_CONT2'].", "
            //     .$array['body']['items']['item'][$i]['NUTR_CONT3'].", "
            //     .$array['body']['items']['item'][$i]['NUTR_CONT4'].", "
            //     .$array['body']['items']['item'][$i]['NUTR_CONT5'].", "
            //     .$array['body']['items']['item'][$i]['NUTR_CONT6']."<br>";
            // }

            // for($i=0; $i<$numofrows; $i++) {
            //     if(!empty($array['body']['items'][$i]['DESC_KOR'])){
            //         $foods = new FoodInfo([
            //             'food_name' => $array['body']['items'][$i]['DESC_KOR']
            //             , 'serving' => $array['body']['items'][$i]['NUTR_CONT2'] === 'N/A' ? '0' : intval($array['body']['items'][$i]['SERVING_WT'])
            //             , 'kcal' => $array['body']['items'][$i]['NUTR_CONT2'] === 'N/A' ? '0' : intval($array['body']['items'][$i]['NUTR_CONT1'])
            //             , 'carbs' => $array['body']['items'][$i]['NUTR_CONT2'] === 'N/A' ? '0' : intval($array['body']['items'][$i]['NUTR_CONT2'])
            //             , 'protein'=> $array['body']['items'][$i]['NUTR_CONT3'] === 'N/A' ? '0' : intval($array['body']['items'][$i]['NUTR_CONT3'])
            //             , 'fat' => $array['body']['items'][$i]['NUTR_CONT4'] === 'N/A' ? '0' : intval($array['body']['items'][$i]['NUTR_CONT4'])
            //             , 'sugar' => $array['body']['items'][$i]['NUTR_CONT5'] === 'N/A' ? '0' : intval($array['body']['items'][$i]['NUTR_CONT5'])
            //             , 'sodium' => $array['body']['items'][$i]['NUTR_CONT6'] === 'N/A' ? '0' : intval($array['body']['items'][$i]['NUTR_CONT6'])
            //             , 'userfood_flg' => 0
            //         ]);
            //         $foods->save();
            //     }
            // } 
            /* print_r(json)
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
    
    public function postFoodCart(Request $req) {
        $arr = [
            'errorcode' => '0'
            ,'msg' => '장바구니 입력 성공'
        ];

        // 현재 장바구니 정보 획득
        $carts = DB::table('food_carts')
        ->select('food_carts.cart_id', 'food_carts.user_id', 'food_carts.amount', 'food_infos.food_name', 'food_carts.food_id', 'food_carts.fav_id')
        ->join('food_infos', 'food_carts.food_id', '=', 'food_infos.food_id')
        ->where('food_carts.user_id', $req->value1)
        ->where('food_infos.food_id', $req->value2)
        ->get();

        // 장바구니 
        $countDuplicateFood = FavDietFood::join('fav_diets', 'fav_diet_food.fav_id', 'fav_diets.fav_id')
            ->join('food_carts', 'food_carts.fav_id', 'fav_diet_food.fav_id')
            ->where('fav_diets.user_id', $req->value1)
            ->where('fav_diet_food.food_id', $req->value2)
            ->get();

        // 장바구니에 같은 음식을 넣지 못하도록 처리
        $flg = 0;
        if($carts->count() > 0 || $countDuplicateFood->count() > 0) {
            $arr['errorcode'] = '1';
            $arr['msg'] = '해당음식이 이미 선택된 음식에 존재합니다.';
            $flg = 1;
        }

        if($flg === 0) {
            $cart = new FoodCart([
                'user_id' => $req->value1,
                'food_id' => $req->value2,
                'amount'  => $req->value3
            ]);
            $cart->save();

            // 현재 음식 장바구니 정보 획득
            $seleted = DB::table('food_carts')
            ->select('food_carts.cart_id', 'food_carts.user_id', 'food_carts.amount', 'food_infos.food_name', 'food_carts.food_id')
            ->join('food_infos', 'food_carts.food_id', '=', 'food_infos.food_id')
            ->where('food_carts.user_id', $req->value1)
            ->where('food_carts.food_id', $req->value2)
            ->first();

            $arr['data'] = $seleted;
        }

        return $arr;
    }

    public function postFoodCart2(Request $req){
        $arr = [
            'errorcode' => '0'
            ,'msg' => '장바구니 입력 성공'
        ];

        // 식단 음식 정보 + 장바구니 음식 아이디 조인 셀렉트
        $countDuplicateFood = FavDietFood::join('fav_diets', 'fav_diet_food.fav_id', 'fav_diets.fav_id')
            ->join('food_carts', 'food_carts.food_id', 'fav_diet_food.food_id')
            ->where('fav_diets.user_id', $req->user_id)
            ->where('fav_diet_food.fav_id', $req->fav_id)
            ->get();

        // 결과가 있으면 에러코드 작성
        $flg = 0;
        if ($countDuplicateFood->count() > 0) {
            $arr['errorcode'] = '1';
            $arr['msg'] = '해당음식이 이미 선택된 음식에 존재합니다.';
            $flg = 1;
        }

        // 결과가 없으면 인서트
        if($flg === 0) {
            $cart = new FoodCart([
                'user_id' => $req->user_id,
                'fav_id' => $req->fav_id,
                'food_id' => 0,
                'amount' => 0.0
            ]);
            $cart->save();

            // 장바구니 정보 획득
            $seleted_diet = DB::table('food_carts')
            ->select('food_carts.cart_id', 'food_carts.user_id', 'food_carts.fav_id', 'fav_diets.fav_name')
            ->join('fav_diets', 'fav_diets.fav_id', '=', 'food_carts.fav_id')
            ->where('food_carts.user_id', $req->user_id)
            ->get();

            $arr['data'] = $seleted_diet;
        }
        return $arr;
    }

    public function foodDelete(Request $req) {
        $arr = [
            'error' => '0'
            ,'msg' => ''
        ];

        if(!$req->food_id){
            $arr['error'] = '1';
            $arr['msg'] = 'fall';
        }else{
            $arr['error'] = '2';
            $arr['msg'] = 'success';

            DB::table('food_carts')
            ->where('user_id', $req->user_id)
            ->where('food_id', $req->food_id)
            ->where('cart_id', $req->cart_id)
            ->delete();

            $seleted = DB::table('food_carts')
            ->select('food_carts.cart_id', 'food_carts.user_id', 'food_carts.amount', 'food_infos.food_name', 'food_carts.food_id')
            ->join('food_infos', 'food_carts.food_id', '=', 'food_infos.food_id')
            ->where('food_carts.user_id', $req->user_id)
            ->get();
        }
        return response()->json($seleted);
    }

    public function dietDelete(Request $req) {
        $arr = [
            'errorcode' => '0'
            ,'msg' => '식단 삭제 성공'
        ];
        
        DB::table('food_carts')
            ->where('cart_id', $req->cart_id)
            ->delete();

        $seleted_diet = DB::table('food_carts')
        ->select('food_carts.cart_id', 'food_carts.user_id', 'food_carts.fav_id', 'fav_diets.fav_name')
        ->join('fav_diets', 'fav_diets.fav_id', '=', 'food_carts.fav_id')
        ->where('food_carts.user_id', $req->user_id)
        ->get();

        if ($seleted_diet->count() > 0 ) {
            $arr['data'] = $seleted_diet;
        } else {
            $arr['errorcode'] = '1';
            $arr['data'] = '식단 목록이 없습니다.';
        }
        return $arr;
    }
}
