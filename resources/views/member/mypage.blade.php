@extends('layout.layout')

@section('content')

<!-- mybox -->
<section class="my_profile_bx">
    <div class="container container_w">
        <div class="my_bx">
            <div class="my_bx_lf">
                <div class="my_bx_pimg">
                    <img class="float-left" src="{{ showProfileImage() }}">
                </div>
                <div class="my_bx_inf">
                    <p>{{ Auth::user()->name }}</p>
                    <p><span class="address mont">{{ Auth::user()->email }}</span></p>
                    <button class="btn btn-thm btn-thm_w"><a href="{{ route('profile') }}">프로필 관리</a></button>
                </div>
            </div>
            <div class="my_bx_rg">
                <div class="my_bx_count my_bx_heart">
                    <p>관심매물</p>
                    <h3 class="mont">{{ $data['favorites']->getDataCount() }}</h3>
                </div>
                <div class="my_bx_line"></div>
                <div class="my_bx_count my_bx_recent">
                    <p>최근 본 매물</p>
                    <h3 class="mont">{{ $data['todayViewSales']->getDataCount() }}</h3>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- <section class="pb100 list_bx">
    <div class="container container_w">
        <ul class="menu_link">
            <li><a href="#" class="on">관심매물</a></li>
            <li><a href="#">최근 본 매물</a></li>
        </ul>
        <div class="row">
            <div class="col-lg-12 pt100 pb100 nolist">
                <p>등록된 관심매물이 없습니다.</p>
                <a class="btn btn-thm btn-thm_w">매물 보러가기</a>
            </div>
        </div>
    </div>
</section> --}}

<section class="pb100 list_bx">
    <div class="container container_w">
        <div class="">
            <div class="ui_kit_tab">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs menu_link" id="myTab2" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#item1-tab">관심매물</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#item2-tab">최근 본 매물</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#item3-tab">관심 경공매</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#item4-tab">최근 본 경공매</a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content" id="myTabContent2">

                    <div id="item1-tab" class="pb150 tab-pane active">
                        @if ($data['favorites']->isSuccess() && $data['favorites']->getDataCount() > 0)
                        <div class="row">
                            @foreach ($data['favorites']->getData() as $printData)
                                <x-item-sale-intranet type='' :printData="$printData" />
                            @endforeach
                        </div>
                        @else
                        <div class="nolist">
                            <p>등록된 관심매물이 없습니다.</p>
                            <a class="btn btn-thm btn-thm_w" href="{{ env('MENU_LINK_INTRA_SALE') }}">매물 보러가기</a>
                        </div>
                        @endif
                    </div>
                    
                    {{-- 최근 본 매물이 없을 때 --}}
                    <div id="item2-tab" class=" pb100 tab-pane nolist fade">
                        @if ($data['todayViewSales']->isSuccess())
                        <div class="row">
                            @foreach ($data['todayViewSales']->getData() as $printData)
                            @php
                                $printData = App\Http\Class\IntraSaleClass::getPrintData($printData);
                            @endphp
                                <x-item-sale-intranet type='' :printData="$printData" />
                            @endforeach
                        </div>
                        @else
                        <div class="nolist">
                            <p>{{ $data['todayViewSales']->getMessage() }}</p>
                            <a class="btn btn-thm btn-thm_w" href="{{ env('MENU_LINK_INTRA_SALE') }}">매물 보러가기</a>
                        </div>
                        @endif
                    </div>

                    <div id="item3-tab" class=" pb100 tab-pane nolist fade">
                        @if ($data['todayViewSales']->isSuccess())
                        <div class="row">
                            @foreach ($data['todayViewSales']->getData() as $printData)
                            @php
                                $printData = App\Http\Class\IntraSaleClass::getPrintData($printData);
                            @endphp
                                <x-item-sale-intranet type='' :printData="$printData" />
                            @endforeach
                        </div>
                        @else
                        <div class="nolist">
                            <p>{{ $data['todayViewSales']->getMessage() }}</p>
                            <a class="btn btn-thm btn-thm_w" href="{{ env('MENU_LINK_AUCTION') }}">경매 보러가기</a>
                        </div>
                        @endif
                    </div>

                    <div id="item4-tab" class=" pb100 tab-pane nolist fade">
                        @if ($data['todayViewAuction']->isSuccess())
                        <div class="row">
                            @foreach ($data['todayViewSales']->getData() as $printData)
                            @php
                                $printData = App\Http\Class\IntraSaleClass::getPrintData($printData);
                            @endphp
                                <x-item-sale-intranet type='' :printData="$printData" />
                            @endforeach
                        </div>
                        @else
                        <div class="nolist">
                            <p>{{ $data['todayViewSales']->getMessage() }}</p>
                            <a class="btn btn-thm btn-thm_w" href="{{ env('MENU_LINK_AUCTION') }}">경매 보러가기</a>
                        </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
    
</section>

@endsection