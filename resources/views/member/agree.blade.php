@extends('layout.layout')

@section('content')

<!-- Our LogIn Register -->

<section class="our-log-reg bgc-fa log_sign_pd">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-6 offset-lg-3">
                <div class="sign_up_form inner_page sign_up_form_w">
                    <div class="heading log_sing_intro">
                        <h3>약관 동의</h3>
                        <p>환영합니다! 계모임 서비스 이용약관에 동의해주세요.</a></p>
                    </div>
                    <div class="details">
                        @include('include.messagebox')
                        <form action="{{ url(route('register')) }}" method="POST">
                            @csrf
                            <input type="hidden" name="mode" value="form">
                            <div class="form-group custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="exampleCheck3" name="agree" value="1">
                                <label class="custom-control-label" for="exampleCheck3">모두 동의합니다.</label>
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