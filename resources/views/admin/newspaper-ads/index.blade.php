@extends('admin.layout.layout')

@section('page-title', ' 신문광고 관리')

@section('page-comment', ' 신문광고를 관리합니다.')

@section('content')
    
<script>
    $(document).ready(function(){
        var table = new DataTable('.table',{
            "ajax":"{{ route('admin.newspaper-ads.data') }}",
            "columns":[
                {"data":"id"},
                {"data":"news_txt"},
                {"data":"pub_date"},
                {"data": "formatted_created_at", "searchable" : false},
                {
                    "data": null,
                    "render": function(data, type, row) {
                        // 수정 및 삭제 버튼 생성 및 이벤트 핸들러 설정
                        return '<ul class="view_edit_delete_list mb0">' +
                               '    <li class="list-inline-item" data-toggle="tooltip" data-placement="top" title="수정"><a href="#" class="btn-edit" data-id="'+data.id+'"><span class="flaticon-edit"></span></a></li>' +
                               '    <li class="list-inline-item" data-toggle="tooltip" data-placement="top" title="삭제"><a href="#" class="btn-delete" data-id="'+data.id+'"><span class="flaticon-garbage"></span></a></li>' +
                               '</ul>';
                    },
                    "orderable": true,
                }
            ],
            processing: true,
            serverSide: true,
            //info:false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Korean.json",
            },
            order:[[0, 'desc']],
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
            var url = "{{ route('admin.newspaper-ads.edit') }}/" + id;
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
                        url : "{{ route('admin.newspaper-ads.destroy') }}" + "/"+id,
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

<div class="my_dashboard_review mb40">
    <div class="property_table">
        <div class="table-responsive mt0">

            <table class="table w100" id="tblList">
                <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">신문사</th>
                    <th scope="col">광고게재일</th>
                    <th scope="col">등록일시</th>
                    <th scope="col">관리</th>
                </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>

        </div>
    </div>
    <div class="pck_chng_btn text-right mt50">
        <a href="{{ route('admin.newspaper-ads.create') }}"><button class="btn btn-lg btn-thm">등록하기</button></a>
    </div>
</div>

@endsection