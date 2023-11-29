<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class kko_map extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        debug('카카오맵');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.kko_map');
    }
}
