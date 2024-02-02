<?php

namespace App\View\Components;

use App\Http\Class\AuctionClass;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Http\Request;

class ModuleAuction extends Component
{
    private $request;
    private $cls;
    /**
     * Create a new component instance.
     */
    public function __construct(Request $request)
    {
        $this->cls = new AuctionClass;
        $this->request = $request;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        
        $data = $this->cls->getData($this->request);
        debug($data);
        return view('components.module-auction', compact('data'));
    }
}