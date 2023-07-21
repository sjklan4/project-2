<?php

namespace App\Http\Controllers;

use App\Models\Alarm;
use Illuminate\Http\Request;

class AlarmController extends Controller
{
    public function flgUpdate(Request $req, $alarm_id){
        // todo 유효성

        // 알람 플래그 업데이트
        Alarm::where('alarm_id', $alarm_id)
            ->update(['alarm_flg' => '1']);

        $alarmInfo = Alarm::find($alarm_id);

        if ($alarmInfo->alarm_type === '0') {
            // 퀘스트 관리 페이지로 이동
            return redirect()->route('quest.show');
        } else {
            // 해당 게시글로 이동
            return redirect()->route('board.show', ['board' => $req->board_id]);
        }
    }
}
