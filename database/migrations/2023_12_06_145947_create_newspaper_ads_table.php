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
        Schema::create('newspaper_ads', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('news_code')->comment('신문사구분코드');
            $table->string('news_txt')->comment('신문사구분명');
            $table->date('pub_date')->comment('신문게재일');

            $table->unsignedBigInteger('created_user_id')->nullable()->comment('작성자 아이디');
            $table->string('created_ip',20)->nullable()->comment('작성자 아이피');
            $table->unsignedBigInteger('updated_user_id')->nullable()->comment('수정자 아이디');
            $table->string('updated_ip',20)->nullable()->comment('수정자 아이피');
            $table->unsignedBigInteger('deleted_user_id')->nullable()->comment('삭제자 아이디');
            $table->string('deleted_ip',20)->nullable()->comment('삭제자 아이피');

            $table->timestamps();
            $table->softDeletes();

            $table->comment('신문광고관리');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newspaper_ads');
    }
};
