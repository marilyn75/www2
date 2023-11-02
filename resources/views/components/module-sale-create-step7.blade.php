
<form name="frmCreate" action="{{ $uri }}" method="post">
    @csrf
    <input type="hidden" name="tmp_id" value="{{ $data['tmp_id'] }}">
    <input type="hidden" name="step" value="6">

<div class="w-100">
    <div class="row">
        <div class="col-lg-12">
            <div class="my_dashboard_review mt30">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="mb30">등록완료</h4>
                    </div>
                    <div class="col-lg-12">
                        등록 완료 되었습니다. 
                        등록된 내용 표시 할겁니다.
                    </div>
                    
                    {{-- <div class="col-xl-12">
                        <div class="my_profile_setting_input">
                            <button class="btn btn1 float-left">이전</button>
                            <button class="btn btn2 float-right">다음</button>
                        </div>
                    </div> --}}
                </div>
            </div>


        </div>
    </div>
</div>
</form>