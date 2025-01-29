<!DOCTYPE html>
<html dir="ltr" lang="ko">

<head>

<link rel="stylesheet" href="https://www.gyemoim.co.kr/css/bootstrap.min.css">

<style>


    
    /*== Typography ==*/
    html {
      font-size: 100%; }
    
    body {
      background-attachment: fixed;
      background-color: #ffffff;
      color: #777777;
      font-size: 16px;
      line-height: 1.642;
      overflow-x: hidden;
      transition: inherit;
      -webkit-font-smoothing: antialiased;
      -webkit-transition: all .4s ease;
      -moz-transition: all .4s ease;
      -ms-transition: all .4s ease;
      -o-transition: all .4s ease;
      transition: all .4s ease;
      font-family: -apple-system, BlinkMacSystemFont, "Apple SD Gothic Neo", "Pretendard Variable", Pretendard, Roboto, "Noto Sans KR", "Segoe UI", "Malgun Gothic", "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", sans-serif !important;
    }
    body.body_overlay{
      position: fixed;
      transform: translate(0, 0);
      width: 100%;
    }
    body.body_overlay:before{
      background-color: rgba(0,0,0,.5);
      bottom: 0;
      content:"";
      left: 0;
      position: absolute;
      right: 0;
      top: 0;
      z-index: 2;
      -webkit-transition: all .8s ease;
      -moz-transition: all .8s ease;
      -ms-transition: all .8s ease;
      -o-transition: all .8s ease;
      transition: all .8s ease;
      transform: translate(360px, 0);
    }
    img {
      max-width: 100%;}
    
    p {
      font-size: 14px;
      color: #484848;
      font-weight: 400;}
    
    ul,
    ol {
      list-style: none;
      margin: 0;
      padding: 0; }
    
    iframe {
      border: none;
      width: 100%; }
    
    a {
      color: #555555;
      text-decoration: none;
      -webkit-font-smoothing: antialiased;}
      a:hover, a:focus {
        color: #333333;
        text-decoration: none;
        outline: none;}
      a img {
        border: none;}
    .form-control{
      height: 50px;
    }
    .form-control:active,
    .form-control:focus{
      box-shadow: none;
      outline: none;
    }
    
    iframe {
      border: none; }
    
    ::selection {
      background: #222222;
      color: #ffffff;
      text-shadow: none; }
    
    ::-moz-selection {
      /* Firefox */
      background: #222222;
      color: #ffffff;
      text-shadow: none; }
    
    ::-webkit-selection {
      /* Safari */
      background: #222222;
      color: #ffffff;
      text-shadow: none; }
    
    h1, h2, h3, h4, h5, h6,
    .h1, .h2, .h3, .h4, .h5, .h6 {
      font-family: -apple-system, BlinkMacSystemFont, "Apple SD Gothic Neo", "Pretendard Variable", Pretendard, Roboto, "Noto Sans KR", "Segoe UI", "Malgun Gothic", "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", sans-serif;
      line-height: 1.2;
      color: #484848; }
      h1 small,
      h1 .small, h2 small,
      h2 .small, h3 small,
      h3 .small, h4 small,
      h4 .small, h5 small,
      h5 .small, h6 small,
      h6 .small,
      .h1 small,
      .h1 .small, .h2 small,
      .h2 .small, .h3 small,
      .h3 .small, .h4 small,
      .h4 .small, .h5 small,
      .h5 .small, .h6 small,
      .h6 .small {
        font-weight: normal;
        line-height: 1;
        color: #484848;
        font-weight: 400; }
      h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
      .h1 a, .h2 a, .h3 a, .h4 a, .h5 a, .h6 a {
        color: #484848;
        font-weight: 400; }
    
    h1, h2, h3, h4
    .h1, .h2, .h3, .h4 {
      font-weight: bold; }
    
    h5, h6,
    .h5, .h6 {
      font-weight: bold;}
    
    h1, .h1 {
      font-size: 36px; }
    
    h2, .h2 {
      font-size: 30px; }
    
    h3, .h3 {
      font-size: 24px; }
    
    h4, .h4 {
      font-size: 18px; }
    
    h5, .h5 {
      font-size: 15px; }
    
    h6, .h6 {
      font-size: 12px; }
    p,
    ul,
    ol,
    dl,
    dt,
    dd,
    blockquote,
    address {
      margin: 0 0 10px; }
    
    .wrapper { background: #f7f7f7; }


    .lsd_list{
      margin-bottom: 40px;
      position: relative;
    }
    .lsd_list li{
      border-radius: 8px;
      background-color: rgb(247, 247, 247);
      height: 40px;
      padding: 6px 25px;
      text-align: center;
    }
    .lsd_list li a{
      color: #484848;
      font-size: 14px;
      color: rgb(72, 72, 72);
      line-height: 1.2;
    }
    .lsd_list li:hover a{
      color: #ff5a5f;
    }
    .listing_single_description{
      background-color: rgb(255, 255, 255);
      border: 1px solid rgb(235, 235, 235);
      border-radius: 8px 8px 0 0;
      padding: 30px;  
    }
    .listing_single_description.style2{
      border-radius: 0;
    }
    .listing_single_description2{
      background-color: rgb(255, 255, 255);
      border: 1px solid rgb(235, 235, 235);
      border-bottom: none;
      border-radius: 8px 8px 0 0;
      display: -webkit-flex;
      display: -moz-flex;
      display: -ms-flex;
      display: -o-flex;
      display: flex;
      position: relative;
      padding: 30px;
    }
    .listing_single_description .card.card-body{
      border: none;
      padding: 0;
    }
    .white_goverlay{
      position: relative;
    }
    .white_goverlay:before{
      background: rgb(255,255,255);
      background: linear-gradient(180deg, rgba(255,255,255, 0.2) 20%, rgba(255,255,255, 0.3) 30%, rgba(255,255,255, 0.8) 20%);
      bottom: 0;
      content: "";
      height: 90px;
      left: 0;
      position: absolute;
      right: 0;
      width: 100%;
      z-index: 1;
    }
    .white_goverlay.z-1:before{
      z-index: -1;
    }
    .additional_details{
      background-color: rgb(255, 255, 255);
      border: 1px solid rgb(235, 235, 235);
      padding: 30px;
      position: relative;  
    }
    .additional_details ul li p{
      font-size: 14px;
      line-height: 2.857;
      margin-bottom: 0;
    }
    .additional_details ul li p span{
      font-size: 14px;
      font-weight: bold;
      line-height: 2.857;
    }
    .property_attachment_area{
      border-radius: 0 0 8px 8px;
    }
    .property_attachment_area,
    .walkscore_area{
      background-color: rgb(255, 255, 255);
      border: 1px solid rgb(235, 235, 235);
      border-radius: 8px;
      padding: 30px;
      position: relative;
    }
    .icon_box_area.style2 .details{
      padding: 25px 20px 0;
    }
    .icon_box_area .details{
      padding: 15px 20px;
    }
    .icon_box_area .details h5{
      font-size: 16px;
      color: rgb(72, 72, 72);
      font-weight: bold;
      line-height: 1.5;
      margin-bottom: 0;
    }
    .icon_box_area .details p{
      font-size: 14px;
      color: rgb(72, 72, 72);
      margin-bottom: 0;
    }
    .walkscore_area .more_info{
      color: rgb(72, 72, 72);
      font-size: 14px;
      line-height: 1.714;
      text-decoration: underline;
    }
    .whats_nearby{
      border: 1px solid rgb(235, 235, 235);
      border-radius: 8px;
      background-color: rgb(255, 255, 255);
      padding: 30px;
      position: relative;
    }

    
    .education_distance{
      display: grid;
      position: relative;
    }
    .education_distance h5{
      font-size: 16px;
      font-weight: bold;
      line-height: 2;
      margin-bottom: 0;
    }
    .education_distance h5 span{
      color: #4585ff;
      font-size: 24px;
      margin-right: 5px;
    }
    .education_distance.style2 h5 span{
      color: #fb8855;
    }
    .education_distance.style3 h5 span{
      color: #92d060;
    }
    .single_line .para{
      font-size: 14px;
      float: left;
      line-height: 2.143;
      margin-bottom: 0;
    }
    .single_line .para span{
      color: #767676;
    }
    .single_line .review{
      float: right;
      margin-bottom: 0;
    }
    .single_line .review li{
      margin-right: 3px;
    }
    .single_line .review li:nth-child(5){
      margin-right: 25px;
    }
    .single_line .review li:nth-child(5) a{
      color: #e1e1e1;
    }
    .single_line .review span.total_rive_count{
      font-size: 14px;
      color: rgb(118, 118, 118);
      line-height: 2.143;
    }
    .single_line .review li a{
      font-size: 14px;
      color: rgb(188, 197, 42);
      line-height: 2.143;
    }

    .application_statics{
      border-radius: 5px;
      background-color: #ffffff;
      -webkit-box-shadow:0px 1px 4px 0px rgba(0, 0, 0, 0.09);
      -moz-box-shadow:0px 1px 4px 0px rgba(0, 0, 0, 0.09);
      box-shadow:0px 1px 4px 0px rgba(0, 0, 0, 0.09);
      padding: 30px;
      position: relative;
    }
    .application_statics h4{
      color: #484848;
      font-weight: bold;
      line-height: 1.2;
    }
    /*== Fonts Size, Font Weights, Height, Display & Position ==*/
    .fz11 {
      font-size: 11px;
    }
    .fz12 {
      font-size: 12px;
    }
    .fz13 {
      font-size: 13px;
    }
    .fz14 {
      font-size: 14px;
    }
    .fz15 {
      font-size: 15px;
    }
    .fz16 {
      font-size: 16px;
    }
    .fz17 {
      font-size: 17px;
    }
    .fz18 {
      font-size: 18px;
    }
    .fz19 {
      font-size: 19px;
    }
    .fz20 {
      font-size: 20px;
    }
    .fz24 {
      font-size: 24px;
    }
    .fz26 {
      font-size: 26px;
    }
    .fz30 {
      font-size: 30px;
    }
    .fz40 {
      font-size: 40px;
    }
    .fz45 {
      font-size: 45px;
    }
    .fz48 {
      font-size: 48px;
    }
    .fz50 {
      font-size: 50px;
    }
    .fz55 {
      font-size: 55px;
    }
    .fz60 {
      font-size: 60px;
    }
    .fz72 {
      font-size: 72px;
    }
    .fz100 {
      font-size: 100px !important;
    }
    .lh30 {
      line-height: 30px;
    }
    .h05 {
      height: 5px !important;
    }
    .h10 {
      height: 10px;
    }
    .h20 {
      height: 20px;
    }
    .h25 {
      height: 25px;
    }
    .h30 {
      height: 30px;
    }
    .h35 {
      height: 35px;
    }
    .h40 {
      height: 40px;
    }
    .h45 {
      height: 45px;
    }
    .h50 {
      height: 50px;
    }
    .h55 {
      height: 55px;
    }
    .h60 {
      height: 60px;
    }
    .h65 {
      height: 65px;
    }
    .h70 {
      height: 70px;
    }
    .h75 {
      height: 75px;
    }
    .h80 {
      height: 80px;
    }
    .h85 {
      height: 85px;
    }
    .h90 {
      height: 90px;
    }
    .h95 {
      height: 95px;
    }
    .h100p {
      height: 100%;
    }
    .h100 {
      height: 100px;
    }
    .hf100 {
      height: 100%;
    }
    .h150 {
      height: 150px;
    }
    .h200 {
      height: 200px;
    }
    .h250 {
      height: 250px !important;
    }
    .h300 {
      height: 300px;
    }
    .h320 {
      height: 320px;
    }
    .h345 {
      height: 345px;
    }
    .h350 {
      height: 350px;
    }
    .h355 {
      height: 355px;
    }
    .h400 {
      height: 400px;
    }
    .h450 {
      height: 450px;
    }
    .h500 {
      height: 500px;
    }
    .h550 {
      height: 550px;
    }
    .h600 {
      height: 600px;
    }
    .h650 {
      height: 650px;
    }
    .h660 {
      height: 660px;
    }
    .h700 {
      height: 700px;
    }
    .h750 {
      height: 750px;
    }
    .h800 {
      height: 800px;
    }
    .h850 {
      height: 850px;
    }
    .h900 {
      height: 900px;
    }
    .h950 {
      height: 950px;
    }
    .h1000 {
      height: 1000px;
    }
    .wa {
      width: auto;
    }
    .w60 {
      width: 60px !important;
    }
    .w80 {
      width: 80px !important;
    }
    .w100 {
      width: 100% !important;
    }
    .maxw100 {
      max-width: 100%;
    }
    .maxw1600 {
      max-width: 1600px;
    }
    .fw300 {
      font-weight: 300 !important;
    }
    .fw400 {
      font-weight: 400;
    }
    .fw500 {
      font-weight: 500;
    }
    .fw600 {
      font-weight: 600;
    }
    .fw700 {
      font-weight: 700;
    }
    .fw800 {
      font-weight: 800;
    }
    .fw900 {
      font-weight: 900;
    }
    .fwb {
      font-weight: bold;
    }
    .db {
      display: block; }
    
    .dib {
      display: inline-block; }
    
    .dif {
      display: inline-flex; }
    
    .df {
      display: -webkit-flex;
      display: -moz-flex;
      display: -ms-flex;
      display: -o-flex;
      display: flex; }
    
    .dfr {
      display: flow-root; }
    
    .dn {
      display: none; }
    
    .ovh {
      overflow: hidden; }
    
    .ovv {
      overflow: visible; }
    
    .posa {
      position: absolute;}
    
    .posr {
      position: relative;}
    
    /*== Custome Margin Padding ==*/
    .ulockd-pmz {
      margin: 0;
      padding: 0; }
    
    .p0 {
      padding: 0 !important; }
    
    .p1 {
      padding: 1; }
    
    .p10 {
      padding: 10px; }
    
    .p15 {
      padding: 15px; }
    
    .p20 {
      padding: 20px; }
    
    .p25 {
      padding: 25px; }
    
    .p30 {
      padding: 30px; }
    
    .p35 {
      padding: 35px; }
    
    .p40 {
      padding: 40px; }
    
    .p45 {
      padding: 45px; }
    
    .p50 {
      padding: 50px; }
    
    .p55 {
      padding: 55px; }
    
    .p60 {
      padding: 60px; }
    
    .p65 {
      padding: 65px; }
    
    .p70 {
      padding: 70px; }
    
    .p75 {
      padding: 75px; }
    
    .p80 {
      padding: 80px; }
    
    .pad10 {
      padding: 10% 5%; }
    
    .pad17 {
      padding-top: 17% !important; }
    
    .pt0 {
      padding-top: 0px !important; }
    
    .pt10 {
      padding-top: 10px !important; }
    
    .pt15 {
      padding-top: 15px; }
    
    .pt20 {
      padding-top: 20px; }
    
    .pt25 {
      padding-top: 25px; }
    
    .pt30 {
      padding-top: 30px !important; }
    
    .pt35 {
      padding-top: 35px; }
    
    .pt40 {
      padding-top: 40px; }
    
    .pt45 {
      padding-top: 45px; }
    
    .pt50 {
      padding-top: 50px; }
    
    .pt55 {
      padding-top: 55px; }
    
    .pt60 {
      padding-top: 60px; }
    
    .pt65 {
      padding-top: 65px; }
    
    .pt70 {
      padding-top: 70px; }
    
    .pt75 {
      padding-top: 75px; }
    
    .pt80 {
      padding-top: 80px; }
    
    .pt85 {
      padding-top: 85px; }
    
    .pt90 {
      padding-top: 90px; }
    
    .pt95 {
      padding-top: 95px; }
    
    .pt100 {
      padding-top: 100px; }
    
    .pt120 {
      padding-top: 120px; }
    
    .pt130 {
      padding-top: 130px; }
    
    .pt140 {
      padding-top: 140px; }
    
    .pt150 {
      padding-top: 150px; }
    
    .pt160 {
      padding-top: 160px; }
    
    .pt170 {
      padding-top: 170px; }
    
    .pt180 {
      padding-top: 180px; }
    
    .pt190 {
      padding-top: 190px; }
    
    .pt200 {
      padding-top: 200px; }
    
    .pt100 {
      padding-top: 100px; }
    
    .pt70 {
      padding-top: 70px; }
    
    .pt70 {
      padding-top: 70px; }
    
    .pt70 {
      padding-top: 70px; }
    
    .pr0 {
      padding-right: 0; }
    
    .pr1 {
      padding-right: 1px; }
    
    .pr5 {
      padding-right: 5px; }
    
    .pr10 {
      padding-right: 10px; }
    
    .pr15 {
      padding-right: 15px; }
    
    .pr20 {
      padding-right: 20px; }
    
    .pr25 {
      padding-right: 25px; }
    
    .pr30 {
      padding-right: 30px; }
    
    .pr35 {
      padding-right: 35px; }
    
    .pr40 {
      padding-right: 40px; }
    
    .pr45 {
      padding-right: 45px; }
    
    .pr50 {
      padding-right: 50px; }
    
    .pr55 {
      padding-right: 55px; }
    
    .pr60 {
      padding-right: 60px; }
    
    .pr65 {
      padding-right: 65px; }
    
    .pr70 {
      padding-right: 70px; }
    
    .pb0 {
      padding-bottom: 0px !important; }
    
    .pb15 {
      padding-bottom: 15px; }
    
    .pb5 {
      padding-bottom: 5px; }
    
    .pb10 {
      padding-bottom: 10px !important; }
    
    .pb15 {
      padding-bottom: 15px; }
    
    .pb20 {
      padding-bottom: 20px; }
    
    .pb25 {
      padding-bottom: 25px; }
    
    .pb30 {
      padding-bottom: 30px; }
    
    .pb35 {
      padding-bottom: 35px; }
    
    .pb40 {
      padding-bottom: 40px; }
    
    .pb45 {
      padding-bottom: 45px; }
    
    .pb50 {
      padding-bottom: 50px; }
    
    .pb55 {
      padding-bottom: 55px; }
    
    .pb60 {
      padding-bottom: 60px; }
    
    .pb65 {
      padding-bottom: 65px; }
    
    .pb70 {
      padding-bottom: 70px; }
    
    .pb75 {
      padding-bottom: 75px; }
    
    .pb80 {
      padding-bottom: 80px; }
    
    .pb85 {
      padding-bottom: 85px; }
    
    .pb90 {
      padding-bottom: 90px; }
    
    .pb95 {
      padding-bottom: 95px; }
    
    .pb100 {
      padding-bottom: 100px; }
    
    .pl0 {
      padding-left: 0 !important; }
    
    .pl1 {
      padding-left: 1px; }
    
    .pl5 {
      padding-left: 5px; }
    
    .pl10 {
      padding-left: 10px; }
    
    .pl15 {
      padding-left: 15px; }
    
    .pl20 {
      padding-left: 20px; }
    
    .pl25 {
      padding-left: 25px; }
    
    .pl30 {
      padding-left: 30px; }
    
    .pl35 {
      padding-left: 35px; }
    
    .pl40 {
      padding-left: 40px; }
    
    .pl45 {
      padding-left: 45px; }
    
    .pl50 {
      padding-left: 50px; }
    
    .pl55 {
      padding-left: 55px; }
    
    .pl60 {
      padding-left: 60px; }
    
    .pl65 {
      padding-left: 65px; }
    
    .pl70 {
      padding-left: 70px; }
    
    .pl75 {
      padding-left: 75px; }
    
    .pl80 {
      padding-left: 80px; }
    
    .pl85 {
      padding-left: 85px; }
    
    .pl90 {
      padding-left: 90px; }
    
    .pl95 {
      padding-left: 95px; }
    
    .pl100 {
      padding-left: 100px; }
    
    .prpl0 {
      padding-left: 0;
      padding-right: 0;
    }

    
    
    .m0 {
      margin: 0;}
    
    .m5 {
      margin: 5px;}
    
    .m10 {
      margin: 10px !important;}
    
    .m15 {
      margin: 15px;}
    
    .m20 {
      margin: 20px;}
    
    .m25 {
      margin: 25px;}
    
    .m30 {
      margin: 30px;}
    
    .m35 {
      margin: 35px;}
    
    .m40 {
      margin: 40px;}
    
    .m45 {
      margin: 45px;}
    
    .m50 {
      margin: 50px;}
    
    
    .mt30 {
      margin-top: 30px; }
    
    
    

    
    .mb10 {
      margin-bottom: 10px; }
    
    .mb15 {
      margin-bottom: 15px; }
    
    .mb20 {
      margin-bottom: 20px !important; }
    
    
    
    

    section {
      padding: 75px 0;
      position: relative;
    }
    
    /* Shop Single Page Style */
    .single_product_grid{
      background-color: #ffffff;
      border: 1px solid #ebebeb;
      border-radius: 8px;
      margin: 0;
      padding: 10px 0;
      position: relative;
    }
    .single_product_grid .sps_content .content{
      text-align: left;
    }
    .single_product_grid .sps_content{
      display: -webkit-flex;
      display: -moz-flex;
      display: -ms-flex;
      display: -o-flex;
      display: flex;
    }
    .single_product_grid .sps_content .content .shop_single_product_details{
      padding: 15px 10px 0 0;
    }


    .container_w { max-width: 1240px; margin: 0 auto; padding: 0 20px;}
    .details_w { padding: 0 15px; }
    .search_result_w { padding: 0 25px; margin: 0 auto; width: 100%; background: transparent; border: none; font-size: 16px; display: flex; align-items: baseline; justify-content: flex-end; }
    .search_result_w .left_area p{ font-size: 16px; color: #000; font-weight: 600; }
    .search_result_w .bootstrap-select>.dropdown-toggle { background: transparent; }
    .plr-0 { padding: 0; }
    .list-inline-item i {  
      font-size: 16px; 
      /* line-height: 35px;  */
      line-height: normal; 
    }
    
    
    /* detail_page */
    .breadcrumb_title_w { font-size: 18px; color: #505050; font-weight: 600; }
    .detail_title { display: flex; align-items: center; justify-content: space-between;}
    .detail_title h2 { font-size: 24px; color: #385F8D; }
    .small_bx { margin: 0; }
    .small_bx ul { display: flex; gap: 14px;}
    .small_bx ul li { width: 40px; height: 40px; margin-right: 0 !important;}
    .small_bx ul li i { color: #828282 !important; font-size: 20px !important; line-height: 42px !important; }
    .text-sub-loc { font-size: 18px; }
    .text-sub-loc i {margin-right: 5px;}
    .detail_img_w { display: grid; }
    .contact_bar { position: sticky; }
    /* .contact_bx { width:376px; height: 1000px; position: sticky; top: 125px; } */
    .contact_bx { width:376px; height: 1000px; top: 125px; }
    .sl_creator_w h4 { font-size: 18px; font-weight: 600; }
    .profile_crop { border-radius: 10px; overflow: hidden; object-fit: cover; width: 90px; height: 90px; }
    .media_w { gap: 20px; align-items: center; }
    .sasw_list_w .search_area input { border: none; border-bottom: 1px solid #d9d9d9; border-radius: 0px; padding: 10px; }
    .sasw_list_w .search_area textarea { border: none; border-bottom: 1px solid #d9d9d9; border-radius: 0px; padding: 10px; }
    .small-img { width: 90px; height: 90px; overflow: hidden; object-fit: cover; border-radius: 10px; }
    .description_w h4 { color: #000 ; font-size: 20px; font-weight: 600; }
    .description_w p { font-size: 16px; color: #000; width: fit-content; }
    .text-thm_w { color: #385F8D !important; font-weight: 600 ;}
    .additional_w h4 { font-size: 20px; font-weight: 600; color: #000; }
    .additional_w ul li p { font-size: 16px; color: #000; font-weight: 500; line-height: 2.5; }
    .additional_w ul li p span { font-size: 16px; color: #000; font-weight: 500; line-height: 2.5; }
    .application_w h4 { font-size: 20px; color: #000; font-weight: 600; }
    .order_list_w i{ color: #385F8D !important; line-height: 33px; margin-right: 10px; }
    .order_list_w li a { font-size: 16px; color: #000; font-weight: 500; line-height: normal; display: flex; align-items: center; }
    .additional_w .list-inline-item:not(:last-child) { margin: 0; width: 90px; }
    .additional_w .list-inline-item { margin: 0; }
    .order_list_w p { margin: 0; font-size: 16px; font-weight: 500; }
    .map_w h4 { font-size: 20px; color: #000; font-weight: 600; margin: 0;}
    .map_w p { font-size: 16px; color: #000;  margin: 0;}
    .map_w i { color: #385F8D;}
    .map_top_w { display: flex; align-items: baseline; justify-content: space-between; }
    .nearby_w h4 { font-size: 20px; color: #000; font-weight: 600; }
    .nonearby { font-size: 16px; color: #828282; text-align: center; margin: 0; }
    .nonearby i { margin-right: 5px; }
    .nearby_w i { color: #385f8d; }
    .education_w h5 { color: #000; font-weight: 600; color: #385F8D; }
    .single_w .para { line-height: 2; font-size: 16px; cursor: pointer;}
    .single_w .list-inline-item p { font-size: 16px; margin: 0; }
    .detail_top { padding: 0 20px; }
    .similar h4 { color: #000; font-size: 20px; font-weight: 600; }
    .chart_w h4{ color: #000; font-size: 20px; font-weight: 600; }
    .contact_btn { display: none; z-index: 999; position: fixed; bottom: 80px; right: 80px; width: 100px; height: 100px; background: #385F8D; border-radius: 50px; }
    .contact_bx_modal { width: 100%; height: auto; border: none; margin: 0; padding: 15px 20px; }
    .media-detail { color: #385F8D !important; font-weight: 600 !important; }
    .media-call { font-weight: 500; }
    .today_pro h4 { font-size: 18px; font-weight: 600; }
    .detail_emp_btns { display: flex; gap: 10px; }
    .detail_emp_btns .btn{ margin: 0; }
    .detail_emp_btns .btn:first-child { background: #fff; border: 1px solid #385F8D; color: #385F8D; }
    .detail_emp_btns .btn:first-child:hover{ background: #385F8D; color: #fff; }
    .today_loc { color: #000; font-size: 16px; line-height: 1.5; font-weight: 600; margin-top: 2px; margin-bottom: 5px; }
    .today_inf h5{ font-size: 14px; color: #385f8d; line-height: 1.2; font-weight: 500; }
    .today_inf a {  color: #385F8D !important; font-weight: 600 !important; }
    .single_product_grid_w { padding: 30px; }
    .single_product_grid_w h4 { color: #000; font-weight: 500; margin-bottom: 20px; }
    /* .detail_img_crop { width: 360px; height: 275px; border-radius: 10px; overflow: hidden; } */
    .detail_img_crop img { height: 290px !important; border-radius: 10px; }
    .detail_t_tag { 
      width: 60px;
      background: #385F8D;
      padding: 3px 0;
      text-align: center;
      color: #fff;
      border-radius: 5px;
      line-height: 25px;
      margin-bottom: 20px;
    } 
    .detail_type { color: #385F8D; font-weight: 600; }
    .detail_price { font-size: 22px; color: #385F8D; font-weight: 600; }
    .list_details_w a { color: #000; font-weight: 500; display: flex; align-items: center; gap: 5px; }
    .list_details_w a i{ font-size: 18px; }
    .owl-dot span { margin: 0 !important; }
    /* .owl-dots { display: flex; gap: 10px; } */
    .single_product_slider_w{ display: grid !important; gap: 20px; }
    .detail_list li{ display: flex; flex-wrap: wrap; align-items: center; }
    .detail_list li p:first-child { width: 100px; }
    .detail_b_thumb { border-radius: 10px; overflow: hidden; }
    .single_product_slider_w .owl-controls .owl-dots { display: flex; justify-content: space-between; flex-wrap: wrap;}
    .single_product_slider_w .owl-controls .owl-dots span { margin-bottom: 10px !important; width: 100px !important; } 
    .single_product .single_item .thumb img { height: auto; }
    .detail_b_thumb { height: 230px; overflow: hidden; }
    .detail_btn_w { display: flex; gap: 5px; }
    
    .detail_info {
      display: flex;
      justify-content: space-between;
      width: 100%;
      align-items: flex-end; 
      margin-bottom: 15px; 
    }
    .de_info_right .price { display: grid; justify-items: end; }
    .de_info_right .price p { font-size: 16px; font-weight: 500; margin: 0; color: #000; }
    .de_info_left p { font-size: 18px; color: #385F8D; font-weight: 500; margin: 0; }
    .de_info_left h3 { font-size: 24px; color: #000;  }
    .de_info_left ul { margin: 0; }
    .de_info_left ul li a{ font-size: 18px; color: #000; }
    .de_info_pr { line-height: normal; font-size: 24px !important; color: #385F8D !important; font-weight: 600 !important; }
    .de_info_right { display: grid; justify-items: end; align-content: space-between;}
    
    .detail_btn { cursor: pointer; background: #f8f8f8; border: none; border-radius: 5px; width: 40px; height: 40px; display: flex; justify-content: center; align-items: center; }
    .detail_btn:active { outline: none; border: transparent; }
    .detail_btn:focus { outline: none; }
    .detail_btn i { color: #000; }
    .detail_btn_w .fill_heart { color: #E93C3C; }
    
    .related .details .tc_content h4 { font-size: 18px; }
    .related .details .tc_content { margin-bottom: 0; }
    .related .details .tc_content p { font-size: 16px; }
    .related .details .fp_footer .fp_pname { font-size: 16px; }
    .related .details .tc_content_w .text-inf-w { gap: 0; }
    .related .details .fp_footer .fp_meta li { margin-right: 5px; }
    .related .details .fp_footer .fp_meta .sawon_crop { width: 32px; height: 32px; }
    
    .sidebar_enterinfo h4 { color: #000; font-weight: 600; }
    .enterinfo { margin: 0; }
    .enterinfo li{ display: flex; justify-content: space-between; }
    .enterinfo li p { font-size: 14px; margin: 0; color: #000; }
    .enterinfo li p:first-child { font-weight: 600; }
    .order_list li { padding-left: 15px !important; }
    .detail_img { margin-top: 20px; }
    .detail_width { display: flex; gap: 10px; }
    
    table.dataTable tbody tr { background-color: #fff!important; }
    
    .nodata_serch { padding: 230px 0; width: 100%; text-align: center; }
    .nodata_serch .nodata_np { margin-top: 20px !important; color: #385f8d; font-weight: 500; }
    .nodata_serch p { margin-top: 10px !important; font-size: 18px; color: #828282; text-align: center; margin: 0; }
    .nodata_serch .btn { margin-top: 55px; border: 1px solid #385f8d; background: transparent; color: #385f8d; padding: 10px 40px; }
    .nodata_serch .btn:hover { color: #fff; background: #385f8d; }
    
    .hashtag_w { display: flex; gap: 10px; margin-bottom: 20px; }
    .hashtag { font-weight: 500; font-size: 14px !important; border-radius: 3px; padding: 6px 14px; background: #fff; border: 1px solid #385f8d; color: #385f8d !important; }
    .listing_single_description .card.card-body { overflow: hidden; }
    
    
    
</style>


</head>

<body>


    <div class="wrapper">




        <!-- Inner Page Breadcrumb -->

        <div class="col-lg-8">

            <!-- 수정 -->
            <div class="detail_img">
                <div class="col-lg-12 single_product_grid row single_product_grid_w">

                    <div class="detail_info">
                        <div class="de_info_left">
                            <p>상가빌딩</p>
                            <h3>부산 해운대구 재송동</h3>
                            <ul>
                                <li><a href="#">제2종일반주거지역</a>
                                </li>
                                <div class="detail_width">
                                    <li><a href="#">토지면적
                                            <span class="area" data-m2="420.00㎡" data-py="127.05평">420.00㎡</span></a></li>
                                    <li><a href="#">연면적 <span class="area" data-m2="986.18㎡" data-py="298.32평">986.18㎡</span></a>
                                    </li>
                                </div>
                            </ul>
                        </div>
                        <div class="de_info_right">
                            <div class="price">
                                <p class="de_info_pr">매매 <span class="mont">34억원</span></p>
                                <p><span class="mont">2,676만원</span> <span class="mont">(3.3㎡)</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper mySwiper swiper-initialized swiper-horizontal swiper-backface-hidden">
                        <div class="swiper-wrapper" id="swiper-wrapper-bd129101b3b69f5107" aria-live="polite"
                            style="transition-duration: 0ms; transform: translate3d(0px, 0px, 0px); transition-delay: 0ms;">
                            <div class="swiper-slide" role="group">
                                <img src="/images/noimg.jpg" alt="">
                            </div>
                        </div>
                        
                    </div>


                </div>
            </div>
            <!-- Agent Single Grid View -->
            <section class="our-agent-single bgc-f7 pb30-991">
                <div class="container container_w">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 pl-0 pr-0">
                            <div class="row pl10 pr10">
                                <div class="col-lg-12 pl-0 pr-0">
                                    <div class="listing_single_description description_w">
                                        <h4 class="mb20">상세내용</h4>

                                        <div class="description card card-body">
                                            <p>투자노후보장////공실무</p>
                                        </div>

                                    </div>

                                </div>
                                <div class="col-lg-12 pl-0 pr-0">
                                    <div class="additional_details additional_w">
                                        <div class="col-lg-12 pl-0 pr-0">
                                            <h4 class="mb10">매물정보</h4>
                                        </div>

                                        <ul class="list-inline-item detail_list row">
                                            <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                                <p>매물유형 :</p>
                                                <p>상가빌딩</p>
                                            </li>
                                            <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                                <p>대지면적 :</p>
                                                <p class="mont">420.00㎥ (127.05p)
                                                </p>
                                            </li>
                                            <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                                <p>지목 :</p>
                                                <p>대</p>
                                            </li>
                                            <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                                <p>용도지역 :</p>
                                                <p>제2종일반주거지역</p>
                                            </li>


                                            <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                                <p>연면적 :</p>
                                                <p class="mont">986.18㎥ (298.32p)</p>
                                            </li>


                                            <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                                <p>건물용도 :</p>
                                                <p>제2종근린생활시설</p>
                                            </li>
                                            <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                                <p>주구조 :</p>
                                                <p>철근콘크리트구조</p>
                                            </li>
                                            <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                                <p>규모 :</p>
                                                <p>지하 1층 / 지상 5층</p>
                                            </li>
                                            <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                                <p>주차시설 :</p>
                                                <p>4 대</p>
                                            </li>
                                            <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                                <p>승강기 :</p>
                                                <p>1 대</p>
                                            </li>


                                        </ul>
                                    </div>
                                    <div class="additional_details additional_w">
                                        <div class="col-lg-12 pl-0 pr-0 d-flex align-items-center">
                                            <h4 class="mb10 mr-2">추가설명</h4>
                                        </div>
                                        <ul class="list-inline-item detail_list row">
                                            <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                                <p>사용승인일 :</p>
                                                <p>2006-09-12</p>
                                            </li>
                                            <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                                <p>방향 :</p>
                                                <p>남 (출입구 기준)</p>
                                            </li>
                                            <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                                <p>방/화장실 :</p>
                                                <p>6개 / 6개</p>
                                            </li>
                                            <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                                <p>월관리비 :</p>
                                                <p>없음</p>
                                            </li>
                                            <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                                <p>난방방식 :</p>
                                                <p>-</p>
                                            </li>
                                            <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                                <p>입주정보 : </p>
                                                <p>즉시입주 </p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="additional_details additional_w">
                                        <div class="col-lg-12 pl-0 pr-0">
                                            <h4 class="mb10">가격정보</h4>
                                        </div>


                                        <ul class="list-inline-item detail_list row">
                                            <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                                <p>매매가격 :</p>
                                                <p>34억원</p>
                                            </li>
                                            <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                                <p>월세현황 :</p>
                                                <p>보증금 11,200만원 / 월세
                                                    820만원</p>
                                            </li>
                                            <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                                <p>융자금 :</p>
                                                <p>없음
                                                </p>
                                            </li>
                                            <li class="col-md-6 col-lg-6 col-xl-6 pl-0 pr-0">
                                                <p>예상 수익률 :</p>
                                                <p class="mont">2.99%</p>
                                            </li>
                                        </ul>



                                    </div>
                                </div>
                                <div class="col-lg-12 pl-0 pr-0">
                                    <div class="application_statics mt30 map_w">
                                        <div class="map_top_w mb20">
                                            <h4>지도</h4>
                                            <p class="float-right">
                                                <i class="ri-map-pin-2-line"></i>
                                                부산 해운대구 재송동
                                            </p>
                                        </div>

                                        <div style="width:auto;height:400px;">
                                            
                                            <div id="map" style="width:auto;height:100%;"></div>
                                            


                                        </div>

                                    </div>
                                </div>


                                <div class="col-lg-12 pl-0 pr-0">
                                    <div class="whats_nearby mt30 nearby_w">
                                        <h4 class="mb10">근처시설

                                        </h4>
                                        <script>
                                            $(document).ready(function() {

                                                //Tooltip, activated by hover event
                                                $("body").tooltip({
                                                        selector: "[data-toggle='tooltip']",
                                                        container: "body"
                                                    })
                                                    //Popover, activated by clicking
                                                    .popover({
                                                        selector: "[data-toggle='popover']",
                                                        container: "body",
                                                        html: true
                                                    });
                                                //They can be chained like the example above (when using the same selector).

                                            });
                                        </script>
                                        <div class="education_distance mb15 education_w">
                                            <h5><i class="ri-school-line"></i> 교육시설
                                            </h5>
                                            <div class="single_line single_w nearby-infra edu" data-x="129.129350883405"
                                                data-y="35.193898129967">
                                                <p class="para">반산초등학교</p>
                                                <ul class="review">
                                                    <li class="list-inline-item">
                                                        <p>530m</p>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="single_line single_w nearby-infra edu" data-x="129.127625799014"
                                                data-y="35.1865138445191">
                                                <p class="para">재송초등학교</p>
                                                <ul class="review">
                                                    <li class="list-inline-item">
                                                        <p>375m</p>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="single_line single_w nearby-infra edu" data-x="129.122629730562"
                                                data-y="35.1915975009431">
                                                <p class="para">신재초등학교</p>
                                                <ul class="review">
                                                    <li class="list-inline-item">
                                                        <p>403m</p>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="single_line single_w nearby-infra edu" data-x="129.12862727038407"
                                                data-y="35.19338639101464">
                                                <p class="para">재송중학교</p>
                                                <ul class="review">
                                                    <li class="list-inline-item">
                                                        <p>449m</p>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="single_line single_w nearby-infra edu" data-x="129.119250295302"
                                                data-y="35.1898003504925">
                                                <p class="para">송수초등학교</p>
                                                <ul class="review">
                                                    <li class="list-inline-item">
                                                        <p>656m</p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="education_distance mb15 style2 education_w">
                                            <h5><i class="ri-store-line"></i> 주변시설
                                            </h5>
                                            <div class="single_line single_w nearby-infra near" data-x="129.12382608627888"
                                                data-y="35.18661480896755">
                                                <p class="para">한양스토아</p>
                                                <ul class="review">
                                                    <li class="list-inline-item">
                                                        <p>422m</p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="education_distance style3 education_w">
                                            <h5><i class="ri-bus-2-line"></i> 교통정보
                                            </h5>
                                            <div class="single_line single_w nearby-infra traffic" data-x="129.120092561969"
                                                data-y="35.1880806332915">
                                                <p class="para">재송역 동해선</p>
                                                <ul class="review">
                                                    <li class="list-inline-item">
                                                        <p>608m</p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

</body>

</html>