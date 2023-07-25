<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiReportController extends Controller
{
    public function reportDetail($id, $board) {
        $arr = [
            'errorcode' => '0'
            ,'msg'      => ''
        ];

        if($board == 'a'){
            $report = DB::select('SELECT * FROM report_lists
                                INNER JOIN board_replies
                                on board_replies.reply_id = report_lists.reply_id
                                WHERE report_lists.rep_id = ?', [$id]);
        }else{
            $report = DB::select('SELECT * FROM report_lists
                                INNER JOIN boards 
                                on boards.board_id = report_lists.board_id
                                WHERE report_lists.board_id = ?', [$board]);
        }

        $user = DB::select('SELECT 
                            ff.user_id AS suspect, ff.user_name AS suspectid, 
                            dd.user_id AS reporter, dd.user_name AS reporterid,
                            rp.complate_flg, rp.created_at
                            FROM report_lists AS rp
                            LEFT JOIN user_infos AS ff
                            ON rp.suspect = ff.user_id
                            LEFT JOIN user_infos AS dd
                            ON rp.reporter = dd.user_id
                            WHERE rp.rep_id = ?', [$id]);

        $reportreason = DB::select('SELECT rr.rep_r_content, rr.rep_flg
                                    from report_lists rl
                                    INNER JOIN report_reasons rr
                                    ON rl.rep_id = rr.rep_id
                                    WHERE rl.rep_id = ?', [$id]);

        if(!$report){
            $arr['errcode'] = '1';
            $arr['msg'] = '데이터 없음';
        }else{
            $arr['errcode'] = '0';
            $arr['msg'] = '성공';
            $arr['reportdata'] = $report;
            $arr['userdata'] = $user;
            $arr['reason'] = $reportreason;
        }
        

        return $arr;
    }
}
