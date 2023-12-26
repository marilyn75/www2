@extends('layout.layout-popup')

@section('page-title', '메뉴 이동')

@section('content')

@include('include.messagebox')

<script>
    var totMenu = JSON.parse('{!! $totMenu->toTree()->toJson() !!}');
    var currMenu = JSON.parse('{!! $currMenu->toTree()->toJson() !!}');

    $(document).ready(function(){
        initSelect();

        @foreach ($currMenu as $i=>$mnu)
            @if($mnu->id > 2 && $i<count($currMenu)-1)
            $("select[name='menu[]']:last").val({{ $mnu->id }}).change();
            @endif
        @endforeach
    });

    $(document).on('click', '.btnList', function(){
        location.href="{{ route('admin.board-confs') }}";
        return false;
    });

    $(document).on('change', "select[name='menu[]']", function(){
        

        var depth = $(this).data('depth');
        var id = this.value * 1;

        $("select[name='menu[]']:gt("+(depth - 1)+")").remove();

        if(this.value==frm.id.value){
            alert("선택하신 메뉴로는 이동하실 수 없습니다.\n다시 선택해 주시기 바랍니다.");
            this.value='';
            return false;
        }else{
            let parent_id = this.value;

            if(!parent_id && $("select[name='menu[]']").length > 1){
                parent_id = $(this).prev().val();
            }
            frm.parentId.value = parent_id;
        }

        if(id){
            
            var searchMnu = totMenu;
            
            $("select[name='menu[]']").each(function(){
                var searchId = this.value;
                searchMnu.forEach(function(sMnu){
                    console.log(sMnu.id,id,sMnu.id==searchId);
                    if(sMnu.id==searchId){
                        searchMnu=sMnu.children;
                    }
                });
            });

            if(searchMnu.length > 0)   makeSelect(searchMnu);
        }
    });

    function findChildMenu(searchMnu, id){
        searchMnu.forEach(function(sMnu){
            console.log(sMnu.id,id,sMnu.id==id);
            if(sMnu.id==id){
                alert(sMnu.id);
                searchMnu=sMnu.children;
            }
        });
        return searchMnu;
    }

    function initSelect(){
        makeSelect(totMenu);
        // let mnu = currMenu[0];
        // do {
        //     mnu = mnu.children[0];
        //     makeSelect(mnu);
        //     console.log(mnu.title);
        // } while(mnu.children[0].children[0]);
    }

    function makeSelect(menu){
        var cnt = $("select[name='menu[]']").length + 1;
        var html = '<select name="menu[]" data-depth="'+cnt+'" class="menu">';
        if(cnt==1)
            html += '<option value="{{ $root_id }}">--'+cnt+'차 메뉴--</option>';
        else
            html += '<option value="">--'+cnt+'차 메뉴--</option>';
        
        menu.forEach(function(mn){
            html += '<option value="'+mn.id+'">'+mn.title+'</option>';
        });
        html += '</select>';
        $("#divMenuSelect").append(html);
    }
    
</script>

<form name="frm" action="{{ route('admin.menus.sort.update', $id) }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ $id }}">
    <input type="hidden" name="parentId" value="" hname="상위메뉴" frequired='required'>
    <div class="my_dashboard_review mb40">
        <div class="row">
            <div class="col-lg-6 col-xl-6">
                <div class="my_profile_setting_input form-group">
                    <label for="board_name">메뉴정보</label>
                    <div>[ {{ $currMenu->find($id)->code }} ] {{ $currMenu->find($id)->title }}</div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-6">
                <div class="my_profile_setting_input ui_kit_select_search form-group">
                    <label>현재경로</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $path }}" readonly>
                </div>
            </div>
            <div class="col-lg-6 col-xl-6">
                <div class="my_profile_setting_input ui_kit_select_search form-group">
                    <label>이동할 상위메뉴</label>
                    <div id="divMenuSelect">

                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>


    <div class="col-xl-12">
        <div class="my_profile_setting_input">
            {{-- <button class="btn btn1 float-left btnList">목록</button> --}}
            <button class="btn btn2 float-right">저장</button>
        </div>
    </div>
</form>
@endsection