@extends('layout.layout')

@section('content')
    <section class="listing-title-area">
        <div class="container container_w">
            <!-- title -->
            <div class="row">
                <div class="col-12 auc_tit">
                    <p class="det_inf">서울동부지방법원 본원 <span>2021타경51574[1]</span></p>
                    <div class="main_title">
                        <h3>서울특별시 송파구 새말로 116, 2층 202호 (문정동, 한울리움)</h3>
                        <p class="auc_bdg">전용 12.5평</p>
                    </div>
                    <p class="adr">서울 송파구 문정동 83-24</p>
                </div>
            </div>
            <!-- img -->
            <div class="row jcsb auc_detail_row">
                <div class="row col-lg-12 col-xl-8">
                    <div class="col-12 col-sm-6 auc_slider">
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide auc-slide">
                                    <img src="images/auction/auction01.png" alt="">
                                </div>
                                <div class="swiper-slide auc-slide">
                                    <img src="images/auction/auction04.png" alt="">
                                </div>
                                <div class="swiper-slide auc-slide">
                                    <img src="images/auction/auction05.png" alt="">
                                </div>
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
                        <img src="/images/auction/auction_map.png" alt="">
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
                                <h3 class="auc_pri_n">3억 1700만원</h3>
                            </li>
                            <li>
                                <p class="auc_pri_tit">최저가</p>
                                <h3 class="auc_pri_n">892만 3000원</h3>
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
                                <p class="sale_day">2024년 02월 19일</p>
                                <p class="auc_bdg">D-26</p>
                            </div>
                        </div>
                        <div class="und_line"></div>
                        <ul class="sale_lst">
                            <li>
                                <p>용도</p>
                                <p>다세대</p>
                            </li>
                            <li>
                                <p>대상</p>
                                <p>토지전체, 건물전체</p>
                            </li>
                            <li>
                                <p>토지</p>
                                <p>19.8㎡ (6평)</p>
                            </li>
                            <li>
                                <p>건물</p>
                                <p>41.31㎡ (12.5평)</p>
                            </li>
                            <li>
                                <p>감정</p>
                                <p>2021년 04월 20일</p>
                            </li>
                            <li>
                                <p>보증금</p>
                                <p>90만원 (10%)</p>
                            </li>
                            <li class="hidden">
                                <p>경매구분</p>
                                <p>강제경매</p>
                            </li>
                            <li class="hidden">
                                <p>사건번호</p>
                                <p>2021타경51574</p>
                            </li>
                            <li class="hidden">
                                <p>관할법원</p>
                                <p>서울동부지방법원 본원</p>
                            </li>
                            <li class="hidden">
                                <p>배당요구종기일</p>
                                <p>2021년06월28일</p>
                            </li>
                            <li class="hidden">
                                <p>청구액</p>
                                <p>190,000,000원</p>
                            </li>
                            <li class="hidden">
                                <p>채권자</p>
                                <p>조OO</p>
                            </li>
                        </ul>
                        <button class="ac_more_btn" onclick="showMore()">더보기</button>
                    </div>


                    <!-- 유찰내역 -->
                    <div class="col-12">
                        <div class="sale_tit">
                            <p>#유찰16회 #재매각 #선순위임차인 #선순위전세권 #위반건축물</p>
                        </div>
                        <div class="und_line"></div>
                        <ul class="fall_lst">
                            <li>
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
                            </li>
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
                                <h3 class="auc_wid_n">320.5㎡ (97평)</h3>
                            </li>
                            <li>
                                <p class="auc_wid_tit">건물</p>
                                <h3 class="auc_wid_n">898.1㎡ (271.7평)</h3>
                            </li>
                        </ul>
                        <table>
                            <thead>
                                <tr>
                                    <th scope="col" width="10%"></th>
                                    <th scope="col" width="20%">구분</th>
                                    <th scope="col" width="40%">소재지</th>
                                    <th scope="col" width="17%">용도</th>
                                    <th scope="col" width="13%">상세</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="bck_col">1</th>
                                    <td class="bck_col">집합건물</td>
                                    <td class="bck_col">서울특별시 송파구 새말로 116, 2층 202호 (문정동, 한울리움)</td>
                                    <td class="bck_col">근린생활시설</td>
                                    <td class="bck_col"><a href="#">보기</a></td>
                                </tr>
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
                                    <p>성남시 수정구 신흥동 소재‘수정구보건소’남서측 인근에 위치하며, 북측 인근 수정로변에 노선버스정류장이 소재하며,
                                        남측 근거리에‘신흥역’이 소재함.</p>
                                </div>
                            </li>
                            <li>
                                <div class="use_state_list">
                                    <span>이용현황</span>
                                    <p>공부상‘제2종근린생활시설(사무소 1호)’이며, 건축물대장상 무단용도변경(주거)으로 위반건축물 등재됨.</p>
                                </div>
                            </li>
                            <li>
                                <div class="use_state_list">
                                    <span>기타사항</span>
                                    <p>실지조사(5월 30일 13시경) 당시 부재중으로 내부조사 생략함.</p>
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
                        <p class="respon">매수자</p>
                        <div class="cont_und_line"></div>
                    </div>

                    <!-- 토지정보&이용계획 -->
                    <div class="col-12">
                        <div class="auc_info_tit flx_bg">
                            <p>토지정보</p>
                            <button class="auc_bdg">토지이음</button>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th scope="col" width="30%">지목</th>
                                    <th scope="col" width="30%">면적</th>
                                    <th scope="col" width="40%">공시지가(㎡당)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="bck_col">전</th>
                                    <td class="bck_col">20.75㎡</td>
                                    <td class="bck_col">261,200원 (2023-01)</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="cont_und_line"></div>
                    </div>

                    <div class="col-12">
                        <div class="auc_info_tit">
                            <p>이용계획</p>
                        </div>
                        <div class="use_plan">
                            <p class="auc_bdg">제3종일반주거지역</p>
                            <p class="auc_bdg">성장관리권역</p>
                            <p class="auc_bdg">진입표면구역</p>
                            <p class="auc_bdg">가축사육제한구역</p>
                            <p class="auc_bdg">제한보호구역(전방지역:25km)</p>
                            <p class="auc_bdg">절대보호구역</p>
                        </div>
                        <div class="cont_und_line"></div>
                    </div>

                    <!-- 감정평가 -->
                    <div class="col-12">
                        <div class="auc_info_tit">
                            <p>감정평가</p>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th scope="col" width="10%"></th>
                                    <th scope="col" width="30%">감정평가기관</th>
                                    <th scope="col" width="30%">평가일</th>
                                    <th scope="col" width="30%">평가금액</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="bck_col">1</th>
                                    <th class="bck_col">성실감정평가사무소</th>
                                    <td class="bck_col">2023-08-16</td>
                                    <td class="bck_col">17,139,500원</td>
                                </tr>
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
                                    <th scope="col" width="20%">설정일자</th>
                                    <th scope="col">권리종류</th>
                                    <th scope="col">권리자/설정금액</th>
                                    <th scope="col" width="15%">권리</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="bck_col" rowspan="2">-</th>
                                    <th class="bck_col">공유자</th>
                                    <td class="bck_col">전**</td>
                                    <td class="bck_col" rowspan="2">-</td>
                                </tr>
                                <tr>
                                    <th class="bck_col">성실감정평가사무소</th>
                                    <td class="bck_col">2023-08-16</td>
                                </tr>
                                <tr>
                                    <th class="bck_col" rowspan="2">-</th>
                                    <th class="bck_col">공유자</th>
                                    <td class="bck_col">밍**</td>
                                    <td class="bck_col" rowspan="2">-</td>
                                </tr>
                                <tr>
                                    <th class="bck_col">성실감정평가사무소</th>
                                    <td class="bck_col">2023-08-16</td>
                                </tr>
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
                                    <th scope="col" width="20%">임차인</th>
                                    <th scope="col">보증금/차임</th>
                                    <th scope="col">전입/확정</th>
                                    <th scope="col" width="15%">대향/소멸</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="bck_col" colspan="4">조회된 데이터가 없습니다.</th>
                                </tr>
                            </tbody>
                        </table>
                        <div class="cont_und_line"></div>
                    </div>

                    {{-- 주요 유의사항 --}}
                    <div class="col-12">
                        <div class="auc_info_tit">
                            <p>주요 요의사항</p>
                        </div>
                        <ul class="auc_use_state">
                            <li>
                                <div class="use_state_list">
                                    <span>등기된 권리 또는 가처분으로서 매각으로 효력을 잃지 아니하는 것</span>
                                    <p>-</p>
                                </div>
                            </li>
                            <li>
                                <div class="use_state_list">
                                    <span>매수인으로서 일정한 자격을 필요로 하는 경우 그 사실</span>
                                    <p>농지(전, 답, 과수원 등)에 대해서는 「농지법」 제8조에 따라 농지취득자격증명을 발급받을 수 있는 개인과 농업법인만이
                                        소유권이전등기를 받을 수 있으므로, 매각결정기일 전에 매수자격 취득사실을 증명하는 서류[농지취득자격증명,
                                        농지취득자격증명 반려증(단, 반려사유에 따라 매각결정 또는 매각결정 불허)]를 제출하는 경우 매각결정을 하고,
                                        매각결전기일 전까지 해당 서류를 제출하지 않는 경우에는 매각불허결정합니다.</p>
                                </div>
                            </li>
                            <li>
                                <div class="use_state_list">
                                    <span>유의사항</span>
                                    <p>-</p>
                                </div>
                            </li>
                        </ul>
                        <p class="sm_txt">* 본 정보는 공사에 공매의뢰된 시점의 정보로 현행 등기사항증명서과 다를 수 있으며, 일부 정보의 표시가 누락, 오기될 수 있습니다. 따라서 본
                            정보는 참고용 자료로만 활용하시고 정확한 정보 확인을 위해서는 반드시 등기사항증명서와 관련 공부를 확인하시기 바랍니다.</p>
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
                                <p>[총 0건]</p>
                                <tr>
                                    <th scope="col" width="22%">설정일자</th>
                                    <th scope="col" width="22%">권리종류</th>
                                    <th scope="col" width="28%">권리자/설정금액</th>
                                    <th scope="col" width="28%">배분요구일/배분요구채권액</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="bck_col" colspan="4">조회된 데이터가 없습니다.</th>
                                </tr>
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
