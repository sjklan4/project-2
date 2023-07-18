<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PwController extends Controller
{
    public function findpwget(){
        return view('findpw');
    }

    public function findpwpost(Request $req){
        return $req;
    }
}
