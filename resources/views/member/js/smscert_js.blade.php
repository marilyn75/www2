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

        var chkDup = true;
        if($(this).closest('form').attr('action')=='{{ route('findpw') }}') chkDup = false;

        $.post("{{ route('sendCertNum') }}", {
            _token: '{{ csrf_token() }}',
            phone:phone,
            chkDup:chkDup,
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