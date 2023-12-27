<!-- Nav tabs -->
{{-- <ul class="nav nav-tabs menu_link" id="myTab2" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#item1-tab">부동산</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#item2-tab">사회</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#item2-tab">증권금융</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#item2-tab">추천뉴스</a>
    </li>
</ul> --}}

<div class="row mt20">
    @for ($i=0;$i<12;$i++)
    <div class="col-sm-6 col-md-6 col-lg-4">
        <div class="news_w">
            <a href="https://www.busan.com/view/busan/view.php?code={{ $data[$i]['CODE'] }}" target="_blank">
                <div class="thumb">
                    <img class="img-fluid w100" src="{{ __('https://www.busan.com/nas/wcms/wcms_data/photos/').$data[$i]['IMG_PATH'] }}" alt="{{ $data[$i]['IMG_PATH'] }}">
                </div>
                <div class="details news_details">
                    <p class="mont">News</p>
                    <h4>
                        {{ $data[$i]['TITLE'] }}
                    </h4>
                    <p class="mont">{{ str_replace("-",".",$data[$i]['PUB_DATE']) }}</p>
                </div>
            </a>
        </div>
    </div>    
    @endfor
    
    
</div>