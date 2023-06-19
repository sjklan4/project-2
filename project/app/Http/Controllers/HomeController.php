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

class HomeController extends Controller
{
    // Route::get('/home', [HomeController::class, 'home'])->name('home');
    // https://www.lesstif.com/laravelprog/query-scope-27295884.html
    public function home()
    {
        // 사용자 인증 작업
        if(!Auth::user()) {
            return redirect()->route('user.login');
        }

        // 유저 pk획득
        $id = Auth::user()->user_id;
        $date = Carbon::now()->format('Y-m-d');

        // 사용자 목표 칼로리
        $kcal = KcalInfo::find($id);

        // 개인 식단 select
        // $diet = DB::select('SELECT * FROM diets WHERE user_id = :id AND d_date = :d_date',['id' => $id,'d_date' => $date]);

        // 식단 음식 select
        // $dietFood = DietFood::join('diets','diet_food.d_id','=','diets.d_id')
        //     ->where('diets.user_id', $id)
        //     ->where('diets.d_date',$date)
        //     ->where('diets.d_flg','0')
        //     ->get();

        $dietBrf = DietFood::DietFood( $id , $date, "0")->get(); // 아침
        $dietLunch = DietFood::DietFood( $id , $date, "1")->get(); // 점심
        $dietDinner = DietFood::DietFood( $id , $date, "2")->get(); // 저녁
        $dietSnack = DietFood::DietFood( $id , $date, "3")->get(); // 간식

        // 식단 음식 계산 select
        // $sum = DB::table('diet_food')->select(DB::raw('sum(df_kcal)'))->join('diets','diet_food.d_id','=','diets.d_id')->where('diets.user_id', $id)->where('diets.d_date',$date)->where('diets.d_flg','0')->where('diet_food.deleted_at', null)->get();

        // 아침 식단 - 칼로리 합계
        $brfKcalSum = $dietBrf->sum('df_kcal');

        // 아침 식단 - 탄수화물 합계
        $brfCarbSum = $dietBrf->sum('df_carbs');

        // 아침 식단 - 단백질 합계
        $brfProteinSum = 0;
        foreach($dietBrf as $val){
            $brfProteinSum += $val->df_protein;
        }
        // 아침 식단 - 지방 합계
        $brfFatSum = 0;
        foreach($dietBrf as $val){
            $brfFatSum += $val->df_fat;
        }

        $arrData = [
            'date'          => $date
            ,'userKcal'     => $kcal
            ,'dietFood'     => [
                    'dietBrf'       => $dietBrf
                    ,'dietLunch'    => $dietLunch
                    ,'dietDinner'   => $dietDinner
                    ,'dietSnack'    => $dietSnack
            ]
            ,'brfSum'   => [
                    'brfKcalSum'        => $brfKcalSum
                    ,'brfCarbSum'       => $brfCarbSum
                    ,'brfProteinSum'    => $brfProteinSum
                    ,'brfFatSum'        => $brfFatSum
            ]
        ];

        return view('home')->with("data",$arrData);
    }

    public function homePost(Request $req)
    {
        // 사용자 인증 작업
        if(!Auth::user()) {
            return redirect()->route('user.login');
        }

        // 유저 pk획득
        $id = Auth::user()->user_id;

        // 날짜
        $date = $req->getDate;

        // 유저 목표 칼로리
        $kcal = KcalInfo::find($id);

        $dietBrf = DietFood::DietFood( $id , $date, "0")->get(); // 아침
        $dietLunch = DietFood::DietFood( $id , $date, "1")->get(); // 점심
        $dietDinner = DietFood::DietFood( $id , $date, "2")->get(); // 저녁
        $dietSnack = DietFood::DietFood( $id , $date, "3")->get(); // 간식

        // 아침 식단 - 칼로리 합계
        $brfKcalSum = 0;
        foreach($dietBrf as $val){
            $brfKcalSum += $val->df_kcal;
        }

        // 아침 식단 - 탄수화물 합계
        $brfCarbSum = $dietBrf->sum('df_carbs');

        // 아침 식단 - 단백질 합계
        $brfProteinSum = 0;
        foreach($dietBrf as $val){
            $brfProteinSum += $val->df_protein;
        }
        // 아침 식단 - 지방 합계
        $brfFatSum = 0;
        foreach($dietBrf as $val){
            $brfFatSum += $val->df_fat;
        }

        $arrData = [
            'date'          => $date
            ,'userKcal'     => $kcal
            ,'dietFood'     => [
                    'dietBrf'       => $dietBrf
                    ,'dietLunch'    => $dietLunch
                    ,'dietDinner'   => $dietDinner
                    ,'dietSnack'    => $dietSnack
            ]
            ,'brfSum'   => [
                    'brfKcalSum'        => $brfKcalSum
                    ,'brfCarbSum'       => $brfCarbSum
                    ,'brfProteinSum'    => $brfProteinSum
                    ,'brfFatSum'        => $brfFatSum
            ]
        ];

        return view('home')->with("data",$arrData);

    }
}
