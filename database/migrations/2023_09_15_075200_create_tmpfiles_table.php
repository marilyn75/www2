<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tmpfiles', function (Blueprint $table) {
            $table->id();

            $table->string('ss_id')->comment('세션id');
            $table->string('module')->comment('모듈코드');
            $table->string('filepath')->comment('파일경로');
            $table->string('filename')->comment('저장 파일명');
            $table->string('filename_org')->comment('원본 파일명');
            $table->integer('filesize')->comment('파일크기');
            $table->string('filetype',100)->comment('파일유형');
            $table->integer('num')->default(0)->comment('순번');
            $table->string('created_ip')->nullable()->comment('등록 아이피');
            $table->unsignedBigInteger('created_id')->nullable()->comment('등록 아이디');

            $table->timestamps();

            $table->comment('임시파일정보');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tmpfiles');
    }
};
