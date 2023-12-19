<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;

class ModuleNews extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // API로부터 데이터 가져오기
        $response = Http::get('http://www.busan.com/dataset_hotnews/2019/01/16/228_580_1_article_list.json');   // 부동산 기사
        $data = $response->json();

        debug($data['NEWS_DATA']);
        
        return view('components.module-news')->with('data', $data['NEWS_DATA']);
    }
}
