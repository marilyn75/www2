@extends('admin.layout.layout')

@section('page-title', '메뉴 관리')

@section('page-comment', '사이트 메뉴를 관리합니다.')

@section('content')

    <link rel="stylesheet" media="all" href="{{ url('css/admin-menu.css') }}" />
    @include('include.messagebox')
    <div class="my_dashboard_review mb40">

    <div class="siteMnCtrlsWrap">
        <div class="mn-mnlist">

            <div class="sec-top">
                <h3 class="a-tit02">1차 메뉴</h3>
            </div>


            <div class="menu-mlist-f">
                <button type="button" class="bt-reg" id="btnAddMenu"><span class="ic-reg"></span><span
                        class="">메뉴추가</span></button>
                <div class="chk-all-sel">
                    <span class='is-chk'>
                        <input type="checkbox" id="chk1_use" value="1" title="사용" /><label for="chk1_use">USE</label>
                    </span>
                    <span class='is-chk'>
                        <input type="checkbox" id="chk1_print_top" onclick="siteMenuCtrls.chk_printType(1,'print_top')" value="1" title="탑메뉴" /><label for="chk1_print_top">TOP</label>
                    </span>
                </div>
                <div class="bt-wr fr">
                    <button type="button" onclick="frmMenuList1.submit()" class=""><span
                            class=''>옵션<br />수정</span></button>
                    <button type="button" onclick="siteMenuCtrls.menuSort(1);" class=""><span
                            class=''>순서<br />저장</span></button>
                </div>
            </div>

            <form name="frmMenuList1" id="frmMenuList1" method="post" action="{{ route('admin.menus.option') }}">
                @csrf
                <input type="hidden" name="gubun" value="left">
                <input type="hidden" name="root" value="{{ $p_id }}">

                <ul class="menu-list menu-mlist">
                @foreach ($parentMenus as $_menu)
                    <li>
                        <input type="hidden" name="mn_code[]" value="Setting" />
                        <div class="li-wr">
                            <span class="is-mntype mntype-{{ strtolower($_menu->type) }}"></span>

                            <p class="nm-wr">
                                <strong class="is-nm"><a
                                        href="{{ route('admin.menus',[$p_id, $_menu->id]) }}">{{ $_menu->title }}</a></strong>
                                <span class="is-code">Setting</span>
                            </p>

                            <p class="chk-wr">

                                <span class="is-chk "><input type="checkbox" name="chk_use[]" value="{{ $_menu->id }}"
                                    @if($_menu->is_use==1) checked @endif /></span>
                                <span class="is-chk "><input type="checkbox" name="chk_print_top[]" value="Setting"
                                        checked='checked' /></span>
                            </p>

                            <p class="bt-wr">
                                <button type="button" class="a-icbt ic-cfg btnEditMenu" data-id="{{ $_menu->id }}">
                                    <span class="blind">관리</span>
                                </button>

                                <button class="a-icbt ic-move btnMoveMenu" type="button" data-id="{{ $_menu->id }}">
                                    <span class="blind">이동</span>
                                </button>

                                <button class="a-icbt ic-del btnDeleteMenu" type="button" data-id="{{ $_menu->id }}">
                                    <span class="blind">삭제</span>
                                </button>
                            </p>
                        </div>


                    </li>
                @endforeach
                </ul>
            </form>

            <div class="sgap"></div>
            <p class="f12  a-info-ex2"> 마우스로 드래그하여 이동하신 후 <strong>[순서 저장]</strong> 버튼을 클릭하시면 순서를 변경하실 수 있습니다.</p>


        </div>


        <div class="mn-sublist">

            <div class="sec-top">
            @if (empty($c_id))
                <h3 class="a-tit02">하위메뉴 <span class="nb f11 cg3"></span></h3>
            @else
                <h3 class="a-tit02">{{ $currMenu->title }} <span class="nb f11 cg3"> / {{ $currMenu->code }}</span></h3>
            @endif
            </div>


            <div class="menulist-wr">

                <div class="menu-sublist-f">
                @if (!empty($currMenu))
                    <button type="button" class="bt-reg btnAddSubMenu" data-id="{{ $currMenu->id }}"><span
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
                @endif
                    
                </div>




                <div class="menu-list menu-sublist">
                @if (empty($c_id))
                    <div style="padding:50px 0px 50px 0px;border-bottom:1px solid #DDD" class="text-center">1차 메뉴를 선택하세요 </div>
                @elseif ($subMenus->count() == 0)
                    <div style="padding:50px 0px 50px 0px;border-bottom:1px solid #DDD" class="text-center">하위메뉴를 추가하세요. </div>
                @else
                    <form name="frmMenuList2" id="frmMenuList2" method="post" action="{{ route('admin.menus.sort') }}" >
                        @csrf
                        <input type="hidden" name="root" value="{{ $c_id }}">
   
                        <x-MenuItem :menuItems="$subMenus" />
                        
                    </form>
                @endif
                    
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
                        <button type="button" onclick="frmMenuList2.action='{{ route('admin.menus.option') }}';frmMenuList2.submit()" class=""><span
                                class=''>옵션수정</span></button>
                        <button type="button" onclick="frmMenuList2.submit()" class=""><span
                                class=''>순서저장</span></button>
                    </div>
                </div>


            </div>



        </div>
    </div>
    </div>


    <script>
        $(".menu-mlist").sortable();
        $(".menu-sublist ul").sortable();
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

        $(document).on('click', '#chk1_use', function(){
            $("input[name='chk_use[]']",$(".menu-mlist")).attr('checked', this.checked);
        });

        $(document).on('click', '#chk2_use', function(){
            $("input[name='chk_use[]']",$(".menu-sublist")).attr('checked', this.checked);
        });

        // 1차메뉴추가
        $(document).on('click', '#btnAddMenu', function(){
            openWindow("{{ route('admin.menus.create', $p_id) }}", 900, 1000, 'addmenu');
        });
        @if (!empty($c_id))
        // 2차메뉴추가
        $(document).on('click', '.btnAddSubMenu', function(){
            var id = $(this).data('id');
            openWindow("{{ route('admin.menus.create') }}/"+id, 900, 1000, 'addmenu');
        });    
        @endif

        // 수정하기
        $(document).on('click', '.btnEditMenu', function(){
            var id = $(this).data('id');
            openWindow("{{ route('admin.menus.edit') }}/"+id, 900, 1000, 'addmenu');
        });  

        // 이동하기
        $(document).on('click', '.btnMoveMenu', function(){
            var id = $(this).data('id');
            openWindow("{{ route('admin.menus.sort.edit') }}/"+id, 900, 1000, 'addmenu');
        });

        // 삭제하기
        $(document).on('click', '.btnDeleteMenu', function(){
            var id = $(this).data('id');
            
            Swal.fire({
                title: '메뉴를 삭제 하시겠습니까?',
                text: '하위메뉴도 모두 삭제됩니다. 신중하세요.',
                icon: 'warning',
                
                showCancelButton: true, // cancel버튼 보이기. 기본은 원래 없음
                confirmButtonColor: '#3085d6', // confrim 버튼 색깔 지정
                cancelButtonColor: '#d33', // cancel 버튼 색깔 지정
                confirmButtonText: '삭제', // confirm 버튼 텍스트 지정
                cancelButtonText: '취소', // cancel 버튼 텍스트 지정
                
                reverseButtons: true, // 버튼 순서 거꾸로
                
                })
                .then(result => {
                // 만약 Promise리턴을 받으면,
                if (result.isConfirmed) { // 만약 모달창에서 confirm 버튼을 눌렀다면
                    $.ajax({
                        type: 'post',
                        url : "{{ route('admin.menus.destroy') }}/" +id,
                        data: {'_token': '{{ csrf_token() }}'},
                        dataType: 'json', 
                        success: function(r){
                            //작업이 성공적으로 발생했을 경우
                            if(r.result==true){
                                Swal.fire(r.message, '메뉴가 삭제 되었습니다.', 'success');
                                // 데이터테이블 리로드
                                // table.ajax.reload(); // 데이터 테이블 다시 로드
                                location.reload();
                            }
                        },
                        error:function(e){  
                            //에러가 났을 경우 실행시킬 코드
                            console.log(e);
                        }
                    })
                }
            });
        });  
    </script>


@endsection
