<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ---------------------------------------------
// 섹션명       : 게시판(Board)
// 기능         : 게시판 관련 api 라우트 설정
// 관리자       : 최아란
// 생성일       : 2023-06-27
// ---------------------------------------------
use App\Http\Controllers\ApiBoardController;

Route::put('/board/likeup', [ApiBoardController::class, 'likeUp']);
Route::put('/board/likedown', [ApiBoardController::class, 'likeDown']);

// ---------------------------------------------
// 섹션명       : 음식(Food)
// 기능         : 사용자 등록 음식 관련 api 라우트 설정
// 관리자       : 최아란
// 생성일       : 2023-06-19
// ---------------------------------------------
use App\Http\Controllers\ApiFoodController;

Route::get('/foods/{id}', [ApiFoodController::class, 'getFoodList']);

// ---------------------------------------------
// 섹션명       : 퀘스트(Quest)
// 기능         : 퀘스 관련 api 라우트 설정
// 관리자       : 최아란
// 생성일       : 2023-06-26
// ---------------------------------------------
use App\Http\Controllers\ApiQuestController;

Route::put('/quest', [ApiQuestController::class, 'questFlgUpdate'])->name('apiQuest.update');

// ---------------------------------------------
// 섹션명       : 회원(User)
// 기능         : 회원 관리 api 라우트 설정
// 관리자       : 박상준
// 생성일       : 2023-06-19
// ---------------------------------------------

use App\Http\Controllers\ApiUserController;

Route::get('/user/useremailedt/{user_email}',[ApiUserController::class, 'chdeckEmail']);
Route::post('/user/userpsedt', [ApiUserController::class, 'chdeckpassword']);

// ---------------------------------------------
// 섹션명       : 카트(Cart)
// 기능         : 사용자 체크 음식 관련 api 라우트 설정
// 관리자       : 채수지
// 생성일       : 2023-06-22
// ---------------------------------------------
Route::get('/apisearch', [ApiController::class, 'apisearch']);
Route::post('/cart/{user_id}/{food_id}/{amount}', [ApiController::class, 'postFoodCart']);
Route::post('/cart2/{user_id}/{fav_id}', [ApiController::class, 'postFoodCart2']);