<?php
/****************************
 * 컨트롤러명   : ReportController
 * 디렉토리     : Contrllers
 * 파일명       : ReportController.php
 * 이력         : v001 0724 채수지 new
*****************************/
namespace App\Http\Controllers;

use App\Models\ReportReason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    // 게시글 및 댓글 신고
    public function report(Request $req) {
        $rep_r_id = DB::table('report_reasons')->insertGetId([
            'rep_id' => 0,
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

        $repseasoninsert = DB::table('report_reasons')
        ->where('rep_r_id', $rep_r_id)
        ->update([
            'rep_id' => $insert
        ]);

        $getSuspectId = DB::table('report_lists')
        ->select('report_lists.suspect', 'user_infos.report_num')
        ->join('user_infos', 'user_infos.user_id', 'report_lists.suspect')
        ->where('rep_id', $insert)
        ->get();

        return redirect()->back();
    }
}
