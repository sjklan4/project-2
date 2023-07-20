<?php

/*****************************************************
 * 프로젝트명   : project-2
 * 디렉토리     : Controllers
 * 파일명       : QuestController.php
 * 이력         : v001 0526 AR.Choe new
 *****************************************************/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\QuestCate;
use App\Models\QuestLog;
use App\Models\QuestStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuestController extends Controller
{
    public function index()
    {
        // 로그인 확인
        if(auth()->guest()) {
            return redirect()->route('user.login');
        }

        // 퀘스트 정보 획득
        $result = QuestCate::get();

        // 이미 수락된 퀘스트가 있는지 확인
        $questLog = QuestStatus::where('user_id','=', Auth::user()->user_id)
            ->first();

        if(!isset($questLog)) {
            return view('questList')->with('data', $result)->with('flg', 1);
        }

        return view('questList')->with('data', $result);
    }

    public function store(Request $req) {
        // 로그인 확인
        if(auth()->guest()) {
            return redirect()->route('user.login');
        }

        DB::transaction(function () use ($req) {
            // 퀘스트 로그 정보 획득
            $quest = QuestCate::find($req->id);
            $quest_period = $quest->min_period;

            // 퀘스트 스탯 테이블 인서트
            $quest_status_id = QuestStatus::insertGetId([
                'user_id'           => Auth::user()->user_id,
                'quest_cate_id'     => $req->id,
                'created_at'        => now()
            ]);
            
            // 퀘스트 로그 테이블 인서트
            for ($i=0; $i < $quest_period; $i++) { 
                $questLog = new QuestLog([
                    'quest_status_id'   => $quest_status_id,
                    'effective_date'    => Carbon::now()->addDays($i)->format("Y-m-d"),
                ]);
                $questLog->save();
            }
        });
        
        
        // 퀘스트 관리 페이지 리턴
        return redirect()->route('quest.show');
    }

    public function show() {
        if(auth()->guest()) {
            return redirect()->route('user.login');
        }

        $flg = 0;
        
        // 진행 혹은 성공한 퀘스트 정보 획득
        $quest_status = QuestStatus::where('user_id', Auth::user()->user_id)
            ->first();
        
        // 진행중인 퀘스트가 없을 때
        if (!isset($quest_status)) {
            // 플래그 변경
            $flg = 1;
            return view('questDetail')->with('flg', $flg);
        }

        // 성공했을 때
        if ($quest_status->complete_flg === 1) {
            // 플래그 변경
            $flg = 3;
            return view('questDetail')->with('id', $quest_status->quest_status_id)->with('flg', $flg);
        }

        // 전체 로그 정보 획득
        $questLog = DB::table('quest_logs')
            ->where('quest_status_id', $quest_status->quest_status_id)
            ->get();

        // todo 로그 마지막 날 이후 접속 시 실패

        
        // 첫날 제외 어제 수행 여부 확인, 안되어있으면 실패
        if ($questLog[0]->effective_date !== Carbon::now()->format("Y-m-d")) {
            // $count = 0;
            // foreach ($questLog as $val) {
            //     if ($val->effective_date <= Carbon::now()->subDays(1)->format("Y-m-d")) {
            //         if ($val->complete_flg === 0) {
            //             ++$count;
            //         }
            //     }
            // }

            // if ($count > 0) {
            //     // 플래그 변경
            //     $flg = 2;
    
            //     // 퀘스트 실패 처리
            //     QuestStatus::destroy($yesterdayLog->quest_status_id);
            // }

            $yesterdayLog = DB::table('quest_logs')
                ->where('quest_status_id', $quest_status->quest_status_id)
                ->where('effective_date', Carbon::now()->subDays(1)->format("Y-m-d"))
                ->first();

            if ($yesterdayLog->complete_flg === '0') {
                // 플래그 변경
                $flg = 2;

                // 퀘스트 실패 처리
                QuestStatus::destroy($yesterdayLog->quest_status_id);
            }
        }

        // 진행중인 퀘스트 정보 획득
        $questInfo = QuestCate::find($quest_status->quest_cate_id);

        // 진행도 계산
        $period = $questInfo->min_period;
        $nowComplete = 0;
        foreach ($questLog as $val) {
            if ($val->complete_flg === '1') {
                ++$nowComplete;
            }
        }
        $ratio = round($nowComplete / $period * 100, 1);

        $arrRatio = [
            'period'    => $period,
            'complete'  => $nowComplete,
            'ratio'     => $ratio,
        ];

        return view('questDetail')
            ->with('info', $questInfo)
            ->with('logs', $questLog)
            ->with('ratio', $arrRatio)
            ->with('questStat', $quest_status)
            ->with('flg', $flg);
    }

    public function update(Request $req, $id) {
        // todo 유효성, 트랜잭션

        DB::table('quest_logs')
            ->where('quest_log_id', $id)
            ->update([
                'complete_flg' => '1',
                'updated_at' => Carbon::now(),
            ]);

        $logs = DB::table('quest_logs')
            ->where('quest_status_id', $req->statId)
            ->latest('quest_log_id')
            ->first();
        
        $lastLogDate = $logs->effective_date;

        // 오늘이 마지막 날인지 확인
        if ($lastLogDate === Carbon::now()->format("Y-m-d")) {
            $questStat = QuestStatus::find($req->statId);
            // 퀘스트 성공 처리
            $questStat->complete_flg = '1';
            $questStat->save();
        }

        return redirect()->route('quest.show');
    }
    

    public function destroy($id) {
        QuestStatus::destroy($id);

        return redirect()->route('quest.show');
    }
}