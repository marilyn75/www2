@extends('layout.layout')

@section('content')

<script>
    // // input 클릭 시 box 보이기
    // document.getElementById('searchSano').addEventListener('click', function() {
    //     document.getElementById('box').style.display = 'block';
    // });

    // // document 클릭 시 box 숨기기
    // document.addEventListener('click', function(event) {
    //     // 클릭된 요소가 input 또는 box인 경우 무시
    //     if (!event.target.closest('.n_search') && !event.target.closest('#box')) {
    //         document.getElementById('box').style.display = 'none';
    //     }
    // });

    // // 초기화 버튼 클릭 시 box 숨기고 input 비우기
    // document.getElementById('resetButton').addEventListener('click', function() {
    //     document.getElementById('box').style.display = 'none';
    //     document.getElementById('searchInput').value = '';
    // });

    // // 검색 버튼 클릭 시 여기에 검색 기능 추가
    // document.getElementById('searchButton').addEventListener('click', function() {
    //     // 검색 기능 추가
    // });

    $(document).on('focus', '#searchSano', function(){
        $('#searchResultBox').show();
        if(this.value=="") showHistory();
    });
    $(document).on('keyup', '#searchSano', function(){
        var str = this.value;
        console.log('press');
        if(str==""){
            $('#searchResultBox').find('h3').html("최근검색기록");
            $('#btnClearHistory').show();
            showHistory();
        }else{
            $('#btnClearHistory').hide();

            $('#searchResultBox').find('h3').html(str+" 검색결과");

            $.post("{{ env('AUCTION_API_URL') }}/api/auction/search", {
                q: str
            })
            .done(function(res){
                console.log(res);
                $('#ulSearchResult').html('');
                
                if(res.length > 0){
                    res.forEach(function(r){
                        let $li = $('<li class="serchResultItem"><div class="n_auc_tit"><div class="auc_bdg">경매</div><h2>2023타경2023[2]</h2></div><p class="n_auc_loc">부산시 연제구 연제동 123</p></li>');
                        if(r.gbn=='a'){
                            $li.find('.auc_bdg').addClass('auc_b').html('경매');
                            $li.find('h2').html(r['a_사건번호']);
                            $li.find('.n_auc_loc').html(r['a_소재지'][0]['addr_jibun']);
                            $li.attr('sano',r['a_saNo']);
                            $li.attr('no',r['a_물건번호']);
                        }else{
                            $li.find('.auc_bdg').addClass('pub_b').html('공매');
                            $li.find('h2').html(r['b_물건관리번호']);
                            $li.find('.n_auc_loc').html(r['b_물건세부정보']['지번주소']);
                            $li.attr('sano','');
                            $li.attr('no',r['b_물건관리번호']);
                        }

                        $('#ulSearchResult').append($li);
                    });
                }else{
                    $('#ulSearchResult').append('<li class="n_nodata">검색 결과가 없습니다.</li>');
                }
            });
        }
    });

    $(document).on('blur', '#searchSano', function(){
        // $('#searchResultBox').hide();
        setTimeout(function() {
            $('#searchResultBox').hide();
        }, 500); // 1000밀리초 후에 실행
    });

    $(document).on('click', '.serchResultItem', function(){
          console.log('li click -> auction view popup');
        let sano = $(this).attr('sano');
        let no = $(this).attr('no');
        let url = '{{ env('MENU_LINK_AUCTION') }}?mode=view';

        if(sano==""){
            url += '&no=' + no;
        }else{
            url += '&sano=' + sano + '&no=' + no;
        }

        saveHistory($(this)[0].outerHTML);

        window.open(url);
    });

    // 검색기록삭제버튼
    $(document).on('click', '#btnClearHistory', function(){
        removeHistory();
        showHistory();
        sbAlert('검색기록이 삭제 되었습니다.');
        return false;
    });

    // 최근 검색기록 저장
    function saveHistory(item){
        let mySearchList = getCookie('auction_search_list');
        let jsonSearchList;
        console.log(mySearchList);
        if(mySearchList==""){
            let arr = [item];
            jsonSearchList = JSON.stringify(arr);
        }else{
            let arr = JSON.parse(mySearchList);
            if (arr.indexOf(item) !== -1) {
                arr.splice(arr.indexOf(item), 1);
            }
            arr.push(item);
            jsonSearchList = JSON.stringify(arr);
        }
        
        if(!$(item).hasClass('history')) setCookie('auction_search_list', jsonSearchList, 1);

        console.log(jsonSearchList);
    }

    // 검색기록 삭제
    function removeHistory(){
        setCookie('auction_search_list', '', -1);
    }

    // 최근 검색기록 표시
    function showHistory(){
        $('#ulSearchResult').html('');
        let mySearchList = getCookie('auction_search_list');
        // console.log(mySearchList);
        if(mySearchList!=""){
            let arr = JSON.parse(mySearchList);
            // arr.forEach(function(item){
            for (let i = arr.length - 1; i >= 0; i--) {
                let item = arr[i];
                let $li = $(item).addClass('history');
                $('#ulSearchResult').append($li);
            };
        }else{
            $('#ulSearchResult').append('<li class="n_nodata">최근 검색 기록이 없습니다.</li>');
        }
    }
</script>

    <form name="frm" action="" method="post" class="col-md-12 pl0 pr0">
        @csrf
        <input type="hidden" name="page" value="1">
        <section class="our-listing pb30-991">
            <div class="container_w">
                <div class="col-md-12 pl0 pr0 mt50">
                    <div class="n_filt_top">
                        <div class="input-group mb-3 n_search">
                            <input type="text" class="form-control" id="searchSano" placeholder="사건번호 검색">
                            <button class="btn" type="button" id="button-addon2"><i class="ri-search-line"></i></button>
                            
                            {{-- 최근검색기록 & 2023검색결과 --}}
                            <div class="input_bx" id="searchResultBox" style="z-index: 10;">
                                <div class="input_bx_top">
                                    <h3>최근검색기록</h3>
                                    <button class="btn" id="btnClearHistory">검색기록 지우기</button>
                                </div>
                                <div id="resultList" class="overflow-auto" style="max-height:30vh;">
                                    <ul id="ulSearchResult">
                                    
                                    </ul>
                                </div>
                                
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
                </div>
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
                            $('#ftAddr button:eq(0)').click();

                            setCate();
                            // $('#ftCate button:eq(0)').click();

                            initInputRange();
                        });

                        function setCate(){
                            var r = doAjax('{{ route('common.ajax.getAuctionCategory') }}');
                            if (r.result) jsonCate = r.data;

                            $ul = $("<ul></ul>");

                            $ul.append('<li><button type="button" class="btn sel">전체</button></li>');
                            jsonCate.forEach(function(cate){
                                $ul.append('<li><button type="button" class="btn">' +
                                    cate.title + '</button></li>');
                            });

                            $('#ftCate div').eq(0).html($ul);
                        }

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
                                    $ul.append('<li><button type="button" class="btn sel" code="' + item.locatjumin_cd + '">' + item.locallow_nm.replace("광역시","") + ' 전체</button></li>');
                                else
                                    $ul.append('<li><button type="button" class="btn" code="' + item.locatjumin_cd + '">' + item.locallow_nm + '</button></li>');
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

                        // 용도 1차분류 선택
                        $(document).on('click', '#ftCate div:eq(0) li button', function() {
                            var idx = ($("button", $(this).closest('ul')).index(this));
                            
                            $(this).closest('ul').find('button').removeClass('sel');
                            $(this).addClass('sel');

                            if(idx>0){
                                var data = jsonCate[idx-1].children;
                                $ul = $("<ul></ul>");
                                $ul.append('<li><button type="button" class="btn sel">' + $(this).html().replace("건물","") + ' 전체</button></li>');

                                data.forEach(function(item) {
       
                                    $ul.append('<li><button type="button" class="btn">' + item.title + '</button></li>');
                                });
                                $('#ftCate div').eq(1).html($ul);
                            }else{
                                $ul = $("<ul></ul>");
                                $ul.append('<li><button type="button" class="btn sel">전체</button></li>');
                                $('#ftCate div').eq(1).html($ul);
                            }
                        });

                        // 용도 2차분류 선택
                        $(document).on('click', '#ftCate div:eq(1) li button', function() {
                            var idx = ($("button", $(this).closest('ul')).index(this));
                            
                            $(this).closest('ul').find('button').removeClass('sel');
                            $(this).addClass('sel');

                     
                        });
                    </script>
                


                    {{-- new filter --}}
               

                    <div class="col-md-12 pl0 pr0 mt50">
                        
                        
                        
                        
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
                                <div class="n_filter_sub" id="ftCate">
                                    <div class="n_filter_subbox overflow-auto">
                                        <ul>
                                            <li>전체</li>
                                            <li>주거용 건물</li>
                                            <li>상업용 건물</li>
                                            <li>토지</li>
                                        </ul>
                                    </div>
                                    <div class="n_filter_subbox overflow-auto">
                                        
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
                                        var arrRange = arrPriceRange;

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



                                    function initInputRange(){
                                        fromSlider = document.querySelector('#fromPrice1_slider');
                                        toSlider = document.querySelector('#toPrice1_slider');
                                        fromInput = document.querySelector('#fromPrice1');
                                        toInput = document.querySelector('#toPrice1');

                                        fromAreaSlider = document.querySelector('#fromPrice2_slider');
                                        toAreaSlider = document.querySelector('#toPrice2_slider');
                                        fromAreaInput = document.querySelector('#fromPrice2');
                                        toAreaInput = document.querySelector('#toPrice2');

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
                                        <li><button type="button" class="btn sel">진행중</button></li>
                                        <li><button type="button" class="btn">변경/연기</button></li>
                                        <li><button type="button" class="btn">낙찰</button></li>
                                        <li><button type="button" class="btn">기각/취하/취소</button></li>
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
