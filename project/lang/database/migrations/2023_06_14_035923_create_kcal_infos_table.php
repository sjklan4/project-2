<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kcal_infos', function (Blueprint $table) {
            $table->integer('user_id')->primary();
            $table->integer('goal_kcal')->default(0);
            $table->integer('nutrition_ratio')->default(0);
            $table->char('user_gen',1);
            $table->date('user_birth');
            $table->integer('user_tall')->default(0);
            $table->integer('user_weight')->default(0);
            $table->char('user_activity',1)->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kcal_infos');
    }
};
