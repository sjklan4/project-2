<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestLog extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'quest_logs';

    protected $primaryKey = 'quest_log_id';

    protected $guarded = ['quest_log_id'];

}
