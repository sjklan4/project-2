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
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // Route::get('/home/{id}', [HomeController::class, 'home'])->name('home');

    public function home()
    {
        if(auth()->guest()) {
            return redirect()->route('user.login');
        }

        // $data = UserInfo::find($id);
        $today = Carbon::now()->format('Y-m-d');

        $id = Auth::user()->user_name;
        // var_dump($id);
        // exit; //test

        // return response()->json($data, 200); //test

        return view('home')->with("today",$today);
        // return view('home')->with("data",$data)->with("today",$today); // 찐
    }

    public function homePost(Request $req)
    {
        // $data = UserInfo::find($id);
        $id = Auth::user()->user_id;

        $date = $req->getDate;
        var_dump($id);
        // return var_dump($req->getDate);

        // return view('home');
    }
}
