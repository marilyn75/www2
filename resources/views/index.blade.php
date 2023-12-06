@extends('layout.layout')

@section('content')

<!-- Home Design -->
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
                                            <select class="selectpicker w100 show-tick">
                                                <option>상업용</option>
                                                <option>상업용</option>
                                                <option>주거용</option>
                                                <option>경매</option>
                                                <option>프랜차이즈</option>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-inline-item">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="exampleInputName1"
                                            placeholder="지역, 도로명, 지번주소, 프랜차이즈명">
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

<!-- Why Chose Us -->
<section id="why-chose" class="whychose_us pb30">
    <div class="container container_w">
        <div class="row">
            <div class="col-md-4 col-lg-4 col-xl-4">
                <div class="why_chose_us home7 empty">
                    <p class="mont">image</p>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 col-xl-4">
                <div class="why_chose_us home7 empty">
                    <p class="mont">image</p>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 col-xl-4">
                <div class="why_chose_us home7 empty">
                    <p class="mont">image</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Feature Properties -->
<section id="feature-property" class="feature-property bgc-f7 pb30">
    <div class="container container_w">
        <div class="tit_btn">
            <div class="main-title subtit">
                <h2><span class="mont">NEW </span>신규매물</h2>
                <p>최고의 매물을 놓치지 마세요</p>
            </div>
            <button class="more_btn">
                더보기<i class="ri-arrow-right-line"></i>
            </button>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-4">
                <div class="feat_property home7 style4 bdrrn feat_property_w">
                    <div class="thumb">
                        <img class="img-whp" src="images/property/BI1.PNG" alt="BI1.PNG">
                        <div class="thmb_cntnt">
                            <ul class="tag mb0">
                                <li class="list-inline-item"><a href="#"><i class="ri-heart-3-line"></i></a>
                                </li>
                                <li class="list-inline-item"><a href="#"><i class="ri-thumb-up-fill"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="details details_w">
                        <div class="tc_content tc_content_w">
                            <p class="text-thm">상가건물</p>
                            <h4>최고의 선택, 밸류업</h4>
                            <div class="text-inf-w text-inf_main">
                                <p class="text-inf"><i class="ri-building-line"></i>일반상업지 1,000㎡</p>
                                <p class="text-inf"><i class="ri-building-line"></i>B1/15F 연10,000㎡</p>
                            </div>
                            <p class="text-inf"><i class="ri-map-pin-2-line"></i>부산광역시 해운대구 우동</p>
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
            <div class="col-sm-6 col-md-6 col-lg-4">
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
                            <div class="text-inf-w text-inf_main">
                                <p class="text-inf"><i class="ri-building-line"></i>전유면적 1,000㎡</p>
                                <p class="text-inf"><i class="ri-building-line"></i>해당층 1/15F</p>
                            </div>
                            <p class="text-inf"><i class="ri-map-pin-2-line"></i>부산광역시 부산진구 부전동</p>
                            <p class="text-thm price_w">임대 <span class="mont">30,000 / 1,000</span> 만원</p>
                        </div>
                        <div class="fp_footer fp_footer_w">
                            <ul class="fp_meta float-left mb0 fp_meta_w">
                                <li class="list-inline-item"><a href="#"><img src="images/property/HM1.PNG"
                                            alt="HM1.PNG"></a></li>
                                <li class="list-inline-item"><a href="#">송땡땡 부동산연구소</a></li>
                            </ul>
                            <p class="fp_pdate mont">2 day ago</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-4">
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
                            <div class="text-inf-w text-inf_main">
                                <p class="text-inf"><i class="ri-building-line"></i>일반상업지 333㎡</p>
                                <p class="text-inf"><i class="ri-building-line"></i>단층 연100㎡</p>
                            </div>
                            <p class="text-inf"><i class="ri-map-pin-2-line"></i>부산광역시 연제구 연산동</p>
                            <p class="text-thm price_w">매매 <span class="mont">150,000</span> 만원</p>
                        </div>
                        <div class="fp_footer fp_footer_w">
                            <ul class="fp_meta float-left mb0 fp_meta_w">
                                <li class="list-inline-item"><a href="#"><img src="images/property/AI3.PNG"
                                            alt="AI3.PNG"></a></li>
                                <li class="list-inline-item"><a href="#">M3consulting Inc.</a></li>
                            </ul>
                            <p class="fp_pdate mont">3 day ago</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-4">
                <div class="feat_property home7 style4 bdrrn feat_property_w">
                    <div class="thumb">
                        <img class="img-whp" src="images/property/BI1.PNG" alt="BI1.PNG">
                        <div class="thmb_cntnt">
                            <ul class="tag mb0">
                                <li class="list-inline-item"><a href="#"><i class="ri-heart-3-fill full-heart"></i></a>
                                </li>
                                <li class="list-inline-item"><a href="#"><i class="ri-thumb-up-fill"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="details details_w">
                        <div class="tc_content tc_content_w">
                            <p class="text-thm">상가건물</p>
                            <h4>최고의 선택, 밸류업</h4>
                            <div class="text-inf-w text-inf_main">
                                <p class="text-inf"><i class="ri-building-line"></i>일반상업지 333㎡</p>
                                <p class="text-inf"><i class="ri-building-line"></i>단층 연100㎡</p>
                            </div>
                            <p class="text-inf"><i class="ri-map-pin-2-line"></i>부산광역시 해운대구 우동</p>
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
            <div class="col-sm-6 col-md-6 col-lg-4">
                <div class="feat_property home7 style4 bdrrn feat_property_w">
                    <div class="thumb">
                        <img class="img-whp" src="images/property/BI1.PNG" alt="BI1.PNG">
                        <div class="thmb_cntnt">
                            <ul class="tag mb0">
                                <li class="list-inline-item"><a href="#"><i class="ri-heart-3-line"></i></a>
                                </li>
                                <li class="list-inline-item"><a href="#"><i class="ri-thumb-up-fill"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="details details_w">
                        <div class="tc_content tc_content_w">
                            <p class="text-thm">상가건물</p>
                            <h4>최고의 선택, 밸류업</h4>
                            <div class="text-inf-w text-inf_main">
                                <p class="text-inf"><i class="ri-building-line"></i>일반상업지 1,000㎡</p>
                                <p class="text-inf"><i class="ri-building-line"></i>B1/15F 연10,000㎡</p>
                            </div>
                            <p class="text-inf"><i class="ri-map-pin-2-line"></i>부산광역시 해운대구 우동</p>
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
            <div class="col-sm-6 col-md-6 col-lg-4">
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
                            <div class="text-inf-w text-inf_main">
                                <p class="text-inf"><i class="ri-building-line"></i>전유면적 1,000㎡</p>
                                <p class="text-inf"><i class="ri-building-line"></i>해당층 1/15F</p>
                            </div>
                            <p class="text-inf"><i class="ri-map-pin-2-line"></i>부산광역시 부산진구 부전동</p>
                            <p class="text-thm price_w">임대 <span class="mont">30,000 / 1,000</span> 만원</p>
                        </div>
                        <div class="fp_footer fp_footer_w">
                            <ul class="fp_meta float-left mb0 fp_meta_w">
                                <li class="list-inline-item"><a href="#"><img src="images/property/HM1.PNG"
                                            alt="HM1.PNG"></a></li>
                                <li class="list-inline-item"><a href="#">송땡땡 부동산연구소</a></li>
                            </ul>
                            <p class="fp_pdate mont">2 day ago</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Property Cities -->
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
                <div class="properti_city home7">
                    <div class="thumb">
                        <img class="img-fluid w100" src="images/property/C1.jpg" alt="C1.jpg">
                        <div class="overlay"></div>
                    </div>
                    <div class="details city_tit">
                        <h4>동래구 <span class="mont">24</span>개</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-xl-8">
                <div class="properti_city home7">
                    <div class="thumb">
                        <img class="img-fluid w100" src="images/property/C2.jpg" alt="C2.jpg">
                        <div class="overlay"></div>
                    </div>
                    <div class="details city_tit">
                        <h4>해운대구 <span class="mont">18</span>개</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-xl-8">
                <div class="properti_city home7">
                    <div class="thumb">
                        <img class="img-fluid w100" src="images/property/C3.jpg" alt="C3.jpg">
                        <div class="overlay"></div>
                    </div>
                    <div class="details city_tit">
                        <h4>수영구 <span class="mont">89</span>개</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xl-4">
                <div class="properti_city home7">
                    <div class="thumb">
                        <img class="img-fluid w100" src="images/property/C4.jpg" alt="C4.jpg">
                        <div class="overlay"></div>
                    </div>
                    <div class="details city_tit">
                        <h4>부산진구 <span class="mont">47</span>개</h4>
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
                    <button type="submit" class="btn btn-thm btn-thm_w">더보기</button>
                </div>
            </div>
            <div class="col-sm-3 col-md-6 col-lg-3 hot_list">
                <div class="feat_property home7 style4 bdrrn feat_property_w feat_main">
                    <div class="thumb">
                        <img class="img-whp" src="images/property/BI1.PNG" alt="BI1.PNG">
                        <div class="thmb_cntnt">
                            <ul class="tag mb0">
                                <li class="list-inline-item"><a href="#"><i class="ri-heart-3-line"></i></a>
                                </li>
                                <li class="list-inline-item"><a href="#"><i class="ri-thumb-up-fill"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="details details_w">
                        <div class="tc_content tc_content_w">
                            <p class="text-thm text-thm_main">상가건물</p>
                            <h4>최고의 선택, 밸류업</h4>
                            <div class="text-inf-w text_wrap_main">
                                <p class="text-inf"><i class="ri-building-line"></i>일반상업지 1,000㎡</p>
                                <p class="text-inf"><i class="ri-building-line"></i>B1/15F 연10,000㎡</p>
                            </div>
                            <p class="text-inf"><i class="ri-map-pin-2-line"></i>부산광역시 해운대구 우동</p>
                            <p class="text-thm price_w">매매 <span class="mont">1,000,000</span> 만원</p>
                        </div>
                        <div class="fp_footer fp_footer_w fp_main">
                            <ul class="fp_meta float-left mb0 fp_meta_w fp_meta_main">
                                <li class="list-inline-item"><a href="#"><img src="images/property/AI4.PNG"
                                            alt="AI4.PNG"></a></li>
                                <li class="list-inline-item"><a href="#">(주)부동산중개법인개벽</a></li>
                            </ul>
                            <p class="fp_pdate mont">1 day ago</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-6 col-lg-3 hot_list">
                <div class="feat_property home7 style4 bdrrn feat_property_w feat_main">
                    <div class="thumb">
                        <img class="img-whp" src="images/property/rent1.PNG" alt="rent1.PNG">
                        <div class="thmb_cntnt">
                            <ul class="tag mb0">
                                <li class="list-inline-item"><a href="#"><i class="ri-heart-3-line"></i></a>
                                </li>
                                <li class="list-inline-item"><a href="#"><i class="ri-thumb-up-fill"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="details details_w">
                        <div class="tc_content tc_content_w">
                            <p class="text-thm">상가건물</p>
                            <h4>최고의 선택, 밸류업</h4>
                            <div class="text-inf-w text_wrap_main">
                                <p class="text-inf"><i class="ri-building-line"></i>일반상업지 1,000㎡</p>
                                <p class="text-inf"><i class="ri-building-line"></i>B1/15F 연10,000㎡</p>
                            </div>
                            <p class="text-inf"><i class="ri-map-pin-2-line"></i>부산광역시 해운대구 우동</p>
                            <p class="text-thm price_w">매매 <span class="mont">1,000,000</span> 만원</p>
                        </div>
                        <div class="fp_footer fp_footer_w fp_main">
                            <ul class="fp_meta float-left mb0 fp_meta_w fp_meta_main">
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
</section>

<!-- Our Testimonials -->
<section class="our-testimonials">
    <div class="container container_w">
        <div>
            <div class="main-title subtit">
                <h2>전문가 추천</h2>
                <p>전문가의 눈으로 선별한 최고의 매물을 만나보세요.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="testimonial_grid_slider style2">
                    <div class="item item_main">
                        <div class="testimonial_grid style2 col-lg-4 employ_bx">
                            <div class="all_bx">
                                <div class="prof">
                                    <div class="employ_prof_w">
                                        <img src="images/property/profile.jpg" alt="">
                                    </div>
                                    <div class="employ_name">
                                        <p>중개보조원</p>
                                        <p class="en">김중개</p>
                                    </div>
                                </div>
                                <button class="btn btn-thm btn-thm_w">더보기</button>
                            </div>
                        </div>
                        <div class="testimonial_grid style2 col-lg-4 employ_bx">
                            <div class="all_bx">
                                <div class="prof">
                                    <div class="employ_prof_w">
                                        <img src="images/property/profile02.jpg" alt="">
                                    </div>
                                    <div class="employ_name">
                                        <p>소속공인중개사</p>
                                        <p class="en">이중개</p>
                                    </div>
                                </div>
                                <button class="btn btn-thm btn-thm_w">더보기</button>
                            </div>
                        </div>
                        <div class="testimonial_grid style2 col-lg-4 employ_bx">
                            <div class="all_bx">
                                <div class="prof">
                                    <div class="employ_prof_w">
                                        <img src="images/property/profile03.jpg" alt="">
                                    </div>
                                    <div class="employ_name">
                                        <p>중개보조원</p>
                                        <p class="en">박중개</p>
                                    </div>
                                </div>
                                <button class="btn btn-thm btn-thm_w">더보기</button>
                            </div>
                        </div>
                    </div>
                    <div class="item item_main">
                        <div class="testimonial_grid style2 col-lg-4 employ_bx">
                            <div class="all_bx">
                                <div class="prof">
                                    <div class="employ_prof_w">
                                        <img src="images/property/profile.jpg" alt="">
                                    </div>
                                    <div class="employ_name">
                                        <p>중개보조원</p>
                                        <p class="en">김중개</p>
                                    </div>
                                </div>
                                <button class="btn btn-thm btn-thm_w">더보기</button>
                            </div>
                        </div>
                        <div class="testimonial_grid style2 col-lg-4 employ_bx">
                            <div class="all_bx">
                                <div class="prof">
                                    <div class="employ_prof_w">
                                        <img src="images/property/profile02.jpg" alt="">
                                    </div>
                                    <div class="employ_name">
                                        <p>소속공인중개사</p>
                                        <p class="en">이중개</p>
                                    </div>
                                </div>
                                <button class="btn btn-thm btn-thm_w">더보기</button>
                            </div>
                        </div>
                        <div class="testimonial_grid style2 col-lg-4 employ_bx">
                            <div class="all_bx">
                                <div class="prof">
                                    <div class="employ_prof_w">
                                        <img src="images/property/profile03.jpg" alt="">
                                    </div>
                                    <div class="employ_name">
                                        <p>중개보조원</p>
                                        <p class="en">박중개</p>
                                    </div>
                                </div>
                                <button class="btn btn-thm btn-thm_w">더보기</button>
                            </div>
                        </div>
                    </div>
                    <div class="item item_main">
                        <div class="testimonial_grid style2 col-lg-4 employ_bx">
                            <div class="all_bx">
                                <div class="prof">
                                    <div class="employ_prof_w">
                                        <img src="images/property/profile.jpg" alt="">
                                    </div>
                                    <div class="employ_name">
                                        <p>중개보조원</p>
                                        <p class="en">김중개</p>
                                    </div>
                                </div>
                                <button class="btn btn-thm btn-thm_w">더보기</button>
                            </div>
                        </div>
                        <div class="testimonial_grid style2 col-lg-4 employ_bx">
                            <div class="all_bx">
                                <div class="prof">
                                    <div class="employ_prof_w">
                                        <img src="images/property/profile02.jpg" alt="">
                                    </div>
                                    <div class="employ_name">
                                        <p>소속공인중개사</p>
                                        <p class="en">이중개</p>
                                    </div>
                                </div>
                                <button class="btn btn-thm btn-thm_w">더보기</button>
                            </div>
                        </div>
                        <div class="testimonial_grid style2 col-lg-4 employ_bx">
                            <div class="all_bx">
                                <div class="prof">
                                    <div class="employ_prof_w">
                                        <img src="images/property/profile03.jpg" alt="">
                                    </div>
                                    <div class="employ_name">
                                        <p>중개보조원</p>
                                        <p class="en">박중개</p>
                                    </div>
                                </div>
                                <button class="btn btn-thm btn-thm_w">더보기</button>
                            </div>
                        </div>
                    </div>
                    <div class="item item_main">
                        <div class="testimonial_grid style2 col-lg-4 employ_bx">
                            <div class="all_bx">
                                <div class="prof">
                                    <div class="employ_prof_w">
                                        <img src="images/property/profile.jpg" alt="">
                                    </div>
                                    <div class="employ_name">
                                        <p>중개보조원</p>
                                        <p class="en">김중개</p>
                                    </div>
                                </div>
                                <button class="btn btn-thm btn-thm_w">더보기</button>
                            </div>
                        </div>
                        <div class="testimonial_grid style2 col-lg-4 employ_bx">
                            <div class="all_bx">
                                <div class="prof">
                                    <div class="employ_prof_w">
                                        <img src="images/property/profile02.jpg" alt="">
                                    </div>
                                    <div class="employ_name">
                                        <p>소속공인중개사</p>
                                        <p class="en">이중개</p>
                                    </div>
                                </div>
                                <button class="btn btn-thm btn-thm_w">더보기</button>
                            </div>
                        </div>
                        <div class="testimonial_grid style2 col-lg-4 employ_bx">
                            <div class="all_bx">
                                <div class="prof">
                                    <div class="employ_prof_w">
                                        <img src="images/property/profile03.jpg" alt="">
                                    </div>
                                    <div class="employ_name">
                                        <p>중개보조원</p>
                                        <p class="en">박중개</p>
                                    </div>
                                </div>
                                <button class="btn btn-thm btn-thm_w">더보기</button>
                            </div>
                        </div>
                    </div>
                    <div class="item item_main">
                        <div class="testimonial_grid style2 col-lg-4 employ_bx">
                            <div class="all_bx">
                                <div class="prof">
                                    <div class="employ_prof_w">
                                        <img src="images/property/profile.jpg" alt="">
                                    </div>
                                    <div class="employ_name">
                                        <p>중개보조원</p>
                                        <p class="en">김중개</p>
                                    </div>
                                </div>
                                <button class="btn btn-thm btn-thm_w">더보기</button>
                            </div>
                        </div>
                        <div class="testimonial_grid style2 col-lg-4 employ_bx">
                            <div class="all_bx">
                                <div class="prof">
                                    <div class="employ_prof_w">
                                        <img src="images/property/profile02.jpg" alt="">
                                    </div>
                                    <div class="employ_name">
                                        <p>소속공인중개사</p>
                                        <p class="en">이중개</p>
                                    </div>
                                </div>
                                <button class="btn btn-thm btn-thm_w">더보기</button>
                            </div>
                        </div>
                        <div class="testimonial_grid style2 col-lg-4 employ_bx">
                            <div class="all_bx">
                                <div class="prof">
                                    <div class="employ_prof_w">
                                        <img src="images/property/profile03.jpg" alt="">
                                    </div>
                                    <div class="employ_name">
                                        <p>중개보조원</p>
                                        <p class="en">박중개</p>
                                    </div>
                                </div>
                                <button class="btn btn-thm btn-thm_w">더보기</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Blog -->
<section class="our-blog bgc-f7 pb100">
    <div class="container container_w">
        <div>
            <div class="main-title subtit">
                <h2><span>NEWS </span>인사이드</h2>
                <p>주목할만한 부동산 소식을 여기서 만나보세요.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-md-4 col-lg-4 main_news">
                <h5>경제학자 곽수종 “내년 올해보다 어렵다… 2025년엔 리바운드”</h5>
                <p class="mont">2023. 12. 05</p>
                <div class="mn_nws_img">
                    <p>image</p>
                </div>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4 main_news">
                <h5>“지역업체 써달라” 서울 본사 찾아 하도급 세일즈 나선 부산시</h5>
                <p class="mont">2023. 12. 05</p>
                <div class="mn_nws_img">
                    <p>image</p>
                </div>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4 main_news">
                <h5>아파트중개플랫폼 ‘부동산서베이’, 사회초년생 무료 강의</h5>
                <p class="mont">2023. 12. 05</p>
                <div class="mn_nws_img">
                    <p>image</p>
                </div>
            </div>
        </div>
    </div>
</section>




@endsection