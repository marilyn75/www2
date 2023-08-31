<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="advanced search custom, agency, agent, business, clean, corporate, directory, google maps, homes, listing, membership packages, property, real estate, real estate agent, realestate agency, realtor">
<meta name="description" content="FindHouse - Real Estate HTML Template">
<meta name="CreativeLayers" content="ATFN">
<!-- css file -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/dashbord_navitaion.css">
<!-- Responsive stylesheet -->
<link rel="stylesheet" href="css/responsive.css">
<!-- Title -->
<title>FindHouse - Real Estate HTML Template</title>
<!-- Favicon -->
<link href="images/favicon.ico" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
<link href="images/favicon.ico" sizes="128x128" rel="shortcut icon" />

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script src="{{ url('js/common.js') }}"></script>
</head>
<body>
<div class="wrapper">
	<div class="preloader"></div>

	<!-- Main Header -->
	@include('layout.admin.header')

	<!-- Main Header Nav For Mobile -->
	@include('layout.admin.menum')

    <!-- Main Header Nav For Web -->
    @include('layout.admin.menu')

    @yield('content')
	
<a class="scrollToHome" href="#"><i class="flaticon-arrows"></i></a>
</div>
<!-- Wrapper End -->
<script type="text/javascript" src="{{ url('js/jquery-3.3.1.js') }}"></script>
<script type="text/javascript" src="{{ url('js/jquery-migrate-3.0.0.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/jquery.mmenu.all.js') }}"></script>
<script type="text/javascript" src="{{ url('js/ace-responsive-menu.js') }}"></script>
<script type="text/javascript" src="{{ url('js/chart.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/chart-custome.js') }}"></script>
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
<script type="text/javascript" src="{{ url('js/wow.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/dashboard-script.js') }}"></script>
<!-- Custom script for all pages --> 
<script type="text/javascript" src="{{ url('js/script.js') }}"></script>
</body>
</html>
