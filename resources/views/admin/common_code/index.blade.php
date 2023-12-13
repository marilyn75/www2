@extends('admin.layout.layout')

@section('page-title', '공통 코드 관리')

@section('page-comment', '사이트에 메뉴를 관리합니다.')

@section('content')

    <style>
        @charset "utf-8";

        .adm-commcode-wr {
            position: relative;
        }

        .adm-commcode-wr:after {
            clear: both;
            content: "";
            display: block;
        }

        .comm-cdgroups {
            position: absolute;
            left: 0;
            width: 360px;
            height: 500px;
            z-index: 150;
            top: 0px;
        }

        .comm-cd-list {
            margin-left: 400px;
            position: relative
        }

        .comm-cd-list .no-data {
            border-top: 2px solid #555;
            border-bottom: 1px solid #DDD;
            padding: 50px;
        }

        .tree-list-wr {
            font-size: 1em;
        }

        .tree-list-wr ul {}

        .tree-list-wr ul:after {
            clear: both;
            content: "";
            display: block;
        }

        .tree-list-wr li {
            position: relative;
            width: 100%;
            float: left;
        }

        .tree-list-wr li .tgl-btn {
            position: absolute;
            left: 0;
            top: 2px;
            width: 35px;
            height: 3em;
            border: 0;
            background: #CCC;
        }

        .tree-list-wr li .is-lf {
            position: absolute;
            left: 0;
            top: 2px;
            display: inline-block;
            width: 35px;
            height: 3em;
            background: #EAEAEA;
        }

        .tree-list-wr .li-wr {
            position: relative;
            display: block;
            box-sizing: border-box;
            padding: 0.5em 1em;
            height: 3em;
            line-height: 1.5em;
            position: relative;
            border: 1px solid #DDD;
            margin-top: 2px;
            margin-bottom: 2px;
            margin-left: 35px;
        }

        .tree-list-wr .li-wr:hover {
            background-color: #f9f9f9;
        }

        .tree-list-wr li ul {
            margin-left: 35px;
            position: relative;
        }

        .tree-list-wr .is-btns {
            position: absolute;
            right: 5px;
            top: 50%;
            margin-top: -10px;
            height: 20px;
        }
        
    </style>

    <script>

        function setTreeList($listwr){
            var $wr = $listwr;
            $("li",$wr).each(function(){
                if($("ul",this).length>0){
                    $(this).addClass("has-sub");
                    $(this).addClass("is-open");
                }else{
                    $(this).removeClass("has-sub");
                }

                $(" > .li-wr .is-handle button",this).bind("click",function(){

                    var $li = $(this).parent().parent().parent();

                    if($li.hasClass("has-sub")){
                        if($li.hasClass("is-open")){
                            $("ul",$li).slideUp("fast");
                            $li.removeClass("is-open");
                            $li.addClass("is-close");
                        }
                        else{
                            $("ul",$li).slideDown("fast");
                            $li.addClass("is-open");
                            $li.removeClass("is-close");
                        }
                    }
                });

            });
        }
        // 1차메뉴추가
        $(document).on('click', '#btnAddCode', function() {
            openWindow("{{ route('admin.codes.create') }}", 700, 500, 'addcode');
        });

        $(document).on('click', '.btnAddSubCode', function() {
            var id = $(this).data('id');
            openWindow("{{ route('admin.codes.create') }}/"+id, 700, 500, 'addcode');
        });

        // 수정하기
        $(document).on('click', '.btnEditCode', function(){
            var id = $(this).data('id');
            openWindow("{{ route('admin.codes.edit') }}/"+id, 700, 500, 'addcode');
        });  

        // 이동하기
        $(document).on('click', '.btnMoveCode', function(){
            var id = $(this).data('id');
            openWindow("{{ route('admin.codes.sort.edit') }}/"+id, 700, 500, 'addcode');
        });

        // 삭제하기
        $(document).on('click', '.btnDeleteCode', function(){
            var id = $(this).data('id');
            
            Swal.fire({
                title: '코드를 삭제 하시겠습니까?',
                text: '하위코드도 모두 삭제됩니다. 신중하세요.',
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
                        url : "{{ route('admin.codes.destroy') }}/" +id,
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

        // 코드순서저장
        $(document).on('click', '.btnSort', function(){
            frm.submit();
        });
    </script>

    <link rel="stylesheet" media="all" href="{{ url('css/admin-style.css') }}" />
    @include('include.messagebox')
    <div class="my_dashboard_review mb40">

        <div class="adm-commcode-wr">
            <div class="comm-cdgroups">

                <div class="sec-top">
                    <h4 class="a-tit02">공통코드 분류 목록</h4>
                    <div class="sec-top-scont">
                        <p>
                            <a href="#" id="btnAddCode" class="ssw-btn"><span>코드 그룹 등록하기</span></a>
                        </p>
                    </div>
                </div>


                <table width="100%" class="a-tbl-list">
                    <thead>
                        <tr>
                            <th width="60">코드</th>
                            <th>분류명</th>
                            <th width="110">관리</th>
                        </tr>
                    </thead>


                    @foreach ($parentCodes as $_code)
                    <tr>
                        <td class="b c2">{{ $_code->id }}</td>
                        <td><a href="{{ route('admin.codes', $_code->id) }}">{{ $_code->title }}</a></td>
			            <td>
				            <button type="button" class="a-sw-btn btnEditCode" data-id="{{ $_code->id }}"><span class="">수정</span></button>
                            <button type="button" class="a-sw-btn btnDeleteCode" data-id="{{ $_code->id }}"><span class="cred">삭제</span></button>
                        </td>
                    </tr>
                    @endforeach



                </table>

                <div class="sgap"></div>
                <div class="f12">
                    <span class="a-info-ex1">코드명을 클릭하시면 코드명 수정이 가능합니다.</span><br />
                    <span class="a-info-ex3">코드 삭제시에는 연동된 데이터가 있을경우 데이터 출력에 문제가 있을수 있으므로 주의해 주시기 바랍니다.</span><br />
                </div>




            </div>


            <div class="comm-cd-list">
                @if(empty($subCodes))
                <div class=''>분류명을 선택해 주시기 바랍니다.</div>
                @elseif (empty($subCodes))
                <div class='' style='padding:50px 0;'>등록된 코드 데이터가 없습니다.<br />코드 데이터를 등록해 주시기 바랍니다.<br />
                    <p class="pad10t"><a href=""
                            onclick="CommCodeCtrl.regCode('',''); return false;" class="a-sw-btn"><span>코드
                                등록하기</span></a></p>
                </div>
                @else
                <h4 class="a-tit02">{{ $currCode->title }}</h4>
                <div class="">
                    <button type="button" class="a-sp-btn btnAddSubCode" data-id="{{ $p_id }}"><span>코드 등록</span></button>
                    <button type="button" class="a-sp-btn btnSort" onclick=""><span>코드 순서 저장</span></button>
                </div>

                <form name="frm" action="{{ route('admin.codes.sort') }}" id="frmCommCodeDataList" method="post" onsubmit="return false">
                    @csrf
                    <input type="hidden" name="root" value="{{ $p_id }}">
                    <div class="cfg-category-list">
                        <x-CommonCodeItem :codeItems="$subCodes" />
                    </div>
                </form>
                <script>
                    $(document).ready(function() {
                        // $(".cfg-category-list ul").sortable({});
                        // setTreeList($('.cfg-category-list'));

                        $(".cfg-category-list ul").sortable();
                        $(".cfg-category-list .is-folder").each(function() {
                            $(this).click(function() {
                                var $li = $(this).parent().parent().parent();
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
                    });
                </script>

                @endif

            </div>



            


        </div>

    </div>




@endsection
