<?php

namespace App\View\Components;

use App\Models\Menu as ModelsMenu;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Menum extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if(ModelsMenu::isBroken()){
            // $data = ModelsMenu::countErrors();
            ModelsMenu::fixTree();
        }
        $model = ModelsMenu::where('is_use',1)->defaultOrder()->withDepth()->descendantsOf(2)->toTree();

        $menus = [];
        foreach($model as $_mn){
            $item = $this->mkItem($_mn);
            $menus[] = $item;
        }


        return view('components.menum', compact('menus'));
    }

    private function mkItem($data){
        $link = ($data->type != 'M')?route('page', $data->id):"#";
        if($data->type=="L")    $link = $data->url;
        if(!empty($data->params))   $link .= "?".$data->params;

        $item = [
            'code' => $data->id,
            'txt' => $data->title,
            'link' => $link,
        ];
        if(!empty($data->children)){
            foreach($data->children as $_mn){
                $item['submenu'][] = $this->mkItem($_mn);
            }
        }
        return $item;
    }
}
