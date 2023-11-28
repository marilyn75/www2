<?php

namespace App\Http\Class;

use App\Models\Sale;
use App\Models\CommonCode;
use App\Models\IntraSaleHomepage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use DragonCode\Contracts\Cashier\Http\Request;

// 매물관련 클래스

class IntraSaleClass{

    public function __construct()
    {
        
    }

    public function getListData($request, $itemNum=6){
        $data = $request->all();

        $model = IntraSaleHomepage::where('isDone',1);

        if(!empty($data['sort'])){
            $arrSort = explode("|", $data['sort']);
            if(empty($arrSort[1])) $arrSort[1] = 'asc';
            $model->orderBy($arrSort[0],$arrSort[1]);
        }else{
            $model->orderBy('reg_date','desc');
        }

        return $model->paginate($itemNum);
    }

    public function getData($idx){
        $data = IntraSaleHomepage::find($idx);

        return $data;
    }

    // 출력용 데이터 가공
    static public function getPrintData($data){
        $return = $data->toArray();

        // 수익률 계산 : (월세 * 12) / (매매가격 - 보증금)
        $return['rate'] = (intval($data->monPrice_st)==0)?0:round(((($data->monPrice_st * 12) / ($data->salePrice - $data->depPrice_st)) * 100), 2);


        $return['saleTypeFull'] = $data->saleTypeTxt;
        $return['saleType'] = trim(explode(">",$data->saleTypeTxt)[1]);        

        if($data->tradeType=="임대"){
            $return['price'] = number_format($data->depPrice)." / ".number_format($data->monPrice);
        }else{
            $return['price'] = number_format($data->salePrice);
        }

        $return['imgs'] = [];
        foreach($data->files as $_img){
            $return['imgs'][] = "http://test.gbbinc.co.kr/_Data/Homepage/".$_img->filename;
        }
        if(count($return['imgs'])==0){
            $return['imgs'][] = "/images/noimg.jpg";
        }
        // $return['imgs'][] = "/images/noimg.jpg";

        $return['img'] = (empty($data->files->first()->filename))?"/images/noimg.jpg":"http://test.gbbinc.co.kr/_Data/Homepage/".$data->files->first()->filename;

        $arrAddr = explode("|",$data->addr);
        $arrAddress = explode(" ", $arrAddr[0]);
        $addr = trim($arrAddress[0])." ".trim($arrAddress[1])." ".trim($arrAddress[2]);
        if(count($arrAddr)>1) $addr .= " 외 ".(count($arrAddr) -1)."필지";
        $return['address'] = $addr;

        $return['bdArea'] = (empty($return['bdArea']))?"":number_format($return['bdArea'],2);
        $return['bdArea_py'] = (empty($return['bdArea']))?"":number_format(doubleval($return['bdArea']) * 0.3025 ,2);
        $return['landArea'] = (empty($return['landArea']))?"":number_format($return['landArea'],2);
        $return['landArea_py'] = (empty($return['landArea']))?"":number_format(doubleval($return['landArea']) * 0.3025 ,2);

        $return['parkingCnt'] = ($return['totPkngCnt']=="없음")?$return['totPkngCnt']:$return['totPkngCnt']."대";
        $return['ElvtCnt'] = ($return['rideUseElvtCnt']=="없음")?$return['rideUseElvtCnt']:$return['rideUseElvtCnt']."대";

        if($return['movein']!="즉시입주"){
            $arrMovein = explode(" ", $return['movein']);
            $arrYmd = explode("-", $arrMovein[0]);

            if(!empty($arrYmd[2])){
                $movein = $arrMovein[0];
            }else{
                $movein = $arrYmd[0]."년 ";
                if(!empty($arrYmd[1]))  $movein .= $arrYmd[1]."월 ";

                $movein .= @$arrMovein[1];
            }
            $return['movein'] = $movein;
        }

        $return['movein_nego'] = ($return['movein_nego']=='1')?"(협의가능)":"";

        // $bd = $data->sale->building->first();
        // $floorInfo = "";
        // $area_b = "";
        // $area_j = "";
        // if(!empty($bd)){
        //     if(intval($bd->bd_ugrndFlrCnt) > 0) $floorInfo = "B".$bd->bd_ugrndFlrCnt."/";
        //     $floorInfo .= $bd->bd_grndFlrCnt."F";

        //     // 분양, 전유면적
        //     if(!empty($bd->hos->first()->details)){
        //         $hoDetail = $bd->hos->first()->details;
        //         $area_b = number_format($hoDetail->sum('hodt_area'),2);
        //         $area_j = number_format($hoDetail->where('hodt_exposPubuseGbCdNm','전유')->value('hodt_area'),2);
        //         // debug($area_b,$area_j);
        //     }
        // }
        // $return['floorInfo'] = $floorInfo;

        $floorInfo = "";
        if(intval($data->ugrndFlrCnt) > 0) $floorInfo = "B".$data->ugrndFlrCnt."/";
        $floorInfo .= $data->grndFlrCnt."F";
        $return['floorInfo'] = $floorInfo;

        $return['sawon_idx'] = $data->sale->users->first()->sawon->idx;
        $return['sawon_photo'] = $data->sale->users->first()->sawon->mb_photo;
        $return['sawon_photo'] = (empty($return['sawon_photo']))?"/images/user-placeholder.png":"https://www.gbbinc.co.kr/_Data/Member/".$return['sawon_photo'];
        $return['sawon_name'] = $data->sale->users->first()->sawon->user_name;
        $return['sawon_duty'] = $data->sale->users->first()->sawon->info->duty;
        $return['sawon_sosok'] = $data->sale->users->first()->sawon->info->sosok;
        $return['sawon_office_line'] = $data->sale->users->first()->sawon->info->office_line;

        $return['print_data'] = formatCreatedAt2($data->reg_date);

        // 카테고리 체크용
        $return['isJugeo'] = strpos($return['category'],'주거') === 0;
        $return['isToji'] = strpos($return['category'],'토지') !== false;

        return $return;
    }

    public function todayViewSaleSetCookie($idx){
        // 현재 쿠키 값 가져오기
        $existingViewedSales = (empty($_COOKIE['viewed_intra_sales']))?[]:json_decode($_COOKIE['viewed_intra_sales'], true);
        debug($existingViewedSales);
        if(!in_array($idx, $existingViewedSales)){
            // 새로운 매물 키를 배열에 추가 (맨 앞으로)
            array_unshift($existingViewedSales, $idx);

            // 배열을 JSON으로 다시 인코딩하고 쿠키 설정
            setcookie("viewed_intra_sales", json_encode($existingViewedSales), time()+3600);
        }
    }

    public function getTodayViewSales(){
        if(empty($_COOKIE['viewed_intra_sales'])){
            return null;
        }else{
            $arrIdx = json_decode($_COOKIE['viewed_intra_sales'],true);
            
            $data = IntraSaleHomepage::whereIn('idx', $arrIdx)
                ->orderByRaw("FIELD(idx, " . implode(',', $arrIdx) . ")")   // 쿠키값 순서대로
                ->get();

            return $data;
        }
    }

    // 지도 url
    public function getMapUrl($localX, $localY){
        $kko_xy = (new KakaoApiClass)->getKKOTranscoord($localX, $localY);

        $x = intval($kko_xy["documents"][0]["x"]);
		$y = intval($kko_xy["documents"][0]["y"]);

        return "https://www.gbbinc.co.kr/Share/map.php?x=".$x."&y=".$y."&w=720&h=400";
    }

    // 근처시설
    public function getNearInfra($x, $y){

        // MT1	대형마트
        // CS2	편의점
        // PS3	어린이집, 유치원
        // SC4	학교
        // AC5	학원
        // PK6	주차장
        // OL7	주유소, 충전소
        // SW8	지하철역
        // BK9	은행
        // CT1	문화시설
        // AG2	중개업소
        // PO3	공공기관
        // AT4	관광명소
        // AD5	숙박
        // FD6	음식점
        // CE7	카페
        // HP8	병원
        // PM9	약국
        $clsKkoApi = new KakaoApiClass;

        $r_data['category'] = 'SC4';
        $r_data['x'] = $x;
        $r_data['y'] = $y;
        $r_data['radius'] = 2000; // 반경 00m
        $r_data['size'] = 5;

        $response = $clsKkoApi->getLocalSearchCategory($r_data);
        $data['교육시설'] = $response['documents'];

        $r_data['category'] = 'MT1,HP8';
        $response = $clsKkoApi->getLocalSearchCategory($r_data);
        $data['주변시설'] = $response['documents'];

        $r_data['category'] = 'SW8';
        $response = $clsKkoApi->getLocalSearchCategory($r_data);
        $data['교통정보'] = $response['documents'];

        return $data;
    }
}