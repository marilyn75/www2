<?php

namespace App\Http\Controllers\Admin;

use App\Http\Class\BoardClass;
use DataTables;
use App\Http\Controllers\Controller;
use App\Models\BoardConf;
use App\Models\BoardData;
use App\Models\TmpFile;
use Illuminate\Http\Request;

class BoardDatasControll extends Controller
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
        $board_list = $BoardClass->getBoardList();

        return view('admin.board.index',compact('board_exist', 'id', 'board_name', 'board_list', 'condition'));
    }

    public function getTableData(Request $request, $id){
        if($request->ajax()){   
            return (new BoardClass($id))->datalist();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $id)
    {
        $BoardClass = new BoardClass($id);

        $conf = $BoardClass->getConf();
        $board_exist = $BoardClass->isExist();
        $board_name = $BoardClass->getBoardName();

        $ss_id = ($request->old('ss_id'))?$request->old('ss_id'):md5(uniqid());
        $_MULTIFILE = [];
        if(!empty($request->old('ss_id'))){
            $tmp_files = TmpFile::where('ss_id', $ss_id)->orderBy('num', 'asc')->get();
            foreach($tmp_files as $f){
                $ext = pathinfo(public_path($f['filepath']).$f['filename'])['extension'];
                $_MULTIFILE[] = json_encode(Array(
                    "num"=>$f['num'],
                    "id"=>$f['id'],
                    "fidx"=>$f["id"],
                    "name"=>$f["filename_org"],
                    "size"=>$f["filesize"],
                    // "status"=>$_BOARD_TXT["LABEL_ORG_FILE"],
                    // "alt"=>$_files["file_content_org"],
                    // "del_lbl"=>$_BOARD_TXT["LABEL_ORG_FILE"]." " .$_BOARD_TXT["LABEL_DEL"],
                    "type"=>$ext,
                    // "content"=>$_files["file_content"],
                    'fileViewUrl' => route('common.file.view',$f['filename']),
                    'fileDownUrl' => route('common.file.download',$f['filename']),
                    "fileName"=>$f["filename"],
                    "orgFileName"=>$f["filename_org"],
                    // "upload_date"=>Date("Y-m-d H:i",$_files["reg_date"]),
                ));
            }
        }

        return view('admin.board.create', compact('board_name', 'id', 'conf', 'ss_id', '_MULTIFILE'));
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
    public function show($id)
    {
        $BoardClass = new BoardClass(null, $id);
        $board_name = $BoardClass->getBoardName();

        $data = $BoardClass->getViewData();

        return view('admin.board.view', compact('board_name', 'data'));
    }

    public function download($file_id){
        return (new BoardClass())->fileDownload($file_id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $BoardClass = new BoardClass(null, $id);
        $board_name = $BoardClass->getBoardName();

        $data = $BoardClass->getViewData($request);

        $conf = $BoardClass->getConf();
        
        $_MULTIFILE = [];
        $ss_id = ($request->old('ss_id'))?$request->old('ss_id'):md5(uniqid());

        return view('admin.board.edit', compact('board_name', 'data', 'id', 'conf', '_MULTIFILE', 'ss_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $BoardClass = new BoardClass(null, $id);
        $BoardClass->update($request);

        return back()
            ->with('success_message','게시글이 수정 되었습니다.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        (new BoardClass(null, $id))->destroy();
        return json_encode(['result'=>true, 'message'=>'삭제 되었습니다.']);
    }
}
