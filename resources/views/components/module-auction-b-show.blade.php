@extends('layout.layout')

@section('content')
<section class="listing-title-area">
    <div class="container container_w">
        <!-- title -->
        <div class="row">
            <div class="col-12 auc_tit">
                <p class="det_inf">{{ $data['물건관리번호'] }} <span>[{{ $data['처분방식'] }}] {{ $data['자산구분'] }}</span></p>
                <div class="main_title">
                    <h3>{{ $data['물건명'] }}</h3>
                    <p class="auc_bdg">{{ $data['print_box_area'] }}</p>
                </div>
                <p class="adr">{{ $data['addr_jibun'] }}</p>
            </div>
        </div>
        <!-- img -->
        <div class="row jcsb auc_detail_row">
            <div class="row col-lg-12 col-xl-8">
                <div class="col-12 col-sm-6 auc_slider">
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
                <div class="col-12 col-sm-6 col-xl-6 map_wrap">
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
                            <h3 class="auc_pri_n">{{ price_kor($data['감정평가금액']) }}원</h3>
                        </li>
                        <li>
                            <p class="auc_pri_tit">최저가</p>
                            <h3 class="auc_pri_n">{{ price_kor($data['최저가']) }}원</h3>
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
                            <p class="auc_bdg">{{ $data['dday'] }}</p>
                        </div>
                    </div>
                    <div class="und_line"></div>
                    <ul class="sale_lst">
                        <li>
                            <p>용도</p>
                            <p>{{ $data['용도'] }}</p>
                        </li>
                        <li>
                            <p>대상</p>
                            <p>{{ $data['print_target'] }}</p>
                        </li>
                        <li>
                            <p>토지</p>
                            <p>{{ number_format($data['면적']['토지'],2) }}㎡ ({{ number_format(@$data['면적']['토지p'],2) }}평)</p>
                        </li>
                        <li>
                            <p>건물</p>
                            <p>{{ number_format($data['면적']['건물'],2) }}㎡ ({{ number_format(@$data['면적']['건물p'],2) }}평)</p>
                        </li>
                        <li>
                            <p>감정</p>
                            <p>{{ $data['감정평가일'] }}</p>
                        </li>
                        <li>
                            <p>보증금</p>
                            <p>-</p>
                        </li>
                        <li class="hidden">
                            <p>처분방식</p>
                            <p>{{ $data['처분방식'] }}</p>
                        </li>
                        <li class="hidden">
                            <p>자산구분</p>
                            <p>{{ $data['자산구분'] }}</p>
                        </li>
                        <li class="hidden">
                            <p>입찰방식</p>
                            <p>{{ $data['입찰방식'] }}</p>
                        </li>
                        <li class="hidden">
                            <p>입찰방법</p>
                            <p>인터넷</p>
                        </li>
                        <li class="hidden">
                            <p>입찰시작</p>
                            <p>{{ printDateKor($data['입찰시작일시']) }}</p>
                        </li>
                        <li class="hidden">
                            <p>입찰마감</p>
                            <p>{{ printDateKor($data['입찰종료일시']) }}</p>
                        </li>
                        <li class="hidden">
                            <p>집행</p>
                            <p>{{ $data['집행기관'] }}</p>
                        </li>
                        <li class="hidden">
                            <p>담당자</p>
                            <p>{{ $data['담당자정보'][0].' / '.$data['담당자정보'][1] }}</p>
                        </li>
                        <li class="hidden">
                            <p>연락처</p>
                            <p>{{ $data['담당자정보'][2] }}</p>
                        </li>
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
                    @foreach ($data['입찰이력목록'] as $_i=>$_row)
                        <li @if($_i>2){!! __('class="hidden"') !!}@endif>
                            <p>
                                회차 {{ $_row['회차'] }}/차수 {{ $_row['차수'] }}<br>
                                {{ $_row['입찰시작일시'] }}
                                ~
                                {{ $_row['입찰종료일시'] }}
                            </p>
                            <div class="fall_rst">
                                <p>
                                    개찰 {{ $_row['개찰일시'] }}<br>
                                    {{ price_kor($_row['최저입찰가']) }}원
                                </p>
                                <p class="auc_bdg {{ $_row['class'] }}">{{ $_row['입찰결과'] }}</p>
                            </div>
                        </li>
                    @endforeach
                        
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

                <div class="col-12">
                    <div class="auc_btitle">
                        <p>부동산</p>
                    </div>
                </div>

                <!-- 면적목록 -->
                <div class="col-12">
                    <div class="auc_info_tit">
                        <p>면적목록</p>
                    </div>
                    <ul class="auc_width_wrap">
                        <li>
                            <p class="auc_wid_tit">토지</p>
                            <h3 class="auc_wid_n">{{ number_format($data['면적']['토지'],2) }}㎡ ({{ number_format(@$data['면적']['토지p'],2) }}평)</h3>
                        </li>
                        <li>
                            <p class="auc_wid_tit">건물</p>
                            <h3 class="auc_wid_n">{{ number_format($data['면적']['건물'],2) }}㎡ ({{ number_format(@$data['면적']['건물p'],2) }}평)</h3>
                        </li>
                    </ul>
                    <table>
                        <thead>
                            <tr>
                                <th class="bck_col" scope="col" width="10%">번호</th>
                                <th class="bck_col" scope="col" width="20%">종별</th>
                                <th class="bck_col" scope="col" width="20%">면적</th>
                                <th class="bck_col" scope="col" width="20%">지분</th>
                                <th class="bck_col" scope="col">비고</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data['물건세부정보']['면적정보'] as $_row)
                            <tr>
                                <th class="bck_wt">{{ $_row['번호'] }}</th>
                                <td class="bck_wt">{{ $_row['종별'] }} / {{ $_row['지목'] }}</td>
                                <td class="bck_wt">{{ number_format($_row['면적'],2) }}㎡</td>
                                <td class="bck_wt">{{ $_row['지분'] }}</td>
                                <td class="bck_wt">{{ $_row['비고'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="cont_und_line"></div>
                </div>

                <!-- 이용현황 -->
                <div class="col-12">
                    <div class="auc_info_tit">
                        <p>이용현황</p>
                    </div>
                    <ul class="auc_use_state">
                        <li>
                            <div class="use_state_list">
                                <span>위치 및 부근현황</span>
                                <p>{{ $data['물건세부정보']['위치부근현황'] }}</p>
                            </div>
                        </li>
                        <li>
                            <div class="use_state_list">
                                <span>이용현황</span>
                                <p>{{ $data['물건세부정보']['이용현황'] }}</p>
                            </div>
                        </li>
                        <li>
                            <div class="use_state_list">
                                <span>기타사항</span>
                                <p>{{ $data['물건세부정보']['기타사항'] }}</p>
                            </div>
                        </li>
                    </ul>
                    <div class="cont_und_line"></div>
                </div>

                <!-- 명도책임 -->
                <div class="col-12">
                    <div class="auc_info_tit">
                        <p>명도책임</p>
                    </div>
                    <p class="respon">{{ $data['물건세부정보']['명도책임'] }}</p>
                    <div class="cont_und_line"></div>
                </div>

                @if(count($data['물건세부정보']['면적정보'])==1 && $data['물건세부정보']['면적정보'][0]['종별']=="토지" && !empty($data['토지정보']))
                <!-- 토지정보&이용계획 -->
                <div class="col-12">
                    <div class="auc_info_tit flx_bg">
                        <p>토지정보</p>
                        <button class="auc_bdg">토지이음</button>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th class="bck_col" scope="col" width="30%">지목</th>
                                <th class="bck_col" scope="col" width="30%">면적</th>
                                <th class="bck_col" scope="col" width="40%">공시지가(㎡당)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="bck_wt">{{ $data['물건세부정보']['면적정보'][0]['지목'] }}</th>
                                <td class="bck_wt">{{ number_format($data['물건세부정보']['면적정보'][0]['면적'],2) }}㎡</td>
                                <td class="bck_wt">{{ number_format($data['토지정보']['공시지가']) }}원 ({{ $data['토지정보']['공시년월'] }})</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="cont_und_line"></div>
                </div>
                @endif

                @if(!empty($data['토지이용계획']))
                <div class="col-12">
                    <div class="auc_info_tit">
                        <p>이용계획</p>
                    </div>
                    <div class="use_plan">
                    @foreach($data['토지이용계획'] as $_dt)
                        <p class="auc_bdg">{{ $_dt }}</p>
                    @endforeach
                    </div>
                    <div class="cont_und_line"></div>
                </div>
                @endif

                <!-- 감정평가 -->
                <div class="col-12">
                    <div class="auc_info_tit">
                        <p>감정평가</p>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th class="bck_col" scope="col" width="10%"></th>
                                <th class="bck_col" scope="col" width="30%">감정평가기관</th>
                                <th class="bck_col" scope="col" width="30%">평가일</th>
                                <th class="bck_col" scope="col" width="30%">평가금액</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data['물건세부정보']['감정평가정보'] as $_i=>$_row)
                            <tr>
                                <th class="bck_wt">{{ $_i + 1 }}</th>
                                <th class="bck_wt">{{ $_row['감정평가기관'] }}</th>
                                <td class="bck_wt">{{ $_row['평가일'] }}</td>
                                <td class="bck_wt">{{ number_format($_row['평가금액']) }}원</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="cont_und_line"></div>
                </div>

                <div class="col-12">
                    <div class="auc_btitle">
                        <p>등기</p>
                    </div>
                </div>

                <!-- 등기부현황 -->
                <div class="col-12">
                    <div class="auc_info_tit">
                        <p>등기부현황</p>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th class="bck_col" scope="col" width="20%">설정일자</th>
                                <th class="bck_col" scope="col">권리종류</th>
                                <th class="bck_col" scope="col">권리자/설정금액</th>
                                <th class="bck_col" scope="col" width="15%">권리</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data['압류재산정보']['등기부현황'] as $_row)
                            <tr>
                                <th class="bck_wt" rowspan="2">{{ $_row['설정일자'] }}</th>
                                <th class="bck_wt">{{ $_row['권리종류'] }}</th>
                                <td class="bck_wt">{{ $_row['권리자명'] }}</td>
                                <td class="bck_wt" rowspan="2">-</td>
                            </tr>
                            <tr>
                                <th class="bck_wt">-</th>
                                <td class="bck_wt">@if($_row['설정금액']>0){{ number_format($_row['설정금액']) }}원@else{{ __("-") }}@endif</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <p class="sm_txt">* 본 정보는 공사에 공매의뢰된 시점의 정보로 현행 등기사항증명서과 다를 수 있으며, 일부 정보의 표시가 누락, 오기될 수 있습니다. 따라서 본
                        정보는 참고용 자료로만 활용하시고 정확한 정보 확인을 위해서는 반드시 등기사항증명서와 관련 공부를 확인하시기 바랍니다.</p>
                    <div class="cont_und_line"></div>
                </div>

                <div class="col-12">
                    <div class="auc_btitle">
                        <p>임차인</p>
                    </div>
                </div>

                <!-- 임차인현황 -->
                <div class="col-12">
                    <div class="auc_info_tit">
                        <p>임차인현황</p>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th class="bck_col" scope="col" width="20%">임차인</th>
                                <th class="bck_col" scope="col">보증금/차임</th>
                                <th class="bck_col" scope="col">전입/확정</th>
                                <th class="bck_col" scope="col" width="15%">대향/소멸</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if (count($data['압류재산정보']['임대차정보'])>0)
                        @foreach ($data['압류재산정보']['임대차정보'] as $_row)
                            <tr>
                                <td rowspan="2">[{{ $_row['임대차내용'] }}]<br>{{ $_row['성명'] }}</td>
                                <td>보증금 : {{ $_row['보증금']>0 ? number_format($_row['보증금']).'원':'-' }}</td>
                                <td>전입 : {{ empty($_row['전입일']) ? '-':$_row['전입일'] }}</td>
                                <td rowspan="2">-</td>
                            </tr>
                            <tr>
                                <td>차임 : {{ $_row['차임']>0 ? number_format($_row['차임']).'원':'-' }}</td>
                                <td>확정 : {{ empty($_row['확정일']) ? '-':$_row['확정일'] }}</td>
                            </tr>
                        @endforeach
                        @else
                            <tr>
                                <th class="bck_wt" colspan="4">조회된 데이터가 없습니다.</th>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    <div class="cont_und_line"></div>
                </div>

                {{-- 주요 유의사항 --}}
                <div class="col-12">
                    <div class="auc_info_tit">
                        <p>주요 유의사항</p>
                    </div>
                    <ul class="auc_use_state">
                        <li>
                            <div class="use_state_list">
                                <span>등기된 권리 또는 가처분으로서 매각으로 효력을 잃지 아니하는 것</span>
                                <p style="white-space:pre-line;">{{ empty($data['유의사항'][0]) ? '-':$data['유의사항'][0] }}</p>
                            </div>
                        </li>
                        <li>
                            <div class="use_state_list">
                                <span>매수인으로서 일정한 자격을 필요로 하는 경우 그 사실</span>
                                <p style="white-space:pre-line;">{{ empty($data['유의사항'][1]) ? '-':$data['유의사항'][1] }}</p>
                            </div>
                        </li>
                        <li>
                            <div class="use_state_list">
                                <span>유의사항</span>
                                <p style="white-space:pre-line;">{!! empty($data['유의사항'][2]) ? '-':$data['유의사항'][2] !!}</p>
                            </div>
                        </li>
                    </ul>
                    <p class="sm_txt">* 임대차정보는 감정서상 표시내용 또는 신고된 임대차 내용으로서 누락, 추가, 변동 될 수 있으니 참고 자료로만 활용하여야 하며, 이에 따른 모든 책임은 입찰자에게 있습니다. 임차인의 배분요구 여부는 입찰시작 7일전부터 제공하는 공매재산명세서를 통하여 확인하시기 바랍니다.</p>
                    <div class="cont_und_line"></div>
                </div>

                <div class="col-12">
                    <div class="auc_btitle">
                        <p>배분요구</p>
                    </div>
                </div>

                <!-- 배분요구&채권신고 -->
                <div class="col-12">
                    <div class="auc_info_tit">
                        <p>배분요구&채권신고</p>
                    </div>
                    <table>
                        <thead>
                            <p>[총 {{ count($data['압류재산정보']['배분요구채권신고현황']) }}건]</p>
                            <tr>
                                <th class="bck_col" scope="col" width="20%">설정일자</th>
                                <th class="bck_col" scope="col" width="20%">권리종류</th>
                                <th class="bck_col" scope="col" width="35%">권리자/설정금액</th>
                                <th class="bck_col" scope="col" width="25%">배분요구일/배분요구채권액</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(count($data['압류재산정보']['배분요구채권신고현황']) > 0)
                            @foreach ($data['압류재산정보']['배분요구채권신고현황'] as $_row)
                            <tr>
                                <td class="bck_wt" rowspan="2">{{ !empty($_row['설정일자']) ? $_row['설정일자'] : '-' }}</td>
                                <td class="bck_wt" rowspan="2">{{ $_row['권리종류'] }}</td>
                                <td class="bck_wt">{{ $_row['권리자명'] }}</td>
                                <td class="bck_wt">{{ $_row['배분요구일'] }}</td>
                            </tr>
                            <tr>
                                <td class="bck_wt">{{ $_row['설정금액']>0 ? number_format($_row['설정금액'])."원" : '-' }}</td>
                                <td class="bck_wt">{{ $_row['배분요구채권액']>0 ? number_format($_row['배분요구채권액'])."원" : '-' }}</td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <th class="bck_wt" colspan="4">조회된 데이터가 없습니다.</th>
                            </tr>
                        @endif 
                        </tbody>
                    </table>
                    <p class="sm_txt">
                        * 배분요구서를 기준으로 작성하였으며, 신고된 채권액은 변동될 수 있습니다. 배분요구와 채권신고 여부는 입찰시작 7일전부터 제공됩니다.
                    </p>
                    <div class="cont_und_line"></div>
                </div>

                <div class="col-12">
                    <div class="auc_btitle">
                        <p>그외</p>
                    </div>
                </div>

                <!-- 입찰방법&제한 -->
                <div class="col-12">
                    <div class="auc_info_tit">
                        <p class="img_tit"><img src="/images/auction/other01.png" alt=""> 입찰방법&제한</p>
                    </div>
                    <ul class="sale_lst bid">
                        <li>
                            <p>집행기관</p>
                            <p>{{ $data['집행기관'] }}</p>
                        </li>
                        <li>
                            <p>담당자</p>
                            <p>{{ trim($data['담당자정보'][0]).'/'.trim($data['담당자정보'][1]) . ' '.$data['담당자정보'][2] }}</p>
                        </li>
                        <li>
                            <p>전자보증서</p>
                            <p>사용{{ $data['전자보증서가능'] ? '':'불' }}가능</p>
                        </li>
                        <li>
                            <p>차순위매수신청</p>
                            <p>신청{{ $data['차순위_매수신청가능'] ? '':'불' }}가능</p>
                        </li>
                        <li>
                            <p>공동입찰</p>
                            <p>공동입찰 {{ $data['공동입찰가능'] ? '':'불' }}가능</p>
                        </li>
                        
                        <li>
                            <p>2인 미만 유찰</p>
                            <p>{{ $data['2인_미만_유찰여부'] ? '1인만 입찰시 유찰':'1인이 입찰해도 유효함' }}</p>
                        </li>
                        <li>
                            <p>대리입찰</p>
                            <p>대리입찰 {{ $data['대리입찰가능'] ? '':'불' }}가능</p>
                        </li>
                        <li>
                            <p>2회 이상 입찰</p>
                            <p>동일물건 2회 이상 입찰 {{ $data['2회_이상_입찰가능'] ? '':'불' }}가능</p>
                        </li>
                    </ul>
                    <div class="cont_und_line"></div>
                </div>

                <!-- 납부기한 -->
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
