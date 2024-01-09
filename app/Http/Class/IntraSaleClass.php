<?php

namespace App\Http\Class;

use App\Http\Class\lib\FileClass;
use App\Models\Sale;
use App\Models\CommonCode;
use App\Models\UserSaleFavorite;
use App\Models\IntraSaleHomepage;
use Illuminate\Support\Facades\DB;
use App\Http\Class\lib\ResultClass;
use App\Http\Class\lib\KakaoApiClass;
use App\Models\IntraSale;
use Illuminate\Support\Facades\Session;
use DragonCode\Contracts\Cashier\Http\Request;

// 매물관련 클래스

class IntraSaleClass{

    public function __construct()
    {
        
    }

    public function getListData($request, $itemNum=6){
        $data = $request->all();
        if(empty($data) && !empty($_COOKIE["filter_condition"])){
            $data = json_decode($_COOKIE["filter_condition"], true);
        }else{
            // 검색조건 저장 쿠키
            $cookie = $data;
            unset($cookie['_token'],$cookie['page']);
            setcookie("filter_condition", json_encode($cookie), time()+3600);
        }
        
        $model = IntraSaleHomepage::where(['isDel'=>0, 'isDone'=>1]);
        if($request['mode']=="recommend"){
            $model = $model->where('isRecom',1);
        }else{

            // 필터조건 s ///////////////////////////////////////////////////////////
            // 유형
            if(!empty($data['cate2'])){
                $model->where('category_id', $data['cate2']);
            }elseif(!empty($data['cate1'])){
                $clsCode = new CommonCodeClass;
                $result = $clsCode->getDescendants($data['cate1']);

                $responsData = $result->getData();
                foreach($responsData as $_dt){
                    $inCateId[] = $_dt['id'];
                }
                
                $model->whereIn('category_id', $inCateId);
            }

            // 거래종류
            if(!empty($data['tradeType'])){
                $model->where('tradeType', $data['tradeType']);
            }

            // 지역
            if(!empty($data['location'])){
                $model->where('addr', 'like', '%'.$data['location'].'%');
            }

            // 가격
            if(!empty($data['fromPrice'])){
                $model->whereRaw('GREATEST(salePrice*1, depPrice*1) >= ' . str_replace(',','',$data['fromPrice']));
            }
            if(!empty($data['toPrice'])){
                $model->whereRaw('GREATEST(salePrice*1, depPrice*1) <= ' . str_replace(',','',$data['toPrice']));
            }

            // 거래면적
            if(!empty($data['fromArea'])){
                $fromArea = str_replace(',','',$data['fromArea']);
                $model->whereRaw('GREATEST(landArea*1,bdArea*1,area_b*1) >= ' . $fromArea);
            }
            if(!empty($data['toArea'])){
                $toArae = str_replace(',','',$data['toArea']);
                // if($data['area_unit']=='p'){
                //     $fromArea = $fromArea * 3.305785;
                //     $toArae = $toArae * 3.305785;
                // }
                $model->whereRaw('GREATEST(landArea*1,bdArea*1,area_b*1) <= ' . $toArae);
            }
            // 필터조건 e ///////////////////////////////////////////////////////////
        }

        if($request['mode']=="recommend"){
            $model->orderBy('recom_date','desc')->orderBy('reg_date','desc');
        }elseif(!empty($data['sort'])){
            $arrSort = explode("|", $data['sort']);
            if(empty($arrSort[1])) $arrSort[1] = 'asc';

            if($arrSort[0]=="salePrice"){
                $model->orderByRaw("cast(salePrice as UNSIGNED) ".$arrSort[1]);
            }else{
                $model->orderBy($arrSort[0],$arrSort[1]);
            }
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
        $clsFile = new FileClass();

        $return = $data->toArray();

        // 거래완료 여부
        $return['is_soldout'] = (strpos($data->sale->_options, 'COC')!==false);

        // 수익률 계산 : (월세 * 12) / (매매가격 - 보증금)
        $return['rate'] = (intval($data->monPrice_st)==0)?0:round(((($data->monPrice_st * 12) / ($data->salePrice - $data->depPrice_st)) * 100), 2);


        $return['saleTypeFull'] = $data->saleTypeTxt;
        $return['saleType'] = trim(explode(">",$data->saleTypeTxt)[1]);        

        $return['categoryFull'] = $data->category;
        $return['category'] = trim(explode(">",$data->category)[1]);        

        if($data->tradeType=="임대"){
            $return['price'] = number_format($data->depPrice)." / ".number_format($data->monPrice);
        }else{
            $return['price'] = number_format($data->salePrice);
        }

        $return['imgs'] = [];
        foreach($data->files as $_img){
            // $return['imgs'][] = env('intranet_domain')."/_Data/Homepage/".$_img->filename;
            $return['imgs'][] = $clsFile->mkThumbnailFromUrl(env('INTRANET_DOMAIN')."/_Data/Homepage/".$_img->filename, 730, 430);
        }
        if(count($return['imgs'])==0){
            $return['imgs'][] = "/images/noimg.jpg";
        }
        // $return['imgs'][] = "/images/noimg.jpg";


        // 리스트이미지 썸네일
        $return['img'] = "/images/noimg.jpg";
        $return['img2'] = "/images/noimg.jpg";
        if(!empty($data->files->first()->filename)){
            $return['img'] = $clsFile->mkThumbnailFromUrl(env('intranet_domain')."/_Data/Homepage/".$data->files->first()->filename, 250, 150);
            $return['img2'] = $clsFile->mkThumbnailFromUrl(env('intranet_domain')."/_Data/Homepage/".$data->files->first()->filename, 250, 190);
        }

        $arrAddr = explode("|",$data->addr);
        $arrAddress = explode(" ", $arrAddr[0]);
        $addr = trim($arrAddress[0])." ".trim($arrAddress[1])." ".trim($arrAddress[2]);
        if(count($arrAddr)>1) $addr .= " 외 ".(count($arrAddr) -1)."필지";
        $return['address'] = $addr;

        $return['bdArea_py'] = (empty($return['bdArea']))?"":number_format(doubleval($return['bdArea']) * 0.3025 ,2);
        $return['bdArea'] = (empty($return['bdArea']))?"":number_format($return['bdArea'],2);
        
        $return['landArea_py'] = (empty($return['landArea']))?"":number_format(doubleval($return['landArea']) * 0.3025 ,2);
        $return['landArea'] = (empty($return['landArea']))?"":number_format($return['landArea'],2);
        

        $return['area_b_py'] = (empty($return['area_b']))?"":number_format(doubleval($return['area_b']) * 0.3025 ,2);
        $return['area_j_py'] = (empty($return['area_j']))?"":number_format(doubleval($return['area_j']) * 0.3025 ,2);

        if($return['area_j']) $return['areaRate'] = round(($return['area_j'] / $return['area_b']) * 100,2);   //전용율

        $return['parkingCnt'] = ($return['totPkngCnt']=="없음")?$return['totPkngCnt']:number_format(intval($return['totPkngCnt']))." 대";
        $return['ElvtCnt'] = ($return['rideUseElvtCnt']=="없음")?$return['rideUseElvtCnt']:$return['rideUseElvtCnt']." 대";

        if(!$return['direction_gijun']) $return['direction_gijun'] = "출입구 기준";

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

        $return['useAprDay'] = ($return['useAprDay'])?$return['useAprDay']:"확인불가";

        $return["households"] = ($return['households']=="해당없음")?$return['households']:number_format(intval($return['households']))." 세대";

        $return["print_mngPrice"] = ($return['mngPrice']=="없음")?$return['mngPrice']:number_format(intval($return['mngPrice'])) . "원 <small class='f-10'>(".str_replace("|",", ",$return['mngPriceOpt']).")</small>";
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

        // 리스트 층 정보
        $floorInfo = "";
        if(intval($return['ugrndFlrCnt']) > 0) $floorInfo = "B".$return['ugrndFlrCnt']."/";
        $floorInfo .= $return['grndFlrCnt']."F";
        $return['floorInfo'] = $floorInfo;

        $return['description_1'] = "";
        $return['description_2'] = "";
        $return['description_3'] = "";
        $return['description_arr'] = explode("\n",$return['description']);
        foreach($return['description_arr'] as $i=>$_txt){
            if($i<=1)   $return['description_1'] .= "<p>".$_txt."</p>";
            else    $return['description_3'] .= "<p>".$_txt."</p>";
            if($i > 1 && $i <= 4)   $return['description_2'] .= $_txt;
        }

        

// dd('중개사정보',$data->sale->users->first()->sawon->user_name);
        $return['sawon_idx'] = $data->sale->users->first()->sawon->idx;
        $return['sawon_user_id'] = $data->sale->users->first()->sawon->user_id;
        $return['sawon_photo'] = $data->sale->users->first()->sawon->mb_photo;
        $return['sawon_photo'] = (empty($return['sawon_photo']))?"/images/sawon-placeholder.png":env('INTRANET_DOMAIN')."/_Data/Member/".$return['sawon_photo'];
        $return['sawon_name'] = $data->sale->users->first()->sawon->user_name;
        $return['sawon_duty'] = @$data->sale->users->first()->sawon->info->duty;
        $return['sawon_chkcert'] = @$data->sale->users->first()->sawon->info->chkcert;
        $return['sawon_sosok'] = @$data->sale->users->first()->sawon->info->sosok;
        // $return['sawon_sosok'] = str_replace('소속','',$return['sawon_sosok']);
        $return['sawon_office_line'] = @$data->sale->users->first()->sawon->info->office_line;

        $return['radmin_photo'] = "/images/sawon-placeholder.png";
        $return['radmin_name'] = "부동산중개법인개벽";
        $return['radmin_duty'] = "";
        $return['radmin_sosok'] = "";
        $return['radmin_office_line'] = "";

        $return['print_data'] = formatCreatedAt2($data->reg_date);

        $cateInfo = CommonCodeClass::getData($return['category_id']);
        $return['category_class'] = $cateInfo->class;

        if($return['category_class']=="mall" || $return['category_class']=="home"){
            // 리스트 층정보
            $return['floorInfo'] = $return['currFloor'] . " / " . $return['totFloor'] .'층';

            $optCodes = CommonCodeClass::getChildrenTreeFormFirstCodeText('매물옵션정보');
            $options = explode("|",$return['options']);
            
            foreach($optCodes as $_k=>$_opt){
                foreach($_opt as $__v){
                    $optTxt = explode("|",$__v)[0];
                    if(in_array($optTxt, $options)) $return['optCodes'][$_k][] = $optTxt;
                }
            }
        }

        // 카테고리 체크용
        $return['isJugeo'] = strpos($return['category'],'주거') === 0;
        $return['isToji'] = strpos($return['category'],'토지') !== false;
        $return['isSangeop'] = !$return['isToji'] && strpos($return['category'],'상업') === 0;

        $favorites = (new IntraSaleClass)->getFavorites();
        if($favorites->isSuccess() && in_array($return['idx'], $favorites->getData())) $return['isFavorite'] = true;

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
            setcookie("viewed_intra_sales", json_encode($existingViewedSales), time()+3600, '/');
        }
    }

    public function getTodayViewSales(){
        if(empty($_COOKIE['viewed_intra_sales'])){
            return ResultClass::fail('최근 본 매물이 없습니다.');
        }else{
            $arrIdx = json_decode($_COOKIE['viewed_intra_sales'],true);
            
            $data = IntraSaleHomepage::whereIn('idx', $arrIdx)
                ->orderByRaw("FIELD(idx, " . implode(',', $arrIdx) . ")")   // 쿠키값 순서대로
                ->get();

            return ResultClass::success('',$data);
        }
    }

    // 지도 url
    public function getMapUrl($localX, $localY){
        $kko_xy = (new KakaoApiClass)->getKKOTranscoord($localX, $localY);

        $x = intval($kko_xy["documents"][0]["x"]);
		$y = intval($kko_xy["documents"][0]["y"]);

        return env('INTRANET_DOMAIN')."?x=".$x."&y=".$y."&w=720&h=400";
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
        $r_data['radius'] = 1000; // 반경 00m
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

    // 관심매물처리
    public function addFavorite($request){
        $data = $request->all();

        if(!auth()->check()){
            $result = ResultClass::fail('로그인 후 이용하세요.');
        }else{
            if($data['flag']=="add"){
                $response = UserSaleFavorite::create([
                    'user_id' => auth()->user()->id,
                    'sale_id' => $data['id'],
                ]);
                if($response->id)   $result = ResultClass::success('관심매물로 담겼습니다.');
                else            $result = ResultClass::fail('관심매물 처리 실패했습니다. 관리자에게 문의하세요.');
            }else{
                $response = UserSaleFavorite::where([
                    'user_id' => auth()->user()->id,
                    'sale_id' => $data['id'],
                ])->delete();
                if($response)   $result = ResultClass::success('관심매물 해제 되었습니다.');
                else            $result = ResultClass::fail('관심매물 처리 실패했습니다. 관리자에게 문의하세요.');
            }
        }

        return $result;
    }

    // 관심매물 ids
    public function getFavorites(){
        if(!auth()->check()) return ResultClass::fail('');

        $data = UserSaleFavorite::where('user_id', auth()->user()->id)->get();
        $ids = [];
        foreach($data as $_dt)  $ids[] = $_dt->sale_id;

        return ResultClass::success('', $ids);
    }

    // 관심매물 데이터
    public function getFavoritesData(){
        $data = [];
        $favorites = $this->getFavorites();
        if($favorites->isSuccess()){
            $ids = $favorites->getData();
            $respons_data = IntraSaleHomepage::where(['isDel'=>0, 'isDone'=>1])
                ->whereIn('idx', $ids)->get();

            foreach($respons_data as $_dt){
                $data[] = $this->getPrintData($_dt);
            }

            return ResultClass::success('',$data);
        }else{
            return $favorites;
        }
    }

    // 관련매물
    /*
        관련매물 조건정리

        상업용 매물
        매물유형 ≥ 매매가격 ≥ 지역(소재지) ≥ 용도지역(토지) ≥ 사용승인일(최근순) ≥ 수익율 > 이하 같은 매물유형 중 클릭수 많은 매물

        주거용 매물 
        매물유형 ≥ 매매가격 ≥ 지역(소재지) ≥ 방갯수 ≥ 사용승인일(최근순) > 이하 같은 매물유형 중 클릭수 많은 매물

        토지 매물
        매물유형 ≥ 매매가격 ≥ 지역(소재지) ≥ 용도지역(토지) ≥ 이하 같은 매물유형 중 클릭수 많은 매물

        기타의 경우
        매매가격 ≥ 지역(소재지) ≥ 용도지역(토지) ≥ 면적(330㎡ 범위내) > 이하 클릭수 많은 매물

        예외처리
        매물유형에 관계없이 클릭수가 많은 매물



        매매가격 범위(기준이 되는 물건의 3.3㎡당 가격 ±100만원) 
        |
        지역(같은 동 기준)
        |
        용도지역(같은 용도지역 기준)
        |
        사용승인일(기준이 되는 물건의 ±1년)
    */
    public function getRelatedSales($sale){
        $arrCategory = explode(" > ", $sale['category']);
        $arrAddress = explode(" ", $sale['address']);
        $addr3 = $arrAddress[0] . " " . $arrAddress[1] . " " . $arrAddress[2];
        $addr2 = $arrAddress[0] . " " . $arrAddress[1];
        $addr1 = $arrAddress[0];

        // 평당가격 쿼리
        $qry['price_per_py'] = "round(case when category like '%분양상가' then salePrice / (area_b / 3.3) else salePrice / (landArea / 3.3) end)";

        $model = IntraSaleHomepage::where('idx','!=',$sale['idx'])
            ->orderByRaw("case when category = '" .$sale['category']. "' then 0 when category like '" .$arrCategory[0]. "%' then 1 else 2 end"); // 매물유형조건
        
        if($sale['tradeType']=="임대"){
            
        }else{
            $model->orderByRaw("abs(".$qry['price_per_py']." - ".$sale['salePrice'].")");
        }

        $model->orderByRaw("case when SUBSTRING_INDEX(addr, ' ', 3) = '" .$addr3. "' then 0 when SUBSTRING_INDEX(addr, ' ', 2) = '" .$addr2. "' then 1 when SUBSTRING_INDEX(addr, ' ', 1) = '" .$addr1. "' then 2 else 3 end");    // 소재지 조건

        $data = $model->take(4)
            ->get();

        // debug($sale);
        debug($data);

        return $data;
    }

    // 최고가격, 최고면적
    public function getMaxPriceNArea(){
        $data = DB::connection('mysql_intranet')
        ->table('CS_SALE_HOMEPAGE')
        ->where(['isDel'=>0, 'isDone'=>1])
        ->select(DB::raw('round(MAX(greatest(salePrice*1,depPrice*1))) as maxPrice'), DB::raw('round(MAX(greatest(landArea*1,bdArea*1,area_b*1))) as maxArea'))
        ->first();

        return $data;
    }

    // 메인 신규매물
    public function mainNewSales(){
        $model = IntraSaleHomepage::where(['isDel'=>0, 'isDone'=>1])->orderBy('reg_date','desc')
            ->whereHas('sale', function($query){
                $query->whereRaw("instr(ifnull(_options,''),'COC') IS false");
            })->limit(6)->get();
        return $model;
    }

    // 메인 구역별 매물수
    public function mainLocalSaleCount(){
        $model = IntraSaleHomepage::where(['isDel'=>0, 'isDone'=>1])
            ->select(DB::raw("sum(case when addr like '%동래구%' then 1 else 0 end ) as 동래구"), 
                    DB::raw("sum(case when addr like '%해운대구%' then 1 else 0 end ) as 해운대구"), 
                    DB::raw("sum(case when addr like '%수영구%' then 1 else 0 end ) as 수영구"), 
                    DB::raw("sum(case when addr like '%부산진구%' then 1 else 0 end ) as 부산진구")
            )
            ->first();

        return $model;
    }

    // 메인 추천매물
    public function mainRecommendSales(){
        $model = IntraSaleHomepage::where(['isDel'=>0, 'isDone'=>1])
            ->where('isRecom',1)
            ->whereHas('sale', function($query){
                $query->whereRaw("instr(ifnull(_options,''),'COC') IS false");
            })
            ->orderBy('reg_date','desc')
            ->limit(2)->get();

        return $model;
    }
}