
    @php
        if($data->tradeType=="임대"){
            $printPrice = number_format($data->l_depPrice)."/".number_format($data->l_monPrice);
        }else{
            $printPrice = number_format($data->salePrice);
        }

        $arrAddr = explode(",",$data->_addr);
        $addr = trim($arrAddr[0]);
        if(count($arrAddr)>1) $addr .= " 외 ".(count($arrAddr) -1)."필지";

        $arrPrpos = explode(",",$data->_prposAreaNm);
        $prpos = trim($arrPrpos[0]);

        $bd = $data->building->first();
        $floorInfo = "";
        if(!empty($bd)){
            if(intval($bd->bd_ugrndFlrCnt) > 0) $floorInfo = "B".$bd->bd_ugrndFlrCnt."/";
            $floorInfo .= $bd->bd_grndFlrCnt."F";

            // 분양, 전유면적
            if(!empty($bd->hos->first()->details)){
                $hoDetail = $bd->hos->first()->details;
                $area_b = number_format($hoDetail->sum('hodt_area'),2);
                $area_j = number_format($hoDetail->where('hodt_exposPubuseGbCdNm','전유')->value('hodt_area'),2);
                // debug($area_b,$area_j);
            }
        }

    @endphp
    <div class="col-lg-8">
        <div class="single_product_grid row">
            <div class="single_product_slider col-lg-6">
                @if($data->files->count()==0)
                <div class="item">
                    <div class="sps_content">
                        <div class="thumb">
                            <div class="single_product">
                                <div class="single_item">
                                    <div class="thumb"><img class="img-fluid" src="https://www.gbbinc.co.kr/mng/_Img/thumb_noimg.jpg"></div>
                                </div>
                                <a class="product_popup popup-img" href="https://www.gbbinc.co.kr/mng/_Img/thumb_noimg.jpg"><span class="flaticon-zoom-in"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="sps_content">
                        <div class="thumb">
                            <div class="single_product">
                                <div class="single_item">
                                    <div class="thumb"><img class="img-fluid" src="https://www.gbbinc.co.kr/mng/_Img/thumb_noimg.jpg"></div>
                                </div>
                                <a class="product_popup popup-img" href="https://www.gbbinc.co.kr/mng/_Img/thumb_noimg.jpg"><span class="flaticon-zoom-in"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                @elseif ($data->files->count()==1)
                <div class="item">
                    <div class="sps_content">
                        <div class="thumb">
                            <div class="single_product">
                                <div class="single_item">
                                    <div class="thumb"><img class="img-fluid" src="https://www.gbbinc.co.kr/_Data/SaleNew/{{ $data->files->first()->filename }}"></div>
                                </div>
                                <a class="product_popup popup-img" href="https://www.gbbinc.co.kr/_Data/SaleNew/{{ $data->files->first()->filename }}"><span class="flaticon-zoom-in"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="sps_content">
                        <div class="thumb">
                            <div class="single_product">
                                <div class="single_item">
                                    <div class="thumb"><img class="img-fluid" src="https://www.gbbinc.co.kr/mng/_Img/thumb_noimg.jpg"></div>
                                </div>
                                <a class="product_popup popup-img" href="https://www.gbbinc.co.kr/mng/_Img/thumb_noimg.jpg"><span class="flaticon-zoom-in"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                @foreach ($data->files as $_file)
                <div class="item">
                    <div class="sps_content">
                        <div class="thumb">
                            <div class="single_product">
                                <div class="single_item">
                                    <div class="thumb"><img class="img-fluid" src="https://www.gbbinc.co.kr/_Data/SaleNew/{{ $_file->filename }}"></div>
                                </div>
                                <a class="product_popup popup-img" href="https://www.gbbinc.co.kr/_Data/SaleNew/{{ $_file->filename }}"><span class="flaticon-zoom-in"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endauth
            </div>
            <div class="col-lg-6">
                <div class="sps_content">
                    <div class="content">
                        <div class="shop_single_product_details">
                            <div class="tag">{{ $data->tradeType }}</div>
                            <div class="tag">{{ $data->saleTypeTxt }}</div>
                            <h4 class="title">{{ $addr }}</h4>
                            <div class="sspd_price mb25">{{ $printPrice }}만원</div>
                            <p class="mb20">{!! nl2br($data->review) !!}</p>

                            <ul class="list_details">
                                <li><a href="#"><i class="fa fa-check mr10"></i> {{ $prpos }}</a></li>
                                @if(!empty($area_b))
                                <li><a href="#"><i class="fa fa-check mr10"></i> 분양{{ $area_b }}㎡ 전유{{ $area_j }}㎡ </a></li>  
                                @else
                                <li><a href="#"><i class="fa fa-check mr10"></i> 토지면적 {{ number_format($data->_lndpclAr_sum) }}㎡</a></li>
                                    @if (strpos($data->saleTypeTxt,"토지")===false)
                                    <li><a href="#"><i class="fa fa-check mr10"></i> 연면적 {{ number_format($data->_area) }}㎡</a></li>    
                                    @endif
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="shop_single_tab_content mt30">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Reviews</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent2">
                <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                    <div class="product_single_content">
                        <div class="mbp_pagination_comments">
                            <div class="mbp_first media">
                                <div class="media-body">
                                    <p class="mb25">Evans Tower very high demand corner junior one bedroom plus a large balcony boasting full open NYC views. You need to see the views to believe them. Mint condition with new hardwood floors. Lots of closets plus washer and dryer.</p>
                                    <p class="mt10 mb0">Fully furnished. Elegantly appointed condominium unit situated on premier location. PS6. The wide entry hall leads to a large living room with dining area. This expansive 2 bedroom and 2 renovated marble bathroom apartment has great windows. Despite the interior views, the apartments Southern and Eastern exposures allow for lovely natural light to fill every room. The master suite is surrounded by handcrafted milkwork and features incredible walk-in closet and storage space.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                    <div class="product_single_content">
                        <div class="mbp_pagination_comments">
                            <ul class="total_reivew_view">
                                <li class="list-inline-item sub_titles">896 Reviews</li>
                                <li class="list-inline-item">
                                    <ul class="star_list">
                                        <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                    </ul>
                                </li>
                                <li class="list-inline-item avrg_review">( 4.5 out of 5 )</li>
                                <li class="list-inline-item write_review">Write a Review</li>
                            </ul>
                            <div class="mbp_first media">
                                <img src="images/testimonial/1.png" class="mr-3" alt="1.png">
                                <div class="media-body">
                                    <h4 class="sub_title mt-0">Diana Cooper
                                        <div class="sspd_review dif">
                                            <ul>
                                                <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li class="list-inline-item"></li>
                                            </ul>
                                        </div>
                                    </h4>
                                    <a class="sspd_postdate fz14" href="#">December 28, 2020</a>
                                    <p class="mt10">Beautiful home, very picturesque and close to everything in jtree! A little warm for a hot weekend, but would love to come back during the cooler seasons!</p>
                                </div>
                            </div>
                            <div class="custom_hr"></div>
                            <div class="mbp_first media">
                                <img src="images/testimonial/2.png" class="mr-3" alt="2.png">
                                <div class="media-body">
                                    <h4 class="sub_title mt-0">Ali Tufan
                                        <div class="sspd_review dif">
                                            <ul>
                                                <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li class="list-inline-item"></li>
                                            </ul>
                                        </div>
                                    </h4>
                                    <a class="sspd_postdate fz14" href="#">December 28, 2020</a>
                                    <p class="mt10">Beautiful home, very picturesque and close to everything in jtree! A little warm for a hot weekend, but would love to come back during the cooler seasons!</p>
                                </div>
                            </div>
                            <div class="custom_hr"></div>
                            <div class="mbp_comment_form style2">
                                <h4>Write a Review</h4>
                                <ul class="sspd_review">
                                    <li class="list-inline-item">
                                        <ul class="mb0">
                                            <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                            <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                            <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                            <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                            <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                        </ul>
                                    </li>
                                    <li class="list-inline-item review_rating_para">Your Rating & Review</li>
                                </ul>
                                <form class="comments_form">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="exampleInputName1" aria-describedby="textHelp" placeholder="Review Title">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="12" placeholder="Your Review"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-thm">Submit Review <span class="flaticon-right-arrow-1"></span></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb30">
            <div class="col-lg-12">
                <h4 class="mt25">Related products</h4>
            </div>
            <div class="col-sm-6 col-lg-6">
                <div class="shop_grid">
                    <div class="thumb">
                        <img class="img-fluid w100" src="images/shop/1.png" alt="1.png">
                        <div class="tag">Sale</div>
                    </div>
                    <div class="details">
                        <h4 class="item-tile">Album <span class="price">$13,000</span></h4>
                        <button class="btn btn-thm add_to_cart">Add to cart</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-6">
                <div class="shop_grid">
                    <div class="thumb">
                        <img class="img-fluid w100" src="images/shop/2.png" alt="2.png">
                    </div>
                    <div class="details">
                        <h4 class="item-tile">Beanie <span class="price">$13,000</span></h4>
                        <button class="btn btn-thm add_to_cart">Add to cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="sidebar_listing_list">
            <div class="sidebar_advanced_search_widget">
                <div class="sl_creator">
                    <h4 class="mb25">중개사정보</h4>
                    <div class="media">
                        <img class="mr-3" src="http://gbbinc.co.kr/_Data/Member/{{ $data->users->first()->sawon->mb_photo }}" style="width:90px;height:90px">
                        <div class="media-body">
                            <h5 class="mt-0 mb0">{{ $data->users->first()->sawon->user_name }} {{ @$data->users->first()->sawon->info->duty }}</h5>
                            <p class="mb0">{{ @$data->users->first()->sawon->info->sosok }}</p>
                            <p class="mb0">1833-{{ @$data->users->first()->sawon->info->office_line }}</p>
                            <a class="text-thm" href="#">View My Listing</a>
                          </div>
                    </div>
                </div>
                <ul class="sasw_list mb0">
                    <li class="search_area">
                        <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputName1" placeholder="Your Name">
                        </div>
                    </li>
                    <li class="search_area">
                        <div class="form-group">
                            <input type="number" class="form-control" id="exampleInputName2" placeholder="Phone">
                        </div>
                    </li>
                    <li class="search_area">
                        <div class="form-group">
                            <input type="email" class="form-control" id="exampleInputEmail" placeholder="Email">
                        </div>
                    </li>
                    <li class="search_area">
                        <div class="form-group">
                            <textarea id="form_message" name="form_message" class="form-control required" rows="5" required="required" placeholder="문의하실 내용을 입력하세요."></textarea>
                        </div>
                    </li>
                    <li>
                        <div class="search_option_button">
                            <button type="submit" class="btn btn-block btn-thm">문의하기</button>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="sidebar_recent_product">
            <h4 class="title">오늘 본 매물</h4>
            @if(empty($todayViewSales))
            @else
            @foreach ($todayViewSales as $_data)
            @php
                $sale = $_data->sale;
                if($sale->files->count()==0){
                    $img = "https://www.gbbinc.co.kr/mng/_Img/thumb_noimg.jpg";
                }else{
                    $img = "https://www.gbbinc.co.kr/_Data/SaleNew/".$sale->files->first()->filename;
                }

                if($sale->tradeType=="임대"){
                    $printPrice = number_format($sale->l_depPrice)."/".number_format($sale->l_monPrice);
                }else{
                    $printPrice = number_format($sale->salePrice);
                }

                $arrAddr = explode(",",$sale->_addr);
                $addr = trim($arrAddr[0]);
                if(count($arrAddr)>1) $addr .= " 외 ".(count($arrAddr) -1)."필지";
            @endphp
            <div class="media" style="cursor: pointer" onclick="location.href='?mode=show&idx={{ $_data->idx }}'">
                <img class="align-self-start mr-3" src="{{ $img }}">
                <div class="media-body">
                    <h5 class="mt-0 post_title">{{ $sale->saleTypeTxt }}</h5>
                    <div class="small">{{ $addr }}</div>
                    <a href="#">{{ $sale->tradeType }} {{ $printPrice }}만원</a>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
