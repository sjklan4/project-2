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
use App\Models\FavDiet;
use App\Models\KcalInfo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

// use function PHPUnit\Framework\isNull;

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
        if(Session::has('d_date')){
            $date = Session::get('d_date');
            Session::forget('d_date');
        }
        else if(empty($req->getDate)){
            $date = $today;
        }
        else{
            $date = $req->getDate;
        }

        // 사용자 목표 칼로리
        $kcal = KcalInfo::find($id);

        $dietBrf = Diet::Diet( $id , $date, "0")->get(); // 아침
        $dietLunch = Diet::Diet( $id , $date, "1")->get(); // 점심
        $dietDinner = Diet::Diet( $id , $date, "2")->get(); // 저녁
        $dietSnack = Diet::Diet( $id , $date, "3")->get(); // 간식

        // $test = DietFood::join('diets','diet_food.d_id','=','diets.d_id')
        //     ->join('food_infos','diet_food.food_id','=','food_infos.food_id')
        //     ->where('diets.user_id','=',$id)
        //     ->where('diets.d_date','=', $date)
        //     ->get();

        // 칼로리, 탄수화물, 단백질, 지방 총합 계산
        function MealSums($mealArr) {
            $kcalSum = 0;
            $carbSum = 0;
            $proteinSum = 0;
            $fatSum = 0;
        
            foreach ($mealArr as $val) {
                $kcalSum += ($val->kcal) * ($val->df_intake);
                $carbSum += ($val->carbs) * ($val->df_intake);
                $proteinSum += ($val->protein) * ($val->df_intake);
                $fatSum += ($val->fat) * ($val->df_intake);
            }
        
            return ['kcalSum' => $kcalSum, 'carbSum' => $carbSum, 'proteinSum' => $proteinSum, 'fatSum' => $fatSum];
        }
        $brfSum = MealSums($dietBrf);
        $lunchSum = MealSums($dietLunch);
        $dinnerSum = MealSums($dietDinner);
        $snackSum = MealSums($dietSnack);

        // 하루 전체 
        $kcalTotal = $brfSum['kcalSum'] + $lunchSum['kcalSum'] + $dinnerSum['kcalSum'] + $snackSum['kcalSum'] ;
        $carbTotal = $brfSum['carbSum'] + $lunchSum['carbSum'] + $dinnerSum['carbSum'] +$snackSum['carbSum'] ;
        $proteinTotal = $brfSum['proteinSum'] + $lunchSum['proteinSum'] + $dinnerSum['proteinSum'] + $snackSum['proteinSum'];
        $fatTotal = $brfSum['fatSum'] + $lunchSum['fatSum'] + $dinnerSum['fatSum'] + $snackSum['fatSum'];
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
            ,'brfSum'   => $brfSum
            ,'lunchSum' => $lunchSum
            ,'dinnerSum'=> $dinnerSum
            ,'snackSum' => $snackSum
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

    public function homeupdate(Request $req, $id){

        // 사용자 인증 작업
        if(!Auth::user()) {
            return redirect()->route('user.login');
        }

        $dietfood = DietFood::find($id);
        $dietfood->df_intake = $req->df_intake;
        $dietfood->save();

        // 수정 후 해당 날짜에 해당하는 식단을 출력하기 위해 세션에 날짜를 담음
        Session::put('d_date',$req->d_date);

        Alert::success('수정완료', '');

        return redirect()->route('home.post');
    }

    public function homedelete(Request $req, $id){

        // 사용자 인증 작업
        if(!Auth::user()) {
            return redirect()->route('user.login');
        }

        // 삭제 후 해당 날짜에 해당하는 식단을 출력하기 위해 세션에 날짜를 담음
        Session::put('d_date',$req->date);

        DietFood::destroy($id);

        Alert::success('삭제완료', '');

        return redirect()->route('home.post');
    }

    public function favinsert(Request $req){

        // 사용자 인증 작업
        if(!Auth::user()) {
            return redirect()->route('user.login');
        }

        // 사용자 pk 획득
        $id = Auth::user()->user_id;

        $d_date = $req->input('date');
        $d_flg = $req->input('d_flg');

        // 유효성 검사
        // $rules = [
        //     'date'      => 'required'
        //     ,'d_flg'    => 'required'
        //     ,'fav_name' => 'required|max:10'
        // ];
        // $messages = [
        //     'fav_name.required'     => '10자 까지 입력 가능합니다.'
        // ];

        // $validator = Validator::make($req->only('date','d_flg','fav_name'),$rules, $messages);

        // if($validator->fails()){
            
        //     Alert::error($messages['fav_name.required'],'');

        //     return back()->withErrors($validator)->withInput();
        // }


        $dietFood = DietFood::join('diets','diet_food.d_id','=','diets.d_id')
                ->where('diets.user_id','=',$id)
                ->where('diets.d_date','=',$d_date)
                ->where('diets.d_flg','=',$d_flg)
                ->get();

        // 즐겨찾는 식단 insert 후 즐겨찾는 식단의 pk 획득
        $fav_id = DB::table('fav_diets')->insertGetId([
            'user_id'       => $id
            ,'fav_name'     => $req->input('fav_name')
            ,'created_at'   => now()
            ]
        ,'fav_id'
        );

        $df_arr = [];
        foreach ($dietFood as $val)
        {
            $df_arr[] = [
                'fav_id'        => $fav_id
                ,'food_id'      => $val->food_id
                ,'fav_f_intake' => $val->df_intake
                ,'created_at'   => now()
            ];
        }
        
        DB::table('fav_diet_food')
        ->insert($df_arr);

        return redirect()->route('fav.favdiet');
    }

    public function imgEdit(Request $req, $id){
        
        // 사용자 인증 작업
        if(!Auth::user()) {
            return redirect()->route('user.login');
        }

        $diet = Diet::find($id);

        // 이미지 수정
        if($req->hasFile('dietImg')){
            $img = $req->file('dietImg');
            $fileName = $req->file('dietImg')->getClientOriginalName();


            $img->move(public_path('foodImg'), $fileName);
            // 이미지 경로

            $imagePath = 'foodImg/' . $fileName;

            // 이미지 경로를 image_path칼럼에 insert
            $diet->d_img_path = $imagePath;          
            $diet->save();
        }
        Session::put('d_date',$req->d_date);

        return redirect()->route('home.post');
    }
}
