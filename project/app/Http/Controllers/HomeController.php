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
        // 유저 인증 작업
        if(!Auth::user()) {
            return redirect()->route('user.login');
        }
        $id = Auth::user()->user_id;
        $date = Carbon::now()->format('Y-m-d');

        $kcal = KcalInfo::find($id);

        $diet = DB::select('SELECT * FROM diets WHERE user_id = :id AND d_date = :d_date',['id' => $id,'d_date' => $date]);

        $dietFood = DB::select('SELECT * FROM diet_food df INNER JOIN diets d ON d.d_id = df.d_id WHERE d.user_id = :id AND d.d_date = :d_date',['id' => $id,'d_date' => $date]);

        return view('home')->with("date",$date)->with("diet",$diet)->with("df",$dietFood)->with("kcal",$kcal);
    }

    public function homePost(Request $req)
    {
        $id = Auth::user()->user_id;
        $date = $req->getDate;
        
        $diet = DB::select('SELECT * FROM diets WHERE user_id = :id AND d_date = :d_date',['id' => $id,'d_date' => $date]);

        $dietFood = DB::select('SELECT * FROM diet_food df INNER JOIN diets d ON d.d_id = df.d_id WHERE d.user_id = :id AND d.d_date = :d_date',['id' => $id,'d_date' => $date]);

        $kcal = KcalInfo::find($id);

        return view('home')->with("date",$date)->with("diet",$diet)->with("df",$dietFood)->with("kcal",$kcal);
    }
}
