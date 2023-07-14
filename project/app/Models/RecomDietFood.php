<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecomDietFood extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'recom_diet_food';

    protected $primaryKey = 'recom_f_id';

    protected $guarded = ['recom_f_id'];

    protected $dates = ['deleted_at'];
}
