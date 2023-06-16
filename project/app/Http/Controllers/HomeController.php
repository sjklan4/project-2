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
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // Route::get('/home/{id}', [HomeController::class, 'home'])->name('home');

    public function home()
    {
        if(!Auth::user()) {
            return redirect()->route('user.login');
        }

        // $data = UserInfo::find($id);
        $date = Carbon::now()->format('Y-m-d');

        $id = Auth::user()->user_id;
        $result = DB::select('SELECT * FROM diets WHERE user_id = :id AND d_date = :d_date',['id' => $id,'d_date' => $date]);

        // var_dump($id);
        // exit; //test

        // return response()->json($data, 200); //test

        return view('home')->with("date",$date)->with("result",$result);
        // return view('home')->with("data",$data)->with("today",$today); // 찐
    }

    public function homePost(Request $req)
    {
        // $data = UserInfo::find($id);
        $id = Auth::user()->user_id;
        $date = $req->getDate;

        $result = DB::select('SELECT * FROM diets WHERE user_id = :id AND d_date = :d_date',['id' => $id,'d_date' => $date]);


        // var_dump($result);exit;
        // return var_dump($req->getDate);

        return view('home')->with("result",$result)->with("date",$date);
        // return redirect()->back()->withInput(['date', $date ]);
    }
}
