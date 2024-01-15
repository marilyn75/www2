<ul>
    <li class="mmenu_logo"><img src="/images/mmenu_logo.png" alt=""></li>
    @auth
    {{-- 로그인 후 --}}
    <div class="login_ham">
        {{-- 프로필 이미지 --}}
        <img src="{{ showProfileImage() }}" alt="">
        <p>{{ Auth::user()->name }}</p>
        {{-- 마이페이지 링크로 이동 --}}
        <button class="btn mont"><a href="{{ route('mypage') }}">MY<i class="ri-arrow-right-s-fill"></i></a></button>
    </div>
    @else 
    {{-- 로그인 전 --}}
    <li class="cl_btn"><a class="btn btn-block btn-lg btn-thm" href="{{ route('login') }}">로그인</a></li>
    @endauth
    
    @foreach ($menus as $menu)
    <x-menum-item :menu="$menu" />
    @endforeach
</ul>

