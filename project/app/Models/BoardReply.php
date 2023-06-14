<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoardReply extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'board_replies';

    protected $primaryKey = 'reply_id';

    protected $guarded = ['reply_id', 'created_at'];

    protected $dates = ['deleted_at'];
}
