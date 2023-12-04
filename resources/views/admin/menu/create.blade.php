@extends('layout.layout-popup')

@section('page-title', '메뉴 생성')

@section('content')

@include('admin.menu.script')

@include('include.messagebox')

@if (empty($menu))
<form action="{{ route('admin.menus.store', $id) }}" method="POST" enctype="multipart/form-data">
@else
<form action="{{ route('admin.menus.update', $id) }}" method="POST" enctype="multipart/form-data">
@endif
    @csrf
    <div class="my_dashboard_review mb40">
        <div class="row">
            <div class="col-lg-6 col-xl-6">
                <div class="my_profile_setting_input form-group">
                    <label for="board_name">메뉴경로</label>
                    <input type="text" class="form-control" id="locate" name="locate" value="{{ $path }}" readonly>
                </div>
            </div>
            <div class="col-lg-6 col-xl-6">
                <div class="my_profile_setting_input ui_kit_select_search form-group">
                    <label>메뉴명</label>
                    <input type="text" class="form-control" id="title" name="title" value="@if (empty($menu)){{ old('title') }}@else{{ $menu->title }}@endif">
                </div>
            </div>
            <div class="col-lg-6 col-xl-6">
                <div class="my_profile_setting_input ui_kit_select_search form-group">
                    <label>메뉴코드</label>
                    <input type="text" class="form-control" id="code" name="code" value="@if (empty($menu)){{ old('code') }}@else{{ $menu->code }}@endif">
                </div>
            </div>
            <div class="col-lg-12 col-xl-12">
                <div class="my_profile_setting_input form-group">
                    <label for="file_num">상단이미지</label><br>
                    <div class="wrap-custom-file menu">
                        <input type="file" name="top_image" id="image1" accept=".gif, .jpg, .jpeg, .png" value="" />
                        <label  for="image1" style="background-image: url('@if (!empty($menu)){{ asset('files/menu/'.$menu->top_image) }}@endif');background-size: 768px 200px;">
                                <span><i class="flaticon-download"></i> Upload Photo </span>
                        </label>
                    </div>
                    <p>*minimum 1920px x 500px</p>
                </div>
            </div>
            <div class="col-lg-6 col-xl-6">
                <div class="my_profile_setting_input ui_kit_select_search form-group" id="mntype">
                    <label>메뉴유형</label>
                    <div class="ui_kit_radiobox">
                        <div class="radio">
                            <input id="type_M" name="type" type="radio" value="M" @if(empty($menu) || $menu->type=='M') checked @endif>
                            <label for="type_M"><span class="radio-label"></span> 단순메뉴</label>
                        </div>&nbsp;&nbsp;&nbsp;
                        <div class="radio">
                            <input id="type_C" name="type" type="radio" value="C" @if(!empty($menu) && $menu->type=='C') checked @endif>
                            <label for="type_C"><span class="radio-label"></span> 컨텐츠</label>
                        </div>&nbsp;&nbsp;&nbsp;
                        <div class="radio">
                            <input id="type_B" name="type" type="radio" value="B" @if(!empty($menu) && $menu->type=='B') checked @endif>
                            <label for="type_B"><span class="radio-label"></span> 게시판</label>
                        </div>&nbsp;&nbsp;&nbsp;
                        <div class="radio">
                            <input id="type_P" name="type" type="radio" value="P" @if(!empty($menu) && $menu->type=='P') checked @endif>
                            <label for="type_P"><span class="radio-label"></span> 프로그램</label>
                        </div>&nbsp;&nbsp;&nbsp;
                        <div class="radio">
                            <input id="type_L" name="type" type="radio" value="L" @if(!empty($menu) && $menu->type=='L') checked @endif>
                            <label for="type_L"><span class="radio-label"></span> 링크</label>
                        </div>&nbsp;&nbsp;&nbsp;
                        <div class="radio">
                            <input id="type_W" name="type" type="radio" value="W" @if(!empty($menu) && $menu->type=='W') checked @endif>
                            <label for="type_W"><span class="radio-label"></span> 준비중</label>
                        </div>&nbsp;&nbsp;&nbsp;
                    </div>
                </div>
            </div>
            
            {{-- <div class="col-lg-6 col-xl-6">
                <div class="my_profile_setting_input form-group">
                    <label for="file_type">연결게시판</label>
                    <input type="text" class="form-control" id="file_type" name="file_type">
                </div>
            </div>
            <div class="col-lg-6 col-xl-6">
                <div class="my_profile_setting_input form-group">
                    <label for="file_size">연결컨텐츠</label>
                    <input type="number" class="form-control" id="file_size" name="file_size" value="2097152">
                </div>
            </div> --}}
            <div class="col-lg-6 col-xl-6 @if(empty($menu) || $menu->type!='L') d-none @endif type-addInput" id="addInputL">
                <div class="my_profile_setting_input form-group">
                    <label for="file_total_size">링크 URL</label>
                    <input type="text" class="form-control" id="url" name="url" value="@if(empty($menu)){{ old('url') }}@else{{ $menu->url }}@endif">
                </div>
            </div>

            <div class="col-lg-6 col-xl-6 @if(empty($menu) || $menu->type!='C') d-none @endif type-addInput" id="addInputC">
                <div class="my_profile_setting_input form-group">
                    <label for="file_total_size">컨텐츠 내용</label>
                    <textarea class="form-control" id="content" rows="7" name="content">@if(empty($menu->content)){{ old('content') }}@else{{ $menu->content->content }}@endif</textarea>
                </div>
            </div>

            <div class="col-lg-6 col-xl-6 @if(empty($menu) || $menu->type!='B') d-none @endif type-addInput" id="addInputB">
                <div class="my_profile_setting_input form-group">
                    <input type="radio" name="board_type" id="board_type1" value="board" @if(empty($menu) || !empty($menu->board_id)) checked @endif  onclick="$('.board_opt').hide();$('#board_id_sel').show();">
                    <label for="board_type1">게시판연결</label>

                    <input type="radio" name="board_type" id="board_type2" value="rss" onclick="$('.board_opt').hide();$('#board_rss').show();">
                    <label for="board_type2">RSS연결</label>

                    <div class="board_opt" id="board_id_sel">
                    <select name="board_id" id="board_id">
                        <option value="">게시판을 선택하세요.</option>
                        @foreach ($board as $_bd)
                        <option value="{{ $_bd->id }}" @if (!empty($menu) && $menu->board_id==$_bd->id) selected @endif>{{ $_bd->board_name }}</option>
                        @endforeach
                    </select>
                    </div>

                    <div class="board_opt" id="board_rss" style="display: none;">
                        <input type="text" class="form-control" id="rss_url" name="rss_url" value="@if(empty($menu)){{ old('rss_url') }}@else{{ $menu->rss_url }}@endif" placeholder="RSS 주소를 입력하세요.">
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-xl-6 @if(empty($menu) || $menu->type!='P') d-none @endif type-addInput" id="addInputP">
                <div class="my_profile_setting_input form-group">
                    <label for="program_module">연결모듈</label>
                    <div>
                    <select name="program_module" id="program_module">
                        <option value="">모듈을 선택하세요.</option>
                        @foreach ($module as $_mdl)
                        <option value="{{ $_mdl }}" @if (!empty($menu) && $menu->program_module==$_mdl) selected @endif>{{ $_mdl }}</option>
                        @endforeach
                    </select>
                    </div>

                    <label for="program_module">파라메터</label>
                    <div>
                    <input type="text" name="params" id="params" class="w100" value="@if(empty($menu)){{ old('params') }}@else{{ $menu->params }}@endif">
                    </div>
                </div>
            </div>

            {{-- <div class="col-lg-6 col-xl-6">
                <div class="my_profile_setting_input form-group">
                    <label for="file_total_size">링크 TARGET</label>
                    <input type="number" class="form-control" id="file_total_size" name="file_total_size" value="83886080">
                </div>
            </div> --}}
            
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