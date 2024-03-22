<?php

namespace App\View\Components;

use App\Http\Class\CommonCodeClass;
use Closure;
use Illuminate\Http\Request;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use App\Http\Class\NewspaperAdClass;

class ModuleNewspaperAd extends Component
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
        $this->cls = new NewspaperAdClass;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        // 신문사구분 공통코드
        $clsCommonCode = new CommonCodeClass;
        $codes = $clsCommonCode->getNewspaperCodes();
 
        if(empty($this->request->code)) $this->request['code'] = $codes[0]['id'];

        $codes = $clsCommonCode->setKeyValue($codes);

        $data = $this->cls->getListData($this->request);
        $request = $this->request;
        return view('components.module-newspaper-ad', compact('data', 'request', 'codes'));
    }
}
