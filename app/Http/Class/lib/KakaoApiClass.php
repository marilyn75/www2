<?php

namespace App\Http\Class\lib;

// 카카오 api 관련 클래스

class KakaoApiClass{
    private $apikey = "d94f8fc57c58ba7de8e6485359df4031";
    private $headers; 

    public function __construct()
    {
        $this->headers = array('Authorization: KakaoAK '.$this->apikey);
    }

    private function resCurl($R_DATA){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $R_DATA["url"]);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		if($R_DATA["header"])	curl_setopt($ch, CURLOPT_HTTPHEADER, $R_DATA["header"]);
		curl_setopt($ch, CURLOPT_TIMEOUT,300);
		$response = curl_exec($ch);
		$curl_info = curl_getinfo($ch);
		if($curl_info["http_code"]!="200"){
			return array("meta"=>array("result_code"=>"e_curl", "response"=>$response));
			print_r($response); 
			print_r(curl_getinfo($ch)); //모든정보 출력
			echo curl_errno($ch); //에러정보 출력
			echo curl_error($ch); //에러정보 출력
			exit;
		}

		curl_close($ch);
		
		return $response;
	}

    public function getKKOTranscoord($localX, $localY){
        $ch = curl_init();
		$x =  curl_escape($ch ,$localX);
		$y =  curl_escape($ch ,$localY);
		$url = "http://dapi.kakao.com/v2/local/geo/transcoord.json?x={$x}&y={$y}&input_coord=WGS84&output_coord=WCONGNAMUL";
		$headers = $this->headers;

		$R_DATA["url"] = $url;
		$R_DATA["header"] = $headers;

		$data = $this->resCurl($R_DATA);
		return json_decode($data, true);
    }

    // 카테고리로 장소 검색하기
    public function getLocalSearchCategory($r_data){
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
        $url = "https://dapi.kakao.com/v2/local/search/category.json";
        $headers = $this->headers;
        $params['category_group_code'] = $r_data['category'];
        $params['x'] = $r_data['x'];
        $params['y'] = $r_data['y'];
        $params['radius'] = $r_data['radius'];
        // $params['page'] = $r_data['page'];
        $params['size'] = $r_data['size'];
        // $params['sort'] = $r_data['sort'];   // distance 또는 accuracy (기본값: accuracy)
        $queryString = http_build_query($params);
        $url .= "?".$queryString;

        $R_DATA["url"] = $url;
		$R_DATA["header"] = $headers;

		$data = $this->resCurl($R_DATA);
		return json_decode($data, true);
    }

    // 주소검색
    public function getAddr($query){
        $url = "https://dapi.kakao.com/v2/local/search/address.json";
        $headers = $this->headers;
        $params['query'] = $query;
        
        $queryString = http_build_query($params);
        $url .= "?".$queryString;

        $R_DATA["url"] = $url;
		$R_DATA["header"] = $headers;

		$data = $this->resCurl($R_DATA);
		return json_decode($data, true);
    }
}