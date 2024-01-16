<script>
    function sendMsg(r){
        // r = JSON.parse(r);
        try{ $alertLoadingClose();}catch(e){}
        if(r.result=='true'){
            frm.reset();
            sbAlert(r.message);
        }else{
            sbAlert(r.message);
        }
    }

    function sendMsgFail(r){
        sbAlert(r.responseJSON['message']);
        $alertLoadingClose();
    }
</script>
<div class="sidebar_listing_list sidebar_listing_list_w">
    <div class="sidebar_advanced_search_widget">
        @if ($type=='photo')
        <div class="sl_creator sl_creator_w">
            <h4 class="mb20">현장안내</h4>
            <div class="media media_w">
                <div class="profile_crop">
                    <img class="mr-3" src="{{ $printData['sawon_photo'] }}" style="width:90px;height:90px">
                </div>
                <div class="media-body">
                    <p class="mb0 media-detail">{{ $printData['sawon_sosok'] }}</p>
                    <h5 class="mt-0">{{ $printData['sawon_name'] }}
                        {{ $printData['sawon_duty'] }}</h5>
                    <p class="mb0 mont media-call">Tel.
                    @if ($printData['sawon_chkcert']=='y')
                        <a href="tel:{{ $printData['sawon_phone'] }}">{{ $printData['sawon_phone'] }}</a>
                    @else
                        1833-{{ $printData['sawon_office_line'] }}
                    @endif
                    </p>
                </div>
            </div>
        </div>
        @else
        <div class="sl_creator sl_creator_w">
            <h4 class="mb20">지금 바로 문의해보세요!</h4>
        </div>
        @endif

        <form name="frm" method="post" onsubmit="return defaultAjaxFormSubmit(this, sendMsg, sendMsgFail);">
            @csrf
            <input type="hidden" name="dataType" value="json">
            <input type="hidden" name="mode" value="sendInquiry">
            <input type="hidden" name="p_code" value="{{ @$printData['p_code'] }}">
            <input type="hidden" name="user_id" value="{{ $printData['sawon_user_id'] }}">
            <input type="hidden" name="s_idx" value="{{ @$printData['s_idx'] }}">
            @auth
            <input type="hidden" name="name" value="{{ auth()->user()->name }}">
            @if(!empty(auth()->user()->phone))<input type="hidden" name="phone" value="{{ auth()->user()->phone }}">@endif
            @endauth
        <ul class="sasw_list mb0 sasw_list_w">
            @if(empty(auth()->user()->phone))
            {{-- <li class="search_area">
            <div class="form-group">
                <input type="text" class="form-control" name="name" id="name" placeholder="이름을 입력하세요" required hname="이름">
            </div>
            </li> --}}
            <li class="search_area">
                <div class="form-group">
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="연락처를 입력하세요" required hname="연락처" options="phone">
                </div>
            </li>
            @endif
            
            <li class="search_area">
                <div class="form-group">
                    <textarea id="message" name="message" class="form-control required" rows="3"
                    required hname="내용" placeholder="문의하실 내용을 입력하세요." ></textarea>
                </div>
            </li>
            <li>
                <div class="search_option_button detail_emp_btns">
                    @if ($type=='photo')<a class="btn btn-block btn-thm btn-thm_w" href="@if($printData['sawon_chkcert']=='y'){{ route('page',25) }}?mode=view&idx={{ $printData['sawon_idx'] }}@else{{ route('page',25) }}?mode=view&idx=0 @endif">자세히보기</a>@endif
                    {{-- @auth --}}
                    <button type="submit" class="btn btn-block btn-thm btn-thm_w">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        문의하기
                    </button>
                    {{-- @else --}}
                    {{-- <button type="button" class="btn btn-block btn-thm btn-thm_w" data-toggle="modal" data-target="#logalertModal">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        문의하기
                    </button> --}}
                    {{-- @endauth --}}
                </div>
            </li>
        </ul>
        </form>
    </div>
</div>