<script>
    function initFilterForm() {
        console.log('initFilterForm');
        var oldCond = JSON.parse(getCookie('filter_condition'));
        console.log(oldCond);

        if (oldCond.cate1) {
            $("input[name='cate1']").eq(0).attr('checked', false);
            $("input[name='cate1']").eq(0).parent().removeClass('active');
            $("input[name='cate1'][value='" + oldCond.cate1 + "']").click();
        }
        if (oldCond.cate2) {
            frm.cate2.value = oldCond.cate2;
            $('#cate2').selectpicker('refresh');
        }

        if (oldCond.tradeType) {
            $("input[name='tradeType']").eq(0).attr('checked', false);
            $("input[name='tradeType']").eq(0).parent().removeClass('active');
            $("input[name='tradeType'][value='" + oldCond.tradeType + "']").click();
        }
        if (oldCond.location) {
            $("input[name='location']").val(oldCond.location);
        }
        if (oldCond.fromPrice || oldCond.toPrice) {
            frm.fromPriceRange.value = oldCond.fromPriceRange;
            controlFromSlider(frm.fromPriceRange, frm.toPriceRange, frm.fromPrice);
            frm.toPriceRange.value = oldCond.toPriceRange;
            controlToSlider(frm.fromPriceRange, frm.toPriceRange, frm.toPrice);

        }
        if (oldCond.fromArea || oldCond.toArea) {
            if (oldCond.area_unit == 'p' && $("#area_unit").val() != 'p') {
                tranBtnClick();
            }
            frm.fromAreaRange.value = oldCond.fromAreaRange;
            controlFromSlider(frm.fromAreaRange, frm.toAreaRange, frm.fromArea);
            frm.toAreaRange.value = oldCond.toAreaRange;
            controlToSlider(frm.fromAreaRange, frm.toAreaRange, frm.toArea);
        }
        console.log('fromSlider', fromSlider);
    }
</script>



{{-- new filter --}}

<form name="frm" action="">
    <div class="col-md-12 pl0 pr0">

        <div class="">
            {{-- 지역 --}}

            <div class= "m_filt_sec">
                <div class="m_filt_tit">
                    <p>지역</p>
                </div>
                <div class="n_filter_sub" id="ftAddr">
                    <div class="n_filter_subbox m_sub overflow-auto">
                        <ul>
                            <li>부산 전체</li>
                            <li>중구</li>
                            <li>서구</li>
                            <li>동구</li>
                            <li>영도구</li>
                            <li>부산진구</li>
                            <li>동래구</li>
                            <li>남구</li>
                            <li>북구</li>
                        </ul>
                    </div>
                    <div class="n_filter_subbox m_sub overflow-auto">
                        <ul>
                            <li>전체</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- 용도 --}}
            <div class= "m_filt_sec">
                <div class="m_filt_tit">
                    <p>용도</p>
                </div>

                {{-- 주거용 --}}
                <p>주거용</p>
                <div class="filt_btns m_filt_btns" data-toggle="buttons" id="divCategory">
                    <label class="btn filt_r-btn m_filt_r inter active">
                        <input type="radio" name="cate1" value="" autocomplete="off"
                            checked=""><span>전체</span>
                    </label>
                    <label class="btn filt_r-btn m_filt_r inter">
                        <input type="radio" name="cate1" value="" autocomplete="off"><span>아파트</span>
                    </label>
                    <label class="btn filt_r-btn m_filt_r inter">
                        <input type="radio" name="cate1" value="" autocomplete="off"><span>오피스텔</span>
                    </label>
                    <label class="btn filt_r-btn m_filt_r inter">
                        <input type="radio" name="cate1" value="" autocomplete="off"><span>다세대/빌라</span>
                    </label>
                    <label class="btn filt_r-btn m_filt_r inter">
                        <input type="radio" name="cate1" value="" autocomplete="off"><span>단독주택</span>
                    </label>
                    <label class="btn filt_r-btn m_filt_r inter">
                        <input type="radio" name="cate1" value="" autocomplete="off"><span>다가구</span>
                    </label>
                    <label class="btn filt_r-btn m_filt_r inter">
                        <input type="radio" name="cate1" value="" autocomplete="off"><span>근린주택</span>
                    </label>
                    <label class="btn filt_r-btn m_filt_r inter">
                        <input type="radio" name="cate1" value="" autocomplete="off"><span>기타</span>
                    </label>
                </div>

                {{-- 상업용 --}}
                <p>상업용</p>
                <div class="filt_btns m_filt_btns" data-toggle="buttons" id="divCategory">
                    <label class="btn filt_r-btn m_filt_r inter active">
                        <input type="radio" name="cate1" value="" autocomplete="off"
                            checked=""><span>전체</span>
                    </label>
                    <label class="btn filt_r-btn m_filt_r inter">
                        <input type="radio" name="cate1" value="" autocomplete="off"><span>상가</span>
                    </label>
                    <label class="btn filt_r-btn m_filt_r inter">
                        <input type="radio" name="cate1" value="" autocomplete="off"><span>오피스텔</span>
                    </label>
                    <label class="btn filt_r-btn m_filt_r inter">
                        <input type="radio" name="cate1" value="" autocomplete="off"><span>사무실</span>
                    </label>
                    <label class="btn filt_r-btn m_filt_r inter">
                        <input type="radio" name="cate1" value="" autocomplete="off"><span>공장</span>
                    </label>
                    <label class="btn filt_r-btn m_filt_r inter">
                        <input type="radio" name="cate1" value="" autocomplete="off"><span>창고</span>
                    </label>
                    <label class="btn filt_r-btn m_filt_r inter">
                        <input type="radio" name="cate1" value="" autocomplete="off"><span>종교시설</span>
                    </label>
                    <label class="btn filt_r-btn m_filt_r inter">
                        <input type="radio" name="cate1" value="" autocomplete="off"><span>의료시설</span>
                    </label>
                    <label class="btn filt_r-btn m_filt_r inter">
                        <input type="radio" name="cate1" value="" autocomplete="off"><span>교육시설</span>
                    </label>
                    <label class="btn filt_r-btn m_filt_r inter">
                        <input type="radio" name="cate1" value="" autocomplete="off"><span>숙박시설</span>
                    </label>
                    <label class="btn filt_r-btn m_filt_r inter">
                        <input type="radio" name="cate1" value="" autocomplete="off"><span>기타</span>
                    </label>
                </div>

                {{-- 토지 --}}
                <p>토지</p>
                <div class="filt_btns m_filt_btns" data-toggle="buttons" id="divCategory">
                    <label class="btn filt_r-btn m_filt_r inter active">
                        <input type="radio" name="cate1" value="" autocomplete="off"
                            checked=""><span>전체</span>
                    </label>
                    <label class="btn filt_r-btn m_filt_r inter">
                        <input type="radio" name="cate1" value="" autocomplete="off"><span>아파트</span>
                    </label>
                    <label class="btn filt_r-btn m_filt_r inter">
                        <input type="radio" name="cate1" value="" autocomplete="off"><span>오피스텔</span>
                    </label>
                    <label class="btn filt_r-btn m_filt_r inter">
                        <input type="radio" name="cate1" value="" autocomplete="off"><span>다세대/빌라</span>
                    </label>
                    <label class="btn filt_r-btn m_filt_r inter">
                        <input type="radio" name="cate1" value="" autocomplete="off"><span>단독주택</span>
                    </label>
                    <label class="btn filt_r-btn m_filt_r inter">
                        <input type="radio" name="cate1" value="" autocomplete="off"><span>다가구</span>
                    </label>
                    <label class="btn filt_r-btn m_filt_r inter">
                        <input type="radio" name="cate1" value="" autocomplete="off"><span>근린주택</span>
                    </label>
                    <label class="btn filt_r-btn m_filt_r inter">
                        <input type="radio" name="cate1" value="" autocomplete="off"><span>기타</span>
                    </label>
                </div>


            </div>

            {{-- 감정가 --}}
            <div class= "m_filt_sec">
                <div class="m_filt_tit">
                    <p>감정가</p>
                </div>
                <div class="">
                    <ul>
                        <li class="filt_li">
                            <div class="range_container n_range">
                                <div class="form_control">
                                    <!-- min -->
                                    <div class="form_control_container">
                                        <input class="form_price" type="hidden" name="fromPrice2" id="fromPrice2"
                                            value="" readonly="">
                                        <input class="form_price" type="text" name="fromPrice2_txt"
                                            id="fromPrice2_txt" value="최소" readonly="">
                                    </div>
                                    <!-- max -->
                                    <div class="form_control_container">
                                        <input class="form_price" type="hidden" name="toPrice2" id="toPrice2"
                                            value="" readonly="">
                                        <input class="form_price" type="text" name="toPrice2_txt"
                                            id="toPrice2_txt" value="최대" readonly="">
                                    </div>
                                </div>
                                <div class="sliders_control">
                                    <input id="fromPrice2_slider" name="fromPrice2_slider" type="range"
                                        value="0" min="0" max="12" step="1">
                                    <input id="toPrice2_slider" name="toPrice2_slider" type="range" value="12"
                                        min="0" max="12" step="1">
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- 최저가 --}}
            <div class= "m_filt_sec">
                <div class="m_filt_tit">
                    <p>최저가</p>
                </div>
                <div class="">
                    <ul>
                        <li class="filt_li">
                            <div class="range_container n_range">
                                <div class="form_control">
                                    <!-- min -->
                                    <div class="form_control_container">
                                        <input class="form_price" type="hidden" name="fromPrice1" id="fromPrice1"
                                            value="" readonly="">
                                        <input class="form_price" type="text" name="fromPrice1_txt"
                                            id="fromPrice1_txt" value="최소" readonly="">
                                    </div>
                                    <!-- max -->
                                    <div class="form_control_container">
                                        <input class="form_price" type="hidden" name="toPrice1" id="toPrice1"
                                            value="" readonly="">
                                        <input class="form_price" type="text" name="toPrice1_txt" id="toPrice1_txt"
                                            value="최대" readonly="">
                                    </div>
                                </div>
                                <div class="sliders_control">
                                    <input id="fromPrice1_slider" name="fromPrice1_slider" type="range" value="0"
                                        min="0" max="12" step="1">
                                    <input id="toPrice1_slider" name="toPrice1_slider" type="range" value="12"
                                        min="0" max="12" step="1">
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- 물건상태 --}}
            <div class= "m_filt_sec">
                <div class="m_filt_tit">
                    <p>물건상태</p>
                </div>
                <div class="filt_btns" data-toggle="buttons" id="divCategory">
                    <label class="btn filt_r-btn inter active">
                        <input type="radio" name="cate1" value="" autocomplete="off"
                            checked=""><span>진행</span>
                    </label>
                    <label class="btn filt_r-btn inter">
                        <input type="radio" name="cate1" value="" autocomplete="off"><span>낙찰</span>
                    </label>
                    <label class="btn filt_r-btn inter">
                        <input type="radio" name="cate1" value="" autocomplete="off"><span>그외</span>
                    </label>
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
