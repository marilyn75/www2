<?php

namespace App\Http\Class;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

// 뉴스 클래스

class NewsClass{

    private $url = 'http://www.busan.com/dataset_hotnews/2019/01/16/228_580_1_article_list.json';   // 부동산 기사
    private $data;

    public function __construct()
    {
        // API로부터 데이터 가져오기
        $response = Http::get($this->url);   // 부동산 기사
        $this->data = $response->json();
    }

    public function getData(){
        return $this->data;
    }

}