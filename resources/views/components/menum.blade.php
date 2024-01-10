<ul>
    <li class="mmenu_logo"><img src="/images/mmenu_logo.png" alt=""></li>

    {{-- 로그인 전 --}}
    {{-- <li class="cl_btn"><a class="btn btn-block btn-lg btn-thm" href="#">로그인</a></li> --}}
    
    {{-- 로그인 후 --}}
    <div class="login_ham">
        {{-- 프로필 이미지 --}}
        <img src="http://gyemoim.co.kr/images/user-placeholder.png" alt="">
        <p>계모임</p>
        {{-- 마이페이지 링크로 이동 --}}
        <button class="btn mont">MY<i class="ri-arrow-right-s-fill"></i></button>
    </div>
    
    @foreach ($menus as $menu)
    <x-menum-item :menu="$menu" />
    @endforeach
</ul>

