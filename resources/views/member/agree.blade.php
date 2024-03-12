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
                        <form action="{{ route('agree') }}" method="POST">
                            @csrf
                            <input type="hidden" name="mode" value="form">
                            {{-- 전체동의 --}}
                            <div class="form-group custom-control custom-checkbox agree_bx mb40">
                                <input type="checkbox" class="custom-control-input" id="exampleCheck3" name="agree3" value="3">
                                <label class="custom-control-label" for="exampleCheck3">전체동의</label>
                            </div>

                            {{-- 서비스 이용약관 --}}
                            <label for="" class="agree_lb">서비스 이용약관</label>
                            <div class="form-group custom-control custom-checkbox agree_bx">
                                <input type="checkbox" class="custom-control-input" id="exampleCheck2" name="agree2" value="2">
                                <label class="custom-control-label" for="exampleCheck2">서비스 이용약관에 동의합니다.</label>
                                {{-- <a href="{{ route('page',39) }}" target="_blank"><i class="ri-arrow-right-s-line"></i></a> --}}
                                <a href="#" class="btn flaticon-user login_head modal-button" id="a-login" data-url="modal.usedetail"><i class="ri-arrow-right-s-line"></i></a>
                            </div>

                            {{-- 개인정보처리방침 --}}
                            <label for="" class="agree_lb">개인정보처리방침</label>
                            <div class="form-group custom-control custom-checkbox agree_bx">
                                <input type="checkbox" class="custom-control-input" id="exampleCheck1" name="agree" value="1">
                                <label class="custom-control-label" for="exampleCheck1">개인정보처리방침에 동의합니다.</label>
                                {{-- <a href="{{ route('page',40) }}" target="_blank"><i class="ri-arrow-right-s-line"></i></a> --}}
                                <a href="#" class="btn flaticon-user login_head modal-button" id="a-login" data-url="modal.privacy"><i class="ri-arrow-right-s-line"></i></a>
                            </div>

                            
                            <button type="submit" id="agreeButton" class="btn btn-log btn-block btn-thm2" disabled>동의하기</button>

                        </form>

                        <script>
                            $(document).ready(function () {
                                // Function to update the state of the '동의하기' button
                                function updateAgreeButtonState() {
                                    var isAllAgreed = $('#exampleCheck3').prop('checked');
                                    // Enable or disable the '동의하기' button based on the '전체동의' checkbox state
                                    $('#agreeButton').prop('disabled', !isAllAgreed);
                                }
                        
                                // Handle the '전체동의' checkbox change event
                                $('#exampleCheck3').change(function () {
                                    // Check or uncheck other checkboxes based on the '전체동의' checkbox state
                                    $('.agree_bx input[type="checkbox"]').prop('checked', $(this).prop('checked'));
                                    // Update the state of the '동의하기' button
                                    updateAgreeButtonState();
                                });
                        
                                // Handle individual checkbox change events
                                $('.agree_bx input[type="checkbox"]').change(function () {
                                    // Uncheck '전체동의' checkbox if any of the individual checkboxes is unchecked
                                    if (!$(this).prop('checked')) {
                                        $('#exampleCheck3').prop('checked', false);
                                    }
                        
                                    // Check '전체동의' checkbox if both individual checkboxes are checked
                                    if ($('#exampleCheck1').prop('checked') && $('#exampleCheck2').prop('checked')) {
                                        $('#exampleCheck3').prop('checked', true);
                                    }
                        
                                    // Update the state of the '동의하기' button
                                    updateAgreeButtonState();
                                });
                        
                                // Initial update when the page loads
                                updateAgreeButtonState();
                            });
                        </script>
                        
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    
@endsection