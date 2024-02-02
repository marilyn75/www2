<?php

namespace App\Http\Class;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

// 경매 클래스

class AuctionClass{

    private $url;   // 목록 api
    private $data;

    public function __construct()
    {
        $this->url = env('AUCTION_API_URL') . '/api/auction/list';
    }

    public function getData(Request $request){
        $data = $request->all();

        // API로부터 데이터 가져오기
        $params = [           
            'numOfRows' => 9,
            'pageNo' => @$data['page'],
        ];

        $response = Http::get($this->url, $params);   
        $this->data = $response->json();

        return $this->data;
    }

    public function getPrintData($data){
        $data['할인율'] = round((intval($data['감정가']) - intval($data['최저가'])) / intval($data['감정가']) * 100);
        $data['dday'] = calculateDDay('2024-02-16');

        $data['유찰횟수'] = 0;
        foreach($data['기일내역'] as $_item){
            if($_item['기일결과']=='유찰')  $data['유찰횟수']++;
        }

        return $data;
    }

}