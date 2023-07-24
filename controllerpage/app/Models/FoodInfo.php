<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FoodInfo extends Model
{
    use HasFactory;

    protected $table = 'food_infos';

    protected $primaryKey = 'food_id';

    protected $dates = ['deleted_at'];

    // protected $guarded = ['food_id', 'userfood_flg'];

    protected $fillable = ['user_id', 'food_name', 'kcal', 'carbs', 'protein', 'fat', 'sugar', 'sodium', 'serving', 'ser_unit', 'created_at', 'updated_at','userfood_flg'];
}
