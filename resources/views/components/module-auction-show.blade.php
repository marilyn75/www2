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
                            <a href="https://map.kakao.com/?q={{ urlencode($data['주소2']) }}" target="_blank">
                                <img src="/images/auction/kaokaomap.png" alt="">
                            </a>
                            <a href="https://map.naver.com/?query={{ urlencode($data['주소2']) }}" target="_blank">
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
                            <p>{{ $data['진행상태'] }}</p>
                            <div class="sale_days">
                                <p class="sale_day">{{ $data['매각기일2'] }}</p>
                                @if(!empty($data['dday']))<p class="auc_bdg">{{ $data['dday'] }}</p>@endif
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
                                <p>0000년 00월 00일</p>
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
                            @foreach ($data['기일내역목록'] as $_i=>$_data)
                                @if ($_data['최저매각가격'] > 0)
                                    <li>
                                    {{-- <li @if($_i>3){!! __('class="hidden"') !!}@endif> --}}
                                        <p>{{ $_data['기일'] }}</p>
                                        <div class="fall_rst">
                                            <p>{{ price_kor($_data['최저매각가격']) }}원</p>
                                            @if ($_data['기일결과'] == '유찰')
                                                <p class="auc_bdg fall">유찰</p>
                                            @elseif ($_data['기일결과'] == '매각')
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
                    {{-- <div class="col-12 col-lg-6 auc_mob">
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
                    </div> --}}

                    <div class="col-12 col-lg-4 auc_mob">
                        <ul class="auc_pdf_down pdf_mob pdf_mob_temp">
                            <li>
                                <img src="/images/auction/auc_pdf_01.png" alt="">
                                <p>매각명세서</p>
                            </li>
                            <li>
                                <img src="/images/auction/auc_pdf_02.png" alt="">
                                <p>감정평가서</p>
                            </li>
                        </ul>
                    </div>


                    <!-- 대법원 link -->
                    {{-- <div class="col-12 col-lg-6 auc_mob">
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
                    </div> --}}

                    <div class="col-12 col-lg-8 auc_mob">
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
                                    <th class="bck_col" scope="col"></th>
                                    <th class="bck_col" scope="col">구분</th>
                                    <th class="bck_col" scope="col">소재지</th>
                                    <th class="bck_col" scope="col">용도</th>
                                    <th class="bck_col" scope="col">상세</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < count($data['소재지']); $i++)
                                    <tr>
                                        <th class="bck_wt">{{ $data['소재지'][$i]['num'] }}</th>
                                        <td class="bck_wt">{{ $data['소재지'][$i]['구분'] }}</td>
                                        <td class="bck_wt">{{ $data['소재지'][$i]['addr'] }}</td>
                                        <td class="bck_wt">{{ $data['소재지'][$i]['type'] }}</td>
                                        <td class="bck_wt">
                                            <a href="#" class="login_head modal-button" id="a-login" data-url="modal.auction">보기</a>
                                            <input type="hidden" value="{{ $data['목록내역'][$i]['상세내역html'] }}">
                                        </td>
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
                        <div class="auc_hide">
                            {!! $data['감정평가요항표요약html'] !!}
                        </div>
                        <button class="ac_more_btn mb0 auc_inf_btn" onclick="showMoreAucInf()">더보기</button>
                        <div class="cont_und_line"></div>
                    </div>

                    <!-- 건축물정보 -->
                    @if (!empty($data['건물정보']))
                        @php
                            $bdInfo = $data['건물정보'];
                        @endphp
                        <!-- 건축물정보 -->
                        <div class="col-12">
                            <div class="auc_info_tit">
                                <p>건축물정보</p>
                            </div>
                            <div class="build_table_w">
                                <table class="build_table">
                                    <!-- <colgroup>
                                        <col width="20%"><col width="30%"><col width="20%"><col width="30%">
                                        </colgroup> -->
                                    <tbody>
                                        <tr>
                                            <th class="bck_col">착공일자</th>
                                            <td class="bck_wt">{{ printDate($bdInfo['착공일자']) }}</td>
                                            <th class="bck_col">대지면적</th>
                                            <td class="bck_wt">{{ number_format($bdInfo['대지면적'], 2) }} ㎡</td>
                                        </tr>
                                        <tr>
                                            <th class="bck_col">허가일자</th>
                                            <td class="bck_wt">{{ printDate($bdInfo['허가일자']) }}</td>
                                            <th class="bck_col">건축면적</th>
                                            <td class="bck_wt">{{ number_format($bdInfo['건축면적'], 2) }} ㎡</td>
                                        </tr>
                                        <tr>
                                            <th class="bck_col">사용승인</th>
                                            <td class="bck_wt">{{ printDate($bdInfo['사용승인']) }}</ㅅ>
                                            <th class="bck_col">연면적</th>
                                            <td class="bck_wt">{{ number_format($bdInfo['연면적'], 2) }} ㎡</td>
                                        </tr>
                                        <tr>
                                            <th class="bck_col">건폐율</th>
                                            <td class="bck_wt">{{ number_format($bdInfo['건폐율'], 2) }} %</td>
                                            <th class="bck_col">용적률</th>
                                            <td class="bck_wt">{{ number_format($bdInfo['용적률'], 2) }} %</td>
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
                                @if(!empty($data['건물정보']['층별정보']))
                                <table class="hidden">
                                    <thead>
                                        <tr>
                                            <th class="bck_col" scope="col">층</th>
                                            <th class="bck_col" scope="col">구조</th>
                                            <th class="bck_col" scope="col">용도</th>
                                            <th class="bck_col" scope="col">면적</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['건물정보']['층별정보'] as $_floor)
                                        <tr>
                                            <td class="bck_wt">{{ $_floor['층구분'] }} {{ $_floor['층'] }}</td>
                                            <td class="bck_wt">{{ $_floor['주구조'] }}</td>
                                            <td class="bck_wt">{{ $_floor['주용도'] }}</td>
                                            <td class="bck_wt">{{ $_floor['면적'] }}㎡</td>
                                        </tr>    
                                        @endforeach
                                    </tbody>
                                </table>
                                @endif
                            </div>
                            @if(!empty($data['건물정보']['층별정보']))<button class="ac_more_btn mb0 build_btn" onclick="showMoreBuild()">더보기</button>@endif
                            <div class="cont_und_line"></div>
                        </div>
                    @endif


                    <!-- 권리분석 -->
                    {{-- <div class="col-12">
                        <div class="auc_info_tit flx_bg">
                            <p>권리분석</p>
                            <button class="auc_bdg">예상배당표</button>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th class="bck_col" scope="col" width="25%">말소기준</th>
                                    <th class="bck_col" scope="col" width="25%">기준금액</th>
                                    <th class="bck_col" scope="col">총 인수금액</th>
                                    <th class="bck_col" scope="col">총 인수권리</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="bck_wt">압류<br>(2020.05.18)</th>
                                    <td class="bck_wt">892만원<br>(최저가)</td>
                                    <td class="bck_wt" colspan="2">-</td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="sm_txt">
                            * 낙찰자가 인수할 최종적인 금액과 권리를 확인할 수 있습니다.
                        </p>
                        <p class="sm_txt">
                            * 위 내용은 등기부 등본 및 매각명세서 등을 바탕으로 분석되었습니다.
                        </p>
                        <div class="cont_und_line"></div>
                    </div>

                    <div class="col-12">
                        <div class="auc_btitle">
                            <p>등기</p>
                        </div>
                    </div>

                    {{-- 등기부현황 --
                    <div class="col-12">
                        <div class="auc_info_tit flx_bg">
                            <p>등기부현황</p>
                            <button class="auc_bdg">건물등기</button>
                        </div>
                        <table class="regis_table">
                            <thead>
                                <tr>
                                    <th class="bck_col" scope="col" width="25%">등기일자</th>
                                    <th class="bck_col" scope="col" width="25%">권리종류</th>
                                    <th class="bck_col" scope="col">권리자/채권액</th>
                                    <th class="bck_col" scope="col">권리</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="bck_wt" rowspan="2">2018-04-16</th>
                                    <td class="bck_wt">소유자</td>
                                    <td class="bck_wt">서옥선 (소유자)</td>
                                    <td class="bck_wt" rowspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="bck_wt">단독소유</td>
                                    <td class="bck_wt">-</td>
                                </tr>

                                <tr>
                                    <th class="bck_rd" rowspan="2">2019-09-20<br>(을4)</th>
                                    <td class="bck_rd">전세권설정</td>
                                    <td class="bck_rd">남해균</td>
                                    <td class="bck_rd" rowspan="2">인수</td>
                                </tr>
                                <tr>
                                    <td class="bck_rd">-</td>
                                    <td class="bck_rd">205,000,000</td>
                                </tr>

                                <tr>
                                    <th class="bck_bl" rowspan="2">2020-05-18<br>(갑3)</th>
                                    <td class="bck_bl">압류</td>
                                    <td class="bck_bl">서울특별시송파구</td>
                                    <td class="bck_bl" rowspan="2">소멸</td>
                                </tr>
                                <tr>
                                    <td class="bck_bl">말소기준 등기</td>
                                    <td class="bck_bl">-</td>
                                </tr>
                            </tbody>
                            <tbody class="hidden">
                                <tr>
                                    <th class="bck_wt" rowspan="2">2020-06-23<br>(갑4)</th>
                                    <td class="bck_wt">가압류</td>
                                    <td class="bck_wt">주택도시보증공사</td>
                                    <td class="bck_wt" rowspan="2">소멸</td>
                                </tr>
                                <tr>
                                    <td class="bck_wt">-</td>
                                    <td class="bck_wt">398,000,000</td>
                                </tr>

                                <tr>
                                    <th class="bck_yw" rowspan="2">2021-04-08<br>(갑5)</th>
                                    <td class="bck_yw">강제경매개시결정<br>(2021타경51574)</td>
                                    <td class="bck_yw">조기환</td>
                                    <td class="bck_yw" rowspan="2">소멸</td>
                                </tr>
                                <tr>
                                    <td class="bck_yw">경매기입 등기</td>
                                    <td class="bck_yw">190,000,000원</td>
                                </tr>

                                <tr>
                                    <th class="bck_wt" rowspan="2">2023-08-22<br>(갑6)</th>
                                    <td class="bck_wt">몰수보전</td>
                                    <td class="bck_wt">국</td>
                                    <td class="bck_wt" rowspan="2">소멸</td>
                                </tr>
                                <tr>
                                    <td class="bck_wt">-</td>
                                    <td class="bck_wt">-</td>
                                </tr>
                            </tbody>
                        </table>
                        <button class="ac_more_btn mb0 regis_btn" onclick="showMoreRegis()">더보기</button>
                        <p class="sm_txt">
                            * 신규 발급등기의 분석자료 반영에는 최대 1일까지 소요될 수 있습니다. (등기분석, 임차인분석, 분석노트 등)
                        </p>
                        <div class="cont_und_line"></div>
                    </div>

                    <!-- 인수되는 권리 또는 지상권 -->
                    <div class="col-12">
                        <div class="auc_info_tit">
                            <p>인수되는 권리 또는 지상권</p>
                        </div>
                        <div class="use_state_list">
                            <span>인수되는 권리</span>
                            <p>을구 순위번호 4번 2019년 9월 20일 접수 제 138270호 전세권설정등기는 말소되지 않고 매수인에게 인수 됨</p>
                        </div>
                        <div class="cont_und_line"></div>
                    </div> --}}

                    <div class="col-12">
                        <div class="auc_btitle">
                            <p>임차인</p>
                        </div>
                    </div>

                    <!-- 임차인현황 -->
                    <div class="col-12">
                        <div class="auc_info_tit flx_bg">
                            <p>임차인현황</p>
                            <div class="flx_bgs">
                                <button class="auc_bdg">매각명세서</button>
                                <button class="auc_bdg">소액임차표</button>
                            </div>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th class="bck_col" scope="col" width="25%">임차인</th>
                                    <th class="bck_col" scope="col" width="25%">보증금/차임</th>
                                    <th class="bck_col" scope="col">전입/확정/배당</th>
                                    <th class="bck_col" scope="col">대향력</th>
                                </tr>
                            </thead>
                            <tbody>
                            @empty($data['임차인현황목록'])
                                <tr>
                                    <td colspan="4" class="bck_wt">매각물건명세서상 임차인이 존재하지 않습니다.</td>
                                </tr>
                            @else
                                @foreach ($data['임차인현황목록'] as $_row)
                                    
                                @endforeach
                                <tr>
                                    <td class="bck_wt">
                                        {{ $_row['점유자명'] }}<br>
                                        ({{ $_row['점유의권원'] }})<br>
                                        점유부분:<br>
                                        {{ $_row['점유부분'] }}
                                    </td>
                                    <td class="bck_wt txt_lt">보증: {{ $_row['보증금'] }}<br>차임: {{ $_row['차임'] }}</td>
                                    <td class="bck_wt txt_lt">
                                        전입: {{ $_row['신고일자'] }}<br>
                                        확정: {{ $_row['확정일자'] }}<br>
                                        배당: {{ $_row['배당요구여부'] }}
                                    </td>
                                    <td class="bck_wt txt_rd">있음<br>(인수유의)</td>
                                </tr>
                            @endempty
                            </tbody>
                        </table>
                        <div class="cont_und_line"></div>
                    </div>

                    @if(!empty($data['매각물건명세']['임차인참고사항']) && str_replace("<비고>","",$data['매각물건명세']['임차인참고사항'])!="")
                    <!-- 임차인 참고사항 -->
                    <div class="col-12">
                        <div class="auc_info_tit">
                            <p>임차인 참고사항</p>
                        </div>
                        <div class="use_state_list">
                            <p>{{ str_replace("<비고>","",$data['매각물건명세']['임차인참고사항']) }}</p>
                        </div>
                        <div class="cont_und_line"></div>
                    </div>
                    @endif
                    <!-- 현황조사 -->
                    <div class="col-12">
                        <div class="auc_info_tit">
                            <p>현황조사</p>
                        </div>
                        <div class="use_state_list">
                            @if (!empty($data['현황조사내역']['기타']))
                                <p>{{ $data['현황조사내역']['기타'] }}</p>
                            @endif
                            
                            @foreach ($data['현황조사내역']['점유관계'] as $_i=>$_row)
                            <span>[목록{{ $_i+1 }}]</span>
                            <P>{{ $_row['기타'] }}</P>
                            @endforeach
                            
                        </div>
                        <div class="cont_und_line"></div>
                    </div>

                    {{-- <!-- 전입세대원 -->
                    <div class="col-12">
                        <div class="auc_info_tit">
                            <p>전입세대원</p>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th class="bck_col" scope="col" width="25%">말소기준</th>
                                    <th class="bck_col" scope="col" width="25%">기준금액</th>
                                    <th class="bck_col" scope="col">총 인수금액</th>
                                    <th class="bck_col" scope="col">총 인수관리</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="bck_wt" colspan="4">
                                        -
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="cont_und_line"></div>
                    </div> --}}

                    <div class="col-12">
                        <div class="auc_btitle">
                            <p>그외</p>
                        </div>
                    </div>

                    {{-- <div class="col-12">
                        <div class="auc_info_tit">
                            <p class="img_tit"><img src="/images/auction/other01.png" alt=""> 입찰방법&amp;제한</p>
                        </div>
                        <ul class="sale_lst bid">
                            <li>
                                <p>집행기관</p>
                                <p>다세대</p>
                            </li>
                            <li>
                                <p>전자보증서</p>
                                <p>사용불가능</p>
                            </li>
                            <li>
                                <p>차순위매수신청</p>
                                <p>신청불가능</p>
                            </li>
                            <li>
                                <p>공동입찰</p>
                                <p>공동입찰 불가능</p>
                            </li>
                            <li>
                                <p>담당자</p>
                                <p>인천지역본부/조세정리팀 1588-5321</p>
                            </li>
                            <li>
                                <p>2인 미만 유찰</p>
                                <p>1인이 입찰해도 유효함</p>
                            </li>
                            <li>
                                <p>대리입찰</p>
                                <p>대리입찰 불가능</p>
                            </li>
                            <li>
                                <p>2회 이상 입찰</p>
                                <p>동일물건 2회 이상 입찰 불가능</p>
                            </li>
                        </ul>
                        <div class="cont_und_line"></div>
                    </div> --}}

                    {{-- 납부기한 --}}
                    <div class="col-12">
                        <div class="auc_info_tit">
                            <p class="img_tit"><img src="/images/auction/other02.png" alt="">납부기한</p>
                        </div>
                        <p class="respon">30일</p>
                        <p class="sm_txt">
                            * 낙찰가격 3천만원 이상은 매각결정기일로부터 30일 이내 3천만원 미만은 매각결정일로부터 7일 이내
                        </p>
                        <div class="cont_und_line"></div>
                    </div>
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
                            // "접기" 상태에서ㄹ 다시 클릭하면 숨겨진 리스트들을 숨기고 버튼 텍스트를 "더보기"로 변경
                            hiddenElements.forEach(function(element) {
                                element.style.display = 'none';
                            });
                            btn.innerText = "더보기";
                        }
                    }

                    function showMoreAucInf() {
                        // var hiddenElements = document.querySelectorAll('.auc_info_list li.hidden');
                        var summary = document.querySelector('.auc_hide');

                        var btn = document.querySelector('.auc_inf_btn');
                        if (btn.innerText === "더보기") {
                            btn.innerText = "접기";
                            summary.style.height = 'auto';
                            summary.style.display = 'block';
                        } else {
                            btn.innerText = "더보기";
                            summary.style.height = '170px';
                        }
                    }

                    // 건축물정보 더보기
                    function showMoreBuild() {
                        var hiddenElements = document.querySelectorAll('.build_table_w table.hidden');

                        hiddenElements.forEach(function(element) {
                            element.style.display = 'inline-table';
                        });

                        var btn = document.querySelector('.build_btn');
                        if (btn.innerText === "더보기") {
                            btn.innerText = "접기";
                        } else {
                            // "접기" 상태에서ㄹ 다시 클릭하면 숨겨진 리스트들을 숨기고 버튼 텍스트를 "더보기"로 변경
                            hiddenElements.forEach(function(element) {
                                element.style.display = 'none';
                            });
                            btn.innerText = "더보기";
                        }
                    }

                    // 등기부현황 더보기
                    function showMoreRegis() {
                        var hiddenElements = document.querySelectorAll('.regis_table tbody.hidden');

                        hiddenElements.forEach(function(element) {
                            element.style.display = 'contents';
                        });

                        var btn = document.querySelector('.regis_btn');
                        if (btn.innerText === "더보기") {
                            btn.innerText = "접기";
                        } else {
                            // "접기" 상태에서ㄹ 다시 클릭하면 숨겨진 리스트들을 숨기고 버튼 텍스트를 "더보기"로 변경
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
                        {{-- <div class="sidebar_auc_content">
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
                        </div> --}}

                        <div class="sidebar_auc_content">
                            <ul class="auc_pdf_down pdf_temp">
                                <li>
                                    <div class="pdf_temp_img">
                                        <img src="/images/auction/auc_pdf_01.png" alt="">
                                    </div>
                                    <p>매각명세서</p>
                                </li>
                                <li>
                                    <div class="pdf_temp_img">
                                        <img src="/images/auction/auc_pdf_02.png" alt="">
                                    </div>
                                    <p>감정평가서</p>
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
