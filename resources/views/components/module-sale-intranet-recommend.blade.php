<form name="frm" action="{{ $data->path() }}" method="post" class="row">
    @csrf
    <input type="hidden" name="page" value="1">
    <input type="hidden" name="mode" value="{{ $_REQUEST['mode'] }}">
<section class="our-listing bgc-f7 pb30-991">
    <div class="container container_w">
        <section class="row top_cate pt-0">
            <div class="cate_wrap">
                <div class="cate_bg">
                    <img src="/images/top_cate/busanilbo.png" alt="">
                </div>
                <p>부산일보</p>
            </div>
            <div class="cate_wrap">
                <div class="cate_bg"></div>
                <p>부산일보</p>
            </div>
            <div class="cate_wrap">
                <div class="cate_bg"></div>
                <p>부산일보</p>
            </div>
            <div class="cate_wrap">
                <div class="cate_bg"></div>
                <p>부산일보</p>
            </div>
            <div class="cate_wrap">
                <div class="cate_bg"></div>
                <p>부산일보</p>
            </div>
            <div class="cate_wrap">
                <div class="cate_bg"></div>
                <p>부산일보</p>
            </div>
        </section>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    @foreach ($data as $_data)
                    @php
                    
                    $printData = App\Http\Class\IntraSaleClass::getPrintData($_data);

                    if(!empty($favorites) && in_array($printData['idx'], $favorites))   $printData['isFavorite'] = true;

                    @endphp
                    <x-item-sale-intranet type='recommend' :printData="$printData" />

                    @endforeach
                    <x-pagination :data="$data" />
                </div>
            </div>
        </div>
    </div>
</section>


<a class="scrollToHome" href="#"><i class="flaticon-arrows"></i></a>
</form>