@extends('layout.layout')

@section('content')

<!-- Home Design -->
{{-- <form action="{{ route('page', 20) }}" method="POST">
    @csrf
    <input type="hidden" name="page" value="1">
<section class="home-seven home_w">
    <div class="container container_w">
        <div class="main_tit">
            <h2>전문가들의 추천매물과<br>최고의 투자 기회를 만나보세요</h2>
        </div>
        <div>
            <div>
                <div class="home_content home7 home_bx">
                    <div class="home_adv_srch_opt home7">
                        <div class="home1-advnc-search home7 home_search_w">
                            <ul class="h1ads_1st_list mb0 text-center">
                                <li class="list-inline-item">
                                    <div class="search_option_two">
                                        <div class="candidate_revew_select">
                                            <select name="cate1" class="selectpicker w100 show-tick">
                                            @foreach($sale_codes as $_code)
                                                <option value="{{ $_code['id'] }}">{{ $_code['title'] }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-inline-item">
                                    <div class="form-group">
                                        <input type="text" name="location" class="form-control" id="exampleInputName1" placeholder="지역명">
                                    </div>
                                </li>
                                <li class="list-inline-item">
                                    <div class="search_option_button">
                                        <button type="submit" class="btn btn-thm btn-thm_w">검색</button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</form> --}}

<!-- Home Design -->
<form action="{{ env('MENU_LINK_INTRA_SALE') }}" method="POST">
    @csrf
    <input type="hidden" name="page" value="1">
    <div class="container container_w">
        <section class="mainslider">
            <swiper-container class="mainswiper" pagination="false" navigation="false" loop="true" autoplay="true" delay="5000" speed="600">
                <swiper-slide>
                    <img src="/images/slide/slide01.png" alt="">
                </swiper-slide>
                <swiper-slide>
                    <img src="/images/slide/slide02.png" alt="">
                </swiper-slide>
                <swiper-slide>
                    <img src="/images/slide/slide03.png" alt="">
                </swiper-slide>
                <swiper-slide>
                    <img src="/images/slide/slide04.png" alt="">
                </swiper-slide>
            </swiper-container>
            <div class="container container_w">
                <div class="main_tit main_tit_new">
                    <h2>전문가들의 추천매물과<br>최고의 투자 기회를 만나보세요</h2>
                </div>
                <div>
                    <div>
                        <div class="home_content home7 home_bx home_bx_new">
                            <div class="home_adv_srch_opt home7">
                                <div class="home1-advnc-search home7 home_search_w">
                                    <ul class="h1ads_1st_list mb0 text-center">
                                        <li class="list-inline-item">
                                            <div class="search_option_two">
                                                <div class="candidate_revew_select">
                                                    <select name="cate1" class="selectpicker w100 show-tick">
                                                    @foreach($sale_codes as $_code)
                                                        <option value="{{ $_code['id'] }}">{{ $_code['title'] }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-inline-item">
                                            <div class="form-group">
                                                <input type="text" name="location" class="form-control" id="exampleInputName1" placeholder="지역명">
                                            </div>
                                        </li>
                                        <li class="list-inline-item">
                                            <div class="search_option_button">
                                                <button type="submit" class="btn btn-thm btn-thm_w">검색</button>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</form>

  <script src="/js/swiper-element-bundle.min.js">
</script>

<!-- Feature Properties -->
<section id="feature-property" class="feature-property bgc-f7">
    <div class="container container_w">
        <div class="tit_btn">
            <div class="main-title subtit">
                <h2><span class="mont">NEW </span>신규매물</h2>
                <p>최고의 매물을 놓치지 마세요</p>
            </div>
            <a href="{{ env('MENU_LINK_INTRA_SALE') }}" class="more_btn">더보기<i class="ri-arrow-right-line"></i>
            </a>
        </div>
        <div class="row">
            @foreach ($newSales as $_data)
            @php
            
            $printData = App\Http\Class\IntraSaleClass::getPrintData($_data);

            @endphp
            <x-item-sale-intranet type='recommend' :printData="$printData" />

            @endforeach
        </div>
        
    </div>
</section>

<!-- Property Cities -->
<form name="frmCities" action="{{ env('MENU_LINK_INTRA_SALE') }}" method="POST">
    @csrf
    <input type="hidden" name="page" value="1">
    <input type="hidden" name="location">
</form>
<section id="property-city" class="property-city pb30">
    <div class="container container_w">
        <div>
            <div class="main-title subtit">
                <h2>다음 도시에서의 놀라운 발견</h2>
                <p>다양한 구역의 특별한 매물, 최고의 선택을 제공합니다.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-xl-4">
                <div class="properti_city home7" onclick="frmCities.location.value='동래구';frmCities.submit();">
                    <div class="thumb">
                        <img class="img-fluid w100" src="images/property/C1.jpg" alt="C1.jpg">
                        <div class="overlay"></div>
                    </div>
                    <div class="details city_tit">
                        <h4>동래구 <span class="mont">{{ number_format($localSaleCnt->동래구) }}</span>개</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-xl-8">
                <div class="properti_city home7" onclick="frmCities.location.value='해운대구';frmCities.submit();">
                    <div class="thumb">
                        <img class="img-fluid w100" src="images/property/C2.jpg" alt="C2.jpg">
                        <div class="overlay"></div>
                    </div>
                    <div class="details city_tit">
                        <h4>해운대구 <span class="mont">{{ number_format($localSaleCnt->해운대구) }}</span>개</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-xl-8">
                <div class="properti_city home7" onclick="frmCities.location.value='수영구';frmCities.submit();">
                    <div class="thumb">
                        <img class="img-fluid w100" src="images/property/C3.jpg" alt="C3.jpg">
                        <div class="overlay"></div>
                    </div>
                    <div class="details city_tit">
                        <h4>수영구 <span class="mont">{{ number_format($localSaleCnt->수영구) }}</span>개</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xl-4">
                <div class="properti_city home7" onclick="frmCities.location.value='부산진구';frmCities.submit();">
                    <div class="thumb">
                        <img class="img-fluid w100" src="images/property/C4.jpg" alt="C4.jpg">
                        <div class="overlay"></div>
                    </div>
                    <div class="details city_tit">
                        <h4>부산진구 <span class="mont">{{ number_format($localSaleCnt->부산진구) }}</span>개</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Hot Offier -->
<section class="our-hot-offer parallax hot_w" data-stellar-background-ratio="0.3">
    <div class="container container_w">
        <div class="row align-items-center">
            <div class="col-md-12 col-lg-6 hot_top">
                <div class="our_hotoffer hot_subtit">
                    <h4><span class="mont">HOT</span> 추천매물</h4>
                    <p>성공적인 거래를 위한 가장 큰 장점,<br>바로 우리의 경험이 만들어낸 매물 선별입니다.</p>
                    <button type="submit" class="btn btn-thm btn-thm_w" onclick="location.href='{{ route('page', 19).'?mode=recommend' }}'">더보기</button>
                </div>
            </div>
            @foreach ($recommendSales as $_data)
            @php
            
            $printData = App\Http\Class\IntraSaleClass::getPrintData($_data);

            @endphp
            <x-item-sale-intranet type='main_recommend' :printData="$printData" />

            @endforeach
        </div>
    </div>
</section>

<!-- Our Testimonials -->
<section class="our-testimonials">
    <div class="container container_w">
        <div class="tit_btn">
            <div class="main-title subtit">
                <h2>전문가 추천</h2>
                <p>전문가의 눈으로 선별한 최고의 매물을 만나보세요.</p>
            </div>
            <a class="more_btn" href="{{ route('page', 25) }}">
                더보기<i class="ri-arrow-right-line"></i>
            </a>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="testimonial_grid_slider style2">
                @foreach ($agents as $_i=>$_sawon)
                @php
                    $cls = new App\Http\Class\IntraSawonClass;
                    $_sawon = $cls->getPrintData($_sawon);
                @endphp

                @if($_i % 3 == 0)
                    <div class="item item_main">
                @endif
                        <div class="testimonial_grid style2 col-lg-4 employ_bx">
                            <div class="all_bx">
                                <div class="prof">
                                    <div class="employ_prof_w">
                                        <img src="{{ $_sawon['photo'] }}" alt="">
                                    </div>
                                    <div class="employ_name">
                                        <p>{{ $_sawon['sosok'] }}</p>
                                        <p class="en">{{ $_sawon['user_name'] }} {{ $_sawon['duty'] }}</p>
                                    </div>
                                </div>
                                <button class="btn btn-thm btn-thm_w" onclick="location.href='{{ route('page', 25).'?mode=view&idx='.$_sawon['idx'] }}'">더보기</button>
                            </div>
                        </div>
                @if($_i % 3 == 2)
                    </div>
                @endif
                @endforeach
                @if($_i % 3 != 2)
                    </div>
                @endif
                    
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 신문광고 -->
{{-- <section class="our-newspaper bgc-f7">
    <div class="container container_w">
        <div class="row align-items-center">
            <div class="col-8 col-sm-8 col-md-8 main-title subtit newsp_subtit">
                <h2>신문속의 <span class="mont">GYEMOIM INC .</span></h2>
                <p>매주 월, 수, 금 부산일보와 함께하는 신문광고</p>
                <button class="btn btn-thm btn-thm_w" onclick="location.href='{{ route('page', 29) }}'">더보기</button>
            </div>
            <div class="col-4 col-sm-4 col-md-4 news_imgw">
                <img src="/images/newspaper.png" alt="">
            </div>
        </div>
    </div>
</section> --}}
<section class="our-newspaper bgc-f7">
    <div class="container container_w">
        <div class="newsad_box">
            <a href="" class="news_link">
                <div class="news-title">
                    <h2>신문속의 <br><span class="mont">GYEMOIM INC .</span></h2>
                    <div class="article_wr">
                        <a href="{{ route('page',29) }}?code=70">
                            <div class="article_img">
                                <img src="/images/busan.png" alt="">
                            </div>
                        </a>
                        <a href="{{ route('page',29) }}?code=71"">
                            <div class="article_img">
                                <img src="/images/kukje.png" alt="">
                            </div>
                        </a>
                    </div>
                </div>
                <a href="{{ route('page',29) }}">
                <div class="news-arrow">
                    <i class="ri-arrow-right-line"></i>
                </div></a>
                <img src="/images/news_ad.png" alt="">
            </a>
        </div>
    </div>
</section>


<!-- 경공매 -->
@if (@$auctions['totalCount'] > 0)
<section id="feature-property" class="feature-property bgc-f7">
    <div class="container container_w">
        <div class="tit_btn">
            <div class="main-title subtit">
                <h2><span class="mont">GYEMOIM PICK </span>오늘의 경·공매</h2>
                <p>조회수 높은 경공매 매물을 만나보세요.</p>
            </div>
            <a href="{{ env('MENU_LINK_AUCTION') }}" class="more_btn">더보기<i class="ri-arrow-right-line"></i>
            </a>
        </div>
        <div class="row">
            @foreach ($auctions['items'] as $_item)
                @php
                    $printData = (new App\Http\Class\AuctionClass())->getPrintData($_item);
                    debug($printData);
                @endphp
                @if ($printData['gubun'] == 'a')
                    <x-item-auction type="main" :printData="$printData" />
                @else
                    <x-item-onbid  type="main" :printData="$printData" />
                @endif
            @endforeach
            {{-- <div class="col-sm-6 col-md-6 col-lg-4">
                <div class="feat_property home7 style4 bdrrn feat_property_w">
                    <div class="thumb">
                        <img class="img-whp" src="images/auction/auction01.png" alt="BI1.PNG">
                        <div class="thmb_cntnt">
                            <ul class="tag mb0">
                                <!-- 찜하기 전 -->
                                <li class="list-inline-item">
                                    <button data-url="modal.login-alert" class="heart_btn modal-button">
                                        <i class="ri-heart-3-line"></i>
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <!-- 경매 공매 표시 -->
                        <div class="auction_tag auc">
                            <p>경매</p>
                        </div>
                    </div>
                    <div class="details details_w auc_list">
                        <div class="auc_listw">
                            <div class="auc_list_t">
                                <p class="auc_num">서울동부지법 2021타경51574[1]</p>
                                <p class="auc_dd">D-26</p>
                            </div>
                            <h4>서울특별시 송파구 새말로 116, 2층 202호 (문정동, 한울리움)</h4>
                            <p class="app_vlu">3억 1700만원</p>
                            <p class="low_vlu">892만 3000원<span>(<i
                                        class="ri-arrow-down-line"></i>98%)</span></p>
                        </div>
                        <ul class="auc_hash">
                            <li>
                                <p>#유찰16회</p>
                            </li>
                            <li>
                                <p>#재매각</p>
                            </li>
                            <li>
                                <p>#선순위임자인</p>
                            </li>
                            <li>
                                <p>#선순위전세권</p>
                            </li>
                            <li>
                                <p>#위반건축물</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-4">
                <div class="feat_property home7 style4 bdrrn feat_property_w">
                    <div class="thumb">
                        <img class="img-whp" src="images/auction/auction01.png" alt="BI1.PNG">
                        <div class="thmb_cntnt">
                            <ul class="tag mb0">
                                <!-- 찜하기 전 -->
                                <li class="list-inline-item">
                                    <button data-url="modal.login-alert" class="heart_btn modal-button">
                                        <i class="ri-heart-3-line"></i>
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <!-- 경매 공매 표시 -->
                        <div class="auction_tag auc">
                            <p>경매</p>
                        </div>
                    </div>
                    <div class="details details_w auc_list">
                        <div class="auc_listw">
                            <div class="auc_list_t">
                                <p class="auc_num">서울동부지법 2021타경51574[1]</p>
                                <p class="auc_dd">D-26</p>
                            </div>
                            <h4>서울특별시 송파구 새말로 116, 2층 202호 (문정동, 한울리움)</h4>
                            <p class="app_vlu">3억 1700만원</p>
                            <p class="low_vlu">892만 3000원<span>(<i
                                        class="ri-arrow-down-line"></i>98%)</span></p>
                        </div>
                        <ul class="auc_hash">
                            <li>
                                <p>#유찰16회</p>
                            </li>
                            <li>
                                <p>#재매각</p>
                            </li>
                            <li>
                                <p>#선순위임자인</p>
                            </li>
                            <li>
                                <p>#선순위전세권</p>
                            </li>
                            <li>
                                <p>#위반건축물</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-4">
                <div class="feat_property home7 style4 bdrrn feat_property_w">
                    <div class="thumb">
                        <img class="img-whp" src="images/auction/auction03.png" alt="BI2.PNG">
                        <div class="thmb_cntnt">
                            <ul class="tag mb0">
                                <!-- 찜하기 전 -->
                                <li class="list-inline-item">
                                    <button data-url="modal.login-alert" class="heart_btn modal-button">
                                        <i class="ri-heart-3-line"></i>
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <!-- 경매 공매 표시 -->
                        <div class="auction_tag auc">
                            <p>경매</p>
                        </div>
                    </div>
                    <div class="details details_w auc_list">
                        <div class="auc_listw">
                            <div class="auc_list_t">
                                <p class="auc_num">창원지법 2022타경6498[1]</p>
                                <p class="auc_dd red_c">D-7</p>
                            </div>
                            <h4>경상남도 김해시 분성로 4, 110동 2층 201호 (외동,김해외동협성엘리시안)</h4>
                            <p class="app_vlu">2억 8600만원</p>
                            <p class="low_vlu">1억 8304원<span>(<i
                                        class="ri-arrow-down-line"></i>36%)</span></p>

                        </div>
                        <ul class="auc_hash">
                            <li>
                                <p>#유찰2회</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> --}}
        </div>
        
    </div>
</section>
@endif

<!-- Our Blog -->
<section class="our-blog bgc-f7 pb100">
    <div class="container container_w">
        <div class="tit_btn">
            <div class="main-title subtit">
                <h2><span>NEWS </span>인사이드</h2>
                <p>주목할만한 부동산 소식을 여기서 만나보세요.</p>
            </div>
            <a class="more_btn" href="{{ route('page', 30) }}">
                더보기<i class="ri-arrow-right-line"></i>
            </a>
        </div>
        <div class="row">
        @for ($i=0;$i<3;$i++)
            <div class="col-sm-4 col-md-4 col-lg-4 main_news">
                <a href="https://www.busan.com/view/busan/view.php?code={{ $news[$i]['CODE'] }}" target="_blank">
                    <h5>{{ $news[$i]['TITLE'] }}</h5>
                
                <p class="mont">{{ str_replace("-",".",$news[$i]['PUB_DATE']) }}</p>
                <div class="mn_nws_img">
                    <div class="thumb">
                        <img class="img-fluid w100" src="{{ __('https://www.busan.com/nas/wcms/wcms_data/photos/').$news[$i]['IMG_PATH'] }}" alt="{{ $news[$i]['IMG_PATH'] }}">
                    </div>
                </div>
                </a>
            </div>
        @endfor
        </div>
    </div>
</section>




@endsection