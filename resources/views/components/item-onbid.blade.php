<div class="col-sm-6 col-md-6 col-lg-4">
    <a href="{{ $printData['view_link'] }}">
        <div class="feat_property home7 style4 bdrrn feat_property_w">
            <div class="thumb auction_thumb">
                <img class="img-whp" src="{{ $printData['image'] }}" alt="{{ $printData['alt'] }}">
                <div class="thmb_cntnt">
                    <ul class="tag mb0">
                        <!-- 찜하기 전 -->
                        <li class="list-inline-item">
                            <button 
                                @auth
                                class="heart_btn" onclick="return addFavoriteAuction(this,'{{ $printData['gubun'] }},{{ $printData['물건관리번호'] }}')"
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
                <!-- 경매 공매 표시 -->
                <div class="auction_tag sell">
                    <p>공매</p>
                </div>


                {{-- 하트 개수 --}}
                <div class="auction_hrt">
                    <i class="ri-heart-fill"></i>
                    <p>275</p>
                </div> 

                {{-- 특별매각조건 --}}
                <div class="aucton_if">
                    <p>특별매각조건</p>
                </div>


            </div>
            <div class="details details_w auc_list">
                <div class="auc_listw">
                    <div class="auc_list_t">
                        <p class="auc_num">{{ $printData['상태'] }}</p>
                        <p class="auc_dd">{{ $printData['날짜'] }}</p>
                    </div>
                    <h4>{{ $printData['물건명'] }}</h4>
                    <p class="app_vlu">{{ price_kor($printData['감정가']) }}원</p>
                    <p class="low_vlu">{{ price_kor($printData['최저가']) }}원
                        @if ($printData['할인율'] > 0)
                            <span>(<i class="ri-arrow-down-line"></i>{{ $printData['할인율'] }}%)</span>
                        @endif
                    </p>
                </div>
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
