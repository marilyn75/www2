@extends('layout.layout')

@section('content')

<!-- Our LogIn Register -->

<section class="our-log-reg bgc-fa log_sign_pd">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-6 offset-lg-3">
                <div class="sign_up_form inner_page sign_up_form_w">
                    <div class="heading log_sing_intro">
                        <h3>회원가입</h3>
                        <p>계정이 있으신가요?<a class="text-thm" href="{{ route('login') }}">로그인</a></p>
                    </div>
                    <div class="details">
                        @include('include.messagebox')
                        	
                        <form action="{{ url(route('register')) }}" method="POST">
                            @csrf
                            <input type="hidden" name="isCert" id="isCert" value="{{ old('isCert') }}">
                            <div class="form-group">
                                <input type="text" class="form-control" id="name" name="name" placeholder="사용자 이름" value="{{ old('name') }}">
                            </div>
                             <div class="form-group">
                                <input type="email" class="form-control" id="email" name="email" placeholder="이메일" value="{{ old('email') }}">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="비밀번호" >
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="비밀번호 확인" >
                            </div>
                            <div class="form-group phone_num_chk">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="휴대폰 번호를 입력하세요" value="{{ old('phone') }}" options="phone">
                                <span class="cert_btn"><button type="button" class="num_chk_btn" id="certRequestBtn">인증 요청</button></span>
                                {{-- 인증완료 시 --}}
                                {{-- <p class="finish_agr"><i class="ri-checkbox-circle-line"></i>인증완료</p> --}}
                            </div>
                            <div class="form-group phone_num_chk" id="divCertNumber">
                                <input type="text" class="form-control" id="confirm" name="confirm" placeholder="인증번호를 입력하세요." disabled maxlength="4">
                                <button type="button" class="num_chk_btn" id="certConfirmBtn">확인</button>
                            </div>
        
                            <button type="submit" class="btn btn-log btn-block btn-thm2">가입하기</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    var intervalId;

    $(document).on('click', '#certRequestBtn', function(){
        if($('#phone').val()==""){
            alert('휴대폰 번호를 입력하세요.');
            $('#phone').focus();
            return false;
        }

        // var phone = $('#phone').val().replace(/-/g,'');
        var phone = $('#phone').val();
        if(phone.length < 10){
            alert('휴대폰 번호를 정확히 입력하세요.');
            $('#phone').focus();
            return false;
        }

        $.post("{{ route('sendCertNum') }}", {
            _token: '{{ csrf_token() }}',
            phone:phone,
        })
        .done(function(res){
            res = JSON.parse(res);
            console.log(res);
            console.log(res.message);
            alert(res.message);
            if(res.result){
                clearInterval(intervalId);
                $('#certRequestBtn').html('인증 재요청');
                $('#phone').prop('readonly',true);
                $('#confirm').prop('disabled',false).focus();
                countdown(1);
            }
        });

        return false;
    });

    function countdown(mm){
        var timeLeft = mm * 60; // 분을 초 단위로 변환

        intervalId = setInterval(function() {
            if(timeLeft <= 0) {
                clearInterval(intervalId);
                $('#confirm').prop('placeholder', '시간이 만료되었습니다.');
                $('#phone').prop('readonly',false);
                $('#confirm').val('').prop('disabled',true);
            } else {
                var minutes = Math.floor(timeLeft / 60);
                var seconds = timeLeft % 60;
                $('#confirm').prop('placeholder', '인증번호를 입력하세요. [' + minutes + ':' + (seconds < 10 ? '0' : '') + seconds + ']');
                timeLeft--;
            }
        }, 1000);
    }

    $(document).on('click', '#certConfirmBtn', function(){
        var cert_number = $('#confirm').val();
        $.post("{{ route('confirmCertNum') }}", {
            _token: '{{ csrf_token() }}',
            cert_number:cert_number,
        })
        .done(function(res){
            res = JSON.parse(res);
            alert(res.message);
            if(res.result){
                certNumberOk();
            }else{
                $('#confirm').val('').focus();
            }
        });

        return false;
    });

    function certNumberOk(){
        $('#isCert').val('ok');
        $('#phone').prop('readonly',true);
        $('.cert_btn').html('<p class="finish_agr"><i class="ri-checkbox-circle-line"></i>인증완료</p>');
        $('#certRequestBtn').prop('disabled', true);
        $('#divCertNumber').remove();
    }

    $(document).ready(function(){
        if($('#isCert').val() == 'ok')  certNumberOk();
    });

    $(document).on('keypress', '#phone', function(e){
        var cert_number = $('#confirm').val();
        if(e.which == 13) { // 13은 엔터키의 코드입니다.
            $('#certRequestBtn').click();
            return false; // 이벤트 버블링을 방지합니다.
        }
    });

    $(document).on('keypress', '#confirm', function(e){
        var cert_number = $('#confirm').val();
        if(e.which == 13) { // 13은 엔터키의 코드입니다.
            $('#certConfirmBtn').click();
            return false; // 이벤트 버블링을 방지합니다.
        }
    });
</script>

@endsection

