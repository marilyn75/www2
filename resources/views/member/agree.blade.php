@extends('layout.layout')

@section('content')

<!-- Our LogIn Register -->

<section class="our-log-reg bgc-fa log_sign_pd">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-6 offset-lg-3">
                <div class="sign_up_form inner_page sign_up_form_w">
                    <div class="heading log_sing_intro">
                        <h3>약관동의</h3>
                    </div>
                    <div class="details">
                        @include('include.messagebox')
                        <form action="{{ url(route('register')) }}" method="POST">
                            @csrf
                            <input type="hidden" name="mode" value="form">
                            
                            {{-- 전체동의 --}}
                            <div class="form-group custom-control custom-checkbox agree_bx">
                                <input type="checkbox" class="custom-control-input" id="exampleCheck3" name="agree" value="1">
                                <label class="custom-control-label" for="exampleCheck3">전체동의</label>
                            </div>

                            {{-- 서비스 이용약관 --}}
                            <div class="form-group custom-control custom-checkbox agree_bx">
                                <input type="checkbox" class="custom-control-input" id="exampleCheck3" name="agree" value="1">
                                <label class="custom-control-label" for="exampleCheck3">서비스 이용약관에 동의합니다.</label>
                            </div>

                            {{-- 개인정보처리방침 --}}
                            <div class="form-group custom-control custom-checkbox agree_bx">
                                <input type="checkbox" class="custom-control-input" id="exampleCheck3" name="agree" value="1">
                                <label class="custom-control-label" for="exampleCheck3">개인정보처리방침에 동의합니다.</label>
                            </div>

                            
                            <button type="submit" class="btn btn-log btn-block btn-thm2">동의하기</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    
@endsection