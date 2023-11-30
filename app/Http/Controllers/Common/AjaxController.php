<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    // 관심매물 추가
    public function addFavorite(Request $request){
        if(!auth()->check()){
            return json_encode(['result'=>false, 'msg'=>'로그인 후 이용하세요.']);
        }
        
        if($request->flag == "add")
            $return = ['result'=>true, 'msg'=>'관심매물에 담겼습니다.'.$request->id];
        else
            $return = ['result'=>true, 'msg'=>'관심매물 해제되었습니다.'.$request->id];

        return json_encode($return);
    }
}
