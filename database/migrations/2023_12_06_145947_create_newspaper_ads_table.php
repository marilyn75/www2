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

            $table->userstamps();
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
