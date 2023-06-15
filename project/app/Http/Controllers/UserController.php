<?php

namespace App\Http\Controllers;

use App\Models\KcalInfo;
use App\Models\UserInfo;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(){
        return view('login');
    }

    public function loginpost(Request $req){
        
    }

    public function regist(){
        return view('regist');
    }

    public function registpost(Request $req){

        $data = [
            'user_email' => $req->user_email
            ,'user_name' => $req->user_name
            ,'password' => Hash::make($req->password)
            ,'nkname' => $req->nkname
            ,'user_phone_num' => $req->user_phone_num
            ,'created_at' => now()
        ];
    
        $userid = DB::table('user_infos')->insertGetId($data);
    
        $data1 = [
            'user_birth' => $req->user_birth
            ,'user_gen' => $req->gender
            ,'user_id'  =>  $userid
        ];
        
        KcalInfo::create($data1);
        
        return view('login');
    }
}

// $table->char('user_gen',1);
// $table->date('user_birth');

// 'name'      => 'required|regex:/^[ㄱ-ㅎ가-힣a-zA-Z]*$/|min:2|max:20' 
// ,'password' => 'required_with:passwordchk|same:passwordchk|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,20}$/' //두 값을 비교해서 같은지 확인해 주는 구문
// ,'email'    =>  'required|email|max:100'
// ,'nkname' => 'required|regex:/^[ㄱ-ㅎ가-힣a-zA-Z0-9]*$/|min:2|max:20' 

// ,'callnum' => 'required|regex:/^01[0-9]{9,11}$/'


     // $req->validate([
        //     'name'      => 'require'
        //     ,'password' => 'required_with:passwordchk|same:passwordchk|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,20}$/'
        //     ,'email'    => 'require'
        //     ,'nkname'   => 'require'
        //     ,'birthdate'    =>  'require'
        //     ,'callnum'  => 'require'
        //     ,'gender'   =>  'require'
        // ]);
