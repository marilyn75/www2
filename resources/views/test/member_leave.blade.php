@extends('layout.layout')

@section('content')

<div class="container container_w">
    <section>
        <div class="heading log_sing_intro">
            <h3>회원탈퇴</h3>
        </div>
        <div class="agree_bx mt20 mb40">
            <p>
                회원탈퇴 시 개인정보 및 GYEMOIM INC . 에서 만들어진 모든 데이터는 삭제됩니다.
                <br>(단, 아래 항목은 표기된 법률에 따라 특정 기간 동안 보관됩니다.)
            </p>
            <ul>
                <li><span>1.</span> 항목 1번</li>
                <li><span>2.</span> 항목 2번</li>
                <li><span>3.</span> 항목 3번</li>
            </ul>
        </div>

        {{-- 유의사항 --}}
        <h4>유의사항</h4>
        <div class="agree_bx mt20 mb40">
            <ul>
                <li>- 회원탈퇴 처리 후에는 회원님의 개인정보를 복원할 수 없으며, 회원탈퇴 진행 시 아이디는 영구적으로 삭제되어 재가입이 불가합니다.</li>
                <li>- 소속된 회사가 존재할 경우, '탈퇴' 회원으로 조회됩니다.</li>
            </ul>
        </div>
        <div class="form-group custom-control custom-checkbox agree_bx mb40">
            <input type="checkbox" class="custom-control-input" id="leave_check" name="leavechk" value="4">
            <label class="custom-control-label" for="leave_check">
                해당 내용을 모두 확인했으며, 회원탈퇴에 동의합니다.
            </label>
        </div>
    </section>
</div>

@endsection