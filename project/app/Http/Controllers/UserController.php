<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function registpost(){
 
        return view('login');
    }
}
