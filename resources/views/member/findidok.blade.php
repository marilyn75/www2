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
                    <form action="{{ route('login') }}" method="get">
                        @csrf
                        <input type="hidden" name="email" value="{{ $userData->email }}">
                        <div class="heading log_sing_intro">
                            <h3>이메일 찾기에 성공하였습니다.</h3>
                            <!-- <p class="">계정이 없으신가요? <a class="text-thm" href="{{ route('register') }}">&nbsp;&nbsp;&nbsp;회원가입!</a></p> -->
                        </div>
                        <div class="found_inf mt40 mb80">
                            <p>이메일 주소</p>
                            <h3 class="mont">{{ $userData->email }}</h3>
                        </div>
                        <button type="submit" class="btn btn-log btn-block btn-thm2">로그인</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection