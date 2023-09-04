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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('is_admin')->default(0)->comment('관리자여부');
            $table->string('name')->comment('이름');
            $table->string('email')->unique()->comment('이메일');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable()->comment('패스워드');
            $table->string('file')->nullable()->comment('프로필사진파일');
            $table->string('company')->nullable()->comment('회사명');
            $table->string('position')->nullable()->comment('직책');
            $table->string('phone')->nullable()->comment('연락처');
            $table->string('zip_code',10)->nullable()->comment('우편번호');
            $table->string('address',255)->nullable()->comment('주소');
            $table->string('address_detail',255)->nullable()->comment('상세주소');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
