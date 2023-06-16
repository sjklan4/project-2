<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// v002 add
use Laravel\Scout\Searchable;

class FoodInfo extends Model
{
    use HasFactory;
    use Searchable; // v002 add

    protected $table = 'food_infos';

    protected $primaryKey = 'food_id';

    protected $dates = ['deleted_at'];

    protected $guarded = ['food_id', 'user_id', 'userfood_flg'];
}
