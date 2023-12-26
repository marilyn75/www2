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

    function initFilterForm(){
        var oldCond = JSON.parse(getCookie('filter_condition'));

        jsonCate.forEach(function(cate){
            $html = $('#divCategory label').eq(0).clone();
            $html.find('input').attr('checked',false).val(cate.id);
            $html.find('span').html(cate.title);
            $html.appendTo('#divCategory');
        });

        if(oldCond.cate1){
            $("input[name='cate1']").eq(0).attr('checked',false);
            $("input[name='cate1']").eq(0).parent().removeClass('active');
            $("input[name='cate1'][value='"+oldCond.cate1+"']").click();
        }
        if(oldCond.cate2){
            frm.cate2.value = oldCond.cate2;
            $('#cate2').selectpicker('refresh');
        }

        if(oldCond.tradeType){
            $("input[name='tradeType']").eq(0).attr('checked',false);
            $("input[name='tradeType']").eq(0).parent().removeClass('active');
            $("input[name='tradeType'][value='"+oldCond.tradeType+"']").click();
        }
        if(oldCond.location){
            $("input[name='location']").val(oldCond.location);
        }
        if(oldCond.toPrice){
            frm.fromPrice.value = oldCond.fromPrice;
            frm.toPrice.value = oldCond.toPrice;
            controlFromInput(fromSlider, fromInput, toInput, toSlider);
            controlToInput(toSlider, fromInput, toInput, toSlider);
        }
        if(oldCond.toArea){
            if(oldCond.area_unit=='p'){
                tranBtnClick();
            }
            frm.fromArea.value = oldCond.fromArea;
            frm.toArea.value = oldCond.toArea;
            controlFromAreaInput(fromAreaSlider, fromAreaInput, toAreaInput, toAreaSlider);
            controlToAreaInput(toAreaSlider, fromAreaInput, toAreaInput, toAreaSlider);
        }
    }

    $(document).ready(function(){
        var r = doAjax('{{ route('common.ajax.getSaleCategory') }}');
        if (r.result) jsonCate = r.data;

        initFilterForm();

        console.log(JSON.parse(getCookie('filter_condition')));
    });

    $(document).on('change', "input[name='cate1']", function(){
        var idx = ($("input[name='cate1']").index(this));

        $('#cate2 option').remove();
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
</script>

<form name="frm" action="{{ $data->path() }}" method="post" class="row pl15 pr15">
    @csrf
    <input type="hidden" name="page" value="1">

    @if((new Jenssegers\Agent\Agent)->isMobile())
    <!-- mobile filter -->
    <div class="row">
        <div class="col-lg-12">
            <div class="listing_sidebar dn db-991">
                <div class="sidebar_content_details style3">
                    <!-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> -->
                    <a class="filter_closed_btn float-right" href="#"><i class="ri-close-line"></i></a>
                    <div class="sidebar_listing_list style2 mobile_sytle_sidebar mb0">
                        @include('include.filter')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- mobile filter end -->
    @else
    <!-- pc side bar -->
    <div class="col-lg-3 col-xl-3">
        <div class="dn-smd dn-991 pc_filter_bx">
            @include('include.filter')
        </div>
    </div>
    <!-- pc side bar end -->
    @endif
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
                                <option value="reg_date|desc" @if (@$_POST['sort'] == 'reg_date|desc') selected @endif>
                                    최신순</option>
                                <option value="reg_date" @if (@$_POST['sort'] == 'reg_date') selected @endif>오래된순
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
            @foreach ($data as $_data)
                @php

                    $printData = App\Http\Class\IntraSaleClass::getPrintData($_data);

                    // if(!empty($favorites) && in_array($printData['idx'], $favorites)) $printData['isFavorite'] = true;

                @endphp
                <x-item-sale-intranet type='default' :printData="$printData" />
            @endforeach
            <x-pagination :data="$data" />
        </div>
    </div>
</form>
