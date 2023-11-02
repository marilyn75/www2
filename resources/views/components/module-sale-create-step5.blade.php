
<form name="frmCreate" action="{{ $uri }}" method="post">
    @csrf
    <input type="hidden" name="tmp_id" value="{{ $data['tmp_id'] }}">
    <input type="hidden" name="step" value="6">

<div class="w-100">
    <div class="row">
        <div class="col-lg-12">
            <div class="my_dashboard_review mt30">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="mb30">매물사진 등록단계</h4>
                    </div>
                    <div class="col-lg-12">
                        <ul class="mb0">
                            <li class="list-inline-item">
                                <div class="portfolio_item">
                                    <img class="img-fluid" src="images/property/fp1.jpg" alt="fp1.jpg">
                                    <div class="edu_stats_list" data-toggle="tooltip" data-placement="top" title="Delete" data-original-title="Delete"><a href="#"><span class="flaticon-garbage"></span></a></div>
                                </div>
                            </li>
                            <li class="list-inline-item">
                                <div class="portfolio_item">
                                    <img class="img-fluid" src="images/property/fp2.jpg" alt="fp2.jpg">
                                    <div class="edu_stats_list" data-toggle="tooltip" data-placement="top" title="Delete" data-original-title="Delete"><a href="#"><span class="flaticon-garbage"></span></a></div>
                                </div>
                            </li>
                            <li class="list-inline-item">
                                <div class="portfolio_item">
                                    <img class="img-fluid" src="images/property/fp3.jpg" alt="fp3.jpg">
                                    <div class="edu_stats_list" data-toggle="tooltip" data-placement="top" title="Delete" data-original-title="Delete"><a href="#"><span class="flaticon-garbage"></span></a></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-12">
                        <div class="portfolio_upload">
                            <input type="file" name="myfile" />
                            <div class="icon"><span class="flaticon-download"></span></div>
                            <p>+이미지 끌어다놓기</p>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="resume_uploader mb30">
                            <h4>매물 사진을 첨부해주세요</h4>
                            <form class="form-inline">
                                <input class="upload-path">
                                <label class="upload">
                                    <input type="file">
                                    파일첨부
                                </label>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="my_profile_setting_input">
                            <button class="btn btn1 float-left">이전</button>
                            <button class="btn btn2 float-right">다음</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
</form>