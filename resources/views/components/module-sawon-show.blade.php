<div class="row">
<form name="frm" action="{{ $data['sales']->path() }}" method="post" class="row pl15 pr15">
    @csrf
    <input type="hidden" name="page" value="1">
    <input type="hidden" name="mode" value="{{ $_REQUEST['mode'] }}">
    <input type="hidden" name="idx" value="{{ $_REQUEST['idx'] }}">
</form>
<div class="col-md-12 col-lg-8">
    <div class="row">
        <div class="col-lg-12">
            <div class="feat_property list style2 agent agent_bx">
                <div class="thumb agent_thumb">
                    <img class="img-whp" src="{{ $data['photo'] }}">
                </div>
                <div class="details details_w">
                    <div class="tc_content agent_inf">
                        <p>{{ $data['sosok'] }}</p>
                        <h4>{{ $data['user_name'] }} {{ $data['duty'] }}</h4>
                        <p class="mont">Tel. 1833-{{ $data['office_line'] }}</p>
                        @if($data['slogan'])<p>" {{ $data['slogan'] }} " </p>@endif
                        @if($data['introduce'])<p>" {{ $data['introduce'] }} "</p>@endif
                    </div>
                </div>
            </div>
            <div class="shop_single_tab_content style2 mt40 agent_bot_bx">
                <ul class="nav nav-tabs mb20" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="listing-tab" data-toggle="tab" href="#listing" role="tab"
                            aria-controls="listing" aria-selected="false">등록매물</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab"
                            aria-controls="review" aria-selected="false">리뷰</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent2">
                    {{-- 등록매물 s --}}
                    <div class="tab-pane fade row pl15 pl0-1199 pr15 pr0-1199 show active agent_enter" id="listing" role="tabpanel" aria-labelledby="listing-tab">
                        @if ($data['sales']->total()==0)
                        <div class="col-lg-12 pl0 pr0 feat_property feat_property_w">
                            <div class="product_single_content">
                                <div class="mbp_pagination_comments agent_review">
                                    <p><i class="ri-information-line"></i>등록된 매물이 없습니다.</p>
                                </div>
                            </div>
                        </div>
                        @else
                            @foreach ($data['sales'] as $_sale)
                            @php
                                $_sale = App\Http\Class\IntraSaleClass::getPrintData($_sale);
                            @endphp
                            <a href="{{ route('page',20).__('?mode=show&idx='.$_sale['idx']) }}">
                        <div class="col-lg-12 pl0 pr0 feat_property feat_property_w">
                            <div class="feat_property list style2 hvr-bxshd bdrrn agent_list">
                                <div class="thumb agent_thumb">
                                    <img class="img-whp" src="{{ $_sale['img2'] }}" >
                                </div>
                                <div class="details details_w">
                                    <div class="tc_content tc_content_w agent_content">
                                        <p class="text-thm type">{{ $_sale['category'] }}</p>
                                        <h4>{{ $_sale['title'] }}</h4>
                                        @if(!empty($_sale['area_b']))
                                            <div class="text-inf-w text-inf_main">
                                                <p class="text-inf"><i class="ri-split-cells-horizontal"></i>{{ $_sale['prposAreaNm'] }} {{ $_sale['floorInfo'] }}</p>
                                                <p class="text-inf"><i class="ri-building-line"></i>분양{{ $_sale['area_b'] }}㎡ 전용{{ $_sale['area_j'] }}㎡</p>
                                            </div>
                                        @else
                                            <div class="text-inf-w text-inf_main">
                                                <p class="text-inf"><i class="ri-split-cells-horizontal"></i>{{ $_sale['prposAreaNm'] }} {{ $_sale['landArea'] }}㎡</p>
                                                @if (strpos($_sale['category'],"토지")===false)
                                                <p class="text-inf"><i class="ri-building-line"></i>{{ $_sale['floorInfo']}} 연{{ $_sale['bdArea'] }}㎡</p>
                                                @endif
                                            </div>
                                        @endif
                                        <div class="enter_list">
                                            <p class="text-inf"><i class="ri-map-pin-2-line"></i>{{ $_sale['address'] }}</p>
                                            <p class="text-thm price_w">{{ $_sale['tradeType'] }} <span class="mont">{{ $_sale['price'] }}</span> 만원</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            </a>
                            @endforeach
                        <x-pagination :data="$data['sales']" />
                        @endif
                        
                    </div>
                    
                    {{-- 등록매물 e --}}
                    <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                        <div class="product_single_content">
                            <div class="mbp_pagination_comments agent_review">
                                <p><i class="ri-information-line"></i>준비중입니다</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="pt20 col-lg-4">

    <x-inquirybox type="default" :printData="$data" />

    <div class="sidebar_listing_list sidebar_enterinfo">
        <h4 class="mb20">중개등록정보</h4>
        <ul class="enterinfo">
            <li>
                <p>업체명</p>
                <p>(주)부동산중개법인 개벽</p>
            </li>
            <li>
                <p>허가번호</p>
                <p>26470-2018-00085</p>
            </li>
            <li>
                <p>소재지</p>
                <p>부산 연제구 중앙대로 1091, 6F (연산동, 제세빌딩)</p>
            </li>
            <li>
                <p>대표공인중개사</p>
                <p>권태용</p>
            </li>
            <li>
                <p>연락처</p>
                <p>1833-8840</p>
            </li>
        </ul>
    </div>

    <x-today-view-sales />


</div>
</div>