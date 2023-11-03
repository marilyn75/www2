<?php

namespace App\View\Components;

use Closure;
use Illuminate\Http\Request;
use Illuminate\View\Component;
use App\Http\Class\CommonCodeClass;
use App\Http\Class\SaleClass;
use App\Models\Sale;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;

class ModuleSale extends Component
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
        $this->cls = new SaleClass;
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
            // case "view":
            //     $return = $this->show();
            //     break;
            case "create":
                $return = $this->create();
                break;
            // case "edit":
            //     $return = $this->edit();
            //     break;

        }

        return $return;
    }

    public function index(){
        return view('components.module-sale');
    }

    public function create(){
        
        if(!auth()->check()){
            return redirect()->route('login');
        }

        $data['step'] = $this->request->step;
        $data['tmp_id'] = $this->request->tmp_id;
        $page = $this->page;
        $uri = $this->request->getUri();

        switch($data['step']){
            case "": case "1":
                $data['tmp_id'] = $this->cls->getTmpId();

                $CommonCodeClass = new CommonCodeClass;
                $tradeType = $CommonCodeClass->getChildrenFormFirstCodeText('거래유형');
                $saleType = $CommonCodeClass->getChildrenFormFirstCodeText('매물유형');

                $db_data = $this->cls->getDataFromTmpId($data['tmp_id']);
                if(empty($db_data)){
                    $data['tradeType'] = old('trade_type');
                    $data['saleType'] = old('sale_type');
                }else{
                    $data['tradeType'] = $db_data['trade_type'];
                    $data['saleType'] = $db_data['sale_type'];
                }
                
                

                debug('tmpid',$data['tmp_id'],$db_data);
                
                return view('components.module-sale-create-step1', compact('tradeType', 'saleType', 'page', 'data', 'uri'));
                break;
            case "2":
                $this->cls->postSetp1($this->request);
                return view('components.module-sale-create-step2', compact('page', 'data', 'uri'));
                break;
            case "3":
                return view('components.module-sale-create-step3', compact('page', 'data', 'uri'));
                break;
            case "4":
                return view('components.module-sale-create-step4', compact('page', 'data', 'uri'));
                break;
            case "5":
                return view('components.module-sale-create-step5', compact('page', 'data', 'uri'));
                break;
            case "6":
                return view('components.module-sale-create-step6', compact('page', 'data', 'uri'));
                break;
            case "7":
                return view('components.module-sale-create-step7', compact('page', 'data', 'uri'));
                break;
        }

        
    }
}
