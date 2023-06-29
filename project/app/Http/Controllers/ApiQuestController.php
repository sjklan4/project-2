<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuestCate;
use App\Models\QuestLog;
use App\Models\QuestStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApiQuestController extends Controller
{
    public function questFlgUpdate(Request $req) {
        $arr = [
            'errorcode' => '0'
            ,'msg'      => ''
        ];


        $quest = QuestStatus::find($req->stat_id);

        // 완료 플래그 업데이트
        DB::table('quest_logs')
        ->where('quest_log_id', '=', $req->log_id)
        ->update(['complete_flg' => '1']);

        $arr['errorcode'] = '0';
        $arr['msg'] = '오늘 퀘스트 완료!';

        return $arr;
    }
}
