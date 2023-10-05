@extends('admin.layout.layout')

@section('page-title', '메뉴 관리')

@section('page-comment', '사이트 메뉴를 관리합니다.')

@section('content')

    <link rel="stylesheet" media="all" href="{{ url('css/admin-menu.css') }}" />

    <div class="my_dashboard_review mb40">

    <div class="siteMnCtrlsWrap">
        <div class="mn-mnlist">

            <div class="sec-top">
                <h3 class="a-tit02">1차 메뉴</h3>
            </div>


            <div class="menu-mlist-f">
                <button type="button" onclick="siteMenuCtrls.addMenu('');" class="bt-reg"><span class="ic-reg"></span><span
                        class="">메뉴추가</span></button>
                <div class="chk-all-sel">
                    <span class='is-chk'><input type="checkbox" id="chk1_use"
                            onclick="siteMenuCtrls.chk_printType(1,'use')" value="1" title="사용" /><label
                            for="chk1_use">USE</label></span>
                    <span class='is-chk'><input type="checkbox" id="chk1_print_top"
                            onclick="siteMenuCtrls.chk_printType(1,'print_top')" value="1" title="탑메뉴" /><label
                            for="chk1_print_top">TOP</label></span>
                </div>
                <div class="bt-wr fr">
                    <button type="button" onclick="siteMenuCtrls.menuOptEdit(1);" class=""><span
                            class=''>옵션<br />수정</span></button>
                    <button type="button" onclick="siteMenuCtrls.menuSort(1);" class=""><span
                            class=''>순서<br />저장</span></button>
                </div>
            </div>

            <form name="frmMenuList1" id="frmMenuList1" method="post" action="/_Admin/Site/cfg.menu.php"
                enctype="multipart/form-data" onsubmit="return false">
                <input type="hidden" name="sCode" value="mng" />
                <input type="hidden" name="pCode" value="" />


                <ul class="menu-list menu-mlist">
                    <li>
                        <input type="hidden" name="mn_code[]" value="Setting" />
                        <div class="li-wr">
                            <span class="is-mntype mntype-m"></span>

                            <p class="nm-wr">
                                <strong class="is-nm"><a
                                        href="/_Admin/Site/cfg.menu.php?sCode=mng&mode=&key=S-0132000001">환경/운영설정</a></strong>
                                <span class="is-code">Setting</span>
                            </p>

                            <p class="chk-wr">

                                <span class="is-chk "><input type="checkbox" name="chk_use[]" value="Setting"
                                        checked='checked' /></span>
                                <span class="is-chk "><input type="checkbox" name="chk_print_top[]" value="Setting"
                                        checked='checked' /></span>
                            </p>

                            <p class="bt-wr">

                                <button class="a-icbt ic-cfg" type="button"
                                    onclick="siteMenuCtrls.cfgMenu('S-0132000001');"><span class="blind">관리</span></button>
                                <button class="a-icbt ic-move" type="button"
                                    onclick="siteMenuCtrls.moveMenu('S-0132000001');"><span
                                        class="blind">이동</span></button>

                                <button class="a-icbt ic-del" type="button"
                                    onclick="siteMenuCtrls.delMenu('S-0132000001');"><span class="blind">삭제</span></button>
                            </p>
                        </div>


                    </li>
                    <li>
                        <input type="hidden" name="mn_code[]" value="Sawon" />
                        <div class="li-wr">
                            <span class="is-mntype mntype-m"></span>

                            <p class="nm-wr">
                                <strong class="is-nm"><a
                                        href="/_Admin/Site/cfg.menu.php?sCode=mng&mode=&key=S-0132000002">사원관리</a></strong>
                                <span class="is-code">Sawon</span>
                            </p>

                            <p class="chk-wr">

                                <span class="is-chk "><input type="checkbox" name="chk_use[]" value="Sawon"
                                        checked='checked' /></span>
                                <span class="is-chk "><input type="checkbox" name="chk_print_top[]" value="Sawon"
                                        checked='checked' /></span>
                            </p>

                            <p class="bt-wr">

                                <button class="a-icbt ic-cfg" type="button"
                                    onclick="siteMenuCtrls.cfgMenu('S-0132000002');"><span
                                        class="blind">관리</span></button>
                                <button class="a-icbt ic-move" type="button"
                                    onclick="siteMenuCtrls.moveMenu('S-0132000002');"><span
                                        class="blind">이동</span></button>

                                <button class="a-icbt ic-del" type="button"
                                    onclick="siteMenuCtrls.delMenu('S-0132000002');"><span
                                        class="blind">삭제</span></button>
                            </p>
                        </div>


                    </li>
                    <li>
                        <input type="hidden" name="mn_code[]" value="Sale" />
                        <div class="li-wr">
                            <span class="is-mntype mntype-m"></span>

                            <p class="nm-wr">
                                <strong class="is-nm"><a
                                        href="/_Admin/Site/cfg.menu.php?sCode=mng&mode=&key=S-0132000003">물건관리</a></strong>
                                <span class="is-code">Sale</span>
                            </p>

                            <p class="chk-wr">

                                <span class="is-chk "><input type="checkbox" name="chk_use[]" value="Sale"
                                        checked='checked' /></span>
                                <span class="is-chk "><input type="checkbox" name="chk_print_top[]" value="Sale"
                                        checked='checked' /></span>
                            </p>

                            <p class="bt-wr">

                                <button class="a-icbt ic-cfg" type="button"
                                    onclick="siteMenuCtrls.cfgMenu('S-0132000003');"><span
                                        class="blind">관리</span></button>
                                <button class="a-icbt ic-move" type="button"
                                    onclick="siteMenuCtrls.moveMenu('S-0132000003');"><span
                                        class="blind">이동</span></button>

                                <button class="a-icbt ic-del" type="button"
                                    onclick="siteMenuCtrls.delMenu('S-0132000003');"><span
                                        class="blind">삭제</span></button>
                            </p>
                        </div>


                    </li>
                    <li>
                        <input type="hidden" name="mn_code[]" value="mngAd" />
                        <div class="li-wr">
                            <span class="is-mntype mntype-m"></span>

                            <p class="nm-wr">
                                <strong class="is-nm"><a
                                        href="/_Admin/Site/cfg.menu.php?sCode=mng&mode=&key=S-0132000076">광고관리</a></strong>
                                <span class="is-code">mngAd</span>
                            </p>

                            <p class="chk-wr">

                                <span class="is-chk "><input type="checkbox" name="chk_use[]" value="mngAd"
                                        checked='checked' /></span>
                                <span class="is-chk "><input type="checkbox" name="chk_print_top[]" value="mngAd"
                                        checked='checked' /></span>
                            </p>

                            <p class="bt-wr">

                                <button class="a-icbt ic-cfg" type="button"
                                    onclick="siteMenuCtrls.cfgMenu('S-0132000076');"><span
                                        class="blind">관리</span></button>
                                <button class="a-icbt ic-move" type="button"
                                    onclick="siteMenuCtrls.moveMenu('S-0132000076');"><span
                                        class="blind">이동</span></button>

                                <button class="a-icbt ic-del" type="button"
                                    onclick="siteMenuCtrls.delMenu('S-0132000076');"><span
                                        class="blind">삭제</span></button>
                            </p>
                        </div>


                    </li>
                    <li>
                        <input type="hidden" name="mn_code[]" value="Mypage" />
                        <div class="li-wr">
                            <span class="is-mntype mntype-m"></span>

                            <p class="nm-wr">
                                <strong class="is-nm"><a
                                        href="/_Admin/Site/cfg.menu.php?sCode=mng&mode=&key=S-0132000004">마이페이지</a></strong>
                                <span class="is-code">Mypage</span>
                            </p>

                            <p class="chk-wr">

                                <span class="is-chk "><input type="checkbox" name="chk_use[]" value="Mypage"
                                        checked='checked' /></span>
                                <span class="is-chk "><input type="checkbox" name="chk_print_top[]" value="Mypage"
                                        checked='checked' /></span>
                            </p>

                            <p class="bt-wr">

                                <button class="a-icbt ic-cfg" type="button"
                                    onclick="siteMenuCtrls.cfgMenu('S-0132000004');"><span
                                        class="blind">관리</span></button>
                                <button class="a-icbt ic-move" type="button"
                                    onclick="siteMenuCtrls.moveMenu('S-0132000004');"><span
                                        class="blind">이동</span></button>

                                <button class="a-icbt ic-del" type="button"
                                    onclick="siteMenuCtrls.delMenu('S-0132000004');"><span
                                        class="blind">삭제</span></button>
                            </p>
                        </div>


                    </li>
                    <li>
                        <input type="hidden" name="mn_code[]" value="Board" />
                        <div class="li-wr">
                            <span class="is-mntype mntype-m"></span>

                            <p class="nm-wr">
                                <strong class="is-nm"><a
                                        href="/_Admin/Site/cfg.menu.php?sCode=mng&mode=&key=S-0132000014">게시판</a></strong>
                                <span class="is-code">Board</span>
                            </p>

                            <p class="chk-wr">

                                <span class="is-chk "><input type="checkbox" name="chk_use[]" value="Board"
                                        checked='checked' /></span>
                                <span class="is-chk "><input type="checkbox" name="chk_print_top[]" value="Board"
                                        checked='checked' /></span>
                            </p>

                            <p class="bt-wr">

                                <button class="a-icbt ic-cfg" type="button"
                                    onclick="siteMenuCtrls.cfgMenu('S-0132000014');"><span
                                        class="blind">관리</span></button>
                                <button class="a-icbt ic-move" type="button"
                                    onclick="siteMenuCtrls.moveMenu('S-0132000014');"><span
                                        class="blind">이동</span></button>

                                <button class="a-icbt ic-del" type="button"
                                    onclick="siteMenuCtrls.delMenu('S-0132000014');"><span
                                        class="blind">삭제</span></button>
                            </p>
                        </div>


                    </li>
                    <li>
                        <input type="hidden" name="mn_code[]" value="etc" />
                        <div class="li-wr">
                            <span class="is-mntype mntype-m"></span>

                            <p class="nm-wr">
                                <strong class="is-nm"><a
                                        href="/_Admin/Site/cfg.menu.php?sCode=mng&mode=&key=S-0132000055">부가관리</a></strong>
                                <span class="is-code">etc</span>
                            </p>

                            <p class="chk-wr">

                                <span class="is-chk "><input type="checkbox" name="chk_use[]" value="etc"
                                        checked='checked' /></span>
                                <span class="is-chk "><input type="checkbox" name="chk_print_top[]" value="etc"
                                        checked='checked' /></span>
                            </p>

                            <p class="bt-wr">

                                <button class="a-icbt ic-cfg" type="button"
                                    onclick="siteMenuCtrls.cfgMenu('S-0132000055');"><span
                                        class="blind">관리</span></button>
                                <button class="a-icbt ic-move" type="button"
                                    onclick="siteMenuCtrls.moveMenu('S-0132000055');"><span
                                        class="blind">이동</span></button>

                                <button class="a-icbt ic-del" type="button"
                                    onclick="siteMenuCtrls.delMenu('S-0132000055');"><span
                                        class="blind">삭제</span></button>
                            </p>
                        </div>


                    </li>
                    <li>
                        <input type="hidden" name="mn_code[]" value="Login" />
                        <div class="li-wr">
                            <span class="is-mntype mntype-p"></span>

                            <p class="nm-wr">
                                <strong class="is-nm"><a
                                        href="/_Admin/Site/cfg.menu.php?sCode=mng&mode=&key=S-0132000005">로그인</a></strong>
                                <span class="is-code">Login</span>
                            </p>

                            <p class="chk-wr">

                                <span class="is-chk "><input type="checkbox" name="chk_use[]" value="Login"
                                        checked='checked' /></span>
                                <span class="is-chk "><input type="checkbox" name="chk_print_top[]"
                                        value="Login" /></span>
                            </p>

                            <p class="bt-wr">

                                <button class="a-icbt ic-cfg" type="button"
                                    onclick="siteMenuCtrls.cfgMenu('S-0132000005');"><span
                                        class="blind">관리</span></button>
                                <button class="a-icbt ic-move" type="button"
                                    onclick="siteMenuCtrls.moveMenu('S-0132000005');"><span
                                        class="blind">이동</span></button>

                                <button class="a-icbt ic-del" type="button"
                                    onclick="siteMenuCtrls.delMenu('S-0132000005');"><span
                                        class="blind">삭제</span></button>
                            </p>
                        </div>


                    </li>
                    <li>
                        <input type="hidden" name="mn_code[]" value="styleguide" />
                        <div class="li-wr">
                            <span class="is-mntype mntype-m"></span>

                            <p class="nm-wr">
                                <strong class="is-nm"><a
                                        href="/_Admin/Site/cfg.menu.php?sCode=mng&mode=&key=S-0132000051">스타일가이드</a></strong>
                                <span class="is-code">styleguide</span>
                            </p>

                            <p class="chk-wr">

                                <span class="is-chk "><input type="checkbox" name="chk_use[]" value="styleguide"
                                        checked='checked' /></span>
                                <span class="is-chk "><input type="checkbox" name="chk_print_top[]"
                                        value="styleguide" /></span>
                            </p>

                            <p class="bt-wr">

                                <button class="a-icbt ic-cfg" type="button"
                                    onclick="siteMenuCtrls.cfgMenu('S-0132000051');"><span
                                        class="blind">관리</span></button>
                                <button class="a-icbt ic-move" type="button"
                                    onclick="siteMenuCtrls.moveMenu('S-0132000051');"><span
                                        class="blind">이동</span></button>

                                <button class="a-icbt ic-del" type="button"
                                    onclick="siteMenuCtrls.delMenu('S-0132000051');"><span
                                        class="blind">삭제</span></button>
                            </p>
                        </div>


                    </li>
                </ul>
            </form>

            <div class="sgap"></div>
            <p class="f12  a-info-ex2"> 마우스로 드래그하여 이동하신 후 <strong>[순서 저장]</strong> 버튼을 클릭하시면 순서를 변경하실 수 있습니다.</p>


        </div>


        <div class="mn-sublist">

            <div class="sec-top">
                <h3 class="a-tit02">사원관리 <span class="nb f11 cg3"> / Sawon</span></h3>
            </div>


            <div class="menulist-wr">

                <div class="menu-sublist-f">
                    <button type="button" onclick="siteMenuCtrls.addMenu('S-0132000002');" class="bt-reg"><span
                            class="ic-reg"></span><span class="">하위메뉴추가</span></button>
                    <div class="chk-all-sel">
                        <span class='is-chk'><input type="checkbox" id="chk2_use"
                                onclick="siteMenuCtrls.chk_printType(2,'use')" value="1" title="사용" /><label
                                for="chk2_use">USE</label></span>
                        <span class='is-chk'><input type="checkbox" id="chk2_print_top"
                                onclick="siteMenuCtrls.chk_printType(2,'print_top')" value="1"
                                title="사용" /><label for="chk2_print_top">TOP</label></span>
                        <span class='is-chk'><input type="checkbox" id="chk2_print_left"
                                onclick="siteMenuCtrls.chk_printType(2,'print_left')" value="1"
                                title="사용" /><label for="chk2_print_left">LEFT</label></span>
                        <span class='is-chk'><input type="checkbox" id="chk2_print_tab"
                                onclick="siteMenuCtrls.chk_printType(2,'print_tab')" value="1"
                                title="사용" /><label for="chk2_print_tab">TAB</label></span>
                    </div>
                    <div class="bt-wr fr">

                        <button type="button" onclick="siteMenuCtrls.menuOptEdit(2);" class=""><span
                                class=''>옵션수정</span></button>
                        <button type="button" onclick="siteMenuCtrls.menuSort(2);" class=""><span
                                class=''>순서저장</span></button>
                    </div>
                </div>




                <div class="menu-list menu-sublist">
                    <form name="frmMenuList2" id="frmMenuList2" method="post" action="/_Admin/Site/cfg.menu.php"
                        enctype="multipart/form-data" onsubmit="return false">
                        <input type="hidden" name="sCode" value="mng" />
                        <input type="hidden" name="pCode" value="Sawon" />

                        <ul class=' ' id='mnSubSawon'>
                            <li id='mnList_SawonList' class='' n='1' depth='2'>
                                <div class='li-wr'>
                                    <input type='hidden' name='code[]' value='SawonList' />
                                    <button type='button' class='is-folder'><span class='blind'>Sub
                                            Toggle</span></button>
                                    <span class='is-mntype mntype-p'></span>
                                    <p class='nm-wr'>
                                        <a href='http://test.gbbinc.co.kr/mng/SawonList' target='_blank'>
                                            <strong class='is-nm'>사원목록</strong>
                                            <span class='is-code'>SawonList</span>
                                        </a>
                                    </p>
                                    <p class='chk-wr'><span class='is-chk'><input type='checkbox' name='chk_use[]'
                                                id='chk_use_SawonList' value='SawonList' checked='checked'
                                                title='사용여부' /><label for='chk_use_SawonList'>USE</label></span><span
                                            class='is-chk'><input type='checkbox' name='chk_print_top[]'
                                                id='chk_tmn_SawonList' value='SawonList' title='상단메뉴로출력' /><label
                                                for='chk_tmn_SawonList'>TOP</label></span><span class='is-chk'><input
                                                type='checkbox' name='chk_print_left[]' id='chk_lm_SawonList'
                                                value='SawonList' checked='checked' title='왼쪽메뉴로출력' /><label
                                                for='chk_lm_SawonList'>LEFT</label></span><span class='is-chk'><input
                                                type='checkbox' name='chk_print_tab[]' id='chk_tab_SawonList'
                                                value='SawonList' title='탭메뉴로출력' /><label
                                                for='chk_tab_SawonList'>TAB</label></span></p>
                                    <p class='bt-wr'><button type="button" class="a-icbt ic-add"
                                            onclick="siteMenuCtrls.addMenu('S-0132000006');"><span
                                                class="blind">추가</span></button><button type="button"
                                            class="a-icbt ic-cfg" onclick="siteMenuCtrls.cfgMenu('S-0132000006');"><span
                                                class="blind">관리</span></button><button type="button"
                                            class="a-icbt ic-move" onclick="siteMenuCtrls.moveMenu('S-0132000006');"><span
                                                class="blind">이동</span></button><button type="button"
                                            class="a-icbt ic-del" onclick="siteMenuCtrls.delMenu('S-0132000006');"><span
                                                class="blind">삭제</span></button></p>
                                </div>

                            </li>
                            <li id='mnList_SawonReg' class='' n='2' depth='2'>
                                <div class='li-wr'>
                                    <input type='hidden' name='code[]' value='SawonReg' />
                                    <button type='button' class='is-folder'><span class='blind'>Sub
                                            Toggle</span></button>
                                    <span class='is-mntype mntype-p'></span>
                                    <p class='nm-wr'>
                                        <a href='http://test.gbbinc.co.kr/mng/SawonReg' target='_blank'>
                                            <strong class='is-nm'>사원등록</strong>
                                            <span class='is-code'>SawonReg</span>
                                        </a>
                                    </p>
                                    <p class='chk-wr'><span class='is-chk'><input type='checkbox' name='chk_use[]'
                                                id='chk_use_SawonReg' value='SawonReg' checked='checked'
                                                title='사용여부' /><label for='chk_use_SawonReg'>USE</label></span><span
                                            class='is-chk'><input type='checkbox' name='chk_print_top[]'
                                                id='chk_tmn_SawonReg' value='SawonReg' title='상단메뉴로출력' /><label
                                                for='chk_tmn_SawonReg'>TOP</label></span><span class='is-chk'><input
                                                type='checkbox' name='chk_print_left[]' id='chk_lm_SawonReg'
                                                value='SawonReg' checked='checked' title='왼쪽메뉴로출력' /><label
                                                for='chk_lm_SawonReg'>LEFT</label></span><span class='is-chk'><input
                                                type='checkbox' name='chk_print_tab[]' id='chk_tab_SawonReg'
                                                value='SawonReg' title='탭메뉴로출력' /><label
                                                for='chk_tab_SawonReg'>TAB</label></span></p>
                                    <p class='bt-wr'><button type="button" class="a-icbt ic-add"
                                            onclick="siteMenuCtrls.addMenu('S-0132000007');"><span
                                                class="blind">추가</span></button><button type="button"
                                            class="a-icbt ic-cfg" onclick="siteMenuCtrls.cfgMenu('S-0132000007');"><span
                                                class="blind">관리</span></button><button type="button"
                                            class="a-icbt ic-move" onclick="siteMenuCtrls.moveMenu('S-0132000007');"><span
                                                class="blind">이동</span></button><button type="button"
                                            class="a-icbt ic-del" onclick="siteMenuCtrls.delMenu('S-0132000007');"><span
                                                class="blind">삭제</span></button></p>
                                </div>

                            </li>
                            <li id='mnList_SawonLeave' class='' n='3' depth='2'>
                                <div class='li-wr'>
                                    <input type='hidden' name='code[]' value='SawonLeave' />
                                    <button type='button' class='is-folder'><span class='blind'>Sub
                                            Toggle</span></button>
                                    <span class='is-mntype mntype-p'></span>
                                    <p class='nm-wr'>
                                        <a href='http://test.gbbinc.co.kr/mng/SawonLeave' target='_blank'>
                                            <strong class='is-nm'>퇴사사원</strong>
                                            <span class='is-code'>SawonLeave</span>
                                        </a>
                                    </p>
                                    <p class='chk-wr'><span class='is-chk'><input type='checkbox' name='chk_use[]'
                                                id='chk_use_SawonLeave' value='SawonLeave' checked='checked'
                                                title='사용여부' /><label for='chk_use_SawonLeave'>USE</label></span><span
                                            class='is-chk'><input type='checkbox' name='chk_print_top[]'
                                                id='chk_tmn_SawonLeave' value='SawonLeave' title='상단메뉴로출력' /><label
                                                for='chk_tmn_SawonLeave'>TOP</label></span><span class='is-chk'><input
                                                type='checkbox' name='chk_print_left[]' id='chk_lm_SawonLeave'
                                                value='SawonLeave' checked='checked' title='왼쪽메뉴로출력' /><label
                                                for='chk_lm_SawonLeave'>LEFT</label></span><span class='is-chk'><input
                                                type='checkbox' name='chk_print_tab[]' id='chk_tab_SawonLeave'
                                                value='SawonLeave' title='탭메뉴로출력' /><label
                                                for='chk_tab_SawonLeave'>TAB</label></span></p>
                                    <p class='bt-wr'><button type="button" class="a-icbt ic-add"
                                            onclick="siteMenuCtrls.addMenu('S-0132000008');"><span
                                                class="blind">추가</span></button><button type="button"
                                            class="a-icbt ic-cfg" onclick="siteMenuCtrls.cfgMenu('S-0132000008');"><span
                                                class="blind">관리</span></button><button type="button"
                                            class="a-icbt ic-move" onclick="siteMenuCtrls.moveMenu('S-0132000008');"><span
                                                class="blind">이동</span></button><button type="button"
                                            class="a-icbt ic-del" onclick="siteMenuCtrls.delMenu('S-0132000008');"><span
                                                class="blind">삭제</span></button></p>
                                </div>

                            </li>
                            <li id='mnList_SawonLoginCert' class='' n='4' depth='2'>
                                <div class='li-wr'>
                                    <input type='hidden' name='code[]' value='SawonLoginCert' />
                                    <button type='button' class='is-folder'><span class='blind'>Sub
                                            Toggle</span></button>
                                    <span class='is-mntype mntype-p'></span>
                                    <p class='nm-wr'>
                                        <a href='http://test.gbbinc.co.kr/mng/SawonLoginCert' target='_blank'>
                                            <strong class='is-nm'>접속기기 관리</strong>
                                            <span class='is-code'>SawonLoginCert</span>
                                        </a>
                                    </p>
                                    <p class='chk-wr'><span class='is-chk'><input type='checkbox' name='chk_use[]'
                                                id='chk_use_SawonLoginCert' value='SawonLoginCert' checked='checked'
                                                title='사용여부' /><label
                                                for='chk_use_SawonLoginCert'>USE</label></span><span class='is-chk'><input
                                                type='checkbox' name='chk_print_top[]' id='chk_tmn_SawonLoginCert'
                                                value='SawonLoginCert' title='상단메뉴로출력' /><label
                                                for='chk_tmn_SawonLoginCert'>TOP</label></span><span class='is-chk'><input
                                                type='checkbox' name='chk_print_left[]' id='chk_lm_SawonLoginCert'
                                                value='SawonLoginCert' checked='checked' title='왼쪽메뉴로출력' /><label
                                                for='chk_lm_SawonLoginCert'>LEFT</label></span><span class='is-chk'><input
                                                type='checkbox' name='chk_print_tab[]' id='chk_tab_SawonLoginCert'
                                                value='SawonLoginCert' title='탭메뉴로출력' /><label
                                                for='chk_tab_SawonLoginCert'>TAB</label></span></p>
                                    <p class='bt-wr'><button type="button" class="a-icbt ic-add"
                                            onclick="siteMenuCtrls.addMenu('S-0132000026');"><span
                                                class="blind">추가</span></button><button type="button"
                                            class="a-icbt ic-cfg" onclick="siteMenuCtrls.cfgMenu('S-0132000026');"><span
                                                class="blind">관리</span></button><button type="button"
                                            class="a-icbt ic-move" onclick="siteMenuCtrls.moveMenu('S-0132000026');"><span
                                                class="blind">이동</span></button><button type="button"
                                            class="a-icbt ic-del" onclick="siteMenuCtrls.delMenu('S-0132000026');"><span
                                                class="blind">삭제</span></button></p>
                                </div>

                            </li>
                            <li id='mnList_SawonInfo' class='' n='5' depth='2'>
                                <div class='li-wr'>
                                    <input type='hidden' name='code[]' value='SawonInfo' />
                                    <button type='button' class='is-folder'><span class='blind'>Sub
                                            Toggle</span></button>
                                    <span class='is-mntype mntype-p'></span>
                                    <p class='nm-wr'>
                                        <a href='http://test.gbbinc.co.kr/mng/SawonInfo' target='_blank'>
                                            <strong class='is-nm'>사원정보관리</strong>
                                            <span class='is-code'>SawonInfo</span>
                                        </a>
                                    </p>
                                    <p class='chk-wr'><span class='is-chk'><input type='checkbox' name='chk_use[]'
                                                id='chk_use_SawonInfo' value='SawonInfo' checked='checked'
                                                title='사용여부' /><label for='chk_use_SawonInfo'>USE</label></span><span
                                            class='is-chk'><input type='checkbox' name='chk_print_top[]'
                                                id='chk_tmn_SawonInfo' value='SawonInfo' title='상단메뉴로출력' /><label
                                                for='chk_tmn_SawonInfo'>TOP</label></span><span class='is-chk'><input
                                                type='checkbox' name='chk_print_left[]' id='chk_lm_SawonInfo'
                                                value='SawonInfo' title='왼쪽메뉴로출력' /><label
                                                for='chk_lm_SawonInfo'>LEFT</label></span><span class='is-chk'><input
                                                type='checkbox' name='chk_print_tab[]' id='chk_tab_SawonInfo'
                                                value='SawonInfo' title='탭메뉴로출력' /><label
                                                for='chk_tab_SawonInfo'>TAB</label></span></p>
                                    <p class='bt-wr'><button type="button" class="a-icbt ic-add"
                                            onclick="siteMenuCtrls.addMenu('S-0132000012');"><span
                                                class="blind">추가</span></button><button type="button"
                                            class="a-icbt ic-cfg" onclick="siteMenuCtrls.cfgMenu('S-0132000012');"><span
                                                class="blind">관리</span></button><button type="button"
                                            class="a-icbt ic-move" onclick="siteMenuCtrls.moveMenu('S-0132000012');"><span
                                                class="blind">이동</span></button><button type="button"
                                            class="a-icbt ic-del" onclick="siteMenuCtrls.delMenu('S-0132000012');"><span
                                                class="blind">삭제</span></button></p>
                                </div>

                            </li>
                            <li id='mnList_state' class='has-sub' n='6' depth='2'>
                                <div class='li-wr'>
                                    <input type='hidden' name='code[]' value='state' />
                                    <button type='button' class='is-folder'><span class='blind'>Sub
                                            Toggle</span></button>
                                    <span class='is-mntype mntype-m'></span>
                                    <p class='nm-wr'>
                                        <a href='http://test.gbbinc.co.kr/mng/state' target='_blank'>
                                            <strong class='is-nm'>사원별 물건통계</strong>
                                            <span class='is-code'>state</span>
                                        </a>
                                    </p>
                                    <p class='chk-wr'>
                                        <span class='is-chk'>
                                            <input type='checkbox' name='chk_use[]' id='chk_use_state' value='state'
                                                checked='checked' title='사용여부' />
                                            <label for='chk_use_state'>USE</label>
                                        </span>
                                        <span class='is-chk'>
                                            <input type='checkbox' name='chk_print_top[]' id='chk_tmn_state'
                                                value='state' title='상단메뉴로출력' /><label
                                                for='chk_tmn_state'>TOP</label></span><span class='is-chk'><input
                                                type='checkbox' name='chk_print_left[]' id='chk_lm_state' value='state'
                                                checked='checked' title='왼쪽메뉴로출력' /><label
                                                for='chk_lm_state'>LEFT</label></span><span class='is-chk'><input
                                                type='checkbox' name='chk_print_tab[]' id='chk_tab_state' value='state'
                                                title='탭메뉴로출력' /><label for='chk_tab_state'>TAB</label></span>
                                    </p>
                                    <p class='bt-wr'><button type="button" class="a-icbt ic-add"
                                            onclick="siteMenuCtrls.addMenu('S-0132000094');"><span
                                                class="blind">추가</span></button><button type="button"
                                            class="a-icbt ic-cfg" onclick="siteMenuCtrls.cfgMenu('S-0132000094');"><span
                                                class="blind">관리</span></button><button type="button"
                                            class="a-icbt ic-move" onclick="siteMenuCtrls.moveMenu('S-0132000094');"><span
                                                class="blind">이동</span></button><button type="button"
                                            class="a-icbt ic-del" onclick="siteMenuCtrls.delMenu('S-0132000094');"><span
                                                class="blind">삭제</span></button></p>
                                </div>
                                <ul class=' ' id='mnSubstate'>
                                    <li id='mnList_saleStateSawon' class='' n='1' depth='3'>
                                        <div class='li-wr'>
                                            <input type='hidden' name='code[]' value='saleStateSawon' />
                                            <button type='button' class='is-folder'><span class='blind'>Sub
                                                    Toggle</span></button>
                                            <span class='is-mntype mntype-p'></span>
                                            <p class='nm-wr'>
                                                <a href='http://test.gbbinc.co.kr/mng/saleStateSawon' target='_blank'>
                                                    <strong class='is-nm'>기간별</strong>
                                                    <span class='is-code'>saleStateSawon</span>
                                                </a>
                                            </p>
                                            <p class='chk-wr'><span class='is-chk'><input type='checkbox'
                                                        name='chk_use[]' id='chk_use_saleStateSawon'
                                                        value='saleStateSawon' checked='checked' title='사용여부' /><label
                                                        for='chk_use_saleStateSawon'>USE</label></span><span
                                                    class='is-chk'><input type='checkbox' name='chk_print_top[]'
                                                        id='chk_tmn_saleStateSawon' value='saleStateSawon'
                                                        title='상단메뉴로출력' /><label
                                                        for='chk_tmn_saleStateSawon'>TOP</label></span><span
                                                    class='is-chk'><input type='checkbox' name='chk_print_left[]'
                                                        id='chk_lm_saleStateSawon' value='saleStateSawon'
                                                        title='왼쪽메뉴로출력' /><label
                                                        for='chk_lm_saleStateSawon'>LEFT</label></span><span
                                                    class='is-chk'><input type='checkbox' name='chk_print_tab[]'
                                                        id='chk_tab_saleStateSawon' value='saleStateSawon'
                                                        checked='checked' title='탭메뉴로출력' /><label
                                                        for='chk_tab_saleStateSawon'>TAB</label></span></p>
                                            <p class='bt-wr'><button type="button" class="a-icbt ic-add"
                                                    onclick="siteMenuCtrls.addMenu('S-0132000054');"><span
                                                        class="blind">추가</span></button><button type="button"
                                                    class="a-icbt ic-cfg"
                                                    onclick="siteMenuCtrls.cfgMenu('S-0132000054');"><span
                                                        class="blind">관리</span></button><button type="button"
                                                    class="a-icbt ic-move"
                                                    onclick="siteMenuCtrls.moveMenu('S-0132000054');"><span
                                                        class="blind">이동</span></button><button type="button"
                                                    class="a-icbt ic-del"
                                                    onclick="siteMenuCtrls.delMenu('S-0132000054');"><span
                                                        class="blind">삭제</span></button></p>
                                        </div>

                                    </li>
                                    <li id='mnList_saleStateSawonMonth' class='' n='2' depth='3'>
                                        <div class='li-wr'>
                                            <input type='hidden' name='code[]' value='saleStateSawonMonth' />
                                            <button type='button' class='is-folder'><span class='blind'>Sub
                                                    Toggle</span></button>
                                            <span class='is-mntype mntype-p'></span>
                                            <p class='nm-wr'>
                                                <a href='http://test.gbbinc.co.kr/mng/saleStateSawonMonth'
                                                    target='_blank'>
                                                    <strong class='is-nm'>월별</strong>
                                                    <span class='is-code'>saleStateSawonMonth</span>
                                                </a>
                                            </p>
                                            <p class='chk-wr'><span class='is-chk'><input type='checkbox'
                                                        name='chk_use[]' id='chk_use_saleStateSawonMonth'
                                                        value='saleStateSawonMonth' checked='checked'
                                                        title='사용여부' /><label
                                                        for='chk_use_saleStateSawonMonth'>USE</label></span><span
                                                    class='is-chk'><input type='checkbox' name='chk_print_top[]'
                                                        id='chk_tmn_saleStateSawonMonth' value='saleStateSawonMonth'
                                                        title='상단메뉴로출력' /><label
                                                        for='chk_tmn_saleStateSawonMonth'>TOP</label></span><span
                                                    class='is-chk'><input type='checkbox' name='chk_print_left[]'
                                                        id='chk_lm_saleStateSawonMonth' value='saleStateSawonMonth'
                                                        title='왼쪽메뉴로출력' /><label
                                                        for='chk_lm_saleStateSawonMonth'>LEFT</label></span><span
                                                    class='is-chk'><input type='checkbox' name='chk_print_tab[]'
                                                        id='chk_tab_saleStateSawonMonth' value='saleStateSawonMonth'
                                                        checked='checked' title='탭메뉴로출력' /><label
                                                        for='chk_tab_saleStateSawonMonth'>TAB</label></span></p>
                                            <p class='bt-wr'><button type="button" class="a-icbt ic-add"
                                                    onclick="siteMenuCtrls.addMenu('S-0132000096');"><span
                                                        class="blind">추가</span></button><button type="button"
                                                    class="a-icbt ic-cfg"
                                                    onclick="siteMenuCtrls.cfgMenu('S-0132000096');"><span
                                                        class="blind">관리</span></button><button type="button"
                                                    class="a-icbt ic-move"
                                                    onclick="siteMenuCtrls.moveMenu('S-0132000096');"><span
                                                        class="blind">이동</span></button><button type="button"
                                                    class="a-icbt ic-del"
                                                    onclick="siteMenuCtrls.delMenu('S-0132000096');"><span
                                                        class="blind">삭제</span></button></p>
                                        </div>

                                    </li>
                                </ul>
                            </li>
                            <li id='mnList_state2' class='has-sub' n='7' depth='2'>
                                <div class='li-wr'>
                                    <input type='hidden' name='code[]' value='state2' />
                                    <button type='button' class='is-folder'><span class='blind'>Sub
                                            Toggle</span></button>
                                    <span class='is-mntype mntype-m'></span>
                                    <p class='nm-wr'>
                                        <a href='http://test.gbbinc.co.kr/mng/state2' target='_blank'>
                                            <strong class='is-nm'>사원별 계약통계</strong>
                                            <span class='is-code'>state2</span>
                                        </a>
                                    </p>
                                    <p class='chk-wr'><span class='is-chk'><input type='checkbox' name='chk_use[]'
                                                id='chk_use_state2' value='state2' checked='checked'
                                                title='사용여부' /><label for='chk_use_state2'>USE</label></span><span
                                            class='is-chk'><input type='checkbox' name='chk_print_top[]'
                                                id='chk_tmn_state2' value='state2' title='상단메뉴로출력' /><label
                                                for='chk_tmn_state2'>TOP</label></span><span class='is-chk'><input
                                                type='checkbox' name='chk_print_left[]' id='chk_lm_state2' value='state2'
                                                checked='checked' title='왼쪽메뉴로출력' /><label
                                                for='chk_lm_state2'>LEFT</label></span><span class='is-chk'><input
                                                type='checkbox' name='chk_print_tab[]' id='chk_tab_state2' value='state2'
                                                title='탭메뉴로출력' /><label for='chk_tab_state2'>TAB</label></span></p>
                                    <p class='bt-wr'><button type="button" class="a-icbt ic-add"
                                            onclick="siteMenuCtrls.addMenu('S-0132000095');"><span
                                                class="blind">추가</span></button><button type="button"
                                            class="a-icbt ic-cfg" onclick="siteMenuCtrls.cfgMenu('S-0132000095');"><span
                                                class="blind">관리</span></button><button type="button"
                                            class="a-icbt ic-move" onclick="siteMenuCtrls.moveMenu('S-0132000095');"><span
                                                class="blind">이동</span></button><button type="button"
                                            class="a-icbt ic-del" onclick="siteMenuCtrls.delMenu('S-0132000095');"><span
                                                class="blind">삭제</span></button></p>
                                </div>
                                <ul class=' ' id='mnSubstate2'>
                                    <li id='mnList_saleStateSawon2' class='' n='1' depth='3'>
                                        <div class='li-wr'>
                                            <input type='hidden' name='code[]' value='saleStateSawon2' />
                                            <button type='button' class='is-folder'><span class='blind'>Sub
                                                    Toggle</span></button>
                                            <span class='is-mntype mntype-p'></span>
                                            <p class='nm-wr'>
                                                <a href='http://test.gbbinc.co.kr/mng/saleStateSawon2' target='_blank'>
                                                    <strong class='is-nm'>기간별</strong>
                                                    <span class='is-code'>saleStateSawon2</span>
                                                </a>
                                            </p>
                                            <p class='chk-wr'><span class='is-chk'><input type='checkbox'
                                                        name='chk_use[]' id='chk_use_saleStateSawon2'
                                                        value='saleStateSawon2' checked='checked' title='사용여부' /><label
                                                        for='chk_use_saleStateSawon2'>USE</label></span><span
                                                    class='is-chk'><input type='checkbox' name='chk_print_top[]'
                                                        id='chk_tmn_saleStateSawon2' value='saleStateSawon2'
                                                        title='상단메뉴로출력' /><label
                                                        for='chk_tmn_saleStateSawon2'>TOP</label></span><span
                                                    class='is-chk'><input type='checkbox' name='chk_print_left[]'
                                                        id='chk_lm_saleStateSawon2' value='saleStateSawon2'
                                                        title='왼쪽메뉴로출력' /><label
                                                        for='chk_lm_saleStateSawon2'>LEFT</label></span><span
                                                    class='is-chk'><input type='checkbox' name='chk_print_tab[]'
                                                        id='chk_tab_saleStateSawon2' value='saleStateSawon2'
                                                        checked='checked' title='탭메뉴로출력' /><label
                                                        for='chk_tab_saleStateSawon2'>TAB</label></span></p>
                                            <p class='bt-wr'><button type="button" class="a-icbt ic-add"
                                                    onclick="siteMenuCtrls.addMenu('S-0132000093');"><span
                                                        class="blind">추가</span></button><button type="button"
                                                    class="a-icbt ic-cfg"
                                                    onclick="siteMenuCtrls.cfgMenu('S-0132000093');"><span
                                                        class="blind">관리</span></button><button type="button"
                                                    class="a-icbt ic-move"
                                                    onclick="siteMenuCtrls.moveMenu('S-0132000093');"><span
                                                        class="blind">이동</span></button><button type="button"
                                                    class="a-icbt ic-del"
                                                    onclick="siteMenuCtrls.delMenu('S-0132000093');"><span
                                                        class="blind">삭제</span></button></p>
                                        </div>

                                    </li>
                                    <li id='mnList_saleStateSawonMonth2' class='' n='2'
                                        depth='3'>
                                        <div class='li-wr'>
                                            <input type='hidden' name='code[]' value='saleStateSawonMonth2' />
                                            <button type='button' class='is-folder'><span class='blind'>Sub
                                                    Toggle</span></button>
                                            <span class='is-mntype mntype-p'></span>
                                            <p class='nm-wr'>
                                                <a href='http://test.gbbinc.co.kr/mng/saleStateSawonMonth2'
                                                    target='_blank'>
                                                    <strong class='is-nm'>월별</strong>
                                                    <span class='is-code'>saleStateSawonMonth2</span>
                                                </a>
                                            </p>
                                            <p class='chk-wr'><span class='is-chk'><input type='checkbox'
                                                        name='chk_use[]' id='chk_use_saleStateSawonMonth2'
                                                        value='saleStateSawonMonth2' checked='checked'
                                                        title='사용여부' /><label
                                                        for='chk_use_saleStateSawonMonth2'>USE</label></span><span
                                                    class='is-chk'><input type='checkbox' name='chk_print_top[]'
                                                        id='chk_tmn_saleStateSawonMonth2' value='saleStateSawonMonth2'
                                                        title='상단메뉴로출력' /><label
                                                        for='chk_tmn_saleStateSawonMonth2'>TOP</label></span><span
                                                    class='is-chk'><input type='checkbox' name='chk_print_left[]'
                                                        id='chk_lm_saleStateSawonMonth2' value='saleStateSawonMonth2'
                                                        title='왼쪽메뉴로출력' /><label
                                                        for='chk_lm_saleStateSawonMonth2'>LEFT</label></span><span
                                                    class='is-chk'><input type='checkbox' name='chk_print_tab[]'
                                                        id='chk_tab_saleStateSawonMonth2' value='saleStateSawonMonth2'
                                                        checked='checked' title='탭메뉴로출력' /><label
                                                        for='chk_tab_saleStateSawonMonth2'>TAB</label></span></p>
                                            <p class='bt-wr'><button type="button" class="a-icbt ic-add"
                                                    onclick="siteMenuCtrls.addMenu('S-0132000097');"><span
                                                        class="blind">추가</span></button><button type="button"
                                                    class="a-icbt ic-cfg"
                                                    onclick="siteMenuCtrls.cfgMenu('S-0132000097');"><span
                                                        class="blind">관리</span></button><button type="button"
                                                    class="a-icbt ic-move"
                                                    onclick="siteMenuCtrls.moveMenu('S-0132000097');"><span
                                                        class="blind">이동</span></button><button type="button"
                                                    class="a-icbt ic-del"
                                                    onclick="siteMenuCtrls.delMenu('S-0132000097');"><span
                                                        class="blind">삭제</span></button></p>
                                        </div>

                                    </li>
                                </ul>
                            </li>
                            <li id='mnList_assignment' class='' n='8' depth='2'>
                                <div class='li-wr'>
                                    <input type='hidden' name='code[]' value='assignment' />
                                    <button type='button' class='is-folder'><span class='blind'>Sub
                                            Toggle</span></button>
                                    <span class='is-mntype mntype-p'></span>
                                    <p class='nm-wr'>
                                        <a href='http://test.gbbinc.co.kr/mng/assignment' target='_blank'>
                                            <strong class='is-nm'>사원 물건배정</strong>
                                            <span class='is-code'>assignment</span>
                                        </a>
                                    </p>
                                    <p class='chk-wr'><span class='is-chk'><input type='checkbox' name='chk_use[]'
                                                id='chk_use_assignment' value='assignment' checked='checked'
                                                title='사용여부' /><label for='chk_use_assignment'>USE</label></span><span
                                            class='is-chk'><input type='checkbox' name='chk_print_top[]'
                                                id='chk_tmn_assignment' value='assignment' title='상단메뉴로출력' /><label
                                                for='chk_tmn_assignment'>TOP</label></span><span class='is-chk'><input
                                                type='checkbox' name='chk_print_left[]' id='chk_lm_assignment'
                                                value='assignment' checked='checked' title='왼쪽메뉴로출력' /><label
                                                for='chk_lm_assignment'>LEFT</label></span><span class='is-chk'><input
                                                type='checkbox' name='chk_print_tab[]' id='chk_tab_assignment'
                                                value='assignment' title='탭메뉴로출력' /><label
                                                for='chk_tab_assignment'>TAB</label></span></p>
                                    <p class='bt-wr'><button type="button" class="a-icbt ic-add"
                                            onclick="siteMenuCtrls.addMenu('S-0132000090');"><span
                                                class="blind">추가</span></button><button type="button"
                                            class="a-icbt ic-cfg" onclick="siteMenuCtrls.cfgMenu('S-0132000090');"><span
                                                class="blind">관리</span></button><button type="button"
                                            class="a-icbt ic-move"
                                            onclick="siteMenuCtrls.moveMenu('S-0132000090');"><span
                                                class="blind">이동</span></button><button type="button"
                                            class="a-icbt ic-del" onclick="siteMenuCtrls.delMenu('S-0132000090');"><span
                                                class="blind">삭제</span></button></p>
                                </div>

                            </li>
                            <li id='mnList_mngTeam' class='' n='9' depth='2'>
                                <div class='li-wr'>
                                    <input type='hidden' name='code[]' value='mngTeam' />
                                    <button type='button' class='is-folder'><span class='blind'>Sub
                                            Toggle</span></button>
                                    <span class='is-mntype mntype-p'></span>
                                    <p class='nm-wr'>
                                        <a href='http://test.gbbinc.co.kr/mng/mngTeam' target='_blank'>
                                            <strong class='is-nm'>팀관리</strong>
                                            <span class='is-code'>mngTeam</span>
                                        </a>
                                    </p>
                                    <p class='chk-wr'><span class='is-chk'><input type='checkbox' name='chk_use[]'
                                                id='chk_use_mngTeam' value='mngTeam' checked='checked'
                                                title='사용여부' /><label for='chk_use_mngTeam'>USE</label></span><span
                                            class='is-chk'><input type='checkbox' name='chk_print_top[]'
                                                id='chk_tmn_mngTeam' value='mngTeam' title='상단메뉴로출력' /><label
                                                for='chk_tmn_mngTeam'>TOP</label></span><span class='is-chk'><input
                                                type='checkbox' name='chk_print_left[]' id='chk_lm_mngTeam'
                                                value='mngTeam' checked='checked' title='왼쪽메뉴로출력' /><label
                                                for='chk_lm_mngTeam'>LEFT</label></span><span class='is-chk'><input
                                                type='checkbox' name='chk_print_tab[]' id='chk_tab_mngTeam'
                                                value='mngTeam' title='탭메뉴로출력' /><label
                                                for='chk_tab_mngTeam'>TAB</label></span></p>
                                    <p class='bt-wr'><button type="button" class="a-icbt ic-add"
                                            onclick="siteMenuCtrls.addMenu('S-0132000102');"><span
                                                class="blind">추가</span></button><button type="button"
                                            class="a-icbt ic-cfg" onclick="siteMenuCtrls.cfgMenu('S-0132000102');"><span
                                                class="blind">관리</span></button><button type="button"
                                            class="a-icbt ic-move"
                                            onclick="siteMenuCtrls.moveMenu('S-0132000102');"><span
                                                class="blind">이동</span></button><button type="button"
                                            class="a-icbt ic-del" onclick="siteMenuCtrls.delMenu('S-0132000102');"><span
                                                class="blind">삭제</span></button></p>
                                </div>

                            </li>
                        </ul>
                    </form>
                </div>

                <div class="menu-sublist-f">
                    <!-- <button type="button" onclick="siteMenuCtrls.addMenu('S-0132000002');" class="bt-reg"><span class="cblue">하위메뉴<br/>등록</span></button> -->
                    <div class="chk-all-sel">
                        <!-- <span class='is-chk'><input type="checkbox"  id="chk2_use1" onclick="siteMenuCtrls.chk_printType(2,'use')" value="1" title="사용" /><label for="chk2_use">USE</label></span>
          <span class='is-chk'><input type="checkbox"  id="chk2_print_top1" onclick="siteMenuCtrls.chk_printType(2,'print_top')" value="1" title="사용" /><label for="chk2_print_top">TOP</label></span>
          <span class='is-chk'><input type="checkbox"  id="chk2_print_left1" onclick="siteMenuCtrls.chk_printType(2,'print_left')" value="1" title="사용" /><label for="chk2_print_left">LEFT</label></span>
          <span class='is-chk'><input type="checkbox"  id="chk2_print_tab1" onclick="siteMenuCtrls.chk_printType(2,'print_tab')" value="1" title="사용" /><label for="chk2_print_tab">TAB</label></span> -->
                    </div>
                    <div class="bt-wr fr">
                        <button type="button" onclick="siteMenuCtrls.menuOptEdit(2);" class=""><span
                                class=''>옵션수정</span></button>
                        <button type="button" onclick="siteMenuCtrls.menuSort(2);" class=""><span
                                class=''>순서저장</span></button>
                    </div>
                </div>


            </div>



        </div>
    </div>
    </div>


    <script>
        $(".menu-mlist").sortable();
        $(".menu-sublist ul").sortable({});
        $(".menu-sublist .is-folder").each(function() {
            $(this).click(function() {
                var $li = $(this).parent().parent();
                var hasSub = $(" > ul", $li).length;

                if (hasSub > 0) {
                    if ($li.hasClass("is-close")) {
                        $(" > ul", $li).slideDown("fast");
                        $li.removeClass("is-close");
                    } else {
                        $(" > ul", $li).slideUp("fast");
                        $li.addClass("is-close");
                    }

                }
            });
        });


        var mnLi = $(".menuListWrap2 .menuList2");
        mnLi.sortable({
            //	connectWith : ".menuListWrap2 .menuList2:first > li[depth='2']",
            placeholder: "ui-state-highlight"
        });

        //alert(mnLi.length);
    </script>


@endsection
