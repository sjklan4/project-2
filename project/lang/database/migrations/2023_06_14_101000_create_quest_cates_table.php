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
        Schema::create('quest_cates', function (Blueprint $table) {
            $table->integer('quest_cate_id')->autoIncrement();
            $table->string('quest_name')->unique();
            $table->string('quest_content');
            $table->integer('min_period');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quest_cates');
    }
};
