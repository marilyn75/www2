@extends('layout.layout')

@section('content')
<form name="frm" action="" method="post" class="col-md-12 pl0 pr0">
    @csrf
    <input type="hidden" name="page" value="1">
<section class="our-listing pb30-991">
    <div class="container_w">
        <div class="col-md-12 col-lg-12 pl0 pr0">

            <!-- 검색결과 -->
            <div class="row row_w">
                <div class="grid_list_search_result search_result_w auc_serch">
                    <div class="left_area tac-xsd">
                        <p>검색결과 <span class="mont point_c">{{ number_format(@$data['totalCount']) }}</span>건</p>
                    </div>
                </div>
            </div>
            <!-- 검색결과 end -->

            <!-- 검색필터 -->
            <!-- 경매+공매 -->
            <span class="dropdown-el">
                <input type="radio" name="gubun" value="" id="gubun_ab" @if(@$_REQUEST['gubun']==""){{ __('checked="checked"') }}@endif><label for="gubun_ab">경매+공매</label>
                <input type="radio" name="gubun" value="a" id="gubun_a" @if(@$_REQUEST['gubun']=="a"){{ __('checked="checked"') }}@endif><label for="gubun_a">경매</label>
                <input type="radio" name="gubun" value="b" id="gubun_b" @if(@$_REQUEST['gubun']=="b"){{ __('checked="checked"') }}@endif><label for="gubun_b">공매</label>
            </span>
            <!-- 지분필터 - 전체  -->
            <span class="dropdown-el down_width">
                <input type="radio" name="share" value="0" checked="checked" id="share-all"><label
                    for="share-all">지분필터-전체</label>
                <input type="radio" name="share" value="5" id="share-ex"><label for="share-ex">지분보기</label>
                <input type="radio" name="share" value="6" id="share-out"><label
                    for="share-out">지분제외</label>
            </span>
            <!-- 조회순 -->
            <span class="dropdown-el down_filt">
                <input type="radio" name="filt" value="0" checked="checked" id="sale-ear"><label
                    for="sale-ear">매각기일 빠른</label>
                <input type="radio" name="filt" value="5" id="sale-late"><label for="sale-late">매각기일
                    늦은</label>
                <input type="radio" name="filt" value="6" id="price-hight"><label for="price-hight">최저가
                    높은</label>
                <input type="radio" name="filt" value="6" id="price-low"><label for="price-low">최저가
                    낮은</label>
            </span>

            <script>
            $('.dropdown-el').click(function(e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).toggleClass('expanded');

                var ipName = $('#' + $(e.target).attr('for')).attr('name');
                if($('input[name='+ipName+']:checked').val() != $('#' + $(e.target).attr('for')).attr('value')){
                    frm.page.value = 1;
                    $('#' + $(e.target).attr('for')).prop('checked', true);
                    frm.submit();
                }
                
            });
            $(document).click(function() {
                $('.dropdown-el').removeClass('expanded');
            });
            </script>

            <!-- list -->
            <div class="row mt80 auc_list_r">
            @if(@$data['totalCount']>0)
                @foreach ($data['items'] as $_item)
                @php
                    $printData = (new App\Http\Class\AuctionClass)->getPrintData($_item);
                @endphp
                @if($printData['gubun']=="a")
                <x-item-auction :printData="$printData" />
                @else
                <x-item-onbid :printData="$printData" />
                @endif
                @endforeach
                
            </div>
            <x-pagination type="api" :data="$data" />
            @else
                <div class="nodata_serch">
                    <img src="/images/nodata.png" alt="">
                    <p class="nodata_np">해당매물이 없습니다</p>
                    <p>검색어를 바르게 입력하셨는지 확인하시거나,<br>
                        다른 조건으로 검색해보세요!</p>
                    {{-- <button class="btn btn-thm_w reset_btn">매물 둘러보기</button> --}}
                </div>
            @endif
            <!-- list end -->
        </div>
        <!-- 검색결과 end -->
    </div>
</section>

</form>
@endsection