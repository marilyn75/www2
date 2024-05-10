


<script>
    function initFilterForm(){
        console.log('initFilterForm');
        var oldCond = JSON.parse(getCookie('filter_condition'));
        console.log(oldCond);

        if(oldCond.cate1){
            $("input[name='cate1']").eq(0).attr('checked',false);
            $("input[name='cate1']").eq(0).parent().removeClass('active');
            $("input[name='cate1'][value='"+oldCond.cate1+"']").click();
        }
        if(oldCond.cate2){
            frm.cate2.value = oldCond.cate2;
            $('#cate2').selectpicker('refresh');
        }

        if(oldCond.tradeType){
            $("input[name='tradeType']").eq(0).attr('checked',false);
            $("input[name='tradeType']").eq(0).parent().removeClass('active');
            $("input[name='tradeType'][value='"+oldCond.tradeType+"']").click();
        }
        if(oldCond.location){
            $("input[name='location']").val(oldCond.location);
        }
        if(oldCond.fromPrice || oldCond.toPrice){
            frm.fromPriceRange.value = oldCond.fromPriceRange;
            controlFromSlider(frm.fromPriceRange, frm.toPriceRange, frm.fromPrice);
            frm.toPriceRange.value = oldCond.toPriceRange;
            controlToSlider(frm.fromPriceRange, frm.toPriceRange, frm.toPrice);

        }
        if(oldCond.fromArea || oldCond.toArea){
            if(oldCond.area_unit=='p' && $("#area_unit").val() != 'p'){
                tranBtnClick();
            }
            frm.fromAreaRange.value = oldCond.fromAreaRange;
            controlFromSlider(frm.fromAreaRange, frm.toAreaRange, frm.fromArea);
            frm.toAreaRange.value = oldCond.toAreaRange;
            controlToSlider(frm.fromAreaRange, frm.toAreaRange, frm.toArea);
        }
        console.log('fromSlider',fromSlider);
    }
</script>



{{-- new filter --}}

<form name="frm" action="">
<div class="col-md-12 pl0 pr0">
    
    
    <div class="n_filter_w">
        {{-- 지역 --}}
        <div class= "n_filter_area">
            <div class="n_filter_t">
                <img src="/images/auction/location.png" alt="">
                <p>지역</p>
            </div>
            <div class="n_filter_sub" id="ftAddr">
                <div class="n_filter_subbox overflow-auto">
                    <ul>
                        <li>부산 전체</li>
                        <li>중구</li>
                        <li>서구</li>
                        <li>동구</li>
                    </ul>
                </div>
                <div class="n_filter_subbox overflow-auto">
                    <ul>
                        <li>전체</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- 용도 --}}
        <div class= "n_filter_use">
            <div class="n_filter_t">
                <img src="/images/auction/use.png" alt="">
                <p>용도</p>
            </div>
            <div class="n_filter_sub" id="ftPurpos">
                <div class="n_filter_subbox overflow-auto">
                    <ul>
                        <li>전체</li>
                        <li>주거용 건물</li>
                        <li>상업용 건물</li>
                        <li>토지</li>
                    </ul>
                </div>
                <div class="n_filter_subbox overflow-auto">
                    <ul>
                        <li><button type="button" class="btn" data-code="0_0" data-parent_code="0">전체</button></li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- 감정가/최저가 --}}
        <div class= "n_filter_price">
            <div class="n_filter_t">
                <img src="/images/auction/price.png" alt="">
                <p>감정가/최저가</p>
            </div>
            <div class="n_filter_subbox">


                <ul>
                    <li class="filt_li">
                        <label for="">최저가</label>
                        <div class="range_container n_range">
                            <div class="form_control">
                                <!-- min -->
                                <div class="form_control_container">
                                    <input class="form_price" type="hidden" name="fromPrice1"
                                        id="fromPrice1" value="" readonly="">
                                    <input class="form_price" type="text"
                                        name="fromPrice1_txt" id="fromPrice1_txt" value="최소"
                                        readonly="">
                                </div>
                                <!-- max -->
                                <div class="form_control_container">
                                    <input class="form_price" type="hidden" name="toPrice1"
                                        id="toPrice1" value="" readonly="">
                                    <input class="form_price" type="text" name="toPrice1_txt"
                                        id="toPrice1_txt" value="최대" readonly="">
                                </div>
                            </div>
                            <div class="sliders_control">
                                <input id="fromPrice1_slider" name="fromPrice1_slider" type="range"
                                    value="0" min="0" max="12" step="1">
                                <input id="toPrice1_slider" name="toPrice1_slider" type="range"
                                    value="12" min="0" max="12" step="1">
                            </div>
                        </div>
                    </li>
                </ul>


                <ul>
                    <li class="filt_li">
                        <label for="">감정가</label>
                        <div class="range_container n_range">
                            <div class="form_control">
                                <!-- min -->
                                <div class="form_control_container">
                                    <input class="form_price" type="hidden" name="fromPrice2"
                                        id="fromPrice2" value="" readonly="">
                                    <input class="form_price" type="text"
                                        name="fromPrice2_txt" id="fromPrice2_txt" value="최소"
                                        readonly="">
                                </div>
                                <!-- max -->
                                <div class="form_control_container">
                                    <input class="form_price" type="hidden" name="toPrice2"
                                        id="toPrice2" value="" readonly="">
                                    <input class="form_price" type="text" name="toPrice2_txt"
                                        id="toPrice2_txt" value="최대" readonly="">
                                </div>
                            </div>
                            <div class="sliders_control">
                                <input id="fromPrice2_slider" name="fromPrice2_slider" type="range"
                                    value="0" min="0" max="12" step="1">
                                <input id="toPrice2_slider" name="toPrice2_slider" type="range"
                                    value="12" min="0" max="12" step="1">
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            
        </div>

        {{-- 물건상태 --}}
        <div class= "n_filter_status">
            <div class="n_filter_t">
                <img src="/images/auction/status.png" alt="">
                <p>물건상태</p>
            </div>
            <div class="n_filter_subbox" id="ftStatus">
                <ul>
                    <li><button type="button" class="btn sel" data-code="0">진행중</button></li>
                    <li><button type="button" class="btn" data-code="1">변경/연기</button></li>
                    <li><button type="button" class="btn" data-code="2">낙찰</button></li>
                    <li><button type="button" class="btn" data-code="3">기각/취하/취소</button></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="n_filter_b">
        <div class="btn_wrap">
            <div id="filter-addr">
                
            </div>
            <div id="filter-purpose">
                
            </div>
            <div id="filter-cost">
                
            </div>
            <div id="filter-status">
                
            </div>
        </div>
        <li class="filt_li filt_bt_wrap n_filt_bt_wrap"> 
            <div class="search_option_button">
                <button type="button" id="resetButton" class="btn btn-block btn-thm btn-thm_w">초기화</button>
            </div>
            <div class="search_option_button">
                <button type="button" id="searchButton" class="btn btn-block btn-thm btn-thm_w">검색하기</button>
            </div>
        </li>
    </div>
</div>
</form>