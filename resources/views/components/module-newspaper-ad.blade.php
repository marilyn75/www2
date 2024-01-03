

<form name="frm" action="{{ $data->path() }}" method="post" class="col-md-12">
    @csrf
    <input type="hidden" name="page" value="1">
    <div class="article_top mb80">
        <h2>부산일보 신문광고</h2>
        <div class="search_option_two">
            <div class="candidate_revew_select">
                <div class="dropdown bootstrap-select w100 show-tick">
                    <select name="y" class="selectpicker w100 show-tick" tabindex="-98" onchange="frm.submit();">
                    @for ($year = date('Y'); $year >= 2020; $year--)
                        <option value="{{ $year }}" @if(@$_REQUEST['y']==$year){{ __('selected') }}@endif>{{ $year }}</option>
                    @endfor
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- 데이터 없는 경우 -->
    <!-- <div class="row pt100 pb100 nodata">
        <p><i class="ri-information-line"></i>데이터가 없습니다.</p>
    </div> -->
    @if($data->total()>0)

    <div class="row pb100">
        @foreach ($data as $_data)
        @php
        
        $printData = App\Http\Class\NewspaperAdClass::getPrintData($_data);
        
        @endphp
        <div class="col-md-6">
            <div class="article_brd">
                <p class="article_cate">{{ $printData['news_txt'] }}</p>
                <h2>부동산중개법인 개벽 신문광고</h2>
                <div class="article_fot">
                    <div class="article_d">
                        <i class="ri-time-line"></i>   
                        <p class="mont date">{{ $printData['pub_date'] }}</p>
                    </div>
                    <a href="{{ $printData['link'] }}" target="_blank" class="pdf_btn" >PDF Download<i class="ri-file-download-line"></i></a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <x-pagination :data="$data" />

    @else
    <div class="row pt100 pb100 nodata">
        <p><i class="ri-information-line"></i>데이터가 없습니다.</p>
    </div>
    @endif 
</form>