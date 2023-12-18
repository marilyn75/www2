@extends('layout.layout')

@section('content')

<!-- mybox -->
<section class="my_profile_bx">
    <div class="container container_w">
        <div class="my_bx">
            <div class="my_bx_lf">
                <div class="my_bx_pimg">
                    <img class="float-left" src="{{ showProfileImage() }}">
                </div>
                <div class="my_bx_inf">
                    <p>{{ Auth::user()->name }}</p>
                    <p><span class="address mont">{{ Auth::user()->email }}</span></p>
                    <button class="btn btn-thm btn-thm_w"><a href="">프로필 관리</a></button>
                </div>
            </div>
            <div class="my_bx_rg">
                <div class="my_bx_count my_bx_heart">
                    <p>관심매물</p>
                    <h3 class="mont">5</h3>
                </div>
                <div class="my_bx_line"></div>
                <div class="my_bx_count my_bx_recent">
                    <p>최근 본 매물</p>
                    <h3 class="mont">2</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pb100 list_bx">
    <div class="container container_w">
        <ul class="menu_link">
            <li><a href="#" class="on">관심매물</a></li>
            <li><a href="#">최근 본 매물</a></li>
        </ul>
        <div class="row">

            {{-- 관심 매물이 없는 경우 --}}
            <div class="col-lg-12 pt100 pb100 nolist">
                <p>등록된 관심매물이 없습니다.</p>
                <a class="btn btn-thm btn-thm_w">매물 보러가기</a>
            </div>

        </div>
    </div>
</section>

@endsection