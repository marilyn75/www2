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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();

            $table->string('tmp_id')->nullable()->comment('임시저장아이디');
            $table->string('sale_code')->nullable()->comment('매물번호');
            $table->string('trade_type',20)->comment('거래유형코드');
            $table->string('trade_type_txt')->comment('거래유형코드텍스트');
            $table->string('sale_type',20)->comment('매물유형코드');
            $table->string('sale_type_txt')->comment('매물유형코드텍스트');

            $table->bigInteger('sale_amount')->nullable()->comment('매매가격');
            $table->integer('deposit_amount_state')->nullable()->comment('월세현황-보증금');
            $table->integer('monthly_amount_state')->nullable()->comment('월세현황-월세');
            $table->integer('deposit_amount')->nullable()->comment('임대-보증금');
            $table->integer('monthly_amount')->nullable()->comment('임대-월세');
            $table->integer('premium_amount')->nullable()->comment('임대-권리금');
            $table->integer('maintenance_cost')->nullable()->comment('관리비');

            $table->tinyInteger('is_movein_immediately')->default(0)->comment('즉시입주여부');
            $table->date('movein_date')->nullable()->comment('입주가능일');
            $table->tinyInteger('is_movein_nego')->default(0)->comment('입주가능일 협의가능여부');

            $table->decimal('land_area',19,9)->nullable()->comment('토지면적');
                // $table->string('direction')->nullable()->comment('지목');
                // $table->string('direction')->nullable()->comment('용도지역');

            $table->decimal('building_area',19,9)->nullable()->comment('건물면적');
                // $table->string('direction')->nullable()->comment('건물용도');
                // $table->string('direction')->nullable()->comment('주구조');

                // $table->string('direction')->nullable()->comment('규모');

            $table->tinyInteger('is_transfer_ownership')->default(0)->comment('명도여부');

            $table->decimal('supply_area',19,9)->nullable()->comment('공급면적');
            $table->decimal('exclusive_area',19,9)->nullable()->comment('전용면적');

            $table->integer('floor')->nullable()->comment('해당층');
            $table->integer('total_floor')->nullable()->comment('총층');
            $table->integer('bath_num')->nullable()->comment('욕실수');
            $table->integer('room_num')->nullable()->comment('방수');
            $table->string('direction')->nullable()->comment('방향');
            $table->tinyInteger('is_parking')->default(0)->comment('주차가능여부');
            $table->integer('parking_num')->nullable()->comment('주차가능대수');

            $table->string('title')->comment('매물제목');
            $table->text('content')->nullable()->comment('매물설명');
            $table->string('youtube_link')->nullable()->comment('유튜브링크');
            $table->tinyInteger('is_open')->default(0)->comment('공개여부 (0:비공개, 1:위치및주소비공개, 2:공개)');

            $table->userstamps();
            $table->timestamps();
            $table->softDeletes();

            $table->comment('매물정보');
        });

        Schema::create('sale_lands', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('sale_id')->comment('매물정보 키');
            $table->foreign('sale_id')
                ->references('id')
                ->on('sales')
                ->onDelete('cascade');
            $table->string('pnucode')->nullable()->comment('pnu코드');
            $table->string('address_jibun')->nullable()->comment('지번주소');
            $table->string('address_road')->nullable()->comment('도로명주소');
            $table->string('lndpclAr')->nullable()->comment('토지면적');
            $table->string('lndcgrCodeNm')->nullable()->comment('지목');
            $table->string('prposAreaNm')->nullable()->comment('용도지역');

            $table->timestamps();
            $table->softDeletes();

            $table->comment('매물정보-소재지');
        });

        Schema::create('sale_buildings', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('land_id')->comment('매물정보-소재지 키');
            $table->foreign('land_id')
                ->references('id')
                ->on('sale_lands')
                ->onDelete('cascade');
            $table->string('mgmBldrgstPk')->nullable()->comment('관리건축물대장PK');
            $table->string('bldNm')->nullable()->comment('건물명');
            $table->string('dongNm')->nullable()->comment('동명칭');
            $table->string('mainPurpsCdNm')->nullable()->comment('주용도코드명');
            $table->string('etcPurps')->nullable()->comment('기타용도');
            $table->string('strctCdNm')->nullable()->comment('구조코드명');
            $table->string('etcStrct')->nullable()->comment('기타구조');

            $table->integer('grndFlrCnt')->nullable()->comment('지상층수');
            $table->integer('ugrndFlrCnt')->nullable()->comment('지하층수');
            $table->integer('rideUseElvtCnt')->nullable()->comment('승강기수');
            $table->integer('emgenUseElvtCnt')->nullable()->comment('비상용승강기수');

            $table->integer('indrMechUtcnt')->nullable()->comment('주차-옥내기계식대수');
            $table->integer('oudrMechUtcnt')->nullable()->comment('주차-옥외기계식대수');
            $table->integer('indrAutoUtcnt')->nullable()->comment('주차-옥내자주식대수');
            $table->integer('oudrAutoUtcnt')->nullable()->comment('주차-옥외자주식대수');

            $table->decimal('platArea',19,9)->nullable()->comment('대지면적');
            $table->decimal('archArea',19,9)->nullable()->comment('건축면적');
            $table->decimal('bcRat',19,9)->nullable()->comment('건폐율');
            $table->decimal('totArea',19,9)->nullable()->comment('연면적');
            $table->decimal('vlRatEstmTotArea',19,9)->nullable()->comment('용적률산정연면적');
            $table->decimal('vlRat',19,9)->nullable()->comment('용적률');
            

            $table->timestamps();
            $table->softDeletes();

            $table->comment('매물정보-건물');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_buildings');
        Schema::dropIfExists('sale_lands');
        Schema::dropIfExists('sales');
    }
};
