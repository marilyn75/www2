@extends('admin.layout.layout')

@section('page-title', ' 게시판 관리')

@section('page-comment', ' 개시판을 관리합니다.')

@section('content')

@include('include.messagebox')

<script type="text/javascript" src="/js/common.fileuploadForm.js"></script>

<script>
    $(document).on('change', '#news_code', function(){
        var txt = this.options[this.selectedIndex].text;

        if(this.selectedIndex > 0){
            frm.news_txt.value = txt;
        }else{
            frm.news_txt.value = "";
        }

    });

    $(document).on('click', '.btnList', function(){
        location.href="{{ route('admin.newspaper-ads') }}";
        return false;
    });
</script>

<form name="frm" action="{{ $conf['action'] }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="my_dashboard_review mb40"><h4 class="mb30">신문광고 등록하기</h4>
        <div class="row">
            
            <div class="col-lg-6">
                <div class="my_profile_setting_input form-group">
                    <label for="title">신문사</label>
                    <select name="news_code" id="news_code" class="form-control">
                        <option value="">선택하세요.</option>
                        @php
                            echo makeOptions($conf['cate'], $data['news_code']);
                        @endphp
                    </select>
                    <input type="hidden" name="news_txt" value="{{ $data['news_txt'] }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="my_profile_setting_textarea">
                    <label for="content">게재일</label>
                    <input type="date" class="form-control w-50" name="pub_date" id="pub_date" value="{{ $data['pub_date'] }}" max="9999-12-31">
                </div>
            </div>

            <div class="col-lg-12">
                <div class="my_profile_setting_textarea">
                    <label for="content">파일</label>
                    @if(!empty($data['file']['filename_org']))
                    <div>
                        <a href="{{ route('common.file.view', $data['file']['id']) }}" target="_blank">{{ $data['file']['filename_org'] }}</a>
                    </div>
                    @endif
                    <input type="file" name="file" id="file" class="form-control">
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