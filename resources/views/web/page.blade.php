@extends('layout.layout')

@section('content')

{{-- 메뉴 이미지가 있는 경우 --}}
@if (!empty($bg))
<section class="inner_page_breadcrumb" style="background-image: url('/files/menu/{{ $bg }}')">
    <div class="container container_w">
        <div class="row">
            <div class="col-xl-6">
                <div class="breadcrumb_content">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        @foreach ($arrLocation as $loc)
                        <li class="breadcrumb-item active" aria-current="page">{{ $loc }}</li>
                        @endforeach
                    </ol>
                    <h4 class="breadcrumb_title">{{ end($arrLocation) }}</h4>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Inner Page Breadcrumb -->
<section class="our-listing bgc-f7 pb30-991">
    <div class="container container_w">
        @empty($bg)
        {{-- <div class="row">
            <div class="col-lg-6">
                <div class="dn db-991">
                    <div id="main2">
                        <span id="open2" class="flaticon-filter-results-button filter_open_btn style3"> Show Filter</span>
                    </div>
                </div>
                <div class="breadcrumb_content style2 mt30-767 mb30-767">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        @foreach ($arrLocation as $loc)
                        <li class="breadcrumb-item active text-thm" aria-current="page">{{ $loc }} </li>
                        @endforeach
                    </ol>
                    <h2 class="breadcrumb_title">{{ end($arrLocation) }}</h2>
                </div>
            </div>
        </div> --}}

        <div class="row">
            <div class="col-lg-6 top-filt">
                <div class="breadcrumb_content style2 breadcrumb_content_w">
                    <h2 class="breadcrumb_title breadcrumb_title_w">Home / {{ implode(" / ", $arrLocation) }}</h2>
                </div>
                <div>
                    <button id="open2" class="filter_btn mont  filter_open_btn filter_btn_w"><i class="ri-equalizer-line"></i>Filter</button>
                </div>
            </div>
        </div>
        @endempty

        <div class="row">
            @if ($page->type == 'C')
            <x-menu-content :page="$page" />
            @elseif ($page->type == 'B')
            <x-menu-board :page="$page" :request="$request" />
            @elseif ($page->type == 'P')
                @php
                    $module = "Module".$page->program_module;
                @endphp
            <x-dynamic-component :component="$module" :page="$page" :request="$request"/>
            @elseif ($page->type == 'W')
            <x-menu-wait />
            @endif
        </div>
    </div>
</section>

@endsection