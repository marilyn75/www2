@extends('layout.layout')

@section('content')

<!-- Inner Page Breadcrumb -->
<section class="inner_page_breadcrumb">

</section>

<!-- Our LogIn Register -->
<section class="our-log bgc-fa log_sign_pd">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-6 offset-lg-3">
                <div class="login_form inner_page login_form_w">
                    @include('include.messagebox')
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="heading log_sing_intro">
                            <h3>비밀번호 찾기</h3>
                            <p>가입 시 등록한 정보를 입력하시면 비밀번호를 변경하실 수 있습니다.</p>
                            <!-- <p class="">계정이 없으신가요? <a class="text-thm" href="{{ route('register') }}">&nbsp;&nbsp;&nbsp;회원가입!</a></p> -->
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder="이메일을 입력하세요"
                                value="@if (Session::has('email')) {{ Session::get('email') }} @elseif (isset($_COOKIE["
                                email"])) {{ $_COOKIE["email"] }} @else {{ old('email') }} @endif">
                        </div>
                        <div class="form-group phone_num_chk">
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="휴대폰 번호를 입력하세요" value="{{ old('phone') }}" options="phone">
                            <span class="cert_btn"><button type="button" class="num_chk_btn" id="certRequestBtn">인증 요청</button></span>
                        </div>
                        <div class="form-group phone_num_chk" id="divCertNumber">
                            <input type="text" class="form-control" id="confirm" name="confirm" placeholder="인증번호를 입력하세요." disabled maxlength="4">
                            <button type="button" class="num_chk_btn" id="certConfirmBtn">확인</button>
                        </div>
                        <button type="submit" class="btn btn-log btn-block btn-thm2">비밀번호 찾기</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection