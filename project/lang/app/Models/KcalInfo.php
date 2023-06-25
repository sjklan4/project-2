<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KcalInfo extends Model
{
    use HasFactory;

    protected $table = 'kcal_infos';

    protected $primaryKey = 'user_id';

    protected $fillable = ['user_id','user_gen','user_birth'];
}
