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




    </section>

{{-- 모달창 영역 --}}
<div class="modal-content" id="modal">
    {{-- AJAX로 로드된 컨텐츠가 여기 들어갑니다. --}}
</div>
<script>
// 모달창 호출 스크립트
$(document).ready(function() {
    $('.modal-button').click(function() {
        var url = $(this).data('url'); // 버튼의 데이터 속성에서 URL을 가져옵니다.
        
        $.ajax({
            url: '{{ route('modal.content') }}/'+url,
            type: 'GET',
            success: function(response) {
                $('#modal').html(response); // 모달의 내용을 업데이트합니다.
                $('#modal .modal').modal('show'); // 모달을 표시합니다.
            },
            error: function(error) {
                console.log(error);
            }
        });

        return false;
    });
});

</script>