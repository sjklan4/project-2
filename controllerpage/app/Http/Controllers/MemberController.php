<?php

namespace App\Http\Controllers;

use App\Mail\infomail;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MemberController extends Controller
{
    public function memberinfo(){
        $memberinfo = UserInfo::all();

        // dump($memberinfo);
        // exit;

        return view('membercon')->with('data',$memberinfo);
    }

    public function memberstop(Request $req){

        $user = UserInfo::where('user_id', $req->id)->first();
   
        $user->update(['user_status' => '3']);

        // dump($user);
        // exit;
            Mail::to($user->user_email)->send(new infomail($user));
        return redirect()->route('member.memberlist');
    }

    public function memberreturn(Request $req){
        UserInfo::where('user_id', $req->id)
        ->update(['user_status' => '1']);

        return redirect()->route('member.memberlist');
    }



    public function memberrestore(Request $req){
        UserInfo::where('user_id',$req->user_id)
            ->restore();
            return redirect()->route('member.memberlist');
    }
}
