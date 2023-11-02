<?php

namespace App\View\Components;

use App\Http\Class\CommonCodeClass;
use Closure;
use Illuminate\Http\Request;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ModuleSale extends Component
{
    private $page;
    private $request;
    /**
     * Create a new component instance.
     */
    public function __construct($page, Request $request)
    {
        $this->page = $page;
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
                if(empty($data['tmp_id'])){
                    $data['tmp_id'] = uniqid();
                }

                $CommonCodeClass = new CommonCodeClass;
                $tradeType = $CommonCodeClass->getChildrenFormFirstCodeText('거래유형');
                $saleType = $CommonCodeClass->getChildrenFormFirstCodeText('매물유형');
                
                return view('components.module-sale-create-step1', compact('tradeType', 'saleType', 'page', 'data', 'uri'));
                break;
            case "2":
                $data['tmp_id'] = uniqid();
                return view('components.module-sale-create-step2', compact('page', 'data', 'uri'));
                break;
            case "3":
                $data['tmp_id'] = uniqid();
                return view('components.module-sale-create-step3', compact('page', 'data', 'uri'));
                break;
            case "4":
                $data['tmp_id'] = uniqid();
                return view('components.module-sale-create-step4', compact('page', 'data', 'uri'));
                break;
            case "5":
                $data['tmp_id'] = uniqid();
                return view('components.module-sale-create-step5', compact('page', 'data', 'uri'));
                break;
            case "6":
                $data['tmp_id'] = uniqid();
                return view('components.module-sale-create-step6', compact('page', 'data', 'uri'));
                break;
            case "7":
                $data['tmp_id'] = uniqid();
                return view('components.module-sale-create-step7', compact('page', 'data', 'uri'));
                break;
        }
    }
}
