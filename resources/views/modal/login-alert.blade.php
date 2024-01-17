<div class="modal fade login_modal" id="logalertModal" tabindex="-1" aria-labelledby="logalertModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <img src="/images/modal/modal_log.png" alt="">
        </div>
        <div class="modal-body">
          <h3>로그인이 필요한 서비스입니다</h3>
          <p>로그인 후 더 다양한<br>
            서비스를 이용해보세요!</p>
        </div>
        <div class="modal-footer">
            {{-- 로그인 링크로 이동 --}}
          <button type="button" class="btn btn-primary" onclick="location.href='{{ route('login') }}';">로그인</button>
        </div>
      </div>
    </div>
  </div>
  
  
