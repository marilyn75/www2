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
                        <input class="form_price" type="hidden" name="fromPrice" id="fromInput" value="" readonly />
                        <input class="form_price" type="text" name="fromPrice_txt" id="fromInput_txt" value="최소" readonly />
                    </div>
                    <!-- max -->
                    <div class="form_control_container">
                        <input class="form_price" type="hidden" name="toPrice" id="toInput" value="" readonly />
                        <input class="form_price" type="text" name="toPrice_txt" id="toInput_txt" value="최대" readonly />
                    </div>
                </div>
                <div class="sliders_control">
                    <input id="fromSlider" name="fromPriceRange" type="range" value="0" min="0" max="12" step="1" />
                    <input id="toSlider" name="toPriceRange" type="range" value="12" min="0"max="12" step="1" />
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
                        <input class="form_area" type="hidden" name="fromArea" id="fromAreaInput" value="" />
                        <input class="form_area" type="text" name="fromArea_txt" id="fromAreaInput_txt" value="최소" min="0" max="12" readonly />
                    </div>
                    <!-- max -->
                    <div class="form_control_container">
                        <input class="form_area" type="hidden" name="toArea" id="toAreaInput" value="" />
                        <input class="form_area" type="text" name="toArea_txt" id="toAreaInput_txt" value="최대" min="0" max="12" />
                    </div>
                </div>
                <div class="sliders_control">
                    <input id="fromAreaSlider" name="fromAreaRange" type="range" value="0" min="0" max="12" step="1" />
                    <input id="toAreaSlider" name="toAreaRange" type="range" value="12" min="0" max="12" step="1" />
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
    var arrPriceRange = [
        {'title':'최소', 'class':''},
        {'title':'5천만', 'class':'5000'},
        {'title':'1억', 'class':'10000'},
        {'title':'2억', 'class':'20000'},
        {'title':'3억', 'class':'30000'},
        {'title':'5억', 'class':'50000'},
        {'title':'10억', 'class':'100000'},
        {'title':'20억', 'class':'200000'},
        {'title':'30억', 'class':'300000'},
        {'title':'50억', 'class':'500000'},
        {'title':'100억', 'class':'1000000'},
        {'title':'300억', 'class':'3000000'},
        {'title':'최대', 'class':''}, 
    ];

    var arrAreaMRange = [
        {'title':'최소', 'class':''},
        {'title':'30', 'class':'30'},
        {'title':'50', 'class':'50'},
        {'title':'100', 'class':'100'},
        {'title':'150', 'class':'150'},
        {'title':'200', 'class':'200'},
        {'title':'300', 'class':'300'},
        {'title':'500', 'class':'500'},
        {'title':'800', 'class':'800'},
        {'title':'1,000', 'class':'1000'},
        {'title':'3,000', 'class':'3000'},
        {'title':'5,000', 'class':'5000'},
        {'title':'최대', 'class':''}, 
    ];

    var arrAreaPRange = [
        {'title':'최소', 'class':''},
        {'title':'10', 'class':'33.057851'},
        {'title':'20', 'class':'66.115702'},
        {'title':'30', 'class':'99.173554'},
        {'title':'40', 'class':'132.231405'},
        {'title':'50', 'class':'165.289256'},
        {'title':'100', 'class':'330.578512'},
        {'title':'200', 'class':'661.157025'},
        {'title':'300', 'class':'991.735537'},
        {'title':'500', 'class':'1652.89256'},
        {'title':'1,000', 'class':'3305.78512'},
        {'title':'3,000', 'class':'9917.35537'},
        {'title':'최대', 'class':''}, 
    ];

    var arrAreaRange = arrAreaMRange;


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
        

        if($(".form_area").hasClass('up')){ // 평
            $("#area_unit").val('p');
            arrAreaRange = arrAreaPRange;
        }else{                              // 제곱미터
            $("#area_unit").val('m');
            arrAreaRange = arrAreaMRange;
        }
        frm.fromArea.value = '';
        frm.toArea.value = '';
        frm.fromArea_txt.value = '최소';
        frm.toArea_txt.value = '최대';
        frm.fromAreaRange.value = 0;
        frm.toAreaRange.value = 12;

        fillSlider(frm.fromAreaRange, frm.toAreaRange, '#D9D9D9', '#385f8d', frm.toAreaRange);
    }

    // function controlFromInput(fromSlider, fromInput, toInput, controlSlider) {
    //     const [from, to] = getParsed(fromInput, toInput);
    //     // fillSlider(fromInput, toInput, '#D9D9D9', '#385f8d', controlSlider);
    //     if (from > to) {
    //         fromSlider.value = to;
    //         fromInput.value = comma(to);
    //     } else {
    //         fromSlider.value = from;
    //         fromInput.value = comma(from);
    //     }
    // }

    // function controlToInput(toSlider, fromInput, toInput, controlSlider) {
    //     const [from, to] = getParsed(fromInput, toInput);
    //     fillSlider(fromInput, toInput, '#D9D9D9', '#385f8d', controlSlider);
    //     setToggleAccessible(toInput, toSlider);
    //     if (from <= to) {
    //         toSlider.value = to;
    //         toInput.value = comma(to);
    //     } else {
    //         toInput.value = comma(from);
    //     }
    // }

    function controlFromSlider(fromSlider, toSlider, fromInput) {
        const [from, to] = getParsed(fromSlider, toSlider);
        fillSlider(fromSlider, toSlider, '#D9D9D9', '#385f8d', toSlider);
        var arrRange = arrPriceRange;
        if(fromInput.name=='fromArea')    arrRange = arrAreaRange;

        if (from > to) {
            fromSlider.value = to;
            fromInput.value = arrRange[to]['class'];
            $(fromInput).next()[0].value = arrRange[to]['title'];
        } else {
            fromInput.value = arrRange[from]['class'];
            $(fromInput).next()[0].value = arrRange[from]['title'];
        }
    }

    function controlToSlider(fromSlider, toSlider, toInput) {
        const [from, to] = getParsed(fromSlider, toSlider);
        fillSlider(fromSlider, toSlider, '#D9D9D9', '#385f8d', toSlider);
        var arrRange = arrPriceRange;
        if(toInput.name=='toArea')    arrRange = arrAreaRange;
        setToggleAccessible(toSlider, toSlider);
        if (from <= to) {
            toSlider.value = to;
            toInput.value = arrRange[to]['class'];
            $(toInput).next()[0].value = arrRange[to]['title'];
        } else {
            toInput.value = arrRange[from]['class'];
            $(toInput).next()[0].value = arrRange[from]['title'];
            toSlider.value = from;
        }
    }

    
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
        // fromInput.oninput = () => controlFromInput(fromSlider, fromInput, toInput, toSlider);
        // toInput.oninput = () => controlToInput(toSlider, fromInput, toInput, toSlider);

        fillSlider(fromAreaSlider, toAreaSlider, '#D9D9D9', '#385f8d', toAreaSlider);
        setToggleAccessible(toAreaSlider, toAreaSlider);

        fromAreaSlider.oninput = () => controlFromSlider(fromAreaSlider, toAreaSlider, fromAreaInput);
        toAreaSlider.oninput = () => controlToSlider(fromAreaSlider, toAreaSlider, toAreaInput);
        // fromAreaInput.oninput = () => controlFromInput(fromAreaSlider, fromAreaInput, toAreaInput, toAreaSlider);
        // toAreaInput.oninput = () => controlToInput(toAreaSlider, fromAreaInput, toAreaInput, toAreaSlider);

        console.log('initInputRange');
    }

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
        
    // filter script e//////////////////////////////////
</script>