<style>
    .horizontal-list {
        list-style: none; /* 기본 목록 마커(불릿)을 제거합니다. */
        display: flex; /* Flexbox 레이아웃을 사용합니다. */
        flex-direction: row; /* 가로로 배치합니다. */
    }

    .horizontal-list li {
        margin-right: 10px; /* 각 항목 간의 간격을 지정할 수 있습니다. */
    }

    .inbox-item {
        background-color: white;cursor: pointer;
    }
    .inbox-item:hover {
        background-color: #cccccc;
    }
</style>

<script>
    $(document).on('change', '#saleType1', function(){
        var id = this.value;
        if(id){
            $.ajax({
                type: 'post',
                url : "{{ route('page.ajax', $page->id) }}",
                data: {'_token': '{{ csrf_token() }}', 'mode' : 'getChildrenFromId', 'code_id': id},
                dataType: 'json', 
                success: function(jsonData){
                    //작업이 성공적으로 발생했을 경우
                    console.log(jsonData);
                    // 첫 번째 옵션을 제외한 나머지 옵션을 제거
                    $('#saleType2 option:not(:first)').remove();

                    // JSON 데이터를 이용하여 옵션 추가
                    $.each(jsonData, function (key, value) {
                        
                        $('#saleType2').append($('<option>', {
                            value: value.id,
                            text: value.title
                        }));
                    });

                    // selectpicker를 업데이트
                    $('#saleType2').selectpicker('refresh');
                },
                error:function(e){  
                    //에러가 났을 경우 실행시킬 코드
                    console.log(e);
                }
            });
        }else{
            $('#saleType2 option:not(:first)').remove();
            $('#saleType2').selectpicker('refresh');
        }
        frmCreate.saleType.value = "";
        frmCreate.saleTypeTxt.value = "";
    });

    $(document).on('change', '#saleType2', function(){
        var id = this.value;
        var saleType="";
        var saleTypeTxt="";
        if(id){
            saleType = $('#saleType1 option:selected').val() + "_" + $('#saleType2 option:selected').val();
            saleTypeTxt = $('#saleType1 option:selected').text() + " > " + $('#saleType2 option:selected').text();
        }
        frmCreate.saleType.value = saleType;
        frmCreate.saleTypeTxt.value = saleTypeTxt;
    });

    var schTxt;
    $(document).on("keyup", '#addrSearch', function(){
        console.log('searck keyup');

        if($.trim(this.value) == $.trim(schTxt)) return false;
        else	$("#searchResult > div").remove();

        var limit = 15;
        var jsonSearchResult = $.ajax({
            url: "{{ route('AddrSearch') }}?query=" + this.value + "&limit=" + limit ,
            dataType: 'json',
            async: false
        }).responseJSON;


            var htmlItem = "";
            $.each(jsonSearchResult, function(k,dt){
                console.log(dt.id);
                htmlItem += '<div class="inbox-item"><ul class="mb-0 ps-1 hover-line cursor-pointer" onclick="selectLocation(this)" data-lx="'+dt.localX+'" data-ly="'+dt.localY+'" data-id="'+dt.id+'" >';
                htmlItem += '    <li class="inbox-item-author jibun">'+dt.jibun+'</li>';
                htmlItem += '    <li class="inbox-item-text road">'+dt.road+'</li>';
                htmlItem += '</ul></div>';
                
            });


        $("#searchResult").append(htmlItem);
        schTxt = this.value;

        // // 검색어 하이라이트
        // arrSchTxt = schTxt.split(" ");
        // $.each(arrSchTxt, function(key, data){
        //     console.log(data);
        //     $("#searchResult .jibun").highlight(data);
        //     $("#searchResult .road").highlight(data);
        // });
    });

    function selectLocation(obj){
        alert($(obj).data('id'));
    }
</script>
<form name="frmCreate">
    @csrf
    <input type="hidden" name="saleType" value="{{ old('saleType') }}">
    <input type="hidden" name="saleTypeTxt" value="{{ old('saleTypeTxt') }}">
<div class="w-100">
    <div class="row">
        <div class="col-lg-12">
            <div class="my_dashboard_review">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="mb30">매물 등록하기</h4>
                    </div>
                    <div class="col-lg-12">
                        <div class="my_profile_setting_textarea">
                            <label for="propertyDescription">거래유형</label>
                        </div>
                        <ul class="ui_kit_checkbox selectable-list horizontal-list">
                            @foreach ($tradeType as $_item)
                            <li>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="tradeType{{ $_item['id'] }}" value="{{ $_item['id'] }}">
                                    <label class="custom-control-label" for="tradeType{{ $_item['id'] }}">{{ $_item['title'] }}</label>
                                </div>
                            </li>
                            @endforeach
                            
                        </ul>
                    </div>

                    <div class="col-lg-6 col-xl-6">
                        <div class="my_profile_setting_input ui_kit_select_search form-group">
                            <label>매물유형</label>
                            <select class="selectpicker" data-live-search="false" data-width="100%" name="saleType1" id="saleType1">
                                <option value="">-- 선택하세요 --</option>
                                @foreach ($saleType as $_item)
                                <option data-tokens="{{ $_item['title'] }}" value="{{ $_item['id'] }}">{{ $_item['title'] }}</option>    
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-6">
                        <div class="my_profile_setting_input ui_kit_select_search form-group">
                            <label>&nbsp;</label>
                            <select class="selectpicker" data-live-search="false" data-width="100%" name="saleType2" id="saleType2">
                                <option value="">-- 선택하세요 --</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="my_profile_setting_input form-group">
                            <label for="formGroupExamplePrice">주소검색</label>
                            <input type="search" class="form-control" id="addrSearch">
                        </div>
                    </div>
                    <div class="col-xl-12" id="search-dropdown" >
                        <!-- 검색 키워드 목록 -->
                        
                            <!-- <h4 class="header-title mt-2 mb-2">검색결과</h4> -->
                            <div id="searchResult" class="inbox-widget">
 
                            </div> 
                    </div>
                    
                    <div class="col-xl-12">
                        <div class="my_profile_setting_input">
                            <button class="btn btn1 float-left">Back</button>
                            <button class="btn btn2 float-right">Next</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my_dashboard_review mt30">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="mb30">Location</h4>
                        <div class="my_profile_setting_input form-group">
                            <label for="propertyAddress">Address</label>
                            <input type="text" class="form-control" id="propertyAddress">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-6">
                        <div class="my_profile_setting_input form-group">
                            <label for="propertyState">County / State</label>
                            <input type="text" class="form-control" id="propertyState">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-6">
                        <div class="my_profile_setting_input form-group">
                            <label for="propertyCity">City</label>
                            <input type="text" class="form-control" id="propertyCity">
                        </div>
                    </div>
                    <div class="col-lg-4 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="neighborHood">Neighborhood</label>
                            <input type="text" class="form-control" id="neighborHood">
                        </div>
                    </div>
                    <div class="col-lg-4 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="zipCode">Zip</label>
                            <input type="text" class="form-control" id="zipCode">
                        </div>
                    </div>
                    <div class="col-lg-4 col-xl-4">
                        <div class="my_profile_setting_input ui_kit_select_search form-group">
                            <label>Country</label>
                            <select class="selectpicker" data-live-search="true" data-width="100%">
                                <option data-tokens="Turkey">Turkey</option>
                                <option data-tokens="Iran">Iran</option>
                                <option data-tokens="Iraq">Iraq</option>
                                <option data-tokens="Spain">Spain</option>
                                <option data-tokens="Greece">Greece</option>
                                <option data-tokens="Portugal">Portugal</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="my_profile_setting_input form-group">
                            <div class="h400 bdrs8" id="map-canvas"></div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="googleMapLat">Latitude (for Google Maps)</label>
                            <input type="text" class="form-control" id="googleMapLat">
                        </div>
                    </div>
                    <div class="col-lg-4 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="googleMapLong">Longitude (for Google Maps)</label>
                            <input type="text" class="form-control" id="googleMapLong">
                        </div>
                    </div>
                    <div class="col-lg-4 col-xl-4">
                        <div class="my_profile_setting_input ui_kit_select_search form-group">
                            <label>Google Map Street View</label>
                            <select class="selectpicker" data-live-search="true" data-width="100%">
                                <option data-tokens="Turkey">Street View v1</option>
                                <option data-tokens="Iran">Street View v2</option>
                                <option data-tokens="Iraq">Street View v3</option>
                                <option data-tokens="Spain">Street View v4</option>
                                <option data-tokens="Greece">Street View v5</option>
                                <option data-tokens="Portugal">Street View v6</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="my_profile_setting_input">
                            <button class="btn btn1 float-left">Back</button>
                            <button class="btn btn2 float-right">Next</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my_dashboard_review mt30">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="mb30">Detailed Information</h4>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="propertyId">Property ID</label>
                            <input type="text" class="form-control" id="propertyId">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="propertyASize">Area Size</label>
                            <input type="text" class="form-control" id="propertyASize">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="sizePrefix">Size Prefix</label>
                            <input type="text" class="form-control" id="sizePrefix">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="landArea">Land Area</label>
                            <input type="text" class="form-control" id="landArea">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="LASPostfix">Land Area Size Postfix</label>
                            <input type="text" class="form-control" id="LASPostfix">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="bedRooms">Bedrooms</label>
                            <input type="text" class="form-control" id="bedRooms">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="bathRooms">Bathrooms</label>
                            <input type="text" class="form-control" id="bathRooms">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="garages">Garages</label>
                            <input type="text" class="form-control" id="garages">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="garagesSize">Garages Size</label>
                            <input type="text" class="form-control" id="garagesSize">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="yearBuild">Year Built</label>
                            <input type="text" class="form-control" id="yearBuild">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="videoUrl">Video URL</label>
                            <input type="text" class="form-control" id="videoUrl">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="virtualTour">360° Virtual Tour</label>
                            <input type="text" class="form-control" id="virtualTour">
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <h4>Amenities</h4>
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
                            <button class="btn btn1 float-left">Back</button>
                            <button class="btn btn2 float-right">Next</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my_dashboard_review mt30">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="mb30">Property media</h4>
                    </div>
                    <div class="col-lg-12">
                        <ul class="mb0">
                            <li class="list-inline-item">
                                <div class="portfolio_item">
                                    <img class="img-fluid" src="images/property/fp1.jpg" alt="fp1.jpg">
                                    <div class="edu_stats_list" data-toggle="tooltip" data-placement="top" title="Delete" data-original-title="Delete"><a href="#"><span class="flaticon-garbage"></span></a></div>
                                </div>
                            </li>
                            <li class="list-inline-item">
                                <div class="portfolio_item">
                                    <img class="img-fluid" src="images/property/fp2.jpg" alt="fp2.jpg">
                                    <div class="edu_stats_list" data-toggle="tooltip" data-placement="top" title="Delete" data-original-title="Delete"><a href="#"><span class="flaticon-garbage"></span></a></div>
                                </div>
                            </li>
                            <li class="list-inline-item">
                                <div class="portfolio_item">
                                    <img class="img-fluid" src="images/property/fp3.jpg" alt="fp3.jpg">
                                    <div class="edu_stats_list" data-toggle="tooltip" data-placement="top" title="Delete" data-original-title="Delete"><a href="#"><span class="flaticon-garbage"></span></a></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-12">
                        <div class="portfolio_upload">
                            <input type="file" name="myfile" />
                            <div class="icon"><span class="flaticon-download"></span></div>
                            <p>Drag and drop images here</p>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="resume_uploader mb30">
                            <h4>Attachments</h4>
                            <form class="form-inline">
                                <input class="upload-path">
                                <label class="upload">
                                    <input type="file">
                                    Select Attachment
                                </label>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="my_profile_setting_input">
                            <button class="btn btn1 float-left">Back</button>
                            <button class="btn btn2 float-right">Next</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my_dashboard_review mt30">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="mb30">Floor Plans</h4>
                        <button class="btn admore_btn mb30">Add More</button>
                    </div>
                    <div class="col-xl-12">
                        <div class="my_profile_setting_input form-group">
                            <label for="planDsecription">Plan Description</label>
                            <input type="text" class="form-control" id="planDsecription">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="planBedrooms">Plan Bedrooms</label>
                            <input type="text" class="form-control" id="planBedrooms">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="planBathrooms">Plan Bathrooms</label>
                            <input type="text" class="form-control" id="planBathrooms">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="planPrice">Plan Price</label>
                            <input type="text" class="form-control" id="planPrice">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="planPostfix">Price Postfix</label>
                            <input type="text" class="form-control" id="planPostfix">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label for="planSize">Plan Size</label>
                            <input type="text" class="form-control" id="planSize">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="my_profile_setting_input form-group">
                            <label>Plan Image</label>
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
                            <button class="btn btn1 float-left">Back</button>
                            <button class="btn btn2 float-right">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>