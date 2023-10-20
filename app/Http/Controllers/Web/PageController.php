<?php

namespace App\Http\Controllers\Web;

use App\Models\Menu;
use function Ramsey\Uuid\v1;
use Illuminate\Http\Request;
use App\Http\Class\MenuClass;

use App\Http\Class\BoardClass;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index($id, Request $request){
        $page = Menu::find($id);
        $MenuClass = new MenuClass;
        $arrLocation = $MenuClass->getLocationArr($id);
        $bg = $MenuClass->getTopImage($id);
        

        return view('web.page', compact('page', 'arrLocation', 'bg', 'request'));
    }

    public function store($id, Request $request){
        $BoardClass = new BoardClass($request->board_id);
        $BoardClass->store($this, $request);

        return back()
            ->with('success_message','게시글이 등록 되었습니다.');
    }
    
}
