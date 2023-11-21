@if (Request::is('/'))
<header class="header-nav menu_style_home_one home7 navbar-scrolltofixed stricky main-menu">
@else
<header class="header-nav menu_style_home_one style2 home10 navbar-scrolltofixed stricky main-menu main-menu_w">
@endif

	<div class="container container_w">
		<!-- Ace Responsive Menu -->
		<nav>
			<!-- Menu Toggle btn-->
			<div class="menu-toggle">
				<img class="nav_logo_img img-fluid" src="{{ asset('images/header-logo.png') }}" alt="header-logo.png">
				<button type="button" id="menu-btn">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<a href="{{ route('main') }}" class="navbar_brand float-left dn-smd">
				<img class="logo1 img-fluid" src="{{ asset('images/logo_test.png') }}" alt="header-logo.png">
				<img class="logo2 img-fluid" src="{{ asset('images/logo_test.png') }}" alt="header-logo2.png">
			</a>
			<!-- Responsive Menu Structure-->
			<!--Note: declare the Menu style in the data-menu-style="horizontal" (options: horizontal, vertical, accordion) -->
			
			<x-menu />

		</nav>
	</div>
</header>