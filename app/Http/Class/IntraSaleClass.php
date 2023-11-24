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
            $arrSort = explode(" ", $data['sort']);
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
        $addr = trim($arrAddr[0]);
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

        $return['sawon_photo'] = $data->sale->users->first()->sawon->mb_photo;
        $return['sawon_photo'] = (empty($return['sawon_photo']))?"/images/user-placeholder.png":"https://www.gbbinc.co.kr/_Data/Member/".$return['sawon_photo'];
        $return['sawon_name'] = $data->sale->users->first()->sawon->user_name;
        $return['sawon_duty'] = $data->sale->users->first()->sawon->info->duty;
        $return['sawon_sosok'] = $data->sale->users->first()->sawon->info->sosok;
        $return['sawon_office_line'] = $data->sale->users->first()->sawon->info->office_line;

        $return['print_data'] = formatCreatedAt2($data->reg_date);

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
}