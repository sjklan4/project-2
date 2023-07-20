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
            $table->integer('user_id')->autoIncrement();
            $table->string('user_email',50)->unique();
            $table->string('user_name',30);
            $table->string('remember_token')->nullable();
            $table->string('nkname',10)->unique();
            $table->string('password', 100);
            $table->string('user_phone_num',11);
            $table->char('social', 1)->nullable(); // erd 랑 기본값 셋팅 다름
            $table->integer('report_num')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->char('user_status', 1)->default('1'); // erd 랑 기본값 셋팅 다름
            // $table->char('email_verified_at', 1)->default('0');
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
