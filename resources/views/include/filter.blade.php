<div class="sidebar_advanced_search_widget">
    <ul class="sasw_list mb0 sasw_list_w">
        <li class="filt_li">
            <div class="left_area tac-xsd result_filt">
                <p>검색결과 <span class="mont point_c">{{ number_format($data->total()) }}</span>건</p>
                <button class="reset_btn">초기화</button>
            </div>

        </li>
        <li class="filt_li">
            <label for="">유형</label>
            <div class="filt_btns" data-toggle="buttons" id="divCategory">
                <label class="btn filt_r-btn inter ">
                    <input type="radio" name="cate1" value="" autocomplete="off" checked><span>전체</span>
                </label>
            </div>

            <div id="divSubCategory" class="hidden">
                <div class="candidate_revew_select" id="divCate2">
                    <label for="cate2" id="lbCate2">주거용</label>
                    <select id="cate2" name="cate2" class="selectpicker w100 show-tick">
                      
                    </select>
                </div>
            </div>

        </li>
 
        <li class="filt_li">
            <label for="">지역</label>
            <div class="search_option_two">
                <div class="select_w">
                    <input type="text" placeholder="지역" name="location" value="">
                </div>
            </div>
        </li>
        <li class="filt_li">
            <label for="">거래종류</label>
            <div class="filt_btns" data-toggle="buttons">
                <label class="btn filt_r-btn inter active">
                    <input type="radio" name="tradeType" id="option1" autocomplete="off" value="" checked="">전체
                </label>
                <label class="btn filt_r-btn inter active">
                    <input type="radio" name="tradeType" id="option2" autocomplete="off" value="매매">매매
                </label>
                <label class="btn filt_r-btn inter">
                    <input type="radio" name="tradeType" id="option3" autocomplete="off" value="임대">임대
                </label>
            </div>
        </li>

        <li class="filt_li">
            <label for="">가격</label>
            <div class="range_container">
                <div class="form_control">
                    <!-- min -->
                    <div class="form_control_container">
                        <input class="form_price" type="number" name="fromPrice" id="fromInput" value="0" min="0" max="{{ $maxPriceNArea->maxPrice }}" />
                    </div>
                    <!-- max -->
                    <div class="form_control_container">
                        <input class="form_price" type="number" name="toPrice" id="toInput" value="{{ $maxPriceNArea->maxPrice }}" min="0" max="{{ $maxPriceNArea->maxPrice }}" />
                    </div>
                </div>
                <div class="sliders_control">
                    <input id="fromSlider" type="range" value="0" min="0" max="{{ $maxPriceNArea->maxPrice }}" step="10" />
                    <input id="toSlider" type="range" value="{{ $maxPriceNArea->maxPrice }}" min="0"max="{{ $maxPriceNArea->maxPrice }}" step="10" />
                </div>
            </div>
        </li>

        <!-- 거래면적 -->
        <li class="filt_li">
            <div class="label_fx">
                <label for="transactionArea">
                    거래면적
                    <input type="hidden" name="area_unit" id="area_unit" value="m">
                </label>
                <button>
                    <i class="ri-exchange-fill"></i>
                </button>
            </div>
            <div class="range_container">
                <div class="form_control">
                    <!-- min -->
                    <div class="form_control_container">
                        <input class="form_area input_area" type="number" name="fromArea" id="fromAreaInput" value="0" min="0" max="{{ $maxPriceNArea->maxArea }}" />
                    </div>
                    <!-- max -->
                    <div class="form_control_container">
                        <input class="form_area input_area" type="number" name="toArea" id="toAreaInput" value="{{ $maxPriceNArea->maxArea }}" min="0" max="{{ $maxPriceNArea->maxArea }}" />
                    </div>
                </div>
                <div class="sliders_control">
                    <input class="input_area" id="fromAreaSlider" type="range" value="0" min="0" max="{{ $maxPriceNArea->maxArea }}" />
                    <input class="input_area" id="toAreaSlider" type="range" value="{{ $maxPriceNArea->maxArea }}" min="0" max="{{ $maxPriceNArea->maxArea }}" />
                </div>
            </div>
        </li>
        


        <li class="filt_li">
            <div class="search_option_button">
                <button type="submit" class="btn btn-block btn-thm btn-thm_w">검색하기</button>
            </div>
        </li>
    </ul>
</div>