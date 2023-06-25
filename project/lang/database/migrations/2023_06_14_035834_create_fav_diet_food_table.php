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
            $table->string('fav_f_name', 20);
            $table->decimal('fav_f_intake', 4, 1);
            $table->integer('fav_f_kcal');
            $table->integer('fav_f_carbs');
            $table->integer('fav_f_protein');
            $table->integer('fav_f_fat');
            $table->integer('fav_f_sugar')->nullable();
            $table->integer('fav_f_sodium')->nullable();
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
