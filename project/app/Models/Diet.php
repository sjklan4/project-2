<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diet extends Model
{
    use HasFactory;

    protected $table = 'diets';

    protected $primaryKey = 'd_id';

    protected $guarded = ['d_id'];

    // 동적 쿼리 테스트 -kwon
    public function scopeTest($query, $sel, $date, $flg)
    {
        return $query->select($sel)->where('d_date', '=', $date)->where('d_flg', '=', $flg);
    }
}
