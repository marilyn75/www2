<?php

namespace App\Http\Class;

use App\Models\BoardConf;
use DataTables;
use App\Models\BoardData;
use App\Models\BoardFile;
use App\Models\TmpFile;

// 게시판관련 클래스

class PostClass{
    public $BoardData;

    public function __construct($id)
    {
        $this->BoardData = BoardData::find($id)->first();    
    }

    public function conf(){
        return $this->BoardData->conf;
    }
}