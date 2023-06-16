<?php
/****************************
 * 컨트롤러명   : SearchController
 * 디렉토리     : Contrllers
 * 파일명       : SearchController.php
 * 이력         : v001 0615 채수지 new
 *                v002 0616 채수지 add (검색 기능 추가)
*****************************/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
// v001 add
use Illuminate\Support\Facades\Http;
use App\Models\FoodInfo;
use Illuminate\Support\Eloquent\SoftDeletes;

class SearchController extends Controller
{
    // v001 new
    public function search() {
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
                .$array['body']['items']['item'][$i]['NUTR_CONT6'].", <br>";
            }

            for($i=0; $i<$numofrows; $i++) {
                if(!empty($array['body']['items'][$i]['DESC_KOR'])){
                    $foods = new FoodInfo([
                        'food_name' => $array['body']['items'][$i]['DESC_KOR']
                        , 'serving' => $array['body']['items'][$i]['NUTR_CONT2'] === 'N/A' ? '0' : round($array['body']['items'][$i]['SERVING_WT'])
                        , 'kcal' => $array['body']['items'][$i]['NUTR_CONT2'] === 'N/A' ? '0' : round($array['body']['items'][$i]['NUTR_CONT1'])
                        , 'carbs' => $array['body']['items'][$i]['NUTR_CONT2'] === 'N/A' ? '0' : round($array['body']['items'][$i]['NUTR_CONT2'])
                        , 'protein'=> $array['body']['items'][$i]['NUTR_CONT3'] === 'N/A' ? '0' : round($array['body']['items'][$i]['NUTR_CONT3'])
                        , 'fat' => $array['body']['items'][$i]['NUTR_CONT4'] === 'N/A' ? '0' : round($array['body']['items'][$i]['NUTR_CONT4'])
                        , 'sugar' => $array['body']['items'][$i]['NUTR_CONT5'] === 'N/A' ? '0' : round($array['body']['items'][$i]['NUTR_CONT5'])
                        , 'sodium' => $array['body']['items'][$i]['NUTR_CONT6'] === 'N/A' ? '0' : round($array['body']['items'][$i]['NUTR_CONT6'])
                        , 'userfood_flg' => 0
                    ]);
                    $foods->save();
                }
            } 
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
    // v002 add : 
    public function foodselect() {
        $foods = FoodInfo::where('deleted_at', null)
                            ->limit(10)
                            ->dd();

        return redirect()->route('foods.select')->with('item', $foods);
    }
}
