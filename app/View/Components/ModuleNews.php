<?php

namespace App\View\Components;

use App\Http\Class\NewsClass;
use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;

class ModuleNews extends Component
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
        $cls = new NewsClass;
        $data = $cls->getData();
        
        return view('components.module-news')->with('data', $data['NEWS_DATA']);
    }
}
