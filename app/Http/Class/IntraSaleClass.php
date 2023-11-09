<?php

namespace App\Http\Class;

use App\Models\Sale;
use App\Models\CommonCode;
use App\Models\IntraSaleHomepage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use DragonCode\Contracts\Cashier\Http\Request;

// 매물관련 클래스

class IntraSaleClass{

    public function __construct()
    {
        
    }

    public function getListData($itemNum=6){
        return IntraSaleHomepage::orderBy('reg_date','desc')->paginate($itemNum);
    }

    public function getData($idx){
        $data = IntraSaleHomepage::find($idx)->sale;
        $arrAddr = explode(",", $data->_addr);
        $data->printAddr = $arrAddr[0];

        return $data;
    }

    public function todayViewSaleSetCookie($idx){
        // 현재 쿠키 값 가져오기
        $existingViewedSales = (empty($_COOKIE['viewed_intra_sales']))?[]:json_decode($_COOKIE['viewed_intra_sales'], true);
        debug($existingViewedSales);
        if(!in_array($idx, $existingViewedSales)){
            // 새로운 매물 키를 배열에 추가 (맨 앞으로)
            array_unshift($existingViewedSales, $idx);

            // 배열을 JSON으로 다시 인코딩하고 쿠키 설정
            setcookie("viewed_intra_sales", json_encode($existingViewedSales), time()+3600);
        }
    }

    public function getTodayViewSales(){
        if(empty($_COOKIE['viewed_intra_sales'])){
            return null;
        }else{
            $arrIdx = json_decode($_COOKIE['viewed_intra_sales'],true);
            
            $data = IntraSaleHomepage::whereIn('idx', $arrIdx)
                ->orderByRaw("FIELD(idx, " . implode(',', $arrIdx) . ")")   // 쿠키값 순서대로
                ->get();

            return $data;
        }
    }
}