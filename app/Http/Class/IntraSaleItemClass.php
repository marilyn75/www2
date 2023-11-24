<?php

namespace App\Http\Class;

use App\Models\IntraSaleHomepage;

// 인트라넷 홈페이지 게재 매물관련 클래스

class IntraSaleItemClass{

    private $model;

    public function __construct($idx)
    {
        $this->model = IntraSaleHomepage::find($idx);
    }

    public function getData(){
        return $this->model;
    }

    public function getKKOxy(){
        $kko_xy = (new KakaoApiClass)->getKKOTranscoord($this->model->sale->lands[0]->localX, $this->model->sale->lands[0]->localY);

        $x = intval($kko_xy["documents"][0]["x"]);
		$y = intval($kko_xy["documents"][0]["y"]);

        return ['x'=>$x, 'y'=>$y];
    }

    // 지도 url
    public function getMapUrl($x, $y){

        return "https://www.gbbinc.co.kr/Share/map.php?x=".$x."&y=".$y."&w=720&h=400";
    }

    // 근처시설
    public function getNearInfra(){

        // MT1	대형마트
        // CS2	편의점
        // PS3	어린이집, 유치원
        // SC4	학교
        // AC5	학원
        // PK6	주차장
        // OL7	주유소, 충전소
        // SW8	지하철역
        // BK9	은행
        // CT1	문화시설
        // AG2	중개업소
        // PO3	공공기관
        // AT4	관광명소
        // AD5	숙박
        // FD6	음식점
        // CE7	카페
        // HP8	병원
        // PM9	약국
        $clsKkoApi = new KakaoApiClass;

        $r_data['category'] = 'SC4';
        $r_data['x'] = $this->model->sale->lands[0]->localX;
        $r_data['y'] = $this->model->sale->lands[0]->localY;
        $r_data['radius'] = 2000; // 반경 00m
        $r_data['size'] = 5;

        $response = $clsKkoApi->getLocalSearchCategory($r_data);
        $data['교육시설'] = $response['documents'];

        $r_data['category'] = 'MT1,HP8';
        $response = $clsKkoApi->getLocalSearchCategory($r_data);
        $data['주변시설'] = $response['documents'];

        $r_data['category'] = 'SW8';
        $response = $clsKkoApi->getLocalSearchCategory($r_data);
        $data['교통정보'] = $response['documents'];




        debug('근처시설(getNearInfra)',$data);

        return $data;
    }
}