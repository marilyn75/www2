<?php

namespace App\Http\Class;

use App\Http\Class\lib\ResultClass;
use App\Models\CommonCode;

// 공통코드관련 클래스

class CommonCodeClass{
    
    public function __construct()
    {
        
    }

    public static function getData($id){
        return CommonCode::find($id);
    }

    // 하위 노드 가져오기
    public function getDescendants($id){
        $data = CommonCode::descendantsOf($id)->where('is_use', 1)->toArray();

        if(empty($data))    return ResultClass::fail('코드값 호출 실패');
        else                return ResultClass::success('', $data);
    }

    // 1차코드 텍스트 기준으로 자식 코드 가져오기
    public static function getChildrenFormFirstCodeText($code_text){
        $id = CommonCode::where([
            'parent_id' => null,
            'is_use' => 1,
            'title' => $code_text
        ])->pluck('id')[0];

        // return CommonCode::descendantsOf($id)->where('is_use',1)->toTree()->toArray();
        // $data = CommonCode::where(['parent_id' => $id, 'is_use'=>1])->select('id', 'title', 'class')->get()->toTree()->toArray();
        $data = CommonCode::defaultOrder()->withDepth()->descendantsOf($id)->where('is_use',1)->toTree()->toArray();

        if(empty($data))    return ResultClass::fail('코드값 호출 실패');
        else                return ResultClass::success('', $data);
    }

    public static function getChildrenTreeFormFirstCodeText($code_text){
        $id = CommonCode::defaultOrder()->withDepth()->where([
            'parent_id' => null,
            'is_use' => 1,
            'title' => $code_text
        ])->pluck('id')[0];

        $data = CommonCode::defaultOrder()->withDepth()->descendantsOf($id)->where('is_use',1)->toTree()->toArray();
        foreach($data as $_dt){
            foreach($_dt['children'] as $_child){
                $return[$_dt['title']][] = $_child['title'] . "|" . $_child['id'] . "|" . $_child['class'];
            }
        }

        return $return;
    }

    public static function getChildrenFromId($id){
        return CommonCode::defaultOrder()->withDepth()->where(['parent_id' => $id, 'is_use'=>1])->select('id','title')->get()->toArray();
    }

    // 신문사구분
    public function getNewspaperCodes(){
        $cate = $this->getChildrenFromId(69);
        return $cate;
    }

    public function setKeyValue($data){
        $return = [];
        foreach($data as $dt) $return[$dt['id']] = $dt['title'];

        return $return;
    }
    
}