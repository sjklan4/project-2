<?php
/**********************************************
 * 프로젝트명   : 2nd-project
 * 디렉토리     : Controllers
 * 파일명       : HomeController.php
 * 이력         : v001 0615 BJ.Kwon new
 *                v002 
 **********************************************/
namespace App\Http\Controllers;

use App\Models\UserInfo;
use App\Models\Diet;
use App\Models\DietFood;
use App\Models\KcalInfo;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class HomeController extends Controller
{
    public function homepost(Request $req)
    {
        // 사용자 인증 작업
        if(!Auth::user()) {
            return redirect()->route('user.login');
        }

        // 유저 pk획득
        $id = Auth::user()->user_id;

        // 날짜 획득
        $today = Carbon::now()->format('Y-m-d');
        if(empty($req->getDate)){
            $date = $today;
        }
        else{
            $date = $req->getDate;
        }

        // 사용자 목표 칼로리
        $kcal = KcalInfo::find($id);

        // 개인 식단 (사진)
        // $diet = DB::select('SELECT * FROM diets WHERE user_id = :id AND d_date = :d_date',['id' => $id,'d_date' => $date]);

        // 식단 음식
        // $dietFood = DietFood::join('diets','diet_food.d_id','=','diets.d_id')
        //     ->where('diets.user_id', $id)
        //     ->where('diets.d_date',$date)
        //     ->get();

        $dietBrf = Diet::Diet( $id , $date, "0")->get(); // 아침
        $dietLunch = Diet::Diet( $id , $date, "1")->get(); // 점심
        $dietDinner = Diet::Diet( $id , $date, "2")->get(); // 저녁
        $dietSnack = Diet::Diet( $id , $date, "3")->get(); // 간식

        // 아침 칼로리, 탄수화물, 단백질, 지방 계산
        $brfKcalSum = 0;
        $brfCarbSum = 0;
        $brfProteinSum = 0;
        $brfFatSum = 0;
        foreach ($dietBrf as $val) {
            $brfKcalSum += (($val->kcal)*($val->df_intake));
            $brfCarbSum += (($val->carbs)*($val->df_intake));
            $brfProteinSum += (($val->protein)*($val->df_intake));
            $brfFatSum += (($val->fat)*($val->df_intake));
        }

        // 점심 칼로리, 탄수화물, 단백질, 지방 계산
        $lunchKcalSum = 0;
        $lunchCarbSum = 0;
        $lunchProteinSum = 0;
        $lunchFatSum = 0;
        foreach ($dietLunch as $val) {
            $lunchKcalSum += (($val->kcal)*($val->df_intake));
            $lunchCarbSum += (($val->carbs)*($val->df_intake));
            $lunchProteinSum += (($val->protein)*($val->df_intake));
            $lunchFatSum += (($val->fat)*($val->df_intake));
        }

        // 저녁 칼로리, 탄수화물, 단백질, 지방 계산
        $dinnerKcalSum = 0;
        $dinnerCarbSum = 0;
        $dinnerProteinSum = 0;
        $dinnerFatSum = 0;
        foreach ($dietDinner as $val) {
            $dinnerKcalSum += (($val->kcal)*($val->df_intake));
            $dinnerCarbSum += (($val->carbs)*($val->df_intake));
            $dinnerProteinSum += (($val->protein)*($val->df_intake));
            $dinnerFatSum += (($val->fat)*($val->df_intake));
        }

        // 간식 칼로리, 탄수화물, 단백질, 지방 계산
        $snackKcalSum = 0;
        $snackCarbSum = 0;
        $snackProteinSum = 0;
        $snackFatSum = 0;
        foreach ($dietSnack as $val) {
            $snackKcalSum += (($val->kcal)*($val->df_intake));
            $snackCarbSum += (($val->carbs)*($val->df_intake));
            $snackProteinSum += (($val->protein)*($val->df_intake));
            $snackFatSum += (($val->fat)*($val->df_intake));
        }

        // 하루 전체
        $kcalTotal = $brfKcalSum + $lunchKcalSum + $dinnerKcalSum + $snackKcalSum ;
        $carbTotal = $brfCarbSum + $lunchCarbSum + $dinnerCarbSum + $snackCarbSum ;
        $proteinTotal = $brfProteinSum + $lunchProteinSum + $dinnerProteinSum + $snackProteinSum;
        $fatTotal = $brfFatSum + $lunchFatSum + $dinnerFatSum + $snackFatSum;
        $tdgTotal = $carbTotal + $proteinTotal + $fatTotal ;

        $arrData = [
            'date'          => $date
            ,'today'        => $today
            ,'userKcal'     => $kcal
            ,'dietFood'     => [
                    'dietBrf'       => $dietBrf
                    ,'dietLunch'    => $dietLunch
                    ,'dietDinner'   => $dietDinner
                    ,'dietSnack'    => $dietSnack
            ]
            ,'brfSum'   => [
                    'brfKcalSum'    => $brfKcalSum
                    ,'brfCarbSum'   => $brfCarbSum
                    ,'brfProteinSum'=> $brfProteinSum
                    ,'brfFatSum'    => $brfFatSum
            ]
            ,'lunchSum'   => [
                'lunchKcalSum'    => $lunchKcalSum
                ,'lunchCarbSum'   => $lunchCarbSum
                ,'lunchProteinSum'=> $lunchProteinSum
                ,'lunchFatSum'    => $lunchFatSum
            ]
            ,'dinnerSum'   => [
                'dinnerKcalSum'    => $dinnerKcalSum
                ,'dinnerCarbSum'   => $dinnerCarbSum
                ,'dinnerProteinSum'=> $dinnerProteinSum
                ,'dinnerFatSum'    => $dinnerFatSum
            ]
            ,'snackSum'   => [
                'snackKcalSum'    => $snackKcalSum
                ,'snackCarbSum'   => $snackCarbSum
                ,'snackProteinSum'=> $snackProteinSum
                ,'snackFatSum'    => $snackFatSum
            ]
            ,'total'   => [
                'kcalTotal'     => $kcalTotal
                ,'carbTotal'    => $carbTotal
                ,'proteinTotal' => $proteinTotal
                ,'fatTotal'     => $fatTotal
                ,'tdgTotal'     => $tdgTotal
            ]          
        ];

        return view('home')->with("data",$arrData);
    }

}
