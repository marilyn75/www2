<?php

namespace App\Http\Controllers\Common;

use App\Http\Class\ResultClass;
use App\Http\Class\IntraSaleClass;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    // 관심매물 추가
    public function addFavorite(Request $request){
        
        $result = (new IntraSaleClass)->addFavorite($request);

        return $result->jsonResult();
    }
}
