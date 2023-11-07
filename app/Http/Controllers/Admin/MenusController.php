<?php

namespace App\Http\Controllers\Admin;

use App\Http\Class\MenuClass;
use App\Models\Menu;
use App\Models\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BoardConf;
use Intervention\Image\Facades\Image;

class MenusController extends Controller
{
    private $cls;

    public function __construct()
    {
        $this->cls = new MenuClass;
    }

    public function index($p_id=null, $c_id=null){
        $model = Menu::where('parent_id', $p_id);
        $parentMenus = $model->get();
        $subMenus = null;
        $currMenu = null;
        if(!empty($c_id)){
            $currMenu = $model->where('id', $c_id)->first();
            if(!empty($currMenu)) $subMenus =  Menu::defaultOrder()->withDepth()->descendantsOf($c_id)->toTree($c_id);
            else    $c_id = null;
        }

        return view('admin.menu.index', compact('parentMenus', 'subMenus', 'currMenu', 'p_id', 'c_id'));
    }

    // 메뉴 추가
    public function create($id){
        $menu = Menu::find($id);
        $ancestors = $menu->ancestors;

        if($ancestors->count() == 0){
            $path = "--상위 메뉴 없음--";
        }else{
            $path = implode(" > ", $ancestors->where('parent_id', '!=', null)->pluck('title')->toArray());
            if($path)   $path .= " > ";
            $path .= $menu->title;
        }

        $board = $this->cls->getBoardConfList();
        $module = $this->cls->getProgramModuleList();

        return view('admin.menu.create',compact('id', 'path', 'board', 'module'));
    }

    // 메뉴 추가 처리
    public function store($id, Request $request){
        $data = $request->all();
        // 유효성 검사
        $this->validate($request, Menu::$rules, Menu::$messages);

        // 이미지 업로드
        $filename = null;
        if(!empty($data['top_image'])){
            $image = Image::make($data['top_image']);

            // 이미지의 너비와 높이 가져오기
            // $originalWidth = $image->width();
            // $originalHeight = $image->height();

            // // 리사이즈할 크기 계산
            // if ($originalWidth < $originalHeight) {
            //     // 가로가 짧은 경우
            //     $resizedWidth = 260;
            //     $resizedHeight = intval(260 * $originalHeight / $originalWidth);
            // } else {
            //     // 세로가 짧은 경우
            //     $resizedHeight = 260;
            //     $resizedWidth = intval(260 * $originalWidth / $originalHeight);
            // }

            $resizedWidth = 1920;
            $resizedHeight = 500;

            // 이미지 리사이즈
            $image->resize($resizedWidth, $resizedHeight);

            // // 260x260으로 자르기
            // $image->crop(260, 260);

            $extension = $data['top_image']->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $image->save(public_path('files/menu/') . $filename);
        }
        
        $menuData = [
            'code' => $data['code'],
            'title' => $data['title'],
            'type' => $data['type'],
            'url' => $data['url'],
            'top_image' => $filename,
            'created_user_id' => auth()->user()->id,
            'created_ip' => $request->ip(),
            'updated_user_id' => auth()->user()->id,
            'updated_ip' => $request->ip(),
        ];
        if($data['type']=="B")  $menuData['board_id'] = $data['board_id'];
        if($data['type']=="P")  $menuData['program_module'] = $data['program_module'];

        $newMenuItem = new Menu($menuData);

        // 컨텐츠 저장
        if($data['type']=="C"){
            $content = Content::create([
                'title' => $data['title'],
                'type' => 'H',
                'content' => $data['content'],
                'created_user_id' => auth()->user()->id,
                'created_ip' => $request->ip(),
                'updated_user_id' => auth()->user()->id,
                'updated_ip' => $request->ip(),
            ]);

            $newMenuItem->content_id = $content->id;
        }

        $parentMenuItem = Menu::find($id);
        $parentMenuItem->appendNode($newMenuItem);

        return back()
            ->with('success_message','메뉴가 생성 되었습니다.');
    }

    public function edit($id){
        $menu = Menu::find($id);

        $ancestors = $menu->ancestors;

        if($ancestors->count() == 0){
            $path = "--상위 메뉴 없음--";
        }else{
            $path = implode(" > ", $ancestors->where('parent_id', '!=', null)->pluck('title')->toArray());
            if($path)   $path .= " > ";
            $path .= $menu->title;
        }

        $board = $this->cls->getBoardConfList();
        $module = $this->cls->getProgramModuleList();

        return view('admin.menu.create', compact('id', 'path', 'menu', 'board', 'module'));
    }

    public function update($id, Request $request){
        $data = $request->all();
        
        // 유효성 검사
        $rules = Menu::$rules;
        $rules['code'] .= ",".$id;
   
        $this->validate($request, $rules, Menu::$messages);

        $model = Menu::find($id);

        // 이미지 업로드
        $filename = null;
        if(!empty($data['top_image'])){
            $image = Image::make($data['top_image']);

            // 이미지의 너비와 높이 가져오기
            // $originalWidth = $image->width();
            // $originalHeight = $image->height();

            // // 리사이즈할 크기 계산
            // if ($originalWidth < $originalHeight) {
            //     // 가로가 짧은 경우
            //     $resizedWidth = 260;
            //     $resizedHeight = intval(260 * $originalHeight / $originalWidth);
            // } else {
            //     // 세로가 짧은 경우
            //     $resizedHeight = 260;
            //     $resizedWidth = intval(260 * $originalWidth / $originalHeight);
            // }

            $resizedWidth = 1920;
            $resizedHeight = 500;

            // 이미지 리사이즈
            $image->resize($resizedWidth, $resizedHeight);

            // // 260x260으로 자르기
            // $image->crop(260, 260);

            $extension = $data['top_image']->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $image->save(public_path('files/menu/') . $filename);

            // 기존 이미지 삭제
            if(!empty($model['top_image'])){
                unlink(public_path('files/menu/' . $model['top_image']));
            }
        }

        $menuData = [
            'code' => $data['code'],
            'title' => $data['title'],
            'type' => $data['type'],
            'url' => $data['url'],
            'top_image' => $filename,

            'board_id' => $data['board_id'],
            'program_module' => $data['program_module'],

            'updated_user_id' => auth()->user()->id,
            'updated_ip' => $request->ip(),
        ];        

        $model->update($menuData);

        // 컨텐츠 저장
        if($data['type']=="C"){
            if(empty($model->content)){
                $content = Content::create([
                    'title' => $data['title'],
                    'type' => 'H',
                    'content' => $data['content'],
                    'created_user_id' => auth()->user()->id,
                    'created_ip' => $request->ip(),
                    'updated_user_id' => auth()->user()->id,
                    'updated_ip' => $request->ip(),
                ]);
                $model->update(['content_id'=>$content->id]);
            }else{
                $model->content->update([
                    'content' => $data['content'],
                    'updated_user_id' => auth()->user()->id,
                    'updated_ip' => $request->ip(),
                ]);
            }
        }elseif(!empty($model->content_id)){
            $model->update(['content_id'=>null]);
        }

        return back()
            ->with('success_message','메뉴가 수정 되었습니다.');
    }

    public function destroy($id){
        $node = Menu::findOrFail($id);
        
        // 첨부파일 있는지 체크하고 삭제
        if(!empty($node->top_image)){
            unlink(public_path('files/menu/' . $node->top_image));
        }
        if ($node) {
            $children = $node->descendants;
            foreach($children as $_menu){
                if(!empty($_menu->top_image)){
                    unlink(public_path('files/menu/' . $_menu->top_image));
                }
            }
        }
        

        $node->delete();

        return json_encode(['result'=>true, 'message'=>'삭제 되었습니다.']);
    }

    public function sort_edit($id){
        $menu = Menu::find($id);
        $ancestors = $menu->ancestors;

        if($ancestors->count() == 0){
            $path = "--상위 메뉴 없음--";
        }else{
            $path = implode(" > ", $ancestors->where('parent_id', '!=', null)->pluck('title')->toArray());
            if($path)   $path .= " > ";
            $path .= $menu->title;
        }

        return view('admin.menu.sort-edit', compact('id', 'path', 'menu'));
    }

    public function sort(Request $request){
        $data = $request->all();

        $descendants = Menu::descendantsOf($data['root'])->toArray();
        foreach($descendants as $_v){
            $id = $_v['id'];
            unset($_v['_lft'], $_v['_rgt'], $_v['parent_id']);
            $arrDescendents[$id] = $_v;
        }

        $tree = [];
        foreach ($data["id"] as $i => $id) {
            $depth = $data["depth"][$i];
            $node = $arrDescendents[$id];
            // array_push($node, ["children" => []]);
            // $node = ["id" => $id, "children" => []];
            if ($depth == 1) {
                $tree[] = $node;
            } else {
                $parent =& $tree[array_key_last($tree)];
                for ($j = 2; $j < $depth; ++$j) {
                    $parent =& $parent["children"][array_key_last($parent["children"])];
                }
                $parent['children'][] = $node;
            }
        }
//  dd($tree);
        $result = Menu::rebuildSubtree(Menu::find($data['root']), $tree, true);
        // dd($result);

        return back()
            ->with('success_message','메뉴순서가 수정 되었습니다.'.$result);
        
    }

    // 옵션 일괄수정
    public function option(Request $request){

        $data = $request->all();

        $node = Menu::find($data['root']);

        if(empty($data['gubun'])){
            $node->descendants()->update(['is_use' => 0]);
            if(isset($data['chk_use']))  $node->descendants()->whereIn('id',$data['chk_use'])->update(['is_use' => 1]);
        }else{
            $node->children()->update(['is_use' => 0]);
            if(isset($data['chk_use']))  $node->children()->whereIn('id',$data['chk_use'])->update(['is_use' => 1]);
        }
  

        return back()
            ->with('success_message','옵션이 수정 되었습니다.');
    }
}
