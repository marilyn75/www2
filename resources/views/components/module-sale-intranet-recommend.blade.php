<form name="frm" action="{{ $data->path() }}" method="post" class="" >
    @csrf
    <input type="hidden" name="page" value="1">
    <input type="hidden" name="mode" value="{{ $request->mode }}">
<section class="our-listing bgc-f7 pb30-991">
    <div class="container container_w">
        <div class="row">
            <div class="col-12">
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
                    <div class="nodata_serch">
                        <img src="/images/nodata.png" alt="">
                        <p class="nodata_np">추천매물이 없습니다</p>
                        <p>현재 추천중인 매물이 없습니다. 다른 매물을 둘러보세요!</p>
                        <a href="{{ route('page',20) }}" class="btn btn-thm_w">매물 둘러보기</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>


<a class="scrollToHome" href="#"><i class="flaticon-arrows"></i></a>
</form>