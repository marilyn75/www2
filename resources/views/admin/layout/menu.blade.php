@php
  $routeName = Route::currentRouteName();
  $p_id = Route::current()->parameter('p_id');
@endphp

<div class="dashboard_sidebar_menu dn-992">
  <ul class="sidebar-menu">
    <li class="header"><img src="{{ asset('images/header-logo.png') }}" alt="header-logo2.png"></li>
    <li class="title"><span>Main</span></li>
    <li class="treeview @if($routeName=='admin'){{ __('active') }}@endif"><a href="{{ route('admin') }}"><i class="ri-dashboard-line"></i><span>대시보드</span></a></li>
    <li class="treeview @if($routeName=='admin.chat'){{ __('active') }}@endif"><a href="{{ route('admin.chat') }}"><i class="ri-message-3-line"></i><span>채팅문의관리</span></a></li>
    <li class="treeview @if($routeName=='admin.codes'){{ __('active') }}@endif"><a href="{{ route('admin.codes') }}"><i class="ri-archive-2-line"></i><span>공통코드관리</span></a></li>

    <li class="title"><span>Manage Listings</span></li>
    
    <li class="treeview @if(Str::is('admin.users*', $routeName)){{ __('active') }}@endif"><a href="{{ route('admin.users') }}"><i class="ri-user-line"></i><span>회원관리</span></a></li>
    <li class="treeview @if($routeName=='admin.menus'){{ __('active') }}@endif">
      <a href="#n"><i class="ri-menu-line"></i><span>메뉴관리</span><i class="fa fa-angle-down pull-right"></i></a>
      <ul class="treeview-menu">
        <li class="@if($p_id=='1'){{ __('active') }}@endif"><a href="{{ route('admin.menus',1) }}"><i class="fa fa-circle"></i> PC</a></li>
        <li class="@if($p_id=='2'){{ __('active') }}@endif"><a href="{{ route('admin.menus',2) }}"><i class="fa fa-circle"></i> MOBILE</a></li>
      </ul>
    </li>
    <li class="treeview @if(Str::is('admin.board*', $routeName)){{ __('active') }}@endif"><a href="{{ route('admin.board-confs') }}"><i class="ri-file-list-line"></i><span>게시판관리</span></a></li>
    <li class="treeview @if(Str::is('admin.newspaper-ads*', $routeName)){{ __('active') }}@endif"><a href="{{ route('admin.newspaper-ads') }}"><i class="ri-file-list-line"></i><span>신문광고관리</span></a></li>
    <!-- <li class="treeview">
      <a href="page-my-properties.html"><i class="flaticon-home"></i> <span>My Properties</span><i class="fa fa-angle-down pull-right"></i></a>
      <ul class="treeview-menu">
        <li><a href="#"><i class="fa fa-circle"></i> General Elements</a></li>
        <li><a href="#"><i class="fa fa-circle"></i> Advanced Elements</a></li>
        <li><a href="#"><i class="fa fa-circle"></i> Editors</a></li>
      </ul>
    </li>
    <li><a href="page-my-favorites.html"><i class="flaticon-heart"></i> <span> My Favorites</span></a></li>
    <li><a href="page-my-savesearch.html"><i class="flaticon-magnifying-glass"></i> <span>Saved Search</span></a></li>
    <li class="treeview">
      <a href="page-my-review.html"><i class="flaticon-chat"></i><span> Reviews</span><i class="fa fa-angle-down pull-right"></i></a>
      <ul class="treeview-menu">
      <li><a href="#"><i class="fa fa-circle"></i> My Reviews</a></li>
      <li><a href="#"><i class="fa fa-circle"></i> Visitor Reviews</a></li>
      </ul>
    </li>
    <li class="title"><span>Manage Account</span></li>
    <li><a href="page-my-packages.html"><i class="flaticon-box"></i> <span>My Package</span></a></li>
    <li><a href="page-my-profile.html"><i class="flaticon-user"></i> <span>My Profile</span></a></li> -->
    <li><a href="page-login.html"><i class="ri-logout-box-r-line"></i><span>Logout</span></a></li>
  </ul>
</div>