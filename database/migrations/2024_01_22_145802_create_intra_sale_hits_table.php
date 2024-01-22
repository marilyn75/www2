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
        Schema::create('intra_sale_hits', function (Blueprint $table) {
            $table->id();
            
            $table->date('date')->comment('조회일자');
            $table->unsignedBigInteger('s_idx')->comment('물건번호');
            $table->integer('hits')->default(0)->comment('조회수');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intra_sale_hits');
    }
};
