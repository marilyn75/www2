@php
    // 오늘 본 매물 데이터
    $cls = new App\Http\Class\IntraSaleClass;
    $sales = $cls->getTodayViewSales();
@endphp
<div class="sidebar_recent_product today_pro">
    <h4 class="mb20">오늘 본 매물</h4>
    @if($sales->isSuccess())
    
    @foreach ($sales->getData() as $_data)
    @php
    
    $sale = $cls->getPrintData($_data);

    @endphp
    <div class="media media_w" style="cursor: pointer" onclick="location.href='?mode=show&idx={{ $sale['idx'] }}'">
        <img class="align-self-start" src="{{ $sale['img'] }}">
        <div class="media-body today_inf">
            <h5 class="mt-0 mb-0">{{ $sale['category'] }}</h5>
            <div class="today_loc">{{ $sale['address'] }}</div>
            <a href="#">{{ $sale['tradeType'] }} <span class="mont">{{ $sale['price'] }}</span> 만원</a>
        </div>
    </div>
    @endforeach
    @else
    <div class="nolist">
        <p>{{ $sales->getMessage() }}</p>
    </div>
    @endif
</div>