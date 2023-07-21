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
// 섹션명       : 게시글, 댓글 신고 
// 기능         : 게시글, 댓글 상세 내용 관련 라우트 설정
// 관리자       : 채수지
// 생성일       : 2023-07-21
// ---------------------------------------------
use App\Http\Controllers\ApiReportController;
Route::get('/reportdetail/{id}/{board}', [ApiReportController::class, 'reportDetail']);