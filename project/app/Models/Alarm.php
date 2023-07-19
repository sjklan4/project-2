<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alarm extends Model
{
    use HasFactory;
    protected $table = 'alarms';

    protected $primaryKey = 'alarm_id';

    protected $guarded = ['alarm_id'];
}
