<?php

namespace App\Http\Controllers;

use App\Models\FoodInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FoodController extends Controller
{
    public function userfood(){

        // 로그인 확인
        if(auth()->guest()) {
            return redirect()->route('user.login');
        }

        $user_id = 0;

        $foodinfo = FoodInfo::where('user_id','!=',$user_id)->orderBy('food_id','desc')->paginate(10);

        return view('userfood')->with('data',$foodinfo);

    }

    public function managerfood(){

        // 로그인 확인
        if(auth()->guest()) {
            return redirect()->route('user.login');
        }

        $user_id = 0;

        $foodinfo = FoodInfo::where('user_id',$user_id)
                    ->where('userfood_flg',$user_id)
                    ->orderBy('food_id','desc')->paginate(10);

        return view('managerfood')->with('data',$foodinfo);

    }

    public function foodinsert(Request $req){

        // 로그인 확인
        if(auth()->guest()) {
            return redirect()->route('user.login');
        }

        //유효성 검사
        $rules = [
            'food_name'     => 'required|min:2|max:20|regex:/^[가-힣0-9]+$/'
            ,'serving'      => 'required|integer|min:1|max:1000'
            ,'ser_unit'     => 'required'
            ,'kcal'         => 'required|integer|min:0|max:10000'
            ,'carbs'        => 'required|integer|min:0|max:10000'
            ,'protein'      => 'required|integer|min:0|max:10000'
            ,'fat'          => 'required|integer|min:0|max:10000'
            ,'sugar'        => 'integer|max:10000|nullable'
            ,'sodium'       => 'integer|max:10000|nullable'
        ];

        $messages = [
            'food_name'         => '음식명은 2~20자 한글과 숫자만 입력 가능합니다.',
            'serving'           => '제공량은 필수 입력 항목입니다.',
            'ser_unit'          => 'g, ml을 선택해주세요.',
            'kcal'              => '필수 입력사항입니다. 0~10000 사이 숫자를 입력해주세요',
            'carbs'             => '필수 입력사항입니다. 0~10000 사이 숫자를 입력해주세요',
            'protein'           => '필수 입력사항입니다. 0~10000 사이 숫자를 입력해주세요',
            'fat'               => '필수 입력사항입니다. 0~10000 사이 숫자를 입력해주세요',
            'sugar'             => '0~10000 사이 숫자를 입력해주세요',
            'sodium'            => '0~10000 사이 숫자를 입력해주세요',
        ];

        $validator = Validator::make($req->only(
            'food_name'
            ,'serving'
            ,'ser_unit'
            ,'kcal'
            ,'carbs'
            ,'protein'
            ,'fat'
            ,'sugar'
            ,'sodium'
        ), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }

        // 관리자 id와 userfood_flg
        $id = 0;

        // 같은 이름으로 등록 불가능
        $foods = FoodInfo::where('user_id', $id)->where('userfood_flg', $id)
        ->get();
        
        foreach ($foods as $val) {
            if ($val->food_name === $req->food_name) {
                return back()
                    ->withErrors(['food_name' => '이미 등록된 이름입니다.'])
                    ->withInput();
            }
        }

        // 음식 정보 테이블 인서트, 영양 정보 값이 없으면 0으로 처리
        $arr_food = [];

        $arr_food[] = [
            'user_id'       => $id
            ,'food_name'    => $req->food_name
            ,'kcal'         => $req->kcal
            ,'carbs'        => $req->carbs
            ,'protein'      => $req->protein
            ,'fat'          => $req->fat
            ,'sugar'        => $req->sugar ?? 0
            ,'sodium'       => $req->sodium ?? 0
            ,'serving'      => $req->serving
            ,'ser_unit'     => $req->ser_unit
            ,'userfood_flg' => $id
            ,'created_at'   => now()
        ];
        
        DB::table('food_infos')
        ->insert($arr_food);
        
        return redirect()->route('manager.food');
    }
}
