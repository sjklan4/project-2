<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\BoardReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WriteController extends Controller
{
    // 모든 댓글들의 정보와 신고 횟수를 불러오는 부분
    public function commentlist(){
        $comt_list = DB::select('SELECT 
                                board_replies.reply_id,
                                board_replies.user_id,
                                board_replies.board_id,
                                board_replies.rcontent,
                                board_replies.created_at,
                                COALESCE(COUNT(re.reply_id), 0) AS count,
                                board_replies.deleted_at
                            FROM 
                                board_replies
                            LEFT JOIN 
                                report_lists AS re
                            ON 
                                board_replies.reply_id = re.reply_id
                            GROUP BY 
                                board_replies.reply_id, 
                                board_replies.user_id,
                                board_replies.board_id,
                                board_replies.rcontent,
                                board_replies.created_at,
                                board_replies.deleted_at');
    // dump($comt_list);
    // exit;

    return view('commenttem')->with('data', $comt_list);

    }

    public function commentdel($id){

        BoardReply::destroy($id);

        return redirect()->route('comment.commentlist');
    }


    public function boardlist(){
        $board_list = DB::select('SELECT 
                                    ba.board_id,
                                    ba.user_id,
                                    ba.btitle,
                                    COALESCE(COUNT(re.board_id), 0) AS Count,
                                    ba.created_at,
                                    ba.deleted_at
                                FROM 
                                    boards AS ba
                                LEFT JOIN 
                                    report_lists AS re
                                ON 
                                    ba.board_id = re.board_id
                                GROUP BY 
                                    ba.board_id,
                                    ba.user_id,
                                    ba.btitle,
                                    ba.created_at,
                                    ba.deleted_at');

        return view('boardtem')->with('data', $board_list);
    }

    public function boarddel($id){

        Board::destroy($id);

        return redirect()->route('board.boardlist');
    }

    





    // public function test(){
    //     return view('commenttem');
    // }
}
