<?php

namespace App\Http\Class;

use App\Models\BoardConf;
use DataTables;
use App\Models\BoardData;

// 게시판관련 클래스

class BoardClass{
    private $conf;
    private $board_id;

    public function __construct($board_id)
    {
        $this->board_id = $board_id;
        $this->conf = BoardConf::find($board_id);
    }

    // 게시판 존재여부
    public function isExist(){
        return !empty($this->conf);
    }

    public function getBoardName(){
        return ($this->conf)?$this->conf->board_name:"";
    }

    public function datalist(){
        $data = BoardData::select('id', 'title', 'writer')
                ->where('board_id',$this->board_id)
                ->selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d %H:%i:%s") as formatted_created_at')
                ->orderBy('id', 'desc');
            
        return DataTables::of($data)->toJson();
    }

    public function store(&$controller, $request){
        // 유효성 검사
        $controller->validate($request, BoardData::$rules);

        $data = $request->all();
        $save_data = [
            'board_id' => $this->board_id,
            'title' => $data['title'],
            'content' => $data['content'],
            'created_user_id' => auth()->user()->id,
            'created_ip' => $request->ip(),
            'writer' => auth()->user()->name,
        ];

        BoardData::create($save_data);
    }
}