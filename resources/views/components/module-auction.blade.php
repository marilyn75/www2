@extends('layout.layout')

@section('content')
<form name="frm" action="" method="post" class="col-md-12">
    @csrf
    <input type="hidden" name="page" value="1">
<section class="our-listing pb30-991">
    <div class="container_w">
        <div class="col-md-12 col-lg-12">

            <!-- 검색결과 -->
            <div class="row row_w">
                <div class="grid_list_search_result search_result_w auc_serch">
                    <div class="left_area tac-xsd">
                        <p>검색결과 <span class="mont point_c">{{ number_format($data['totalCount']) }}</span>건</p>
                    </div>
                </div>
            </div>
            <!-- 검색결과 end -->

            <!-- 검색필터 -->
            <!-- 경매+공매 -->
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
            <div class="row mt80 auc_list_r">

                @foreach ($data['items'] as $_item)
                @php
                    $_item = (new App\Http\Class\AuctionClass)->getPrintData($_item);
                @endphp
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="feat_property home7 style4 bdrrn feat_property_w">
                        <div class="thumb auction_thumb">
                            <img class="img-whp" src="{{ env('AUCTION_API_URL') }}/images/{{ $_item['saNo'] }}/{{ $_item['대표사진'] }}" alt="{{ $_item['대표사진'] }}" >
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
                                    <p class="auc_num">{{ $_item['법원'] }} {{ $_item['사건번호'] }}[{{ $_item['물건번호'] }}]</p>
                                    <p class="auc_dd">{{ $_item['dday'] }}</p>
                                </div>
                                <h4>{{ $_item['소재지'] }}</h4>
                                <p class="app_vlu">{{ price_kor($_item['감정가']) }}원</p>
                                <p class="low_vlu">{{ price_kor($_item['최저가']) }}원
                                    @if ($_item['할인율'] > 0)
                                    <span>(<i class="ri-arrow-down-line"></i>{{ $_item['할인율'] }}%)</span>
                                    @endif
                                </p>
                            </div>
                            <ul class="auc_hash">
                                @if ($_item['유찰횟수'] > 0)
                                <li>
                                    <p>#유찰{{ $_item['유찰횟수'] }}회</p>
                                </li>    
                                @endif
                                
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
                @endforeach
                
            </div>
            <x-pagination type="api" :data="$data" />
            <!-- list end -->
        </div>
        <!-- 검색결과 end -->
    </div>
</section>

</form>
@endsection