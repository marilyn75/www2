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
  @include('include.modal_login-alert') 
{{-- 로그인 알림 모달 끝 --}}


{{-- 로그인 모달 --}}
  @include('include.modal_login')
  
{{-- 로그인 모달 끝 --}}



    </section>