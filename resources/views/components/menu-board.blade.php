<div class="col-lg-12">
    @if(!$board_exist)
    @include('include.page-error')
@else

<script>
    
    $(document).ready(function(){
        var table = new DataTable('.table',{
            "ajax":"{{ route('board.data', $id) }}",
            "columns":[
                // {"data":"id"},
                {"data":"id", "visible":false},
                {
                    "data":"title",
                    "render": function(data, type, row) {
                        var htmlTitle = '<a href="' + docURL.url + '?mode=view&bid=' + row.id + '" class="btn-view">' + data + '</a>';
                        if(row.is_notice==1)    htmlTitle = '<span class="notice_bg">공지</span> ' + htmlTitle;
                        return htmlTitle;
                    }
                },
                {"data":"writer"},
                {
                    "data": "formatted_created_at", "searchable" : false,
                    "render": function(data, type, row) {
                    // 'formatted_created_at' 열을 수정하여 날짜만 표시하도록 변경
                    return row.formatted_created_at.split(' ')[0];
                },
            },
            ],
            processing: true,
            serverSide: true,
            lengthChange: false,
            ordering : false,
            searching : false,
            responsive: false,

            //info:false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Korean.json",
            },
            // order:[[0, 'desc']],

            "hover" : true,
            
        });
        
        $(".table")
        .on("click",".btn-view",function(){   // 게시물 보기 처리
            var url = this.href;
            //var params = "keyword=" + table.search() + "&page_size=" + table.page.len() + "&page=" + table.page.info().page;
            var params = {
                'keyword' : table.search(),
                'page_size' :  table.page.len(),
                'page' :  table.page.info().page,
            };
            //location.href = url + "?" + params;

            $.ajax({
                type: 'post',
                url : "{{ route('common.redirect-after-session') }}",
                data: {'_token': '{{ csrf_token() }}', 'url' : url, data: params},
                dataType: 'text', 
                success: function(r){
                    //작업이 성공적으로 발생했을 경우
                    location.href = r;
                },
                error:function(e){  
                    //에러가 났을 경우 실행시킬 코드
                    console.log(e);
                }
            });
            return false;
        })
        .on("click",".btn-edit",function(){     // 수정버튼 처리
            var id = $(this).data('id');
            var url = "{{ route('admin.board') }}/edit/" + id;
            //var params = "keyword=" + table.search() + "&page_size=" + table.page.len() + "&page=" + table.page.info().page;
            var params = {
                'keyword' : table.search(),
                'page_size' :  table.page.len(),
                'page' :  table.page.info().page,
            };
            //location.href = url + "?" + params;

            $.ajax({
                type: 'post',
                url : "{{ route('common.redirect-after-session') }}",
                data: {'_token': '{{ csrf_token() }}', 'url' : url, data: params},
                dataType: 'text', 
                success: function(r){
                    //작업이 성공적으로 발생했을 경우
                    location.href = r;
                },
                error:function(e){  
                    //에러가 났을 경우 실행시킬 코드
                    console.log(e);
                }
            });

            return false;
        })
        .on("click",".btn-delete",function(){   // 삭제버튼 처리
            var id = $(this).data('id');
            var pageNumber = table.page.info().page;
            Swal.fire({
                title: '삭제 하시겠습니까?',
                text: '삭제처리 후 복구가 불가합니다. 신중하세요.',
                icon: 'warning',
                
                showCancelButton: true, // cancel버튼 보이기. 기본은 원래 없음
                confirmButtonColor: '#385f8d', // confrim 버튼 색깔 지정
                cancelButtonColor: '#E93C3C', // cancel 버튼 색깔 지정
                confirmButtonText: '삭제', // confirm 버튼 텍스트 지정
                cancelButtonText: '취소', // cancel 버튼 텍스트 지정
                
                reverseButtons: true, // 버튼 순서 거꾸로
                
                })
                .then(result => {
                // 만약 Promise리턴을 받으면,
                if (result.isConfirmed) { // 만약 모달창에서 confirm 버튼을 눌렀다면
                    $.ajax({
                        type: 'post',
                        url : "{{ route('admin.board') }}" + "/delete/"+id,
                        data: {'_token': '{{ csrf_token() }}'},
                        dataType: 'json', 
                        success: function(r){
                            //작업이 성공적으로 발생했을 경우
                            if(r.result==true){
                                Swal.fire(r.message, '게시글이 삭제 되었습니다.', 'success');
                                // 데이터테이블 리로드
                                // table.ajax.reload(); // 데이터 테이블 다시 로드
                                table.page(pageNumber).draw(false);
                            }
                        },
                        error:function(e){  
                            //에러가 났을 경우 실행시킬 코드
                            console.log(e);
                        }
                    })
                }
            });
        });

        // 페이지가 렌더링된 후 이벤트
        table.one('draw.dt', function () {
            @if(!empty($condition))
            // 검색 키워드 설정
            table.search('{{ $condition['keyword'] }}') // 원하는 검색어를 지정합니다.
            // 페이지당 줄 수 설정
            table.page.len({{ $condition['page_size'] }}); // 원하는 페이지당 줄 수를 지정합니다.
            // 초기 페이지 설정
            table.page({{ $condition['page'] }}).draw('page'); // 2페이지는 0부터 시작하므로 1로 설정합니다.
            @endif
        });

        $(document).on("change", "#selBoardLink", function(){
            if(this.value!=""){
                location.href = "{{ route('admin.board') }}/" + this.value;
            }
        });
    });

    
</script>

<div class="my_dashboard_review mb40 mt20">
    <div class="property_table board_table">
        <div class="table-responsive mt0">

            <table class="table w100" id="tblList">
                <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">제목</th>
                    <th scope="col">작성자</th>
                    <th scope="col">날짜</th>
                </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>

        </div>
    </div>
    @auth
    @if(auth()->user()->is_admin)
    <div class="pck_chng_btn text-right mt50">
        <a href="{{ route('page', $page->id) }}?mode=write"><button class="btn btn-lg btn-thm">글쓰기</button></a>
    </div>
    @endif
    @endauth
</div>

@endif
</div>