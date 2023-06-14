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
        Schema::create('user_infos', function (Blueprint $table) {
            $table->id('user_id')->autoIncrement();
            $table->string('user_email',50)->unique();
            $table->string('user_name',30);
            $table->string('remember_token');
            $table->string('nkname',10)->unique();
            $table->password();
            $table->string('user_phone_num',11);
            $table->integer('gole_kcal');
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
        Schema::dropIfExists('user_infos');
    }
};
