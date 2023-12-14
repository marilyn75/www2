<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommonCode;
use Illuminate\Http\Request;

class CommonCodeController extends Controller
{
    public function index($p_id=null){
        $parentCodes = CommonCode::where('parent_id', null)->get();

        $subCodes = null;
        $currCode = null;
        if(!empty($p_id)){
            $currCode = CommonCode::find($p_id);
            if(!empty($currCode)){
                $subCodes =  CommonCode::defaultOrder()->withDepth()->descendantsOf($p_id)->toTree($p_id);
            }
        }

        return view('admin.common_code.index', compact('parentCodes', 'subCodes', 'currCode', 'p_id'));
    }

    public function create($id=null){
        if(empty($id)){
            $id=0;
            $path = "--상위 코드 없음--";
        }else{
            $code = CommonCode::find($id);
            $ancestors = $code->ancestors;

            if($ancestors->count() == 0){
                $path = $code->title;
            }else{
                $path = implode(" > ", $ancestors->pluck('title')->toArray());
                if($path)   $path .= " > ";
                $path .= $code->title;
            }
        }

        return view('admin.common_code.create',compact('id', 'path'));
    }

    // 코드 추가 처리
    public function store($id, Request $request){
        $data = $request->all();
        // 유효성 검사
        $this->validate($request, CommonCode::$rules, CommonCode::$messages);
        
        $codeData = [
            'title' => $data['title'],
            'is_use' => $data['is_use'],
            'created_user_id' => auth()->user()->id,
            'created_ip' => $request->ip(),
            'updated_user_id' => auth()->user()->id,
            'updated_ip' => $request->ip(),
        ];

        $newCodeItem = new CommonCode($codeData);

        if($id==0){
            $newCodeItem->save();
        }else{
            $parentCodeItem = CommonCode::find($id);
            $parentCodeItem->appendNode($newCodeItem);
        }

        return back()
            ->with('success_message','코드가 생성 되었습니다.');
    }

    public function edit($id){
        $code = CommonCode::find($id);

        $ancestors = $code->ancestors;

        if($ancestors->count() == 0){
            $path = "--상위 코드 없음--";
        }else{
            $path = implode(" > ", $ancestors->pluck('title')->toArray());
            if($path)   $path .= " > ";
            $path .= $code->title;
        }

        return view('admin.common_code.create', compact('id', 'path', 'code'));
    }

    public function update($id, Request $request){
        $data = $request->all();
        // 유효성 검사
        $rules = CommonCode::$rules;
         
        $this->validate($request, $rules, CommonCode::$messages);

        $model = CommonCode::find($id);

        $codeData = [
            'title' => $data['title'],
            'is_use' => $data['is_use'],
            'updated_user_id' => auth()->user()->id,
            'updated_ip' => $request->ip(),
        ];

        $model->update($codeData);

        return back()
            ->with('success_message','코드가 수정 되었습니다.');
    }

    public function destroy($id){
        $node = CommonCode::findOrFail($id);    

        $node->delete();

        return json_encode(['result'=>true, 'message'=>'삭제 되었습니다.']);
    }

    public function sort(Request $request){
        $data = $request->all();

        $descendants = CommonCode::descendantsOf($data['root'])->toArray();
        foreach($descendants as $_v){
            $id = $_v['id'];
            unset($_v['_lft'], $_v['_rgt'], $_v['parent_id']);
            $arrDescendents[$id] = $_v;
        }

        $tree = [];
        foreach ($data["id"] as $i => $id) {
            $depth = $data["depth"][$i]*1;
            $node = $arrDescendents[$id];
            // array_push($node, ["children" => []]);
            // $node = ["id" => $id, "children" => []];
            // if ($depth == 1 || $depth == -1) {
            if ($depth == 0) {
                $tree[] = $node;
            } else {
                $parent =& $tree[array_key_last($tree)];
                for ($j = 2; $j < $depth; ++$j) {
                    $parent =& $parent["children"][array_key_last($parent["children"])];
                }
                $parent['children'][] = $node;
            }
        }

        if(!empty($data['gubun']) && $data['gubun']=="left"){
            foreach($tree as $_i=>$_node){
                $tree[$_i]['children'] = CommonCode::descendantsOf($tree[$_i]['id'])->toTree()->toArray();
            }
            $this->removeTreeInfo($tree);
        }  
     

        $result = CommonCode::rebuildSubtree(CommonCode::find($data['root']), $tree);

        return back()
            ->with('success_message','코드순서가 저장 되었습니다.');
    }

    public function sort_edit($id){
        // $menu = Menu::find($id);
        // $ancestors = $menu->ancestors;
        $currMenu = CommonCode::ancestorsAndSelf($id);
        $totMenu = $currMenu->first()->descendants->sortBy(['_lft','_rgt']);

        foreach($currMenu as $_menu){
            $arrPath[] = $_menu->title;
        }
        unset($arrPath[0]);
        $path = implode(" > ", $arrPath);

        return view('admin.common_code.sort-edit', compact('id', 'currMenu', 'totMenu', 'path'));
    }

    public function sort_update($id, Request $request){
        $data = $request->all();

        // 유효성 검사
        $rules = [
            'parentId' => 'required',
        ];
        $messages = [
            'parentId.required' => '상위코드 필드는 필수입니다.',
        ];
        $this->validate($request, $rules, $messages);

        $menu = CommonCode::find($id);
        $menu->parent_id = $data['parentId'];
        $menu->update();

        return back()
            ->with('success_message','코드위치가 이동 되었습니다.');
    }
}
