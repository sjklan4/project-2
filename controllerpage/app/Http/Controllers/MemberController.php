<?php

namespace App\Http\Controllers;

use App\Models\UserInfo;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function memberinfo(){
        $memberinfo = UserInfo::all();

        // dump($memberinfo);
        // exit;

        return view('membercon')->with('data',$memberinfo);
    }

    public function memberstop(Request $req){
        $id = Userinfo::where('user_id',$req->user_id);

    }
}
