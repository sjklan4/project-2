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
            $table->char('user_gen',1);
            $table->integer('user_age');
            $table->integer('user_tall');
            $table->integer('user_weigth');
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
