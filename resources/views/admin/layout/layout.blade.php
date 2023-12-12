<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="advanced search custom, agency, agent, business, clean, corporate, directory, google maps, homes, listing, membership packages, property, real estate, real estate agent, realestate agency, realtor">
    <meta name="description" content="FindHouse - Real Estate HTML Template">
    <meta name="CreativeLayers" content="ATFN">
    <!-- Responsive stylesheet -->
    <link rel="stylesheet" href="{{ url('css/responsive.css') }}">
    <!-- css file -->
    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" href="{{ url('css/dashbord_navitaion.css') }}">
    <!-- Title -->
    <title>FindHouse - Real Estate HTML Template</title>
    <!-- Favicon -->
    <link href="images/favicon.png" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
    <link href="images/favicon.png" sizes="128x128" rel="shortcut icon" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.7.0/fonts/remixicon.css" rel="stylesheet">

    <script type="text/javascript" src="{{ url('js/jquery-3.3.1.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/jquery-migrate-3.0.0.min.js') }}"></script>

    <script type="text/javascript" src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <script type="text/javascript" src="{{ url('js/common.js') }}"></script>
    <script src="{{ url('js/docurl.js') }}"></script>

</head>

<body>
    <div class="wrapper">
        <div class="preloader"></div>

        <!-- Main Header -->
        @include('admin.layout.header')

        <!-- Main Header Nav For Mobile -->
        @include('admin.layout.menum')

        <!-- Main Header Nav For Web -->
        @include('admin.layout.menu')

        <section class="our-dashbord dashbord pb50 dash_contain">
            <div class="container container_w">
                <div class="row">
                    <!-- <div class="col-lg-4 col-xl-2 dn-992 pl0"></div> -->
                    <div class="col-sm-12 col-lg-12 maxw100flex-992">
                        <div class="row">
                            <div class="col-lg-4 col-xl-4 mb10">
                                <div class="breadcrumb_content style2 mb30-991">
                                    <h2 class="breadcrumb_title">@yield('page-title')</h2>
                                    <p>@yield('page-comment')</p>
                                </div>
                            </div>
                            @yield("search")
                            <div class="col-lg-12">



                                @yield('content')




                            </div>
                        </div>
                        <div class="row mt10">
                            <div class="col-lg-12">
                                <div class="copyright-widget text-center">
                                    <p>© 2020 Find House. Made with love.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <a class="scrollToHome" href="#"><i class="flaticon-arrows"></i></a>
    </div>
    <!-- Wrapper End -->


    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script type="text/javascript" src="{{ url('js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/jquery.mmenu.all.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/ace-responsive-menu.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/bootstrap-select.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/snackbar.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/simplebar.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/parallax.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/scrollto.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/jquery-scrolltofixed-min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/jquery.counterup.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/wow.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/progressbar.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/slider.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/timepicker.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/smartuploader.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/dashboard-script.js') }}"></script>
    <!-- Custom script for all pages -->
    <script type="text/javascript" src="{{ url('js/script.js') }}"></script>

</body>

</html>