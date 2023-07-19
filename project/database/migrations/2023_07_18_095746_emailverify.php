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
        Schema::create('Emailverify', function (Blueprint $table) {
        
            $table->integer('email_id')->autoIncrement(); //컬럼 추가된 부분
            $table->string('email');
            $table->string('verification_code')->nullable();
            $table->timestamp('validity_period')->nullable(); // + 메일인증코드 만료시간
            $table->timestamp('email_verified_at')->nullable(); // email 인증 시각
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
        //
    }
};
