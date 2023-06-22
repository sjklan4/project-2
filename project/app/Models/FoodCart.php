<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodCart extends Model
{
    use HasFactory;

    protected  $table = 'food_carts';

    protected  $primaryKey = 'cart_id';

    protected $guarded = ['cart_id'];
}
