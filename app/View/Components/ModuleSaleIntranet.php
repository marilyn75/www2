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
            case "recommend":
                $return = $this->index();
                break;
            case "show":
                $return = $this->show();
                break;
            case "sendInquiry":
                $return = $this->sendInquiry();
        }

        return $return;
    }

    public function index(){
        $request = $this->request;
        $data = $this->cls->getListData($this->request);
        // debug($data);
        // 관심매물 ids
        $result = $this->cls->getFavorites();
        $favorites = $result->getData();

        if($this->request->mode=="recommend")
            return view('components.module-sale-intranet-recommend', compact('data', 'favorites', 'request'));
        else{
            // 최고가격, 최고면적
            $maxPriceNArea = $this->cls->getMaxPriceNArea();
            return view('components.module-sale-intranet', compact('data', 'favorites','maxPriceNArea'));
        }
    }

    public function show(){

        $data = $this->cls->getData($this->request->idx);
        $printData = $this->cls->getPrintData($data);

        // 지도
        $printData['localX'] = $data->sale->lands[0]->localX;
        $printData['localY'] = $data->sale->lands[0]->localY;
        $printData['mapUrl'] = $this->cls->getMapUrl($data->sale->lands[0]->localX, $data->sale->lands[0]->localY);

        // 주변 시설
        $printData['infra'] = $this->cls->getNearInfra($data->sale->lands[0]->localX, $data->sale->lands[0]->localY);
    
        // 오늘 본 매물 키 쿠키저장
        $this->cls->todayViewSaleSetCookie($this->request->idx);

        // 조회수 증가
        $this->cls->incrementHits($this->request->idx);

        // 관련매물
        $this->relatedSales = $this->cls->getRelatedSales($printData);

        $skin = 'components.module-sale-intranet-show';
        if(!empty($this->request->skin))    $skin .= $this->request->skin;

        $this->printData = $printData;
        //debug($printData);
        return view($skin);
    }

    public function sendInquiry(){
        echo "ok!";
        return "ok";
    }
}
