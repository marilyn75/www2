@extends('layout.layout')

@section('content')

<!-- Inner Page Breadcrumb -->
<section class="our-listing bgc-f7 pb30-991">
    <div class="container">

        <div class="row">
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
        </div>

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