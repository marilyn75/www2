<?php

namespace App\Http\Class;

use App\Models\NewspaperAd;
use Yajra\DataTables\DataTables;

// 신문광고관리 클래스

class NewspaperAdClass{
    
    public function datalist(){
        $data = NewspaperAd::select('id', 'news_code', 'news_txt', 'pub_date')
                // ->where('board_id',$this->board_id)
                ->selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d %H:%i:%s") as formatted_created_at');
                // ->orderBy('id', 'desc');
            
        return DataTables::of($data)->toJson();
    }
}