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
        Schema::create('report_lists', function (Blueprint $table) {
            $table->integer('rep_id')->autoIncrement();
            $table->integer('reporter');
            $table->integer('suspect');
            $table->integer('board_id')->nullable();
            $table->integer('reply_id')->nullable();
            $table->integer('rep_r_id');
            $table->char('complate_flg', 1);
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
        Schema::dropIfExists('report_lists');
    }
};
