<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodCart;
use Illuminate\Support\Facades\Auth;
use App\Models\FavDiet;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    
    public function postFoodCart($user_id, $food_id, $amount) {
    // public function postFoodCart($data) {
        Log::debug("시작");
        // if(Auth::check()) {
        //     Log::debug("Auth On");
        // }
        // if(auth('api')->guest()) {
        //     $arr['error'] = '1';
        //     $arr['msg'] = 'guest';
        //     return $arr;
        // }
        
        Log::debug("식단 획득");
        // $data = json_decode($data);
        $cart = new FoodCart([
            'user_id' => $user_id,
            'food_id' => $food_id,
            'amount' => $amount
        ]);
        $cart->save();

        $arr = [
            'error' => '0'
            ,'msg' => ''
        ];

        if(!$food_id){
            $arr['error'] = '1';
            $arr['msg'] = 'fall';
        }else{
            $arr['error'] = '2';
            $arr['msg'] = 'success';
            $arr['data'] = $cart->only('food_id', 'user_id', 'amount');
        }
        return $arr;
    }
    public function postFoodCart2($user_id, $fav_id){
        $cart = new FoodCart([
            'user_id' => $user_id,
            'fav_id' => $fav_id,
            'food_id' => 0,
            'amount' => 0.0
        ]);
        $cart->save();

        $arr = [
            'error' => '0'
            ,'msg' => ''
        ];

        if(!$fav_id){
            $arr['error'] = '1';
            $arr['msg'] = 'fall';
        }else{
            $arr['error'] = '2';
            $arr['msg'] = 'success';
            $arr['data'] = $cart->only('fav_id', 'user_id');
        }
        return $arr;
    }
}
