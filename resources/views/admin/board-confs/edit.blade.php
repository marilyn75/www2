@extends('admin.layout.layout')

@section('page-title', '게시판 설정 관리')

@section('page-comment', '개시판을 생성 및 설정 관리합니다.')

@section('content')

@include('include.messagebox')

<script>
    $(document).on('click', '.btnList', function(){
        location.href="{{ route('admin.board-confs') }}";
        return false;
    });
</script>

<form action="{{ route('admin.board-confs.update') }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ $data->id }}">
    <div class="my_dashboard_review mb40">
        <div class="row">
            <div class="col-lg-6 col-xl-6">
                <div class="my_profile_setting_input form-group">
                    <label for="board_name">게시판명</label>
                    <input type="text" class="form-control" id="board_name" name="board_name" value="{{ $data->board_name }}">
                </div>
            </div>
            <div class="col-lg-6 col-xl-6">
                <div class="my_profile_setting_input ui_kit_select_search form-group">
                    <label>게시판 유형</label>
                    <select name="skin" class="selectpicker" data-live-search="false" data-width="100%">
                        <option data-tokens="board" value="board" @if($data->skin=='board') selected @endif>일반 게시판</option>
                        <option data-tokens="gallery" value="gallery" @if($data->skin=='gallery') selected @endif>갤러리형 게시판</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6 col-xl-6">
                <div class="my_profile_setting_input ui_kit_select_search form-group">
                    <label>댓글 사용옵션</label>
                    <select name="use_comment" class="selectpicker" data-live-search="false" data-width="100%">
                        <option data-tokens="0" value="0" @if($data->use_comment=='0') selected @endif>사용안함</option>
                        <option data-tokens="1" value="1" @if($data->use_comment=='1') selected @endif>사용함</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6 col-xl-6">
                <div class="my_profile_setting_input ui_kit_select_search form-group">
                    <label>비밀글 사용옵션</label>
                    <select name="use_secret" class="selectpicker" data-live-search="false" data-width="100%">
                        <option data-tokens="0" value="0" @if($data->use_secret=='0') selected @endif>사용안함</option>
                        <option data-tokens="1" value="1" @if($data->use_secret=='1') selected @endif>사용자가 선택 등록</option>
                        <option data-tokens="2" value="2" @if($data->use_secret=='2') selected @endif>무조건 비밀글 등록</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6 col-xl-6">
                <div class="my_profile_setting_input form-group">
                    <label for="file_num">업로드 파일 갯수</label>
                    <input type="number" class="form-control" id="file_num" name="file_num" value="{{ $data->file_num }}">
                </div>
            </div>
            <div class="col-lg-6 col-xl-6">
                <div class="my_profile_setting_input form-group">
                    <label for="file_type">업로드 파일 확장자</label>
                    <input type="text" class="form-control" id="file_type" name="file_type" value="{{ $data->file_type }}">
                </div>
            </div>
            <div class="col-lg-6 col-xl-6">
                <div class="my_profile_setting_input form-group">
                    <label for="file_size">업로드 파일 개별용량제한</label>
                    <input type="number" class="form-control" id="file_size" name="file_size" value="{{ $data->file_size }}">
                </div>
            </div>
            <div class="col-lg-6 col-xl-6">
                <div class="my_profile_setting_input form-group">
                    <label for="file_total_size">업로드 파일 전체용량제한</label>
                    <input type="number" class="form-control" id="file_total_size" name="file_total_size" value="{{ $data->file_total_size }}">
                </div>
            </div>
            
            <div class="col-xl-12">
                <div class="my_profile_setting_input">
                    <button class="btn btn1 float-left btnList">목록</button>
                    <button class="btn btn2 float-right">수정</button>
                </div>
            </div>
        </div>
    </div>



</form>
@endsection