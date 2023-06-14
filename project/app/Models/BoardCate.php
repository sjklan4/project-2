<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardCate extends Model
{
    use HasFactory;
    protected $table = 'board_cates';

    protected $primaryKey = 'bcate_id';

    protected $guarded = ['bcate_id'];
}
