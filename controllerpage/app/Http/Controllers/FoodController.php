<?php

namespace App\Http\Controllers;

use App\Models\FoodInfo;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function userfood(){

        // 로그인 확인
        if(auth()->guest()) {
            return redirect()->route('user.login');
        }

        $user_id = 0;

        $foodinfo = FoodInfo::where('user_id','!=',$user_id)->paginate(10);

        return view('userfood')->with('data',$foodinfo);

    }

    public function userfoodDetail($id) {

        $test = $id;
        
        return view('modal');
    }
}
