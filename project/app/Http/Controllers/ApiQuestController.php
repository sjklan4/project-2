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

        // todo 유효성 체크

        $quest = QuestStatus::find($req->stat_id);


        // todo 해당 유저인지 확인
        // $user_id = Auth::user()->user_id;
        // $user_id = 18;

        // if ($user_id !== $quest->user_id) {
        //     $arr['errorcode'] = '1';
        //     $arr['msg'] = '유저 정보 오류';
        //     $arr['errmsg'] = '유저 정보가 일치하지 않습니다.';
        // } else {
            // 완료 플래그 업데이트
            DB::table('quest_logs')
            ->where('quest_log_id', '=', $req->log_id)
            ->update(['complete_flg' => '1']);

            $arr['errorcode'] = '0';
            $arr['msg'] = '오늘 퀘스트 완료!';
        // }

        return $arr;
    }
}
