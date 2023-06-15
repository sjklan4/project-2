<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\FoodInfo;

class SearchController extends Controller
{
    public function search() {
        $foodinfo = Http::get('https://apis.data.go.kr/1471000/FoodNtrIrdntInfoService1/getFoodNtrItdntList1?serviceKey=bmFaWcRSgAvoTtX4icXz1GOdbD7o%2FMS%2BrX8nxsazgSgkLHja%2Bm7UT3I2BGnyAxapTRLBhq1IUH%2B%2BaykFTHQevg%3D%3D');

        $xml = simplexml_load_string($foodinfo);
        $json = json_encode($xml);

        $array = json_decode($json, TRUE);

        dd($array);
        return view('index');
    }
}
