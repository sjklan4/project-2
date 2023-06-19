<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Board;
use App\Models\BoardHit;
use App\Models\DietFood;
use Database\Seeders\DietSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 개인 식단 초기 데이터 삽입용 시더 호출
        // $this->call(DietSeeder::class);

        // 개인 식단음식 더미 데이터 삽입용 팩토리 호출
        // DietFood::factory(500)->create();

        // BoardHit::factory(107)->create();
    }
}
