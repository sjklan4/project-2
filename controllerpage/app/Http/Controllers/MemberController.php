<?php

namespace App\Http\Controllers;

use App\Mail\infomail;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MemberController extends Controller
{
    //회원정보 불러오기
    public function memberinfo(){
        if(!Auth::user()) {
            return redirect()->route('login.get');
        }

        $memberinfo = DB::table('user_infos')->select('*')->paginate(10);       

        return view('membercon')->with('data',$memberinfo);
    }

    //회원 정지 처리
    public function memberstop(Request $req){

        $user = UserInfo::where('user_id', $req->id)->first();
   
        $user->update(['user_status' => '3']);

    
            Mail::to($user->user_email)->send(new infomail($user));
        return redirect()->route('member.memberlist');
    }

}
