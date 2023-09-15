@extends('admin.layout.layout')

@section('page-title', $board_name . ' 게시판 관리')

@section('page-comment', $board_name . ' 개시판을 관리합니다.')

@section('content')

@include('include.messagebox')

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

<script>
    $(document).ready(function(){
        tinymce.init({
            selector: '#content',
            mobile: {
                menubar: true
            },
            language: 'ko_KR',
            plugins: 'quickbars',
            quickbars_selection_toolbar: 'bold italic | blocks | quicklink blockquote',
            
        });
    });
    $(document).on('click', '.btnList', function(){
        location.href="{{ route('admin.board', $id) }}";
        return false;
    });
</script>

<form action="{{ route('admin.board.store',$id) }}" method="POST">
    @csrf
    <div class="my_dashboard_review mb40">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="mb30">글쓰기</h4>
                <div class="my_profile_setting_input form-group">
                    <label for="title">제목</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="my_profile_setting_textarea">
                    <label for="content">내용</label>
                    <textarea class="form-control" id="content" rows="7" name="content">{{ old('content') }}</textarea>
                </div>
            </div>
            
            <div class="col-xl-12">
                <div class="my_profile_setting_input">
                    <button class="btn btn1 float-left btnList">목록</button>
                    <button class="btn btn2 float-right">저장</button>
                </div>
            </div>
        </div>
    </div>



</form>
@endsection