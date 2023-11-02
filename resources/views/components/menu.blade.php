<ul id="respMenu" class="ace-responsive-menu text-right" data-menu-style="horizontal">
    @foreach ($menus as $menu)
    <li>
        <a href="{{ $menu['link'] }}" @if(!empty($menu['target'])) target="{{ $menu['target'] }}" @endif ><span class="title">{{ $menu['txt'] }}</span></a>
        @if(!empty($menu['submenu']))
        <ul>
            @foreach ($menu['submenu'] as $submenu)
            <li><a href="{{ $submenu['link'] }}" @if(!empty($submenu['target'])) target="{{ $submenu['target'] }}" @endif ><span class="title">{{ $submenu['txt'] }}</span></a></li>
            @endforeach
        </ul>
        @endif
    </li>
    @endforeach
    
    @guest
    <li class="list-inline-item list_s">
        {{-- <a href="#" class="btn flaticon-user" data-toggle="modal" data-target=".bd-example-modal-lg"> <span class="dn-lg text-thm3">Login/Register</span></a> --}}
        <a href="{{ route('login') }}" class="btn flaticon-user" > <span class="dn-lg text-thm3">Login/Register</span></a>
    </li>    
    @endguest

    @auth
    <li class="user_setting">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" data-toggle="dropdown"><img class="rounded-circle" src="{{ showProfileImage() }}" width="45" height="45"> <span class="dn-1199">{{ Auth::user()->name }}</span></a>
            <div class="dropdown-menu">
                <div class="user_set_header">
                    <img class="float-left" src="{{ showProfileImage() }}" width="45" height="45">
                    <p>{{ Auth::user()->name }} <br><span class="address">{{ Auth::user()->email }}</span></p>
                </div>
                <div class="user_setting_content">
                    <a class="dropdown-item text-dark" href="{{ route('changepw') }}">비밀번호 변경</a>
                    <a class="dropdown-item text-dark" href="{{ route('profile') }}">회원정보 수정</a>
                    <a class="dropdown-item text-dark" href="#">Messages</a>
                    <a class="dropdown-item text-dark" href="#">Purchase history</a>
                    <a class="dropdown-item text-dark" href="#">Help</a>
                    <a class="dropdown-item text-dark" href="{{ route('logout') }}">Log out</a>
                </div>
            </div>
        </div>
    </li>
    @endauth
    <li class="list-inline-item add_listing"><a href="{{ route('page', 18) }}?mode=create"><span class="flaticon-plus"></span><span class="dn-lg"> 매물등록</span></a></li>
</ul>