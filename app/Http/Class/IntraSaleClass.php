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
        $data = IntraSaleHomepage::find($idx)->sale;
        $arrAddr = explode(",", $data->_addr);
        $data->printAddr = $arrAddr[0];

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

        $return['img'] = (empty($data->files->first()->filename))?"/images/noimg.jpg":"http://test.gbbinc.co.kr/_Data/Homepage/".$data->files->first()->filename;

        $arrAddr = explode("|",$data->addr);
        $addr = trim($arrAddr[0]);
        if(count($arrAddr)>1) $addr .= " 외 ".(count($arrAddr) -1)."필지";
        $return['address'] = $addr;

        $return['bdArea'] = (empty($return['bdArea']))?"":number_format($return['bdArea'],2);
        $return['landArea'] = number_format($return['landArea'],2);

        $bd = $data->sale->building->first();
        $floorInfo = "";
        $area_b = "";
        $area_j = "";
        if(!empty($bd)){
            if(intval($bd->bd_ugrndFlrCnt) > 0) $floorInfo = "B".$bd->bd_ugrndFlrCnt."/";
            $floorInfo .= $bd->bd_grndFlrCnt."F";

            // 분양, 전유면적
            if(!empty($bd->hos->first()->details)){
                $hoDetail = $bd->hos->first()->details;
                $area_b = number_format($hoDetail->sum('hodt_area'),2);
                $area_j = number_format($hoDetail->where('hodt_exposPubuseGbCdNm','전유')->value('hodt_area'),2);
                // debug($area_b,$area_j);
            }
        }
        $return['floorInfo'] = $floorInfo;

        $return['sawon_photo'] = $data->sale->users->first()->sawon->mb_photo;
        $return['sawon_photo'] = (empty($return['sawon_photo']))?"/images/user-placeholder.png":"https://www.gbbinc.co.kr/_Data/Member/".$return['sawon_photo'];
        $return['sawon_name'] = $data->sale->users->first()->sawon->user_name;
        $return['sawon_duty'] = $data->sale->users->first()->sawon->info->duty;
        $return['sawon_sosok'] = $data->sale->users->first()->sawon->info->sosok;

        $return['print_data'] = formatCreatedAt2($data->reg_date);

        debug($data->sale->users->first()->sawon);

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