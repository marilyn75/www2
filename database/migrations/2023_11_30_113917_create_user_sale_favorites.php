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
        Schema::create('user_sale_favorites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('회원키값');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('sale_id')->comment('매물키값');
                        
            $table->timestamps();

            $table->comment('관심매물');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_sale_favorites');
    }
};
