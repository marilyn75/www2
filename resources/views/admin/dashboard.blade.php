@extends('admin.layout.layout')

@section('content')

<section class="our-dashbord dashbord pb50">
    <div class="container container_w">
        <div class="">
            <div class="col-lg-3 col-xl-2 dn-992 pl0"></div>
            <div class="col-lg-12 maxw100flex-992">
                <div class="row">
                    
                    <div class="col-lg-12 mb10">
                        <div class="breadcrumb_content style2">
                            <h2 class="breadcrumb_title">대시보드</h2>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                        <div class="ff_one">
                            <div class="detais">
                                <p>오늘 방문자 수</p>
                                <div class="timer ff_fir mont">37</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                        <div class="ff_one style2">
                            <div class="icon"><span class="flaticon-view"></span></div>
                            <div class="detais">
                                <p>관심매물</p>
                                <div class="timer ff_sec mont">24</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                        <div class="ff_one style3">
                            <div class="icon"><span class="flaticon-chat"></span></div>
                            <div class="detais">
                                <p>매물 조회 수</p>
                                <div class="timer ff_thi mont">12</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="application_statics">
                            <h4>방문자</h4>
                            <div class="c_container"></div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row mt50">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="copyright-widget text-center">
                            <p>© 2020 Find House. Made with love.</p>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</section>

@endsection