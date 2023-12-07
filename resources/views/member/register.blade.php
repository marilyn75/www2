@extends('layout.layout')

@section('content')

<!-- Inner Page Breadcrumb -->
<section class="inner_page_breadcrumb">
    <!-- <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="breadcrumb_content">
                    <h4 class="breadcrumb_title">회원가입</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">회원가입</li>
                    </ol>
                </div>
            </div>
        </div>
    </div> -->
</section>

<!-- Our LogIn Register -->

<section class="our-log-reg bgc-fa log_sign_pd">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-6 offset-lg-3">
                <div class="sign_up_form inner_page sign_up_form_w">
                    <div class="heading log_sing_intro">
                        <h3>회원가입</h3>
                        <p>계정이 있으신가요?<a class="text-thm" href="{{ route('login') }}">로그인</a></p>
                    </div>
                    <div class="details">
                        @include('include.messagebox')
                        	
                        <form action="{{ url(route('register')) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" id="name" name="name" placeholder="사용자 이름" value="{{ old('name') }}">
                            </div>
                             <div class="form-group">
                                <input type="email" class="form-control" id="email" name="email" placeholder="이메일" value="{{ old('email') }}">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="비밀번호" >
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="비밀번호 확인" >
                            </div>
                            {{-- <div class="form-group custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="exampleCheck3">
                                <label class="custom-control-label" for="exampleCheck3">Want to become an instructor?</label>
                            </div> --}}
                            <button type="submit" class="btn btn-log btn-block btn-thm2">가입하기</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection