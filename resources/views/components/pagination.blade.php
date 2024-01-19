@php
    $length = 3;
    $rest = $length % 2;
    $start = ($data->currentPage() - ($length - $rest) / 2);
    if($start < 1) $start = 1;
    if($start + $length > $data->lastPage()){
        // $length = $data->lastPage() - $start + 1;
        $start = $data->lastPage() - $length + 1;
    } 
    $max = $start + $length;

    if($start < 1) $start = 1;

    
@endphp

@if(false)
<div class="col-lg-12 mt20">
    <div class="mbp_pagination">
        <ul class="page_navigation">
            <li class="page-item @if($data->currentPage()==1) disabled @endif">
                <a class="page-link" href="@if($data->currentPage()==1)#@else{{ $data->path()."?page=".(intval($data->currentPage()) - 1) }}@endif" tabindex="-1" aria-disabled="true"> <span class="flaticon-left-arrow"></span></a>
            </li>
            @if($start > 1)
            <li class="page-item"><a class="page-link" href="{{ $data->path()."?page=1" }}">1</a></li>
            <li class="page-item"><a class="page-link" href="#">...</a></li>
            @endif

            @for ($pg=$start; $pg<$max; $pg++)
                @if ($data->currentPage() == $pg)
                <li class="page-item active" aria-current="page">
                    <a class="page-link" href="#">{{ $pg }} <span class="sr-only">(current)</span></a>
                </li>
                @else
                <li class="page-item"><a class="page-link" href="{{ $data->path()."?page=".$pg }}">{{ $pg }}</a></li>
                @endif
            @endfor

            @if($data->lastPage() >= $max)
            <li class="page-item"><a class="page-link" href="#">...</a></li>
            <li class="page-item"><a class="page-link" href="{{ $data->path()."?page=".$data->lastPage() }}">{{ $data->lastPage() }}</a></li>
            @endif
            <li class="page-item @if($data->currentPage()==$data->lastPage()) disabled @endif">
                <a class="page-link" href="@if($data->currentPage()==$data->lastPage())#@else{{ $data->path()."?page=".(intval($data->currentPage()) + 1) }}@endif"><span class="flaticon-right-arrow"></span></a>
            </li>
        </ul>
    </div>
</div>
{{-- @elseif($data->lastPage()>1) --}}
@else
<div class="col-lg-12 mt20">
    <div class="mbp_pagination">
        <ul class="page_navigation">
            <li class="page-item @if($data->currentPage()==1) disabled @endif">
                <a class="page-link" href="@if($data->currentPage()==1)#@else{{ __("javascript:goPage(".(intval($data->currentPage()) - 1).");") }}@endif" tabindex="-1" aria-disabled="true"> <span class="flaticon-left-arrow"></span></a>
            </li>
            @if($start > 1)
            <li class="page-item"><a class="page-link" href="{{ __("javascript:goPage(1);") }}">1</a></li>
            <li class="page-item"><a class="page-link" href="#">...</a></li>
            @endif

            @for ($pg=$start; $pg<$max; $pg++)
                @if ($data->currentPage() == $pg)
                <li class="page-item active" aria-current="page">
                    <a class="page-link" href="#">{{ $pg }} <span class="sr-only">(current)</span></a>
                </li>
                @else
                <li class="page-item"><a class="page-link" href="{{ __("javascript:goPage(".$pg.");") }}">{{ $pg }}</a></li>
                @endif
            @endfor

            @if($data->lastPage() >= $max)
            <li class="page-item"><a class="page-link" href="#">...</a></li>
            <li class="page-item"><a class="page-link" href="{{ __("javascript:goPage(".$data->lastPage().");") }}">{{ $data->lastPage() }}</a></li>
            @endif
            <li class="page-item @if($data->currentPage()==$data->lastPage()) disabled @endif">
                <a class="page-link" href="@if($data->currentPage()==$data->lastPage())#@else{{ __("javascript:goPage(".(intval($data->currentPage()) + 1).");") }}@endif"><span class="flaticon-right-arrow"></span></a>
            </li>
        </ul>
    </div>
</div>
@endif

<script>
    function goPage(pg){
        document.forms[0].page.value = pg;
        document.forms[0].submit();
    }
</script>