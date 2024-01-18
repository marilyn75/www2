@extends('layout.layout')

@section('content')

<div class="container container_w">
    <section>
        <div class="heading log_sing_intro">
            <h3>회원탈퇴</h3>
        </div>
        <div class="found_inf mt40 mb80">
            <p>회원 계정</p>
                @if (auth()->user()->hasSocialAccounts()>0)
                    @foreach (auth()->user()->socialAccounts as $_account)
                    <div class="email_wrap">
                <img src="/images/sns/{{ $_account->provider_name }}_find.png" alt=""><h3 class="mont">{{ $_account->email }}</h3>
                    </div>
                    @endforeach
                @else
                <h3 class="mont">{{ auth()->user()->email }}</h3>
                @endif
            
        </div>
        {{-- 메세지박스 --}}
        <div id="message-box"></div>
        <h4>유의사항</h4>
        <div class="agree_bx mt20 mb40">
            <p>
                회원탈퇴 시 개인정보 및 GYEMOIM INC . 에서 만들어진 모든 데이터는 삭제됩니다.
            </p>
            <ul>
                <li>-. 회원탈퇴 처리 후에는 회원님의 개인정보를 복원할 수 없으며, 탈퇴한 이메일은 탈퇴한 일로부터 5일동안 재가입이 불가능합니다.</li>
                <li>-. 사이트에 등록된 회원정보, 이용정보 등 모든 내용이 삭제되며, 삭제된 데이터는 복구되지 않습니다.</li>
            </ul>
        </div>
        {{-- <div class="agree_bx mt20 mb40">
            <p>
                회원탈퇴 시 개인정보 및 GYEMOIM INC . 에서 만들어진 모든 데이터는 삭제됩니다.
                <br>(단, 아래 항목은 표기된 법률에 따라 특정 기간 동안 보관됩니다.)
            </p>
            <ul>
                <li><span>1.</span> 항목 1번</li>
                <li><span>2.</span> 항목 2번</li>
                <li><span>3.</span> 항목 3번</li>
            </ul>
        </div> --}}

        {{-- 유의사항 --}}
        
        {{-- <div class="agree_bx mt20 mb40">
            <ul>
                <li>- 회원탈퇴 처리 후에는 회원님의 개인정보를 복원할 수 없으며, 탈퇴한 이메일은 탈퇴한 일로부터 5일동안 재가입이 불가능합니다.</li>
                <li>- 사이트에 등록된 회원정보, 이용정보 등 모든 내용이 삭제되며, 삭제된 데이터는 복구되지 않습니다.</li>
            </ul>
        </div> --}}
        <form action="{{ route('leave') }}" method='post' onsubmit='return defaultAjaxFormSubmit(this,successLeave,failLeave)'>
            @csrf
            <input type="hidden" name="dataType" value="json">
        <div class="form-group custom-control custom-checkbox agree_bx mb40">
            <input type="checkbox" class="custom-control-input" id="leave_check" name="leavechk" value="1">
            <label class="custom-control-label" for="leave_check">
                해당 내용을 모두 확인했으며, 회원탈퇴에 동의합니다.
            </label>
        </div>

        <div class="col-xl-12 text-center">
            <div class="my_profile_setting_input">
                <button class="btn btn2">탈퇴하기</button>
            </div>
        </div>
        </form>
    </section>
</div>
<script>
    function successLeave(r){
        console.log('success');
        console.log(r);
        

        // $('.modal-button').click();
        if(r.result=='true' || r.result==true){
            location.href='{{ route('leave.done') }}';
        }else{
            
            $alertLoadingClose();
            showModal('modal.password');
        }
    }
    function failLeave(r){
        console.log('fail');
        // alert(r.responseJSON['message']);
        var msgBox = '<div class="ui_kit_message_box w-100">' +
        '<div class="alert alart_style_four alert-dismissible fade show" role="alert">' + r.responseJSON['message'] +
        '    <button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
        '        <span aria-hidden="true">&times;</span>' +
        '    </button>' +
        '</div>' +
        '</div>	';

        $("#message-box").html(msgBox);
        $alertLoadingClose();
    }
</script>
@endsection