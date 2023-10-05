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
        Schema::create('chat_channels', function (Blueprint $table) {
            $table->id();

            $table->string('channel')->unique()->comment('채널명');
            $table->tinyInteger('is_open')->default(1)->comment('오픈여부');

            $table->timestamps();

            $table->comment('채팅 채널');
        });


        Schema::create('chat_users', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('channel_id')->comment('채널 아이디');
            $table->foreign('channel_id')
                ->references('id')
                ->on('chat_channels')
                ->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->comment('유저 아이디');

            $table->timestamps();

            $table->comment('채팅 참여유저');
        });

        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('chat_user_id')->comment('채팅 유저 아이디');
            $table->foreign('chat_user_id')
                ->references('id')
                ->on('chat_users')
                ->onDelete('cascade');
            $table->string('token');
            $table->string('message')->comment('메세지');
            $table->tinyInteger('is_read')->default(0)->comment('읽음여부');

            $table->timestamps();

            $table->comment('채팅 메세지');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_messages');
        Schema::dropIfExists('chat_users');
        Schema::dropIfExists('chat_channels');
    }
};
