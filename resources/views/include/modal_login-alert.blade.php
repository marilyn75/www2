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


<script>
  // 모달 열기 버튼을 클릭했을 때 이벤트 처리
document.querySelector("#logalertModal").addEventListener("click", function() {
  // 배경을 어둡게 만들기 위한 요소 생성
  var backdrop = document.createElement("div");
  backdrop.classList.add("modal-backdrop");
  
  // 생성한 요소를 body에 추가
  document.body.appendChild(backdrop);
  
  // body에 "modal-open" 클래스 추가
  document.body.classList.add("modal-open");
});

// // 모달 닫기 버튼을 클릭했을 때 이벤트 처리
// document.querySelector("#logalertModal .close").addEventListener("click", function() {
//   // 배경 요소 제거
//   var backdrop = document.querySelector(".modal-backdrop");
//   backdrop.parentNode.removeChild(backdrop);
  
//   // body에서 "modal-open" 클래스 제거
//   document.body.classList.remove("modal-open");
// });

</script>