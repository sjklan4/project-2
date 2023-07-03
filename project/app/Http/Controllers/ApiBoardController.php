<?php

/*****************************************************
 * 프로젝트명   : project-2
 * 디렉토리     : Controllers
 * 파일명       : ApiBoardController.php
 * 이력         : v001 0526 AR.Choe new
 *****************************************************/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Models\Board;

class ApiBoardController extends Controller
{
    public function likeUp(Request $req) {
        $arr = [
            'errorcode' => '0'
            ,'msg'      => ''
        ];

        // 해당 유저의 해당 글 좋아요 확인
        $like_count = DB::table('board_likes')
            ->where('user_id', $req->id1)
            ->where('board_id', $req->id2)
            ->first();
        
        $like_flg = 0;  // 좋아요가 없을 때
        if (isset($like_count)) { 
            $like_flg = 1;  // 좋아요가 있을 때
        }

        if ($like_flg === 0) {
            DB::transaction(function () use ($req) {
                // 좋아요 테이블 인서트
                DB::table('board_likes')->insert([
                    'board_id'    => $req->id2
                    ,'user_id'    => $req->id1
                ]);
    
                // 게시판 테이블 좋아요 수 증가
                $board = Board::find($req->id2);
                DB::table('boards')
                ->where('board_id', '=', $req->id2)
                ->update(['likes' => $board->likes + 1]);
            });
            
            $arr['errorcode'] = '0';
            $arr['msg'] = '좋아요 증가';
        } else {
            DB::transaction(function () use ($req) {
                // 좋아요 테이블 정보 삭제
                DB::table('board_likes')
                    ->where('user_id', $req->id1)
                    ->where('board_id', $req->id2)
                    ->delete();
    
                // 게시판 테이블 좋아요 수 감소
                $board = Board::find($req->id2);
                DB::table('boards')
                ->where('board_id', '=', $req->id2)
                ->decrement('likes');
            });

            $arr['errorcode'] = '1';
            $arr['msg'] = '좋아요 감소';
        }

        $board = Board::find($req->id2);
        $arr['data']['likes'] = $board->likes; 

        return $arr;
    }

    public function likeDown(Request $req) {
        $arr = [
            'errorcode' => '0'
            ,'msg'      => ''
        ];

        DB::transaction(function () use ($req) {
            // 좋아요 테이블 정보 삭제
            DB::table('board_likes')
                ->where('user_id', $req->id1)
                ->where('board_id', $req->id2)
                ->delete();

            // 게시판 테이블 좋아요 수 감소
            $board = Board::find($req->id2);
            DB::table('boards')
            ->where('board_id', '=', $req->id2)
            ->decrement('likes');
        });

        $board = Board::find($req->id2);

        $arr['errorcode'] = '0';
        $arr['msg'] = '좋아요 감소';
        $arr['data']['likes'] = $board->likes; 

        return $arr;
    }
}
