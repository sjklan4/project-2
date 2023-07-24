<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\BoardReply;
use App\Models\ReportList;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ReportController extends Controller
{  
    public function returnview() {

        // 로그인 확인
        if(auth()->guest()) {
            return redirect()->route('user.login');
        }

        // 신고 리스트 id / 게시물 id, 댓글 id / 신고인 user_id, name, 피신고인 user_id, name 및 피신고인의 신고받은 횟수 정보 / 신고사유 / 신고일, 신고 현황
        $reportinfo = DB::table('report_lists as rp')
        ->select('rp.rep_id', 'rp.board_id', 'rp.reply_id', 'rp.reporter', 'rp.suspect', 'ui2.report_num', 'rr.rep_flg', 'rr.rep_r_content', 'rp.complate_flg', 'rp.created_at')
        ->leftJoin('user_infos as ui1', 'rp.reporter', '=', 'ui1.user_id')
        ->leftJoin('user_infos as ui2', 'rp.suspect', '=', 'ui2.user_id')
        ->join('report_reasons as rr', 'rr.rep_r_id', '=', 'rp.rep_r_id')
        ->orderBy('rp.complate_flg')
        ->paginate(10);

        return view('report')
        ->with('report_info', $reportinfo);
    }

    // ! --------------------------------------------------------------------------
    // 신고 상세내용에서 확인 및 철회 버튼 클릭 시 complate_flg 변경 처리
    public function confirmOreport(Request $req) {
        
        $reportID = (int)$req->reportId;
        $userId = (int)$req->userId;
        $complate = $req->complate;
        $boardId = (int)$req->boartId;
        $replyId = (int)$req->replyId;

        if($complate == 1){ // 신고 확인 버튼을 눌렀을 경우
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
            if($replyId != null){
                BoardReply::destroy($replyId);
            }else{
                Board::destroy($boardId);
            }
        }else{ // 신고 철회 버튼을 눌렀을 경우
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

            // 신고받은 회원의 게시물, 댓글 삭제 철회
            // * restore() : destroy() 으로 설정한 deleted_at 되돌리기
            if($replyId != null){
                BoardReply::where('reply_id', $replyId)
                ->restore();
            }else{
                Board::where('board_id', $boardId)
                ->restore();
            }
        }

        // 신고받은 횟수가 5회 이상일 경우 유저 정지처리(user_status = 3)
        $getusernum = UserInfo::find($userId); // 신고받은 유저 정보 획득
        if($getusernum->report_num <= 5){ // 신고받은 횟수가 5회 또는 5회 이상일 경우 정지 처리
            UserInfo::where('user_id', $getusernum->user_id)
            ->update([
                'user_status' => '3'
            ]);
        }

        return redirect()->route('report.get');
    }
}
