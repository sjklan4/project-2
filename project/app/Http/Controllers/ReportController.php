<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    // v002 add 게시글 및 댓글 신고
    public function report(Request $req) {
        $rep_r_id = DB::table('report_reasons')->insertGetId([
            'rep_r_content' => $req->reporttext,
            'rep_flg' => $req->reportselect
        ]);

        $insert = DB::table('report_lists')->insertGetId([
            'reporter' => $req->reporter,
            'suspect' => $req->suspect,
            'board_id' => $req->board_id,
            'reply_id' => $req->reply_id,
            'rep_r_id' => $rep_r_id,
            'complate_flg' => 0,
            'created_at' => now()
        ]);

        // 확실하지 않은 쿼리
        $getSuspectId = DB::table('report_lists')
        ->select('report_lists.suspect', 'user_infos.report_num')
        ->join('user_infos', 'user_infos.user_id', 'report_lists.suspect')
        ->where('rep_id', $insert)
        ->get();

        return redirect()->route('home');
    }
}
