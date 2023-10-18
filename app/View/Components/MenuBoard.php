<?php

namespace App\View\Components;

use Closure;
use App\Http\Class\BoardClass;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class MenuBoard extends Component
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

        $BoardClass = new BoardClass(21);

        $id=21;
        $board_exist = $BoardClass->isExist();
        $board_name = $BoardClass->getBoardName();
        $board_list = $BoardClass->getBoardList();
        
        return view('components.menu-board', compact('board_exist', 'id'));
    }
}
