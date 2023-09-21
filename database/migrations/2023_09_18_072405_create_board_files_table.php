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
        Schema::create('board_files', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('board_data_id')->comment('게시물 아이디');
            $table->foreign('board_data_id')
                ->references('id')
                ->on('board_datas')
                ->onDelete('cascade');
            $table->integer('num')->comment('순번');
            $table->string('filepath')->comment('파일경로');
            $table->string('filename')->comment('저장 파일명');
            $table->string('filename_org')->comment('원본 파일명');
            $table->integer('filesize')->comment('파일크기');
            $table->string('filetype',100)->comment('파일유형');
            $table->string('created_ip')->nullable()->comment('등록 아이피');
            $table->unsignedBigInteger('created_user_id')->nullable()->comment('등록 아이디');
            $table->string('deleted_ip')->nullable()->comment('삭제 아이피');
            $table->unsignedBigInteger('deleted_user_id')->nullable()->comment('삭제 아이디');

            $table->timestamps();
            $table->softDeletes();

            $table->comment('게시물 첨부파일');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('board_files');
    }
};
