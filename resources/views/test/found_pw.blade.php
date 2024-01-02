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
                            <h3>비밀번호 변경</h3>
                            <p>변경하실 비밀번호를 입력해주세요.</p>
                            <!-- <p class="">계정이 없으신가요? <a class="text-thm" href="{{ route('register') }}">&nbsp;&nbsp;&nbsp;회원가입!</a></p> -->
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="비밀번호를 입력하세요" >
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="비밀번호 확인" >
                        </div>
                        <button type="submit" class="btn btn-log btn-block btn-thm2">비밀번호 찾기</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection