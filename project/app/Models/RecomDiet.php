<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecomDiet extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'recom_diets';

    protected $primaryKey = 'recom_d_id';

    protected $dates = ['deleted_at'];

    protected $guarded = ['recom_d_id'];
}
