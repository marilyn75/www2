
<form name="frmCreate" action="{{ $uri }}" method="post">
    @csrf
    <input type="hidden" name="tmp_id" value="{{ $data['tmp_id'] }}">
    <input type="hidden" name="step" value="4">

<div class="w-100">
    <div class="row">
        <div class="col-lg-12">
            <div class="my_dashboard_review mt30">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="mb30">매물상세정보</h4>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="propertyId">매물번호</label>
                            <input type="text" class="form-control" id="propertyId">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="propertyASize">매매가격</label>
                            <input type="text" class="form-control" id="propertyASize">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="sizePrefix">월세현황</label>
                            <input type="text" class="form-control" id="sizePrefix">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="landArea">토지면적</label>
                            <input type="text" class="form-control" id="landArea">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="LASPostfix">지목</label>
                            <input type="text" class="form-control" id="LASPostfix">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="bedRooms">용도지역</label>
                            <input type="text" class="form-control" id="bedRooms">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="bathRooms">건물면적</label>
                            <input type="text" class="form-control" id="bathRooms">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="garages">건물용도</label>
                            <input type="text" class="form-control" id="garages">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="garagesSize">주구조</label>
                            <input type="text" class="form-control" id="garagesSize">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="yearBuild">층정보</label>
                            <input type="text" class="form-control" id="yearBuild">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="videoUrl">주차 승강기</label>
                            <input type="text" class="form-control" id="videoUrl">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="virtualTour">-</label>
                            <input type="text" class="form-control" id="virtualTour">
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <h4>부가정보</h4>
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-2">
                        <ul class="ui_kit_checkbox selectable-list">
                            <li>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">Air Conditioning</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck2">
                                    <label class="custom-control-label" for="customCheck2">Lawn</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck3">
                                    <label class="custom-control-label" for="customCheck3">Swimming Pool</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck4">
                                    <label class="custom-control-label" for="customCheck4">Barbeque</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck5">
                                    <label class="custom-control-label" for="customCheck5">Microwave</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-2">
                        <ul class="ui_kit_checkbox selectable-list">
                            <li>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck6">
                                    <label class="custom-control-label" for="customCheck6">TV Cable</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck7">
                                    <label class="custom-control-label" for="customCheck7">Dryer</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck8">
                                    <label class="custom-control-label" for="customCheck8">Outdoor Shower</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck9">
                                    <label class="custom-control-label" for="customCheck9">Washer</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck10">
                                    <label class="custom-control-label" for="customCheck10">Gym</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-2">
                        <ul class="ui_kit_checkbox selectable-list">
                            <li>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck11">
                                    <label class="custom-control-label" for="customCheck11">Refrigerator</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck12">
                                    <label class="custom-control-label" for="customCheck12">WiFi</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck13">
                                    <label class="custom-control-label" for="customCheck13">Laundry</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck14">
                                    <label class="custom-control-label" for="customCheck14">Sauna</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck15">
                                    <label class="custom-control-label" for="customCheck15">Window Coverings</label>
                                </div>
                            </li>
                        </ul>
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