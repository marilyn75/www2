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
        Schema::create('auction_hits', function (Blueprint $table) {
            $table->id();

            $table->date('date')->comment('조회일자');
            $table->char('gbn',1)->comment('구분(a:경매,b:공매)');
            $table->string('code')->comment('물건코드');
            $table->integer('no')->nullable()->comment('물건번호');
            $table->integer('hits')->default(0)->comment('조회수');

            $table->comment('경매/공매 조회수');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auction_hits');
    }
};
