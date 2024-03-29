@extends('admin.layout.layout')

@section('page-title', '회원 관리')

@section('page-comment', '회원데이터를 관리합니다.')

@section('content')

<script>
    $(document).ready(function(){
        var table = new DataTable('.table',{
            "ajax":"{{ route('admin.users.data') }}",
            "columns":[
                {"data":"id"},
                {"data":"name"},
                {"data":"email"},
                {"data": "formatted_created_at", "searchable" : false},
                {
                    "data": null,
                    "render": function(data, type, row) {
                        // 수정 및 삭제 버튼 생성 및 이벤트 핸들러 설정
                        return '<ul class="view_edit_delete_list mb0">' +
                            //    '    <li class="list-inline-item" data-toggle="tooltip" data-placement="top" title="View"><a href="#"><span class="flaticon-view"></span></a></li>' +
                               '    <li class="list-inline-item" data-toggle="tooltip" data-placement="top" title="Edit"><a href="#" class="btn-edit" data-id="'+data.id+'"><span class="flaticon-edit"></span></a></li>' +
                               '    <li class="list-inline-item" data-toggle="tooltip" data-placement="top" title="Delete"><a href="#" class="btn-delete" data-id="'+data.id+'"><span class="flaticon-garbage"></span></a></li>' +
                               '</ul>';
                    },
                    "orderable": false,
                }
            ],
            processing: true,
            serverSide: true,
            info:false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Korean.json",
            },
            order:[[0, 'desc']],
        });
        
        $(".table")
        .on("click",".btn-edit",function(){     // 수정버튼 처리
            var id = $(this).data('id');
            var url = "{{ route('admin.users') }}/edit/" + id;
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
                title: '탈퇴처리 하시겠습니까?',
                text: '탈퇴처리 후 복구가 불가합니다. 신중하세요.',
                icon: 'warning',
                
                showCancelButton: true, // cancel버튼 보이기. 기본은 원래 없음
                confirmButtonColor: '#385f8d', // confrim 버튼 색깔 지정
                cancelButtonColor: '#E93C3C', // cancel 버튼 색깔 지정
                confirmButtonText: '승인', // confirm 버튼 텍스트 지정
                cancelButtonText: '취소', // cancel 버튼 텍스트 지정
                
                reverseButtons: true, // 버튼 순서 거꾸로
                
                })
                .then(result => {
                // 만약 Promise리턴을 받으면,
                if (result.isConfirmed) { // 만약 모달창에서 confirm 버튼을 눌렀다면
                    $.ajax({
                        type: 'post',
                        url : "{{ route('admin.users') }}" + "/delete/"+id,
                        data: {'_token': '{{ csrf_token() }}'},
                        dataType: 'json', 
                        success: function(r){
                            //작업이 성공적으로 발생했을 경우
                            if(r.result==true){
                                Swal.fire(r.message, '화끈하시네요~!', 'success');
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

        // 페이지가 렌더링된 후 2페이지로 이동
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


    });
</script>

<div class="my_dashboard_review mb40">
    <div class="property_table">
        <div class="table-responsive mt0">

            <table class="table w100" id="tblList">
                <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">이름</th>
                    <th scope="col">이메일</th>
                    <th scope="col">등록일시</th>
                    <th scope="col">관리</th>
                </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>

        </div>
    </div>
</div>

@endsection