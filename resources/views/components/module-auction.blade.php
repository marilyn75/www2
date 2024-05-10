

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

        $(document).on('focus', '#searchSano', function() {
            $('#searchResultBox').show();
            if (this.value == "") showHistory();
        });
        $(document).on('keyup', '#searchSano', function() {
            var str = this.value;
            console.log('press');
            if (str == "") {
                $('#searchResultBox').find('h3').html("최근검색기록");
                $('#btnClearHistory').show();
                showHistory();
            } else {
                $('#btnClearHistory').hide();

                $('#searchResultBox').find('h3').html(str + " 검색결과");

                $.post("{{ env('AUCTION_API_URL') }}/api/auction/search", {
                        q: str
                    })
                    .done(function(res) {
                        console.log(res);
                        $('#ulSearchResult').html('');

                        if (res.length > 0) {
                            res.forEach(function(r) {
                                let $li = $(
                                    '<li class="serchResultItem"><div class="n_auc_tit"><div class="auc_bdg">경매</div><h2>2023타경2023[2]</h2></div><p class="n_auc_loc">부산시 연제구 연제동 123</p></li>'
                                    );
                                if (r.gbn == 'a') {
                                    $li.find('.auc_bdg').addClass('auc_b').html('경매');
                                    $li.find('h2').html(r['a_사건번호']);
                                    $li.find('.n_auc_loc').html(r['a_소재지'][0]['addr_jibun']);
                                    $li.attr('sano', r['a_saNo']);
                                    $li.attr('no', r['a_물건번호']);
                                } else {
                                    $li.find('.auc_bdg').addClass('pub_b').html('공매');
                                    $li.find('h2').html(r['b_물건관리번호']);
                                    $li.find('.n_auc_loc').html(r['b_물건세부정보']['지번주소']);
                                    $li.attr('sano', '');
                                    $li.attr('no', r['b_물건관리번호']);
                                }

                                $('#ulSearchResult').append($li);
                            });
                        } else {
                            $('#ulSearchResult').append('<li class="n_nodata">검색 결과가 없습니다.</li>');
                        }
                    });
            }
        });

        $(document).on('blur', '#searchSano', function() {
            // $('#searchResultBox').hide();
            setTimeout(function() {
                $('#searchResultBox').hide();
            }, 500); // 1000밀리초 후에 실행
        });

        $(document).on('click', '.serchResultItem', function() {
            console.log('li click -> auction view popup');
            let sano = $(this).attr('sano');
            let no = $(this).attr('no');
            let url = '{{ env('MENU_LINK_AUCTION') }}?mode=view';

            if (sano == "") {
                url += '&no=' + no;
            } else {
                url += '&sano=' + sano + '&no=' + no;
            }

            saveHistory($(this)[0].outerHTML);

            window.open(url);
        });

        // 검색기록삭제버튼
        $(document).on('click', '#btnClearHistory', function() {
            removeHistory();
            showHistory();
            sbAlert('검색기록이 삭제 되었습니다.');
            return false;
        });

        // 최근 검색기록 저장
        function saveHistory(item) {
            let mySearchList = getCookie('auction_search_list');
            let jsonSearchList;
            console.log(mySearchList);
            if (mySearchList == "") {
                let arr = [item];
                jsonSearchList = JSON.stringify(arr);
            } else {
                let arr = JSON.parse(mySearchList);
                if (arr.indexOf(item) !== -1) {
                    arr.splice(arr.indexOf(item), 1);
                }
                arr.push(item);
                jsonSearchList = JSON.stringify(arr);
            }

            if (!$(item).hasClass('history')) setCookie('auction_search_list', jsonSearchList, 1);

            console.log(jsonSearchList);
        }

        // 검색기록 삭제
        function removeHistory() {
            setCookie('auction_search_list', '', -1);
        }

        // 최근 검색기록 표시
        function showHistory() {
            $('#ulSearchResult').html('');
            let mySearchList = getCookie('auction_search_list');
            // console.log(mySearchList);
            if (mySearchList != "") {
                let arr = JSON.parse(mySearchList);
                // arr.forEach(function(item){
                for (let i = arr.length - 1; i >= 0; i--) {
                    let item = arr[i];
                    let $li = $(item).addClass('history');
                    $('#ulSearchResult').append($li);
                };
            } else {
                $('#ulSearchResult').append('<li class="n_nodata">최근 검색 기록이 없습니다.</li>');
            }
        }
    </script>

    <form name="frm" action="" method="post" class="col-md-12 pl0 pr0">
        @csrf
        <input type="hidden" name="page" value="1">
            <div class="">
                <div class="dn-smd dn-991">
                    <div class="n_filt_tit">
                        <h2>상세검색</h2>
                        <p>다양한 필터를 활용하여 검색해보세요</p>
                    </div>
                    <div class="col-md-12 pl0 pr0 mt20">
                        <div class="n_filt_top">
                            <div class="input-group mb-3 n_search">
                                <input type="text" class="form-control" id="searchSano" placeholder="사건번호 검색">
                                <button class="btn" type="button" id="button-addon2"><i
                                        class="ri-search-line"></i></button>

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

                    {{-- 필터 --}}
                    <x-filter-auction />

                    
                    
                </div>
                <!-- mobile filter -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="listing_sidebar dn db-991">
                            <div class="sidebar_content_details style3">
                                <!-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> -->
                                <div class="closebtn_wrap">
                                    <a class="filter_closed_btn_ac" href="#"><i class="ri-close-line"></i></a>
                                </div>
                                <div class="sidebar_listing_list style2 mobile_sytle_sidebar mb0" id="divFilterM">
                                    
                                    <x-filter-auction-m />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- mobile filter end -->


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
                            @if (@$_REQUEST['order'] == 'hit') {{ __('checked="checked"') }} @endif><label
                            for="order-hit">조회수 많은</label>
                        <input type="radio" name="order" value="fav" id="order-fav"
                            @if (@$_REQUEST['order'] == 'fav') {{ __('checked="checked"') }} @endif><label
                            for="order-fav">관심수 많은</label>
                        <input type="radio" name="order" value="date1" id="order-date1"
                            @if (@$_REQUEST['order'] == '' || @$_REQUEST['order'] == 'date1') {{ __('checked="checked"') }} @endif><label
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


    </form>
