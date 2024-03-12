@extends('layout.layout')

@section('content')
<section class="our-listing pb30-991">
    <div class="container_w">
        <div class="col-md-12 col-lg-12">

            <!-- 검색결과 -->
            <div class="row row_w">
                <div class="grid_list_search_result search_result_w auc_serch">
                    <div class="left_area tac-xsd">
                        <p>검색결과 <span class="mont point_c">9</span>건</p>
                    </div>
                </div>
            </div>
            <!-- 검색결과 end -->

            <!-- 검색필터 -->
            <!-- 경매+공매 -->
            <div>
                <span class="dropdown-el">
                <input type="radio" name="sortType" value="Relevance" checked="checked"
                    id="sort-relevance"><label for="sort-relevance">경매+공매</label>
                <input type="radio" name="sortType" value="Popularity" id="sort-best"><label
                    for="sort-best">경매</label>
                <input type="radio" name="sortType" value="PriceIncreasing" id="sort-low"><label
                    for="sort-low">공매</label>
            </span>
            <!-- 지분필터 - 전체  -->
            <span class="dropdown-el down_width">
                <input type="radio" name="share" value="0" checked="checked" id="share-all"><label
                    for="share-all">지분필터-전체</label>
                <input type="radio" name="share" value="5" id="share-ex"><label for="share-ex">지분보기</label>
                <input type="radio" name="share" value="6" id="share-out"><label
                    for="share-out">지분제외</label>
            </span>
            <!-- 조회순 -->
            <span class="dropdown-el down_filt">
                <input type="radio" name="filt" value="0" checked="checked" id="sale-ear"><label
                    for="sale-ear">매각기일 빠른</label>
                <input type="radio" name="filt" value="5" id="sale-late"><label for="sale-late">매각기일
                    늦은</label>
                <input type="radio" name="filt" value="6" id="price-hight"><label for="price-hight">최저가
                    높은</label>
                <input type="radio" name="filt" value="6" id="price-low"><label for="price-low">최저가
                    낮은</label>
            </span>
            </div>
            


            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

            <script>
            $('.dropdown-el').click(function(e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).toggleClass('expanded');
                $('#' + $(e.target).attr('for')).prop('checked', true);
            });
            $(document).click(function() {
                $('.dropdown-el').removeClass('expanded');
            });
            </script>

            <!-- list -->
            <div class="row mt80">
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
                        <div class="thumb auction_thumb">
                            <img class="img-whp" src="images/auction/auction02.png" alt="rent1.PNG">
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
                        </div>
                        <div class="details details_w auc_list">
                            <div class="auc_listw">
                                <div class="auc_list_t">
                                    <p class="auc_num">진행중</p>
                                    <p class="auc_dd">~ 2024.01.24 17:00 마감</p>
                                </div>
                                <h4>경기도 고양시 덕양구 대자동 509-17</h4>
                                <p class="app_vlu">1억 6161만 6000원</p>
                                <p class="low_vlu">9697만원<span>(<i
                                            class="ri-arrow-down-line"></i>40%)</span></p>
                            </div>
                            <ul class="auc_hash">
                                <li>
                                    <p>#압류재산(캠코)</p>
                                </li>
                                <li>
                                    <p>#유찰4회</p>
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
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="feat_property home7 style4 bdrrn feat_property_w">
                        <div class="thumb auction_thumb">
                            <img class="img-whp" src="images/auction/auction02.png" alt="BI1.PNG">
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
                            <div class="auction_tag sell">
                                <p>공매</p>
                            </div>
                        </div>
                        <div class="details details_w auc_list">
                            <div class="auc_listw">
                                <div class="auc_list_t">
                                    <p class="auc_num">진행중</p>
                                    <p class="auc_dd">~ 2024.01.24 16:00 마감</p>
                                </div>
                                <h4>부산광역시 수영구 민락동 110-8 104동 1802호 롯데캐슬 자이언트 아파트</h4>
                                <p class="app_vlu">8억 5050만원</p>
                                <p class="low_vlu">7억 6545만원<span>(<i
                                            class="ri-arrow-down-line"></i>10%)</span></p>
                            </div>
                            <ul class="auc_hash">
                                <li>
                                    <p>#기타일반재산</p>
                                </li>
                                <li>
                                    <p>#유찰26회</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="feat_property home7 style4 bdrrn feat_property_w">
                        <div class="thumb">
                            <img class="img-whp" src="images/auction/auction01.png" alt="rent1.PNG">
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
                                <h4>경상남도 김해시 분성로 4, 110동 2층 201호 (외동, 김해외동협성엘리시안)</h4>
                                <p class="app_vlu">2억 8600만원</p>
                                <p class="low_vlu">1억 8304만원<span>(<i
                                            class="ri-arrow-down-line"></i>36%)</span></p>
                            </div>
                            <ul class="auc_hash">
                                <li>
                                    <p>#유찰2회</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt20">
                    <div class="mbp_pagination mbp_pagination_w">
                        <ul class="page_navigation">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true"> <span
                                        class="flaticon-left-arrow"></span> Prev</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active" aria-current="page">
                                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="#">29</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#"><span class="flaticon-right-arrow"></span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- list end -->
        </div>
        <!-- 검색결과 end -->
    </div>
</section>


@endsection