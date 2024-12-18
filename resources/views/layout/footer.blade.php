<section class="footer_one home5 footer_w">
        <div class="container container_w">
            <div>
                <div class="home5 footer_about_w">
                    <div class="foot_agr">
                        {{-- <a href="{{ route('page',39) }}">이용약관</a> --}}
                        <a href="#" class="btn flaticon-user login_head modal-button" id="a-login" data-url="modal.usedetail">이용약관</a>
                        <a href="#" class="btn flaticon-user login_head modal-button" id="a-login" data-url="modal.privacy">개인정보처리방침</a>
                        {{-- <a href="{{ route('page',40) }}">개인정보처리방침</a> --}}
                    </div>
                    <p>NTO PARTNERS INC.</p>
                    <p>부산 동래구 충렬대로 152, 4F (온천동)</p>
                    <div class="footer_info">
                        <p class="mont">051-791-8888</p>
                        <p class="mont">gyemoim.inc@gmail.com</p>
                    </div>
                    <div class="footer_info ftnum">
                        <p>사업자등록번호 846-87-00746</p>
                    </div>
                </div>
                <div class="footer_copy mt35">
                    <p>ⓒ NTO PARTNERS INC. ALL RIGHTS RESERVED.</p>
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
    $(document).on('click', '.modal-button', function(){
        var url = $(this).data('url'); // 버튼의 데이터 속성에서 URL을 가져옵니다.
        var cont = "";
        var params = {};
        if(typeof($(this).find('input[name="cont"]').val())=="string"){
            cont = $(this).find('input[name="cont"]').val();
            params = {cont:cont};
        }
        
        if(typeof($(this).find('input[name="params"]').val())=="string"){
            cont = JSON.parse($(this).find('input[name="params"]').val());
            params = cont;
        }
        // if(params)  
        //     showModalPrc(url, params);
        // else
            showModal(url,params);

        return false;
    });
});

function showModal(url, params){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $.ajax({
        url: '{{ route('modal.content') }}/'+url,
        type: 'POST',
        data:params,
        success: function(response) {
            $('#modal').html(response); // 모달의 내용을 업데이트합니다.
            $('#modal .modal').modal('show'); // 모달을 표시합니다.
        },
        error: function(error) {
            console.log(error);
        }
    });
}

function showModalPrc(url, params){
    let searchParams = new URLSearchParams(params);
    let json = Object.fromEntries(searchParams);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: url,
        data:json,
        dataType:'html',
        type: 'POST',
        success: function(response) {
            // console.log(response);
            $('#modal').html(response); // 모달의 내용을 업데이트합니다.
            $('#modal .modal').modal('show'); // 모달을 표시합니다.
        },
        error: function(error) {
            console.log(error);
        }
    });
}

function addFavoriteAuction(obj, str) {
    var arr = str.split(',');
    console.log(arr.length);
    
    let gbn = arr[0];
    let code = arr[1];
    let no = null;
    if(arr.length>2) no = arr[2];

    var $child = $(obj).children();

    var flag = ($child.hasClass('ri-heart-3-line')) ? "add" : "remove";
    var params = {
        flag: flag,
        gbn: gbn,
        code: code,
        no: no,
    };

    var r = doAjax('{{ route('common.ajax.addFavoriteAuction') }}', params);

    if (r.result) {
        if (flag == "add") $child.removeClass('ri-heart-3-line').addClass('ri-heart-3-fill');
        else $child.removeClass('ri-heart-3-fill').addClass('ri-heart-3-line');

        // if(flag=="add") $child.addClass('on');
        // else            $child.removeClass('on');
        sbAlert(r.message);
    }

    return false;
}
</script>