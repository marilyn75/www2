<style>
    .horizontal-list {
        list-style: none; /* 기본 목록 마커(불릿)을 제거합니다. */
        display: flex; /* Flexbox 레이아웃을 사용합니다. */
        flex-direction: row; /* 가로로 배치합니다. */
    }

    .horizontal-list li {
        margin-right: 10px; /* 각 항목 간의 간격을 지정할 수 있습니다. */
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
</script>
<form name="frmCreate" action="{{ $uri }}" method="post">
    @csrf
    <input type="hidden" name="tmp_id" value="{{ $data['tmp_id'] }}">
    <input type="hidden" name="step" value="2">
    <input type="hidden" name="saleType" value="{{ old('saleType') }}">
    <input type="hidden" name="saleTypeTxt" value="{{ old('saleTypeTxt') }}">
<div class="w-100">
    <div class="row">
        <div class="col-lg-12">
            <div class="my_dashboard_review">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="mb30">매물 등록하기</h4>
             
                        <div class="my_profile_setting_textarea">
                            <label for="propertyDescription">거래유형</label>
                        </div>
                        <div class="ui_kit_radiobox">
                            @foreach ($tradeType as $_item)
                            <div class="radio">
                                <input id="tradeType{{ $_item['id'] }}" value="{{ $_item['id'] }}" name="tradeType" type="radio" >
                                <label for="tradeType{{ $_item['id'] }}"><span class="radio-label"></span> {{ $_item['title'] }}</label>
                            </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            @endforeach
                        </div>	
                        
                    </div>

                    <div class="col-lg-6 col-xl-6">
                        <div class="my_profile_setting_input ui_kit_select_search form-group">
                            <label>매물유형</label>
                            <select class="selectpicker" data-live-search="false" data-width="100%" name="saleType1" id="saleType1">
                                <option value="">-- 선택하세요 --</option>
                                @foreach ($saleType as $_item)
                                <option data-tokens="{{ $_item['title'] }}" value="{{ $_item['id'] }}">{{ $_item['title'] }}</option>    
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-6">
                        <div class="my_profile_setting_input ui_kit_select_search form-group">
                            <label>&nbsp;</label>
                            <select class="selectpicker" data-live-search="false" data-width="100%" name="saleType2" id="saleType2">
                                <option value="">-- 선택하세요 --</option>

                            </select>
                        </div>
                    </div>

                    
                    <div class="col-xl-12">
                        <div class="my_profile_setting_input">
                            <button class="btn btn1 float-left" onclick="return false;">Cancel</button>
                            <button class="btn btn2 float-right">Next</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
</form>