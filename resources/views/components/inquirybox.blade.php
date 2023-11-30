<div class="sidebar_listing_list sidebar_listing_list_w">
    <div class="sidebar_advanced_search_widget">
        @if ($type=='photo')
        <div class="sl_creator sl_creator_w">
            <h4 class="mb20">중개사정보</h4>
            <div class="media media_w">
                <div class="profile_crop">
                    <img class="mr-3" src="{{ $printData['sawon_photo'] }}" style="width:90px;height:90px">
                </div>
                <div class="media-body">
                    <p class="mb0 media-detail">{{ $printData['sawon_sosok'] }}</p>
                    <h5 class="mt-0">{{ $printData['sawon_name'] }}
                        {{ $printData['sawon_duty'] }}</h5>
                    <p class="mb0 mont media-call">Tel.
                        1833-{{ $printData['sawon_office_line'] }}
                    </p>
                </div>
            </div>
        </div>
        @else
        <div class="sl_creator sl_creator_w">
            <h4 class="mb20" onclick="$alertLoading();">지금 바로 문의해보세요!</h4>
        </div>
        @endif

        <form onsubmit="return defaultAjaxFormSubmit(this);">
        <ul class="sasw_list mb0 sasw_list_w">
            <li class="search_area">
                <div class="form-group">
                    <input type="text" class="form-control" id="exampleInputName1" placeholder="이름을 입력하세요" required hname="이름">
                </div>
            </li>
            <li class="search_area">
                <div class="form-group">
                    <input type="text" class="form-control" id="exampleInputName2" placeholder="연락처를 입력하세요"required hname="연락처">
                </div>
            </li>
            <li class="search_area">
                <div class="form-group">
                    <input type="email" class="form-control" id="exampleInputEmail" placeholder="이메일을 입력하세요"required hname="이메일" options="email">
                </div>
            </li>
            <li class="search_area">
                <div class="form-group">
                    <textarea id="form_message" name="form_message" class="form-control required" rows="3"
                    required hname="내용" placeholder="문의하실 내용을 입력하세요."></textarea>
                </div>
            </li>
            <li>
                <div class="search_option_button detail_emp_btns">
                    @if ($type=='photo')<a class="btn btn-block btn-thm btn-thm_w" href="{{ route('page',25) }}?mode=view&idx={{ $printData['sawon_idx'] }}">자세히보기</a>@endif
                    <button type="submit" class="btn btn-block btn-thm btn-thm_w" onclick="$alertLoadingClose();">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        문의하기
                    </button>
                </div>
            </li>
        </ul>
        </form>
    </div>
</div>