<?php

namespace App\Http\Controllers;

use App\Models\FoodInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ApiFoodController extends Controller
{
    public function userfoodDel($id){
        
        // FoodInfo::destroy($id);

        $foodinfo = FoodInfo::find($id);
        $foodinfo->deleted_at = now();

        $foodinfo->save();
        
        // todo 리턴값 수정
        return response()->json(['status' => 'success']);
    }
}
