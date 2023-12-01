<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ItemSaleIntranet extends Component
{
    public $type;
    public $printData;
    /**
     * Create a new component instance.
     */
    public function __construct($type, $printData)
    {
        $this->type = $type;
        $this->printData = $printData;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.item-sale-intranet');
    }
}
