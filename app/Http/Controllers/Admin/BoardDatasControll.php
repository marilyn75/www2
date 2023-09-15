<?php

namespace App\Http\Controllers\Admin;

use App\Http\Class\BoardClass;
use DataTables;
use App\Http\Controllers\Controller;
use App\Models\BoardConf;
use App\Models\BoardData;
use Illuminate\Http\Request;

class BoardDatasControll extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $BoardClass = new BoardClass($id);

        $board_exist = $BoardClass->isExist();
        $board_name = $BoardClass->getBoardName();
        $board_list = $this->getBoardList();

        return view('admin.board.index',compact('board_exist', 'id', 'board_name', 'board_list'));
    }

    public function getTableData(Request $request, $id){
        if($request->ajax()){   
            return (new BoardClass($id))->datalist();
        }
    }

    private function getBoardList(){
        return BoardConf::orderBy('board_name', 'asc')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $BoardClass = new BoardClass($id);

        $board_exist = $BoardClass->isExist();
        $board_name = $BoardClass->getBoardName();

        return view('admin.board.create', compact('board_name', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $BoardClass = new BoardClass($id);
        $BoardClass->store($this, $request);

        return back()
            ->with('success_message','게시글이 등록 되었습니다.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
