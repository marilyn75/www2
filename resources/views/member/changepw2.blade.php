@extends('layout.layout')

@section('content')

<!-- Inner Page Breadcrumb -->
<section class="inner_page_breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="breadcrumb_content">
                    <h4 class="breadcrumb_title">비밀번호 변경</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">비밀번호 변경</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our LogIn Register -->

<section class="our-log-reg bgc-fa">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-6 offset-lg-3">
                <div class="sign_up_form inner_page change_pw">
                    <div class="heading">
                        <h3 class="text-center">비밀번호를 변경하세요.</h3>
                        {{-- <p class="text-center">이미 계정이 있습니까?<a class="text-thm" href="{{ route('login') }}"> &nbsp;&nbsp;&nbsp; Login</a></p> --}}
                    </div>
                    <div class="details">
                        @include('include.messagebox')
                        	
                        <form action="{{ route('findpw.form') }}" method="POST">
                            @csrf
                             <div class="form-group">
                                <input type="email" class="form-control mont email_bx" id="email" name="email" value="{{ $email }}" readonly style="background-color: #88888888;">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="변경할 비밀번호" >
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="비밀번호 확인" >
                            </div>
                            {{-- <div class="form-group custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="exampleCheck3">
                                <label class="custom-control-label" for="exampleCheck3">Want to become an instructor?</label>
                            </div> --}}
                            <button type="submit" class="btn btn-log btn-block btn-thm2">변경하기</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection