<ul>
    <li class="mmenu_logo"><img src="/images/mmenu_logo.png" alt=""></li>
    <li class="cl_btn"><a class="btn btn-block btn-lg btn-thm" href="#">로그인</a></li>
    @foreach ($menus as $menu)
    <x-menum-item :menu="$menu" />
    @endforeach
</ul>