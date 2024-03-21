@extends('layout.layout-popup')

@section('content')

<!-- Inner Page Breadcrumb -->
<section class="our-listing pb30-991">
    <div class="container container_w">

        <div class="">
            @if ($page->type == 'B')
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
    @if ($page->type == 'C')
    <div><x-menu-content :page="$page" /></div>
    @endif
</section>

@endsection