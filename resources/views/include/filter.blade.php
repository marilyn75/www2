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
                        <input class="form_price" type="text" name="fromPrice" id="fromInput" value="0" min="0" max="{{ $maxPriceNArea->maxPrice }}" />
                    </div>
                    <!-- max -->
                    <div class="form_control_container">
                        <input class="form_price" type="text" name="toPrice" id="toInput" value="{{ $maxPriceNArea->maxPrice }}" min="0" max="{{ $maxPriceNArea->maxPrice }}" />
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
                        <input class="form_area input_area" type="text" name="fromArea" id="fromAreaInput" value="0" min="0" max="{{ $maxPriceNArea->maxArea }}" />
                    </div>
                    <!-- max -->
                    <div class="form_control_container">
                        <input class="form_area input_area" type="text" name="toArea" id="toAreaInput" value="{{ $maxPriceNArea->maxArea }}" min="0" max="{{ $maxPriceNArea->maxArea }}" />
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

<script>
    // filter script s//////////////////////////////////
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

    // function controlFromInput(fromSlider, fromInput, toInput, controlSlider) {
    //     const [from, to] = getParsed(fromInput, toInput);
    //     fillSlider(fromInput, toInput, '#D9D9D9', '#385f8d', controlSlider);
    //     if (from > to) {
    //         fromSlider.value = to;
    //         fromInput.value = to;
    //     } else {
    //         fromSlider.value = from;
    //     }
    // }

    // function controlToInput(toSlider, fromInput, toInput, controlSlider) {
    //     const [from, to] = getParsed(fromInput, toInput);
    //     fillSlider(fromInput, toInput, '#D9D9D9', '#385f8d', controlSlider);
    //     setToggleAccessible(toInput);
    //     if (from <= to) {
    //         toSlider.value = to;
    //         toInput.value = to;
    //     } else {
    //         toInput.value = from;
    //     }
    // }

    // function controlFromSlider(fromSlider, toSlider, fromInput) {
    //     const [from, to] = getParsed(fromSlider, toSlider);
    //     fillSlider(fromSlider, toSlider, '#D9D9D9', '#385f8d', toSlider);
    //     if (from > to) {
    //         fromSlider.value = to;
    //         fromInput.value = to;
    //     } else {
    //         fromInput.value = from;
    //     }
    // }

    // function controlToSlider(fromSlider, toSlider, toInput) {
    //     const [from, to] = getParsed(fromSlider, toSlider);
    //     fillSlider(fromSlider, toSlider, '#D9D9D9', '#385f8d', toSlider);
    //     setToggleAccessible(toSlider);
    //     if (from <= to) {
    //         toSlider.value = to;
    //         toInput.value = to;
    //     } else {
    //         toInput.value = from;
    //         toSlider.value = from;
    //     }
    // }

    function getParsed(currentFrom, currentTo) {
        const from = parseInt(uncomma(currentFrom.value), 10);
        const to = parseInt(uncomma(currentTo.value), 10);
        return [from, to];
    }

    function fillSlider(from, to, sliderColor, rangeColor, controlSlider) {
        const rangeDistance = to.max - to.min;
        const fromPosition = uncomma(from.value) - to.min;
        const toPosition = uncomma(to.value) - to.min;

        controlSlider.style.background = `linear-gradient(
        to right,
        ${sliderColor} 0%,
        ${sliderColor} ${(fromPosition)/(rangeDistance)*100}%,
        ${rangeColor} ${((fromPosition)/(rangeDistance))*100}%,
        ${rangeColor} ${(toPosition)/(rangeDistance)*100}%, 
        ${sliderColor} ${(toPosition)/(rangeDistance)*100}%, 
        ${sliderColor} 100%)`;
    }

    function setToggleAccessible(currentTarget, toSlider) {
        // toSlider = document.querySelector('#toSlider');
        if (Number(uncomma(currentTarget.value)) <= 0) {
            toSlider.style.zIndex = 2;
        } else {
            toSlider.style.zIndex = 0;
        }
    }

    var fromSlider = document.querySelector('#fromSlider');
    var toSlider = document.querySelector('#toSlider');
    var fromInput = document.querySelector('#fromInput');
    var toInput = document.querySelector('#toInput');


    $(document).on("click", ".label_fx button", function(e) {
        e.preventDefault(); // 기본 동작 막기
        tranBtnClick();
    });
    
    function tranBtnClick(){
        console.log('tranBtnClick');
        $(".form_area").toggleClass("up");
        var max = $('.input_area').attr('max');
        var min = $('.input_area').attr('min');
        var fval = uncomma($('#fromAreaInput').val());
        var tval = uncomma($('#toAreaInput').val());

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

        $('#fromAreaInput').val(comma(fval));
        $('#toAreaInput').val(comma(tval));
        controlFromInput(fromAreaSlider, fromAreaInput, toAreaInput, toAreaSlider);
        controlToInput(toAreaSlider, fromAreaInput, toAreaInput, toAreaSlider);
    }

    function controlFromInput(fromSlider, fromInput, toInput, controlSlider) {
        const [from, to] = getParsed(fromInput, toInput);
        fillSlider(fromInput, toInput, '#D9D9D9', '#385f8d', controlSlider);
        if (from > to) {
            fromSlider.value = to;
            fromInput.value = comma(to);
        } else {
            fromSlider.value = from;
            fromInput.value = comma(from);
        }
    }

    function controlToInput(toSlider, fromInput, toInput, controlSlider) {
        const [from, to] = getParsed(fromInput, toInput);
        fillSlider(fromInput, toInput, '#D9D9D9', '#385f8d', controlSlider);
        setToggleAccessible(toInput, toSlider);
        if (from <= to) {
            toSlider.value = to;
            toInput.value = comma(to);
        } else {
            toInput.value = comma(from);
        }
    }

    function controlFromSlider(fromSlider, toSlider, fromInput) {
        const [from, to] = getParsed(fromSlider, toSlider);
        fillSlider(fromSlider, toSlider, '#D9D9D9', '#385f8d', toSlider);
        if (from > to) {
            fromSlider.value = to;
            fromInput.value = comma(to);
        } else {
            fromInput.value = comma(from);
        }
    }

    function controlToSlider(fromSlider, toSlider, toInput) {
        const [from, to] = getParsed(fromSlider, toSlider);
        fillSlider(fromSlider, toSlider, '#D9D9D9', '#385f8d', toSlider);
        setToggleAccessible(toSlider, toSlider);
        if (from <= to) {
            toSlider.value = to;
            toInput.value = comma(to);
        } else {
            toInput.value = comma(from);
            toSlider.value = from;
        }
    }

    // function getParsed(currentFrom, currentTo) {
    //     const from = parseInt(uncomma(currentFrom.value), 10);
    //     const to = parseInt(uncomma(currentTo.value), 10);
    //     return [from, to];
    // }

    // function fillSlider(from, to, sliderColor, rangeColor, controlSlider) {
    //     const rangeDistance = to.max - to.min;
    //     const fromPosition = uncomma(from.value) - to.min;
    //     const toPosition = uncomma(to.value) - to.min;
    //     controlSlider.style.background = `linear-gradient(
    //     to right,
    //     ${sliderColor} 0%,
    //     ${sliderColor} ${(fromPosition) / (rangeDistance) * 100}%,
    //     ${rangeColor} ${((fromPosition) / (rangeDistance)) * 100}%,
    //     ${rangeColor} ${(toPosition) / (rangeDistance) * 100}%,
    //     ${sliderColor} ${(toPosition) / (rangeDistance) * 100}%,
    //     ${sliderColor} 100%)`;
    // }

    // function setToggleAccessible(currentTarget) {
    //     toAreaSlider = document.querySelector('#toAreaSlider');
    //     if (Number(currentTarget.value) <= 0) {
    //         toAreaSlider.style.zIndex = 2;
    //     } else {
    //         toAreaSlider.style.zIndex = 0;
    //     }
    // }

    var fromAreaSlider = document.querySelector('#fromAreaSlider');
    var toAreaSlider = document.querySelector('#toAreaSlider');
    var fromAreaInput = document.querySelector('#fromAreaInput');
    var toAreaInput = document.querySelector('#toAreaInput');

    
    function initInputRange(){
        fromSlider = document.querySelector('#fromSlider');
        toSlider = document.querySelector('#toSlider');
        fromInput = document.querySelector('#fromInput');
        toInput = document.querySelector('#toInput');

        fromAreaSlider = document.querySelector('#fromAreaSlider');
        toAreaSlider = document.querySelector('#toAreaSlider');
        fromAreaInput = document.querySelector('#fromAreaInput');
        toAreaInput = document.querySelector('#toAreaInput');

        fillSlider(fromSlider, toSlider, '#D9D9D9', '#385f8d', toSlider);
        setToggleAccessible(toSlider, toSlider);

        fromSlider.oninput = () => controlFromSlider(fromSlider, toSlider, fromInput);
        toSlider.oninput = () => controlToSlider(fromSlider, toSlider, toInput);
        fromInput.oninput = () => controlFromInput(fromSlider, fromInput, toInput, toSlider);
        toInput.oninput = () => controlToInput(toSlider, fromInput, toInput, toSlider);

        fillSlider(fromAreaSlider, toAreaSlider, '#D9D9D9', '#385f8d', toAreaSlider);
        setToggleAccessible(toAreaSlider, toAreaSlider);

        fromAreaSlider.oninput = () => controlFromSlider(fromAreaSlider, toAreaSlider, fromAreaInput);
        toAreaSlider.oninput = () => controlToSlider(fromAreaSlider, toAreaSlider, toAreaInput);
        fromAreaInput.oninput = () => controlFromInput(fromAreaSlider, fromAreaInput, toAreaInput, toAreaSlider);
        toAreaInput.oninput = () => controlToInput(toAreaSlider, fromAreaInput, toAreaInput, toAreaSlider);

        console.log('initInputRange');
    }

    function initFilterForm(){
        console.log('initFilterForm');
        var oldCond = JSON.parse(getCookie('filter_condition'));

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
        if(oldCond.toPrice){
            frm.fromPrice.value = comma(oldCond.fromPrice);
            frm.toPrice.value = comma(oldCond.toPrice);
            controlFromInput(fromSlider, fromInput, toInput, toSlider);
            controlToInput(toSlider, fromInput, toInput, toSlider);
        }else{
            frm.toPrice.value = comma(frm.toPrice.value);
        }
        if(oldCond.toArea){
            if(oldCond.area_unit=='p' && $("#area_unit").val() != 'p'){
                tranBtnClick();
            }
            frm.fromArea.value = comma(oldCond.fromArea);
            frm.toArea.value = comma(oldCond.toArea);
            controlFromInput(fromAreaSlider, fromAreaInput, toAreaInput, toAreaSlider);
            controlToInput(toAreaSlider, fromAreaInput, toAreaInput, toAreaSlider);
        }else{
            frm.toArea.value = comma(frm.toArea.value);
        }
        console.log('fromSlider',fromSlider);
    }
        
    // filter script e//////////////////////////////////
</script>