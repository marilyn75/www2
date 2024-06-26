<script>
    var jsonCate;

    // $.ajax({
    //     url: '{{ route('common.ajax.getSaleCategory') }}',
    //     type: 'GET',
    //     dataType: 'json',
    //     async: false,  // 동기적으로 설정
    //     success: function(response) {
    //         if(response.result){
    //             jsonCate = response.data;
    //             console.log(jsonCate);
    //         }else{
    //             alert(response.message);
    //         }
    //     },
    //     error: function(error) {
    //         console.error('Error:', error);
    //     }
    // });

    function addFavorite(obj, id) {
        var $child = $(obj).children();

        var flag = ($child.hasClass('ri-heart-3-line')) ? "add" : "remove";
        var params = {
            id: id,
            flag: flag
        };

        var r = doAjax('{{ route('common.ajax.addFavorite') }}', params);

        if (r.result) {
            if (flag == "add") $child.removeClass('ri-heart-3-line').addClass('ri-heart-3-fill');
            else $child.removeClass('ri-heart-3-fill').addClass('ri-heart-3-line');

            // if(flag=="add") $child.addClass('on');
            // else            $child.removeClass('on');
            sbAlert(r.message);
        }

        return false;
    }

    $(document).ready(function(){
        var r = doAjax('{{ route('common.ajax.getSaleCategory') }}');
        if (r.result) jsonCate = r.data;

        jsonCate.forEach(function(cate){
            $html = $('#divCategory label').eq(0).clone();
            $html.find('input').attr('checked',false).val(cate.id);
            $html.find('span').html(cate.title);
            $html.appendTo('#divCategory');
        });

        

        initFilterForm();initInputRange();

        console.log(JSON.parse(getCookie('filter_condition')));
    });

    $(document).on('change', "input[name='cate1']", function(){
        var idx = ($("input[name='cate1']").index(this));

        var html = '<label for="cate2" id="lbCate2">주거용</label><select id="cate2" name="cate2" class="selectpicker w100 show-tick"></select>';

        $('#divCate2').html(html);
        if(idx>0){
            var data = jsonCate[idx-1];
            $('#lbCate2').html(data.title);
            $('#cate2').append($('<option>', {value: ' ', text: data.title+' 전체'}));
            data.children.forEach(function(subCate){
                $('#cate2').append($('<option>', {
                            value: subCate.id,
                            text: subCate.title
                        }));
            });
            $('#cate2').selectpicker('refresh');
            $("#divSubCategory").show();
        }else{
            $("#divSubCategory").hide();
        }
        console.log('change cate1');
    });


    $(document).on('change', '#transArea', function() {
        if (this.checked) {
            $('.area').each(function() {
                $(this).html($(this).data('py'));
            });
        } else {
            $('.area').each(function() {
                $(this).html($(this).data('m2'));
            });
        }
    });

    // 초기화
    $(document).on('click', '.reset_btn', function(){
        setCookie('filter_condition','');
        frm.reset();
        frm.submit();
    });
</script>

<form name="frm" action="{{ $data->path() }}" method="post" class="row">
    @csrf
    <input type="hidden" name="page" value="1">

    <!-- mobile filter -->
    <div class="row">
        <div class="col-lg-12">
            <div class="listing_sidebar dn db-991">
                <div class="sidebar_content_details style3">
                    <!-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> -->
                    <div class="closebtn_wrap">
                        <a class="filter_closed_btn" href="#"><i class="ri-close-line"></i></a>
                    </div>
                    <div class="sidebar_listing_list style2 mobile_sytle_sidebar mb0" id="divFilterM">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- mobile filter end -->

    <!-- pc side bar -->
    <div class="col-lg-3 col-xl-3">
        <div class="dn-smd dn-991 pc_filter_bx" id="divFilter">
            @include('include.filter2')
        </div>
    </div>
    <!-- pc side bar end -->

    <div class="col-md-12 col-lg-9">
        <!-- 검색결과 -->
        <div class="row row_w">
            <div class="grid_list_search_result search_result_w">
                <div class="right_area text-right tac-xsd subfilter_w">
                    <ul class="sub_filt">
                        {{-- <li class="list-inline-item">
                                <select class="selectpicker show-tick">
                                    <option>최신순</option>
                                    <option>오래된순</option>
                                    <option>찜하기순</option>
                                </select>
                            </li> --}}
                        <li class="list-inline-item">
                            <select class="selectpicker show-tick" name="sort"
                                onchange="frm.sort.value=this.value;frm.submit();">
                                <option value="done_date|desc" @if (@$_POST['sort'] == 'done_date|desc') selected @endif>
                                    최신순</option>
                                <option value="done_date" @if (@$_POST['sort'] == 'done_date') selected @endif>오래된순
                                </option>
                                <option value="isRecom|desc" @if (@$_POST['sort'] == 'isRecom|desc') selected @endif>
                                    추천순</option>
                                <option value="salePrice|desc" @if (@$_POST['sort'] == 'salePrice|desc') selected @endif>
                                    높은가격순</option>
                                <option value="salePrice" @if (@$_POST['sort'] == 'salePrice') selected @endif>낮은가격순
                                </option>
                                {{-- <option value="zzim desc" @if ($_POST['sort'] == 'zzim desc') selected @endif>찜하기순</option>
                                    <option value="price desc" @if ($_POST['sort'] == 'price desc') selected @endif>높은가격순</option>
                                    <option value="price asc" @if ($_POST['sort'] == 'price asc') selected @endif>낮은가격순</option> --}}
                            </select>
                        </li>
                        <li>
                            <div class="button r" id="button-1">
                                <input type="checkbox" class="checkbox" id="transArea" />
                                <div class="knobs"></div>
                                <div class="layer"></div>
                            </div>
                        </li>
                        <!-- <input type="checkbox" checked data-toggle="toggle" data-on="㎡" data-off="평"> -->
                    </ul>
                </div>
            </div>
        </div>
        <!-- 검색결과 end -->

        <div class="row">
            @if($data->total()>0)
            @foreach ($data as $_data)
                @php

                    $printData = App\Http\Class\IntraSaleClass::getPrintData($_data);

                    // if(!empty($favorites) && in_array($printData['idx'], $favorites)) $printData['isFavorite'] = true;

                @endphp
                <x-item-sale-intranet type='default' :printData="$printData" />
            @endforeach
            <x-pagination :data="$data" />
            @else
                <div class="nodata_serch">
                    <img src="/images/nodata.png" alt="">
                    <p class="nodata_np">해당매물이 없습니다</p>
                    <p>검색어를 바르게 입력하셨는지 확인하시거나,<br>
                        다른 조건으로 검색해보세요!</p>
                    <button class="btn btn-thm_w reset_btn">매물 둘러보기</button>
                </div>
            @endif
        </div>
    </div>
</form>