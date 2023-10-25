<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CommonCodeItem extends Component
{
    public $codeItems;
    /**
     * Create a new component instance.
     */
    public function __construct($codeItems)
    {
        $this->codeItems = $codeItems;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.common-code-item');
    }
}
