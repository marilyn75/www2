@extends('admin.layout.layout')

@section('page-title', '게시판 권한 관리')

@section('page-comment', '개시판의 권한을 설정 관리합니다.')

@section('content')

<script>
    $(document).on('click', '.btnList', function(){
        location.href="{{ route('admin.board-confs') }}";
        return false;
    });
</script>

@include('include.messagebox')

<form action="{{ route('admin.board-confs.permission.save', $id) }}" method="POST">
    @csrf
<div class="my_dashboard_review mb40">
    <div class="property_table">
        <div class="table-responsive mt0">

            <table class="table-striped w100 text-center" id="tblList">
                <thead class="thead-light">
                <tr>
                    <th scope="col" rowspan="2">구분</th>
                    <th scope="col" rowspan="2">쓰기</th>
                    <th scope="col" rowspan="2">목록</th>
                    <th scope="col" colspan="2">읽기</th>
                    <th scope="col" colspan="2">수정</th>
                    <th scope="col" colspan="2">삭제</th>
                    <th scope="col" rowspan="2">댓글쓰기</th>
                    <th scope="col" colspan="2">댓글읽기</th>
                    <th scope="col" colspan="2">댓글수정</th>
                    <th scope="col" colspan="2">댓글삭제</th>
                    <th scope="col" rowspan="2">파일업로드</th>
                    <th scope="col" rowspan="2">파일다운로드</th>
                </tr>
                <tr>
                    <th scope="col">일반</th>
                    <th scope="col">비밀글</th>
                    <th scope="col">본인글</th>
                    <th scope="col">전체글</th>
                    <th scope="col">본인글</th>
                    <th scope="col">전체글</th>
                    <th scope="col">일반</th>
                    <th scope="col">비밀글</th>
                    <th scope="col">본인글</th>
                    <th scope="col">전체글</th>
                    <th scope="col">본인글</th>
                    <th scope="col">전체글</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($roles as $_role)
                    <tr>
                        <th>
                            {{ $_role->name }}
                            <input type="hidden" name="role[]" value="{{ $_role->name }}">
                        </th>
                        @foreach ($columns as $_column)
                        <td>
                            <input type="checkbox" name="{{ $_column }}_chk[]" onchange="$(this).next().val(Number(this.checked))" @if (!empty($data) && intval($data[$_role->name][$_column])==1) checked @endif>
                            <input type="hidden" name="{{ $_column }}[]" value="@if (!empty($data)) {{ intval($data[$_role->name][$_column]) }} @endif">
                        </td>
                        @endforeach
                    </tr>
                @endforeach
                    <tr>
                        <th>Guest<input type="hidden" name="role[]" value="Guest"></th>
                        @foreach ($columns as $_column)
                        <td>
                            <input type="checkbox" name="{{ $_column }}_chk[]" onchange="$(this).next().val(Number(this.checked))" @if (!empty($data) && intval($data['Guest'][$_column])==1) checked @endif>
                            <input type="hidden" name="{{ $_column }}[]" value="@if (!empty($data)) {{ intval($data['Guest'][$_column]) }} @endif">
                        </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
            
        </div>
    </div>
    <div class="pck_chng_btn text-right mt50">
        <button class="btn btn1 float-left btnList">목록</button>
        <button class="btn btn2 btn-thm">권한설정저장</button>
    </div>
</div>
</form>

@endsection