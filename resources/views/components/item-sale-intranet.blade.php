@php
    $page_id = 20;
@endphp

@if ($type=="recommend")
<div class="col-sm-6 col-md-6 col-lg-4">
@elseif ($type=="related")
<div class="col-sm-6 col-md-6 col-lg-6">
@elseif ($type=="main_recommend")
@php
    $page_id = 19;
@endphp
<div class="col-sm-3 col-md-6 col-lg-3 hot_list">
@else
<div class="col-sm-6 col-md-6 col-xl-4 pl10">
@endif
    <a href="{{ route('page',$page_id) }}?mode=show&idx={{ $printData['idx'] }}" target="_blank">
        <div class="feat_property home7 style4 bdrrn feat_property_w @if($type=="related") related @endif">
            <div class="thumb">
                <img class="img-whp" src="{{ $printData['img'] }}">
                <div class="thmb_cntnt @if($printData['is_soldout']) {{ __('thmb_soldout') }} @endif">
                    @if($printData['categoryFirst']=="주거용")
                    <p style="background:green;">{{ $printData['category'] }}</p>
                    @else
                    <p>{{ $printData['category'] }}</p>
                    @endif
                    <ul class="tag mb0">
                        @if ($type=="default")
                            <!-- 찜하기 전 -->
                            <li class="list-inline-item">
                                <button 
                                @auth
                                class="heart_btn" onclick="return addFavorite(this,{{ $printData['idx'] }})"
                                @else
                                data-url="modal.login-alert" class="heart_btn modal-button"
                                @endauth
                                >
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
                    @if($printData['is_soldout'])
                <div class="sold_out">
                    거래완료
                </div>
                @endif
                </div>
                

            </div>
            <div class="details details_w">
                <div class="tc_content tc_content_w">
                    <h4 data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $printData['title'] }}">{{ $printData['title'] }} </h4>
                    <p class="text-inf text_loc"><i class="ri-map-pin-2-fill"></i>{{ $printData['address'] }}</p>
                    @if(!empty($printData['area_b']))
                    <div class="text-inf-w">
                        <p class="text-inf"><i class="ri-split-cells-horizontal"></i>
                            공급<span class="area" data-m2="{{ $printData['area_b'] }}㎡" data-py="{{ $printData['area_b_py'] }}평">{{ $printData['area_b'] }}㎡</span>&nbsp;
                            전용<span class="area" data-m2="{{ $printData['area_j'] }}㎡" data-py="{{ $printData['area_j_py'] }}평">{{ $printData['area_j'] }}㎡</span>
                        </p>
                        <p class="text-inf"><i class="ri-building-line"></i>
                            {{ $printData['floorInfo'] }}
                        </p>
                    </div>
                    @else
                    <div class="text-inf-w">
                        <p class="text-inf"><i class="ri-split-cells-horizontal"></i>{{ $printData['prposAreaNm'] }}
                            <span class="area" data-m2="{{ $printData['landArea'] }}㎡" data-py="{{ $printData['landArea_py'] }}평">{{ $printData['landArea'] }}㎡</span>
                        </p>
                        {{-- @if (strpos($printData['category'],"토지")===false) --}}
                        @if (!empty($printData['bdArea']))
                        <p class="text-inf"><i class="ri-building-line"></i>{{ $printData['floorInfo']}}
                            연<span class="area" data-m2="{{ $printData['bdArea'] }}㎡" data-py="{{ $printData['bdArea_py'] }}평">{{ $printData['bdArea'] }}㎡</span></p>
                        @else
                        <p class="text-inf"><i class="ri-building-line"></i>-</p>
                        @endif
                    </div>
                    @endif
                    <p class="text-thm price_w">{{ $printData['tradeType'] }} <span class="">{{ $printData['price'] }}</span>원</p>
                </div>
                <div class="fp_footer fp_footer_w">
                    <ul class="fp_meta float-left mb0 fp_meta_w">
                        <li class="list-inline-item sawon_crop"><img src="@if ($printData['sawon_chkcert']=='y'){{ $printData['sawon_photo'] }}@else{{ $printData['radmin_photo'] }}@endif"></li>
                        <li class="list-inline-item">
                            <p class="fp_pname">
                                @if ($printData['sawon_chkcert']=='y')
                                {{ $printData['sawon_name'] }}
                                {{ $printData['sawon_sosok'] }}
                                @else
                                {{ $printData['radmin_name'] }}
                                @endif
                            </p>
                        </li>
                    </ul>
                    <p class="fp_pdate">{{ $printData['print_data'] }}</p>
                </div>
            </div>
        </div>
    </a>
</div>
