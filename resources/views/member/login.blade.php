@extends('layout.layout')

@section('content')

<!-- Inner Page Breadcrumb -->
<section class="inner_page_breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="breadcrumb_content">
                    <h4 class="breadcrumb_title">로그인</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Logın</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
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
                            <h3>안녕하세요.<br><span class="mont">GYEMOIM INC.</span> 입니다.</h3>
                            <p>회원 서비스 이용을 위해 로그인 해주세요.</p>
                            <!-- <p class="">계정이 없으신가요? <a class="text-thm" href="{{ route('register') }}">&nbsp;&nbsp;&nbsp;회원가입!</a></p> -->
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder="이메일을 입력해주세요"
                                value="@if (Session::has('email')) {{ Session::get('email') }} @elseif (isset($_COOKIE["
                                email"])) {{ $_COOKIE["email"] }} @else {{ old('email') }} @endif">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="비밀번호를 입력해주세요" value="@if (isset($_COOKIE["
                                password"])){{ $_COOKIE["password"] }}@endif">
                        </div>
                        <button type="submit" class="btn btn-log btn-block btn-thm2">로그인</button>
                        <div class="form-group log_bot">
                            <a class="tdu" href="#">이메일 찾기</a>
                            <div class="log_bar"></div>
                            <a class="tdu" href="#">비밀번호 찾기</a>
                            <div class="log_bar"></div>
                            <a class="tdu" href="{{ route('register') }}">회원가입</a>
                        </div>
                        <!-- <div class="row mt40">
                            <div class="col-lg">
                                <a href="{{ route('social.login','naver') }}"
                                    class="btn btn-block color-white bgc-naver mb0"><i
                                        class="fa fa-facebook float-left mt5"></i> Naver</a>
                            </div>
                            <div class="col-lg">
                                <a href="{{ route('social.login','kakao') }}"
                                    class="btn btn2 btn-block color-black bgc-kakao mb0"><i
                                        class="fa fa-google float-left mt5"></i> Kakao</a>
                            </div>
                        </div> -->
                        <div class="social_btn">
                            <a href="{{ route('social.login','naver') }}">
                                <div class="sns sns_n">
                                    <img src="images/sns/naver.png" alt="">
                                    <p>네이버로 로그인</p>
                                </div>
                            </a>
                            <a href="{{ route('social.login','kakao') }}">
                                <div class="sns sns_k">
                                    <img src="images/sns/kakao.png" alt="">
                                    <p><span>Kakao</span>로 로그인</p>
                                </div>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection