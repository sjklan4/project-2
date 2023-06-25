<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DietSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('diets')->insert([
            ['user_id' => '2', "d_date" => "2023-06-19", "d_flg" => "0"]
            ,['user_id' => '2', "d_date" => "2023-06-19", "d_flg" => "1"]
            ,['user_id' => '2', "d_date" => "2023-06-19", "d_flg" => "2"]
            ,['user_id' => '2', "d_date" => "2023-06-19", "d_flg" => "3"]
        ]);
    }
}
