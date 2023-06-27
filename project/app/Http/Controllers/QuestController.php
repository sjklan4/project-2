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

        // todo 이미 수락된 퀘스트가 있는지 확인
        $questLog = QuestStatus::where('complete_flg','=', '0')
            ->where('user_id','=', Auth::user()->user_id)
            ->count();
        
        if($questLog < 1) {
            return view('questList')->with('data', $result)->with('flg', 1);
        }

        return view('questList')->with('data', $result);
    }

    public function store(Request $req) {
        // 로그인 확인
        if(auth()->guest()) {
            return redirect()->route('user.login');
        }

        // 퀘스트 로그 정보 생성
        $quest = QuestCate::find($req->id);
        $quest_period = $quest->min_period;

        // todo 트랜잭션

        $quest_status_id = QuestStatus::insertGetId([
            'user_id'           => Auth::user()->user_id,
            'quest_cate_id'     => $req->id,
            'created_at'        => now()
        ]);

        for ($i=0; $i < $quest_period; $i++) { 
            $questLog = new QuestLog([
                'quest_status_id'   => $quest_status_id,
                'effective_date'    => Carbon::now()->addDays($i)->format("Y-m-d"),
            ]);
            $questLog->save();
        }
        
        // 퀘스트 관리 페이지 리턴
        return redirect()->route('quest.show');
    }

    public function show() {
        if(auth()->guest()) {
            return redirect()->route('user.login');
        }

        
        // todo 어제 꺼 했는지 확인, 안했으면 퀘스트 실패 띄워야 함
        
        // 퀘스트 정보 획득, 현재 진행중인 퀘스트
        $quest_status = QuestStatus::where('complete_flg','=', '0')
        ->where('user_id','=', Auth::user()->user_id)
        ->first();
        
        // 진행중인 퀘스트가 없을 때 없다고 안내
        if (!isset($quest_status)) {
            return view('questDetail');
        }

        // 진행중인 퀘스트 정보
        $quest_info = QuestCate::find($quest_status->quest_cate_id);

            
        // 전체 로그 정보
        $questLog = DB::table('quest_logs')
            ->where('quest_status_id', $quest_status->quest_status_id)
            ->get();

        // 당일 로그 정보
        $todayLog = DB::table('quest_logs')
            ->where('quest_status_id', $quest_status->quest_status_id)
            ->where('effective_date', Carbon::now()->format("Y-m-d"))
            ->first();

            
        return view('questDetail')->with('info', $quest_info)->with('logs', $questLog)
        ->with('todayLog', $todayLog)->with('questStat', $quest_status);

    }
}
