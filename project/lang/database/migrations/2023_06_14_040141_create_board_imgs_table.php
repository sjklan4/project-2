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
        Schema::create('board_imgs', function (Blueprint $table) {
            $table->integer('bimg_id')->autoIncrement();
            $table->integer('board_id');
            $table->string('bimg_name');
            $table->string('bimg_path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('board_imgs');
    }
};
