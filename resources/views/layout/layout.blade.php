<!DOCTYPE html>
<html dir="ltr" lang="ko">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="advanced search custom, agency, agent, business, clean, corporate, directory, google maps, homes, listing, membership packages, property, real estate, real estate agent, realestate agency, realtor">
<meta name="description" content="FindHouse - Real Estate HTML Template">
<meta name="CreativeLayers" content="ATFN">
<!-- Responsive stylesheet -->
<link rel="stylesheet" href="{{ url('css/responsive.css') }}">
<!-- Title -->
<title>GYEMOIM INC.</title>
<!-- Favicon -->
<link href="{{ url('images/favicon.ico') }}" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
<link href="{{ url('images/favicon.ico') }}" sizes="128x128" rel="shortcut icon" />

<link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

<script type="text/javascript" src="{{ url('js/jquery-3.3.1.js') }}"></script>
<script type="text/javascript" src="{{ url('js/jquery-migrate-3.0.0.min.js') }}"></script>

<script type="text/javascript" src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<!-- Link Swiper's CSS -->
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script src="{{ url('js/common.js') }}"></script>
<script src="{{ url('js/docurl.js') }}"></script>

<!-- css file -->
<link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ url('css/style.css') }}">
</head>

<body>
<div class="wrapper">
	<div class="preloader"></div>

	<!-- Main Header Nav -->
	@include('layout.menu')

	<!-- Main Header Nav For Mobile -->
	@include('layout.menum')

	@yield('content')	

	<!-- Our Footer -->
	@include('layout.footer')

	<!-- Our Footer Bottom Area -->
	@include('layout.bottom')
<a class="scrollToHome home7" href="#"><i class="flaticon-arrows"></i></a>
</div>

<!-- 채팅 아이콘 -->
<x-ChatIcon />

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Wrapper End -->
<script type="text/javascript" src="{{ url('js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/jquery.mmenu.all.js') }}"></script>
<script type="text/javascript" src="{{ url('js/ace-responsive-menu.js') }}"></script>
<script type="text/javascript" src="{{ url('js/bootstrap-select.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/isotop.js') }}"></script>
<script type="text/javascript" src="{{ url('js/snackbar.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/simplebar.js') }}"></script>
<script type="text/javascript" src="{{ url('js/parallax.js') }}"></script>
<script type="text/javascript" src="{{ url('js/scrollto.js') }}"></script>
<script type="text/javascript" src="{{ url('js/jquery-scrolltofixed-min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/jquery.counterup.js') }}"></script>
<script type="text/javascript" src="{{ url('js/wow.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/slider.js') }}"></script>
<script type="text/javascript" src="{{ url('js/timepicker.js') }}"></script>
<script type="text/javascript" src="{{ url('js/smartuploader.js') }}"></script>
<!-- Custom script for all pages --> 
<script type="text/javascript" src="{{ url('js/script.js') }}"></script>

<script type="text/javascript" src="{{ url('js/lib/common.simple.js') }}"></script>
<script type="text/javascript" src="{{ url('js/lib/formcheck.js') }}"></script>
</body>
</html>