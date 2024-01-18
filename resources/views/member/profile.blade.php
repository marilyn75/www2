@extends('layout.layout')

@section('content')

<!-- Inner Page Breadcrumb -->
<section class="inner_page_breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="breadcrumb_content">
                    <h4 class="breadcrumb_title">회원정보 수정</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">회원정보 수정</li>
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
            <div class="col-lg-12">
                <div class="sign_up_form inner_page sign_up_form_w">
                    <div class="heading log_sing_intro">
                        <h3>회원정보를 수정하세요.</h3>
                        {{-- <p class="text-center">이미 계정이 있습니까?<a class="text-thm" href="{{ route('login') }}">
                        &nbsp;&nbsp;&nbsp; Login</a></p> --}}
                    </div>
                    <div class="details">
                        @include('include.messagebox')

                        <form action="{{ url(route('profile')) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="wrap-custom-file">
                                        <input type="file" name="file" id="image1" accept=".gif, .jpg, .jpeg, .png"
                                            value="" />
                                        <label for="image1" style="background-image: url('{{ showProfileImage() }}');background-size: 260px 260px;">
                                            <span><i class="ri-upload-line"></i></span>
                                        </label>
                                    </div>
                                    <p>*최소 260px x 260px</p>
                                </div>
                                <div class="col-lg-8">
                                    <div class="col-lg-12">
                                        <div class="my_profile_setting_input form-group">
                                            <label for="name">이름</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="my_profile_setting_input form-group">
                                            <label for="email">이메일</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ Auth::user()->email }}" readonly>
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-6 col-xl-6">
                                    <div class="my_profile_setting_input form-group">
                                        <label for="company">회사명</label>
                                        <input type="text" class="form-control" id="company" name="company" value="{{ Auth::user()->company }}">
                                    </div>
                                </div> -->
                                    <!-- <div class="col-lg-6 col-xl-6">
                                    <div class="my_profile_setting_input form-group">
                                        <label for="position">직책</label>
                                        <input type="text" class="form-control" id="position" name="position" value="{{ Auth::user()->position }}">
                                    </div>
                                </div> -->
                                    <div class="col-lg-12">
                                        <div class="my_profile_setting_input form-group">
                                            <label for="phone">휴대폰번호</label>
                                            <input type="text" class="form-control" id="phone" name="phone"
                                                value="{{ Auth::user()->phone }}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="my_profile_setting_textarea">
                                            <label for="address">주소</label>
                                            <input type="text" class="form-control" id="address" name="address" readonly
                                                onclick="openSearchZipcode()" value="{{ Auth::user()->address }}">
                                            <input type="hidden" id="zip_code" name="zip_code"
                                                value="{{ Auth::user()->zip_code }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                    <div class="my_profile_setting_textarea">
                                        <label for="address_detail">상세주소</label>
                                        <input type="text" class="form-control" id="address_detail" name="address_detail" value="{{ Auth::user()->address_detail }}">
                                    </div>
                                </div>
                                <div class="cancel_wrap">
                                    <a href="{{ route('leave') }}">
                                        회원탈퇴 <i class="ri-arrow-right-s-line"></i>
                                    </a>
                                </div>
                                <div class="col-xl-12 text-center">
                                    <div class="my_profile_setting_input">
                                        <button class="btn btn2">수정하기</button>
                                    </div>
                                </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection