<style>
    .inbox-item {
        background-color: white;cursor: pointer;
    }
    .inbox-item:hover {
        background-color: #cccccc;
    }

    .address-box {
        border: 1px solid #000;
        border-radius: 10px;
        padding: 10px;
        width: 100%;
    }

    .address-jibun {
        font-weight: bold;
        color: #000;
    }

    .address-road {
        color: #666;
    }

    .delete-button {
        float: right;
    }
</style>

<script>
    $(document).on('change', '#saleType1', function(){
        var id = this.value;
        if(id){
            $.ajax({
                type: 'post',
                url : "{{ route('page.ajax', $page->id) }}",
                data: {'_token': '{{ csrf_token() }}', 'mode' : 'getChildrenFromId', 'code_id': id},
                dataType: 'json', 
                success: function(jsonData){
                    //작업이 성공적으로 발생했을 경우
                    console.log(jsonData);
                    // 첫 번째 옵션을 제외한 나머지 옵션을 제거
                    $('#saleType2 option:not(:first)').remove();

                    // JSON 데이터를 이용하여 옵션 추가
                    $.each(jsonData, function (key, value) {
                        
                        $('#saleType2').append($('<option>', {
                            value: value.id,
                            text: value.title
                        }));
                    });

                    // selectpicker를 업데이트
                    $('#saleType2').selectpicker('refresh');
                },
                error:function(e){  
                    //에러가 났을 경우 실행시킬 코드
                    console.log(e);
                }
            });
        }else{
            $('#saleType2 option:not(:first)').remove();
            $('#saleType2').selectpicker('refresh');
        }
        frmCreate.saleType.value = "";
        frmCreate.saleTypeTxt.value = "";
    });

    $(document).on('change', '#saleType2', function(){
        var id = this.value;
        var saleType="";
        var saleTypeTxt="";
        if(id){
            saleType = $('#saleType1 option:selected').val() + "_" + $('#saleType2 option:selected').val();
            saleTypeTxt = $('#saleType1 option:selected').text() + " > " + $('#saleType2 option:selected').text();
        }
        frmCreate.saleType.value = saleType;
        frmCreate.saleTypeTxt.value = saleTypeTxt;
    });

    var schTxt;
    $(document).on("keyup", '#addrSearch', function(){
        console.log('searck keyup');

        if($.trim(this.value) == $.trim(schTxt)) return false;
        else	$("#searchResult > div").remove();

        var limit = 15;
        var jsonSearchResult = $.ajax({
            url: "<?=env('LOCATION_API_URL')?>/api/search?query=" + this.value + "&limit=" + limit ,
            // url: "{{ route('AddrSearch') }}?query=" + this.value + "&limit=" + limit ,
            dataType: 'json',
            async: false
        }).responseJSON;


            var htmlItem = "";
            $.each(jsonSearchResult, function(k,dt){
                console.log(dt);
                htmlItem += '<div class="inbox-item"><ul class="mb-0 ps-1 hover-line cursor-pointer" onclick="selectLocation(this)" data-lx="'+dt.localX+'" data-ly="'+dt.localY+'" data-id="'+dt.id+'" data-pnu="'+dt.pnucode+'" >';
                htmlItem += '    <li class="inbox-item-author jibun">'+dt.jibun+'</li>';
                htmlItem += '    <li class="inbox-item-text road">'+dt.road+'</li>';
                htmlItem += '</ul></div>';
                
            });


        $("#searchResult").append(htmlItem);
        schTxt = this.value;

        // // 검색어 하이라이트
        // arrSchTxt = schTxt.split(" ");
        // $.each(arrSchTxt, function(key, data){
        //     console.log(data);
        //     $("#searchResult .jibun").highlight(data);
        //     $("#searchResult .road").highlight(data);
        // });
    });

    function selectLocation(obj){
        let jibun = $(obj).children(".jibun").html();
        let road = $(obj).children(".road").html();
        let localX = $(obj).data("lx");
        let localY = $(obj).data("ly");
        let pnucode = $(obj).data("pnu");
        let isUpdate = false;

        let html = '<div class="address-box">';
            html += '    <span class="delete-button" style="cursor:pointer;" onclick="$(this).parent().remove();">X</span>';
            html += '    <div class="address-jibun">'+jibun+'</div>';
            html += '    <div class="address-road">'+road+'</div>';
            html += '</div>';

        $("#search-dropdown").append(html);
        $("#searchResult > div").remove();
        $("#addrSearch").val("");

        // 해당 주소지의 건축물 정보 가저오기
        var jsonDong = $.ajax({
                url: '<?=env('LOCATION_API_URL')?>/api/getDong?pnucode=' + pnucode,
                dataType: 'json',
                async: false
            }).responseJSON;

        
        console.log(jsonDong);
        // 첫 번째 옵션을 제외한 나머지 옵션을 제거
        $('#dong option:not(:first)').remove();

        // JSON 데이터를 이용하여 옵션 추가
        $.each(jsonDong, function (key, value) {
            
            $('#dong').append($('<option>', {
                value: key,
                text: value
            }));
        });

        // selectpicker를 업데이트
        $('#dong').selectpicker('refresh');

        /* TODO 부속지번정보 가져와서 같이 표현하기*/
        /*
        if(!localX || !localY){
            var jsonCurrAddr = $.ajax({
                url: '<?=env('LOCATION_API_URL')?>/api/Geocoding?query=' + encodeURI(jibun),
                dataType: 'json',
                async: false
            }).responseJSON;
console.log(jsonCurrAddr);
            localX = jsonCurrAddr.addresses[0].x;
            localY = jsonCurrAddr.addresses[0].y;
            isUpdate = true;
        }	

        console.log(localX);

        // // 쿠키
        // if($(obj).data("id"))$.getJSON('{ route('setSearchHistoryCookie') }}',{'id':$(obj).data("id")});

        // let position = new naver.maps.LatLng(localY, localX);
        // map.setCenter(position);
        // //fn_dragend();
        // if(isUpdate){
        // // 좌표 디비 저장 todo
        //     $.ajaxSetup({async: true}); 
        //     $.post("{ route('saveCoordInfo') }}",{id: $(obj).data("id"),x:localX, y:localY, _token:'{{ csrf_token() }}'},
        //     function(data, status){
        //         console.log("Data: " + data + "\nStatus: " + status);
        //     });
        // }
        // resetSearchForm();

        // //getCurrMapCenter();

        var coord = {'x':localX, 'y':localY};

        // if(map.zoom < zoom_1) map.setZoom(zoom_1);

        var currAddrInfo = getAddressFromCoordinate(coord); // 좌표값으로 주소 찾기

        // 부속지번 pnucode 가져오기
        var subPnucode = $.ajax({
            url: "<?=env('LOCATION_API_URL')?>/api/getSubAddress?pnucode=" + currAddrInfo.pnucode ,
            dataType: 'json',
            async: false
        }).responseJSON;
        console.log(subPnucode);

        if(subPnucode.length > 0){
            if(confirm('관계지번이 ' + subPnucode.length + '개 있습니다. 추가 하시겠습니까?')){
                console.log('ok');
                var jsonFilterResult = $.ajax({
                    url: "<?=env('LOCATION_API_URL')?>/api/filter?field=pnucode&query=" + subPnucode[0] ,
                    dataType: 'json',
                    async: false
                }).responseJSON;

                console.log(jsonFilterResult);
            }
        }

        // subPnucode.push(currAddrInfo.pnucode);

        // // pnucode로 폴리곤 그리기
        // drawPolygon(subPnucode);

        // currAddrInfo.x = coord.x;   // 위치 좌표 담기
        // currAddrInfo.y = coord.y;   // 위치 좌표 담기

        // // 사이드 정보 표시
        // if(mobile_max_width >= window.innerWidth){   // 모바일 모드
        //     $('#bottom_layer').load(routeUrl.ajax + '/sideInfo.viewM',currAddrInfo).show().addClass('up');
        // }else{
        //     showSideInfo(currAddrInfo);      
        // }
        */
    }

    // 동 선택시 호 세팅
    $(document).on('change', '#dong', function(){
        let bldpk = this.value;
  
            var jsonHo = $.ajax({
                url: '<?=env('LOCATION_API_URL')?>/api/getHo?bldpk=' + bldpk,
                dataType: 'json',
                async: false
            }).responseJSON;
  
        console.log(jsonHo);
        // 첫 번째 옵션을 제외한 나머지 옵션을 제거
        $('#ho option:not(:first)').remove();

        // JSON 데이터를 이용하여 옵션 추가
        $.each(jsonHo, function (key, value) {
            
            $('#ho').append($('<option>', {
                value: value.id,
                text: value.text
            }));
        });

        // selectpicker를 업데이트
        $('#ho').selectpicker('refresh');
    });
</script>
<form name="frmCreate" action="{{ $uri }}" method="post">
    @csrf
    <input type="hidden" name="tmp_id" value="{{ $data['tmp_id'] }}">
    <input type="hidden" name="step" value="3">

<div class="w-100">
    <div class="row">
        <div class="col-lg-12">
            <div class="my_dashboard_review">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="my_profile_setting_input form-group">
                            <label for="formGroupExamplePrice">주소검색</label>
                            <input type="search" class="form-control" id="addrSearch">
                        </div>
                    </div>
                    <div class="col-xl-12" id="search-dropdown" >
                        <!-- 검색 키워드 목록 -->
                        
                            <!-- <h4 class="header-title mt-2 mb-2">검색결과</h4> -->
                            <div id="searchResult" class="inbox-widget">
 
                            </div> 
                    </div>

                    <div class="col-lg-6 col-xl-6">
                        <select class="selectpicker" data-live-search="true" data-width="100%" name="dong" id="dong">
                            <option value="">동 선택</option>
                            
                        </select>
                    </div>
                    <div class="col-lg-6 col-xl-6">
                        <select class="selectpicker" data-live-search="true" data-width="100%" name="ho" id="ho">
                            <option value="">호 선택</option>
                            
                        </select>
                    </div>

                    <div class="col-xl-12">
                        <div class="my_profile_setting_input">
                            <button class="btn btn1 float-left" onclick="frmCreate.step.value='1';frmCreate.submit();">Back</button>
                            <button class="btn btn2 float-right">Next</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
</form>