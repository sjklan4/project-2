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
        Schema::create('recom_diet_food', function (Blueprint $table) {
            $table->integer('recom_f_id')->autoIncrement();
            $table->integer('recom_d_id');
            $table->integer('food_id');
            $table->decimal('recom_intake', 4, 1);
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
        Schema::dropIfExists('recom_diet_food');
    }
};
