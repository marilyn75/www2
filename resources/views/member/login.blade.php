@extends('layout.layout')

@section('content')

<!-- Inner Page Breadcrumb -->
<section class="inner_page_breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="breadcrumb_content">
                    <h4 class="breadcrumb_title">Logın</h4>
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
<section class="our-log bgc-fa">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-6 offset-lg-3">
                <div class="login_form inner_page">
                    @include('include.messagebox')
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="heading">
                            <h3 class="text-center">로그인</h3>
                            <p class="text-center">계정이 없으신가요? <a class="text-thm" href="{{ route('register') }}">&nbsp;&nbsp;&nbsp;회원가입!</a></p>
                        </div>
                         <div class="form-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="@if (Session::has('email')) {{ Session::get('email') }} @elseif (isset($_COOKIE["email"])) {{ $_COOKIE["email"] }} @else {{ old('email') }} @endif">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="@if (isset($_COOKIE["password"])){{ $_COOKIE["password"] }}@endif">
                        </div>
                        <div class="form-group custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="remember" name="remember" @if(isset($_COOKIE["email"])) checked @endif>
                            <label class="custom-control-label" for="remember">Remember me</label>
                            <a class="tdu btn-fpswd float-right" href="#">Forgot Password?</a>
                        </div>
                        <button type="submit" class="btn btn-log btn-block btn-thm2">Login</button>
                        <div class="divide">
                            <span class="lf_divider">Or</span>
                            <hr>
                        </div>
                        <div class="row mt40">
                            <div class="col-lg">
                                <a href="{{ route('social.login','naver') }}" class="btn btn-block color-white bgc-naver mb0"><i class="fa fa-facebook float-left mt5"></i> Naver</a>
                            </div>
                            <div class="col-lg">
                                <button type="submit" class="btn btn2 btn-block color-black bgc-kakao mb0"><i class="fa fa-google float-left mt5"></i> Kakao</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection