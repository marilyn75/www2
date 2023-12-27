<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Class\CommonCodeClass;
use App\Http\Class\IntraSaleClass;
use App\Http\Class\IntraSawonClass;
use App\Http\Class\NewsClass;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    function index(){
        $response_data = CommonCodeClass::getChildrenFormFirstCodeText('매물유형');
        $sale_codes = $response_data->getData();

        // 신규매물
        $clsIntraSale = new IntraSaleClass;
        $newSales = $clsIntraSale->mainNewSales();
        // 구역별 매물수
        $localSaleCnt = $clsIntraSale->mainLocalSaleCount();
        // 추천매물
        $recommendSales = $clsIntraSale->mainRecommendSales();
        // 전문가 추천
        $agents = (new IntraSawonClass)->mainAgents();
        // news 인사이드
        $news = (new NewsClass)->getData();
        $news = $news['NEWS_DATA'];

        return view('index',compact('sale_codes', 'newSales', 'localSaleCnt', 'recommendSales', 'agents', 'news'));
    }
}
