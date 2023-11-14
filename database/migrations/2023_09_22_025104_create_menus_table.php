<?php

use App\Models\Menu;
use Kalnoy\Nestedset\NestedSet;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();

            $table->nestedSet();
            $table->string('code')->comment('메뉴코드');
            $table->string('title')->comment('메뉴명');
            $table->char('type',1)->comment('메뉴유형');
            $table->string('top_image')->nullable()->comment('상단이미지');
            $table->unsignedBigInteger('board_id')->nullable()->comment('연결 게시판 아이디');
            $table->unsignedBigInteger('content_id')->nullable()->comment('연결 컨텐츠 아이디');
            $table->string('program_module')->nullable()->comment('프로그램 연결 모듈명');
            $table->string('url')->nullable()->comment('링크url');
            $table->string('rss_url')->nullable()->comment('rss url');
            $table->string('target',10)->nullable()->comment('링크target');
            $table->tinyInteger('is_use')->default(1)->comment('사용여부');

            $table->unsignedBigInteger('created_user_id')->nullable()->comment('작성자 아이디');
            $table->string('created_ip',20)->nullable()->comment('작성자 아이피');
            $table->unsignedBigInteger('updated_user_id')->nullable()->comment('수정자 아이디');
            $table->string('updated_ip',20)->nullable()->comment('수정자 아이피');

            $table->timestamps();
        });

        // 기초 데이터
        $data = [
            [
                'code'=>'_web',
                'title'=>'PC',
                'type'=>'S',
            ],
            [
                'code'=>'_mobile',
                'title'=>'MOBILE',
                'type'=>'S',
            ],
        ];
        Menu::create($data[0]);
        Menu::create($data[1]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
