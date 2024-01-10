<form name="frm" action="{{ $data->path() }}" method="post" class="" >
    @csrf
    <input type="hidden" name="page" value="1">
    <input type="hidden" name="mode" value="{{ $_REQUEST['mode'] }}">
<section class="our-listing bgc-f7 pb30-991">
    <div class="container container_w">
        <div class="row">
            <div class="">
                <div class="row">
                    @if($data->total() > 0)
                    @foreach ($data as $_data)
                    @php
                    
                    $printData = App\Http\Class\IntraSaleClass::getPrintData($_data);

                    if(!empty($favorites) && in_array($printData['idx'], $favorites))   $printData['isFavorite'] = true;

                    @endphp
                    <x-item-sale-intranet type='recommend' :printData="$printData" />

                    @endforeach
                    <x-pagination :data="$data" />
                    @else
                    *** 추천 매물이 없습니다. 마크업 부분 ***
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>


<a class="scrollToHome" href="#"><i class="flaticon-arrows"></i></a>
</form>