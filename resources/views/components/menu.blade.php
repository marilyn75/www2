<ul id="respMenu" class="ace-responsive-menu text-left" data-menu-style="horizontal">
    @foreach ($menus as $menu)
    <x-menupc-item :menu="$menu" />
    @endforeach
    

    {{-- <li><a href="{{ route('page', 18) }}?mode=create"><span class="title enter_span">매물등록</span></a></li> --}}
    @guest
    <li class="list-inline-item list_s float-right aaa">
        <a href="{{ route('login') }}" class="btn flaticon-user login_head"> <span class="log_sp">로그인</span></a>
    </li>
    @endguest

    @auth
    <li class="user_setting user_setting_w float-right">
        <div class="dropdown">
            <a class="btn dropdown-toggle my_log_hd" href="#" data-toggle="dropdown">
                <div class="head_img_w">
                    <img src="{{ showProfileImage() }}" width="50" height="50"> 
                </div>
                <span class="dn-1199">{{ Auth::user()->name }}</span>
            </a>
            <div class="dropdown-menu">
                <div class="user_set_header user_set_header_w">
                    <div class="head_img_w">
                        <img class="float-left" src="{{ showProfileImage() }}" width="50" height="50">
                    </div>
                    <p>{{ Auth::user()->name }} <br><span class="address mont">{{ Auth::user()->email }}</span></p>
                </div>
                <div class="user_setting_content user_setting_content_w">
                    <a class="dropdown-item text-dark" href="{{ route('changepw') }}">비밀번호 변경</a>
                    <a class="dropdown-item text-dark" href="{{ route('profile') }}">회원정보 수정</a>
                    <a class="dropdown-item text-dark" href="{{ route('mypage') }}">마이페이지</a>
                    {{-- <a class="dropdown-item text-dark" href="#">Messages</a>
                    <a class="dropdown-item text-dark" href="#">Purchase history</a>
                    <a class="dropdown-item text-dark" href="#">Help</a> --}}
                    <a class="dropdown-item text-dark" href="{{ route('logout') }}">Log out</a>
                </div>
            </div>
        </div>
    </li>
    @endauth
</ul>