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
        $arr=[];
        for($i = 1; $i <= 30; $i++){
            for($a = 0; $a <= 3; $a++){
                $arr[] =
                ['user_id' => '30', "d_date" => "2023-06-$i", "d_flg" => $a ];
            }
        }
        DB::table('diets')->insert($arr);
    }
}
