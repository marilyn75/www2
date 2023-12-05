<script>
$(window).on('load', function() {
    $('.owl-dot').each(function(index) {
        var imageUrl = $(".single_product_grid .img-fluid").eq(index + 2).attr('src');
        $(this).find('span').css('background-image', 'url(' + imageUrl + ')');
    });
});
</script>
<div class="col-lg-8">

    <!-- 수정 -->
    <div class="detail_img">
        <div class="col-lg-12 single_product_grid row single_product_grid_w">
            <div class="detail_info">
                <div class="de_info_left">
                    <p>{{ $printData['category'] }}</p>
                    <h3>{{ $printData['address'] }}</h3>
                    <ul>
                        <li><a href="#">{{ $printData['prposAreaNm'] }}</a>
                        </li>
                        @if(!empty($printData['area_b']))
                        <li><a href="#">분양{{ $printData['area_b'] }}㎡
                                전유{{ $printData['area_j'] }}㎡ </a></li>
                        @else
                        <li><a href="#">토지면적
                                {{ $printData['landArea'] }}㎡</a></li>
                        @if (strpos($printData['category'],"토지")===false)
                        <li><a href="#">연면적 {{ $printData['bdArea'] }}㎡</a>
                        </li>
                        @endif
                        @endif
                    </ul>
                </div>
                <div class="de_info_right">
                    <div class="detail_btn_w">
                        <button class="detail_btn">
                            <i class="ri-arrow-left-right-line"></i>
                        </button>

                        <!-- 찜하기 전 -->
                        <button class="heart_btn detail_btn on">
                            <i class="ri-heart-3-line"></i>
                        </button>
                        <!-- 찜한 후 -->
                        <!-- <button class="heart_btn detail_btn">
                            <i class="ri-heart-3-fill fill_heart"></i>
                        </button> -->

                    </div>
                    <p class="de_info_pr"><span class="mont">{{ $printData['price'] }}</span>만원</p>
                </div>
            </div>
            <div class="swiper mySwiper swiper-initialized swiper-horizontal swiper-backface-hidden">
                <div class="swiper-wrapper" id="swiper-wrapper-bd129101b3b69f5107" aria-live="polite"
                    style="transition-duration: 0ms; transform: translate3d(0px, 0px, 0px); transition-delay: 0ms;">
                    @foreach ($printData['imgs'] as $_img)
                    <div class="swiper-slide" role="group">
                        <img src="{{ $_img }}" alt="">
                    </div>
                    @endforeach
                </div>
                <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide"
                    aria-controls="swiper-wrapper-bd129101b3b69f5107" aria-disabled="false">
                    <p class="mont">NEXT</p>
                </div>
                <div class="swiper-button-prev swiper-button-disabled" tabindex="-1" role="button"
                    aria-label="Previous slide" aria-controls="swiper-wrapper-bd129101b3b69f5107" aria-disabled="true">
                    <p class="mont">PREV</p>
                </div>
                <div class="swiper-pagination mont swiper-pagination-fraction swiper-pagination-horizontal"><span
                        class="swiper-pagination-current">1</span> / <span class="swiper-pagination-total">3</span>
                </div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            </div>

            <!-- Initialize Swiper -->
            <script>
            var swiper = new Swiper(".mySwiper", {
                pagination: {
                    el: ".swiper-pagination",
                    type: "fraction",
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });
            </script>

        </div>
    </div>
    <!-- Agent Single Grid View -->
    <section class="our-agent-single bgc-f7 pb30-991">
        <div class="container container_w">
            <div class="row">
                <div class="col-md-12 col-lg-12 pl-0 pr-0">
                    <div class="row pl10 pr10">
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
                                <h4 class="mb10">근처시설
                                    <i class="ri-information-line" data-toggle="tooltip" data-placement="top"
                                        data-original-title="근처시설을 클릭해보세요"></i>
                                </h4>
                                <script>
                                $(document).ready(function() {

                                    //Tooltip, activated by hover event
                                    $("body").tooltip({
                                            selector: "[data-toggle='tooltip']",
                                            container: "body"
                                        })
                                        //Popover, activated by clicking
                                        .popover({
                                            selector: "[data-toggle='popover']",
                                            container: "body",
                                            html: true
                                        });
                                    //They can be chained like the example above (when using the same selector).

                                });
                                </script>

                                @if(!empty($printData['infra']['교육시설']))
                                <div class="education_distance mb15 education_w">
                                    <h5><i class="ri-school-line"></i> 교육시설
                                    </h5>
                                    @foreach ($printData['infra']['교육시설'] as $_row)
                                    <div class="single_line single_w nearby-infra edu" data-x="{{ $_row['x'] }}"
                                        data-y="{{ $_row['y'] }}">
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
                                    <div class="single_line single_w nearby-infra near" data-x="{{ $_row['x'] }}"
                                        data-y="{{ $_row['y'] }}">
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
                                    <div class="single_line single_w nearby-infra traffic" data-x="{{ $_row['x'] }}"
                                        data-y="{{ $_row['y'] }}">
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
                        <div class="row">
                            <div class="col-lg-12 similar similar_w">
                                <h4 class="mt30 mb30">관련매물</h4>
                            </div>
                            @foreach ($relatedSales as $_data)
                            @php

                            $_printData = App\Http\Class\IntraSaleClass::getPrintData($_data);

                            @endphp
                            <x-item-sale-intranet type='related' :printData="$_printData" />

                            @endforeach
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