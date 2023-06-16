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
Route::post('/user/registdup',[UserController::class, 'registdup'])->name('user.registdup');
Route::post('/user/registpost',[UserController::class,'registpost'])->name('user.registpost');
Route::get('/users/logout', [UserController::class, 'logout'])->name('user.logout');


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
Route::get('/foods/select', [SearchController::class, 'foodsselect'])->name('foods.select');
Route::post('/foods/search', [SearchController::class, 'foodssearch'])->name('foods.search');

// ---------------------------------------------
// 섹션명       : 홈(Home)
// 기능         : 홈페이지 관련 라우트 설정
// 관리자       : 권봉정
// 생성일       : 2023-06-15
// ---------------------------------------------
use App\Http\Controllers\HomeController;
Route::get('/home/{id}', [HomeController::class, 'home'])->name('home');
Route::post('/home', [HomeController::class, 'homepost'])->name('home.post');

