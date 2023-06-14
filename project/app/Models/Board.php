<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'boards';

    protected $primaryKey = 'board_id';

    protected $guarded = ['board_id', 'created_at'];

    protected $dates = ['deleted_at'];
}
