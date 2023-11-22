<?php

namespace App\View\Components;

use App\Http\Class\IntraSaleClass;
use App\Models\IntraSaleHomepage;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModuleSaleIntranet extends Component
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
        $this->cls = new IntraSaleClass;
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
            case "show":
                $return = $this->show();
                break;
        }

        return $return;
    }

    public function index(){
        $data = $this->cls->getListData();
        debug($data);
        return view('components.module-sale-intranet', compact('data'));
    }

    public function show(){
        $data = $this->cls->getData($this->request->idx);
        debug($data);
        // 오늘 본 매물 키 쿠키저장
        $this->cls->todayViewSaleSetCookie($this->request->idx);

        // 오늘 본 매물 데이터
        $todayViewSales = $this->cls->getTodayViewSales();

        $skin = 'components.module-sale-intranet-show';
        if(!empty($this->request->skin))    $skin .= $this->request->skin;
        
        return view($skin, compact('data','todayViewSales'));
    }
}
