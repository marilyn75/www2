<?php

namespace App\View\Components;

use Closure;
use Illuminate\Http\Request;
use Illuminate\View\Component;
use App\Http\Class\IntraSaleClass;
use App\Http\Class\CommonCodeClass;
use Illuminate\Contracts\View\View;

class ModuleSaleIntranet extends Component
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
        $data = $this->cls->getListData($this->request);

        // 관심매물 ids
        $result = $this->cls->getFavorites();
        $favorites = $result->getData();

        return view('components.module-sale-intranet', compact('data', 'favorites'));
    }

    public function show(){

        $data = $this->cls->getData($this->request->idx);
        $printData = $this->cls->getPrintData($data);

        $printData['optCodes'] = [];
        $optCodes = CommonCodeClass::getChildrenTreeFormFirstCodeText('매물옵션정보');
        foreach($optCodes as $_k=>$_item){
            foreach($_item as $_v)
                if(in_array($_v, explode("|",$printData['options'])) !== false) $printData['optCodes'][$_k][] = $_v;
        }

        // 지도
        $printData['localX'] = $data->sale->lands[0]->localX;
        $printData['localY'] = $data->sale->lands[0]->localY;
        $printData['mapUrl'] = $this->cls->getMapUrl($data->sale->lands[0]->localX, $data->sale->lands[0]->localY);

        // 주변 시설
        $printData['infra'] = $this->cls->getNearInfra($data->sale->lands[0]->localX, $data->sale->lands[0]->localY);
    
        // 오늘 본 매물 키 쿠키저장
        $this->cls->todayViewSaleSetCookie($this->request->idx);

        // 관련매물
        $this->relatedSales = $this->cls->getRelatedSales($printData);

        $skin = 'components.module-sale-intranet-show';
        if(!empty($this->request->skin))    $skin .= $this->request->skin;

        $this->printData = $printData;
        //debug($printData);
        return view($skin);
    }
}
