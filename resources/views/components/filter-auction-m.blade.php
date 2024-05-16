<script>
    function setFilterFromjsonFilter_m(){
        setFilterAddr1_m();
        setFilterAddr2_m();
        // setFilterPurpos1();
        // setFilterPurpos2();
        setFilterPurpos_m();

        // setFilterCost();
        initInputRange_m();
        setFilterCost_m();
        setFilterStatus_m();

        printFilterButton_m();
    }

    function setFilterAddr1_m(){
        // 지역 1
        $('#ftAddr_m div:eq(0) li button').removeClass('sel');
        $('#ftAddr_m div:eq(0) li button').each(function(index){
            let code = $(this).data('code');
            if(chkCodeJsonArray(jsonFilter.addr, code)){
                $(this).addClass('sel');
            }
        });
    }

    function setFilterAddr2_m(){
        // 지역 2
        $('#ftAddr_m div:eq(1) li button').removeClass('sel');
        
        $('#ftAddr_m div:eq(1) li button').each(function(index){
            // let parent = $(this).closest('div').data('parent');
            // let str = this.innerHTML;
            // if(jsonFilter.addr[parent].includes(str)){
            //     $(this).addClass('sel');
            // }
            let code = $(this).data('code');
            let found = false;
            for(i=0;i<jsonFilter.addr.length;i++){
                if(chkCodeJsonArray(jsonFilter.addr[i].sub, code)){
                    $(this).addClass('sel');
                }
            }
        });
    }

    function setFilterPurpos_m(){
        // 용도 1
        $('#ftPurpos_m input[type=checkbox]').attr('checked',false);
        $('#ftPurpos_m label').removeClass('active');
        $('#ftPurpos_m input[type=checkbox]').each(function(index){
            let code = $(this).data('code');
            for(i=0;i<jsonFilter.purpose.length;i++){
                if(chkCodeJsonArray(jsonFilter.purpose[i].sub, code)){
                    console.log('chk filter code',code);
                    $(this).attr('checked',true);
                    $(this).parent().addClass('active');
                }
            }
        });
    }

    function setPurpos_m(){
        console.log('setPurpos_m');
        // mobile
        var $htmlCate1 = $('<div class="divParentPurpose"><p>주거용</p><div class="filt_btns m_filt_btns divCatePurpose" data-toggle="buttons"></div></div>');
        var $htmlCate2 = $('<label class="btn filt_r-btn m_filt_r inter"><input type="checkbox" class="cate_m" name="cate1" autocomplete="off"><span>전체</span></label>');
        var $cate = $('<div></div>');
        jsonPurpos.forEach(function(purpose){
            let $cate1 = $htmlCate1.clone();
           
            $cate1.find('p').html(purpose.title);
            // $cate1.insertAfter($cate);
            $cate.append($cate1);
            let $cate2 = $htmlCate2.clone();
            $cate2.find('input').attr('data-code',purpose.id + '_0');
            $cate1.find('.m_filt_btns').append($cate2);
            
            purpose.children.forEach(function(purpose_sub){
                $cate2 = $htmlCate2.clone();
                $cate2.find('input').attr('data-code',purpose.id +'_'+purpose_sub.id);
                $cate2.find('span').html(purpose_sub.title);
                $cate1.find('.m_filt_btns').append($cate2);
            });
        });
// console.log('$cate',$cate.html());
        $("#ftPurpos_m .m_filt_tit").after($cate);
    }

    function printFilterButton_m(){
        // 지역
        var loc_txt = "지역: ";
        $('#filter-addr_m').html('');
        jsonFilter.addr.forEach(function(item){
            item.sub.forEach(function(subItem){
                $btn = $btnFilter.clone();

                if(subItem.code=="2600000000"){
                    loc_txt += "전체";
                    $('.loc_input').val(loc_txt);
                    return false;
                } 

                $btn.attr('data-code',subItem.code);
                if(subItem.txt.includes('전체')){
                    $btn.find('span').html(subItem.txt);
                    loc_txt += subItem.txt + ",";
                }else{
                    $btn.find('span').html(item.txt + '-' + subItem.txt);
                    loc_txt += item.txt + '-' + subItem.txt + ",";
                }

                $('#filter-addr_m').append($btn);

                $('.loc_input').val(loc_txt.substr(0, loc_txt.length - 1));
            });
        });
    }

    // 구 선택
    $(document).on('click', '#ftAddr_m div:eq(0) li button', function() {

        var pnu = $(this).data('code');

        setDong(pnu);

        let btnCount = $(this).closest('div').find('button').length;
        let btnSelCount = $(this).closest('div').find('button.sel').length;
        if(btnCount - btnSelCount == 2 && !$(this).hasClass('sel')){
            setDong($(this).closest('div').find('button:first').data('code'));
            changeJsonFilterAddr($(this).closest('div').find('button:first'), $(this).hasClass('sel'));
        }
        else                                                        changeJsonFilterAddr(this, $(this).hasClass('sel'));

        setFilterAddr1_m();
        setFilterAddr2_m();

        console.log(jsonFilter.addr);
    });

    // 동 선택
    $(document).on('click', '#ftAddr_m div:eq(1) li button', function() {

        let btnCount = $(this).closest('div').find('button').length;
        let btnSelCount = $(this).closest('div').find('button.sel').length;
        if(btnCount - btnSelCount == 2 && !$(this).hasClass('sel')) changeJsonFilterAddr($(this).closest('div').find('button:first'), $(this).hasClass('sel'));
        else                                                        changeJsonFilterAddr(this, $(this).hasClass('sel'));

        setFilterAddr1_m();
        setFilterAddr2_m();

        // selFilter($(this));
    });

    // 용도선택
    $(document).on('click', '#ftPurpos_m input[type=checkbox]', function(){
        let $div = $(this).closest('div');
        let idx = $('input[type=checkbox]', $div).index($(this));
        let isChecked = $(this).is(':checked');
        let txt = $(this).find('span').html();

        let code = $(this).data('code').toString();

        if(isChecked){  // 체크하려함
            if(idx==0){
                parent_txt = $div.prev().html();
                txt = parent_txt.replace("건물"," 전체");

                btnOff($div.find('input[type=checkbox]:not(:first)'));
                // $div.find('input[type=checkbox]:not(:first)').prop("checked", false).parent().removeClass('active');

                // // selected 초기화
                // jsonFilter.purpose.forEach(function(item) {item.selected = 0;});
                // // 이미 있으면 selected = 1, 없으면 생성
                // if(jsonFilter.purpose.filter(item => item.code==code.replace('_0','')).length > 0){
                //     let addItem = jsonFilter.purpose.filter(item => item.code==code.replace('_0',''))[0];
                //     addItem.selected = 1;
                //     addItem.sub = [{'code':code,'txt':txt}];
                    
                //     jsonFilter.purpose = jsonFilter.purpose.filter(item => item.code!=code.replace('_0',''));
                //     jsonFilter.purpose.push(addItem);
                // }else{
                //     let addItem = {'code':code.replace('_0',''),'txt':parent_txt, sub:[{'code':code,'txt':txt}], 'selected':1};
                //     jsonFilter.purpose.push(addItem);

                //     jsonFilter.purpose = jsonFilter.purpose.filter(item => item.code!=0);   // 전체 노드 삭제
                // }
            }else{
                let chkCnt = $div.find('input[type=checkbox]:checked').length;
                
                if(chkCnt == $div.find('input[type=checkbox]').length - 1){
                    console.log(chkCnt, $div.find('input[type=checkbox]').length);
                    btnOff($div.find('input[type=checkbox]:not(:first)'));
                    btnOn($div.find('input[type=checkbox]:first'));
                    // $div.find('input[type=checkbox]:not(:first)').prop("checked", true).parent().addClass('active');
                }else{
                    if($div.find('input[type=checkbox]:first').is(':checked'))    btnOff($div.find('input[type=checkbox]:first'));
                }
            }
        }else{          // 해제하려함

        }

        // 1차 용도 모두 전체인지 체크
        let chkCnt = 0;
        $('#ftPurpos_m .divCatePurpose').each(function(idx, item){
            if($(item).find('input[type=checkbox]:eq(0)').is(":checked")) chkCnt++;
        });
        if(chkCnt == $('#ftPurpos_m .divCatePurpose').length){
            btnOff($('#ftPurpos_m').find('input[type=checkbox]'));
        }

        changeJsonFilterPurpos_m(this);

        console.log('jsonFilter.purpose',jsonFilter.purpose);
    });

    function btnOn($obj){
        $obj.prop("checked", true).parent().addClass('active');
    }
    function btnOff($obj){
        $obj.prop("checked", false).parent().removeClass('active');
    }

    function changeJsonFilterPurpos_m(obj){
        let $obj = $(obj);
        let $div = $obj.closest('div');
        let code = $obj.data('code').toString();
        let txt = $obj.next('span').html();
        let idx = $('input[type=checkbox]', $div).index($obj);

        if($('#ftPurpos_m input[type=checkbox]:checked').length == 0){
            jsonFilter.purpose = [{'code':'0','txt':'전체','sub':[{'code':'0_0','txt':'전체'}], 'selected':1}];
        }else{
            // // selected 초기화
            // jsonFilter.purpose.forEach(function(item) {item.selected = 0;});

            let jsonPurpose = [];
            $('#ftPurpos_m .divParentPurpose').each(function(idx, item){
                if($(item).find('input[type=checkbox]:first').is(':checked')){  // 전체 체크됨
                    let item_code = $(item).find('input[type=checkbox]:first').data('code').toString();
                    let parent_txt = $(item).find('p').html();
                    let sub_txt = parent_txt.replace('건물', '') + ' 전체';
                    let json_node = {'code':item_code.replace("_0",""),'txt':parent_txt,'sub':[{'code':item_code,'txt':sub_txt}], 'selected':0};

                    if(item_code == code){
                        jsonPurpose.forEach(function(item) {item.selected = 0;});
                        json_node.selected = 1;
                    }
                    
                    jsonPurpose.push(json_node);
                }else{
                    
                    $(item).find('input[type=checkbox]:checked').each(function(_idx, _item){
                        // 상위 노드 있는지 체크
                        let p_code = $(_item).data('code').split('_')[0];
                        if(jsonPurpose.filter(item => item.code==p_code).length == 0){  // 상위노드 없으면 생성
                            let item_code = p_code;
                            // let parent_txt = $div.prev().html();
                            let parent_txt = $(item).find('p').html();
                            let json_node = {'code':item_code.replace("_0",""),'txt':parent_txt,'sub':[], 'selected':0};
                            if(item_code.replace("_0","") == p_code){
                                jsonPurpose.forEach(function(item) {item.selected = 0;});
                                json_node.selected = 1;
                            }  

                            jsonPurpose.push(json_node);
                        }
                        
                        let json_sub_node = {'code':$(_item).data('code'),'txt':$(_item).next('span').html()};

                        jsonPurpose.filter(item => item.code==p_code)[0].sub.push(json_sub_node);

                        // let tmpNode = jsonPurpose.filter(item => item.code==p_code);
                        // tmpNode.sub.push(json_sub_node);
                        // jsonPurpose = jsonPurpose.filter(item => item.code!=p_code);
                        // jsonPurpose.push(tmpNode);
                    });
                    
                }
            });

            // // 이미 있으면 selected = 1, 없으면 생성
            // if(jsonFilter.purpose.filter(item => item.code==code).length > 0){
            //     jsonFilter.purpose.filter(item => item.code==code).selected = 1;
            // }else{
            //     if(idx > 0){
            //         let isFullChk = jsonPurpos.length - jsonFilter.purpose.length;
            //         if(isFullChk >= 2){

            //             let sub_code = 0;
            //             let sub_txt = txt.replace("건물","") + " 전체";
            //             let addItem = {'code':code,'txt':txt, sub:[{'code':code+'_'+sub_code,'txt':sub_txt}], 'selected':1};
            //             jsonFilter.purpose.push(addItem);

            //             jsonFilter.purpose = jsonFilter.purpose.filter(item => item.code!=0);   // 전체 노드 삭제
            //         }else{
            //             $ul = $("<ul></ul>");
            //             $ul.append('<li><button type="button" class="btn" data-code="0_0" data-parent_code="0">전체</button></li>');
            //             $('#ftPurpos div').eq(1).html($ul);

            //             jsonFilter.purpose = [{'code':'0','txt':'전체','sub':[{'code':'0_0','txt':'전체'}], 'selected':1}];
            //         }
            //     }else{
            //         $ul = $("<ul></ul>");
            //         $ul.append('<li><button type="button" class="btn" data-code="0_0" data-parent_code="0">전체</button></li>');
            //         $('#ftPurpos div').eq(1).html($ul);

            //         jsonFilter.purpose = [{'code':'0','txt':'전체','sub':[{'code':'0_0','txt':'전체'}], 'selected':1}];
            //     }
            // }

            jsonFilter.purpose = jsonPurpose;
        }


    }

    function initInputRange_m(){
        fromSlider = document.querySelector('#fromPrice1_slider_m');
        toSlider = document.querySelector('#toPrice1_slider_m');
        fromInput = document.querySelector('#fromPrice1_m');
        toInput = document.querySelector('#toPrice1_m');

        fromAreaSlider = document.querySelector('#fromPrice2_slider_m');
        toAreaSlider = document.querySelector('#toPrice2_slider_m');
        fromAreaInput = document.querySelector('#fromPrice2_m');
        toAreaInput = document.querySelector('#toPrice2_m');

        fillSlider(fromSlider, toSlider, '#D9D9D9', '#385f8d', toSlider);
        setToggleAccessible(toSlider, toSlider);

        fromSlider.oninput = () => controlFromSlider(fromSlider, toSlider, fromInput);
        toSlider.oninput = () => controlToSlider(fromSlider, toSlider, toInput);
        // fromInput.oninput = () => controlFromInput(fromSlider, fromInput, toInput, toSlider);
        // toInput.oninput = () => controlToInput(toSlider, fromInput, toInput, toSlider);

        fillSlider(fromAreaSlider, toAreaSlider, '#D9D9D9', '#385f8d', toAreaSlider);
        setToggleAccessible(toAreaSlider, toAreaSlider);

        fromAreaSlider.oninput = () => controlFromSlider(fromAreaSlider, toAreaSlider, fromAreaInput);
        toAreaSlider.oninput = () => controlToSlider(fromAreaSlider, toAreaSlider, toAreaInput);
        // fromAreaInput.oninput = () => controlFromInput(fromAreaSlider, fromAreaInput, toAreaInput, toAreaSlider);
        // toAreaInput.oninput = () => controlToInput(toAreaSlider, fromAreaInput, toAreaInput, toAreaSlider);

        console.log('initInputRange_m');
    }

    function setFilterCost_m(){
        console.log('setFilterCost',jsonFilter.cost);
        let from_idx = 0;
        let to_idx = 12;

        if(jsonFilter.cost.cost1.from.code!='') from_idx = arrPriceRange.findIndex(item => item.class == jsonFilter.cost.cost1.from.code);
        if(jsonFilter.cost.cost1.to.code!='') to_idx = arrPriceRange.findIndex(item => item.class == jsonFilter.cost.cost1.to.code);

        $('#fromPrice1_slider_m').val(from_idx);
        $('#toPrice1_slider_m').val(to_idx);
        
        from_idx = 0;
        to_idx = 12;

        if(jsonFilter.cost.cost2.from.code!='') from_idx = arrPriceRange.findIndex(item => item.class == jsonFilter.cost.cost2.from.code);
        if(jsonFilter.cost.cost2.to.code!='') to_idx = arrPriceRange.findIndex(item => item.class == jsonFilter.cost.cost2.to.code);

        $('#fromPrice2_slider_m').val(from_idx);
        $('#toPrice2_slider_m').val(to_idx);
        
        controlFromSlider(fromSlider, toSlider, fromInput);
        controlToSlider(fromSlider, toSlider, toInput);
        controlFromSlider(fromAreaSlider, toAreaSlider, fromAreaInput);
        controlToSlider(fromAreaSlider, toAreaSlider, toAreaInput);
        // initInputRange();
    }

    function setFilterStatus_m(){
        $('#ftStatus_m label').removeClass('active');
        $('#ftStatus_m input[type=radio]').prop('checked',false);
        $('#ftStatus_m input[type=radio]').each(function(index){
            if($(this).val() == jsonFilter.status.code){
                $(this).parent().addClass('active');
                $(this).prop('checked',true);
            }
        });
    }
</script>



{{-- new filter --}}

<form name="frm_m" action="">
    <div class="col-md-12 pl0 pr0">
        <div class="n_filter_b d-none">
            <div class="btn_wrap">
                <div id="filter-addr_m">
                    
                </div>
            </div>
        </div>
        <div class="">
            {{-- 지역 --}}

            <div class= "m_filt_sec">
                <div class="m_filt_tit">
                    <p>지역</p>
                </div>
                <input type="text" class="loc_input" value="지역: 전체">
                <div class="n_filter_sub" id="ftAddr_m">
                    
                    <div class="n_filter_subbox m_sub overflow-auto">
                        <ul>
                            <li>부산 전체</li>
                            <li>중구</li>
                            <li>서구</li>
                            <li>동구</li>
                            <li>영도구</li>
                            <li>부산진구</li>
                            <li>동래구</li>
                            <li>남구</li>
                            <li>북구</li>
                        </ul>
                    </div>
                    <div class="n_filter_subbox m_sub overflow-auto">
                        <ul>
                            <li>전체</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- 용도 --}}
            <div class= "m_filt_sec" id="ftPurpos_m">
                <div class="m_filt_tit">
                    <p>용도</p>
                </div>

                


            </div>

            

            {{-- 최저가 --}}
            <div class= "m_filt_sec">
                <div class="m_filt_tit">
                    <p>최저가</p>
                </div>
                <div class="">
                    <ul>
                        <li class="filt_li">
                            <div class="range_container n_range">
                                <div class="form_control">
                                    <!-- min -->
                                    <div class="form_control_container">
                                        <input class="form_price" type="hidden" name="fromPrice1"
                                        id="fromPrice1_m" value="" readonly="">
                                        <input class="form_price" type="text"
                                        name="fromPrice1_txt" id="fromPrice1_txt_m" value="최소"
                                        readonly="">
                                    </div>
                                    <!-- max -->
                                    <div class="form_control_container">
                                        <input class="form_price" type="hidden" name="toPrice1"
                                        id="toPrice1_m" value="" readonly="">
                                        <input class="form_price" type="text" name="toPrice1_txt"
                                        id="toPrice1_txt_m" value="최대" readonly="">
                                    </div>
                                </div>
                                <div class="sliders_control">
                                    <input id="fromPrice1_slider_m" name="fromPrice1_slider" type="range"
                                    value="0" min="0" max="12" step="1">
                                    <input id="toPrice1_slider_m" name="toPrice1_slider" type="range"
                                    value="12" min="0" max="12" step="1">
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- 감정가 --}}
            <div class= "m_filt_sec">
                <div class="m_filt_tit">
                    <p>감정가</p>
                </div>
                <div class="">
                    <ul>
                        <li class="filt_li">
                            <div class="range_container n_range">
                                <div class="form_control">
                                    <!-- min -->
                                    <div class="form_control_container">
                                        <input class="form_price" type="hidden" name="fromPrice2"
                                            id="fromPrice2_m" value="" readonly="">
                                        <input class="form_price" type="text"
                                            name="fromPrice2_txt_m" id="fromPrice2_txt" value="최소"
                                            readonly="">
                                    </div>
                                    <!-- max -->
                                    <div class="form_control_container">
                                        <input class="form_price" type="hidden" name="toPrice2"
                                            id="toPrice2_m" value="" readonly="">
                                        <input class="form_price" type="text" name="toPrice2_txt"
                                            id="toPrice2_txt_m" value="최대" readonly="">
                                    </div>
                                </div>
                                <div class="sliders_control">
                                    <input id="fromPrice2_slider_m" name="fromPrice2_slider" type="range"
                                        value="0" min="0" max="12" step="1">
                                    <input id="toPrice2_slider_m" name="toPrice2_slider" type="range"
                                        value="12" min="0" max="12" step="1">
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- 물건상태 --}}
            <div class= "m_filt_sec">
                <div class="m_filt_tit">
                    <p>물건상태</p>
                </div>
                <div id="ftStatus_m" class="filt_btns" data-toggle="buttons" >
                    <label class="btn filt_r-btn inter active">
                        <input type="radio" name="status_m" value="0" autocomplete="off" checked="" class="rdoStatus" data-txt="진행중"><span>진행중</span>
                    </label>
                    <label class="btn filt_r-btn inter">
                        <input type="radio" name="status_m" value="1" autocomplete="off" class="rdoStatus" data-txt="변경/연기"><span>변경/연기</span>
                    </label>
                    <label class="btn filt_r-btn inter">
                        <input type="radio" name="status_m" value="2" autocomplete="off" class="rdoStatus" data-txt="낙찰"><span>낙찰</span>
                    </label>
                    <label class="btn filt_r-btn inter">
                        <input type="radio" name="status_m" value="3" autocomplete="off" class="rdoStatus" data-txt="기각/취하/취소"><span>기각/취하</span>
                    </label>
                </div>
            </div>
        </div>
        <li class="filt_li filt_bt_wrap">
            <div class="search_option_button">
                <button type="button" id="resetButton_m" class="btn btn-block btn-thm btn-thm_w">초기화</button>
            </div>
            <div class="search_option_button">
                <button type="button" id="searchButton_m" class="btn btn-block btn-thm btn-thm_w">검색하기</button>
            </div>
        </li>

    </div>
</form>
