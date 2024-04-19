@extends('layout.layout')

@section('content')
    <form name="frm" action="" method="post" class="col-md-12 pl0 pr0">
        @csrf
        <input type="hidden" name="page" value="1">
        <section class="our-listing pb30-991">
            <div class="container_w">
                {{-- 개발용 조건 코드 - 개발완료 후 @if, @endif 제거 --}}
                @if (env('APP_ENV') == 'local')
                    <style>
                        .sel {
                            color: red;
                        }
                    </style>
                    <script>
                        $(document).ready(function() {
                            setGu();
                        });

                        function getListAddr(pnu) {
                            var data;
                            $.ajax({
                                type: 'post',
                                url: "{{ env('AUCTION_API_URL') . __('/api/listLocation/') }}" + pnu,
                                async: false,
                                dataType: 'json',
                                success: function(r) {
                                    //작업이 성공적으로 발생했을 경우
                                    data = r;
                                },
                                error: function(e) {
                                    //에러가 났을 경우 실행시킬 코드
                                    console.log(e);
                                }
                            });

                            return data;
                        }

                        function setGu() {
                            var data = getListAddr('26');
                            $ul = $("<ul></ul>");

                            data.forEach(function(item) {
                                // console.log(item);
                                if (item.sgg_cd == "000")
                                    $ul.append('<li><button type="button" class="btn sel" code="' + item.sido_cd + item.sgg_cd +
                                        '">' + item.locallow_nm + ' 전체</button></li>');
                                else
                                    $ul.append('<li><button type="button" class="btn" code="' + item.sido_cd + item.sgg_cd + '">' +
                                        item.locallow_nm + '</button></li>');
                            });

                            $('#ftAddr div').eq(0).html($ul);
                        }

                        function setDong(pnu) {
                            var data = getListAddr(pnu);
                            $ul = $("<ul></ul>");

                            data.forEach(function(item) {
                                // console.log(item);
                                if (item.umd_cd == "000")
                                    $ul.append('<li><button type="button" class="btn" code="' + item.locatjumin_cd + '">' + item
                                        .locallow_nm + ' 전체</button></li>');
                                else
                                    $ul.append('<li><button type="button" class="btn" code="' + item.locatjumin_cd + '">' + item
                                        .locallow_nm + '</button></li>');
                            });
                            $('#ftAddr div').eq(1).html($ul);
                        }

                        // 구 선택
                        $(document).on('click', '#ftAddr div:eq(0) li button', function() {
                            $(this).closest('ul').find('button').removeClass('sel');
                            $(this).addClass('sel');
                            var pnu = $(this).attr('code');

                            setDong(pnu);
                        });

                        // 동 선택
                        $(document).on('click', '#ftAddr div:eq(1) li button', function() {
                            $(this).closest('ul').find('button').removeClass('sel');
                            $(this).addClass('sel');

                        });
                    </script>
                    {{-- <div class="col-md-12 pl0 pr0">
                        <div id="exTab1">
                            <ul class="nav nav-pills">
                                <li class="active">
                                    <a href="#1a" data-toggle="tab"><img src="/images/auction/fail.png"
                                            alt="">지역</a>
                                </li>
                                <li><a href="#2a" data-toggle="tab"><img src="/images/auction/use.png"
                                            alt="">용도</a>
                                </li>
                                <li><a href="#3a" data-toggle="tab"><img src="/images/auction/price.png"
                                            alt="">감정가/최저가</a>
                                </li>
                                <li><a href="#4a" data-toggle="tab"><img src="/images/auction/status.png"
                                            alt="">물건상태</a>
                                </li>
                            </ul>
                            <div class="tab-content clearfix">
                                <div class="tab-pane active" id="1a">
                                    <div class="auc_menu-box" id="ftAddr">
                                        <div class="red-box overflow-auto" style="height:200px;">
                                            <ul>

                                            </ul>
                                        </div>
                                        <div class="sub-box overflow-auto" style="height:200px;">
                                            <ul>
                                                <li>전체</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="2a">
                                    <div class="auc_menu-box" id="ftPurpose">

                                        <div class="red-box">
                                            <ul>
                                                <li><button type="button" class="btn">전체</button></li>
                                                <li><button type="button" class="btn">주거용 건물</button></li>
                                                <li><button type="button" class="btn">상업용 건물</button></li>
                                                <li><button type="button" class="btn">토지</button></li>
                                            </ul>
                                        </div>
                                        <div class="sub-box">
                                            <ul>
                                                <li>전체</li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane" id="3a">
                                    <div class="auc_menu-box" id="usage-box">
                                        <div class="red-box sm-box">
                                            <ul>
                                                <li class="filt_li">
                                                    <label for="">가격</label>
                                                    <div class="range_container">
                                                        <div class="form_control">
                                                            <!-- min -->
                                                            <div class="form_control_container">
                                                                <input class="form_price" type="hidden"
                                                                    name="fromPriceJudge" id="fromJudge" value=""
                                                                    readonly="">
                                                                <input class="form_price" type="text"
                                                                    name="fromPriceJudge_txt" id="fromJudge_txt"
                                                                    value="최소" readonly="">
                                                            </div>
                                                            <!-- max -->
                                                            <div class="form_control_container">
                                                                <input class="form_price" type="hidden" name="toPriceJudge"
                                                                    id="toJudge" value="" readonly="">
                                                                <input class="form_price" type="text"
                                                                    name="toPriceJudge_txt" id="toJudge_txt" value="최대"
                                                                    readonly="">
                                                            </div>
                                                        </div>
                                                        <div class="sliders_control">
                                                            <input id="fromJudgeSlider" name="fromPriceJudgeRange"
                                                                type="range" value="0" min="0" max="12"
                                                                step="1">
                                                            <input id="toJudgeSlider" name="toPriceJudgeRange"
                                                                type="range" value="12" min="0" max="12"
                                                                step="1"
                                                                style="background: linear-gradient(to right, rgb(217, 217, 217) 0%, rgb(217, 217, 217) 0%, rgb(56, 95, 141) 0%, rgb(56, 95, 141) 100%, rgb(217, 217, 217) 100%, rgb(217, 217, 217) 100%); z-index: 0;">
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="sub-box sm-box">
                                            <ul>
                                                <li class="filt_li">
                                                    <label for="">감정가</label>
                                                    <div class="range_container">
                                                        <div class="form_control">
                                                            <!-- min -->
                                                            <div class="form_control_container">
                                                                <input class="form_price" type="text" name="fromPrice"
                                                                    id="fromInputJudge" value="0" min="0"
                                                                    max="100" />
                                                            </div>
                                                            <!-- max -->
                                                            <div class="form_control_container">
                                                                <input class="form_price" type="text" name="toPrice"
                                                                    id="toInput" value="100" min="0"
                                                                    max="100" />
                                                            </div>
                                                        </div>
                                                        <div class="sliders_control">
                                                            <input id="fromSlider" type="range" value="0"
                                                                min="0" max="100" step="10" />
                                                            <input id="toSlider" type="range" value="100"
                                                                min="0"max="100" step="10" />
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    function controlFromInput(fromSlider, fromInputJudge, toInput, controlSlider) {
                                        const [from, to] = getParsed(fromInputJudge, toInput);
                                        fillSlider(fromInputJudge, toInput, '#C6C6C6', '#385f8d', controlSlider);
                                        if (from > to) {
                                            fromSlider.value = to;
                                            fromInputJudge.value = to;
                                        } else {
                                            fromSlider.value = from;
                                        }
                                    }

                                    function controlToInput(toSlider, fromInputJudge, toInput, controlSlider) {
                                        const [from, to] = getParsed(fromInputJudge, toInput);
                                        fillSlider(fromInputJudge, toInput, '#C6C6C6', '#385f8d', controlSlider);
                                        setToggleAccessible(toInput);
                                        if (from <= to) {
                                            toSlider.value = to;
                                            toInput.value = to;
                                        } else {
                                            toInput.value = from;
                                        }
                                    }

                                    function controlFromSlider(fromSlider, toSlider, fromInputJudge) {
                                        const [from, to] = getParsed(fromSlider, toSlider);
                                        fillSlider(fromSlider, toSlider, '#C6C6C6', '#385f8d', toSlider);
                                        if (from > to) {
                                            fromSlider.value = to;
                                            fromInputJudge.value = to;
                                        } else {
                                            fromInputJudge.value = from;
                                        }
                                    }

                                    function controlToSlider(fromSlider, toSlider, toInput) {
                                        const [from, to] = getParsed(fromSlider, toSlider);
                                        fillSlider(fromSlider, toSlider, '#C6C6C6', '#385f8d', toSlider);
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
                                    const fromInputJudge = document.querySelector('#fromInputJudge');
                                    const toInput = document.querySelector('#toInput');
                                    fillSlider(fromSlider, toSlider, '#C6C6C6', '#385f8d', toSlider);
                                    setToggleAccessible(toSlider);

                                    fromSlider.oninput = () => controlFromSlider(fromSlider, toSlider, fromInputJudge);
                                    toSlider.oninput = () => controlToSlider(fromSlider, toSlider, toInput);
                                    fromInputJudge.oninput = () => controlFromInput(fromSlider, fromInputJudge, toInput, toSlider);
                                    toInput.oninput = () => controlToInput(toSlider, fromInputJudge, toInput, toSlider);
                                </script>
                                <div class="tab-pane" id="4a">
                                    <div class="auc_menu-box" id="usage-box">
                                        <div class="red-box">
                                            <ul>
                                                <li>진행중</li>
                                                <li>변경/연기</li>
                                                <li>낙찰</li>
                                                <li>기각/취하/취소</li>
                                            </ul>
                                        </div>
                                        <div class="sub-box">
                                            <ul>
                                                <li>전체</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}


                    {{-- new filter --}}
                    <div class="col-md-12 pl0 pr0 mt50">
                        <div class="n_filt_top">
                            <div class="input-group mb-3 n_search">
                                <input type="text" class="form-control" id="searchInput" placeholder="사건번호 검색" aria-label="Recipient's username" aria-describedby="button-addon2">
                                <button class="btn" type="button" id="button-addon2">검색</button>
                                
                                {{-- 최근검색기록 & 2023검색결과 --}}
                                <div class="input_bx" id="box">
                                    <div class="input_bx_top">
                                        <h3>2023검색결과</h3>
                                        <button class="btn">검색기록 지우기</button>
                                    </div>
                                    <ul>
                                        <li>
                                            <div class="n_auc_tit">
                                                <div class="auc_bdg auc_b">경매</div>
                                                <h2>2023타경2023[2]</h2>
                                            </div>
                                            <p class="n_auc_loc">부산시 연제구 연제동 123</p>
                                        </li>
                                        <li>
                                            <div class="n_auc_tit">
                                                <div class="auc_bdg pub_b">공매</div>
                                                <h2>2023-00253-001</h2>
                                            </div>
                                            <p class="n_auc_loc">부산시 사하구 하단동 1176</p>
                                        </li>
                                    </ul>
                                </div>

                                
                                {{-- 최근 검색기록 없는 경우 --}}
                                {{-- <div class="input_bx" id="box">
                                    <div class="input_bx_top">
                                        <h3>최근 검색기록</h3>
                                        <button class="btn">검색기록 지우기</button>
                                    </div>
                                    <p>최근 검색 기록이 없습니다.</p>
                                </div> --}}
                            
                                {{-- 검색결과 없는경우 --}}
                                {{-- <div class="input_bx" id="box">
                                    <div class="input_bx_top">
                                        <h3>202333검색결과</h3>
                                        <button class="btn">검색기록 지우기</button>
                                    </div>
                                    <p>검색결과가 없습니다.</p>
                                </div> --}}
                            
                            </div>
                        </div>
                        
                        <script>
                            // input 클릭 시 box 보이기
                            document.getElementById('searchInput').addEventListener('click', function() {
                                document.getElementById('box').style.display = 'block';
                            });
                        
                            // document 클릭 시 box 숨기기
                            document.addEventListener('click', function(event) {
                                // 클릭된 요소가 input 또는 box인 경우 무시
                                if (!event.target.closest('.n_search') && !event.target.closest('#box')) {
                                    document.getElementById('box').style.display = 'none';
                                }
                            });
                        
                            // 초기화 버튼 클릭 시 box 숨기고 input 비우기
                            document.getElementById('resetButton').addEventListener('click', function() {
                                document.getElementById('box').style.display = 'none';
                                document.getElementById('searchInput').value = '';
                            });
                        
                            // 검색 버튼 클릭 시 여기에 검색 기능 추가
                            document.getElementById('searchButton').addEventListener('click', function() {
                                // 검색 기능 추가
                            });
                        </script>
                        
                        <div class="n_filter_w">
                            {{-- 지역 --}}
                            <div class= "n_filter_area">
                                <div class="n_filter_t">
                                    <img src="/images/auction/fail.png" alt="">
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
                                <div class="n_filter_sub">
                                    <div class="n_filter_subbox">
                                        <ul>
                                            <li>전체</li>
                                            <li>주거용 건물</li>
                                            <li>상업용 건물</li>
                                            <li>토지</li>
                                        </ul>
                                    </div>
                                    <div class="n_filter_subbox">
                                        <ul>
                                            <li>주거용 전체</li>
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
                                            <div class="range_container">
                                                <div class="form_control">
                                                    <!-- min -->
                                                    <div class="form_control_container">
                                                        <input class="form_price" type="hidden" name="fromPriceJudge"
                                                            id="fromJudge" value="" readonly="">
                                                        <input class="form_price" type="text"
                                                            name="fromPriceJudge_txt" id="fromJudge_txt" value="최소"
                                                            readonly="">
                                                    </div>
                                                    <!-- max -->
                                                    <div class="form_control_container">
                                                        <input class="form_price" type="hidden" name="toPriceJudge"
                                                            id="toJudge" value="" readonly="">
                                                        <input class="form_price" type="text" name="toPriceJudge_txt"
                                                            id="toJudge_txt" value="최대" readonly="">
                                                    </div>
                                                </div>
                                                <div class="sliders_control">
                                                    <input id="fromJudgeSlider" name="fromPriceJudgeRange" type="range"
                                                        value="0" min="0" max="12" step="1">
                                                    <input id="toJudgeSlider" name="toPriceJudgeRange" type="range"
                                                        value="12" min="0" max="12" step="1"
                                                        style="background: linear-gradient(to right, rgb(217, 217, 217) 0%, rgb(217, 217, 217) 0%, rgb(56, 95, 141) 0%, rgb(56, 95, 141) 100%, rgb(217, 217, 217) 100%, rgb(217, 217, 217) 100%); z-index: 0;">
                                                </div>
                                            </div>
                                        </li>
                                    </ul>


                                    <ul>
                                        <li class="filt_li">
                                            <label for="">감정가</label>
                                            <div class="range_container">
                                                <div class="form_control">
                                                    <!-- min -->
                                                    <div class="form_control_container">
                                                        <input class="form_price" type="text" name="fromPrice"
                                                            id="fromInputJudge" value="0" min="0"
                                                            max="100" />
                                                    </div>
                                                    <!-- max -->
                                                    <div class="form_control_container">
                                                        <input class="form_price" type="text" name="toPrice"
                                                            id="toInput" value="100" min="0"
                                                            max="100" />
                                                    </div>
                                                </div>
                                                <div class="sliders_control">
                                                    <input id="fromSlider" type="range" value="0" min="0"
                                                        max="100" step="10" />
                                                    <input id="toSlider" type="range" value="100"
                                                        min="0"max="100" step="10" />
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <script>
                                    function controlFromInput(fromSlider, fromInputJudge, toInput, controlSlider) {
                                        const [from, to] = getParsed(fromInputJudge, toInput);
                                        fillSlider(fromInputJudge, toInput, '#C6C6C6', '#385f8d', controlSlider);
                                        if (from > to) {
                                            fromSlider.value = to;
                                            fromInputJudge.value = to;
                                        } else {
                                            fromSlider.value = from;
                                        }
                                    }

                                    function controlToInput(toSlider, fromInputJudge, toInput, controlSlider) {
                                        const [from, to] = getParsed(fromInputJudge, toInput);
                                        fillSlider(fromInputJudge, toInput, '#C6C6C6', '#385f8d', controlSlider);
                                        setToggleAccessible(toInput);
                                        if (from <= to) {
                                            toSlider.value = to;
                                            toInput.value = to;
                                        } else {
                                            toInput.value = from;
                                        }
                                    }

                                    function controlFromSlider(fromSlider, toSlider, fromInputJudge) {
                                        const [from, to] = getParsed(fromSlider, toSlider);
                                        fillSlider(fromSlider, toSlider, '#C6C6C6', '#385f8d', toSlider);
                                        if (from > to) {
                                            fromSlider.value = to;
                                            fromInputJudge.value = to;
                                        } else {
                                            fromInputJudge.value = from;
                                        }
                                    }

                                    function controlToSlider(fromSlider, toSlider, toInput) {
                                        const [from, to] = getParsed(fromSlider, toSlider);
                                        fillSlider(fromSlider, toSlider, '#C6C6C6', '#385f8d', toSlider);
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
                                    const fromInputJudge = document.querySelector('#fromInputJudge');
                                    const toInput = document.querySelector('#toInput');
                                    fillSlider(fromSlider, toSlider, '#C6C6C6', '#385f8d', toSlider);
                                    setToggleAccessible(toSlider);

                                    fromSlider.oninput = () => controlFromSlider(fromSlider, toSlider, fromInputJudge);
                                    toSlider.oninput = () => controlToSlider(fromSlider, toSlider, toInput);
                                    fromInputJudge.oninput = () => controlFromInput(fromSlider, fromInputJudge, toInput, toSlider);
                                    toInput.oninput = () => controlToInput(toSlider, fromInputJudge, toInput, toSlider);
                                </script>
                            </div>

                            {{-- 물건상태 --}}
                            <div class= "n_filter_status">
                                <div class="n_filter_t">
                                    <img src="/images/auction/status.png" alt="">
                                    <p>물건상태</p>
                                </div>
                                <div class="n_filter_subbox">
                                    <ul>
                                        <li>진행중</li>
                                        <li>변경/연기</li>
                                        <li>낙찰</li>
                                        <li>기각/취하/취소</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <li class="filt_li filt_bt_wrap n_filt_bt_wrap mt20">
                            <div class="search_option_button">
                                <button type="button" id="resetButton" class="btn btn-block btn-thm btn-thm_w">초기화</button>
                            </div>
                            <div class="search_option_button">
                                <button type="button" id="searchButton" class="btn btn-block btn-thm btn-thm_w">검색하기</button>
                            </div>
                        </li>
                    </div>


                    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
                @endif
                {{-- 개발용 조건 코드 - 개발완료 후 @if, @endif 제거 --}}

                <div class="col-md-12 col-lg-12 pl0 pr0">

                    <!-- 검색결과 -->
                    <div class="row row_w">
                        <div class="grid_list_search_result search_result_w auc_serch">
                            <div class="left_area tac-xsd">
                                <p>검색결과 <span class="mont point_c">{{ number_format(@$data['totalCount']) }}</span>건</p>
                            </div>
                        </div>
                    </div>
                    <!-- 검색결과 end -->

                    <!-- 검색필터 -->
                    <!-- 경매+공매 -->
                    <span class="dropdown-el">
                        <input type="radio" name="gubun" value="" id="gubun_ab"
                            @if (@$_REQUEST['gubun'] == '') {{ __('checked="checked"') }} @endif><label
                            for="gubun_ab">경매+공매</label>
                        <input type="radio" name="gubun" value="a" id="gubun_a"
                            @if (@$_REQUEST['gubun'] == 'a') {{ __('checked="checked"') }} @endif><label
                            for="gubun_a">경매</label>
                        <input type="radio" name="gubun" value="b" id="gubun_b"
                            @if (@$_REQUEST['gubun'] == 'b') {{ __('checked="checked"') }} @endif><label
                            for="gubun_b">공매</label>
                    </span>
                    <!-- 지분필터 - 전체  -->
                    <span class="dropdown-el down_width">
                        <input type="radio" name="jibun" value="" id="jibun_all"
                            @if (@$_REQUEST['jibun'] == '') {{ __('checked="checked"') }} @endif><label
                            for="jibun_all">지분필터-전체</label>
                        <input type="radio" name="jibun" value="1" id="jibun_1"
                            @if (@$_REQUEST['jibun'] == '1') {{ __('checked="checked"') }} @endif><label
                            for="jibun_1">지분보기</label>
                        <input type="radio" name="jibun" value="0" id="jibun_0"
                            @if (@$_REQUEST['jibun'] == '0') {{ __('checked="checked"') }} @endif><label
                            for="jibun_0">지분제외</label>
                    </span>
                    <!-- 조회순 -->
                    <span class="dropdown-el down_filt">
                        <input type="radio" name="order" value="hit" id="order-hit"
                            @if (@$_REQUEST['order'] == '' || @$_REQUEST['order'] == 'hit') {{ __('checked="checked"') }} @endif><label
                            for="order-hit">조회수 많은</label>
                        <input type="radio" name="order" value="fav" id="order-fav"
                            @if (@$_REQUEST['order'] == 'fav') {{ __('checked="checked"') }} @endif><label
                            for="order-fav">관심수 많은</label>
                        <input type="radio" name="order" value="date1" id="order-date1"
                            @if (@$_REQUEST['order'] == 'date1') {{ __('checked="checked"') }} @endif><label
                            for="order-date1">매각기일 빠른</label>
                        <input type="radio" name="order" value="date2" id="order-date2"
                            @if (@$_REQUEST['order'] == 'date2') {{ __('checked="checked"') }} @endif><label
                            for="order-date2">매각기일 늦은</label>
                        <input type="radio" name="order" value="price1" id="order-price1"
                            @if (@$_REQUEST['order'] == 'price1') {{ __('checked="checked"') }} @endif><label
                            for="order-price1">최저가 높은</label>
                        <input type="radio" name="order" value="price2" id="order-price2"
                            @if (@$_REQUEST['order'] == 'price2') {{ __('checked="checked"') }} @endif><label
                            for="order-price2">최저가 낮은</label>
                    </span>

                    <script>
                        $('.dropdown-el').click(function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            $(this).toggleClass('expanded');

                            var ipName = $('#' + $(e.target).attr('for')).attr('name');
                            if ($('input[name=' + ipName + ']:checked').val() != $('#' + $(e.target).attr('for')).attr('value')) {
                                frm.page.value = 1;
                                $('#' + $(e.target).attr('for')).prop('checked', true);
                                frm.submit();
                            }

                        });
                        $(document).click(function() {
                            $('.dropdown-el').removeClass('expanded');
                        });
                    </script>

                    <!-- list -->
                    @if (@$data['totalCount'] > 0)
                        <div class="row mt80 auc_list_r">

                            @foreach ($data['items'] as $_item)
                                @php
                                    $printData = (new App\Http\Class\AuctionClass())->getPrintData($_item);
                                    debug($printData);
                                @endphp
                                @if ($printData['gubun'] == 'a')
                                    <x-item-auction :printData="$printData" />
                                @else
                                    <x-item-onbid :printData="$printData" />
                                @endif
                            @endforeach

                        </div>
                        <x-pagination type="api" :data="$data" />
                    @else
                        <div class="nodata_serch">
                            <img src="/images/nodata.png" alt="">
                            <p class="nodata_np">해당매물이 없습니다</p>
                            <p>검색어를 바르게 입력하셨는지 확인하시거나,<br>
                                다른 조건으로 검색해보세요!</p>
                            {{-- <button class="btn btn-thm_w reset_btn">매물 둘러보기</button> --}}
                        </div>
                    @endif
                    <!-- list end -->
                </div>
                <!-- 검색결과 end -->
            </div>
        </section>

    </form>
@endsection
