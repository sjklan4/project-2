<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoardCateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('board_cates')->insert([
            ['bcate_id' => '1','bcate_name' => '건강 관리']
            ,['bcate_id' => '2','bcate_name' => '다이어트']
            ,['bcate_id' => '3','bcate_name' => '10대']
            ,['bcate_id' => '4','bcate_name' => '20대']
            ,['bcate_id' => '5','bcate_name' => '30대']
        ]);
    }
}
