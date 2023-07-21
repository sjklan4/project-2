<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory;

    protected $table = 'managers';

    protected $primaryKey = 'mng_id';

    protected $guarded = ['mng_id'];

    protected $dates = ['deleted_at'];
}
