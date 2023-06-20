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
        Schema::create('fav_diet_food', function (Blueprint $table) {
            $table->integer('fav_f_id')->autoIncrement();
            $table->integer('fav_id');
            $table->integer('food_id');
            $table->decimal('fav_f_intake', 4, 1);
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
        Schema::dropIfExists('fav_diet_food');
    }
};
