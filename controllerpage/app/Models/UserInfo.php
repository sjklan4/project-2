<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserInfo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_infos';

    protected  $primaryKey = 'user_id';


    protected $fillable = ['user_name','user_email','password','nkname','user_phone_num'];
    protected $garded = ['user_id'];

    protected $dates = ['deleted_at'];  
    
}
