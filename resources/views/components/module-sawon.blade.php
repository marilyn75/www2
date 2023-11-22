<style>
.img-whp {
    width: 340px;
    height: 260px;
}
</style>

<div class="col-md-12 col-lg-12">
    <div class="row">
        <div class="grid_list_search_result style2">
            <div class="col-sm-12 col-md-4 col-lg-3 col-xl-3">
                <div class="left_area">
                    <p>{{ number_format($data->total()) }} Search results</p>
                </div>
            </div>
            <div class="col-sm-12 col-md-8 col-lg-9 col-xl-9">
                <div class="right_area style2 text-right">
                    <ul>
                        <li class="list-inline-item"><span class="shrtby">Sort by:</span>
                            <select class="selectpicker show-tick">
                                <option>Featured First</option>
                                <option>Featured 2nd</option>
                                <option>Featured 3rd</option>
                                <option>Featured 4th</option>
                                <option>Featured 5th</option>
                            </select>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($data as $_sawon)
        <!-- <div class="col-md-6 col-lg-4">
            <div class="feat_property home7 agent">
                <div class="thumb">
                    <img class="img-whp" src="http://gbbinc.co.kr/_Data/Member/{{ $_sawon->mb_photo }}">
                    <div class="thmb_cntnt">
                        <ul class="tag mb0">
                            <li class="list-inline-item dn"></li>
                            <li class="list-inline-item"><a href="#">2 Listings</a></li>
                        </ul>
                    </div>
                </div>
                <div class="details">
                    <div class="tc_content">
                        <h4>{{ $_sawon->user_name }} {{ @$_sawon->info->duty }}</h4>
                        <p class="text-thm">{{ @$_sawon->info->sosok }}</p>
                        <ul class="prop_details mb0">
                            <li><a href="#">Office: 1833 {{ @$_sawon->info->office_line }}</a></li>
                            {{-- <li><a href="#">Mobile: 891 456 9874</a></li>
                            <li><a href="#">Fax: 342 654 1258</a></li> --}}
                            <li><a href="#">Email: {{ $_sawon->mb_email }}</a></li>
                        </ul>
                    </div>
                    <div class="fp_footer">
                        <ul class="fp_meta float-left mb0">
                            <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-google"></i></a></li>
                        </ul>
                        <div class="fp_pdate float-right text-thm">View My Listings <i class="fa fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- 수정 -->
        <div class="col-sm-4 col-md-4 col-lg-3">
            <a class="employ_box" href="#">
                <div class="empl-img-w">
                    <img class="img-whp" src="http://gbbinc.co.kr/_Data/Member/{{ $_sawon->mb_photo }}">
                </div>
                <div class="employ_inf">
                    <p>{{ @$_sawon->info->sosok }}</p>
                    <p>{{ $_sawon->user_name }} {{ @$_sawon->info->duty }}</p>
                </div>
                <div class="employ_call">
                    <i class="ri-phone-line"></i>
                    <p class="mont">1833 {{ @$_sawon->info->office_line }}</p>
                </div>
            </a>
        </div>
        @endforeach

        <x-pagination :data="$data" />
        {{-- <div class="col-lg-12 mt20">
            <div class="mbp_pagination">
                <ul class="page_navigation">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true"> <span class="flaticon-left-arrow"></span> Prev</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active" aria-current="page">
                        <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">...</a></li>
                    <li class="page-item"><a class="page-link" href="#">29</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#"><span class="flaticon-right-arrow"></span></a>
                    </li>
                </ul>
            </div>
        </div> --}}
    </div>
</div>