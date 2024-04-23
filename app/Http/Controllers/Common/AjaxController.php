<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Class\AuctionClass;
use App\Http\Class\IntraSaleClass;
use App\Http\Class\CommonCodeClass;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
    // 관심매물 추가
    public function addFavorite(Request $request){
        
        $result = (new IntraSaleClass)->addFavorite($request);

        return $result->jsonResult();
    }

    // 관심매물 추가 - 경공매
    public function addFavoriteAuction(Request $request){
        
        $result = (new AuctionClass)->addFavorite($request);

        return $result->jsonResult();
    }

    // 매물유형 코드 전체 tree 
    public function getCommonCodeSaleCategoryAllTree(){
        $result = CommonCodeClass::getChildrenFormFirstCodeText('매물유형');

        return $result->jsonResult();
    }

    // 경공매유형 코드 전체 tree 
    public function getCommonCodeAuctionCategoryAllTree(){
        $result = CommonCodeClass::getChildrenFormFirstCodeText('경공매유형');

        return $result->jsonResult();
    }
}
