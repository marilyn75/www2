<script>

    $(document).on('click', '.btnList', function(){
        location.href=docURL.url;
        return false;
    });

    $(document).on('click', '.btnEdit', function(){
        location.href="{{ route('admin.board.edit', $data->id) }}";
        return false;
    });

    $(document).on('click', '.btnDelete', function(){
        Swal.fire({
            title: '삭제 하시겠습니까?',
            text: '삭제처리 후 복구가 불가합니다. 신중하세요.',
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
                    url : "{{ route('admin.board.destroy', $data->id) }}",
                    data: {'_token': '{{ csrf_token() }}'},
                    async: false,
                    dataType: 'json', 
                    success: function(r){
                        location.href="{{ route('admin.board', $data->board_id) }}";
                        // //작업이 성공적으로 발생했을 경우
                        // if(r.result==true){
                        //     Swal.fire(r.message, '게시글이 삭제 되었습니다.', 'success')
                        //     .then((result) => {
                        //         if (result.isConfirmed) {
                        //             // 목록으로 이동
                        //             location.href="{{ route('admin.board', $data->board_id) }}";
                        //         }
                        //     });
                            
                        // }
                    },
                    error:function(e){  
                        //에러가 났을 경우 실행시킬 코드
                        console.log(e);
                    }
                })
                
            }
        });
    });
</script>

@include('include.messagebox')


    <div class="my_dashboard_review mb40 w-100">
        <div class="row">
            <div class="col-lg-12">
                <div class="main_blog_post_content">
                    <div class="mbp_thumb_post">
                        {{-- <div class="blog_sp_tag"><a href="#">Construction</a></div> --}}
                        <h3 class="blog_sp_title">{{ $data->title }}</h3>
                        <ul class="blog_sp_post_meta">
                            <li class="list-inline-item"><a href="#"><img src="{{ $data->photo }}" width="40" height="40"></a></li>
                            <li class="list-inline-item"><a href="#">{{ $data->writer }}</a></li>
                            <li class="list-inline-item"><span class="flaticon-calendar"></span></li>
                            <li class="list-inline-item"><a href="#">{{ $data->created_at }}</a></li>
                            <li class="list-inline-item"><span class="flaticon-view"></span></li>
                            <li class="list-inline-item"><a href="#"> {{ number_format($data->hits) }} views</a></li>
                            {{-- <li class="list-inline-item"><span class="flaticon-chat"></span></li>
                            <li class="list-inline-item"><a href="#">15</a></li> --}}
                        </ul>
                        {{-- <div class="thumb">
                            <img class="img-fluid" src="images/blog/bs1.jpg" alt="bs1.jpg">
                        </div> --}}
                        @if(!empty($data->attachFiles))
                        <div class="board-winfo-listcont">
                            <ul class="board-view-filelist">
                                @foreach ($data->attachFiles as $file)
                                <li>
                                    <a href="{{ route('admin.board.filedownload', $file->id) }}" target="_blank">
                                        <span>
                                            <img src="{{ fileIcon($file->filename_org) }}" alt="hwp 파일" org_width="19" org_height="23" isinit="true"> {{ $file->filename_org }} ({{ formatBytes($file->filesize) }})
                                        </span>
                                    </a>
                                </li>
                                @endforeach												
                            </ul>
                        </div>    
                        @endempty
                        
                        <div class="details">
                            {!! $data->content !!}
                            {{-- <p class="mb30">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis et sem sed sollicitudin. Donec non odio neque. Aliquam hendrerit sollicitudin purus, quis rutrum mi accumsan nec. Quisque bibendum orci ac nibh facilisis, at malesuada orci congue. Nullam tempus sollicitudin cursus. Ut et adipiscing erat. Curabitur this is a text link libero tempus congue.</p>
                            <p class="mb30">Duis mattis laoreet neque, et ornare neque sollicitudin at. Proin sagittis dolor sed mi elementum pretium. Donec et justo ante. Vivamus egestas sodales est, eu rhoncus urna semper eu. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Integer tristique elit lobortis purus bibendum, quis dictum metus mattis. Phasellus posuere felis sed eros porttitor mattis. Curabitur massa magna, tempor in blandit id, porta in ligula. Aliquam laoreet nisl massa, at interdum mauris sollicitudin et.</p>
                            <h4 class="mb15">Housing Markets That Changed the Most This Decade</h4>
                            <p>Nullam tempus sollicitudin cursus. Nulla elit mauris, volutpat eu varius malesuada, pulvinar eu ligula. Ut et adipiscing erat. Curabitur adipiscing erat vel libero tempus congue. Nam pharetra interdum vestibulum. Aenean gravida mi non aliquet porttitor. Praesent dapibus, nisi a faucibus tincidunt, quam dolor condimentum metus, in convallis libero ligula ut eros.</p>
                            <div class="mbp_blockquote">
                                <div class="blockquote">
                                    <span class="font-italic"><i class="fa fa-quote-left"></i></span><br>
                                    <em class="mb-0">Duis mollis et sem sed sollicitudin. Donec non odio neque. Aliquam hendrerit sollicitudin purus, quis rutrum mi accumsan nec.</em>
                                </div>
                            </div>
                            <p class="mb25">Curabitur massa magna, tempor in blandit id, porta in ligula. Aliquam laoreet nisl massa, at interdum mauris sollicitudin et. Mauris risus lectus, tristique at nisl at, pharetra tristique enim.</p>
                            <p class="mb25">Nullam this is a link nibh facilisis, at malesuada orci congue. Nullam tempus sollicitudin cursus. Nulla elit mauris, volutpat eu varius malesuada, pulvinar eu ligula. Ut et adipiscing erat. Curabitur adipiscing erat vel libero tempus congue. Nam pharetra interdum vestibulum. Aenean gravida mi non aliquet porttitor. Praesent dapibus, nisi a faucibus tincidunt, quam dolor condimentum metus, in convallis libero ligula ut eros.</p> --}}
                        </div>
                        
                    </div>
                    <div class="mbp_pagination_tab">
                        <div class="row">
                            <div class="col-sm-6 col-lg-6">
                                @if (!empty($data->previousPost))
                                <div class="pag_prev">
                                    <a href="#n" onclick="document.location.href=docURL.url+'?mode=view&bid={{ $data->previousPost->id }}'"><span class="flaticon-back"></span></a>
                                    <div class="detls"><h5>이전글</h5> <p> {{ $data->previousPost->title }}</p></div>
                                </div>
                                @endif
                            </div>
                            <div class="col-sm-6 col-lg-6">
                                @if (!empty($data->nextPost))
                                <div class="pag_next text-right">
                                    <a href="#n" onclick="document.location.href=docURL.url+'?mode=view&bid={{ $data->nextPost->id }}'"><span class="flaticon-next"></span></a>
                                    <div class="detls"><h5>다음글</h5> <p> {{ $data->nextPost->title }}</p></div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
         

                </div>
            </div>
        </div>
        <div class="col-xl-12 text-right">
            <div class="my_profile_setting_input float-left fn-520">
                <button class="btn btn1 btnList">목록</button>
            </div>
            <div class="my_profile_setting_input">
                {{-- <button class="btn btn2 btnEdit">수정</button>
                <button class="btn btn3 btnDelete">삭제</button> --}}
            </div>
        </div>
    </div>