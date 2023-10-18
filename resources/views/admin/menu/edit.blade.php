@extends('layout.layout-popup')

@section('page-title', '메뉴 수정')

@section('content')

@include('admin.menu.script')

@include('include.messagebox')

<form action="{{ route('admin.menus.update', $id) }}" method="POST" enctype="multipart/form-data">
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
                    <input type="text" class="form-control" id="title" name="title" value="{{ $menu->title }}">
                </div>
            </div>
            <div class="col-lg-6 col-xl-6">
                <div class="my_profile_setting_input ui_kit_select_search form-group">
                    <label>메뉴코드</label>
                    <input type="text" class="form-control" id="code" name="code" value="{{ $menu->code }}">
                </div>
            </div>
            <div class="col-lg-12 col-xl-12">
                <div class="my_profile_setting_input form-group">
                    <label for="file_num">상단이미지</label><br>
                    <div class="wrap-custom-file menu">
                        <input type="file" name="top_image" id="image1" accept=".gif, .jpg, .jpeg, .png" value="" />
                        <label  for="image1" style="background-image: url('{{ asset('files/menu/'.$menu->top_image) }}');background-size: 768px 200px;">
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
                            <input id="type_M" name="type" type="radio" value="M" @if($menu->type=='M') checked @endif>
                            <label for="type_M"><span class="radio-label"></span> 단순메뉴</label>
                        </div>&nbsp;&nbsp;&nbsp;
                        <div class="radio">
                            <input id="type_C" name="type" type="radio" value="C" @if($menu->type=='C') checked @endif>
                            <label for="type_C"><span class="radio-label"></span> 컨텐츠</label>
                        </div>&nbsp;&nbsp;&nbsp;
                        <div class="radio">
                            <input id="type_B" name="type" type="radio" value="B" @if($menu->type=='B') checked @endif>
                            <label for="type_B"><span class="radio-label"></span> 게시판</label>
                        </div>&nbsp;&nbsp;&nbsp;
                        <div class="radio">
                            <input id="type_L" name="type" type="radio" value="L" @if($menu->type=='L') checked @endif>
                            <label for="type_L"><span class="radio-label"></span> 링크</label>
                        </div>&nbsp;&nbsp;&nbsp;
                        <div class="radio">
                            <input id="type_W" name="type" type="radio" value="W" @if($menu->type=='W') checked @endif>
                            <label for="type_W"><span class="radio-label"></span> 준비중</label>
                        </div>&nbsp;&nbsp;&nbsp;
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-xl-6 @if($menu->type!='L') d-none @endif type-addInput" id="addInputL">
                <div class="my_profile_setting_input form-group">
                    <label for="file_total_size">링크 URL</label>
                    <input type="text" class="form-control" id="url" name="url" value="{{ $menu->url }}">
                </div>
            </div>

            <div class="col-lg-6 col-xl-6 @if($menu->type!='C') d-none @endif type-addInput" id="addInputC">
                <div class="my_profile_setting_input form-group">
                    <label for="file_total_size">컨텐츠 내용</label>
                    <textarea class="form-control" id="content" rows="7" name="content">@if(!empty($menu->content)) {{ $menu->content->content }} @endif</textarea>
                </div>
            </div>

            <div class="col-lg-6 col-xl-6 @if($menu->type!='B') d-none @endif type-addInput" id="addInputB">
                <div class="my_profile_setting_input form-group">
                    <label for="board_id">연결게시판</label>
                    <div>
                    <select name="board_id" id="board_id">
                        <option value="">게시판을 선택하세요.</option>
                        @foreach ($board as $_bd)
                        <option value="{{ $_bd->id }}" @if ($menu->board_id==$_bd->id) selected @endif>{{ $_bd->board_name }}</option>
                        @endforeach
                    </select>
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