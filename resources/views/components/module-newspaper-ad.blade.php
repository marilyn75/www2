

<form name="frm" action="{{ $data->path() }}" method="post" class="row">
    @csrf
    <input type="hidden" name="page" value="1">
    <div class="article_top mb80">
        <h2>부산일보 신문광고</h2>
        <div class="search_option_two">
            <div class="candidate_revew_select">
                <div class="dropdown bootstrap-select w100 show-tick">
                    <select name="y" class="selectpicker w100 show-tick" tabindex="-98" onchange="frm.submit();">
                    @for ($year = date('Y'); $year >= 2020; $year--)
                        <option value="{{ $year }}" @if($_REQUEST['y']==$year){{ __('selected') }}@endif>{{ $year }}</option>
                    @endfor
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row pb100">
        <div class="col-md-4 col-lg-3">
            <div class="article_brd">
                <p>부산일보 신문광고</p>
                <p class="mont">2023-12-05</p>
                <button class="pdf_btn">PDF Download<i class="ri-file-download-line"></i></button>
            </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <div class="article_brd">
                <p>부산일보 신문광고</p>
                <p class="mont">2023-12-04</p>
                <button class="pdf_btn">PDF Download<i class="ri-file-download-line"></i></button>
            </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <div class="article_brd">
                <p>부산일보 신문광고</p>
                <p class="mont">2023-12-02</p>
                <button class="pdf_btn">PDF Download<i class="ri-file-download-line"></i></button>
            </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <div class="article_brd">
                <p>부산일보 신문광고</p>
                <p class="mont">2023-12-01</p>
                <button class="pdf_btn">PDF Download<i class="ri-file-download-line"></i></button>
            </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <div class="article_brd">
                <p>부산일보 신문광고</p>
                <p class="mont">2023-11-29</p>
                <button class="pdf_btn">PDF Download<i class="ri-file-download-line"></i></button>
            </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <div class="article_brd">
                <p>부산일보 신문광고</p>
                <p class="mont">2023-11-25</p>
                <button class="pdf_btn">PDF Download<i class="ri-file-download-line"></i></button>
            </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <div class="article_brd">
                <p>부산일보 신문광고</p>
                <p class="mont">2023-11-20</p>
                <button class="pdf_btn">PDF Download<i class="ri-file-download-line"></i></button>
            </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <div class="article_brd">
                <p>부산일보 신문광고</p>
                <p class="mont">2023-11-15</p>
                <button class="pdf_btn">PDF Download<i class="ri-file-download-line"></i></button>
            </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <div class="article_brd">
                <p>부산일보 신문광고</p>
                <p class="mont">2023-11-10</p>
                <button class="pdf_btn">PDF Download<i class="ri-file-download-line"></i></button>
            </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <div class="article_brd">
                <p>부산일보 신문광고</p>
                <p class="mont">2023-11-01</p>
                <button class="pdf_btn">PDF Download<i class="ri-file-download-line"></i></button>
            </div>
        </div>
    </div>
    <x-pagination :data="$data" />
</form>