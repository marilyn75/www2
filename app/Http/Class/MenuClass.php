<?php

namespace App\Http\Class;

use App\Models\Menu;
use App\Models\BoardConf;
use Illuminate\Support\Facades\File;

// 메뉴판관련 클래스

class MenuClass{

    public function __construct()
    {
        
    }

    public function getMenuArray($root=1){
        $model = Menu::defaultOrder()->withDepth()->descendantsOf($root)->toTree();
        $menus = [];
        foreach($model as $_mn){
            $item = $this->mkArrayItem($_mn);
            $menus[] = $item;
        }

        return $menus;
    }

    private function mkArrayItem($data){
        $item = [
            'code' => $data->id,
            'txt' => $data->title,
            'link' => '#',
        ];
        if(!empty($data->children)){
            foreach($data->children as $_mn){
                $item['submenu'][] = $this->mkArrayItem($_mn);
            }
        }
        return $item;
    }

    public function getLocationArr($id){
        $menu = Menu::find($id);

        $ancestors = $menu->getAncestors()->where('type','!=','S');

        foreach($ancestors as $_mn){
            $location[] = $_mn->title;
        }

        $location[] = $menu->title;

        return $location;
    }

    public function getTopImage($id){
        $menu = Menu::find($id);

        $img = $menu->top_image;

        if(empty($img)){
            $ancestors = $menu->getAncestors()->where('type','!=','S');

            foreach($ancestors as $_mn){
                $img = $_mn->top_image;
            }
        }
        
        return $img;
    }

    /** 관리자용 */
    // 연결 게시판 목록
    public function getBoardConfList(){
        return BoardConf::orderBy('board_name', 'desc')->get();
    }

    // 연결 프로그램 모듈 목록
    public function getProgramModuleList(){
        $path = app_path('View/Components');
        $files = File::allFiles($path);

        $moduleFiles = [];
        foreach($files as $_file){
            $fileName = $_file->getFilename();
            if(strpos($fileName, 'Module') === 0){
                $moduleFiles[] = str_replace("Module","",str_replace(".php","",$fileName));
            }
        }

        return $moduleFiles;
    }

}