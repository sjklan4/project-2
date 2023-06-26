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
        Schema::create('quest_statuses', function (Blueprint $table) {
            $table->integer('quest_status_id')->autoIncrement();
            $table->integer('user_id');
            $table->integer('quest_cate_id');
            $table->char('complete_flg', 1)->default('0');
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
        Schema::dropIfExists('quest_statuses');
    }
};
