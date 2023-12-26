<div id="page" class="stylehome1 h0">
    <div class="mobile-menu">
        <div class="header stylehome1">
            <div class="d-flex justify-content-between">
                <a class="mobile-menu-trigger" href="#menu"><img src="{{ asset('images/dark-nav-icon.svg') }}" alt=""></a>
                <a class="nav_logo_img" href="index.html"><img class="img-fluid mt20" src="{{ asset('images/new_logo.png') }}" alt="new_logo.png"></a>
                @guest
                <a class="mobile-menu-reg-link" href="{{ route('login') }}"><span class="flaticon-user"></span></a>    
                @endguest
                @auth

                    <a class="mobile-menu-reg-link" href="#" data-toggle="dropdown"><img class="rounded-circle" src="{{ showProfileImage() }}" width="45" height="45"> <span class="dn-1199">{{ Auth::user()->name }}</span></a>
                    <div class="dropdown-menu">
                        <div class="user_setting_content">
                            <a class="dropdown-item" href="{{ route('changepw') }}">비밀번호 변경</a>
                            <a class="dropdown-item" href="{{ route('profile') }}">회원정보 수정</a>
                            <a class="dropdown-item" href="#">Messages</a>
                            <a class="dropdown-item" href="#">Purchase history</a>
                            <a class="dropdown-item" href="#">Help</a>
                            <a class="dropdown-item" href="{{ route('logout') }}">Log out</a>
                        </div>
                    </div>
           
                @endauth
            </div>
        </div>
    </div><!-- /.mobile-menu -->
    <nav id="menu" class="stylehome1">
        <x-menum />
    </nav>
</div>