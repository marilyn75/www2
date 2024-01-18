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
        Schema::create('common_codes', function (Blueprint $table) {
            $table->id();

            $table->nestedSet();
            $table->string('title')->comment('코드명');
            $table->tinyInteger('is_use')->default(1)->comment('사용여부');

            $table->string('class')->nullable()->comment('구분 클래스');

            $table->userstamps();
            $table->timestamps();

            $table->comment('코드관리');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('common_codes');
    }
};
