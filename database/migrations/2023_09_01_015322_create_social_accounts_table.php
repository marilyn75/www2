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
        Schema::create('social_accounts', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->unsigned()->comment('users 테이블 키값');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('provider_name')->nullable()->comment('쇼셜사이트명');
            $table->string('provider_id')->nullable()->comment('쇼셜사이트 아이디');

            $table->string('token')->nullable()->comment('토큰');

            // OAuth 2.0 providers...
            $table->string('refresh_token')->nullable();
            $table->string('expires_in')->nullable();

            // OAuth 1.0 providers..
            $table->string('token_secret')->nullable();

            $table->string('name')->nullable()->comment('이름');
            $table->string('email')->nullable()->comment('이메일');
            $table->string('avatar')->nullable()->comment('프로필 사진');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_accounts');
    }
};
