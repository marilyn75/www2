<?php

namespace App\View\Components;

use Closure;
use App\Models\TmpFile;
use Illuminate\Http\Request;
use App\Http\Class\BoardClass;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class MenuBoard extends Component
{
    private $board_id;
    private $data_id;
    private $mode;
    private $page;
    private $BoardClass;
    private $request;

    /**
     * Create a new component instance.
     */
    public function __construct($page, Request $request)
    {
        $this->page = $page;
        $this->request = $request;
        $data_id = ($this->request->bid)?$this->request->bid:null;
        $this->BoardClass = new BoardClass($this->page->board_id, $data_id);
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        switch($this->request->mode){
            case "":
                $return = $this->index();
                break;
            case "view":
                $return = $this->show();
                break;
            case "write":
                $return = $this->create();
                break;
            case "edit":
                $return = $this->edit();
                break;

        }

        return $return;
    }

    private function index(){
        $id=$this->page->board_id;
        $board_exist = $this->BoardClass->isExist();
        $board_name = $this->BoardClass->getBoardName();
        $board_list = $this->BoardClass->getBoardList();
        $page = $this->page;
        
        return view('components.menu-board', compact('board_exist', 'id', 'page'));
    }

    private function show(){
        $board_name = $this->BoardClass->getBoardName();

        $data = $this->BoardClass->getViewData();

        $page = $this->page;

        return view('components.menu-board-view', compact('board_name', 'data', 'page'));
    }

    private function create(){
        $id=$this->page->board_id;
        $conf = $this->BoardClass->getConf();
        $board_exist = $this->BoardClass->isExist();
        $board_name = $this->BoardClass->getBoardName();

        $ss_id = ($this->request->old('ss_id'))?$this->request->old('ss_id'):md5(uniqid());
        $_MULTIFILE = [];
        if(!empty($this->request->old('ss_id'))){
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

        $page = $this->page;

        return view('components.menu-board-create', compact('board_name', 'id', 'conf', 'ss_id', '_MULTIFILE', 'page'));
    }

    private function edit(){
        $board_name = $this->BoardClass->getBoardName();

        $data = $this->BoardClass->getViewData($this->request);

        $conf = $this->BoardClass->getConf();
        
        $_MULTIFILE = $data->_multifile;
        $ss_id = ($this->request->old('ss_id'))?$this->request->old('ss_id'):md5(uniqid());

        $page = $this->page;

        return view('components.menu-board-create',  compact('board_name', 'data', 'conf', '_MULTIFILE', 'ss_id', 'page'));
    }

}
