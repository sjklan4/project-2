<?php

namespace App\Http\Controllers;

use App\Models\KcalInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecommendController extends Controller
{
    public function rview() {
        $id = Auth::user()->user_id;
        $userinfo = KcalInfo::select('goal_kcal')
        ->where('user_id', $id)
        ->get();
        $userkcal = $userinfo[0]['goal_kcal'];
        // exit;
        return view('recommend')->with('userkcal', $userkcal);
    }

    public function recommned(Request $req) {
        // 유저 id 획득
        $id = Auth::user()->user_id;

        $result = KcalInfo::select('goal_kcal', 'user_activity')
        ->where('user_id', $id)
        ->get();

        // 유지칼로리 계산
        if($result[0]['goal_kcal'] != null){ // 목표 칼로리 데이터가 설정되어 있는 경우
            if($result[0]['user_activity'] == 0){
                $tdee = $result[0]['goal_kcal'] * 1.375;
            }else if($result[0]['user_activity'] == 1){
                $tdee = $result[0]['goal_kcal'] * 1.55;
            }else{
                $tdee = $result[0]['goal_kcal'] * 1.725;
            };
            echo 'tdee : '.$tdee;
        }else{ // 목표 칼로리 데이터가 설정되어 있지 않은 경우
            // 기초 대사량 계산식
            if($req->gender == 0){ // 남자
                $bmr = round(
                    66 
                    + (13.7 * (int)$req->weight) 
                    + (5 * (int)$req->height) 
                    - (6.8 * $req->age)
                );
            }else{ // 여자
                $bmr = round(
                    655 
                    + (9.6 * (int)$req->weight) 
                    + (1.7 * (int)$req->height) 
                    - (4.7 * $req->age)
                );
            }
            
            // 유저가 선택한 활동량에 따라 계산 > 활동 대사량 계산
            if($req->activity == 0){ // 활동량 적음
                $tdee = round($bmr * 1.375);
            }else if($req->activity == 1){ // 활동량 보통
                $tdee = round($bmr * 1.55);
            }else{ // 활동량 많음
                $tdee = round($bmr * 1.725);
            }
        }
        
        // 식단 유형에 따라 계산 
        if($req->dietcate == 0){ // 감량 3:5:2
            $kcal = $tdee * 0.3;
            $protein = $tdee * 0.5;
            $fat = $tdee * 0.2;
            $totalkcal = round($kcal / 4);
            $totalprotein = round($protein / 4);
            $totalfat = round($fat / 9);
            
            echo $totalkcal.', '.$totalprotein.', '.$totalfat;
            exit;
        }else if($req->dietcate == 1){ // 증량 6:3:1
            $kcal = $tdee * 0.6;
            $protein = $tdee * 0.3;
            $fat = $tdee * 0.1;
            $totalkcal = round($kcal / 4);
            $totalprotein = round($protein / 4);
            $totalfat = round($fat / 9);

            echo $tdee.'<br>';
            echo $totalkcal.', '.$totalprotein.', '.$totalfat;
            exit;
        }else{ // 일반(건강) 5:3:2
            $kcal = $tdee * 0.5;
            $protein = $tdee * 0.3;
            $fat = $tdee * 0.2;
            $totalkcal = round($kcal / 4);
            $totalprotein = round($protein / 4);
            $totalfat = round($fat / 9);

            echo $totalkcal.', '.$totalprotein.', '.$totalfat;
            exit;
        }

        // ! 탄수 1g : 4kcal | 단백질 1g : 4kcal | 지방 : 1g : 9kcal
        // ! 감량 비율 3:5:2 | 증량 비율 6:3:1 | 일반 5:3:2


        // return view('recommend');
    }
}
