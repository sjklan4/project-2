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
        Schema::create('food_infos', function (Blueprint $table) {
            $table->integer('food_id')->autoIncrement();
            $table->integer('user_id');
            $table->string('food_name', 20);
            $table->integer('kcal');
            $table->integer('carbs');
            $table->integer('protein');
            $table->integer('fat');
            $table->integer('sugar')->nullable();
            $table->integer('sodium')->nullable();
            $table->integer('serving');
            $table->char('ser_unit', 1)->default('0');
            $table->char('userfood_flg', 1)->default('1');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_infos');
    }
};
