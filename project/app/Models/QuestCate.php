<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestCate extends Model
{
    use HasFactory;

    protected $table = 'quest_cates';

    protected $primaryKey = 'quest_cate_id';

    protected $guarded = ['quest_cate_id'];

}
