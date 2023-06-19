<?php

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
// 섹션명       : 음식(Food)
// 기능         : 사용자 등록 음식 관련 api 라우트 설정
// 관리자       : 최아란
// 생성일       : 2023-06-19
// ---------------------------------------------
use App\Http\Controllers\ApiFoodController;

Route::get('/foods/{id}', [ApiFoodController::class, 'getFoodList']);

// ---------------------------------------------
// 섹션명       : 회원(User)
// 기능         : 회원 관리 api 라우트 설정
// 관리자       : 박상준
// 생성일       : 2023-06-19
// ---------------------------------------------

use App\Http\Controllers\ApiUserController;

Route::get('/user/{user_email}',[ApiUserController::class, 'chdeckEmail']);