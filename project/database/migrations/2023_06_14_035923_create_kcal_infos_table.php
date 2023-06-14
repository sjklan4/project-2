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
            $table->integer('goal_kcal'); // edit
            $table->integer('nutrition_ratio')->nullable(); // user 테이블쪽확인필요.. (성별,생년월일도)
            $table->char('user_gen',1);
            $table->date('user_birth');
            $table->integer('user_tall');
            $table->integer('user_weight');
            $table->char('user_activity',1);
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
