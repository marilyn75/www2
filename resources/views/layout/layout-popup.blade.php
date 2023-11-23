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
    <!-- Title -->
    <title>FindHouse - Real Estate HTML Template</title>
    <!-- Favicon -->
    <link href="{{ url('images/favicon.ico') }}" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
    <link href="{{ url('images/favicon.ico') }}" sizes="128x128" rel="shortcut icon" />

    <script type="text/javascript" src="{{ url('js/jquery-3.3.1.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/jquery-migrate-3.0.0.min.js') }}"></script>

    <script type="text/javascript" src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script src="{{ url('js/common.js') }}"></script>
    <script src="{{ url('js/docurl.js') }}"></script>

    <style>
        /* 팝업 컨테이너 스타일 */
        .popup-container {
            width: 100%;
            background-color: #333;
            /* 짙은 회색 배경색 */
            padding: 10px;
            position: relative;
        }

        /* 타이틀 스타일 */

        .popup-title {
            display: block;
            position: fixed;
            top: 0px;
            width: 100%;
            z-index: 1000;
            background: #464b57;
            height: 45px;
        }

        /* 창 닫기 버튼 스타일 */
        .pop_close {
            display: block;
            width: 45px;
            height: 45px;
            position: fixed;
            right: 0px;
            top: 0px;
            z-index: 1100;
            background: #333;
            border: 0;
            cursor: pointer;
        }

        .popup-title .pop_title {
            font-size: 18px;
            letter-spacing: -1px;
            font-weight: bold;
            color: #FFF;
            display: inline-block;
            padding: 0.7em 20px 0.7em 20px;
        }

        /* 팝업 내용 스타일 (타이틀 영역 아래에 위치) */
        .popup-content {
            margin-top: 40px;
            /* 타이틀 영역과 겹치지 않도록 margin 추가 */
        }
    </style>

</head>

<body>
    <div class="popup-title">
        <h2 class="pop_title">@yield('page-title')</h2>
        <span class="close-button" >
            <button type="button" onclick="window.close();" class="pop_close"><img
                    src="{{ asset('images/Common/sbtn_close.png') }}" alt="현재창 닫기"></button>
        </span>
    </div>
    <div class="popup-content">
        <div class="preloader"></div>


        @yield('content')
        <a class="scrollToHome home7" href="#"><i class="flaticon-arrows"></i></a>
    </div>

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
</body>

</html>
