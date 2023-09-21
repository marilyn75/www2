@extends('admin.layout.layout')

@section('page-title', $board_name . ' 게시판 관리')

@section('page-comment', $board_name . ' 개시판을 관리합니다.')

@section('content')

@include('include.messagebox')

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script type="text/javascript" src="/js/common.fileuploadForm.js"></script>

<script>
    var fileUploader;

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

        fileUploader = $("#multiFileUpload").formuploader({
            debug : false
            , post_parameters : [ 
                { name : "module" , value : "board" } ,
                { name : "board_conf_id" , value : "{{ $conf->id }}" } ,
                { name : "file_ss_id" , value : $('#ss_id').val() } 
            ]
            ,limit_max_file_cnt : {{ $conf->file_num }}
            ,limit_file_size: {{ $conf->file_size }}
            ,limit_max_file_size: {{ $conf->file_total_size }}
            ,org_file_items:[
                <?=@implode(",",$data->_multifile);?>
            ]
            ,upload_complete_func:function(){
                //업로드 전체 완료 후 실행처리
                boardFormSubmit();
            }
            ,auto_upload:true
            ,tmp_file_down_url:function(r){
                console.log(r);
                // var url = this.download_url;
                // var param = "";
                // param +="&file_ss_id=" + $('#ss_id').val();
                // param +="&fid=" + r.fileId;
                // var downurl =  url + "?" + param;
                // return downurl;
                return r.fileDownUrl;

            }
            ,to_content:false
            ,to_content_func:function(source){

                if(this.viewContMsg!=true) {
                    this.viewContMsg = true;
                    $alert("파일 경로는 게시물 저장시 변경될 수 있으므로 경로를 임의로 변경할 경우 출력되지 않을 수 있으니 유의해주시기 바랍니다.",{"btn":true,"h":180});
                }

                if(editor_type=="mceEditor"){
                    var toEditor = tinymce.activeEditor || $("#b_content").tinymce();
                    toEditor.execCommand("mceInsertContent",false,source);
                }else if(editor_type=="crossEditor"){
                    var toEditor = getCrossEditorNum("b_content");
                    toEditor.InsertValue(1, source);
                }
            }
            
        });
    });
    
    $(document).on('click', '.btnCancel', function(){
        location.href="{{ route('admin.board.show', $id) }}";
        return false;
    });
</script>

<form action="{{ route('admin.board.update',$id) }}" method="POST">
    @csrf
    <div class="my_dashboard_review mb40">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="mb30">수정</h4>
                <div class="my_profile_setting_input form-group">
                    <label for="title">제목</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $data->title }}">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="my_profile_setting_textarea">
                    <label for="content">내용</label>
                    <textarea class="form-control" id="content" rows="7" name="content">{{ $data->content }}</textarea>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="my_profile_setting_textarea">
                    <label for="content">파일</label>
                    <div id="multiFileUpload" style="" class="multiFileUpload">
                    <input type="hidden" name="ss_id" id="ss_id" @if(empty(old('ss_id'))) value="{{ $ss_id }}" @else value="{{ old('ss_id') }}" @endif>
                </div>
            </div>
            
            <div class="col-xl-12">
                <div class="my_profile_setting_input">
                    <button class="btn btn1 float-left btnCancel">취소</button>
                    <button class="btn btn2 float-right">수정</button>
                </div>
            </div>
        </div>
    </div>



</form>

@endsection