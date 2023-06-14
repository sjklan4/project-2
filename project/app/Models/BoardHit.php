<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardHit extends Model
{
    use HasFactory;
    protected $table = 'board_hits';

    protected $primaryKey = 'board_id';

    protected $guarded = ['board_id'];
}
