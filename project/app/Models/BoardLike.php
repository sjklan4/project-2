<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardLike extends Model
{
    use HasFactory;

    protected $table = 'board_likes';

    protected $primaryKey = 'like_id';

    protected $guarded = ['like_id'];
}
