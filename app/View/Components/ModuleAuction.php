<?php

namespace App\View\Components;

use Closure;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\View\Component;
use App\Http\Class\AuctionClass;
use Illuminate\Contracts\View\View;

class ModuleAuction extends Component
{
    private $request;
    private $cls;
    private $mMode, $sMode;
    /**
     * Create a new component instance.
     */
    public function __construct(Request $request)
    {
        $this->cls = new AuctionClass;
        $this->request = $request;
        
        $arrMode = explode(".",$this->request->mode);

        $this->mMode = $arrMode[0];
        $this->sMode = empty($arrMode[1]) ? "" : $arrMode[1];
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
            case "caLink.popup":
                $return = $this->courtauctionLink();
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
        if(empty($data)) return view('components.error', compact('data'));
        
        $data = $this->cls->getViewPrintData($data);
        debug($this->request->all(), $data);

        $skin = 'components.module-auction-show';
        if($data['gbn']=="b")   $skin = 'components.module-auction-b-show';

        // 조회수 증가
        $this->cls->incrementHits($data);

        return view($skin, compact('data'));
    }

    // 소재지 상세보기 모달창
    public function modalAddrDetail(){
        return print_r($this->request->all());
    }

    // 대법원 링크
    public function courtauctionLink(){
        $data = $this->request->all();

        $payload = [
            'jiwonNm'=>iconv('UTF-8', 'euc-kr', $data['jiwonNm']),
            'saNo'=>$data['sano'],
            'maemulSer'=>$data['no'],
            '_SRCH_SRNID'=>'PNO102001',
        ];
        
        $data['link_url'] = "https://www.courtauction.go.kr/" . $data['type'] . "?" . http_build_query($payload);

        $client = new Client;
        $response = $client->get($data['link_url']);
        $contents = $response->getBody()->getContents();

        if(strpos($contents, 'info_nopage.gif')!==false || strpos($contents, 'alert_03.gif')!==false || strpos($contents, 'alert_01.gif')!==false){
            $payload['type'] = $data['type'];
            $jsonHtml = file_get_contents('http://apidata.localhost:8080/api/auction/html?' . http_build_query($payload));
            $arrHtml = json_decode($jsonHtml,1);
            $data['html'] = $arrHtml['html'];
        }

        return view('popup.module-auction-link', compact('data'));
    }
}
