<?php

namespace App\Http\Class;

use App\Models\Menu;


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

}