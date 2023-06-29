<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Models\FoodInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class FoodController extends Controller
{
    public function index($id = '0') {
        if(auth()->guest()) {
            return redirect()->route('user.login');
        }
        
        $user_id = Auth::user()->user_id;

        // 사용자 등록 음식 목록
        $result = FoodInfo::select('food_name', 'food_id', 'user_id')
        ->where('user_id', $user_id)
        ->get();

        // 세부 등록 음식 정보 획득
        if ($id > 0) {
            $food = FoodInfo::select('food_name', 'food_id', 'user_id', 'kcal', 'carbs', 'protein', 'fat', 'sugar', 'sodium', 'serving', 'ser_unit')
            ->where('food_id', $id)
            ->get();

            // 사용자 id가 다른 음식 조회&수정 방지
            if ($food[0]->user_id !== $user_id) {
                return redirect()->route('food.index');
            }

            return view('/foodManage')->with('data', $result)->with('food', $food[0]);
        }
        
        return view('/foodManage')->with('data', $result);
    }


    public function create() {
        if(auth()->guest()) {
            return redirect()->route('user.login');
        }


        return view('/foodCreate');
    }

    public function store(Request $req) {

        if(auth()->guest()) {
            return redirect()->route('user.login');
        }

        // 유저 id 획득
        $id = Auth::user()->user_id;

        // 10개 이상 등록 금지
        $foods = FoodInfo::where('user_id', $id)
        ->get();

        if ($foods->count() >= 10) {
            return redirect()->route('food.index');
        }

        //유효성 검사
        $rules = [
            'foodName'      => 'required|min:2|max:20|regex:/^[가-힣0-9]+$/'
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
            'foodName'          => '음식명은 2~20자 한글과 숫자만 입력 가능합니다.',
            'serving'           => '제목은 필수 입력 항목입니다.',
            'ser_unit'          => 'g, ml을 선택해주세요.',
            'kcal'              => '필수 입력사항입니다. 0~10000 사이 숫자를 입력해주세요',
            'carbs'             => '필수 입력사항입니다. 0~10000 사이 숫자를 입력해주세요',
            'protein'           => '필수 입력사항입니다. 0~10000 사이 숫자를 입력해주세요',
            'fat'               => '필수 입력사항입니다. 0~10000 사이 숫자를 입력해주세요',
            'sugar'             => '0~10000 사이 숫자를 입력해주세요',
            'sodium'            => '0~10000 사이 숫자를 입력해주세요',
        ];

        $validator = Validator::make($req->only(
            'foodName'
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
        
        // 유저가 같은 이름으로 등록 불가능
        foreach ($foods as $val) {
            if ($val->food_name === $req->foodName) {
                return back()->withErrors(['foodName' => '이미 등록된 이름입니다.'])
                        ->withInput();
            }
        }
        

        // 음식 정보 테이블 인서트, 영양 정보 값이 없으면 0으로 처리
        DB::table('food_infos')
            ->insert([
                'user_id'       => $id
                ,'food_name'    => $req->foodName
                ,'kcal'         => $req->kcal
                ,'carbs'        => $req->carbs
                ,'protein'      => $req->protein
                ,'fat'          => $req->fat
                ,'sugar'        => $req->sugar ?? 0
                ,'sodium'       => $req->sodium ?? 0
                ,'serving'      => $req->serving
                ,'ser_unit'     => $req->ser_unit
                ,'created_at'   => now()
            ]);

        return Redirect::to(url()->previous());
    }

    public function update(Request $req, $id) {
        // todo 유효성 검사

        // todo 수정 된 정보만 수정

        // 음식 테이블 정보 수정
        DB::table('food_infos')
            ->where('food_id', $id)
            ->update([
                'food_name'     => $req->foodName
                ,'kcal'         => $req->kcal
                ,'carbs'        => $req->carbs
                ,'protein'      => $req->protein
                ,'fat'          => $req->fat
                ,'sugar'        => $req->sugar
                ,'sodium'       => $req->sodium
                ,'serving'      => $req->serving
                ,'ser_unit'     => $req->ser_unit
                ,'updated_at'   => now()
            ]);

        return redirect()->route('food.show', ['food' => $id]);
    }

    public function destroy($id) {
        // todo 유효성 검사

        // 게시글 삭제 처리
        FoodInfo::destroy($id);

        // todo 에러처리, 트랜잭션 처리
        return redirect()->route('food.index');
    }
}
