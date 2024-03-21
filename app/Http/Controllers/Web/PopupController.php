<?php

namespace App\Http\Controllers\Web;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Class\MenuClass;
use App\Http\Controllers\Controller;

class PopupController extends PageController
{
    public function index($id, Request $request){
        $page = Menu::find($id);
        // 메뉴관리에서 파라메터 설정한 값을 Request 객체에 포함시킴
        if(!empty($page->params)){
            parse_str($page->params, $queryArray);
            foreach ($queryArray as $key => $value) {
                $request->query->set($key, $value);
            }
        }

        if($request->prcCode=="ajax"){
            return $this->ajax($id, $request);
        }

        $MenuClass = new MenuClass;
        $arrLocation = $MenuClass->getLocationArr($id);
        $bg = $MenuClass->getTopImage($id);
        
        return view('web.popup', compact('page', 'arrLocation', 'bg', 'request'));
    }
}
