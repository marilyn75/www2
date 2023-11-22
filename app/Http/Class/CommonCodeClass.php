<?php

namespace App\Http\Class;

use App\Models\CommonCode;

// 게시판관련 클래스

class CommonCodeClass{
    
    public function __construct()
    {
        
    }

    // 1차코드 텍스트 기준으로 자식 코드 가져오기
    public static function getChildrenFormFirstCodeText($code_text){
        $id = CommonCode::where([
            'parent_id' => null,
            'is_use' => 1,
            'title' => $code_text
        ])->pluck('id')[0];

        // return CommonCode::descendantsOf($id)->where('is_use',1)->toTree()->toArray();
        return CommonCode::where(['parent_id' => $id, 'is_use'=>1])->select('id','title')->get()->toArray();
    }

    public static function getChildrenTreeFormFirstCodeText($code_text){
        $id = CommonCode::where([
            'parent_id' => null,
            'is_use' => 1,
            'title' => $code_text
        ])->pluck('id')[0];

        return CommonCode::descendantsOf($id)->where('is_use',1)->toTree()->toArray();
    }

    public static function getChildrenFromId($id){
        return CommonCode::where(['parent_id' => $id, 'is_use'=>1])->select('id','title')->get()->toArray();
    }
}