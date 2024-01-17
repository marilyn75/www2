
<form action="{{ route('login') }}" method="POST" onsubmit="return defaultAjaxFormSubmit(this,successLogin,failLogin);">
    @csrf
    <input type="hidden" name="dataType" value="json">
  <div class="modal fade login_modal logmod" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <img src="/images/modal/modal_logo.png" alt="">
          <p>부동산 투자의 안전한 시작</p>
        </div>
        <div class="modal-body">
            {{-- 메세지박스 --}}
            <div id="message-box"></div>
            <div class="ip_wr">
                <input type="email" class="form-control" id="email" name="email" placeholder="이메일을 입력해주세요" hname="이메일">
                <input class="form-control mb-0" id="password" name="password" placeholder="비밀번호를 입력하세요." maxlength="20" type="password" hname="비밀번호">
            </div>
            <button type="submit" class="btn btn-primary">로그인</button>
            <ul class="find_li">
                <li><a href="{{ route('findid') }}"><p>이메일 찾기</p></a></li>
                <li><a href="{{ route('findpw') }}"><p>비밀번호 찾기</p></a></li>
            </ul>
            <div class="social_mo">
                <div class="nav" style="cursor: pointer" onclick="location.href='{{ route('social.login','naver') }}';">
                    <img src="/images/sns/nav_log.png" alt="">
                    <p>네이버로 로그인</p>
                </div>
                <div class="kak" style="cursor: pointer" onclick="location.href='{{ route('social.login','kakao') }}';">
                    <img src="/images/sns/kak_log.png" alt="">
                    <p>카카오로 로그인</p>
                </div>
            </div>
            <a href="{{ route('agree') }}" class="signin_link">아직 계모임 아이디가 없으신가요? <span>회원가입 바로가기</span></a>
        </div>
      </div>
    </div>
  </div>
  </form>
  
  <script>
    function successLogin(r){

        document.location.reload();

        return false;
    }
    function failLogin(r){
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