<style>
/* .img-whp{width:360px;height:287px;} */
.img-whp {
    width: 370px !important;
    height: 215px;
}
</style>

<script>
    function addFavorite(obj, id){
        var $child = $(obj).children();
        
        var flag = ($child.hasClass('ri-heart-3-line')) ? "add" : "remove";
        var params = {id:id, flag:flag};

        var r = doAjax('{{ route('common.ajax.addFavorite') }}',params);
    
        if(r.result){
            if(flag=="add") $child.removeClass('ri-heart-3-line').addClass('ri-heart-3-fill');
            else            $child.removeClass('ri-heart-3-fill').addClass('ri-heart-3-line');

            // if(flag=="add") $child.addClass('on');
            // else            $child.removeClass('on');
            sbAlert(r.message);
        }

        return false;
    }
</script>

<form name="frm" action="{{ $data->path() }}" method="post" class="row">
    @csrf
    <input type="hidden" name="page" value="1">

    <!-- mobile filter -->
    <div class="row">
        <div class="col-lg-12">
            <div class="listing_sidebar dn db-991">
                <div class="sidebar_content_details style3">
                    <!-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> -->
                    <div class="sidebar_listing_list style2 mobile_sytle_sidebar mb0">
                        <div class="sidebar_advanced_search_widget">
                            <h4 class="mb25">Advanced Search <a class="filter_closed_btn float-right" href="#"><span
                                        class="flaticon-close"></span></a></h4>
                            <ul class="sasw_list style2 mb0 sasw_list_w">
                                <li class="search_area">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="exampleInputName1"
                                            placeholder="keyword">
                                        <label for="exampleInputEmail"><span
                                                class="flaticon-magnifying-glass"></span></label>
                                    </div>
                                </li>
                                <li class="search_area">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="exampleInputEmail"
                                            placeholder="Location">
                                        <label for="exampleInputEmail"><span
                                                class="flaticon-maps-and-flags"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="search_option_two">
                                        <div class="candidate_revew_select">
                                            <select class="selectpicker w100 show-tick">
                                                <option>Status</option>
                                                <option>Apartment</option>
                                                <option>Bungalow</option>
                                                <option>Condo</option>
                                                <option>House</option>
                                                <option>Land</option>
                                                <option>Single Family</option>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="search_option_two">
                                        <div class="candidate_revew_select">
                                            <select class="selectpicker w100 show-tick">
                                                <option>Property Type</option>
                                                <option>Apartment</option>
                                                <option>Bungalow</option>
                                                <option>Condo</option>
                                                <option>House</option>
                                                <option>Land</option>
                                                <option>Single Family</option>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="small_dropdown2">
                                        <div id="prncgs" class="btn dd_btn">
                                            <span>Price</span>
                                            <label for="exampleInputEmail2"><span
                                                    class="fa fa-angle-down"></span></label>
                                        </div>
                                        <div class="dd_content2">
                                            <div class="pricing_acontent">
                                                <!-- <input type="text" class="amount" placeholder="$52,239"> 
                                        <input type="text" class="amount2" placeholder="$985,14">
                                        <div class="slider-range"></div> -->
                                                <span id="slider-range-value1"></span>
                                                <span class="mt0" id="slider-range-value2"></span>
                                                <div id="slider"></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="search_option_two">
                                        <div class="candidate_revew_select">
                                            <select class="selectpicker w100 show-tick">
                                                <option>Bathrooms</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="search_option_two">
                                        <div class="candidate_revew_select">
                                            <select class="selectpicker w100 show-tick">
                                                <option>Bedrooms</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="search_option_two">
                                        <div class="candidate_revew_select">
                                            <select class="selectpicker w100 show-tick">
                                                <option>Garages</option>
                                                <option>Yes</option>
                                                <option>No</option>
                                                <option>Others</option>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="search_option_two">
                                        <div class="candidate_revew_select">
                                            <select class="selectpicker w100 show-tick">
                                                <option>Year built</option>
                                                <option>2013</option>
                                                <option>2014</option>
                                                <option>2015</option>
                                                <option>2016</option>
                                                <option>2017</option>
                                                <option>2018</option>
                                                <option>2019</option>
                                                <option>2020</option>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                                <li class="min_area style2 list-inline-item">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="exampleInputName2"
                                            placeholder="Min Area">
                                    </div>
                                </li>
                                <li class="max_area list-inline-item">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="exampleInputName3"
                                            placeholder="Max Area">
                                    </div>
                                </li>
                                <li>
                                    <div id="accordion" class="panel-group">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a href="#panelBodyRating" class="accordion-toggle link"
                                                        data-toggle="collapse" data-parent="#accordion"><i
                                                            class="flaticon-more"></i> Advanced features</a>
                                                </h4>
                                            </div>
                                            <div id="panelBodyRating" class="panel-collapse collapse">
                                                <div class="panel-body row">
                                                    <div class="col-lg-12">
                                                        <ul class="ui_kit_checkbox selectable-list float-left fn-400">
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        id="customCheck1">
                                                                    <label class="custom-control-label"
                                                                        for="customCheck1">Air
                                                                        Conditioning</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        id="customCheck4">
                                                                    <label class="custom-control-label"
                                                                        for="customCheck4">Barbeque</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        id="customCheck10">
                                                                    <label class="custom-control-label"
                                                                        for="customCheck10">Gym</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        id="customCheck5">
                                                                    <label class="custom-control-label"
                                                                        for="customCheck5">Microwave</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        id="customCheck6">
                                                                    <label class="custom-control-label"
                                                                        for="customCheck6">TV Cable</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        id="customCheck2">
                                                                    <label class="custom-control-label"
                                                                        for="customCheck2">Lawn</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        id="customCheck11">
                                                                    <label class="custom-control-label"
                                                                        for="customCheck11">Refrigerator</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        id="customCheck3">
                                                                    <label class="custom-control-label"
                                                                        for="customCheck3">Swimming
                                                                        Pool</label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                        <ul class="ui_kit_checkbox selectable-list float-right fn-400">
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        id="customCheck12">
                                                                    <label class="custom-control-label"
                                                                        for="customCheck12">WiFi</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        id="customCheck14">
                                                                    <label class="custom-control-label"
                                                                        for="customCheck14">Sauna</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        id="customCheck7">
                                                                    <label class="custom-control-label"
                                                                        for="customCheck7">Dryer</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        id="customCheck9">
                                                                    <label class="custom-control-label"
                                                                        for="customCheck9">Washer</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        id="customCheck13">
                                                                    <label class="custom-control-label"
                                                                        for="customCheck13">Laundry</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        id="customCheck8">
                                                                    <label class="custom-control-label"
                                                                        for="customCheck8">Outdoor
                                                                        Shower</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        id="customCheck15">
                                                                    <label class="custom-control-label"
                                                                        for="customCheck15">Window
                                                                        Coverings</label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="search_option_button">
                                        <button type="submit" class="btn btn-block btn-thm">Search</button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- mobile filter end -->

    <!-- pc side bar -->
    <div class="col-lg-4 col-xl-4">
        <div class="dn-smd dn-991 pc_filter_bx">
            <div class="sidebar_advanced_search_widget">
                <ul class="sasw_list mb0 sasw_list_w">
                    <!-- <li class="search_area">
                <div class="form-group">
                    <input type="text" class="form-control" id="exampleInputName1" placeholder="지하철/건물명/물건번호">
                    <label for="exampleInputEmail"><span class="flaticon-magnifying-glass"></span></label>
                </div>
            </li> -->
                    <!-- <li class="search_area">
                <div class="form-group">
                    <input type="text" class="form-control" id="exampleInputEmail" placeholder="지역">
                    <label for="exampleInputEmail"><span class="flaticon-maps-and-flags"></span></label>
                </div>
            </li> -->
                    <li>
                        <div class="search_option_two">
                            <div class="candidate_revew_select select_w">
                                <!-- <label for="">지역</label> -->
                                <select class="selectpicker w100 show-tick">
                                    <option>지역</option>
                                    <option>강서구</option>
                                    <option>금정구</option>
                                    <option>남구</option>
                                    <option>동구</option>
                                    <option>동래구</option>
                                    <option>진구</option>
                                    <option>북구</option>
                                </select>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="search_option_two">
                            <div class="candidate_revew_select select_w">
                                <!-- <label for="">매물종류</label> -->
                                <select class="selectpicker w100 show-tick">
                                    <option>매물종류</option>
                                    <option>토지 / 임야</option>
                                    <option>상업용 건물</option>
                                    <option>원룸건물</option>
                                    <option>호텔 / 모텔</option>
                                    <option>공장 / 주유소</option>
                                    <option>기타매물</option>
                                </select>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="search_option_two">
                            <div class="candidate_revew_select select_w">
                                <!-- <label for="">매물분류</label> -->
                                <select class="selectpicker w100 show-tick">
                                    <option>매물분류</option>
                                    <option>상가주택</option>
                                    <option>상가건물</option>
                                    <option>다세대</option>
                                    <option>다가구</option>
                                    <option>공장</option>
                                    <option>창고</option>
                                </select>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="search_option_two">
                            <div class="candidate_revew_select select_w">
                                <!-- <label for="">방개수</label> -->
                                <select class="selectpicker w100 show-tick">
                                    <option>방개수</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                </select>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="search_option_two">
                            <div class="candidate_revew_select select_w">
                                <!-- <label for="">화장실개수</label> -->
                                <select class="selectpicker w100 show-tick">
                                    <option>화장실개수</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                </select>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="search_option_two">
                            <div class="candidate_revew_select select_w">
                                <!-- <label for="">명도여부</label> -->
                                <select class="selectpicker w100 show-tick">
                                    <option>명도여부</option>
                                    <option>가능</option>
                                    <option>완료</option>
                                    <option>불가</option>
                                </select>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="search_option_two">
                            <div class="candidate_revew_select select_w">
                                <!-- <label for="">건축년도</label> -->
                                <select class="selectpicker w100 show-tick">
                                    <option>건축년도</option>
                                    <option>2013</option>
                                    <option>2014</option>
                                    <option>2015</option>
                                    <option>2016</option>
                                    <option>2017</option>
                                    <option>2018</option>
                                    <option>2019</option>
                                    <option>2020</option>
                                </select>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="small_dropdown2 small_dropdown2_w">
                            <!-- <label for="">가격</label> -->
                            <div id="prncgs2" class="btn dd_btn">
                                <span>가격 (단위 : 만원)</span>
                                <label for="exampleInputEmail2"><i class="ri-arrow-down-s-fill"></i></label>
                            </div>
                            <div class="dd_content2 style2 dd_content2_w">
                                <div class="pricing_acontent">
                                    <input type="text" class="amount" placeholder="￦10,000">
                                    <input type="text" class="amount2" placeholder="￦1,000,000">
                                    <div class="slider-range"></div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- <li class="min_area list-inline-item">
                <div class="form-group">
                    <input type="text" class="form-control" id="exampleInputName2" placeholder="최소 면적">
                </div>
            </li> -->
                    <!-- <li class="max_area list-inline-item">
                <div class="form-group">
                    <input type="text" class="form-control" id="exampleInputName3" placeholder="최대 면적">
                </div>
            </li> -->
                    <li>
                        <div id="accordion" class="panel-group">
                            <div class="panel panel_w">
                                <div class="panel-heading panel-heading_w">
                                    <a href="#panelBodyRating" class="accordion-toggle link" data-toggle="collapse"
                                        data-parent="#accordion">
                                        <h4 class="panel-title">
                                            옵션
                                        </h4>
                                        <i class="ri-arrow-down-s-fill"></i>
                                    </a>
                                </div>
                                <div id="panelBodyRating" class="panel-collapse collapse">
                                    <div class="panel-body row panel-body_w">
                                        <div class="col-lg-12">
                                            <ul class="ui_kit_checkbox selectable-list float-left fn-400">
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck16">
                                                        <label class="custom-control-label"
                                                            for="customCheck16">주차장</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck17">
                                                        <label class="custom-control-label"
                                                            for="customCheck17">엘리베이터</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck18">
                                                        <label class="custom-control-label"
                                                            for="customCheck18">에스컬레이터</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck19">
                                                        <label class="custom-control-label"
                                                            for="customCheck19">일반상업지</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck20">
                                                        <label class="custom-control-label"
                                                            for="customCheck20">준주거지역</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck21">
                                                        <label class="custom-control-label"
                                                            for="customCheck21">제1종근생시설</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck22">
                                                        <label class="custom-control-label"
                                                            for="customCheck22">제2종근생시설</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck23">
                                                        <label class="custom-control-label"
                                                            for="customCheck23">제3종근생시설</label>
                                                    </div>
                                                </li>
                                            </ul>
                                            <ul class="ui_kit_checkbox selectable-list float-right fn-400">
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck24">
                                                        <label class="custom-control-label"
                                                            for="customCheck24">자연녹지지역</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck25">
                                                        <label class="custom-control-label"
                                                            for="customCheck25">계획관리지역</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck26">
                                                        <label class="custom-control-label"
                                                            for="customCheck26">개발제한지역</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck27">
                                                        <label class="custom-control-label"
                                                            for="customCheck27">일반공업지역</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck28">
                                                        <label class="custom-control-label"
                                                            for="customCheck28">준공업지역</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck29">
                                                        <label class="custom-control-label"
                                                            for="customCheck29">프랜차이즈</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck30">
                                                        <label class="custom-control-label" for="customCheck30">권리금
                                                            무</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="search_option_button">
                            <button type="submit" class="btn btn-block btn-thm btn-thm_w">검색하기</button>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- pc side bar end -->
    <div class="col-md-12 col-lg-8">
        <!-- 검색결과 -->
        <div class="row row_w">
            <div class="grid_list_search_result search_result_w">
                <div class="">
                    <div class="left_area tac-xsd">
                        <p>검색결과 <span class="mont point_c">{{ number_format($data->total()) }}</span>건</p>
                    </div>
                </div>
                <div class="">
                    <div class="right_area text-right tac-xsd subfilter_w">
                        <ul>
                            {{-- <li class="list-inline-item">
                                <select class="selectpicker show-tick">
                                    <option>최신순</option>
                                    <option>오래된순</option>
                                    <option>찜하기순</option>
                                </select>
                            </li> --}}
                            <li class="list-inline-item">
                                <select class="selectpicker show-tick" name="sort"
                                    onchange="frm.sort.value=this.value;frm.submit();">
                                    <option value="reg_date|desc" @if (@$_POST['sort']=="reg_date|desc" ) selected
                                        @endif>최신순</option>
                                    <option value="reg_date" @if (@$_POST['sort']=="reg_date" ) selected @endif>오래된순
                                    </option>
                                    {{-- <option value="zzim desc" @if ($_POST['sort']=="zzim desc") selected @endif>찜하기순</option>
                                    <option value="price desc" @if ($_POST['sort']=="price desc") selected @endif>높은가격순</option>
                                    <option value="price asc" @if ($_POST['sort']=="price asc") selected @endif>낮은가격순</option> --}}
                                </select>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- 검색결과 end -->
        
        <div class="row">
            @foreach ($data as $_data)
            @php

            $printData = App\Http\Class\IntraSaleClass::getPrintData($_data);

            @endphp
            <x-item-sale-intranet type='default' :printData="$printData" />

            @endforeach
            <x-pagination :data="$data" />
        </div>
    </div>
</form>