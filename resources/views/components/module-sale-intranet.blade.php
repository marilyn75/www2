<script>
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
</script>

<form name="frm" action="{{ $data->path() }}" method="post" class="row pl15 pr15">
    @csrf
    <input type="hidden" name="page" value="1">

    <!-- mobile filter -->
    <div class="row">
        <div class="col-lg-12">
            <div class="listing_sidebar dn db-991">
                <div class="sidebar_content_details style3">
                    <!-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> -->
                    <div class="sidebar_listing_list style2 mobile_sytle_sidebar mb0">
                        <div class="sidebar_advanced_search_widget">
                            <h4 class="mb25 mont">Filter <a class="filter_closed_btn float-right" href="#"><i class="ri-close-line"></i></a></h4>
                                        <ul class="sasw_list mb0 sasw_list_w">
                    <li>
                        <div class="left_area tac-xsd result_filt">
                            <p>검색결과 <span class="mont point_c">16</span>건</p>
                            <button class="reset_btn">초기화</button>
                        </div>

                    </li>
                    <li>
                        <label for="">유형</label>
                        <div class="filt_btns" data-toggle="buttons">
                            <label class="btn filt_r-btn inter active">
                                <input type="radio" name="options" id="option1" autocomplete="off" checked="">주거용
                            </label>
                            <label class="btn filt_r-btn inter">
                                <input type="radio" name="options" id="option2" autocomplete="off">상업용
                            </label>
                        </div>
                    </li>
                    <li>
                        <label for="">지역</label>
                        <div class="search_option_two">
                            <div class="select_w">
                                <input type="text" placeholder="지역">
                            </div>
                        </div>
                    </li>
                    <li>
                        <label for="">거래종류</label>
                        <div class="filt_btns" data-toggle="buttons">
                            <label class="btn filt_r-btn inter active">
                                <input type="radio" name="options" id="option1" autocomplete="off" checked="">매매
                            </label>
                            <label class="btn filt_r-btn inter">
                                <input type="radio" name="options" id="option2" autocomplete="off">임대
                            </label>
                        </div>
                    </li>

                    


                    <li>
                        <div class="search_option_button">
                            <button type="submit" class="btn btn-block btn-thm btn-thm_w">검색하기</button>
                        </div>
                    </li>
                </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- mobile filter end -->

    <!-- pc side bar -->
    <div class="col-lg-3 col-xl-3">
        <div class="dn-smd dn-991 pc_filter_bx">
            <div class="sidebar_advanced_search_widget">
                <ul class="sasw_list mb0 sasw_list_w">
                    <li>
                        <div class="left_area tac-xsd result_filt">
                            <p>검색결과 <span class="mont point_c">16</span>건</p>
                            <button class="reset_btn">초기화</button>
                        </div>

                    </li>
                    <li>
                        <label for="">유형</label>
                        <div class="filt_btns" data-toggle="buttons">
                            <label class="btn filt_r-btn inter active">
                                <input type="radio" name="options" id="option1" autocomplete="off" checked="">주거용
                            </label>
                            <label class="btn filt_r-btn inter">
                                <input type="radio" name="options" id="option2" autocomplete="off">상업용
                            </label>
                        </div>
                    </li>
                    <li>
                        <label for="">지역</label>
                        <div class="search_option_two">
                            <div class="select_w">
                                <input type="text" placeholder="지역">
                            </div>
                        </div>
                    </li>
                    <li>
                        <label for="">거래종류</label>
                        <div class="filt_btns" data-toggle="buttons">
                            <label class="btn filt_r-btn inter active">
                                <input type="radio" name="options" id="option1" autocomplete="off" checked="">매매
                            </label>
                            <label class="btn filt_r-btn inter">
                                <input type="radio" name="options" id="option2" autocomplete="off">임대
                            </label>
                        </div>
                    </li>

                    <li>
                        <label for="">가격</label>
                        <div class="range_container">
                            <div class="form_control">
                                <!-- min -->
                                <div class="form_control_container">
                                    <input class="form_price" type="number" id="fromInput" value="10" min="0"
                                        max="100" />
                                </div>
                                <!-- max -->
                                <div class="form_control_container">
                                    <input class="form_price" type="number" id="toInput" value="30" min="0" max="100" />
                                </div>
                            </div>
                            <div class="sliders_control">
                                <input id="fromSlider" type="range" value="10" min="0" max="100" />
                                <input id="toSlider" type="range" value="30" min="0" max="100" />
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
                    <li>
                        <div class="label_fx">
                            <label for="transactionArea">거래면적</label>
                            <button>
                                <i class="ri-exchange-fill"></i>
                            </button>
                        </div>
                        <div class="range_container">
                            <div class="form_control">
                                <!-- min -->
                                <div class="form_control_container">
                                    <input class="form_area" type="number" id="fromAreaInput" value="10" min="0"
                                        max="100" />
                                </div>
                                <!-- max -->
                                <div class="form_control_container">
                                    <input class="form_area" type="number" id="toAreaInput" value="30" min="0"
                                        max="100" />
                                </div>
                            </div>
                            <div class="sliders_control">
                                <input id="fromAreaSlider" type="range" value="10" min="0" max="100" />
                                <input id="toAreaSlider" type="range" value="30" min="0" max="100" />
                            </div>
                        </div>
                    </li>
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
                    fromAreaInput.oninput = () => controlFromAreaInput(fromAreaSlider, fromAreaInput, toAreaInput,
                        toAreaSlider);
                    toAreaInput.oninput = () => controlToAreaInput(toAreaSlider, fromAreaInput, toAreaInput,
                        toAreaSlider);
                    </script>


                    <li>
                        <div class="search_option_button">
                            <button type="submit" class="btn btn-block btn-thm btn-thm_w">검색하기</button>
                        </div>
                    </li>
                </ul>
            </div>
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
                                <option value="reg_date|desc" @if (@$_POST['sort']=="reg_date|desc" ) selected @endif>
                                    최신순</option>
                                <option value="reg_date" @if (@$_POST['sort']=="reg_date" ) selected @endif>오래된순
                                </option>
                                <option value="isRecom|desc" @if (@$_POST['sort']=="isRecom|desc" ) selected @endif>
                                    추천순</option>
                                <option value="salePrice|desc" @if (@$_POST['sort']=="salePrice|desc" ) selected @endif>
                                    높은가격순</option>
                                <option value="salePrice" @if (@$_POST['sort']=="salePrice" ) selected @endif>낮은가격순
                                </option>
                                {{-- <option value="zzim desc" @if ($_POST['sort']=="zzim desc") selected @endif>찜하기순</option>
                                    <option value="price desc" @if ($_POST['sort']=="price desc") selected @endif>높은가격순</option>
                                    <option value="price asc" @if ($_POST['sort']=="price asc") selected @endif>낮은가격순</option> --}}
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