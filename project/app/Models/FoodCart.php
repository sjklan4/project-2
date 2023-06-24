<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FoodCart extends Model
{
    use HasFactory, SoftDeletes;

    protected  $table = 'food_carts';

    protected  $primaryKey = 'cart_id';

    protected $guarded = ['cart_id'];
}
