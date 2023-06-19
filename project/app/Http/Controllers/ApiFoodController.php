<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\FoodInfo;

class ApiFoodController extends Controller
{
    public function getFoodList($id) {

        $arr = [
            'errorcode' => '0'
            ,'msg'      => ''
        ];

        $food = FoodInfo::find($id);

        if (!$food) {
            $arr['errorcode'] = '1';
            $arr['msg'] = 'data not found';
        } else {
            $arr['errorcode'] = '0';
            $arr['msg'] = 'success';
            $arr['data'] = $food->only('food_name', 'kcal', 'carbs', 'protein', 'fat', 'sugar', 'sodium', 'serving', 'ser_unit');
        }

        return $arr;
    }
}
