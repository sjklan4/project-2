<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\BoardReply;
use App\Models\ReportList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ReportController extends Controller
{  
    public function returnview() {

        // 신고인 user_id, name, 피신고인 user_id, name 및 피신고인의 신고받은 횟수 정보 / 신고사유 / 신고일, 신고 현황
        $reportinfo = DB::select('SELECT 
        rp.rep_id, rp.board_id, rp.reply_id, rp.reporter, rp.suspect, ui2.report_num, rr.rep_flg, rr.rep_r_content, rp.complate_flg, rp.created_at
        FROM report_lists rp
        LEFT JOIN user_infos ui1
        ON rp.reporter = ui1.user_id
        LEFT JOIN user_infos ui2
        ON rp.suspect = ui2.user_id
        INNER JOIN report_reasons rr
        ON rr.rep_r_id = rp.rep_r_id
        order by complate_flg');

        return view('report')
        ->with('report_info', $reportinfo);
    }

    // 신고 상세내용에서 확인 및 철회 버튼 클릭 시 complate_flg 변경 처리
    public function confirmOreport(Request $req) {
        
        $reportID = (int)$req->reportId;
        $userId = (int)$req->userId;
        $complate = $req->complate;
        $boardId = $req->boartId;
        $replyId = $req->replyId;

        if($complate == 1){
            DB::table('report_lists')
            ->where('rep_id', $reportID)
            ->update([
                'complate_flg' => $complate
            ]);

            ReportList::destroy($reportID);

            DB::table('user_infos')
            ->where('user_id', $userId)
            ->increment('report_num');

            // 신고받은 회원의 게시물, 댓글 삭제
            if($req->reply_id != null){
                BoardReply::destroy($replyId);
                // DB::table('board_replies')
                // ->where('reply_id', $replyId)
                // ->update([
                //     'updated_at' => now(),
                //     'deleted_at' => now()
                // ]);
            }else{
                Board::destroy($boardId);
                // DB::table('boards')
                // ->where('board_id', $boardId)
                // ->update([
                //     'updated_at' => now(),
                //     'deleted_at' => now()
                // ]);
            }
        }else{ // 신고 철회
            // 완료 플래그 변경 (1->0)
            DB::table('report_lists')
            ->where('rep_id', $reportID)
            ->update([
                'complate_flg' => $complate
            ]);

            ReportList::where('rep_id', $reportID)
            ->restore();

            DB::table('user_infos')
            ->where('user_id', $userId)
            ->decrement('report_num');

            // 신고받은 회원의 게시물, 댓글 삭제
            if($req->reply_id != null){
                BoardReply::where('reply_id', $replyId)
                ->restore();
            }else{
                Board::where('board_id', $boardId)
                ->restore();
            }
        }

        return redirect()->route('report.get');
    }
}
