<div class="row">
    <div class="col-lg-10 offset-lg-1 text-center">
        <div class="error_page footer_apps_widget">
            <img class="img-fluid" src="{{ asset('images/Common/stop_login.png') }}" alt="error.png">
            <div class="erro_code"><h3>로그인 후 다양한<br>혜택을 만나보세요!</h3></div>
            <!-- <p>
                @auth
                    접근 권한이 없습니다.
                @else
                    로그인 후 이용하세요.
                @endauth
            </p> -->
            <!-- <form class="form-inline mailchimp_form">
                <label class="sr-only" for="inlineFormInputName">Name</label>
                <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName" placeholder="Search">
                <button type="submit" class="btn btn-primary mb-2"><span class="flaticon-magnifying-glass"></span></button>
            </form> -->
        </div>
        <div class="error_page_btns">
            <a class="btn btn_error btn-thm " href="#" onclick="opener.location.href='{{ route('login') }}';self.close();">로그인</a>
            <a class="btn btn_error btn-thm" href="#" onclick="self.close();">닫기</a>
        </div>
    </div>
</div>
