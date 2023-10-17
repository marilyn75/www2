@extends('layout.layout-popup')

@section('page-title', '메뉴 이동')

@section('content')

@include('include.messagebox')

<script>
    $(document).on('click', '.btnList', function(){
        location.href="{{ route('admin.board-confs') }}";
        return false;
    });
</script>

<form action="{{ route('admin.menus.update', $id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="my_dashboard_review mb40">
        <div class="row">
            <div class="col-lg-6 col-xl-6">
                <div class="my_profile_setting_input form-group">
                    <label for="board_name">메뉴정보</label>
                    <div>[ {{ $menu->code }} ] {{ $menu->title }}</div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-6">
                <div class="my_profile_setting_input ui_kit_select_search form-group">
                    <label>현재경로</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $path }}">
                </div>
            </div>
            <div class="col-lg-6 col-xl-6">
                <div class="my_profile_setting_input ui_kit_select_search form-group">
                    <label>이동할 상위메뉴</label>
                    <div>
                        <select name="" id="">

                        </select>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>



</form>
@endsection