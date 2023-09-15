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
        Schema::create('board_confs', function (Blueprint $table) {
            $table->id();

            $table->string('board_name', 100)->comment('게시판 명');
            $table->string('skin', 100)->default('board')->comment('게시판 스킨');
            $table->enum('use_secret', ['0', '1', '2'])->default('0')->comment('비밀글 사용옵션(0:사용안함,1:선택등록,2:무조건비밀글)');
            $table->enum('use_comment', ['0', '1'])->default('0')->comment('댓글 사용옵션(0:사용안함,1:사용함)');
            $table->tinyInteger('file_num')->default(0)->comment('업로드 파일갯수');
            $table->integer('file_size')->default(2097152)->comment('업로드파일 개별용량제한');
            $table->integer('file_total_size')->default(83886080)->comment('업로드파일 전체용량제한');
            $table->string('file_type')->nullable()->comment('업로드파일 허용 확장자');
            $table->enum('use_category', ['0','1'])->default('0')->comment('카테고리 사용여부');
            $table->text('category_data')->nullable()->comment('카테고리 데이터(json)');

            $table->timestamps();
            $table->softDeletes();

            $table->comment('게시판 설정관리');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('board_confs');
    }
};
