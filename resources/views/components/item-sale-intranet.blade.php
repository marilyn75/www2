<div class="col-sm-6 col-md-6 col-lg-6">
    <a href="?mode=show&idx={{ $printData['idx'] }}">
        <div class="feat_property home7 style4 bdrrn feat_property_w">
            <div class="thumb">
                <img class="img-whp" src="{{ $printData['img'] }}">
                <div class="thmb_cntnt">
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
                    <p class="text-thm">{{ $printData['category'] }}</p>
                    <h4>{{ $printData['title'] }} </h4>

                    @if(!empty($printData['area_b']))
                    <div class="text-inf-w">
                        <p class="text-inf"><i class="ri-split-cells-horizontal"></i>{{ $printData['prposAreaNm'] }}
                            {{ $printData['floorInfo'] }}
                        </p>
                        <p class="text-inf"><i class="ri-building-line"></i>분양{{ $printData['area_b'] }}㎡
                            전유{{ $printData['area_j'] }}㎡</p>
                    </div>
                    @else
                    <div class="text-inf-w">
                        <p class="text-inf"><i class="ri-split-cells-horizontal"></i>{{ $printData['prposAreaNm'] }}
                            {{ $printData['landArea'] }}㎡
                        </p>
                        @if (strpos($printData['category'],"토지")===false)
                        <p class="text-inf"><i class="ri-building-line"></i>{{ $printData['floorInfo']}}
                            연{{ $printData['bdArea'] }}㎡</p>
                        @endif
                    </div>
                    @endif
                    <p class="text-inf"><i class="ri-map-pin-2-line"></i>{{ $printData['address'] }}</p>
                    <p class="text-thm price_w">{{ $printData['tradeType'] }} <span class="mont">{{ $printData['price'] }}</span> 만원</p>
                </div>
                <div class="fp_footer fp_footer_w">
                    <ul class="fp_meta float-left mb0 fp_meta_w">
                        <li class="list-inline-item sawon_crop"><img src="{{ $printData['sawon_photo'] }}" style="width: 40px; height: 40px;"></li>
                        <li class="list-inline-item">{{ $printData['sawon_name'] }}
                            {{ $printData['sawon_sosok'] }}
                        </li>
                    </ul>
                    <p class="fp_pdate">{{ $printData['print_data'] }}</p>
                </div>
            </div>
        </div>
    </a>
</div>