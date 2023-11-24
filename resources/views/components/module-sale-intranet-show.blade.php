<script>
    $(window).on('load',function(){
        $('.owl-dot').each(function(index) {
            
            var imageUrl = $(".single_product_grid .img-fluid").eq(index+2).attr('src');
            $(this).find('span').css('background-image', 'url(' + imageUrl + ')');
        });
    });
</script>
<div class="col-lg-8">
    <div class="single_product_grid row single_product_grid_w">
        <div class="@if(count($printData['imgs'])>1) single_product_slider @endif col-sm-6 col-md-6 col-lg-6 pl0 pr0 single_product_slider_w">
            @foreach ($printData['imgs'] as $_img)
            <div class="item">
                <div class="sps_content">
                    <div class="thumb">
                        <div class="single_product">
                            <div class="single_item">
                                <div class="thumb"><img class="img-fluid" src="{{ $_img }}"></div>
                            </div>
                            <a class="product_popup popup-img" href="{{ $_img }}">
                                <i class="ri-zoom-in-line"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 detail_top_inf">
            <div class="sps_content">
                <div class="content">
                    <div class="shop_single_product_details">
                        <div class="tag detail_t_tag">{{ $printData['tradeType'] }}</div>
                        <div>
                            <div>
                                <div class="tag detail_type">{{ $printData['category'] }}</div>
                                <h4 class="title">{{ $printData['address'] }}</h4>
                            </div>
                            <div class="detail_price mb15"><span class="mont">{{ $printData['price'] }}</span> 만원</div>
                        </div>

                        <ul class="list_details list_details_w">
                            <li><a href="#"><i class="ri-checkbox-circle-line"></i> {{ $printData['prposAreaNm'] }}</a></li>
                            @if(!empty($printData['area_b']))
                            <li><a href="#"><i class="ri-checkbox-circle-line"></i> 분양{{ $printData['area_b'] }}㎡ 전유{{ $printData['area_j'] }}㎡ </a></li>
                            @else
                            <li><a href="#"><i class="ri-checkbox-circle-line"></i> 토지면적
                                    {{ $printData['landArea'] }}㎡</a></li>
                            @if (strpos($data->saleTypeTxt,"토지")===false)
                            <li><a href="#"><i class="ri-checkbox-circle-line"></i> 연면적 {{ $printData['bdArea'] }}㎡</a>
                            </li>
                            @endif
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Agent Single Grid View -->
    <section class="our-agent-single bgc-f7 pb30-991">
        <div class="container container_w">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="row">
                        <div class="col-lg-12 pl-0 pr-0">
                            <div class="listing_single_description description_w">
                                <h4 class="mb20">상세내용</h4>

                                <p class="mb25">
                                    {!! nl2br($printData['description']) !!}
                                </p>
                                
                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body">
                                        <p class="mt10 mb10">
                                            대중교통 이용이 편리한 단지에요. 단지 정문에서 도보로 1분 거리에 마을버스정류장이 있어서 동네
                                            곳곳을 편리하게 이동할 수 있습니다. 그리고 도보 1분 거리에 할인마트가 있어서 여러가지 물건들과
                                            식품들을 합리적이고 가성비 좋은 가격에 구입할 수 있어요.

                                            또한 주변으로 학군이 형성되어 있는 단지에요. 도보 10분 거리 이내에 금사중학교,
                                            금정전자공업고등학교, 부산경호고등학교가 있어서 학교 선택의 폭이 넓습니다. 그리고 단지와 거리가
                                            가까워서 학생들의 통학이 아주 편리하다는 장점도 있어요. 그리고 주변 녹지환경도 좋습니다. 도보
                                            10분 거리에 등산로가 있어서 날 좋은 휴일에 편하게 등산을 할 수 있어요.

                                            대중교통이 편리하고 조용한 분위기의 단지이기 때문에 노년층 분들께 추천할만 한 단지입니다.
                                        </p>
                                    </div>
                                </div>
                                <p class="overlay_close">
                                    <a class="text-thm fz14 text-thm_w" data-toggle="collapse" href="#collapseExample"
                                        role="button" aria-expanded="false" aria-controls="collapseExample">
                                        더보기 <i class="ri-arrow-down-s-line"></i>
                                    </a>
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-12 pl-0 pr-0">
                            <div class="additional_details additional_w">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h4 class="mb10">매물정보</h4>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <ul class="list-inline-item detail_list">
                                            <li>
                                                <p>매물유형 :</p>
                                                <p>{{ $printData['category'] }}</p>
                                            </li>
                                            <li>
                                                <p>지목 :</p>
                                                <p>{{ $printData['lndcgrCodeNm'] }}</p>
                                            </li>
                                            @if(!empty($printData['area_b']))
                                            <li>
                                                <p>분양/전유면적 :</p>
                                                <p class="mont">{{ $printData['area_b'] }}㎥ ({{ $printData['bdArea_py'] }}p) / {{ $printData['area_j'] }}㎥ ({{ $printData['bdArea_py'] }}p)</p>
                                            </li>
                                            @else
                                            <li>
                                                <p>연면적 :</p>
                                                <p class="mont">{{ $printData['bdArea'] }}㎥ ({{ $printData['bdArea_py'] }}p)</p>
                                            </li>
                                            @endif
                                            
                                            <li>
                                                <p>주구조 :</p>
                                                <p>{{ $printData['strctCdNm'] }}</p>
                                            </li>
                                            <li>
                                                <p>주차시설 :</p>
                                                <p>주차 {{ $printData['parkingCnt'] }}</p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <ul class="list-inline-item detail_list">
                                            <li>
                                                <p>대지면적 :</p>
                                                <p class="mont">{{ $printData['landArea'] }}㎥ ({{ $printData['landArea_py'] }}p)</p>
                                            </li>
                                            <li>
                                                <p>용도지역 :</p>
                                                <p>{{ $printData['prposAreaNm'] }}</p>
                                            </li>
                                            <li>
                                                <p>건물용도 :</p>
                                                <p>{{ $printData['mainPurpsCdNm'] }}</p>
                                            </li>
                                            <li>
                                                <p>규모 :</p>
                                                <p>지하 {{ $printData['ugrndFlrCnt'] }}층 / 지상 {{ $printData['grndFlrCnt'] }}층</p>
                                            </li>
                                            <li>
                                                <p>승강기 :</p>
                                                <p>승강기 {{ $printData['ElvtCnt'] }}</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="additional_details additional_w">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h4 class="mb10">추가설명</h4>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <ul class="list-inline-item detail_list">
                                            <li>
                                                <p>사용승인일 :</p>
                                                <p class="mont">{{ $printData['UseAprDay'] }}</p>
                                            </li>
                                            <li>
                                                <p>입주정보 :</p>
                                                <p>{{ $printData['movein'] }} {{ $printData['movein_nego'] }}</p>
                                            </li>
                                            <li>
                                                <p>월관리비 :</p>
                                                <p>관리비 없음</p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <ul class="list-inline-item detail_list">
                                            <li>
                                                <p>방향 :</p>
                                                <p>{{ $printData['direction'] }}향</p>
                                            </li>
                                            <li>
                                                <p>방 / 화장실 :</p>
                                                <p>방 {{ $printData['room_num'] }}개 / 욕실 {{ $printData['restroom_num'] }}개</p>
                                            </li>
                                            <li>
                                                <p>난방방식 :</p>
                                                <p>개별난방</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="additional_details additional_w">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h4 class="mb10">가격정보</h4>
                                    </div>

                                    @if ($printData['tradeType']=="매매")

                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <ul class="list-inline-item detail_list">
                                            <li>
                                                <p>매매가격 :</p>
                                                <p>매매 <span class="mont">{{ $printData['price'] }}</span>만원</p>
                                            </li>
                                            <li>
                                                <p>융자금 :</p>
                                                <p>{{ (empty($printData['loanPrice']))?"없음":$printData['loanPrice']."만원"; }}</p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <ul class="list-inline-item detail_list">
                                            <li>
                                                <p>월세현황 :</p>
                                                <p>보증금 {{ $printData['depPrice_st'] }}만원 / 월세 {{ $printData['monPrice_st'] }}만원</p>
                                            </li>
                                            <li>
                                                <p>예상 수익률 :</p>
                                                <p class="mont">1.11%</p>
                                            </li>
                                        </ul>
                                    </div>

                                    @else

                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <ul class="list-inline-item detail_list">
                                            <li>
                                                <p>보증금 :</p>
                                                <p><span class="mont">{{ $printData['depPrice'] }}</span>만원</p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <ul class="list-inline-item detail_list">
                                            <li>
                                                <p>월세 :</p>
                                                <p><span class="mont">{{ $printData['monPrice'] }}</span>만원</p>
                                            </li>
                                        </ul>
                                    </div>
                                
                                    @endif
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 pl-0 pr-0">
                            <div class="application_statics mt30 application_w">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h4 class="mb15">생활시설</h4>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-3">
                                        <ul class="order_list list-inline-item order_list_w">
                                            <li>
                                                <a href="#">
                                                    <i class="ri-checkbox-line"></i>
                                                    <p>침대</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="ri-checkbox-line"></i>
                                                    <p>식탁</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="ri-checkbox-line"></i>
                                                    <p>세탁기</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="ri-checkbox-line"></i>
                                                    <p>비데</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="ri-checkbox-line"></i>
                                                    <p>TV</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-3">
                                        <ul class="order_list list-inline-item order_list_w">
                                            <li>
                                                <a href="#">
                                                    <i class="ri-checkbox-line"></i>
                                                    <p>책상</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="ri-checkbox-line"></i>
                                                    <p>쇼파</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="ri-checkbox-line"></i>
                                                    <p>건조기</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="ri-checkbox-line"></i>
                                                    <p>싱크대</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="ri-checkbox-line"></i>
                                                    <p>레인지</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-3">
                                        <ul class="order_list list-inline-item order_list_w">
                                            <li>
                                                <a href="#">
                                                    <i class="ri-checkbox-line"></i>
                                                    <p>옷장</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="ri-checkbox-line"></i>
                                                    <p>신발장</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="ri-checkbox-line"></i>
                                                    <p>샤워부스</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="ri-checkbox-line"></i>
                                                    <p>식기세척기</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="ri-checkbox-line"></i>
                                                    <p>전자레인지</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-3">
                                        <ul class="order_list list-inline-item order_list_w">
                                            <li>
                                                <a href="#">
                                                    <i class="ri-checkbox-line"></i>
                                                    <p>붙박이장</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="ri-checkbox-line"></i>
                                                    <p>냉장고</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="ri-checkbox-line"></i>
                                                    <p>욕조</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="ri-checkbox-line"></i>
                                                    <p>가스레인지</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="ri-checkbox-line"></i>
                                                    <p>가스오픈</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 pl-0 pr-0">
                            <div class="application_statics mt30 application_w">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h4 class="mb15">보안시설</h4>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-3">
                                        <ul class="order_list list-inline-item order_list_w">
                                            <li>
                                                <a href="#">
                                                    <i class="ri-checkbox-line"></i>
                                                    <p>경비원</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="ri-checkbox-line"></i>
                                                    <p>cctv</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-3">
                                        <ul class="order_list list-inline-item order_list_w">
                                            <li>
                                                <a href="#">
                                                    <i class="ri-checkbox-line"></i>
                                                    <p>비디오폰</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="ri-checkbox-line"></i>
                                                    <p>사설경비</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-3">
                                        <ul class="order_list list-inline-item order_list_w">
                                            <li>
                                                <a href="#">
                                                    <i class="ri-checkbox-line"></i>
                                                    <p>인터폰</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="ri-checkbox-line"></i>
                                                    <p>현관보안</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-3">
                                        <ul class="order_list list-inline-item order_list_w">
                                            <li>
                                                <a href="#">
                                                    <i class="ri-checkbox-line"></i>
                                                    <p>카드키</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="ri-checkbox-line"></i>
                                                    <p>방범창</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 pl-0 pr-0">
                            <div class="application_statics mt30 application_w">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h4 class="mb15">기타시설</h4>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-3">
                                        <ul class="order_list list-inline-item order_list_w">
                                            <li>
                                                <a href="#">
                                                    <i class="ri-checkbox-line"></i>
                                                    <p>엘레베이터</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="ri-checkbox-line"></i>
                                                    <p>마당</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-3">
                                        <ul class="order_list list-inline-item order_list_w">
                                            <li>
                                                <a href="#">
                                                    <i class="ri-checkbox-line"></i>
                                                    <p>화재경보기</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="ri-checkbox-line"></i>
                                                    <p>무인택배함</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-3">
                                        <ul class="order_list list-inline-item order_list_w">
                                            <li>
                                                <a href="#">
                                                    <i class="ri-checkbox-line"></i>
                                                    <p>베란다</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-3">
                                        <ul class="order_list list-inline-item order_list_w">
                                            <li>
                                                <a href="#">
                                                    <i class="ri-checkbox-line"></i>
                                                    <p>테라스</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 pl-0 pr-0">
                            <div class="application_statics mt30 map_w">
                                <div class="map_top_w mb20">
                                    <h4>지도</h4>
                                    <p class="float-right">
                                        <i class="ri-map-pin-2-line"></i>
                                        {{ $printData['address'] }}
                                    </p>
                                </div>
                                <!-- <div class="property_video p0">
                                                        <div class="thumb">
                                                            <div class="h400" id="map-canvas"></div>
                                                            <div class="overlay_icon">
                                                                <a href="#"><img class="map_img_icon"
                                                                        src="images/header-logo.png"
                                                                        alt="header-logo.png"></a>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                <div id="map" style="width:auto;height:400px;">
                                @if (!empty($mapUrl))
                                    <img src="{{ $mapUrl }}">
                                @endif
                                </div>
                                {{-- <script type="text/javascript"
                                    src="//dapi.kakao.com/v2/maps/sdk.js?appkey=fc1139f406efd84978d1195e3a874a45">
                                </script>
                                <script>
                                var container = document.getElementById('map');
                                var options = {
                                    center: new kakao.maps.LatLng(35.1691, 129.0704),
                                    level: 3
                                };

                                var map = new kakao.maps.Map(container, options);
                                </script> --}}
                            </div>
                        </div>

                        <div class="col-lg-12 pl-0 pr-0">
                            <div class="whats_nearby mt30 nearby_w">
                                <h4 class="mb10">근처시설</h4>

                                @if(!empty($data['infra']['교육시설']))
                                <div class="education_distance mb15 education_w">
                                    <h5><i class="ri-school-line"></i> 교육시설
                                    </h5>
                                @foreach ($data['infra']['교육시설'] as $_row)
                                    <div class="single_line single_w">
                                        <p class="para">{{ $_row['place_name'] }}</p>
                                        <ul class="review">
                                            <li class="list-inline-item">
                                                <p>{{ number_format($_row['distance']) }}m</p>
                                            </li>
                                        </ul>
                                    </div>
                                @endforeach
                                </div>
                                @endif

                                @if(!empty($data['infra']['주변시설']))
                                <div class="education_distance mb15 style2 education_w">
                                    <h5><i class="ri-store-line"></i> 주변시설
                                    </h5>
                                @foreach ($data['infra']['주변시설'] as $_row)
                                    <div class="single_line single_w">
                                        <p class="para">{{ $_row['place_name'] }}</p>
                                        <ul class="review">
                                            <li class="list-inline-item">
                                                <p>{{ number_format($_row['distance']) }}m</p>
                                            </li>
                                        </ul>
                                    </div>
                                @endforeach
                                </div>
                                @endif

                                @if(!empty($data['infra']['교통정보']))
                                <div class="education_distance style3 education_w">
                                    <h5><i class="ri-bus-2-line"></i> 교통정보
                                    </h5>
                                @foreach ($data['infra']['교통정보'] as $_row)
                                    <div class="single_line single_w">
                                        <p class="para">{{ $_row['place_name'] }}</p>
                                        <ul class="review">
                                            <li class="list-inline-item">
                                                <p>{{ number_format($_row['distance']) }}m</p>
                                            </li>
                                        </ul>
                                    </div>
                                @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-12 pl-0 pr-0 similar">
                            <h4 class="mt30 mb30">관련매물</h4>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="feat_property home7 style4 bdrrn feat_property_w">
                                <div class="thumb">
                                    <img class="img-whp" src="images/property/BI1.PNG" alt="BI1.PNG">
                                    <div class="thmb_cntnt">
                                        <ul class="tag mb0">
                                            <li class="list-inline-item"><a href="#"><i class="ri-heart-3-line"></i></a>
                                            </li>
                                            <li class="list-inline-item"><a href="#"><i
                                                        class="ri-thumb-up-fill"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="details details_w">
                                    <div class="tc_content tc_content_w">
                                        <p class="text-thm">상가건물</p>
                                        <h4>최고의 선택, 밸류업</h4>
                                        <div class="text-inf-w">
                                            <p class="text-inf"><i class="ri-building-line"></i>일반상업지 1,000㎡</p>
                                            <p class="text-inf"><i class="ri-building-line"></i>B1/15F 연10,000㎡</p>
                                        </div>
                                        <p class="text-inf"><i class="ri-map-pin-2-line"></i>부산광역시
                                            해운대구 우동</p>
                                        <p class="text-thm price_w">매매 <span class="mont">1,000,000</span> 만원</p>
                                    </div>
                                    <div class="fp_footer fp_footer_w">
                                        <ul class="fp_meta float-left mb0 fp_meta_w">
                                            <li class="list-inline-item"><a href="#"><img src="images/property/AI4.PNG"
                                                        alt="AI4.PNG"></a></li>
                                            <li class="list-inline-item"><a href="#">(주)부동산중개법인개벽</a></li>
                                        </ul>
                                        <p class="fp_pdate mont">1 day ago</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="feat_property home7 style4 bdrrn feat_property_w">
                                <div class="thumb">
                                    <img class="img-whp" src="images/property/rent1.PNG" alt="rent1.PNG">
                                    <div class="thmb_cntnt">
                                        <ul class="tag mb0">
                                            <li class="list-inline-item"><a href="#"><i class="ri-heart-3-line"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="details details_w">
                                    <div class="tc_content tc_content_w">
                                        <p class="text-thm">분양상가</p>
                                        <h4>부전역 3번출구 바로 앞</h4>
                                        <div class="text-inf-w">
                                            <p class="text-inf"><i class="ri-building-line"></i>전유면적
                                                1,000㎡</p>
                                            <p class="text-inf"><i class="ri-building-line"></i>해당층
                                                1/15F</p>
                                        </div>
                                        <p class="text-inf"><i class="ri-map-pin-2-line"></i>부산광역시
                                            부산진구 부전동</p>
                                        <p class="text-thm price_w">임대 <span class="mont">30,000 /
                                                1,000</span> 만원</p>
                                    </div>
                                    <div class="fp_footer fp_footer_w">
                                        <ul class="fp_meta float-left mb0 fp_meta_w">
                                            <li class="list-inline-item"><a href="#"><img src="images/property/HM1.PNG"
                                                        alt="HM1.PNG"></a></li>
                                            <li class="list-inline-item"><a href="#">송땡땡 부동산연구소</a>
                                            </li>
                                        </ul>
                                        <p class="fp_pdate mont">2 day ago</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="feat_property home7 style4 bdrrn feat_property_w">
                                <div class="thumb">
                                    <img class="img-whp" src="images/property/BI2.PNG" alt="BI2.PNG">
                                    <div class="thmb_cntnt">
                                        <ul class="tag mb0">
                                            <li class="list-inline-item"><a href="#"><i class="ri-heart-3-line"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="details details_w">
                                    <div class="tc_content tc_content_w">
                                        <p class="text-thm">상가주택</p>
                                        <h4>연산동 장사하기 좋은곳</h4>
                                        <div class="text-inf-w">
                                            <p class="text-inf"><i class="ri-building-line"></i>일반상업지 333㎡</p>
                                            <p class="text-inf"><i class="ri-building-line"></i>단층
                                                연100㎡</p>
                                        </div>
                                        <p class="text-inf"><i class="ri-map-pin-2-line"></i>부산광역시
                                            연제구 연산동</p>
                                        <p class="text-thm price_w">매매 <span class="mont">150,000</span> 만원</p>
                                    </div>
                                    <div class="fp_footer fp_footer_w">
                                        <ul class="fp_meta float-left mb0 fp_meta_w">
                                            <li class="list-inline-item"><a href="#"><img src="images/property/AI3.PNG"
                                                        alt="AI3.PNG"></a></li>
                                            <li class="list-inline-item"><a href="#">M3consulting
                                                    Inc.</a></li>
                                        </ul>
                                        <p class="fp_pdate mont">3 day ago</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="feat_property home7 style4 bdrrn feat_property_w">
                                <div class="thumb">
                                    <img class="img-whp" src="images/property/BI1.PNG" alt="BI1.PNG">
                                    <div class="thmb_cntnt">
                                        <ul class="tag mb0">
                                            <li class="list-inline-item"><a href="#"><i
                                                        class="ri-heart-3-fill full-heart"></i></a>
                                            </li>
                                            <li class="list-inline-item"><a href="#"><i
                                                        class="ri-thumb-up-fill"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="details details_w">
                                    <div class="tc_content tc_content_w">
                                        <p class="text-thm">상가건물</p>
                                        <h4>최고의 선택, 밸류업</h4>
                                        <div class="text-inf-w">
                                            <p class="text-inf"><i class="ri-building-line"></i>일반상업지 333㎡</p>
                                            <p class="text-inf"><i class="ri-building-line"></i>단층
                                                연100㎡</p>
                                        </div>
                                        <p class="text-inf"><i class="ri-map-pin-2-line"></i>부산광역시
                                            해운대구 우동</p>
                                        <p class="text-thm price_w">매매 <span class="mont">1,000,000</span> 만원</p>
                                    </div>
                                    <div class="fp_footer fp_footer_w">
                                        <ul class="fp_meta float-left mb0 fp_meta_w">
                                            <li class="list-inline-item"><a href="#"><img src="images/property/AI4.PNG"
                                                        alt="AI4.PNG"></a></li>
                                            <li class="list-inline-item"><a href="#">(주)부동산중개법인개벽</a></li>
                                        </ul>
                                        <p class="fp_pdate mont">1 day ago</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>

<!-- 중개사정보 -->
<div class="col-lg-4">

        <div class="sidebar_listing_list sidebar_listing_list_w">
            <div class="sidebar_advanced_search_widget">
                <div class="sl_creator sl_creator_w">
                    <h4 class="mb20">중개사정보</h4>
                    <div class="media media_w">
                        <div class="profile_crop">
                            <img class="mr-3"
                                src="{{ $printData['sawon_photo'] }}"
                                style="width:90px;height:90px">
                        </div>
                        <div class="media-body">
                            <p class="mb0 media-detail">{{ $printData['sawon_sosok'] }}</p>
                            <h5 class="mt-0">{{ $printData['sawon_name'] }}
                                {{ $printData['sawon_duty'] }}</h5>
                            <p class="mb0 mont media-call">Tel.
                                1833-{{ $printData['sawon_office_line'] }}
                            </p>
                        </div>
                    </div>
                </div>
                <ul class="sasw_list mb0 sasw_list_w">
                    <li class="search_area">
                        <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputName1" placeholder="이름을 입력하세요">
                        </div>
                    </li>
                    <li class="search_area">
                        <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputName2" placeholder="번호를 입력하세요">
                        </div>
                    </li>
                    <li class="search_area">
                        <div class="form-group">
                            <input type="email" class="form-control" id="exampleInputEmail" placeholder="이메일을 입력하세요">
                        </div>
                    </li>
                    <li class="search_area">
                        <div class="form-group">
                            <textarea id="form_message" name="form_message" class="form-control required" rows="3"
                                required="required" placeholder="문의하실 내용을 입력하세요."></textarea>
                        </div>
                    </li>
                    <li>
                        <div class="search_option_button detail_emp_btns">
                            <button class="btn btn-block btn-thm btn-thm_w">자세히보기</button>
                            <button type="submit" class="btn btn-block btn-thm btn-thm_w">문의하기</button>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="sidebar_recent_product today_pro">
            <h4 class="mb20">오늘 본 매물</h4>
            @if(empty($todayViewSales))
            @else
            @foreach ($todayViewSales as $_data)
            @php
            $sale = $_data->sale;
            if($sale->files->count()==0){
            $img = "https://www.gbbinc.co.kr/mng/_Img/thumb_noimg.jpg";
            }else{
            $img = "https://www.gbbinc.co.kr/_Data/SaleNew/".$sale->files->first()->filename;
            }

            if($sale->tradeType=="임대"){
            $printPrice = number_format($sale->l_depPrice)."/".number_format($sale->l_monPrice);
            }else{
            $printPrice = number_format($sale->salePrice);
            }

            $arrAddr = explode(",",$sale->_addr);
            $addr = trim($arrAddr[0]);
            if(count($arrAddr)>1) $addr .= " 외 ".(count($arrAddr) -1)."필지";
            @endphp
            <div class="media media_w" style="cursor: pointer"
                onclick="location.href='?mode=show&idx={{ $_data->idx }}'">
                <img class="align-self-start" src="{{ $img }}">
                <div class="media-body today_inf">
                    <h5 class="mt-0 mb-0">{{ $sale->saleTypeTxt }}</h5>
                    <div class="today_loc">{{ $addr }}</div>
                    <a href="#">{{ $sale->tradeType }} <span class="mont">{{ $printPrice }}</span> 만원</a>
                </div>
            </div>
            @endforeach
            @endif
        </div>


</div>