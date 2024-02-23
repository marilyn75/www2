
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

    @if ($page->type == 'C')
    <x-menu-content :page="$page" />
    @endif
