<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FavDietFood extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'fav_diet_food';

    protected $primaryKey = 'fav_f_id';

    protected $guarded = ['fav_f_id'];

    protected $dates = ['deleted_at'];
}
