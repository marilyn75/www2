@if (Request::is('/'))
<header class="header-nav menu_style_home_one home7 navbar-scrolltofixed stricky main-menu">
@else
<header class="header-nav menu_style_home_one style2 home10 navbar-scrolltofixed stricky main-menu">	
@endif

	<div class="container p0">
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
				<img class="logo1 img-fluid" src="{{ asset('images/header-logo.png') }}" alt="header-logo.png">
				<img class="logo2 img-fluid" src="{{ asset('images/header-logo2.png') }}" alt="header-logo2.png">
			</a>
			<!-- Responsive Menu Structure-->
			<!--Note: declare the Menu style in the data-menu-style="horizontal" (options: horizontal, vertical, accordion) -->
			<ul id="respMenu" class="ace-responsive-menu text-right" data-menu-style="horizontal">
				@foreach ((new \App\Http\Class\MenuClass())->getMenus() as $menu)
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
				{{-- <li>
					<a href="#"><span class="title">Home</span></a>
					<!-- Level Two-->
					<ul>
						<li><a href="index.html">Home 1</a></li>
						<li><a href="index2.html">Home 2</a></li>
						<li><a href="index3.html">Home 3</a></li>
						<li><a href="index4.html">Home 4</a></li>
						<li><a href="index5.html">Home 5</a></li>
						<li><a href="index6.html">Home 6</a></li>
						<li><a href="index7.html">Home 7</a></li>
						<li><a href="index8.html">Home 8</a></li>
						<li><a href="index9.html">Home 9</a></li>
						<li><a href="index10.html">Home 10</a></li>
					</ul>
				</li>
				<li>
					<a href="#"><span class="title">Listing</span></a>
					<!-- Level Two-->
					<ul>
						<li>
							<a href="#">Listing Grid</a>
							<!-- Level Three-->
							<ul>
								<li><a href="page-listing-grid-v1.html">Grid v1</a></li>
								<li><a href="page-listing-grid-v2.html">Grid v2</a></li>
								<li><a href="page-listing-grid-v3.html">Grid v3</a></li>
								<li><a href="page-listing-grid-v4.html">Grid v4</a></li>
								<li><a href="page-listing-grid-v5.html">Grid v5</a></li>
								<li><a href="page-listing-full-width-grid.html">Grid Fullwidth</a></li>
							</ul>
						</li>
						<li>
							<a href="#">Listing List</a>
							<!-- Level Three-->
							<ul>
								<li><a href="page-listing-list.html">List V1</a></li>
							</ul>
						</li>
						<li>
							<a href="#">Listing Style</a>
							<!-- Level Three-->
							<ul>
								<li><a href="page-listing-parallax.html">Parallax Style</a></li>
								<li><a href="page-listing-slider.html">Slider Style</a></li>
								<li><a href="page-listing-map.html">Map Header</a></li>
							</ul>
						</li>
						<li>
							<a href="#">Listing Half</a>
							<!-- Level Three-->
							<ul>
								<li><a href="page-listing-half-map-v1.html">Map V1</a></li>
								<li><a href="page-listing-half-map-v2.html">Map V2</a></li>
								<li><a href="page-listing-half-map-v3.html">Map V3</a></li>
								<li><a href="page-listing-half-map-v4.html">Map V4</a></li>
							</ul>
						</li>
						<li>
							<a href="#">Agent View</a>
							<!-- Level Three-->
							<ul>
								<li><a href="page-listing-agent-v1.html">Agent V1</a></li>
								<li><a href="page-listing-agent-v2.html">Agent V2</a></li>
								<li><a href="page-listing-agent-v3.html">Agent Details</a></li>
							</ul>
						</li>
						<li>
							<a href="#">Agencies View</a>
							<!-- Level Three-->
							<ul>
								<li><a href="page-listing-agencies-v1.html">Agencies V1</a></li>
								<li><a href="page-listing-agencies-v2.html">Agencies V2</a></li>
								<li><a href="page-listing-agencies-v3.html">Agencies Details</a></li>
							</ul>
						</li>
						<li><a href="page-add-new-property.html">Create Listing</a></li>
					</ul>
				</li>
				<li>
					<a href="#"><span class="title">Property</span></a>
					<ul>
						<li>
							<a href="#">User Admin</a>
							<ul>
								<li><a href="page-dashboard.html">Dashboard</a></li>
								<li><a href="page-my-properties.html">My Properties</a></li>
								<li><a href="page-message.html">My Message</a></li>
								<li><a href="page-my-review.html">My Review</a></li>
								<li><a href="page-my-favorites.html">My Favorites</a></li>
								<li><a href="page-add-new-property.html">Add Property</a></li>
								<li><a href="page-my-profile.html">My Profile</a></li>
							</ul>
						</li>
						<li>
							<a href="#">Listing Single</a>
							<!-- Level Three-->
							<ul>
								<li><a href="page-listing-single-v1.html">Single V1</a></li>
								<li><a href="page-listing-single-v2.html">Single V2</a></li>
								<li><a href="page-listing-single-v3.html">Single V3</a></li>
								<li><a href="page-listing-single-v4.html">Single V4</a></li>
								<li><a href="page-listing-single-v5.html">Single V5</a></li>
							</ul>
						</li>
						<li><a href="page-add-new-property.html">Create Listing</a></li>
					</ul>
				</li>
				<li>
					<a href="#"><span class="title">Pages</span></a>
					<ul>
						<li>
							<a href="#"><span class="title">Pages</span></a>
							<ul>
								<li><a href="page-shop.html">Shop</a></li>
								<li><a href="page-shop-single.html">Shop Single</a></li>
								<li><a href="page-shop-cart.html">Cart</a></li>
								<li><a href="page-shop-checkout.html">Checkout</a></li>
								<li><a href="page-shop-order.html">Order</a></li>
							</ul>
						</li>
						<li><a href="page-about.html">About Us</a></li>
						<li><a href="page-gallery.html">Gallery</a></li>
						<li><a href="page-faq.html">Faq</a></li>
						<li><a href="page-login.html">LogIn</a></li>
						<li><a href="page-compare.html">Membership</a></li>
						<li><a href="page-compare2.html">Membership 2</a></li>
						<li><a href="page-register.html">Register</a></li>
						<li><a href="page-service.html">Service</a></li>
						<li><a href="page-error.html">404 Page</a></li>
						<li><a href="page-terms.html">Terms and Conditions</a></li>
						<li><a href="page-ui-element.html">UI Elements</a></li>
					</ul>
				</li>
				<li>
					<a href="#"><span class="title">Blog</span></a>
					<ul>
						<li><a href="page-blog-v1.html">Blog List 1</a></li>
						<li><a href="page-blog-grid.html">Blog List 2</a></li>
						<li><a href="page-blog-single.html">Single Post</a></li>
					</ul>
				</li>
				<li class="last">
					<a href="page-contact.html"><span class="title">Contact</span></a>
				</li> --}}
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
				<li class="list-inline-item add_listing"><a href="page-add-new-property.html"><span class="flaticon-plus"></span><span class="dn-lg"> 매물등록</span></a></li>
			</ul>
		</nav>
	</div>
</header>