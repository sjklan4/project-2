<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestCateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quest_cates')->insert([
            ['quest_name' => '물 마시기','quest_content' => '하루 2L 이상 물 마시기', 'min_period' => 10],
            ['quest_name' => '배달 음식 끊기','quest_content' => '배달 음식 시키지 않기', 'min_period' => 15],
            ['quest_name' => '운동하기','quest_content' => '하루 최소 30분 운동', 'min_period' => 10],
            ['quest_name' => '계단 이용','quest_content' => '엘리베이터 대신 계단 이용', 'min_period' => 10],
            ['quest_name' => '좋은 수면','quest_content' => '7시간 이상 수면시간 확보하기', 'min_period' => 10],
        ]);
    }
}
