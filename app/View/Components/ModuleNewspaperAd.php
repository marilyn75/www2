<?php

namespace App\View\Components;

use Closure;
use Illuminate\Http\Request;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use App\Http\Class\NewspaperAdClass;

class ModuleNewspaperAd extends Component
{
    private $page;
    private $request;
    private $cls;

    public $printData;
    public $relatedSales;
    /**
     * Create a new component instance.
     */
    public function __construct($page, Request $request)
    {
        $this->page = $page;
        $this->request = $request;
        $this->cls = new NewspaperAdClass;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $data = $this->cls->getListData($this->request,4);
        $request = $this->request;
        return view('components.module-newspaper-ad', compact('data', 'request'));
    }
}
