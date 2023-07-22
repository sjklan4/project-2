<?php

namespace App\Http\Controllers;

use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function memberinfo(){
        $memberinfo = UserInfo::all();

        // dump($memberinfo);
        // exit;

        return view('membercon')->with('data',$memberinfo);
    }

    public function memberstop(Request $req){

            UserInfo::where('user_id', $req->id)
            ->update(['user_status' => '3']);

        return redirect()->route('member.memberlist');
    }

    public function memberrestore(Request $req){
        UserInfo::where('user_id',$req->user_id)
            ->restore();
            return redirect()->route('member.memberlist');
    }
}
