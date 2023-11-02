
<form name="frmCreate" action="{{ $uri }}" method="post">
    @csrf
    <input type="hidden" name="tmp_id" value="{{ $data['tmp_id'] }}">
    <input type="hidden" name="step" value="5">

<div class="w-100">
    <div class="row">
        <div class="col-lg-12">
            <div class="my_dashboard_review mt30">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="mb30">매물에 대한 자세한 소개를 부탁드립니다</h4>
                        <div class="my_profile_setting_input form-group">
                            <label for="propertyAddress">매물제목</label>
                            <input type="text" class="form-control" id="propertyAddress">
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="my_profile_setting_textarea mt30-991">
                            <label for="planDescription">매물설명</label>
                            <textarea class="form-control" id="planDescription" rows="7"></textarea>
                        </div>
                    </div>

                    <div class="col-xl-12">
                        <div class="my_profile_setting_input">
                            <button class="btn btn1 float-left">이전</button>
                            <button class="btn btn2 float-right">다음</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
</form>