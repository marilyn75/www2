<?php

namespace App\Http\Controllers\Web;

use App\Models\BoardConf;
use Illuminate\Http\Request;
use App\Http\Class\BoardClass;
use App\Http\Controllers\Controller;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $condition = "";
        if(session()->has('condition')){
            $condition = session('condition');
            session()->forget('condition');
        }

        $BoardClass = new BoardClass($id);

        $board_exist = $BoardClass->isExist();
        $board_name = $BoardClass->getBoardName();

        return view('web.board.index',compact('board_exist', 'id', 'board_name', 'condition'));
    }

    public function getTableData(Request $request, $id){
        if($request->ajax()){   
            return (new BoardClass($id))->datalist();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $BoardClass = new BoardClass(null, $id);
        $board_name = $BoardClass->getBoardName();

        $data = $BoardClass->getViewData();

        return view('board.view', compact('board_name', 'data'));
    }
}
