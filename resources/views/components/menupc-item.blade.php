<li>
    <a href="{{ $menu['link'] }}" @if(!empty($menu['target'])) target="{{ $menu['target'] }}" @endif ><span class="title">{{ $menu['txt'] }}</span></a>
    @if(!empty($menu['submenu']))
    <ul class="sub_menu">
        @foreach ($menu['submenu'] as $submenu)
        <x-menupc-item :menu="$submenu" />
        @endforeach
    </ul>
    @endif
</li>