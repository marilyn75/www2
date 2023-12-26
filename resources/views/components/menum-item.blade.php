<li>
    @if ($menu['link']=="#")
    <span>{{ $menu['txt'] }}</span>
    @else 
    <a href="{{ $menu['link'] }}" @if(!empty($menu['target'])) target="{{ $menu['target'] }}" @endif ><span>{{ $menu['txt'] }}</span></a>   
    @endif
    @if(!empty($menu['submenu']))
    <ul>
        @foreach ($menu['submenu'] as $submenu)
        <x-menum-item :menu="$submenu" />
        @endforeach
    </ul>
    @endif
</li>