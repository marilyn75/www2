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
            'gubun' => @$data['gubun'],
        ];

        $response = Http::get($this->url, $params);   
        $this->data = $response->json();

        return $this->data;
    }

    public function getDetailData(Request $request){
        $data = $request->all();

        // API로부터 데이터 가져오기
        if(!empty($data['sano'])){
            $params = [           
                'sano' => $data['sano'],
                'no' => intval($data['no']),
            ];
        }else{
            $params = [           
                'no' => $data['no'],
            ];
        }

        $response = Http::get($this->url_show, $params);   
        $this->data = $response->json();

        return $this->data;
    }

    public function getPrintData($data){
        if($data['gubun']=="a")   return $this->getPrintData_auction($data);
        else                    return $this->getPrintData_onbid($data);
    }

    public function getPrintData_auction($data){
        $data['할인율'] = round((intval($data['감정가']) - intval($data['최저가'])) / intval($data['감정가']) * 100);
        $tmp = explode(' ', $data['매각기일']);
        $data['dday'] = calculateDDay(str_replace('.','-',$tmp[0]));
        if($data['dday']=='D-Day') $data['dday'] = "결과대기";

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

    public function getPrintData_onbid($data){
        $data['감정가'] = $data['감정평가금액'];
        $data['할인율'] = round((intval($data['감정가']) - intval($data['최저가'])) / intval($data['감정가']) * 100);
        $data['image'] = env('AUCTION_API_URL') .'/images/'. $data['물건관리번호'] .'/'. $data['대표사진'];
        $data['alt'] =  $data['대표사진'];

        $hashtag = [];
        if(!empty($data['자산구분'])) $hashtag[] = $data['자산구분'];
        if($data['유찰횟수']>0) $hashtag[] = '유찰'.$data['유찰횟수'].'회';
        $data['해시태그'] = $hashtag;

        $data['상태'] = str_replace("입찰","",$data['물건상태']);
        $data['날짜'] = $data['상태']=="준비중" ? "시작 " . $data['매각기일'] . " ~ ":" ~ " . $data['매각기일'] . " 마감";

        $data['view_link'] = "?mode=view&no=".$data['물건관리번호'];

        return $data;
    }

    public function getViewPrintData($data){
        if($data['gbn']=="a")   return $this->getViewPrintData_auction($data);
        else                    return $this->getViewPrintData_onbid($data);
    }

    public function getViewPrintData_auction($data){
        if(empty($data)) return $data;

        // $data['level'] = 4; // 카카오 맵 레벨 기본 5
        $data['localX'] = $data['소재지'][0]['kakao_x'];
        $data['localY'] = $data['소재지'][0]['kakao_y'];
        $data['주소'] = (strpos($data['소재지'][0]['addr'], ",")!==false)?$data['소재지'][0]['addr']:$data['소재지'][0]['addr_road'];
        if(empty($data['주소'])){
            $data['주소'] = $data['소재지'][0]['addr_jibun'];
            $data['주소2'] = "";
        }else{
            $data['주소2'] = $data['소재지'][0]['addr_jibun'];
        }

        // 타이틀 옆 면적표시
        $box_area = [];
        $arrTotArea = ['건물'=>0,'토지'=>0];
        $str = "전체";
        $buildingCnt = 0;
        $landCnt = 0;
        $aptHoCnt = 0;
        foreach($data['소재지'] as $_addr){
            $_area = $_addr['면적'];

            if(!empty($_area['전유'])){
                $box_area['전용'] = round($_area['전유'],2);
                $aptHoCnt++;
                // break;
            }
            if(empty($_area['지분'])){
                if(!empty($_area['건물'])){
                    $box_area['건물'] = round($_area['건물'],2);
                    $arrTotArea['건물'] += $_area['건물'];
                    $buildingCnt++;
                    // break;
                }
                if(!empty($_area['토지'])){
                    $box_area['토지'] = round($_area['토지'],2);
                    $arrTotArea['토지'] += $_area['토지'];
                    $landCnt++;
                    // break;
                }
            }else{
                $str = "지분";
                if(!empty($_area['건물지분'])){
                    $box_area['건물'] = round($_area['건물지분'],2);
                    $arrTotArea['건물'] += $_area['건물지분'];
                    $buildingCnt++;
                    // break;
                }
                if(!empty($_area['토지지분'])){
                    $box_area['토지'] = round($_area['토지지분'],2);
                    $arrTotArea['토지'] += $_area['토지지분'];
                    $landCnt++;
                    // break;
                }
            }

            if(!empty($_addr['건물정보']))  $data['건물정보'] = $_addr['건물정보'];
        }
        $data['box_area'] = $box_area;
        if(!empty($box_area['전용']))   $data['print_box_area'] = "전용 ".$box_area['전용'] . "㎡";
        if(!empty($box_area['건물']) && empty($data['print_box_area']))   $data['print_box_area'] = "건물 ".$box_area['건물'] . "㎡";
        if(!empty($box_area['토지']) && empty($data['print_box_area']))   $data['print_box_area'] = "토지 ".$box_area['토지'] . "㎡";

        // 외 필지, 외 건물 동
        $data['print_etc'] = "";
        if($aptHoCnt > 1) $data['print_etc'] = " 외 " . ($aptHoCnt-1) . "호";
        elseif($buildingCnt > 1) $data['print_etc'] = " 외 건물 " . ($buildingCnt-1) . "동";
        elseif($landCnt > 1) $data['print_etc'] = " 외 " . ($landCnt-1) . "필지";
        

        $data['totArea'] = $arrTotArea;

        // $data['pnu'] = $data['소재지'][0]['showGongsiJiga'];

        // 사진
        if(!empty($data['files']['사진'])){
            foreach($data['files']['사진'] as $_img){
                $data['images'][] = [
                    'src' => env('AUCTION_API_URL') .'/images/'. $data['saNo'] .'/'. $_img['file'],
                    'alt' => $_img['cate'],
                ];
            }
        }

        $tmp = explode(' ', $data['매각기일']);
        $tmp2 = explode(".",$tmp[0]);
        $data['매각기일2'] = $tmp2[0] . '년 ' . $tmp2[1] . '월 ' . $tmp2[2] . '일';
        $data['dday'] = calculateDDay(str_replace('.','-',$tmp[0]));
        if($data['dday']=='D-Day') $data['dday'] = "";

        // 대상, 토지, 건물
        if($data['totArea']['토지'] > 0)    $data['target'][] = '토지'.$str;
        if($data['totArea']['건물'] > 0)    $data['target'][] = '건물'.$str;
        $data['print_target'] = implode(", ", $data['target']);
        $data['토지전체면적'] = number_format($data['totArea']['토지'],2) . '㎡ ';
        $data['토지전체면적'] .= '(' . number_format($data['totArea']['토지'] * 0.3025,2) . '평)';
        $data['건물전체면적'] = number_format($data['totArea']['건물'],2) . '㎡ ';
        $data['건물전체면적'] .= '(' . number_format($data['totArea']['건물'] * 0.3025,2) . '평)';

        // 경매구분
        $data['경매구분'] = str_replace('부동산','',$data['사건내역'][0]['사건명']);

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

    public function getViewPrintData_onbid($data){
        if(empty($data)) return $data;
        $arrTarget = [];
        $data['면적'] = ["건물"=>0,"토지"=>0,"건물지분"=>0,"토지지분"=>0,];
        foreach($data['물건세부정보']['면적정보'] as $_area){

            if($_area['종별']=="건물"){
                if(strpos($_area['비고'],'지분')!==false){
                    $data['면적']['건물지분'] = 1;
                    $arrTarget[] = "건물지분";
                }else{
                    $arrTarget[] = "건물전체";
                }
                
                $data['면적']['건물'] += round($_area['면적'],2);
            }
            
            if($_area['종별']=="토지"){
                if(strpos($_area['비고'],'지분')!==false){
                    $data['면적']['토지지분'] = 1;
                    $arrTarget[] = "토지지분";
                }else{
                    $arrTarget[] = "토지전체";
                }
                
                $data['면적']['토지'] += round($_area['면적'],2);
            }
        }
        $arrTarget = array_unique($arrTarget);
        $data['print_target'] = implode(", ", $arrTarget);
        if($data['면적']['건물'] > 0){
            if(empty($data['print_box_area']))   $data['print_box_area'] = "건물 ".$data['면적']['건물'] . "㎡";
            $data['면적']['건물p'] = $data['면적']['건물'] * 0.3025;
        }
        if($data['면적']['토지'] > 0){
            if(empty($data['print_box_area']))   $data['print_box_area'] = "토지 ".$data['면적']['토지'] . "㎡";
            $data['면적']['토지p'] = $data['면적']['토지'] * 0.3025;
        }

        $data['지번주소'] = $data['물건세부정보']['지번주소'];

        // 사진
        if(!empty($data['files']['사진'])){
            foreach($data['files']['사진'] as $_img){
                $data['images'][] = [
                    'src' => env('AUCTION_API_URL') .'/images/'. $data['물건관리번호'] .'/'. $_img,
                    'alt' => $_img,
                ];
            }
        }

        if(!empty($data['files']['감정평가서'])){
            foreach($data['files']['감정평가서'] as $_img){
                $data['docs'][] = [
                    'src' => env('AUCTION_API_URL') .'/images/'. $data['물건관리번호'] .'/'. $_img,
                    'alt' => $_img,
                ];
            }
        }

        $data['localX'] = $data['kakao_x'];
        $data['localY'] = $data['kakao_y'];

        $sDate = intval(str_replace(['-', ' ', ':'],'',$data['입찰시작일시']));
        $eDate = intval(str_replace(['-', ' ', ':'],'',$data['입찰종료일시']));
        $data['진행상태'] = str_replace('인터넷입찰','',$data['물건상태']);
        if($sDate <= intval(date("YmdHi"))){
            $tmp = explode(' ', $data['입찰종료일시']);
            $tmp2 = explode("-",$tmp[0]);
            $data['매각기일2'] = '~ ' . $tmp2[0] . '년 ' . $tmp2[1] . '월 ' . $tmp2[2] . '일 ('.$tmp[1].')';
            $data['dday'] = "마감 ";
        }else{
            $tmp = explode(' ', $data['입찰시작일시']);
            $tmp2 = explode("-",$tmp[0]);
            $data['매각기일2'] = $tmp2[0] . '년 ' . $tmp2[1] . '월 ' . $tmp2[2] . '일 ('.$tmp[1].') ~';
            $data['dday'] = "입찰 ";
        }

        
        $data['dday'] .= calculateDDay(str_replace('.','-',$tmp[0]));
        if($data['dday']=='D-Day') $data['dday'] = "";

        $data['감정평가일'] = "";
        if(!empty($data['물건세부정보']['감정평가정보'][0]))    $data['감정평가일'] = printDateKor($data['물건세부정보']['감정평가정보'][0]['평가일']);

        $data['담당자정보'] = explode("/",$data['담당자정보']);

        $hashtag = [];
        // if(!empty($data['자산구분'])) $hashtag[] = $data['자산구분'];
        if($data['유찰횟수']>0) $hashtag[] = '유찰'.$data['유찰횟수'].'회';
        $data['해시태그'] = (empty($hashtag))?"":"#".implode(" #",$hashtag);

        $data['입찰이력목록'] = [];
        $i = 0;
        do{
            $_row = $data['입찰이력'][$i];
            $sDate = intval(str_replace(['-', ' ', ':'],'',$_row['입찰시작일시']));

            $_row['입찰시작일시'] = str_replace("-",". ",str_replace(" ","(",$_row['입찰시작일시'])) . ")";
            $_row['입찰종료일시'] = str_replace("-",". ",str_replace(" ","(",$_row['입찰종료일시'])) . ")";
            $_row['개찰일시'] = str_replace("-",".",str_replace(" ","(",$_row['개찰일시'])) . ")";
            $_row['class'] = "";
            if($_row['입찰결과']=="유찰"){
                $_row['class'] = "fall";
            }elseif(strpos($_row['입찰결과'],"진행중")!==false){
                $_row['class'] = "ing";
                $_row['입찰결과']="진행";
            }elseif(strpos($_row['입찰결과'],"매각")!==false){
                $_row['class'] = "sale";
                $_row['입찰결과']="매각";
            }
            $data['입찰이력목록'][] = $_row;

            $i++;
        }while($sDate <= intval(date("YmdHi")) && count($data['입찰이력목록'])>$i);

        // foreach($data['입찰이력'] as $_row){
        //     $sDate = intval(str_replace(['-', ' ', ':'],'',$_row['입찰시작일시']));
        //     if($sDate > intval(date("YmdHi"))) break;

        //     $_row['입찰시작일시'] = str_replace("-",". ",str_replace(" ","(",$_row['입찰시작일시'])) . ")";
        //     $_row['입찰종료일시'] = str_replace("-",". ",str_replace(" ","(",$_row['입찰종료일시'])) . ")";
        //     $_row['개찰일시'] = str_replace("-",".",str_replace(" ","(",$_row['개찰일시'])) . ")";
            
        //     if($_row['입찰결과']=="유찰"){
        //         $_row['class'] = "fall";
        //     }elseif(strpos($_row['입찰결과'],"진행중")!==false){
        //         $_row['class'] = "ing";
        //         $_row['입찰결과']="진행";
        //     }elseif(strpos($_row['입찰결과'],"매각")!==false){
        //         $_row['class'] = "sale";
        //         $_row['입찰결과']="매각";
        //     }
        //     $data['입찰이력목록'][] = $_row;
        // }

        $data['입찰이력목록'] = array_reverse($data['입찰이력목록']);

        if(!empty($data['토지정보']['이용계획'])){
            $arrData=[];
            foreach($data['토지정보']['이용계획'] as $_row){
                $arrData[] = $_row['용도지역명'];
            }
            $arrData = array_unique($arrData);
        }

        $data['토지이용계획'] = @$arrData;

        return $data;
    }
}