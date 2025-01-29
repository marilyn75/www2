<?php

namespace App\Http\Controllers\Web;

use App\Models\Menu;
use function Ramsey\Uuid\v1;
use Illuminate\Http\Request;
use App\Http\Class\MenuClass;

use App\Http\Class\BoardClass;
use App\Http\Class\CommonCodeClass;
use App\Http\Class\IntraSawonClass;
use App\Http\Class\SaleClass;
use App\Http\Controllers\Controller;
use App\Models\CommonCode;

class PageController extends Controller
{
    private function getType($id){
        return Menu::where('id', $id)->pluck('type')->first();
    }

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

        if($request->prcCode == "proc") return view('web.proc', compact('page', 'arrLocation', 'bg', 'request'));
        
        if($request->ajax())
            return view('web.ajax', compact('page', 'arrLocation', 'bg', 'request'));
        else
            return view('web.page', compact('page', 'arrLocation', 'bg', 'request'));
    }

    public function store($id, Request $request){
        $type = $this->getType($id);
        if($type=="B"){
            $message = "게시글이 등록 되었습니다.";
            $class = new BoardClass($request->board_id);
        }

        $class->store($this, $request);

        return back()
            ->with('success_message',$message);
    }

    public function update($id, Request $request){
        $type = $this->getType($id);
        if($type=="B"){
            $message = "게시글이 수정 되었습니다.";
            $class = new BoardClass($request->board_id, $request->board_data_id);
        }

        $class->update($request);

        return back()
            ->with('success_message',$message);
    }

    public function destroy($id, Request $request){
        $type = $this->getType($id);
        if($type=="B"){
            $message = "삭제 되었습니다.";
            $class = new BoardClass(null, $request->board_data_id);
        }

        $class->destroy();

        return json_encode(['result'=>true, 'message'=>$message]);
    }

    public function ajax($id, Request $request){
        // $type = $this->getType($id);

        if($request->mode=="getChildrenFromId"){
            $data = CommonCodeClass::getChildrenFromId($request->code_id);
            return json_encode($data);
        }elseif($request->mode=="sendInquiry"){
            $cls = new IntraSawonClass;
            $reslut = $cls->sendInquiry($this, $request);
            return $reslut->jsonResult();
        }
    }
    
}
