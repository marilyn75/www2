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
        Schema::create('user_auction_favorites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('회원키값');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->char('gbn',1)->comment('구분(a:경매,b:공매)');
            $table->string('code')->comment('물건코드');
            $table->integer('no')->nullable()->comment('물건번호');
                        
            $table->timestamps();

            $table->comment('경매/공매 관심매물');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_auction_favorites');
    }
};
