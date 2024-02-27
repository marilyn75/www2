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
        
        switch($this->request->mode){
            case "":
                $return = $this->index();
                break;
            case "view":
                $return = $this->show();
                break;
            case "modalAddrDetail":
                $return = $this->modalAddrDetail();
                break;
        }

        return $return;

        
    }

    public function index(){
        $data = $this->cls->getData($this->request);
        debug($data);
        return view('components.module-auction', compact('data'));
    }

    public function show(){
        $data = $this->cls->getDetailData($this->request);
        $data = $this->cls->getViewPrintData($data);
        debug($this->request->all(), $data);

        $skin = 'components.module-auction-show';
        
        if(empty($data))    $skin = 'components.error';
        elseif($data['gbn']=="b")   $skin = 'components.module-auction-b-show';

        return view($skin, compact('data'));
    }

    // 소재지 상세보기 모달창
    public function modalAddrDetail(){
        return print_r($this->request->all());
    }
}
