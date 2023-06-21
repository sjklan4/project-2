<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// ---------------------------------------------
// 섹션명       : 게시판(Board)
// 기능         : 게시판 관련 라우트 설정
// 관리자       : 최아란
// 생성일       : 2023-06-15
// ---------------------------------------------
use App\Http\Controllers\BoardController;
Route::resource('/board', BoardController::class);
Route::get('/board/{board}/like', [BoardController::class, 'like'])->name('board.like');


Route::get('/board/{board}/detail', [BoardController::class, 'showDetail'])->name('board.showDetail');
Route::get('/board/{board}/list', [BoardController::class, 'indexNum'])->name('board.indexNum');
Route::get('/board/{board}/{flg}', [BoardController::class, 'show'])->name('board.shows');
Route::post('/board/reply', [BoardController::class, 'replyPost'])->name('board.replyPost');


// Route::post('/board', [BoardController::class, 'store'])->name('board.store');
// Route::get('/board/create', [BoardController::class, 'create'])->name('board.create');
// Route::get('/board/{board}', [BoardController::class, 'show'])->name('board.show');
// Route::put('/board/{board}', [BoardController::class, 'update'])->name('board.update');
// Route::delete('/board/{board}', [BoardController::class, 'destroy'])->name('board.destroy');
// Route::get('/board/{board}/edit', [BoardController::class, 'edit'])->name('board.edit');

// ---------------------------------------------
// 섹션명       : 퀘스트(Quest)
// 기능         : 퀘스트 관련 라우트 설정
// 관리자       : 최아란
// 생성일       : 2023-06-15
// ---------------------------------------------
use App\Http\Controllers\QuestController;


// ---------------------------------------------
// 섹션명       : 음식(Food)
// 기능         : 사용자 등록 음식 관련 라우트 설정
// 관리자       : 최아란
// 생성일       : 2023-06-15
// ---------------------------------------------
use App\Http\Controllers\FoodController;
Route::get('/food/manage', [FoodController::class,'index'])->name('food.index');
Route::get('/food/manage/{food}', [FoodController::class,'index'])->name('food.show');
Route::get('/food/create', [FoodController::class,'create'])->name('food.create');
Route::post('/food/store', [FoodController::class,'store'])->name('food.store');
Route::put('/food/{food}', [FoodController::class,'update'])->name('food.update');
Route::delete('/food/{food}', [FoodController::class,'destroy'])->name('food.destroy');


// ---------------------------------------------
// 섹션명       : 유저(User)
// 기능         : 로그인, 회원가입 등 라우트 설정
// 관리자       : 박상준
// 생성일       : 2023-06-15
// ---------------------------------------------
use App\Http\Controllers\UserController;
Route::get('/user/login', [UserController::class,'login'])->name('user.login');
Route::post('/user/loginpost', [UserController::class,'loginpost'])->name('user.loginpost');


Route::get('/user/regist',[UserController::class, 'regist'])->name('user.regist');
Route::post('/user/registpost',[UserController::class,'registpost'])->name('user.registpost');
Route::post('/user/chdeckEmail', [UserController::class, 'chdeckEmail'])->name('user.chdeckEmail');
//유저 정보변경 라우트 확인하기 클레스, 함수 구문 이름 상태등

Route::get('/user/userinfoedit',[UserController::class, 'userinfoedit'])->name('user.userinfoedit');
Route::post('/user/userinfoPost',[UserController::class,'userinfoeditPost'])->name('user.userinfoeditPost');


Route::get('/user/userpsedit',[UserController::class, 'userpsedit'])->name('user.userpsedit');
Route::post('/user/userpseditpost',[UserController::class,'userpseditpost'])->name('user.userpseditpost');
Route::get('/users/logout', [UserController::class, 'logout'])->name('user.logout');

Route::get('/user/userKcal',[UserController::class,'userKcalinfo'])->name('user.prevateinfo');
Route::post('/user/userKcaledit',[UserController::class,'userKcaledit'])->name('user.userKcaledit');



//----------------테스트용--------------------------------------
// use App\Http\Controllers\ButtonController;
// Route::post('/button-click', [ButtonController::class, 'handleButtonClick']);
// Route::post('/user/registdup', [UserController::class, 'chdeckEmail'])->name('user.registdup');
//---------------------------------------------------------------------------------------

// ---------------------------------------------
// 섹션명       : 즐겨찾는 식단(Fav)
// 기능         : 즐겨찾는 식단 관련 라우트 설정
// 관리자       : 박상준
// 생성일       : 2023-06-15
// ---------------------------------------------
use App\Http\Controllers\FavController;


// ---------------------------------------------
// 섹션명       : 검색(Search)
// 기능         : 음식 검색, 인서트 등 라우트 설정
// 관리자       : 채수지
// 생성일       : 2023-06-15
// ---------------------------------------------
use App\Http\Controllers\SearchController;
Route::get('/apisearch', [SearchController::class, 'apisearch']);
Route::get('/search/list/{id}', [SearchController::class, 'searchselect'])->name('search.list.get');
Route::post('/search/list/{id}', [SearchController::class, 'searchinsert'])->name('search.insert');

// ---------------------------------------------
// 섹션명       : 홈(Home)
// 기능         : 홈페이지 관련 라우트 설정
// 관리자       : 권봉정
// 생성일       : 2023-06-15
// ---------------------------------------------
use App\Http\Controllers\HomeController;
Route::get('/home', [HomeController::class, 'homepost'])->name('home');
Route::post('/home', [HomeController::class, 'homepost'])->name('home.post');

