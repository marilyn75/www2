<div class="col-sm-6 col-md-6 col-lg-4">
    <a href="{{ $printData['view_link'] }}">
        <div class="feat_property home7 style4 bdrrn feat_property_w">
            <div class="thumb auction_thumb">
                <img class="img-whp" src="{{ $printData['image'] }}" alt="{{ $printData['alt'] }}">
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

                {{-- 하트 개수 --}}
                <div class="auction_hrt">
                    <i class="ri-heart-fill"></i>
                    <p>275</p>
                </div>

                {{-- 특별매약조건 --}}
                <div class="aucton_if">
                    <p>특별매약조건</p>
                </div>
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
