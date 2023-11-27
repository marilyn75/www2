<?php

namespace App\View\Components;

use App\Http\Class\IntraSawonClass;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Http\Request;

class ModuleSawon extends Component
{
    private $page;
    private $request;
    private $cls;
    /**
     * Create a new component instance.
     */
    public function __construct($page, Request $request)
    {
        $this->page = $page;
        $this->request = $request;
        $this->cls = new IntraSawonClass;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        switch($this->request->mode){
            case "":
                $return = $this->index();
            break;
            case "view":
                $return = $this->show();
            break;

        }

        return $return;
    }

    public function index(){
        $data = $this->cls->getListData();
        debug($data);
        
        return view('components.module-sawon', compact('data'));
    }

    public function show(){
        $data = $this->cls->getData($this->request->idx);
        $data = $this->cls->getPrintData($data);
        debug($data);

        return view('components.module-sawon-show', compact('data'));
    }
}
