<?php

namespace App\Http\Controllers;

use App\Models\DietFood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ApiHomeController extends Controller
{
    public function intakeupdate(Request $req, $id){

        // user authentication task
        if(!Auth::user() && !$req->expectsJson()) {
            return redirect()->route('user.login');
        }
    
        $dietfood = DietFood::find($id);
        $dietfood->df_intake = $req->df_intake;
        $dietfood->save();
    
        // After editing, put the date in the session to output the menu corresponding to that date
        Session::put('d_date',$req->d_date);
    
        // Alert::success('Modification complete', '');
    
        return response()->json(['message' => 'Edited', 'dietfood' => $dietfood]);
    }
    
}
