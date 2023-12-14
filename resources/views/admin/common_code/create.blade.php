@extends('layout.layout-popup')

@section('page-title', '메뉴 생성')

@section('content')

@include('admin.menu.script')

@include('include.messagebox')

@if (empty($code))
<script>
    $(document).ready(function(){
        frm.title.focus();
    });
</script>
<form name="frm" action="{{ route('admin.codes.store', $id) }}" method="POST">
@else
<form name="frm" action="{{ route('admin.codes.update', $id) }}" method="POST">
@endif
    @csrf
    <div class="my_dashboard_review mb40">
        <div class="row">
            <div class="col-lg-6 col-xl-6">
                <div class="my_profile_setting_input form-group">
                    <label for="board_name">상위코드</label>
                    <input type="text" class="form-control" id="locate" name="locate" value="{{ $path }}" readonly>
                </div>
            </div>
            <div class="col-lg-6 col-xl-6">
                <div class="my_profile_setting_input ui_kit_select_search form-group">
                    <label>코드명</label>
                    <input type="text" class="form-control" id="title" name="title" value="@if (empty($code)){{ old('title') }}@else{{ $code->title }}@endif">
                </div>
            </div>
            <div class="col-lg-6 col-xl-6">
                <div class="my_profile_setting_input ui_kit_select_search form-group">
                    <label>여분필드 (class)</label>
                    <input type="text" class="form-control" id="class" name="class" value="@if (empty($code)){{ old('class') }}@else{{ $code->class }}@endif">
                </div>
            </div>
            
            <div class="col-lg-6 col-xl-6">
                <div class="my_profile_setting_input ui_kit_select_search form-group" id="mntype">
                    <label>사용여부</label>
                    <div class="ui_kit_radiobox">
                        <div class="radio">
                            <input id="is_use1" name="is_use" type="radio" value="1" @if(empty($code) || $code->is_use==1) checked @endif>
                            <label for="is_use1"><span class="radio-label"></span> 사용함</label>
                        </div>&nbsp;&nbsp;&nbsp;
                        <div class="radio">
                            <input id="is_use0" name="is_use" type="radio" value="0" @if(!empty($code) && $code->is_use==0) checked @endif>
                            <label for="is_use0"><span class="radio-label"></span> 사용안함</label>
                        </div>&nbsp;&nbsp;&nbsp;
                    </div>
                </div>
            </div>
            
            
            
            <div class="col-xl-12">
                <div class="my_profile_setting_input">
                    {{-- <button class="btn btn1 float-left btnList">목록</button> --}}
                    <button class="btn btn2 float-right">저장</button>
                </div>
            </div>
        </div>
    </div>



</form>
@endsection
