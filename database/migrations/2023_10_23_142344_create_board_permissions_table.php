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
        Schema::create('board_permissions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('board_id')->comment('게시판설정 키값');
            $table->string('role')->comment('사용자 구분');
            $table->tinyInteger('write')->default(0)->comment('쓰기권한');
            $table->tinyInteger('list')->default(1)->comment('목록');
            $table->tinyInteger('read')->default(1)->comment('읽기권한');
            $table->tinyInteger('read_secret')->default(0)->comment('비밀글읽기권한');
            $table->tinyInteger('edit_own')->default(0)->comment('본인글수정권한');
            $table->tinyInteger('edit_all')->default(0)->comment('전체글수정권한');
            $table->tinyInteger('delete_own')->default(0)->comment('본인글삭제권한');
            $table->tinyInteger('delete_all')->default(0)->comment('전체글삭제권한');
            $table->tinyInteger('comment_write')->default(0)->comment('댓글쓰기권한');
            $table->tinyInteger('comment_read')->default(1)->comment('댓글읽기권한');
            $table->tinyInteger('comment_read_secret')->default(0)->comment('비밀댓글읽기권한');
            $table->tinyInteger('comment_edit_own')->default(0)->comment('본인댓글수정권한');
            $table->tinyInteger('comment_edit_all')->default(0)->comment('전체댓글수정권한');
            $table->tinyInteger('comment_delete_own')->default(0)->comment('본인댓글삭제권한');
            $table->tinyInteger('comment_delete_all')->default(0)->comment('전체댓글삭제권한');
            $table->tinyInteger('file_upload')->default(0)->comment('파일업로드권한');
            $table->tinyInteger('file_download')->default(1)->comment('파일다운로드권한');

            $table->unsignedBigInteger('created_user_id')->nullable()->comment('작성자 아이디');
            $table->string('created_ip',20)->nullable()->comment('작성자 아이피');
            $table->unsignedBigInteger('updated_user_id')->nullable()->comment('수정자 아이디');
            $table->string('updated_ip',20)->nullable()->comment('수정자 아이피');

            $table->timestamps();
            $table->softDeletes();

            $table->comment('게시판 권한관리');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('board_permissions');
    }
};
