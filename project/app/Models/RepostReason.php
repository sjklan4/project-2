<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepostReason extends Model
{
    use HasFactory;

    protected $table = 'report_reasons';

    protected $primaryKey = 'rep_r_id';

    protected $guarded = ['rep_r_id'];
}
