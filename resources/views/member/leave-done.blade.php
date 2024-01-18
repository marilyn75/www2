@extends('layout.layout')

@section('content')

<div class="container container_w">
    <section>
        <div class="leave_finish_wrap">
            <img src="/images/member_leave.png" alt="">
            <h2>회원탈퇴 완료</h2>
            <p>GYEMOIM INC. 회원탈퇴 신청이 완료되었습니다.</p>
            <button class="btn btn2" onclick="location.href='{{ route('main') }}';">홈</button>
        </div>
    </section>
</div>

@endsection