<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodCart;
use Illuminate\Support\Facades\Auth;
use App\Models\FavDiet;

class ApiController extends Controller
{
    
    // public function postFoodCart($food_id, $amount) {
    public function postFoodCart($data) {
        echo 'sedfg';
        echo 'asdkf';
        $id = Auth::user()->user_id;
        $uid = FavDiet::find($id);
        $data = json_decode($data);
        $cart = new FoodCart([
            'user_id' => $uid,
            'food_id' => $data->food_id,
            'amount' => $data->amount
        ]);
        $cart->save();
    // public function postFoodCart(Request $req) {
    //     echo 'asdkf';
    //     $cart = new FoodCart([
    //         'user_id' => Auth::user()->user_id,
    //         'food_id' => $req->food_id,
    //         'amount' => $req->amount
    //     ]);
    //     $cart->save();

        $arr = [
            'error' => '0'
            ,'msg' => ''
        ];

        if(!$data->food_id){
            $arr['error'] = '1';
            $arr['msg'] = 'fall';
        // if(!$food_id){
        //     $arr['error'] = '1';
        //     $arr['msg'] = 'fall';
        // if(!$req->food_id){
        //     $arr['error'] = '1';
        //     $arr['msg'] = 'fall';
        }else{
            $arr['error'] = '2';
            $arr['msg'] = 'success';
            $arr['data'] = $cart->only('food_id', 'user_id', 'amount');
        }
        return $arr;
    }
}
