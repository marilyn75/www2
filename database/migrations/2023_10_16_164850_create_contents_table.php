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
            $table->unsignedBigInteger('created_user_id')->nullable()->comment('작성자 아이디');
            $table->string('created_ip',20)->nullable()->comment('작성자 아이피');
            $table->unsignedBigInteger('updated_user_id')->nullable()->comment('수정자 아이디');
            $table->string('updated_ip',20)->nullable()->comment('수정자 아이피');

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
