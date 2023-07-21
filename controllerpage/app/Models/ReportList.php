<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReportList extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'report_lists';

    protected $primaryKey = 'rep_id';

    protected $guarded = ['rep_id'];

    protected $dates = ['deleted_at'];
}
