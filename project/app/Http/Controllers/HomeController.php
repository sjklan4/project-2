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

class HomeController extends Controller
{
    // Route::get('/home/{id}', [HomeController::class, 'home'])->name('home');

    public function home(Request $req, $id)
    {
        // if(auth()->guest()) {
        //     return redirect()->route('user.login');
        // }

        $data = UserInfo::find($id);
        $today = Carbon::now()->format('Y-m-d');
        if(empty($req)){
            
        }

        $arrrData = [];

        // return view('home')->with("id",$id);
        // var_dump($data);
        // exit; //test

        // return response()->json($data, 200); //test
        return view('home')->with("data",$data)->with("today",$today);
    }

    // public function homePost(Request $req)
    // {
    //     return var_dump($req);
    // }
}
