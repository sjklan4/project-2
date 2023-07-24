<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\BoardReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class WriteController extends Controller
{
    // 모든 댓글들의 정보와 신고 횟수를 불러오는 부분
    public function commentlist(){
        if(!Auth::user()) {
            return redirect()->route('login.get');
        }

        $comt_list = DB::table('board_replies')->select('reply_id','user_id','board_id','rcontent','created_at','deleted_at')->orderBy('reply_id','desc')->paginate(10);

    return view('commenttem')->with('data', $comt_list);

    }

//댓글 삭제 하기
public function commentdel($id){
    // dump($id);
    // exit;

        BoardReply::destroy($id);


        DB::table('boards')
        ->join('board_replies', 'boards.board_id', '=', 'board_replies.board_id')
        ->where('board_replies.reply_id', $id)
        ->decrement('replies');

        return redirect()->route('comment.commentlist');
    }
    
//체크된 댓글 삭제 하기
public function bulkDelete(Request $req)
{
    // Log::debug('--------- bulkDelete Start ---------');
    // Log::debug('Array delchk', $req->all());
    if($req->has('delchk')) {
        BoardReply::destroy($req->delchk[]);
    }

    Log::debug('--------- bulkDelete End ---------');
    return redirect()->route('comment.commentlist');
}



    public function boardlist(){

        if(!Auth::user()) {
            return redirect()->route('login.get');
        }

        $board_list = DB::table('boards')->select('board_id','user_id','btitle','created_at','deleted_at')->orderBy('board_id','desc')->paginate(10);
        // $board_list = DB::select('SELECT 
        //                             ba.board_id,
        //                             ba.user_id,
        //                             ba.btitle,
        //                             COALESCE(COUNT(re.board_id), 0) AS Count,
        //                             ba.created_at,
        //                             ba.deleted_at
        //                         FROM 
        //                             boards AS ba
        //                         LEFT JOIN 
        //                             report_lists AS re
        //                         ON 
        //                             ba.board_id = re.board_id
        //                         GROUP BY 
        //                             ba.board_id,
        //                             ba.user_id,
        //                             ba.btitle,
        //                             ba.created_at,
        //                             ba.deleted_at');

        return view('boardtem')->with('data', $board_list);
    }

    public function boarddel($id){

        if(!Auth::user()) {
            return redirect()->route('login.get');
        }


        Board::destroy($id);

        return redirect()->route('board.boardlist');
    }

    





    // public function test(){
    //     return view('commenttem');
    // }
}
