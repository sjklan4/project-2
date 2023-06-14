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

    protected $guarded = ['food_id', 'user_id', 'userfood_flg'];
}
