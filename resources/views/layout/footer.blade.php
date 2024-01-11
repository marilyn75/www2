<section class="footer_one home5 footer_w">
        <div class="container container_w">
            <div>
                <div class="home5 footer_about_w">
                    <div class="foot_agr">
                        <a href="{{ route('page',39) }}">이용약관</a>
                        <a href="{{ route('page',40) }}">개인정보처리방침</a>
                    </div>
                    <p>주식회사 계모임 대표 송대훈</p>
                    <p>부산 연제구 중앙대로 1091, 6F (연산동, 제세빌딩)</p>
                    <div class="footer_info">
                        <p class="mont">051-791-8888</p>
                        <p class="mont">gyemoim.inc@gmail.com</p>
                    </div>
                    <div class="footer_info ftnum">
                        <p>사업자등록번호 846-87-00746</p>
                    </div>
                </div>
                <div class="footer_copy mt35">
                    <p>ⓒ GYEMOIM INC. ALL RIGHTS RESERVED.</p>
                </div>
            </div>
        </div>

{{-- 로그인 알림 모달 --}}
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#logalertModal">
    로그인 알림 모달
  </button>
  
  <!-- Modal -->
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
          <button type="button" class="btn btn-primary">로그인</button>
        </div>
      </div>
    </div>
  </div>
{{-- 로그인 알림 모달 끝 --}}


{{-- 로그인 모달 --}}
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">
    로그인 모달
  </button>
  
  <!-- Modal -->
  <div class="modal fade login_modal logmod" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <img src="/images/modal/modal_logo.png" alt="">
          <p>부동산 투자의 안전한 시작</p>
        </div>
        <div class="modal-body">
            <div class="ip_wr">
                <input class="form-control" id="" placeholder="아이디를 입력하세요." maxlength="15" type="text">
                <input class="form-control mb-0" id="" placeholder="비밀번호를 입력하세요." maxlength="20" type="password">
                <div id="login_gc_result" class="input_info invalid-feedback d-none">
                    <span><i class="ri-information-fill"></i> <span id="login_gc_result_msg">아이디 또는 패스워드가 일치하지 않습니다</span></span>
                </div>
            </div>
            <button type="button" class="btn btn-primary">로그인</button>
            <ul class="find_li">
                <li><a href="/find_id"><p>아이디 찾기</p></a></li>
                <li><a href="/find_pwd"><p>비밀번호 찾기</p></a></li>
            </ul>
            <div class="social_mo">
                <div class="nav">
                    <img src="/images/sns/nav_log.png" alt="">
                    <p>네이버로 로그인</p>
                </div>
                <div class="kak">
                    <img src="/images/sns/kak_log.png" alt="">
                    <p>카카오로 로그인</p>
                </div>
            </div>
            <a href="/signin" class="signin_link">아직 계모임 아이디가 없으신가요? <span>회원가입 바로가기</span></a>
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

// 모달 닫기 버튼을 클릭했을 때 이벤트 처리
document.querySelector("#logalertModal .close").addEventListener("click", function() {
    // 배경 요소 제거
    var backdrop = document.querySelector(".modal-backdrop");
    backdrop.parentNode.removeChild(backdrop);
    
    // body에서 "modal-open" 클래스 제거
    document.body.classList.remove("modal-open");
});

  </script>
{{-- 로그인 모달 끝 --}}



    </section>