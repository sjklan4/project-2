<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoardHitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 108; $i++) { 
            DB::table('board_hits')->insert([
                'board_id' => $i
                ,'board_hits' => random_int(20, 300) 
            ]);
        }
        
    }
}
