<?php

namespace App\Http\Class;

use App\Http\Class\lib\KakaoApiClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

// 경매 클래스

class AuctionClass{

    private $url, $url_show;   // 목록 api
    private $data;
    private $hash_keyword;

    public function __construct()
    {
        $this->url = env('AUCTION_API_URL') . '/api/auction/list';
        $this->url_show = env('AUCTION_API_URL') . '/api/auction/show';
        $this->hash_keyword = [
            '재매각', '선순위임자인', '선순위전세권', '위반건축물', '법정지상권', '별도등기', '유치권', '분묘기지권', 
            '특별매각조건', '농지취득', '예고등기', '선순위관련', '우선매수신고'
        ];
    }

    public function getData(Request $request){
        $data = $request->all();

        // API로부터 데이터 가져오기
        $params = [           
            'numOfRows' => 9,
            'pageNo' => @$data['page'],
        ];

        $response = Http::get($this->url, $params);   
        $this->data = $response->json();

        return $this->data;
    }

    public function getDetailData(Request $request){
        $data = $request->all();

        // API로부터 데이터 가져오기
        $params = [           
            'sano' => $data['sano'],
            'no' => intval($data['no']),
        ];

        $response = Http::get($this->url_show, $params);   
        $this->data = $response->json();

        return $this->data;
    }

    public function getPrintData($data){
        $data['할인율'] = round((intval($data['감정가']) - intval($data['최저가'])) / intval($data['감정가']) * 100);
        $tmp = explode(' ', $data['매각기일']);
        $data['dday'] = calculateDDay(str_replace('.','-',$tmp[0]));

        $data['유찰횟수'] = 0;
        foreach($data['기일내역'] as $_item){
            if($_item['기일결과']=='유찰')  $data['유찰횟수']++;
        }

        $hashtag = [];
        if($data['유찰횟수']>0) $hashtag[] = '유찰'.$data['유찰횟수'].'회';

        if(!empty($data['물건비고'])){
            foreach($this->hash_keyword as $_word){
                if(strpos($data['물건비고'], $_word)!==false)   $hashtag[] = $_word;
            }
        }
        $data['해시태그'] = $hashtag;

        $data['image'] = env('AUCTION_API_URL') .'/images/'. $data['saNo'] .'/'. $data['대표사진'];
        $data['alt'] =  $data['대표사진'];

        $data['view_link'] = "?mode=view&sano=".$data['saNo']."&no=".$data['물건번호'];

        return $data;
    }

    public function getViewPrintData($data){
        if(empty($data)) return $data;

        $clsKakaoApi = new KakaoApiClass;

        $addr = $clsKakaoApi->getAddr($data['소재지'][0]['addr']);
        $data['localX'] = $addr['documents'][0]['x'];
        $data['localY'] = $addr['documents'][0]['y'];

        debug($addr);
        $data['도로명주소'] = $data['소재지'][0]['addr'];
        $data['지번주소'] = $addr['documents'][0]['address']['address_name'];
        $data['외필지'] = (count($data['소재지'])>1)?" 외 " .(count($data['소재지']) - 1). "필지":"";

        $data['pnu'] = $data['소재지'][0]['showGongsiJiga'];

        // 사진
        if(!empty($data['photo'])){
            foreach($data['photo'] as $_img){
                $data['images'][] = [
                    'src' => env('AUCTION_API_URL') .'/images/'. $data['saNo'] .'/'. $_img['file'],
                    'alt' => $_img['cate'],
                ];
            }
        }

        $data['유찰횟수'] = 0;
        foreach($data['기일내역'] as $_item){
            if($_item['기일결과']=='유찰')  $data['유찰횟수']++;
        }
        $hashtag = [];
        if($data['유찰횟수']>0) $hashtag[] = '유찰'.$data['유찰횟수'].'회';

        if(!empty($data['물건비고'])){
            foreach($this->hash_keyword as $_word){
                if(strpos($data['물건비고'], $_word)!==false)   $hashtag[] = $_word;
            }
        }
        $data['해시태그'] = (empty($hashtag))?"":"#".implode(" #",$hashtag);

        $data['기일내역목록'] = [];
        $chk = false;
        foreach($data['기일내역'] as $_item){
            $date = intval(str_replace(".","",$_item['기일']));
            $today = intval(date("Ymd"));

            if($date<$today){
                $data['기일내역목록'][] = $_item;
            }else{
                if($chk==false)    $data['기일내역목록'][] = $_item;
                $chk = true;
            }
        }

        $data['기일내역목록'] = array_reverse($data['기일내역목록']);

        return $data;
    }
}