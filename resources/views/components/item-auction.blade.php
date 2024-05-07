<div class="col-sm-6 col-md-6 col-lg-4">
    <a href="{{ env('MENU_LINK_AUCTION').'/'.$printData['view_link'] }}" target="_blank">
        <div class="feat_property home7 style4 bdrrn feat_property_w">
            <div class="thumb auction_thumb">
                <img class="img-whp" src="{{ $printData['image'] }}" alt="{{ $printData['alt'] }}">
                @if (empty($type))
                <div class="thmb_cntnt">
                    <ul class="tag mb0">
                        <!-- 찜하기 전 -->
                        <li class="list-inline-item">
                            <button
                                @auth
                                class="heart_btn" onclick="return addFavoriteAuction(this,'{{ $printData['gubun'] }},{{ $printData['saNo'] }},{{ $printData['물건번호'] }}')"
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
                    </ul>
                </div>
                @endif
                <!-- 경매 공매 표시 -->
                <div class="auction_tag auc">
                    <p>경매</p>
                </div>

                {{-- 하트 개수 --}}
                @if (empty($type))
                <div class="auction_hrt">
                    <i class="ri-heart-fill"></i>
                    <p>{{ number_format($printData['favoriteCnt']) }}</p>
                </div>
                @endif

                {{-- 특별매각조건 --}}
                @if(in_array('특별매각조건',$printData['해시태그']))
                <div class="aucton_if">
                    <p>특별매각조건</p>
                </div>
                @endif
            </div>
            <div class="details details_w auc_list">
                <div class="auc_listw">
                    <div class="auc_list_t">
                        <div class="auc_num_w">
                            <p class="auc_num">{{ $printData['법원'] }}</p>
                            <p class="auc_num">{{ $printData['사건번호'] }}[{{ $printData['물건번호'] }}]</p>
                        </div>
                        <p class="auc_dd">{{ $printData['dday'] }}</p>
                    </div>
                    <h4>{{ $printData['소재지'] }}</h4>
                    <p class="app_vlu">{{ price_kor($printData['감정가']) }}원</p>
                    <p class="low_vlu">{{ price_kor($printData['price']) }}원
                        @if ($printData['할인율'] > 0)
                            <span>(<i class="ri-arrow-down-line"></i>{{ $printData['할인율'] }}%)</span>
                        @endif
                    </p>
                </div>

                {{-- <div>
                    {{ $printData['cate1'] }} - {{ $printData['cate2'] }}
                </div> --}}

                <ul class="auc_hash">
                    @foreach ($printData['해시태그'] as $_tag)
                        <li>
                            <p>#{{ $_tag }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </a>
</div>
