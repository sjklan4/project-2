<?php
/**********************************************
 * 프로젝트명   : 2nd-project
 * 디렉토리     : Controllers
 * 파일명       : HomeController.php
 * 이력         : v001 0615 BJ.Kwon new
 *                v002 
 **********************************************/
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Route::get('/home/{id}', [HomeController::class, 'home'])->name('home');

    public function home($id)
    {
        return view('home')->with("id",$id);
    }
}
