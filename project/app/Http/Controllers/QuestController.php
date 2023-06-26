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

        // 퀘스트 정보 획득, 현재 진행중인 퀘스트


        return view('questDetail');
    }
}
