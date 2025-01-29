<div class="row">

    <script>
        function addFavorite(obj, id) {
            var $child = $(obj).children();
        
            var flag = ($child.hasClass('fill_heart')) ? "remove" : "add";
            var params = {
                id: id,
                flag: flag
            };
        
            var r = doAjax('{{ route('common.ajax.addFavorite') }}', params);
        
            if (r.result) {
                if (flag == "add") $child.removeClass('ri-heart-3-line').addClass('fill_heart').addClass('ri-heart-3-fill');
                else $child.removeClass('ri-heart-3-fill').addClass('ri-heart-3-line').removeClass('fill_heart');
        
                // if(flag=="add") $child.addClass('on');
                // else            $child.removeClass('on');
                sbAlert(r.message);
            }
        
            return false;
        }
        
        $(document).on('click', '#transArea', function() {
            if (!$(this).hasClass('py')) {
                $('.area').each(function() {
                    $(this).html($(this).data('py'));
                });
                $(this).addClass('py');
            } else {
                $('.area').each(function() {
                    $(this).html($(this).data('m2'));
                });
                $(this).removeClass('py');
            }
        });
        
    </script>
    <style>
        td {border:0px;padding: 0px; }
        td span {font-size: 18px;color:#000;}
    </style>
    <div class="col-lg-8">
    
        <!-- 수정 -->
        <div class="detail_img">
            <div class="col-lg-12 single_product_grid row single_product_grid_w">
               
                <div class="detail_info">
                    <div class="de_info_left" style="width: 100%;">
                        <p>{{ $printData['category'] }}</p>
                        <h3>{{ $printData['address'] }}</h3>
                       
                                <table table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td style="text-align:left"><span>{{ $printData['prposAreaNm'] }}</span></td>
                                    </tr>
                                    @if($printData['category_class']=="home" || $printData['category_class']=="mall")
                                    <tr>
                                        <td style="text-align:left"><span>계약<span class="area" data-m2="{{ $printData['area_b'] }}㎡" data-py="{{ $printData['area_b_py'] }}평">{{ $printData['area_b'] }}㎡</span>
                                            전용<span class="area" data-m2="{{ $printData['area_j'] }}㎡" data-py="{{ $printData['area_j_py'] }}평">{{ $printData['area_j'] }}㎡ </span></span></td>
                                    </tr>
                                    @else
                                    <div class="detail_width">
                                        <tr>
                                            <td style="text-align:left"><span>토지면적
                                            <span class="area" data-m2="{{ $printData['landArea'] }}㎡" data-py="{{ $printData['landArea_py'] }}평">{{ $printData['landArea'] }}㎡</span></span></td>
                                        </tr>
                                        @if (strpos($printData['category'],"토지")===false && strpos($printData['category'],"임야")===false)
                                        <tr>
                                            <td style="text-align:left"><span>연면적 <span class="area" data-m2="{{ $printData['bdArea'] }}㎡" data-py="{{ $printData['bdArea_py'] }}평">{{ $printData['bdArea'] }}㎡</span></span></td>
                                        </tr>
                                    </div>
                                    @endif
                                    @endif
                                </table>
            
                        <div class="de_info_right">
                            <div class="price">
                                <p class="de_info_pr">{{ $printData['tradeType'] }} <span class="mont">{{ $printData['price'] }}원</span></p>
                                @if(!empty($printData['price_py']))<p><span class="mont">{{ $printData['price_py'] }}원</span> <span class="mont">(3.3㎡)</span></p>@endif
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="swiper mySwiper swiper-initialized swiper-horizontal swiper-backface-hidden">
                    <div class="swiper-wrapper" id="swiper-wrapper-bd129101b3b69f5107" aria-live="polite"
                        style="transition-duration: 0ms; transform: translate3d(0px, 0px, 0px); transition-delay: 0ms;">
                 
                        <div class="swiper-slide" role="group">
                            <img src="https://www.gyemoim.co.kr{{ $printData['imgs'][0] }}" alt="">
                        </div>
                 
                    </div>
                    
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
                                
                                    <div class="description card card-body"><Br>
                                        {!! nl2br($printData['description']) !!}
                                    </div>

                                </div>
                                
                            </div>
                            <div class="col-lg-12 pl-0 pr-0">
                                <div class="additional_details additional_w">
                                    
                                        <h4 class="mb10">매물정보</h4>
                                    
                                    {{-- 주거, 분양상가 --}}
                                @if ($printData['category_class']=="mall" || $printData['category_class']=="home")
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;">매물유형 :</td>
                                            <td style="text-align:left !important; width: 35%; font-size: 16px;">{{ $printData['category'] }}</td>
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;">건물용도 :</td>
                                            <td style="text-align:left !important; width: 35%; font-size: 16px;">{{ printEmpty($printData['mainPurpsCdNm']) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;">계약면적 :</td>
                                            <td class="mont" style="text-align:left !important; width: 35%; font-size: 16px;">{{ $printData['area_b'] }}㎥ ({{ $printData['area_b_py'] }}p)</td>
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;">전용면적 :</td>
                                            <td class="mont" style="text-align:left !important; width: 35%; font-size: 16px;">{{ $printData['area_j'] }}㎥ ({{ $printData['area_j_py'] }}p)</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;">전용율 :</td>
                                            <td class="mont" style="text-align:left !important; width: 35%; font-size: 16px;">{{ $printData['areaRate'] }}%</td>
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;">주구조 :</td>
                                            <td style="text-align:left !important; width: 35%; font-size: 16px;">{{ printEmpty($printData['strctCdNm']) }}</td>
                                        </tr>
                                        @if($printData['category_class']=="home")
                                        <tr>
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;">주차시설 :</td>
                                            <td style="text-align:left !important; width: 35%; font-size: 16px;">세대당 {{ $printData['ratePkngCnt'] }} 대 / 총 {{ $printData['totPkngCnt'] }} 대</td>
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;">승강기 :</td>
                                            <td style="text-align:left !important; width: 35%; font-size: 16px;">{{ $printData['ElvtCnt'] }}</td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;">주차시설 :</td>
                                            <td style="text-align:left !important; width: 35%; font-size: 16px;">{{ $printData['parkingCnt'] }}</td>
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;">승강기 :</td>
                                            <td style="text-align:left !important; width: 35%; font-size: 16px;">{{ $printData['ElvtCnt'] }}</td>
                                        </tr>
                                        @endif
                                    </table>
                                @else
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;">매물유형 :</td>
                                            <td style="text-align:left !important; width: 35%; font-size: 16px;">{{ $printData['category'] }}</td>
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;">대지면적 :</td>
                                            <td class="mont" style="text-align:left !important; width: 35%; font-size: 16px;">{{ $printData['landArea'] }}㎥ ({{ $printData['landArea_py'] }}p)</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;">지목 :</td>
                                            <td style="text-align:left !important; width: 35%; font-size: 16px;">{{ printEmpty($printData['lndcgrCodeNm']) }}</td>
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;">용도지역 :</td>
                                            <td style="text-align:left !important; width: 35%; font-size: 16px;">{{ printEmpty($printData['prposAreaNm']) }}</td>
                                        </tr>
                                        @if ($printData['noBuilding']!="1")
                                        <tr>
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;">연면적 :</td>
                                            <td class="mont" style="text-align:left !important; width: 35%; font-size: 16px;">@if(intval($printData['bdArea'])==0){{ __('-') }}@else{{ $printData['bdArea'] }}㎥ ({{ $printData['bdArea_py'] }}p)@endif</td>
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;">건물용도 :</td>
                                            <td style="text-align:left !important; width: 35%; font-size: 16px;">{{ printEmpty($printData['mainPurpsCdNm']) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;">주구조 :</td>
                                            <td style="text-align:left !important; width: 35%; font-size: 16px;">{{ printEmpty($printData['strctCdNm']) }}</td>
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;">규모 :</td>
                                            <td style="text-align:left !important; width: 35%; font-size: 16px;">지하 {{ printEmpty($printData['ugrndFlrCnt']) }}층 / 지상 {{ printEmpty($printData['grndFlrCnt']) }}층</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;">주차시설 :</td>
                                            <td style="text-align:left !important; width: 35%; font-size: 16px;">{{ $printData['parkingCnt'] }}</td>
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;">승강기 :</td>
                                            <td style="text-align:left !important; width: 35%; font-size: 16px;">{{ $printData['ElvtCnt'] }}</td>
                                        </tr>
                                        @endif
                                    </table>
                                @endif
                                </div>
                                @if ($printData['noBuilding']!="1")
                                <div class="additional_details additional_w">
                                    
                                        <h4 class="mb10 mr-2">추가설명</h4>
                                        @if(strpos($printData['bdOpt'],"불법건축물")!==false)
                                        &nbsp;
                                        <div class="text-white fs-6" style="background-color: #e24b3f; padding: 5px 5px 3px 5px; border-radius: 5px; font-size: 13px;">
                                            불법건축물
                                        </div>
                                        @endif
                                        @if(strpos($printData['bdOpt'],"무허가")!==false)
                                        &nbsp;
                                        <div class="text-white fs-6" style="background-color: #4f83c4; padding: 5px 5px 3px 5px; border-radius: 5px; font-size: 13px;">
                                            무허가
                                        </div>
                                        @endif
                                        @if(strpos($printData['bdOpt'],"미등기")!==false)
                                        &nbsp;
                                        <div class="text-white fs-6" style="background-color: #d8ac1d; padding: 5px 5px 3px 5px; border-radius: 5px; font-size: 13px;">
                                            미등기
                                        </div>
                                        @endif
                                    
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;">사용승인일 :</td>
                                            <td style="text-align:left !important; width: 35%; font-size: 16px;">{{ $printData['useAprDay'] }}</td>
                                        
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;">방향 :</td>
                                            <td style="text-align:left !important; width: 35%; font-size: 16px;">{{ $printData['direction'] }} ({{ $printData['direction_gijun'] }})</td>
                                        </tr>
                                        @if($printData['category_class']=="home")
                                        <tr>
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;">세대수 :</td>
                                            <td style="text-align:left !important; width: 35%; font-size: 16px;">{{ $printData['households'] }}</td>
                                        
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;">발코니 :</td>
                                            <td style="text-align:left !important; width: 35%; font-size: 16px;">{{ printEmpty($printData['balcony']) }}</td>
                                        </tr>
                                        @endif
                                        
                                    @if($printData['category_class']!="factory")
                                        <tr>
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;">방/화장실 :</td>
                                            <td style="text-align:left !important; width: 35%; font-size: 16px;">{{ $printData['room_num'] }}개 / {{ $printData['restroom_num'] }}</td>
                                        
                                        @if ($printData['category_class']=="mall" || $printData['category_class']=="home")
                                        
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;">해당층@if(!empty($printData['totFloor'])){{ __('/전체층') }}@endif :</td>
                                            <td style="text-align:left !important; width: 35%; font-size: 16px;">{{ printEmpty($printData['currFloor']) }} @if(!empty($printData['totFloor'])){{ __('/') }}@endif {{ $printData['totFloor'] .'층' }}</td>
                                        
                                        @else
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;"></td>
                                            <td style="text-align:left !important; width: 35%; font-size: 16px;"></td>
                                        @endif
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;">월관리비 :</td>
                                            <td style="text-align:left !important; width: 35%; font-size: 16px;">{!! $printData['print_mngPrice'] !!}</td>
                                       
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;">난방방식 :</td>
                                            <td style="text-align:left !important; width: 35%; font-size: 16px;">@if(empty($printData['heat_type']) && empty($printData['heat_info'])){{ __('-') }}@else{{ $printData['heat_type'] }} ({{ $printData['heat_info'] }})@endif</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;">입주정보 :</td>
                                            <td colspan="3" style="text-align:left !important; width: 35%; font-size: 16px;">{{ $printData['movein'] }} {{ $printData['movein_nego'] }}</td>
                                        </tr>
                                    @endif
                                    </table>
                                </div>
                                @endif
                                <div class="additional_details additional_w">
                                    
                                        <h4 class="mb10">가격정보</h4>
                                    
    
                                    @if ($printData['tradeType']=="매매")
    
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;">매매가격 :</td>
                                            <td style="text-align:left !important; width: 35%; font-size: 16px;">{{ $printData['price'] }}원</td>
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;">월세현황 :</td>
                                            <td style="text-align:left !important; width: 35%; font-size: 16px;">보증금 {{ number_format($printData['depPrice_st']) }}만원 / 월세 {{ number_format($printData['monPrice_st']) }}만원</td>
                                        </tr>
                                        @if($printData['loanType']!="표시안함")
                                        <tr>
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;">융자금 :</td>
                                            <td style="text-align:left !important; width: 35%; font-size: 16px;">{{ (empty($printData['loanPrice']))?"없음":price_kor($printData['loanPrice'] * 10000)."원"; }}</td>
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;">예상 수익률 :</td>
                                            <td style="text-align:left !important; width: 35%; font-size: 16px;">{{ $printData['rate'] }}%</td>
                                        </tr>
                                        @endif
                                    </table>
    
    
                                    @else
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;">보증금 :</td>
                                            <td style="text-align:left !important; width: 35%; font-size: 16px;">{{ number_format($printData['depPrice']) }} 만원</td>
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;">월세 :</td>
                                            <td style="text-align:left !important; width: 35%; font-size: 16px;">{{ number_format($printData['monPrice']) }} 만원</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold" style="text-align:left !important; width: 15%; font-size: 16px;">권리금 :</td>
                                            <td style="text-align:left !important; width: 35%; font-size: 16px;">{{ number_format($printData['premPrice']) }} 만원</td>
                                        </tr>
                                    </table>
    
                                    @endif
    
                                </div>
                            </div>
                            @if($printData['category_class']=="mall" || $printData['category_class']=="home")
                            @if(!empty($printData['optCodes']['생활시설']))
                            <div class="col-lg-12 pl-0 pr-0">
                                <div class="application_statics mt30 application_w">
                                    
                                        <h4 class="mb15">생활시설</h4>
                                    
                                    <table class="table table-borderless">
                                        @foreach ($printData['optCodes']['생활시설'] as $_item)
                                        <tr>
                                            <td style="text-align:left !important; width: 50%;"><i class="ri-checkbox-line"></i> {{ $_item }}</td>
                                            @if ($loop->remaining)
                                            <td style="text-align:left !important; width: 50%;"><i class="ri-checkbox-line"></i> {{ $printData['optCodes']['생활시설'][$loop->index + 1] }}</td>
                                            @endif
                                        </tr>
                                        @if ($loop->remaining)
                                        @php $loop->next() @endphp
                                        @endif
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            @endif
                            @if(!empty($printData['optCodes']['보안시설']))
                            <div class="col-lg-12 pl-0 pr-0">
                                <div class="application_statics mt30 application_w">
                                    
                                        <h4 class="mb15">보안시설</h4>
                                  
                                    <table class="table table-borderless">
                                        @foreach ($printData['optCodes']['보안시설'] as $_item)
                                        <tr>
                                            <td style="text-align:left !important; width: 50%;"><i class="ri-checkbox-line"></i> {{ $_item }}</td>
                                            @if ($loop->remaining)
                                            <td style="text-align:left !important; width: 50%;"><i class="ri-checkbox-line"></i> {{ $printData['optCodes']['보안시설'][$loop->index + 1] }}</td>
                                            @endif
                                        </tr>
                                        @if ($loop->remaining)
                                        @php $loop->next() @endphp
                                        @endif
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            @endif
                            @if(!empty($printData['optCodes']['기타시설']))
                            <div class="col-lg-12 pl-0 pr-0">
                                <div class="application_statics mt30 application_w">
                                   
                                        <h4 class="mb15">기타시설</h4>
                                    
                                    <table class="table table-borderless">
                                        @foreach ($printData['optCodes']['기타시설'] as $_item)
                                        <tr>
                                            <td style="text-align:left !important; width: 50%;"><i class="ri-checkbox-line"></i> {{ $_item }}</td>
                                            @if ($loop->remaining)
                                            <td style="text-align:left !important; width: 50%;"><i class="ri-checkbox-line"></i> {{ $printData['optCodes']['기타시설'][$loop->index + 1] }}</td>
                                            @endif
                                        </tr>
                                        @if ($loop->remaining)
                                        @php $loop->next() @endphp
                                        @endif
                                        @endforeach
                                    </table>
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
    
                                    <div style="width:auto;height:400px;">
                                        <div id="staticMap" style="width:auto;height:400px;">
                                            <img src="{{ $printData['mapUrl'] }}" alt="">
                                        </div>

                                        {{-- <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey={{ env('KAKAO_SCRIPT_KEY') }}"></script>
                                        <script>
                                            

                                            var staticMapContainer  = document.getElementById('staticMap'), // 이미지 지도를 표시할 div  
                                                staticMapOption = { 
                                                    center: new kakao.maps.LatLng({{ $printData['localY'] }}, {{ $printData['localX'] }}), // 이미지 지도의 중심좌표
                                                    level: 3 // 이미지 지도의 확대 레벨
                                                    , marker: {
                                                        position: new kakao.maps.LatLng({{ $printData['localY'] }}, {{ $printData['localX'] }}),
                                                        markerImage: new kakao.maps.MarkerImage(
                                                            'https://www.gyemoim.co.kr/images/map/map_mark.png',
                                                            new kakao.maps.Size(24, 35),
                                                            {offset: new kakao.maps.Point(12, 35)}
                                                        )
                                                    }
                                                };

                                            // 이미지 지도를 표시할 div와 옵션으로 이미지 지도를 생성합니다
                                            var staticMap = new kakao.maps.StaticMap(staticMapContainer, staticMapOption);

                                            // 지도에 원을 표시한다
                                            var circle = new kakao.maps.Circle({
                                                map: map, // 원을 표시할 지도 객체
                                                center : new kakao.maps.LatLng({{ $printData['localY'] }}, {{ $printData['localX'] }}), // 지도의 중심 좌표
                                                radius : 300, // 원의 반지름 (단위 : m)
                                                fillColor: 'rgba(56, 95, 141, 0.44)', // 채움 색
                                                fillOpacity: 0.9, // 채움 불투명도
                                                strokeWeight: 3, // 선의 두께
                                                strokeColor: 'rgba(56, 95, 141, 0.44)', // 선 색
                                                strokeOpacity: 0.1, // 선 투명도 
                                                strokeStyle: 'solid' // 선 스타일
                                            });	

                                            // 원을 지도에 추가
                                            circle.setMap(staticMap);
                                        </script> --}}

                                    </div>
    
                                </div>
                            </div>
    
    
                            @if(!empty($printData['infra']['교육시설']) || !empty($printData['infra']['주변시설']) || !empty($printData['infra']['교통정보']))
                            <div class="col-lg-12 pl-0 pr-0">
                                <div class="whats_nearby mt30 nearby_w">
                                    <h4 class="mb10">근처시설
                                    </h4>
            
                                    @if(!empty($printData['infra']['교육시설']))
                                    <div class="education_distance mb15 education_w">
                                        <h5><i class="ri-school-line"></i> 교육시설
                                        </h5>
                                        <table class="table table-borderless" style="margin-bottom: 0;">
                                        @foreach ($printData['infra']['교육시설'] as $_row)
                                        
                                            <tr style="">
                                                <td style="text-align:left !important;border-top: none !important; width: 50%; padding: 0;">
                                                    <div class="single_line single_w nearby-infra edu" >
                                                        <p class="para" style="margin-bottom: 0;">{{ $_row['place_name'] }}</p>
                                                    </div>
                                                </td>
                                                <td style="text-align:right !important;border-top: none !important; width: 50%; padding: 0;">
                                                    
                                                            <p style="margin-bottom: 0;">{{ number_format($_row['distance']) }}m</p>
                                                    
                                                </td>
                                            </tr>
                                        
                                        @endforeach
                                        </table>
                                    </div>
                                    @endif
    
                                    @if(!empty($printData['infra']['주변시설']))
                                    <div class="education_distance mb15 style2 education_w">
                                        <h5><i class="ri-store-line"></i> 주변시설
                                        </h5>
                                        <table class="table table-borderless" style="margin-bottom: 0;">
                                        @foreach ($printData['infra']['주변시설'] as $_row)
                                        
                                            <tr style="">
                                                <td style="text-align:left !important;border-top: none !important; width: 50%; padding: 0;">
                                                    <div class="single_line single_w nearby-infra near" data-x="{{ $_row['x'] }}"
                                                        data-y="{{ $_row['y'] }}">
                                                        <p class="para" style="margin-bottom: 0;">{{ $_row['place_name'] }}</p>
                                                    </div>
                                                </td>
                                                <td style="text-align:right !important;border-top: none !important; width: 50%; padding: 0;">
                                                    <p style="margin-bottom: 0;">{{ number_format($_row['distance']) }}m</p>
                                                </td>
                                            </tr>
                                       
                                        @endforeach 
                                        </table>
                                    </div>
                                    @endif
    
                                    @if(!empty($printData['infra']['교통정보']))
                                    <div class="education_distance style3 education_w">
                                        <h5><i class="ri-bus-2-line"></i> 교통정보
                                        </h5>
                                        <table class="table table-borderless" style="margin-bottom: 0;">
                                        @foreach ($printData['infra']['교통정보'] as $_row)
                                        
                                            <tr style="">
                                                <td style="text-align:left !important;border-top: none !important; width: 50%; padding: 0;">
                                                    <div class="single_line single_w nearby-infra near" data-x="{{ $_row['x'] }}"
                                                        data-y="{{ $_row['y'] }}">
                                                        <p class="para" style="margin-bottom: 0;">{{ $_row['place_name'] }}</p>
                                                    </div>
                                                </td>
                                                <td style="text-align:right !important;border-top: none !important; width: 50%; padding: 0;">
                                                    <p style="margin-bottom: 0;">{{ number_format($_row['distance']) }}m</p>
                                                </td>
                                            </tr>

                                        @endforeach
                                        </table>
                                    </div>
                                    @endif
    
                                    
                                    {{-- 근처시설 없는경우  --}}
                                    {{-- <p class="nonearby"><i class="ri-information-line"></i>해당사항 없음</p> --}}
                                    
                                </div>
                            </div>
                            @endif
                           
                        </div>
                    </div>
    
                </div>
            </div>
        </section>
    </div>
    
   
    </div>