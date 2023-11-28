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
                        <p>" {{ $data['slogan'] }} " <br>" 전문적이고 친절한 공인중개사 직원으로, 부동산 거래에 대한 전문지식과 고객서비스에 최선을 다하는 자부심을 가지고 있습니다. "</p>
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
                        @if (empty($data['sales']))
                        <div class="col-lg-12 pl0 pr0 feat_property feat_property_w">
                            <div class="product_single_content">
                                <div class="mbp_pagination_comments agent_review">
                                    <p><i class="ri-information-line"></i>등록된 매물이 없습니다.</p>
                                </div>
                            </div>
                        </div>
                        @else
                            @foreach ($data['sales'] as $_sale)
                        <div class="col-lg-12 pl0 pr0 feat_property feat_property_w">
                            <div class="feat_property list style2 hvr-bxshd bdrrn agent_list">
                                <div class="thumb agent_thumb">
                                    <img class="img-whp" src="{{ $_sale['img'] }}" >
                                </div>
                                <div class="details details_w">
                                    <div class="tc_content tc_content_w agent_content">
                                        <p class="text-thm type">{{ $_sale['category'] }}</p>
                                        <h4>{{ $_sale['title'] }}</h4>
                                        @if(!empty($_sale['area_b']))
                                            <div class="text-inf-w text-inf_main">
                                                <p class="text-inf"><i class="ri-split-cells-horizontal"></i>{{ $_sale['prposAreaNm'] }} {{ $_sale['floorInfo'] }}</p>
                                                <p class="text-inf"><i class="ri-building-line"></i>분양{{ $_sale['area_b'] }}㎡ 전유{{ $_sale['area_j'] }}㎡</p>
                                            </div>
                                        @else
                                            <div class="text-inf-w text-inf_main">
                                                <p class="text-inf"><i class="ri-split-cells-horizontal"></i>{{ $_sale['prposAreaNm'] }} {{ $_sale['landArea'] }}㎡</p>
                                                @if (strpos($_sale['category'],"토지")===false)
                                                <p class="text-inf"><i class="ri-building-line"></i>{{ $_sale['floorInfo']}} 연{{ $_sale['bdArea'] }}㎡</p>
                                                @endif
                                            </div>
                                        @endif
                                        <p class="text-inf"><i class="ri-map-pin-2-line"></i>{{ $_sale['address'] }}</p>
                                        <p class="text-thm price_w">{{ $_sale['tradeType'] }} <span class="mont">{{ $_sale['price'] }}</span> 만원</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                            @endforeach
                        
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
<div class="col-lg-4">

    <x-inquirybox type="default" :printData="$data" />

    <x-today-view-sales />


</div>