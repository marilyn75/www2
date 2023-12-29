<script>
    var jsonCate;

    // $.ajax({
    //     url: '{{ route('common.ajax.getSaleCategory') }}',
    //     type: 'GET',
    //     dataType: 'json',
    //     async: false,  // 동기적으로 설정
    //     success: function(response) {
    //         if(response.result){
    //             jsonCate = response.data;
    //             console.log(jsonCate);
    //         }else{
    //             alert(response.message);
    //         }
    //     },
    //     error: function(error) {
    //         console.error('Error:', error);
    //     }
    // });

    function addFavorite(obj, id) {
        var $child = $(obj).children();

        var flag = ($child.hasClass('ri-heart-3-line')) ? "add" : "remove";
        var params = {
            id: id,
            flag: flag
        };

        var r = doAjax('{{ route('common.ajax.addFavorite') }}', params);

        if (r.result) {
            if (flag == "add") $child.removeClass('ri-heart-3-line').addClass('ri-heart-3-fill');
            else $child.removeClass('ri-heart-3-fill').addClass('ri-heart-3-line');

            // if(flag=="add") $child.addClass('on');
            // else            $child.removeClass('on');
            sbAlert(r.message);
        }

        return false;
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

    $(document).ready(function(){
        var r = doAjax('{{ route('common.ajax.getSaleCategory') }}');
        if (r.result) jsonCate = r.data;

        jsonCate.forEach(function(cate){
            $html = $('#divCategory label').eq(0).clone();
            $html.find('input').attr('checked',false).val(cate.id);
            $html.find('span').html(cate.title);
            $html.appendTo('#divCategory');
        });

        

        initFilterForm();initInputRange();

        console.log(JSON.parse(getCookie('filter_condition')));
    });

    $(document).on('change', "input[name='cate1']", function(){
        var idx = ($("input[name='cate1']").index(this));

        var html = '<label for="cate2" id="lbCate2">주거용</label><select id="cate2" name="cate2" class="selectpicker w100 show-tick"></select>';

        $('#divCate2').html(html);
        if(idx>0){
            var data = jsonCate[idx-1];
            $('#lbCate2').html(data.title);
            $('#cate2').append($('<option>', {value: ' ', text: data.title+' 전체'}));
            data.children.forEach(function(subCate){
                $('#cate2').append($('<option>', {
                            value: subCate.id,
                            text: subCate.title
                        }));
            });
            $('#cate2').selectpicker('refresh');
            $("#divSubCategory").show();
        }else{
            $("#divSubCategory").hide();
        }
        console.log('change cate1');
    });


    $(document).on('change', '#transArea', function() {
        if (this.checked) {
            $('.area').each(function() {
                $(this).html($(this).data('py'));
            });
        } else {
            $('.area').each(function() {
                $(this).html($(this).data('m2'));
            });
        }
    });

    // 초기화
    $(document).on('click', '.reset_btn', function(){
        setCookie('filter_condition','');
        frm.reset();
        frm.submit();
    });
</script>

<form name="frm" action="{{ $data->path() }}" method="post" class="row">
    @csrf
    <input type="hidden" name="page" value="1">

    <!-- mobile filter -->
    <div class="row">
        <div class="col-lg-12">
            <div class="listing_sidebar dn db-991">
                <div class="sidebar_content_details style3">
                    <!-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> -->
                    <div class="closebtn_wrap">
                        <a class="filter_closed_btn" href="#"><i class="ri-close-line"></i></a>
                    </div>
                    <div class="sidebar_listing_list style2 mobile_sytle_sidebar mb0" id="divFilterM">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- mobile filter end -->

    <!-- pc side bar -->
    <div class="col-lg-3 col-xl-3">
        <div class="dn-smd dn-991 pc_filter_bx" id="divFilter">
            @include('include.filter')
        </div>
    </div>
    <!-- pc side bar end -->

    <div class="col-md-12 col-lg-9">
        <!-- 검색결과 -->
        <div class="row row_w">
            <div class="grid_list_search_result search_result_w">
                <div class="right_area text-right tac-xsd subfilter_w">
                    <ul class="sub_filt">
                        {{-- <li class="list-inline-item">
                                <select class="selectpicker show-tick">
                                    <option>최신순</option>
                                    <option>오래된순</option>
                                    <option>찜하기순</option>
                                </select>
                            </li> --}}
                        <li class="list-inline-item">
                            <select class="selectpicker show-tick" name="sort"
                                onchange="frm.sort.value=this.value;frm.submit();">
                                <option value="reg_date|desc" @if (@$_POST['sort'] == 'reg_date|desc') selected @endif>
                                    최신순</option>
                                <option value="reg_date" @if (@$_POST['sort'] == 'reg_date') selected @endif>오래된순
                                </option>
                                <option value="isRecom|desc" @if (@$_POST['sort'] == 'isRecom|desc') selected @endif>
                                    추천순</option>
                                <option value="salePrice|desc" @if (@$_POST['sort'] == 'salePrice|desc') selected @endif>
                                    높은가격순</option>
                                <option value="salePrice" @if (@$_POST['sort'] == 'salePrice') selected @endif>낮은가격순
                                </option>
                                {{-- <option value="zzim desc" @if ($_POST['sort'] == 'zzim desc') selected @endif>찜하기순</option>
                                    <option value="price desc" @if ($_POST['sort'] == 'price desc') selected @endif>높은가격순</option>
                                    <option value="price asc" @if ($_POST['sort'] == 'price asc') selected @endif>낮은가격순</option> --}}
                            </select>
                        </li>
                        <li>
                            <div class="button r" id="button-1">
                                <input type="checkbox" class="checkbox" id="transArea" />
                                <div class="knobs"></div>
                                <div class="layer"></div>
                            </div>
                        </li>
                        <!-- <input type="checkbox" checked data-toggle="toggle" data-on="㎡" data-off="평"> -->
                    </ul>
                </div>
            </div>
        </div>
        <!-- 검색결과 end -->

        <div class="row">
            @foreach ($data as $_data)
                @php

                    $printData = App\Http\Class\IntraSaleClass::getPrintData($_data);

                    // if(!empty($favorites) && in_array($printData['idx'], $favorites)) $printData['isFavorite'] = true;

                @endphp
                <x-item-sale-intranet type='default' :printData="$printData" />
            @endforeach
            <x-pagination :data="$data" />
        </div>
    </div>
</form>

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

    
        
    // filter script e//////////////////////////////////
</script>