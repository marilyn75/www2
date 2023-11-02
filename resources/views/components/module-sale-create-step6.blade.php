
<form name="frmCreate" action="{{ $uri }}" method="post">
    @csrf
    <input type="hidden" name="tmp_id" value="{{ $data['tmp_id'] }}">
    <input type="hidden" name="step" value="7">

<div class="w-100">
    <div class="row">
        <div class="col-lg-12">
            <div class="my_dashboard_review mt30">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="mb30">유튜브 URL을 연결해보세요</h4>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="planBedrooms">유튜브 링크</label>
                            <input type="text" class="form-control" id="planBedrooms">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="planBathrooms">-</label>
                            <input type="text" class="form-control" id="planBathrooms">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="planPrice">-</label>
                            <input type="text" class="form-control" id="planPrice">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="planPostfix">매물공개 / 위치 및 주소비공개 / 매물비공개</label>
                            <input type="text" class="form-control" id="planPostfix">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="planSize">-</label>
                            <input type="text" class="form-control" id="planSize">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label>-</label>
                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <input class="btn btn-thm" type="file" id="imageUpload" accept=".png, .jpg, .jpeg">
                                    <label for="imageUpload"></label>
                                </div>
                                <div class="avatar-preview">
                                    <div id="imagePreview"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="my_profile_setting_textarea mt30-991">
                            <label for="planDescription">Plan Description</label>
                            <textarea class="form-control" id="planDescription" rows="7"></textarea>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="my_profile_setting_input">
                            <button class="btn btn1 float-left">이전</button>
                            <button class="btn btn2 float-right">등록완료</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
</form>