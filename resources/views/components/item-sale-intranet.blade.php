@if ($type=="recommend")
<div class="col-sm-6 col-md-6 col-lg-4">
@else
<div class="col-sm-6 col-md-6 col-lg-4 pl10 ">
@endif
    <a href="?mode=show&idx={{ $printData['idx'] }}">
        <div class="feat_property home7 style4 bdrrn feat_property_w @if($type=="related") classname @endif">
            <div class="thumb">
                <img class="img-whp" src="{{ $printData['img'] }}">
                <div class="thmb_cntnt">
                    <p>{{ $printData['category'] }}</p>
                    <ul class="tag mb0">
                        @if ($type=="default")
                            <!-- 찜하기 전 -->
                            <li class="list-inline-item">
                                <button class="heart_btn" onclick="return addFavorite(this,{{ $printData['idx'] }})">
                                    @if (isset($printData['isFavorite']) && $printData['isFavorite']==true)
                                    <i class="ri-heart-3-fill"></i>
                                    @else
                                    <i class="ri-heart-3-line"></i>
                                    @endif
                                </button>
                            </li>
                        
                            @if($printData['isRecom']==1)
                            <li class="list-inline-item">
                                <i class="ri-thumb-up-fill"></i>
                            </li>
                            @endif
                        @endif
                    </ul>
                </div>

            </div>
            <div class="details details_w">
                <div class="tc_content tc_content_w">
                    <h4>{{ $printData['title'] }} </h4>
                    <p class="text-inf text_loc"><i class="ri-map-pin-2-fill"></i>{{ $printData['address'] }}</p>
                    @if(!empty($printData['area_b']))
                    <div class="text-inf-w">
                        <p class="text-inf"><i class="ri-split-cells-horizontal"></i>{{ $printData['prposAreaNm'] }}
                            {{ $printData['floorInfo'] }}
                        </p>
                        <p class="text-inf"><i class="ri-building-line"></i>분양<span class="area" data-m2="{{ $printData['area_b'] }}㎡" data-py="{{ $printData['area_b_py'] }}평">{{ $printData['area_b'] }}㎡</span>
                            전용<span class="area" data-m2="{{ $printData['area_j'] }}㎡" data-py="{{ $printData['area_j_py'] }}평">{{ $printData['area_j'] }}㎡</span></p>
                    </div>
                    @else
                    <div class="text-inf-w">
                        <p class="text-inf"><i class="ri-split-cells-horizontal"></i>{{ $printData['prposAreaNm'] }}
                            <span class="area" data-m2="{{ $printData['landArea'] }}㎡" data-py="{{ $printData['landArea_py'] }}평">{{ $printData['landArea'] }}㎡</span>
                        </p>
                        @if (strpos($printData['category'],"토지")===false)
                        <p class="text-inf"><i class="ri-building-line"></i>{{ $printData['floorInfo']}}
                            연<span class="area" data-m2="{{ $printData['bdArea'] }}㎡" data-py="{{ $printData['bdArea_py'] }}평">{{ $printData['bdArea'] }}㎡</span></p>
                        @endif
                    </div>
                    @endif
                    <p class="text-thm price_w">{{ $printData['tradeType'] }} <span class="mont">{{ $printData['price'] }}</span> 만원</p>
                </div>
                <div class="fp_footer fp_footer_w">
                    <ul class="fp_meta float-left mb0 fp_meta_w">
                        <li class="list-inline-item sawon_crop"><img src="{{ $printData['sawon_photo'] }}"></li>
                        <li class="list-inline-item"><p class="fp_pname">{{ $printData['sawon_name'] }}
                            {{ $printData['sawon_sosok'] }}</p>
                        </li>
                    </ul>
                    <p class="fp_pdate">{{ $printData['print_data'] }}</p>
                </div>
            </div>
        </div>
    </a>
</div>
