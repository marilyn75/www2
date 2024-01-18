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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();

            $table->string('title')->comment('컨텐츠 제목');
            $table->char('type',1)->default('H')->comment('컨텐츠 타입');
            $table->longText('content')->nullable()->comment('컨텐츠 내용');
            
            $table->userstamps();
            $table->timestamps();
            $table->softDeletes();

            $table->comment('컨텐츠 관리');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
