<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    // v002 add 게시글 및 댓글 신고
    public function report(Request $req) {
        // 이때까지 한 신고를 모아 볼 수 있는 페이지가 있어야 할 거 같은 느낌...
    
        $rep_r_id = DB::table('report_reasons')->insertGetId([
            'rep_r_content' => $req->reporttext,
            'rep_flg' => $req->reportselect
        ]);

        DB::table('report_lists')->insert([
            'reporter' => $req->reporter,
            'suspect' => $req->suspect,
            'board_id' => $req->board_id,
            'reply_id' => $req->reply_id,
            'rep_r_id' => $rep_r_id,
            'complate_flg' => 0
        ]);

        return redirect()->route('home');
    }
}
