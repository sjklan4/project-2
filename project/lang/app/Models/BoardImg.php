<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardImg extends Model
{
    use HasFactory;
    protected $table = 'board_imgs';

    protected $primaryKey = 'bimg_id';

    protected $guarded = ['bimg_id'];
    
}
