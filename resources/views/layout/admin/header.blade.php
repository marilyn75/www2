<header class="header-nav menu_style_home_one style2 menu-fixed main-menu">
    <div class="container-fluid p0">
        <!-- Ace Responsive Menu -->
        <nav>
            <!-- Menu Toggle btn-->

            <a href="#" class="navbar_brand float-left dn-smd">
                <img class="logo1 img-fluid" src="images/header-logo2.png" alt="header-logo.png">
                <img class="logo2 img-fluid" src="images/header-logo2.png" alt="header-logo2.png">
            </a>
            <!-- Responsive Menu Structure-->
            <!--Note: declare the Menu style in the data-menu-style="horizontal" (options: horizontal, vertical, accordion) -->
            <ul id="respMenu" class="ace-responsive-menu text-left" data-menu-style="horizontal">
                <li style="width:195px">
                </li>
                <li class="">
                    <div>
                        <a class="btn" href="#" ><img class="rounded-circle" src="{{ showProfileImage() }}" width="45" height="45"> <span class="dn-1199">{{ Auth::user()->name }}</span></a>
                    </div>
                </li>
                <li>
                    <a class="btn" href="{{ route('admin') }}" >Dashboard</a>
                </li>
                <li>
                    <a class="btn" href="{{ route('logout') }}" >Logout</a>
                </li>
            </ul>
        </nav>
    </div>
</header>