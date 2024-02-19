@extends('layout.layout')

@section('content')


<section class="listing-title-area">
    <div class="container container_w">
        <!-- title -->
        <div class="row">
            <div class="col-12 auc_tit">
                <p class="det_inf">{{ $data['법원'] }} <span>{{ $data['사건번호'] }}[{{ $data['물건번호'] }}]</span></p>
                <div class="main_title">
                    <h3>{{ $data['주소'] }} {{ $data['print_etc'] }}</h3>
                    <p class="auc_bdg">
                        {{ $data['print_box_area'] }}
                    </p>
                </div>
                <p class="adr">{{ $data['주소2'] }}</p>
            </div>
        </div>
        <!-- img -->
        <div class="row jcsb auc_detail_row">
            <div class="row col-lg-12 col-xl-8">
                <div class="col-12 col-md-6 auc_slider">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            @empty($data['images'])
                            @else
                            @foreach ($data['images'] as $_img)
                            <div class="swiper-slide auc-slide">
                                <img src="{{ $_img['src'] }}" alt="{{ $_img['alt'] }}">
                            </div>    
                            @endforeach
                            @endempty
                        </div>
                        <!-- <div class="swiper-button-next"><i class="ri-arrow-right-s-line"></i></i></div> -->
                        <div class="swiper-button-next">
                            <p class="mont">NEXT</p>
                        </div>
                        <!-- <div class="swiper-button-prev"><i class="ri-arrow-left-s-line"></i></div> -->
                        <div class="swiper-button-prev">
                            <p class="mont">PREV</p>
                        </div>
                        <div class="swiper-pagination mont"></div>
                    </div>
                </div>
                <!-- Initialize Swiper -->
                <script>
                var swiper = new Swiper(".mySwiper", {
                    pagination: {
                        el: ".swiper-pagination",
                        type: "fraction",
                    },
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                });
                </script>
                <div class="col-12 col-md-6 map_wrap">
                    <div class="auc_info_tit map_info_tit">
                        <p>지도</p>
                    </div>
                    <div style="width:100%;height:290px;">
                        <x-kko_map :printData="$data" />
                    </div>
                    {{-- <img src="/images/auction/auction_map.png" alt=""> --}}
                    <div class="map_icon">
                        <a href="#">
                            <img src="/images/auction/kaokaomap.png" alt="">
                        </a>
                        <a href="#">
                            <img src="/images/auction/navermap.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-12">
                    <ul class="auc_price_wrap">
                        <li>
                            <p class="auc_pri_tit">감정가</p>
                            <h3 class="auc_pri_n">{{ price_kor($data['감정평가액']) }}원</h3>
                        </li>
                        <li>
                            <p class="auc_pri_tit">최저가</p>
                            <h3 class="auc_pri_n">{{ price_kor($data['최저매각가격']) }}원</h3>
                        </li>
                        <li>
                            <p class="auc_pri_tit">실거래 매매가</p>
                            <h3 class="auc_pri_n">-원</h3>
                        </li>
                        <li>
                            <p class="auc_pri_tit">실거래 전세가</p>
                            <h3 class="auc_pri_n">-원</h3>
                        </li>
                    </ul>
                </div>

                <!-- 매각진행 -->
                <div class="col-12">
                    <div class="sale_tit">
                        <p>매각진행</p>
                        <div class="sale_days">
                            <p class="sale_day">{{ $data['매각기일2'] }}</p>
                            <p class="auc_bdg">{{ $data['dday'] }}</p>
                        </div>
                    </div>
                    <div class="und_line"></div>
                    <ul class="sale_lst">
                        <li>
                            <p>용도</p>
                            <p>{{ $data['물건종류'] }}</p>
                        </li>
                        <li>
                            <p>대상</p>
                            <p>{{ $data['print_target'] }}</p>
                        </li>
                        <li>
                            <p>토지</p>
                            <p>{{ $data['토지전체면적'] }}</p>
                        </li>
                        <li>
                            <p>건물</p>
                            <p>{{ $data['건물전체면적'] }}</p>
                        </li>
                        <li>
                            <p>감정</p>
                            <p>2021년 04월 20일</p>
                        </li>
                        <li>
                            <p>보증금</p>
                            <p>{{ price_kor($data['감정평가액'] * 0.1) }}원 (10%)</p>
                        </li>
                        <li class="hidden">
                            <p>경매구분</p>
                            <p>{{ $data['경매구분'] }}</p>
                        </li>
                        <li class="hidden">
                            <p>사건번호</p>
                            <p>{{ $data['사건번호'] }}</p>
                        </li>
                        <li class="hidden">
                            <p>관할법원</p>
                            <p>{{ $data['법원'] }}</p>
                        </li>
                        <li class="hidden">
                            <p>배당요구종기일</p>
                            <p>{{ printDateKor($data['배당요구종기']) }}</p>
                        </li>
                        <li class="hidden">
                            <p>청구액</p>
                            <p>{{ number_format($data['청구금액']) }}원</p>
                        </li>
                        @foreach ($data['사건내역'][0]['당사자내역'] as $_data)
                        <li class="hidden">
                            <p>{{ $_data['당사자구분'] }}</p>
                            <p>{{ $_data['당사자명'] }}</p>
                        </li>
                        @endforeach
                    </ul>
                    <button class="ac_more_btn" onclick="showMore()">더보기</button>
                </div>


                <!-- 유찰내역 -->
                <div class="col-12">
                    <div class="sale_tit">
                        <p>{{ $data['해시태그'] }}</p>
                    </div>
                    <div class="und_line"></div>
                    <ul class="fall_lst">
                    @foreach ($data['기일내역'] as $_data)
                        @if($_data['최저매각가격'] > 0)
                        <li>
                            <p>{{ $_data['기일'] }}</p>
                            <div class="fall_rst">
                                <p>{{ price_kor($_data['최저매각가격']) }}원</p>
                                @if($_data['기일결과']=="유찰")
                                <p class="auc_bdg fall">유찰</p>
                                @elseif ($_data['기일결과']=="매각")
                                <p class="auc_bdg sale">매각</p>
                                @else
                                <p class="auc_bdg ing">진행</p>
                                @endif
                            </div>
                        </li>
                        @endif
                    @endforeach
                        {{-- <li>
                            <p>2024. 02. 19</p>
                            <div class="fall_rst">
                                <p>892만 3000원</p>
                                <p class="auc_bdg ing">진행</p>
                            </div>
                        </li>
                        <li>
                            <p>2023. 12. 01</p>
                            <div class="fall_rst">
                                <p>1115만 4000원</p>
                                <p class="auc_bdg fall">유찰</p>
                            </div>
                        </li>
                        <li>
                            <p>2023. 04. 24</p>
                            <div class="fall_rst">
                                <p>2750만원</p>
                                <p class="auc_bdg sale">매각</p>
                            </div>
                        </li>
                        <li class="hidden">
                            <p>2023. 03. 20</p>
                            <div class="fall_rst">
                                <p>3403만 7000원</p>
                                <p class="auc_bdg fall">유찰</p>
                            </div>
                        </li>
                        <li class="hidden">
                            <p>2023. 02. 13</p>
                            <div class="fall_rst">
                                <p>4254만 6000원</p>
                                <p class="auc_bdg fall">유찰</p>
                            </div>
                        </li>
                        <li class="hidden">
                            <p>2022. 12. 12</p>
                            <div class="fall_rst">
                                <p>5318만 3000원</p>
                                <p class="auc_bdg fall">유찰</p>
                            </div>
                        </li> --}}
                    </ul>
                    <button class="ac_more_btn fall_btn" onclick="showMoreFall()">더보기</button>
                </div>


                {{-- side filter mobile --}}
                <!-- pdf -->
                <div class="col-12 col-lg-6 auc_mob">
                    <ul class="auc_pdf_down pdf_mob">
                        <li>
                            <img src="/images/auction/auc_pdf_01.png" alt="">
                            <p>매각명세서</p>
                        </li>
                        <li>
                            <img src="/images/auction/auc_pdf_02.png" alt="">
                            <p>감정평가서</p>
                        </li>
                        <li>
                            <img src="/images/auction/auc_pdf_03.png" alt="">
                            <p>건물등기</p>
                        </li>
                        <li>
                            <img src="/images/auction/auc_pdf_04.png" alt="">
                            <p>토지등기</p>
                        </li>
                        <li>
                            <img src="/images/auction/auc_pdf_05.png" alt="">
                            <p>예상배당표</p>
                        </li>
                        <li>
                            <img src="/images/auction/auc_pdf_06.png" alt="">
                            <p>전입세대원</p>
                        </li>
                        <li>
                            <img src="/images/auction/auc_pdf_07.png" alt="">
                            <p>건축물대장</p>
                        </li>
                        <li>
                            <img src="/images/auction/auc_pdf_08.png" alt="">
                            <p>토지등기</p>
                        </li>
                    </ul>
                </div>
                <!-- 대법원 link -->
                <div class="col-12 col-lg-6 auc_mob">
                    <div class="sidebar_auc_content auc_link link_mob">
                        <a href="#">
                            <p><span>대법원</span>물건상세</p>
                            <i class="ri-arrow-right-s-line"></i>
                        </a>
                        <a href="#">
                            <p><span>대법원</span>현황조사</p>
                            <i class="ri-arrow-right-s-line"></i>
                        </a>
                        <a href="#">
                            <p><span>대법원</span>송달내역</p>
                            <i class="ri-arrow-right-s-line"></i>
                        </a>
                        <a href="#">
                            <p><span>대법원</span>사건내역</p>
                            <i class="ri-arrow-right-s-line"></i>
                        </a>
                        <a href="#">
                            <p><span>대법원</span>기일내역</p>
                            <i class="ri-arrow-right-s-line"></i>
                        </a>
                    </div>
                </div>

                @if (!empty($data['물건비고html']))
                <!-- 공고내용 -->
                <div class="col-12">
                    <div class="auc_info_tit">
                        <p>공고내용</p>
                    </div>
                    <div>{!! $data['물건비고html'] !!}</div>
                    {{-- <ul class="auc_info_list">
                        <li>
                            <div class="auc_inf_order">
                                <span>1.</span>
                                <p> 재매각임. 매수신청보증금 20%</p>
                            </div>
                        </li>
                        <li>
                            <div class="auc_inf_order">
                                <span>2.</span>
                                <p> 건축물대장상 용도는 제2종근린생활시설(사무소)이나 현황 주거용으로 무단 용도 변경되어 있고, 위반건축물로 등재되어 있음.</p>
                            </div>
                        </li>
                    </ul> --}}
                    <div class="cont_und_line"></div>
                </div>
                @endif


                <div class="col-12">
                    <div class="auc_btitle">
                        <p>부동산</p>
                    </div>
                </div>

                <!-- 매각목록 -->
                <div class="col-12">
                    <div class="auc_info_tit">
                        <p>매각목록</p>
                    </div>
                    <ul class="auc_width_wrap">
                        <li>
                            <p class="auc_wid_tit">토지</p>
                            <h3 class="auc_wid_n">{{ $data['토지전체면적'] }}</h3>
                        </li>
                        <li>
                            <p class="auc_wid_tit">건물</p>
                            <h3 class="auc_wid_n">{{ $data['건물전체면적'] }}</h3>
                        </li>
                    </ul>
                    <table>
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">구분</th>
                                <th scope="col">소재지</th>
                                <th scope="col">용도</th>
                                <th scope="col">상세</th>
                            </tr>
                        </thead>
                        <tbody>
                        @for ($i=0;$i<count($data['소재지']);$i++)
                            
                        
                            <tr>
                                <th class="bck_col">{{ $data['소재지'][$i]['num'] }}</th>
                                <td class="bck_col">{{ $data['소재지'][$i]['구분'] }}</td>
                                <td class="bck_col">{{ $data['소재지'][$i]['addr'] }}</td>
                                <td class="bck_col">{{ $data['소재지'][$i]['type'] }}</td>
                                <td class="bck_col"><a href="#" class="login_head modal-button" id="a-login" data-url="modal.auction">보기</a></td>
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                    <div class="cont_und_line"></div>
                </div>

                <!-- 감정평가 -->
                <div class="col-12">
                    <div class="auc_info_tit">
                        <p>감정평가</p>
                    </div>
                    <div>
                        {!! $data['감정평가요항표요약html'] !!}
                    </div>
                    {{-- <ul class="auc_info_list">
                        <li>
                            <div class="auc_inf_order">
                                <span>1.</span>
                                <p> 구분건물감정평가요항표</p>
                            </div>
                        </li>
                        <li>
                            <div class="auc_inf_order">
                                <span>1 )</span>
                                <p> 위치 및 주의환경</p>
                            </div>
                            <p> 본건은 서울특별시 송파구 문정동 소재 "문정고등학교" 남측 인근에 위치하고, 부근은 공동주택, 단독주택, 근린생활시설, 학교 등이 혼재하는
                                지대로서 주위환경은 보통임.</p>
                        </li>
                        <li class="hidden">
                            <div class="auc_inf_order">
                                <span>2 )</span>
                                <p> 교통상황</p>
                            </div>
                            <p> 본건까지 차량출입이 가능하고, 인근에 버스정류장 및 근거리에 지하철8호선(문정역, 장지역)이 소재하는 등 대중교통여건은 보통임.</p>
                        </li>
                        <li class="hidden">
                            <div class="auc_inf_order">
                                <span>3 )</span>
                                <p> 건물의 구조</p>
                            </div>
                            <p> 철근콘크리트구조 평스라브지붕 7층 건물 내 2층 202호로서,외벽: 치장벽돌 및 일부 석재붙임 마감 등.내벽: 벽지 및 일부 타일붙임 마감
                                등.창호: 샷시창임.</p>
                        </li>
                    </ul> --}}
                    <button class="ac_more_btn mb0 auc_inf_btn" onclick="showMoreAucInf()">더보기</button>
                    <div class="cont_und_line"></div>
                </div>

                @if(!empty($data['건물정보']))
                @php
                    $bdInfo = $data['건물정보'];
                @endphp
                <!-- 건축물정보 -->
                <div class="col-12">
                    <div class="auc_info_tit">
                        <p>건축물정보</p>
                    </div>
                    <table class="build_table">
                        <!-- <colgroup>
                    <col width="20%"><col width="30%"><col width="20%"><col width="30%">
                    </colgroup> -->
                        <tbody>
                            <tr>
                                <th class="bck_col">착공일자</th>
                                <td class="bck_wt">{{ printDate($bdInfo['착공일자']) }}</td>
                                <th class="bck_col">대지면적</th>
                                <td class="bck_wt">{{ number_format($bdInfo['대지면적'],2) }} ㎡</td>
                            </tr>
                            <tr>
                                <th class="bck_col">허가일자</th>
                                <td class="bck_wt">{{ printDate($bdInfo['허가일자']) }}</td>
                                <th class="bck_col">건축면적</th>
                                <td class="bck_wt">{{ number_format($bdInfo['건축면적'],2) }} ㎡</td>
                            </tr>
                            <tr>
                                <th class="bck_col">사용승인</th>
                                <td class="bck_wt">{{ printDate($bdInfo['사용승인']) }}</ㅅ>
                                <th class="bck_col">연면적</th>
                                <td class="bck_wt">{{ number_format($bdInfo['연면적'],2) }} ㎡</td>
                            </tr>
                            <tr>
                                <th class="bck_col">건폐율</th>
                                <td class="bck_wt">{{ number_format($bdInfo['건폐율'],2) }} %</td>
                                <th class="bck_col">용적률</th>
                                <td class="bck_wt">{{ number_format($bdInfo['용적률'],2) }} %</td>
                            </tr>
                            <tr>
                                <th class="bck_col">승강기</th>
                                <td class="bck_wt"> 
                                    · 승용 - {{ $bdInfo['승용승강기수'] }}대<br>
                                    · 비상용 - {{ $bdInfo['비상용승강기수'] }}대
                                </td>
                                <th class="bck_col">지하 / 지상</th>
                                <td class="bck_wt">{{ $bdInfo['지하층수'] }}층 / {{ $bdInfo['지상층수'] }}층</td>
                            </tr>
                            <tr>
                                <th class="bck_col">주차장</th>
                                <td colspan="3" class="bck_wt"> 
                                    · 옥내기계식 - {{ $bdInfo['옥내기계식대수'] }}대<br> 
                                    · 옥외기계식 - {{ $bdInfo['옥외기계식대수'] }}대<br>
                                    · 옥내자주식 - {{ $bdInfo['옥내자주식대수'] }}대<br> 
                                    · 옥외자주식 - {{ $bdInfo['옥외자주식대수'] }}대<br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @endif
            </div>

            <script>
            function applyStyleToFallItems() {
                var elements = document.querySelectorAll('.fall_lst li');

                elements.forEach(function(element) {
                    var auctionStatusElement = element.querySelector('.auc_bdg');
                    var auctionStatus = auctionStatusElement ? auctionStatusElement.innerText.trim()
                        .toLowerCase() : '';

                    console.log(auctionStatus); // 디버깅 메시지
                    if (auctionStatus === 'fall') {
                        var priceElement = element.querySelector('.fall_rst p:first-child');
                        priceElement.style.cssText = 'font-size: 25px;'; // 
                    }

                });
            }

            // 호출하여 모든 아이템에 스타일을 적용
            applyStyleToFallItems();


            function showMore() {
                var hiddenElements = document.querySelectorAll('.sale_lst li.hidden');

                hiddenElements.forEach(function(element) {
                    element.style.display = 'flex';
                });

                var btn = document.querySelector('.ac_more_btn');
                if (btn.innerText === "더보기") {
                    btn.innerText = "접기";
                } else {
                    // "접기" 상태에서 다시 클릭하면 숨겨진 리스트들을 숨기고 버튼 텍스트를 "더보기"로 변경
                    hiddenElements.forEach(function(element) {
                        element.style.display = 'none';
                    });
                    btn.innerText = "더보기";
                }
            }

            function showMoreFall() {
                var hiddenElements = document.querySelectorAll('.fall_lst li.hidden');

                hiddenElements.forEach(function(element) {
                    element.style.display = 'flex';
                });

                var btn = document.querySelector('.fall_btn');
                if (btn.innerText === "더보기") {
                    btn.innerText = "접기";
                } else {
                    // "접기" 상태에서 다시 클릭하면 숨겨진 리스트들을 숨기고 버튼 텍스트를 "더보기"로 변경
                    hiddenElements.forEach(function(element) {
                        element.style.display = 'none';
                    });
                    btn.innerText = "더보기";
                }
            }

            function showMoreAucInf() {
                var hiddenElements = document.querySelectorAll('.auc_info_list li.hidden');

                hiddenElements.forEach(function(element) {
                    element.style.display = 'block';
                });

                var btn = document.querySelector('.auc_inf_btn');
                if (btn.innerText === "더보기") {
                    btn.innerText = "접기";
                } else {
                    // "접기" 상태에서 다시 클릭하면 숨겨진 리스트들을 숨기고 버튼 텍스트를 "더보기"로 변경
                    hiddenElements.forEach(function(element) {
                        element.style.display = 'none';
                    });
                    btn.innerText = "더보기";
                }
            }
            </script>



            <div class="contact_bar">
                <div class="contact_bx">
                    <!-- 상단버튼 -->
                    <div class="sidebar_auc_content auc_side_btns">
                        <button id="fontSizeButton" onclick="toggleFontSize()"><i class="ri-text"></i><span
                                id="fontSizeButtonText">글자크게</span></button>
                        <button><i class="ri-heart-3-line"></i>보관하기</button>
                        <button onclick="printPage()"><i class="ri-printer-line"></i>인쇄하기</button>
                    </div>


                    <script>
                    var fontSizeIncreased = false;

                    // 현재 폰트 크기를 픽셀로 변환하는 함수
                    function getFontSizeInPixels(element) {
                        var fontSize = window.getComputedStyle(element, null).getPropertyValue('font-size');
                        if (fontSize.includes('px')) {
                            return parseFloat(fontSize);
                        } else {
                            // 다른 단위가 있는 경우에 대한 처리 (em, rem 등)
                            // 단순하게 16px 기준으로 가정하고 계산합니다
                            return parseFloat(fontSize) * 16;
                        }
                    }

                    function toggleFontSize() {
                        var fontSizeButton = document.getElementById('fontSizeButton');
                        var fontSizeButtonText = document.getElementById('fontSizeButtonText');

                        // 페이지 내의 모든 요소에 대해 폰트 크기를 조절
                        var elements = document.querySelectorAll('*');
                        elements.forEach(function(element) {
                            var currentFontSize = getFontSizeInPixels(element);

                            if (!fontSizeIncreased) {
                                // 크게 버튼 클릭 시
                                var newFontSize = (currentFontSize + 2) + 'px';
                                element.style.fontSize = newFontSize;
                            } else {
                                // 작게 버튼 클릭 시
                                var newFontSize = (currentFontSize > 2) ? (currentFontSize - 2) + 'px' :
                                    currentFontSize + 'px';
                                element.style.fontSize = newFontSize;
                            }
                        });

                        // 토글 상태 변경
                        fontSizeIncreased = !fontSizeIncreased;

                        // 버튼 텍스트 변경
                        fontSizeButtonText.innerText = fontSizeIncreased ? '글자작게' : '글자크게';
                    }

                        // 인쇄
                        function printPage() {
                            window.print();
                        }
                    </script>


                    <!-- pdf -->
                    <div class="sidebar_auc_content">
                        <ul class="auc_pdf_down">
                            <li>
                                <img src="/images/auction/auc_pdf_01.png" alt="">
                                <p>매각명세서</p>
                            </li>
                            <li>
                                <img src="/images/auction/auc_pdf_02.png" alt="">
                                <p>감정평가서</p>
                            </li>
                            <li>
                                <img src="/images/auction/auc_pdf_03.png" alt="">
                                <p>건물등기</p>
                            </li>
                            <li>
                                <img src="/images/auction/auc_pdf_04.png" alt="">
                                <p>토지등기</p>
                            </li>
                            <li>
                                <img src="/images/auction/auc_pdf_05.png" alt="">
                                <p>예상배당표</p>
                            </li>
                            <li>
                                <img src="/images/auction/auc_pdf_06.png" alt="">
                                <p>전입세대원</p>
                            </li>
                            <li>
                                <img src="/images/auction/auc_pdf_07.png" alt="">
                                <p>건축물대장</p>
                            </li>
                            <li>
                                <img src="/images/auction/auc_pdf_08.png" alt="">
                                <p>토지등기</p>
                            </li>
                        </ul>
                    </div>

                    <!-- 대법원 -->
                    <div class="sidebar_auc_content auc_link">
                        <a href="#">
                            <p><span>대법원</span>물건상세</p>
                            <i class="ri-arrow-right-s-line"></i>
                        </a>
                        <a href="#">
                            <p><span>대법원</span>현황조사</p>
                            <i class="ri-arrow-right-s-line"></i>
                        </a>
                        <a href="#">
                            <p><span>대법원</span>송달내역</p>
                            <i class="ri-arrow-right-s-line"></i>
                        </a>
                        <a href="#">
                            <p><span>대법원</span>사건내역</p>
                            <i class="ri-arrow-right-s-line"></i>
                        </a>
                        <a href="#">
                            <p><span>대법원</span>기일내역</p>
                            <i class="ri-arrow-right-s-line"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection