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

    public function store(Request $request){
        $BoardClass = new BoardClass($request->board_id);
        $BoardClass->store($this, $request);

        return back()
            ->with('success_message','게시글이 등록 되었습니다.');
    }

    public function update(Request $request){
        $BoardClass = new BoardClass($request->board_id, $request->board_data_id);
        $BoardClass->update($request);

        return back()
            ->with('success_message','게시글이 수정 되었습니다.');
    }

    public function destroy(Request $request){
        (new BoardClass(null, $request->board_data_id))->destroy();
        return json_encode(['result'=>true, 'message'=>'삭제 되었습니다.']);
    }
    
}
