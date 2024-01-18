
<form action="{{ route('passwordConfrim') }}" method="POST" onsubmit="return defaultAjaxFormSubmit(this,successPWConfirm,failPWConfirm);">
    @csrf
    <input type="hidden" name="dataType" value="json">
  <div class="modal fade login_modal logmod" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <img src="/images/modal/modal_logo.png" alt="">
          <p>본인 확인을 위하여 비밀번호를 입력해주세요.</p>
        </div>
        <div class="modal-body">
            {{-- 메세지박스 --}}
            <div id="message-box"></div>
            <div class="ip_wr">
                <input class="form-control mb-0" id="password" name="password" placeholder="비밀번호를 입력하세요." maxlength="20" type="password" hname="비밀번호">
            </div>
            <button type="submit" class="btn btn-primary">확인</button>
            
        </div>
      </div>
    </div>
  </div>
  </form>
  
  <script>
    function successPWConfirm(r){
      

      console.log(r);
        if(r.result==true){
          location.href='{{ route('leave.done') }}';
        }else{
          $alertLoadingClose();
          sbAlert(r.message, 'warning');
        }

        return false;
    }
    function failPWConfirm(r){
      $alertLoadingClose();
        // alert(r.responseJSON['message']);
        // var msgBox = '<div class="ui_kit_message_box w-100">' +
        // '<div class="alert alart_style_four alert-dismissible fade show" role="alert">' + r.responseJSON['message'] +
        // '    <button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
        // '        <span aria-hidden="true">&times;</span>' +
        // '    </button>' +
        // '</div>' +
        // '</div>	';

        // $("#message-box").html(msgBox);
        
        sbAlert(r.responseJSON['message'], 'warning');
    }
  </script>