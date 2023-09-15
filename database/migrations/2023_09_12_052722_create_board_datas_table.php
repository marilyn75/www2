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
        Schema::create('board_datas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('board_id')->comment('게시판 아이디');
            $table->foreign('board_id')
                ->references('id')
                ->on('board_confs')
                ->onDelete('cascade');
            $table->string('title',200)->comment('제목');
            $table->longText('content')->nullable()->comment('내용');
            $table->string('password')->nullable()->comment('비밀번호');
            $table->string('writer',100)->nullable()->comment('작성자');
            $table->mediumInteger('hits')->default(0)->comment('조회수');
            $table->tinyInteger('is_secret')->default(0)->comment('비밀글여부');
            $table->tinyInteger('is_notice')->default(0)->comment('공지글여부');
            $table->unsignedBigInteger('created_user_id')->nullable()->comment('작성자 아이디');
            $table->string('created_ip',20)->nullable()->comment('작성자 아이피');
            $table->unsignedBigInteger('updated_user_id')->nullable()->comment('수정자 아이디');
            $table->string('updated_ip',20)->nullable()->comment('수정자 아이피');

            $table->timestamps();
            $table->softDeletes();

            $table->comment('게시판 데이터');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('board_datas');
    }
};
