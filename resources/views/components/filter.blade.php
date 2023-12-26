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
                <div class="candidate_revew_select">
                    <label for="cate2" id="lbCate2">주거용</label>
                    <select id="cate2" name="cate2" class="selectpicker w100 show-tick">
                      
                    </select>
                </div>
            </div>

        </li>
        <script>
            function showSelectBox(type) {
                document.getElementById('residentialSelectBox').classList.add('hidden');
                document.getElementById('commercialSelectBox').classList.add('hidden');

                document.getElementById(type + 'SelectBox').classList.remove('hidden');
            }

            function hideAllSelectBoxes() {
                document.getElementById('residentialSelectBox').classList.add('hidden');
                document.getElementById('commercialSelectBox').classList.add('hidden');
            }

            document.getElementById('option1').addEventListener('click', function() {
                hideAllSelectBoxes();
            });
        </script>


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
        <script>
            function controlFromInput(fromSlider, fromInput, toInput, controlSlider) {
                const [from, to] = getParsed(fromInput, toInput);
                fillSlider(fromInput, toInput, '#D9D9D9', '#385f8d', controlSlider);
                if (from > to) {
                    fromSlider.value = to;
                    fromInput.value = to;
                } else {
                    fromSlider.value = from;
                }
            }

            function controlToInput(toSlider, fromInput, toInput, controlSlider) {
                const [from, to] = getParsed(fromInput, toInput);
                fillSlider(fromInput, toInput, '#D9D9D9', '#385f8d', controlSlider);
                setToggleAccessible(toInput);
                if (from <= to) {
                    toSlider.value = to;
                    toInput.value = to;
                } else {
                    toInput.value = from;
                }
            }

            function controlFromSlider(fromSlider, toSlider, fromInput) {
                const [from, to] = getParsed(fromSlider, toSlider);
                fillSlider(fromSlider, toSlider, '#D9D9D9', '#385f8d', toSlider);
                if (from > to) {
                    fromSlider.value = to;
                    fromInput.value = to;
                } else {
                    fromInput.value = from;
                }
            }

            function controlToSlider(fromSlider, toSlider, toInput) {
                const [from, to] = getParsed(fromSlider, toSlider);
                fillSlider(fromSlider, toSlider, '#D9D9D9', '#385f8d', toSlider);
                setToggleAccessible(toSlider);
                if (from <= to) {
                    toSlider.value = to;
                    toInput.value = to;
                } else {
                    toInput.value = from;
                    toSlider.value = from;
                }
            }

            function getParsed(currentFrom, currentTo) {
                const from = parseInt(currentFrom.value, 10);
                const to = parseInt(currentTo.value, 10);
                return [from, to];
            }

            function fillSlider(from, to, sliderColor, rangeColor, controlSlider) {
                const rangeDistance = to.max - to.min;
                const fromPosition = from.value - to.min;
                const toPosition = to.value - to.min;
                controlSlider.style.background = `linear-gradient(
                to right,
                ${sliderColor} 0%,
                ${sliderColor} ${(fromPosition)/(rangeDistance)*100}%,
                ${rangeColor} ${((fromPosition)/(rangeDistance))*100}%,
                ${rangeColor} ${(toPosition)/(rangeDistance)*100}%, 
                ${sliderColor} ${(toPosition)/(rangeDistance)*100}%, 
                ${sliderColor} 100%)`;
            }

            function setToggleAccessible(currentTarget) {
                const toSlider = document.querySelector('#toSlider');
                if (Number(currentTarget.value) <= 0) {
                    toSlider.style.zIndex = 2;
                } else {
                    toSlider.style.zIndex = 0;
                }
            }

            const fromSlider = document.querySelector('#fromSlider');
            const toSlider = document.querySelector('#toSlider');
            const fromInput = document.querySelector('#fromInput');
            const toInput = document.querySelector('#toInput');
            fillSlider(fromSlider, toSlider, '#D9D9D9', '#385f8d', toSlider);
            setToggleAccessible(toSlider);

            fromSlider.oninput = () => controlFromSlider(fromSlider, toSlider, fromInput);
            toSlider.oninput = () => controlToSlider(fromSlider, toSlider, toInput);
            fromInput.oninput = () => controlFromInput(fromSlider, fromInput, toInput, toSlider);
            toInput.oninput = () => controlToInput(toSlider, fromInput, toInput, toSlider);
        </script>


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
        <script>
            $(document).ready(function() {
                $(".label_fx button").click(function(e) {
                    e.preventDefault(); // 기본 동작 막기
                    tranBtnClick();

                });
            });
            
            function tranBtnClick(){
                $(".form_area").toggleClass("up");
                var max = $('.input_area').attr('max');
                var min = $('.input_area').attr('min');
                var fval = $('#fromAreaInput').val();
                var tval = $('#toAreaInput').val();

                if($(".form_area").hasClass('up')){ // 평
                    $("#area_unit").val('p');
                    max = Math.round(max * 0.3025);
                    min = Math.round(min * 0.3025);
                    fval = Math.round(fval * 0.3025);
                    tval = Math.round(tval * 0.3025);
                }else{                              // 제곱미터
                    $("#area_unit").val('m');
                    max = Math.round(max * 3.305785);
                    min = Math.round(min * 3.305785);
                    fval = Math.round(fval * 3.305785);
                    tval = Math.round(tval * 3.305785);
                }
                $('.input_area').attr('max', max);
                $('.input_area').attr('min', min);
                $('#fromAreaInput').val(fval);
                $('#toAreaInput').val(tval);
                controlFromAreaInput(fromAreaSlider, fromAreaInput, toAreaInput, toAreaSlider);
                controlToAreaInput(toAreaSlider, fromAreaInput, toAreaInput, toAreaSlider);
            }
        </script>

        <script>
            function controlFromAreaInput(fromSlider, fromInput, toInput, controlSlider) {
                const [from, to] = getParsed(fromInput, toInput);
                fillSlider(fromInput, toInput, '#D9D9D9', '#385f8d', controlSlider);
                if (from > to) {
                    fromSlider.value = to;
                    fromInput.value = to;
                } else {
                    fromSlider.value = from;
                }
            }

            function controlToAreaInput(toSlider, fromInput, toInput, controlSlider) {
                const [from, to] = getParsed(fromInput, toInput);
                fillSlider(fromInput, toInput, '#D9D9D9', '#385f8d', controlSlider);
                setToggleAccessible(toInput);
                if (from <= to) {
                    toSlider.value = to;
                    toInput.value = to;
                } else {
                    toInput.value = from;
                }
            }

            function controlFromAreaSlider(fromSlider, toSlider, fromInput) {
                const [from, to] = getParsed(fromSlider, toSlider);
                fillSlider(fromSlider, toSlider, '#D9D9D9', '#385f8d', toSlider);
                if (from > to) {
                    fromSlider.value = to;
                    fromInput.value = to;
                } else {
                    fromInput.value = from;
                }
            }

            function controlToAreaSlider(fromSlider, toSlider, toInput) {
                const [from, to] = getParsed(fromSlider, toSlider);
                fillSlider(fromSlider, toSlider, '#D9D9D9', '#385f8d', toSlider);
                setToggleAccessible(toSlider);
                if (from <= to) {
                    toSlider.value = to;
                    toInput.value = to;
                } else {
                    toInput.value = from;
                    toSlider.value = from;
                }
            }

            function getParsed(currentFrom, currentTo) {
                const from = parseInt(currentFrom.value, 10);
                const to = parseInt(currentTo.value, 10);
                return [from, to];
            }

            function fillSlider(from, to, sliderColor, rangeColor, controlSlider) {
                const rangeDistance = to.max - to.min;
                const fromPosition = from.value - to.min;
                const toPosition = to.value - to.min;
                controlSlider.style.background = `linear-gradient(
to right,
${sliderColor} 0%,
${sliderColor} ${(fromPosition) / (rangeDistance) * 100}%,
${rangeColor} ${((fromPosition) / (rangeDistance)) * 100}%,
${rangeColor} ${(toPosition) / (rangeDistance) * 100}%,
${sliderColor} ${(toPosition) / (rangeDistance) * 100}%,
${sliderColor} 100%)`;
                console.log('fill');
            }

            function setToggleAccessible(currentTarget) {
                const toAreaSlider = document.querySelector('#toAreaSlider');
                if (Number(currentTarget.value) <= 0) {
                    toAreaSlider.style.zIndex = 2;
                } else {
                    toAreaSlider.style.zIndex = 0;
                }
            }

            const fromAreaSlider = document.querySelector('#fromAreaSlider');
            const toAreaSlider = document.querySelector('#toAreaSlider');
            const fromAreaInput = document.querySelector('#fromAreaInput');
            const toAreaInput = document.querySelector('#toAreaInput');
            fillSlider(fromAreaSlider, toAreaSlider, '#D9D9D9', '#385f8d', toAreaSlider);
            setToggleAccessible(toAreaSlider);

            fromAreaSlider.oninput = () => controlFromAreaSlider(fromAreaSlider, toAreaSlider, fromAreaInput);
            toAreaSlider.oninput = () => controlToAreaSlider(fromAreaSlider, toAreaSlider, toAreaInput);
            fromAreaInput.oninput = () => controlFromAreaInput(fromAreaSlider, fromAreaInput, toAreaInput, toAreaSlider);
            toAreaInput.oninput = () => controlToAreaInput(toAreaSlider, fromAreaInput, toAreaInput, toAreaSlider);
        </script>


        <li class="filt_li">
            <div class="search_option_button">
                <button type="submit" class="btn btn-block btn-thm btn-thm_w">검색하기</button>
            </div>
        </li>
    </ul>
</div>