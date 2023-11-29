<script>
$(window).on('load', function() {
    $('.owl-dot').each(function(index) {

        var imageUrl = $(".single_product_grid .img-fluid").eq(index + 2).attr('src');
        $(this).find('span').css('background-image', 'url(' + imageUrl + ')');
    });

    $(document).on("click", ".nearby-infra", function(){
        console.log('marker click');
        var x = $(this).data('x');
        var y = $(this).data('y');

        // 마커 하나를 지도위에 표시합니다 
        addMarker(new kakao.maps.LatLng(y, x));
    });
});


</script>
<div class="col-lg-8">
    <div class="single_product_grid row single_product_grid_w">
        <div
            class="@if(count($printData['imgs'])>1) single_product_slider @endif col-sm-6 col-md-6 col-lg-6 pl0 pr0 single_product_slider_w">
            @foreach ($printData['imgs'] as $_img)
            <div class="item">
                <div class="sps_content">
                    <div class="thumb detail_b_thumb">
                        <div class="single_product">
                            <div class="single_item">
                                <div class="thumb detail_b_thumb"><img class="img-fluid" src="{{ $_img }}"></div>
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
                            <li><a href="#"><i class="ri-checkbox-circle-line"></i> {{ $printData['prposAreaNm'] }}</a>
                            </li>
                            @if(!empty($printData['area_b']))
                            <li><a href="#"><i class="ri-checkbox-circle-line"></i> 분양{{ $printData['area_b'] }}㎡
                                    전유{{ $printData['area_j'] }}㎡ </a></li>
                            @else
                            <li><a href="#"><i class="ri-checkbox-circle-line"></i> 토지면적
                                    {{ $printData['landArea'] }}㎡</a></li>
                            @if (strpos($printData['category'],"토지")===false)
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

                                <p class="mb10">
                                    {!! $printData['description_1'] !!}
                                </p>
                                @if (!empty($printData['description_2']))
                                <p class="gpara second_para white_goverlay mt10 mb10">
                                    {{ $printData['description_2'] }}
                                </p>    
                                
                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body">
                                        <p class="mt10 mb10">
            
                                                {!! $printData['description_3'] !!}
            
                                        </p>
                                    </div>
                                </div>
                                <p class="overlay_close">
                                    <a class="text-thm fz14 text-thm_w" data-toggle="collapse" href="#collapseExample"
                                        role="button" aria-expanded="false" aria-controls="collapseExample">
                                        더보기 <i class="ri-arrow-down-s-line"></i>
                                    </a>
                                </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-12 pl-0 pr-0">
                            <div class="additional_details additional_w">
                                <div class="col-lg-12 pl-0 pr-0">
                                    <h4 class="mb10">매물정보</h4>
                                </div>
                                <ul class="list-inline-item detail_list row">
                                    <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                        <p>매물유형 :</p>
                                        <p>{{ $printData['category'] }}</p>
                                    </li>
                                    <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                        <p>대지면적 :</p>
                                        <p class="mont">{{ $printData['landArea'] }}㎥ ({{ $printData['landArea_py'] }}p)
                                        </p>
                                    </li>
                                    <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                        <p>지목 :</p>
                                        <p>{{ $printData['lndcgrCodeNm'] }}</p>
                                    </li>
                                    <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                        <p>용도지역 :</p>
                                        <p>{{ $printData['prposAreaNm'] }}</p>
                                    </li>

                                    @if ($printData['isToji']==false)

                                    @if(!empty($printData['area_b']))
                                    <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                        <p>분양면적 :</p>
                                        <p class="mont">{{ $printData['area_b'] }}㎥ ({{ $printData['area_b_py'] }}p)</p>
                                    </li>
                                    <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                        <p>전유면적 :</p>
                                        <p class="mont">{{ $printData['area_j'] }}㎥ ({{ $printData['area_j_py'] }}p)</p>
                                    </li>
                                    @else
                                    <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                        <p>연면적 :</p>
                                        <p class="mont">{{ $printData['bdArea'] }}㎥ ({{ $printData['bdArea_py'] }}p)</p>
                                    </li>
                                    @endif

                                    <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                        <p>건물용도 :</p>
                                        <p>{{ $printData['mainPurpsCdNm'] }}</p>
                                    </li>
                                    <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                        <p>주구조 :</p>
                                        <p>{{ $printData['strctCdNm'] }}</p>
                                    </li>
                                    <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                        <p>규모 :</p>
                                        <p>지하 {{ $printData['ugrndFlrCnt'] }}층 / 지상 {{ $printData['grndFlrCnt'] }}층</p>
                                    </li>
                                    <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                        <p>주차시설 :</p>
                                        <p>주차 {{ $printData['parkingCnt'] }}</p>
                                    </li>
                                    <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                        <p>승강기 :</p>
                                        <p>승강기 {{ $printData['ElvtCnt'] }}</p>
                                    </li>

                                    @endif

                                </ul>
                            </div>
                            @if ($printData['isToji']==false)
                            <div class="additional_details additional_w">
                                <div class="col-lg-12 pl-0 pr-0">
                                    <h4 class="mb10">추가설명</h4>
                                </div>
                                <ul class="list-inline-item detail_list row">
                                    <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                        <p>사용승인일 :</p>
                                        <p class="mont">{{ $printData['useAprDay'] }}</p>
                                    </li>
                                    <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                        <p>입주정보 :</p>
                                        <p>{{ $printData['movein'] }} {{ $printData['movein_nego'] }}</p>
                                    </li>
                                    @if ($printData['isJugeo']==true)
                                    <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                        <p>월관리비 :</p>
                                        <p>관리비 없음</p>
                                    </li>
                                    <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                        <p>방향 :</p>
                                        <p>{{ $printData['direction'] }}향</p>
                                    </li>
                                    <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                        <p>방 / 화장실 :</p>
                                        <p>방 {{ $printData['room_num'] }}개 / 욕실 {{ $printData['restroom_num'] }}개</p>
                                    </li>
                                    
                                    <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                        <p>난방방식 :</p>
                                        <p>개별난방</p>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                            @endif
                            <div class="additional_details additional_w">
                                <div class="col-lg-12 pl-0 pr-0">
                                    <h4 class="mb10">가격정보</h4>
                                </div>

                                @if ($printData['tradeType']=="매매")

                                <ul class="list-inline-item detail_list row">
                                    <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                        <p>매매가격 :</p>
                                        <p>매매 <span class="mont">{{ $printData['price'] }}</span>만원</p>
                                    </li>
                                    <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                        <p>월세현황 :</p>
                                        <p>보증금 {{ number_format($printData['depPrice_st']) }}만원 / 월세
                                            {{ number_format($printData['monPrice_st']) }}만원</p>
                                    </li>
                                    <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                        <p>융자금 :</p>
                                        <p>{{ (empty($printData['loanPrice']))?"없음":number_format($printData['loanPrice'])."만원"; }}
                                        </p>
                                    </li>
                                    <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                        <p>예상 수익률 :</p>
                                        <p class="mont">{{ $printData['rate'] }}%</p>
                                    </li>
                                </ul>


                                @else
                                <ul class="list-inline-item detail_list row">
                                    <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                        <p>보증금 :</p>
                                        <p><span class="mont">{{ number_format($printData['depPrice']) }}</span>만원</p>
                                    </li>
                                    <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                        <p>월세 :</p>
                                        <p><span class="mont">{{ number_format($printData['monPrice']) }}</span>만원</p>
                                    </li>
                                </ul>

                                @endif

                            </div>
                        </div>
                        @if($printData['isJugeo'])
                        @if(!empty($printData['optCodes']['생활시설']))
                        <div class="col-lg-12 pl-0 pr-0">
                            <div class="application_statics mt30 application_w">
                                <div class="col-lg-12">
                                    <h4 class="mb15">생활시설</h4>
                                </div>
                                <ul class="order_list list-inline-item order_list_w row">
                                    @foreach ($printData['optCodes']['생활시설'] as $_item)
                                    <li class="col-md-6 col-lg-3 col-xl-3">
                                        <a href="#">
                                            <i class="ri-checkbox-line"></i>
                                            <p>{{ $_item }}</p>
                                        </a>
                                    </li>
                                    @endforeach
                                    
                                </ul>
                            </div>
                        </div>
                        @endif
                        @if(!empty($printData['optCodes']['보안시설']))
                        <div class="col-lg-12 pl-0 pr-0">
                            <div class="application_statics mt30 application_w">
                                <div class="col-lg-12">
                                    <h4 class="mb15">보안시설</h4>
                                </div>
                                <ul class="order_list list-inline-item order_list_w row">
                                    @foreach ($printData['optCodes']['보안시설'] as $_item)
                                    <li class="col-md-6 col-lg-3 col-xl-3">
                                        <a href="#">
                                            <i class="ri-checkbox-line"></i>
                                            <p>{{ $_item }}</p>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                        @if(!empty($printData['optCodes']['기타시설']))
                        <div class="col-lg-12 pl-0 pr-0">
                            <div class="application_statics mt30 application_w">
                                <div class="col-lg-12">
                                    <h4 class="mb15">기타시설</h4>
                                </div>
                                <ul class="order_list list-inline-item order_list_w row">
                                    @foreach ($printData['optCodes']['기타시설'] as $_item)
                                    <li class="col-md-6 col-lg-3 col-xl-3">
                                        <a href="#">
                                            <i class="ri-checkbox-line"></i>
                                            <p>{{ $_item }}</p>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>


                            </div>
                        </div>
                        @endif
                        @endif
                        <div class="col-lg-12 pl-0 pr-0">
                            <div class="application_statics mt30 map_w">
                                <div class="map_top_w mb20">
                                    <h4>지도</h4>
                                    <p class="float-right">
                                        <i class="ri-map-pin-2-line"></i>
                                        {{ $printData['address'] }}
                                    </p>
                                </div>
                  
                                
                                <x-kko_map :printData="$printData" />

                            </div>
                        </div>

                        

                        <div class="col-lg-12 pl-0 pr-0">
                            <div class="whats_nearby mt30 nearby_w">
                                <h4 class="mb10">근처시설</h4>

                                @if(!empty($printData['infra']['교육시설']))
                                <div class="education_distance mb15 education_w">
                                    <h5><i class="ri-school-line"></i> 교육시설
                                    </h5>
                                    @foreach ($printData['infra']['교육시설'] as $_row)
                                    <div class="single_line single_w nearby-infra edu" data-x="{{ $_row['x'] }}" data-y="{{ $_row['y'] }}">
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

                                @if(!empty($printData['infra']['주변시설']))
                                <div class="education_distance mb15 style2 education_w">
                                    <h5><i class="ri-store-line"></i> 주변시설
                                    </h5>
                                    @foreach ($printData['infra']['주변시설'] as $_row)
                                    <div class="single_line single_w nearby-infra near" data-x="{{ $_row['x'] }}" data-y="{{ $_row['y'] }}">
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

                                @if(!empty($printData['infra']['교통정보']))
                                <div class="education_distance style3 education_w">
                                    <h5><i class="ri-bus-2-line"></i> 교통정보
                                    </h5>
                                    @foreach ($printData['infra']['교통정보'] as $_row)
                                    <div class="single_line single_w nearby-infra traffic" data-x="{{ $_row['x'] }}" data-y="{{ $_row['y'] }}">
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

<!-- 중개사정보 / 오늘 본 매물-->
<div class="col-lg-4">

    <x-inquirybox type="photo" :printData="$printData" />

    <x-today-view-sales />

</div>