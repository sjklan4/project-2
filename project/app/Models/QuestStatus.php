<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestStatus extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'quest_statuses';

    protected $primaryKey = 'quest_status_id';

    protected $guarded = ['quest_status_id'];
}
