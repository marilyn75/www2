@extends('layout.layout')

@section('content')

<!-- Inner Page Breadcrumb -->
<section class="inner_page_breadcrumb"
@if (!empty($bg))
    style="background-image: url('/files/menu/{{ $bg }}')"    
@endif
>
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="breadcrumb_content">
                    <h4 class="breadcrumb_title">{{ end($arrLocation) }}</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        @foreach ($arrLocation as $loc)
                        <li class="breadcrumb-item active" aria-current="page">{{ $loc }}</li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="our-shop bgc-f7">
    <div class="container">
        <div class="row">
            @if ($page->type == 'C')
            <x-menu-content :page="$page" />
            @elseif ($page->type == 'B')
            <x-menu-board :page="$page" :request="$request" />
            @elseif ($page->type == 'W')
            <x-menu-wait />
            @endif
        </div>
    </div>
</section>

@endsection