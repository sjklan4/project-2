<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diet extends Model
{
    use HasFactory ;

    protected $table = 'diets';

    protected $primaryKey = 'd_id';

    protected $guarded = ['d_id'];

    public $timestamps = false;

    // 참고 사이트
    // https://www.lesstif.com/laravelprog/query-scope-27295884.html
    public function scopeDiet($query, $id, $date, $flg)
    {
        return $query->join('diet_food','diets.d_id','=','diet_food.d_id')->join('food_infos','diet_food.food_id','=','food_infos.food_id')->where('diets.user_id', $id)->where('diets.d_date', '=', $date)->where('d_flg', '=', $flg)->where('diet_food.deleted_at','=', null);
    }
}
