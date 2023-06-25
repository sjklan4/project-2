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
        Schema::create('diet_food', function (Blueprint $table) {
            $table->integer('df_id')->autoIncrement();
            $table->integer('food_id');
            $table->integer('d_id');
            $table->string('df_name', 20);
            $table->integer('df_kcal');
            $table->integer('df_carbs');
            $table->integer('df_protein');
            $table->integer('df_fat');
            $table->integer('df_sugar')->nullable();
            $table->integer('df_sodium')->nullable();
            $table->decimal('df_intake', 4, 1);
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
        Schema::dropIfExists('diet_food');
    }
};
