<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DietFood extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'diet_food';

    protected $primaryKey = 'df_id';

    protected $guarded = ['df_id'];

    protected $dates = ['deleted_at'];

    // 동적 쿼리 테스트 -kwon
    public function scopeDietFood($query, $id , $date, $flg)
    {
        return $query->join('diets','diet_food.d_id','=','diets.d_id')->where('diets.user_id', '=', $id)->where('diets.d_date', '=', $date)->where('diets.d_flg', '=', $flg);
    }
}
