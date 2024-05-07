

<script>
                

    function controlFromInput(fromSlider, fromInput, toInput, controlSlider) {
        const [from, to] = getParsed(fromInput, toInput);
        fillSlider(fromInput, toInput, '#D9D9D9', '#385f8d', controlSlider);
        if (from > to) {
            fromSlider.value = to;
            fromInput.value = comma(to);
        } else {
            fromSlider.value = from;
            fromInput.value = comma(from);
        }
    }

    function controlToInput(toSlider, fromInput, toInput, controlSlider) {
        const [from, to] = getParsed(fromInput, toInput);
        fillSlider(fromInput, toInput, '#D9D9D9', '#385f8d', controlSlider);
        setToggleAccessible(toInput, toSlider);
        if (from <= to) {
            toSlider.value = to;
            toInput.value = comma(to);
        } else {
            toInput.value = comma(from);
        }
    }

    function controlFromSlider(fromSlider, toSlider, fromInput) {
        const [from, to] = getParsed(fromSlider, toSlider);
        fillSlider(fromSlider, toSlider, '#D9D9D9', '#385f8d', toSlider);
        var arrRange = arrPriceRange;

        if (from > to) {
            fromSlider.value = to;
            fromInput.value = arrRange[to]['class'];
            $(fromInput).next()[0].value = arrRange[to]['title'];
        } else {
            fromInput.value = arrRange[from]['class'];
            $(fromInput).next()[0].value = arrRange[from]['title'];
        }
    }

    function controlToSlider(fromSlider, toSlider, toInput) {
        const [from, to] = getParsed(fromSlider, toSlider);
        fillSlider(fromSlider, toSlider, '#D9D9D9', '#385f8d', toSlider);
        var arrRange = arrPriceRange;

        setToggleAccessible(toSlider, toSlider);
        if (from <= to) {
            toSlider.value = to;
            toInput.value = arrRange[to]['class'];
            $(toInput).next()[0].value = arrRange[to]['title'];
        } else {
            toInput.value = arrRange[from]['class'];
            $(toInput).next()[0].value = arrRange[from]['title'];
            toSlider.value = from;
        }
    }
    
    function getParsed(currentFrom, currentTo) {
        const from = parseInt(uncomma(currentFrom.value), 10);
        const to = parseInt(uncomma(currentTo.value), 10);
        return [from, to];
    }

    function fillSlider(from, to, sliderColor, rangeColor, controlSlider) {
        const rangeDistance = to.max - to.min;
        const fromPosition = uncomma(from.value) - to.min;
        const toPosition = uncomma(to.value) - to.min;

        controlSlider.style.background = `linear-gradient(
        to right,
        ${sliderColor} 0%,
        ${sliderColor} ${(fromPosition)/(rangeDistance)*100}%,
        ${rangeColor} ${((fromPosition)/(rangeDistance))*100}%,
        ${rangeColor} ${(toPosition)/(rangeDistance)*100}%, 
        ${sliderColor} ${(toPosition)/(rangeDistance)*100}%, 
        ${sliderColor} 100%)`;
    }

    function setToggleAccessible(currentTarget, toSlider) {
        // toSlider = document.querySelector('#toSlider');
        if (Number(uncomma(currentTarget.value)) <= 0) {
            toSlider.style.zIndex = 2;
        } else {
            toSlider.style.zIndex = 0;
        }
    }
    var fromAreaSlider = document.querySelector('#fromPrice2_slider');
    var toAreaSlider = document.querySelector('#toPrice2_slider');
    var fromAreaInput = document.querySelector('#fromPrice2');
    var toAreaInput = document.querySelector('#toPrice2');


    function initInputRange(){
        fromSlider = document.querySelector('#fromPrice1_slider');
        toSlider = document.querySelector('#toPrice1_slider');
        fromInput = document.querySelector('#fromPrice1');
        toInput = document.querySelector('#toPrice1');

        fromAreaSlider = document.querySelector('#fromPrice2_slider');
        toAreaSlider = document.querySelector('#toPrice2_slider');
        fromAreaInput = document.querySelector('#fromPrice2');
        toAreaInput = document.querySelector('#toPrice2');

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

        console.log('initInputRange');
    }

</script>
<script>
    var arrPriceRange = [
                    {'title':'최소', 'class':''},
                    {'title':'5천만', 'class':'5000'},
                    {'title':'1억', 'class':'10000'},
                    {'title':'2억', 'class':'20000'},
                    {'title':'3억', 'class':'30000'},
                    {'title':'5억', 'class':'50000'},
                    {'title':'10억', 'class':'100000'},
                    {'title':'20억', 'class':'200000'},
                    {'title':'30억', 'class':'300000'},
                    {'title':'50억', 'class':'500000'},
                    {'title':'100억', 'class':'1000000'},
                    {'title':'300억', 'class':'3000000'},
                    {'title':'최대', 'class':''}, 
                ];

    // var jsonFilter = {
    //     'addr':{'부산광역시 전체':['부산 전체']},
    //     'purpose':{'전체':[]},
    //     'cost':{},
    //     'status':{}};

    var jsonFilter_base = {
            // 'addr':{'26000':['2600000000'], '26110':['2611010100','대창동1가','중앙동3가']},
            // 'addr':{'부산광역시 전체':['부산 전체'], '중구':['영주동','대창동1가','중앙동3가']},
            // 'addr':[{'26110':'중구','sub':[{'2611010100':'영주동'},{'2611013300':'광복동1가'},{'2611010500':'중앙동2가'}]}],
            'addr':[{'code':'26000','txt':'부산광역시 전체','sub':[{'code':'2600000000','txt':'부산 전체'}], 'selected':1}],
            'purpose':[{'code':'0','txt':'전체','sub':[{'code':'0_0','txt':'전체'}], 'selected':1}],
            'cost':{'cost1':{'from':{'code':'','txt':'최소'}, 'to':{'code':'','txt':'최대'}},'cost2':{'from':{'code':'','txt':'최소'}, 'to':{'code':'','txt':'최대'}}},
            'status':{'code':'0', 'txt':'진행중'}};

    var jsonFilter = jsonFilter_base;
    
    var $btnFilter = $('<button class="btn selected-filter"><span>선택필터</span><i class="ri-close-line"></i></button>');

    $(document).ready(function() {
        let cookieFilterJson = getCookie('filter_json');
        if(cookieFilterJson) jsonFilter = JSON.parse(cookieFilterJson);
        
        console.log('jsonFilter',jsonFilter);

        setGu();
        // $('#ftAddr button:eq(0)').click();
        let pnu = jsonFilter.addr[0].code;
        setDong(pnu);

        setPurpos();
        // $('#ftPurpos button:eq(0)').click();

        initInputRange();

        setFilterFromjsonFilter();

        // console.log(jsonFilter);
    });



    function setFilterAddr1(){
        // 지역 1
        $('#ftAddr div:eq(0) li button').removeClass('sel');
        $('#ftAddr div:eq(0) li button').each(function(index){
            let code = $(this).data('code');
            if(chkCodeJsonArray(jsonFilter.addr, code)){
                $(this).addClass('sel');
            }
        });
    }

    function setFilterAddr2(){
        // 지역 2
        $('#ftAddr div:eq(1) li button').removeClass('sel');
        
        $('#ftAddr div:eq(1) li button').each(function(index){
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
        console.log(jsonFilter.addr);
    }

    function setFilterPurpos1(){
        // 용도 1
        $('#ftPurpos div:eq(0) li button').removeClass('sel');
        $('#ftPurpos div:eq(0) li button').each(function(index){
            let code = $(this).data('code');
            if(chkCodeJsonArray(jsonFilter.purpose, code)){
                $(this).addClass('sel');
            }
        });
    }

    function setFilterPurpos2(){
        // 용도 2
        $('#ftPurpos div:eq(1) li button').removeClass('sel');
        
        $('#ftPurpos div:eq(1) li button').each(function(index){
            let parent_code = $(this).data('parent_code');
            let code = $(this).data('code');
            let found = false;
            for(i=0;i<jsonFilter.purpose.length;i++){
                if(chkCodeJsonArray(jsonFilter.purpose[i].sub, code) && jsonFilter.purpose[i].code == parent_code){
                    $(this).addClass('sel');
                }
            }
        });
    }

    function setFilterCost(){
        console.log('setFilterCost',jsonFilter.cost);
        let from_idx = 0;
        let to_idx = 12;

        if(jsonFilter.cost.cost1.from.code!='') from_idx = arrPriceRange.findIndex(item => item.class == jsonFilter.cost.cost1.from.code);
        if(jsonFilter.cost.cost1.to.code!='') to_idx = arrPriceRange.findIndex(item => item.class == jsonFilter.cost.cost1.to.code);

        $('#fromPrice1_slider').val(from_idx);
        $('#toPrice1_slider').val(to_idx);
        
        from_idx = 0;
        to_idx = 12;

        if(jsonFilter.cost.cost2.from.code!='') from_idx = arrPriceRange.findIndex(item => item.class == jsonFilter.cost.cost2.from.code);
        if(jsonFilter.cost.cost2.to.code!='') to_idx = arrPriceRange.findIndex(item => item.class == jsonFilter.cost.cost2.to.code);

        $('#fromPrice2_slider').val(from_idx);
        $('#toPrice2_slider').val(to_idx);
        
        controlFromSlider(fromSlider, toSlider, fromInput);
        controlToSlider(fromSlider, toSlider, toInput);
        controlFromSlider(fromAreaSlider, toAreaSlider, fromAreaInput);
        controlToSlider(fromAreaSlider, toAreaSlider, toAreaInput);
        // initInputRange();
    }

    function setFilterStatus(){
        $('#ftStatus li button').removeClass('sel');
        $('#ftStatus li button').each(function(index){
            if($(this).data('code') == jsonFilter.status.code) $(this).addClass('sel');
        });
    }

    function setFilterButtonAddr(){
        for(i=0;i<jsonFilter.addr.length;i++){
            if(chkCodeJsonArray(jsonFilter.addr[i].sub, code)){
                $(this).addClass('sel');
            }
        }
    }

    function setFilterFromjsonFilter(){
        setFilterAddr1();
        setFilterAddr2();
        setFilterPurpos1();
        setFilterPurpos2();

        setFilterCost();
        setFilterStatus();

        printFilterButton();
    }

    function chkCodeJsonArray(json, code){
        var found = false; // 찾는 키가 있는지를 나타내는 플래그

        // 배열을 순회
        for (var i = 0; i < json.length; i++) {
            if(json[i].code == code){
                found = true;
                break;
            }
        }

        return found;
    }

    function setPurpos(){
        var r = doAjax('{{ route('common.ajax.getAuctionCategory') }}');
        if (r.result) jsonPurpos = r.data;
        console.log(jsonPurpos);

        $ul = $("<ul></ul>");

        $ul.append('<li><button type="button" class="btn" data-code="0">전체</button></li>');
        jsonPurpos.forEach(function(purpose){
            $ul.append('<li><button type="button" class="btn" data-code="'+purpose.id+'">' +
                purpose.title + '</button></li>');
        });

        $('#ftPurpos div').eq(0).html($ul);
    }

    function getListAddr(pnu) {
        var data;
        $.ajax({
            type: 'post',
            url: "{{ env('AUCTION_API_URL') . __('/api/listLocation/') }}" + pnu,
            async: false,
            dataType: 'json',
            success: function(r) {
                //작업이 성공적으로 발생했을 경우
                data = r;
            },
            error: function(e) {
                //에러가 났을 경우 실행시킬 코드
                console.log(e);
            }
        });

        return data;
    }

    function setGu() {
        var data = getListAddr('26');
        $ul = $("<ul></ul>");

        data.forEach(function(item) {
            // console.log(item);
            if (item.sgg_cd == "000")
                $ul.append('<li><button type="button" class="btn" data-code="' + item.sido_cd + item.sgg_cd +
                    '">' + item.locallow_nm + ' 전체</button></li>');
            else
                $ul.append('<li><button type="button" class="btn" data-code="' + item.sido_cd + item.sgg_cd + '">' +
                    item.locallow_nm + '</button></li>');
        });

        $('#ftAddr div').eq(0).html($ul);
    }

    function setDong(pnu) {
        var data = getListAddr(pnu);
        $ul = $("<ul></ul>");

        data.forEach(function(item) {
            // console.log(item);
            if (item.umd_cd == "000")
                $ul.append('<li><button type="button" class="btn" data-code="' + item.locatjumin_cd + '">' + item.locallow_nm.replace("광역시","") + ' 전체</button></li>');
            else
                $ul.append('<li><button type="button" class="btn" data-code="' + item.locatjumin_cd + '">' + item.locallow_nm + '</button></li>');
        });
        $('#ftAddr div').eq(1).html($ul);
    }

    function changeJsonFilterAddr(obj, isRemove){
        let $obj = $(obj);
        let $parentDiv = $obj.closest('div');
        let level = $('#ftAddr div').index($parentDiv) + 1; // 1: 구군, 2: 동리
        let idx = $('li button', $parentDiv).index($(obj)); // 선택한 버튼의 index
        let code = $obj.data('code').toString();
        let txt = $obj.html();

        if(isRemove){  // 삭제
            if(level == 1){  // 구군
                //jsonFilter.addr = jsonFilter.addr.filter(item => item.code != code);
                jsonFilter.addr.forEach(function(item) {
                    item.selected = 0;
                });
                jsonFilter.addr.filter(item => item.code==code)[0].selected=1;
            }else{           // 동리
                // jsonFilter.addr.filter(item => item.selected==1).sub.filter(subitem => subitem.)
                let selAddr = jsonFilter.addr.filter(item => item.selected==1)[0];
                selAddr.sub = selAddr.sub.filter(item => item.code != code);

                if(selAddr.sub.length==0){
                    let subFirstItemCode = $('button:first', $parentDiv).data('code');
                    let subFirstItemTxt = $('button:first', $parentDiv).html();
                    selAddr.sub.push({'code':subFirstItemCode, 'txt':subFirstItemTxt});

                    jsonFilter.addr = jsonFilter.addr.filter(item => item.selected!=1);
                    console.log(jsonFilter.addr.length);
                    if(jsonFilter.addr.length > 0) jsonFilter.addr[0].selected=1;
                }   
            }


            if(jsonFilter.addr.length==0){
                jsonFilter.addr.push({'code':'26000', 'txt':'부산광역시 전체', sub:[{'code':'2600000000','txt':'부산 전체'}], 'selected':1});
            }

        }else{          // 추가
            if(level == 1){  // 구군
                // selected 초기화
                jsonFilter.addr.forEach(function(item) {item.selected = 0;});

                if(idx > 0){
                    jsonFilter.addr = jsonFilter.addr.filter(item => item.code != '26000');
                }else{
                    jsonFilter.addr = [];
                }

                let sub_code = $parentDiv.next().find('button:first').data('code').toString();
                let sub_txt = $parentDiv.next().find('button:first').html();
                let addItem = {'code':code,'txt':txt, sub:[{'code':sub_code,'txt':sub_txt}], 'selected':1};
                jsonFilter.addr.push(addItem);
            }else{          // 동리
                // 구군의 selected item이 선택한 동리의 구군 item과 다를때
                let upLevelCode = code.toString().substr(0,5);
                let upLevelTxt = '';
                if(jsonFilter.addr.filter(item => item.selected==1)[0].code.toString() != upLevelCode){
                    
                    $parentDiv.prev().find('button').each(function(idx){
                        console.log($(this).data('code').toString()==upLevelCode, $(this).data('code').toString(), upLevelCode);
                        if($(this).data('code').toString()==upLevelCode){
                            upLevelTxt = $(this).html();
                        }
                    });

                    let upLevelItem = {'code':upLevelCode, 'txt':upLevelTxt, sub:[], 'selected':1}
                    jsonFilter.addr.forEach(function(item) {
                        item.selected = 0;
                    });
                    jsonFilter.addr.push(upLevelItem);
                    jsonFilter.addr = jsonFilter.addr.filter(item => item.code != '26000');
                }

                if(idx > 0){
                    let subFirstItemCode = $('button:first', $parentDiv).data('code');
                    jsonFilter.addr.filter(item => item.selected==1)[0].sub = jsonFilter.addr.filter(item => item.selected==1)[0].sub.filter(subitem => subitem.code != subFirstItemCode);
                }else{
                    jsonFilter.addr.filter(item => item.selected==1)[0].sub = [];
                }

                let addItem = {'code':code,'txt':txt};
                jsonFilter.addr.filter(item => item.selected==1)[0].sub.push(addItem);
            }
        }

        printFilterButton();
    }

    function changeJsonFilterPurpos(obj){
        let $obj = $(obj);
        let $parentDiv = $obj.closest('div');
        let level = $('#ftPurpos div').index($parentDiv) + 1; // 1: 구군, 2: 동리
        let idx = $('li button', $parentDiv).index($(obj)); // 선택한 버튼의 index
        let code = $obj.data('code').toString();
        let txt = $obj.html();

        


        if(level == 1){  // 1차
            // selected 초기화
            jsonFilter.purpose.forEach(function(item) {item.selected = 0;});

            // 이미 있으면 selected = 1, 없으면 생성
            if(jsonFilter.purpose.filter(item => item.code==code).length > 0){
                jsonFilter.purpose.filter(item => item.code==code).selected = 1;
            }else{
                if(idx > 0){
                    let isFullChk = jsonPurpos.length - jsonFilter.purpose.length;
                    if(isFullChk >= 2){

                        let sub_code = 0;
                        let sub_txt = txt.replace("건물","") + " 전체";
                        let addItem = {'code':code,'txt':txt, sub:[{'code':code+'_'+sub_code,'txt':sub_txt}], 'selected':1};
                        jsonFilter.purpose.push(addItem);

                        jsonFilter.purpose = jsonFilter.purpose.filter(item => item.code!=0);   // 전체 노드 삭제
                    }else{
                        $ul = $("<ul></ul>");
                        $ul.append('<li><button type="button" class="btn" data-code="0_0" data-parent_code="0">전체</button></li>');
                        $('#ftPurpos div').eq(1).html($ul);

                        jsonFilter.purpose = [{'code':'0','txt':'전체','sub':[{'code':'0_0','txt':'전체'}], 'selected':1}];
                    }
                }else{
                    $ul = $("<ul></ul>");
                    $ul.append('<li><button type="button" class="btn" data-code="0_0" data-parent_code="0">전체</button></li>');
                    $('#ftPurpos div').eq(1).html($ul);

                    jsonFilter.purpose = [{'code':'0','txt':'전체','sub':[{'code':'0_0','txt':'전체'}], 'selected':1}];
                }
            }
        }else{          // 2차
            // // 구군의 selected item이 선택한 동리의 구군 item과 다를때
            // let upLevelCode = code.toString().substr(0,5);
            // let upLevelTxt = '';
            // if(jsonFilter.purpose.filter(item => item.selected==1)[0].code.toString() != upLevelCode){
                
            //     $parentDiv.prev().find('button').each(function(idx){
            //         console.log($(this).data('code').toString()==upLevelCode, $(this).data('code').toString(), upLevelCode);
            //         if($(this).data('code').toString()==upLevelCode){
            //             upLevelTxt = $(this).html();
            //         }
            //     });

            //     let upLevelItem = {'code':upLevelCode, 'txt':upLevelTxt, sub:[], 'selected':1}
            //     jsonFilter.purpose.forEach(function(item) {
            //         item.selected = 0;
            //     });
            //     jsonFilter.purpose.push(upLevelItem);
            //     jsonFilter.purpose = jsonFilter.purpose.filter(item => item.code != '26000');
            // }

            // if(idx > 0){
            //     let subFirstItemCode = $('button:first', $parentDiv).data('code');
            //     jsonFilter.purpose.filter(item => item.selected==1)[0].sub = jsonFilter.purpose.filter(item => item.selected==1)[0].sub.filter(subitem => subitem.code != subFirstItemCode);
            // }else{
            //     jsonFilter.purpose.filter(item => item.selected==1)[0].sub = [];
            // }

            // let addItem = {'code':code,'txt':txt};
            // jsonFilter.purpose.filter(item => item.selected==1)[0].sub.push(addItem);

            let parent_code = $obj.data('parent_code').toString();

            let isExist = jsonFilter.purpose.filter(item => item.code == parent_code).length > 0 ? jsonFilter.purpose.filter(item => item.code == parent_code)[0].sub.filter(item => item.code == code).length:false;
            // 이미 있으면 삭제, 없으면 생성
            if(isExist){    // 삭제
                if(code != "0_0"){
                    for (let i = 0; i < jsonFilter.purpose.length; i++) {
                        const item = jsonFilter.purpose[i];
                        console.log('item.sub',item.sub);
                        if(item.sub) {
                            const indexToRemove = item.sub.findIndex(subItem => subItem.code == code);
                            console.log('indexToRemove',indexToRemove, code);
                            if(indexToRemove !== -1) {
                                item.sub.splice(indexToRemove, 1);
                                // item.sub 배열에서 요소를 삭제한 후, 배열 길이가 0인지 확인
                                if(item.sub.length === 0) {
                                    // 상위 요소도 jsonData 배열에서 삭제
                                    jsonFilter.purpose.splice(i, 1);
                                    // 인덱스 조정
                                    i--;
                                }
                            }
                        }
                    }
                }
            }else{          // 생성
                // 부모노드가 있는지 체크 없으면 추가
                if(jsonFilter.purpose.filter(item => item.code == parent_code).length == 0){
                    let parent_txt = jsonPurpos.filter(item => item.id == parent_code)[0].title;
                    jsonFilter.purpose.push({'code':parent_code,'txt':parent_txt,'sub':[], 'selected':1});

                    jsonFilter.purpose = jsonFilter.purpose.filter(item => item.code!=0);   // 전체 노드 삭제
                }

                if(idx == 0){   // 전체버튼 
                    let parent_txt = jsonPurpos.filter(item => item.id == parent_code)[0].title.replace('건물','')+' 전체';
                    jsonFilter.purpose.filter(item => item.code == parent_code)[0].sub = [{'code':parent_code+'_0','txt':parent_txt}];
                }else{      
                    let subItem = {'code':code,'txt':txt};
                    let isFullChk = jsonPurpos.filter(item => item.id == parent_code)[0].children.length - jsonFilter.purpose.filter(item => item.code == parent_code)[0].sub.length;
                    if(isFullChk >= 2){
                        jsonFilter.purpose.filter(item => item.code == parent_code)[0].sub = jsonFilter.purpose.filter(item => item.code == parent_code)[0].sub.filter(item => item.code != parent_code+'_0');   // 전체노드삭제
                        jsonFilter.purpose.filter(item => item.code == parent_code)[0].sub.push(subItem);
                    }else{
                        let parent_txt = jsonPurpos.filter(item => item.id == parent_code)[0].title.replace('건물','')+' 전체';
                        jsonFilter.purpose.filter(item => item.code == parent_code)[0].sub = [{'code':parent_code+'_0','txt':parent_txt}];
                    }
                    
                }
            }
        }

        if(jsonFilter.purpose.length==0) jsonFilter.purpose = [{'code':'0','txt':'전체','sub':[{'code':'0_0','txt':'전체'}], 'selected':1}];

        printFilterButton();
        console.log(jsonFilter.purpose);
    }

    function printFilterButton(){
        // 지역
        $('#filter-addr').html('');
        jsonFilter.addr.forEach(function(item){
            item.sub.forEach(function(subItem){
                $btn = $btnFilter.clone();

                if(subItem.code=="2600000000") return false;

                $btn.attr('data-code',subItem.code);
                if(subItem.txt.includes('전체'))
                    $btn.find('span').html(subItem.txt);
                else
                    $btn.find('span').html(item.txt + '-' + subItem.txt);

                $('#filter-addr').append($btn);
            });
        });

        // 용도
        $('#filter-purpose').html('');
        jsonFilter.purpose.forEach(function(item){
            item.sub.forEach(function(subItem){
                $btn = $btnFilter.clone();

                if(subItem.code=="0_0") return false;

                $btn.attr('data-code',subItem.code);
                if(subItem.txt.includes('전체'))
                    $btn.find('span').html(subItem.txt);
                else
                    $btn.find('span').html(item.txt + '-' + subItem.txt);

                $('#filter-purpose').append($btn);
            });
        });

        // 최저가, 감정가
        $('#filter-cost').html('');
        let btnTxt = '';
        if(jsonFilter.cost.cost1.from.code != '' || jsonFilter.cost.cost1.to.code != ''){
            btnTxt += '최저가 ' + jsonFilter.cost.cost1.from.txt + '~' + jsonFilter.cost.cost1.to.txt;
            $btn = $btnFilter.clone();
            $btn.attr('data-code','cost1');
            $btn.find('span').html(btnTxt);
            $('#filter-cost').append($btn);
        }
        btnTxt = '';
        if(jsonFilter.cost.cost2.from.code != '' || jsonFilter.cost.cost2.to.code != ''){
            btnTxt += '감정가 ' + jsonFilter.cost.cost2.from.txt + '~' + jsonFilter.cost.cost2.to.txt;
            $btn = $btnFilter.clone();
            $btn.attr('data-code','cost2');
            $btn.find('span').html(btnTxt);
            $('#filter-cost').append($btn);
        }

        // 물건상태
        $('#filter-status').html('');
        if(jsonFilter.status.code!=0){
            $btn = $btnFilter.clone();
            $btn.attr('data-code',jsonFilter.status.code);
            $btn.find('span').html('상태-' + jsonFilter.status.txt);

            $('#filter-status').append($btn);
        }
    }

    // 필터 버튼 클릭
    $(document).on('click', '.selected-filter', function(){
        let code = $(this).data('code').toString();
        
        // 지역
        for (let i = 0; i < jsonFilter.addr.length; i++) {
            const item = jsonFilter.addr[i];
            console.log(item.sub);
            if(item.sub) {
                const indexToRemove = item.sub.findIndex(subItem => subItem.code === code);
                if(indexToRemove !== -1) {
                item.sub.splice(indexToRemove, 1);
                // item.sub 배열에서 요소를 삭제한 후, 배열 길이가 0인지 확인
                if(item.sub.length === 0) {
                    // 상위 요소도 jsonData 배열에서 삭제
                    jsonFilter.addr.splice(i, 1);
                    // 인덱스 조정
                    i--;
                }
                }
            }
        }
        if(jsonFilter.addr.length==0){
            jsonFilter.addr.push({'code':'26000', 'txt':'부산광역시 전체', sub:[{'code':'2600000000','txt':'부산 전체'}], 'selected':1});
        }

        // 용도
        for (let i = 0; i < jsonFilter.purpose.length; i++) {
            const item = jsonFilter.purpose[i];
            console.log(item.sub);
            if(item.sub) {
                const indexToRemove = item.sub.findIndex(subItem => subItem.code === code);
                if(indexToRemove !== -1) {
                item.sub.splice(indexToRemove, 1);
                // item.sub 배열에서 요소를 삭제한 후, 배열 길이가 0인지 확인
                if(item.sub.length === 0) {
                    // 상위 요소도 jsonData 배열에서 삭제
                    jsonFilter.purpose.splice(i, 1);
                    // 인덱스 조정
                    i--;
                }
                }
            }
        }
        if(jsonFilter.purpose.length==0){
            jsonFilter.purpose.push({'code':'0','txt':'전체','sub':[{'code':'0_0','txt':'전체'}], 'selected':1});
        }

        // 감정가, 최저가
        if(code == 'cost1'){
            jsonFilter.cost.cost1.from.code = '';
            jsonFilter.cost.cost1.to.code = '';
            jsonFilter.cost.cost1.from.txt = '최소';
            jsonFilter.cost.cost1.to.txt = '최대';
        }
        if(code == 'cost2'){
            jsonFilter.cost.cost2.from.code = '';
            jsonFilter.cost.cost2.to.code = '';
            jsonFilter.cost.cost2.from.txt = '최소';
            jsonFilter.cost.cost2.to.txt = '최대';
        }

        // 물건상태
        jsonFilter.status.code= '0';jsonFilter.status.txt= '진행중';

        setFilterFromjsonFilter();

        return false;
    });
    
    // 구 선택
    $(document).on('click', '#ftAddr div:eq(0) li button', function() {

        var pnu = $(this).data('code');

        setDong(pnu);

        let btnCount = $(this).closest('div').find('button').length;
        let btnSelCount = $(this).closest('div').find('button.sel').length;
        if(btnCount - btnSelCount == 2 && !$(this).hasClass('sel')){
            setDong($(this).closest('div').find('button:first').data('code'));
            changeJsonFilterAddr($(this).closest('div').find('button:first'), $(this).hasClass('sel'));
        }
        else                                                        changeJsonFilterAddr(this, $(this).hasClass('sel'));

        setFilterAddr1();
        setFilterAddr2();
        
        console.log(jsonFilter.addr);
    });

    // 동 선택
    $(document).on('click', '#ftAddr div:eq(1) li button', function() {
        
        let btnCount = $(this).closest('div').find('button').length;
        let btnSelCount = $(this).closest('div').find('button.sel').length;
        if(btnCount - btnSelCount == 2 && !$(this).hasClass('sel')) changeJsonFilterAddr($(this).closest('div').find('button:first'), $(this).hasClass('sel'));
        else                                                        changeJsonFilterAddr(this, $(this).hasClass('sel'));

        setFilterAddr1();
        setFilterAddr2();

        // selFilter($(this));
    });

    // 용도 1차분류 선택
    $(document).on('click', '#ftPurpos div:eq(0) li button', function() {
        var idx = ($("button", $(this).closest('ul')).index(this));
 
        if(idx>0){
            var data = jsonPurpos[idx-1].children;
            $ul = $("<ul></ul>");
            $ul.append('<li><button type="button" class="btn" data-code="'+data[0].parent_id+'_0" data-parent_code="'+data[0].parent_id+'">' + $(this).html().replace("건물","") + ' 전체</button></li>');

            data.forEach(function(item) {

                $ul.append('<li><button type="button" class="btn" data-code="'+item.parent_id+'_'+item.id+'" data-parent_code="'+item.parent_id+'">' + item.title + '</button></li>');
            });
            $('#ftPurpos div').eq(1).html($ul);
        }else{
            $ul = $("<ul></ul>");
            $ul.append('<li><button type="button" class="btn" data-code="0_0" data-parent_code="0">전체</button></li>');
            $('#ftPurpos div').eq(1).html($ul);
        }

        changeJsonFilterPurpos(this);

        setFilterPurpos1();
        setFilterPurpos2();
    });

    // 용도 2차분류 선택
    $(document).on('click', '#ftPurpos div:eq(1) li button', function() {

        changeJsonFilterPurpos(this, $(this).hasClass('sel'));

        setFilterPurpos1();
        setFilterPurpos2();
    });

    // 최저가 최소
    $(document).on('change', '#fromPrice1_slider', function(){
        let code = arrPriceRange[this.value].class;
        let txt = arrPriceRange[this.value].title;

        jsonFilter.cost.cost1.from.code = code;
        jsonFilter.cost.cost1.from.txt = txt;

        setFilterCost();
        printFilterButton();
    });
    // 최저가 최대
    $(document).on('change', '#toPrice1_slider', function(){
        let code = arrPriceRange[this.value].class;
        let txt = arrPriceRange[this.value].title;

        jsonFilter.cost.cost1.to.code = code;
        jsonFilter.cost.cost1.to.txt = txt;

        setFilterCost();
        printFilterButton();
        
    });
    // 감정가 최소
    $(document).on('change', '#fromPrice2_slider', function(){
        let code = arrPriceRange[this.value].class;
        let txt = arrPriceRange[this.value].title;

        jsonFilter.cost.cost2.from.code = code;
        jsonFilter.cost.cost2.from.txt = txt;

        setFilterCost();
        printFilterButton();
    });
    // 감정가 최대
    $(document).on('change', '#toPrice2_slider', function(){
        let code = arrPriceRange[this.value].class;
        let txt = arrPriceRange[this.value].title;

        jsonFilter.cost.cost2.to.code = code;
        jsonFilter.cost.cost2.to.txt = txt;

        setFilterCost();
        printFilterButton();
    });

    // 물건상태 선택
    $(document).on('click', '#ftStatus li button', function() {
        let code = $(this).data('code');
        let txt = $(this).html();
        jsonFilter.status.code = code;
        jsonFilter.status.txt = txt;

        setFilterStatus();
        printFilterButton();
    });


    $(document).on('click', '#searchButton', function(){
        console.log('검색버튼', jsonFilter);
        var jsonString = JSON.stringify(jsonFilter);
        setCookie('filter_json', jsonString, 7);
        frm.submit();
    });

    $(document).on('click', '#resetButton', function(){
        
        var jsonString = JSON.stringify(jsonFilter_base);
        setCookie('filter_json', jsonString, 7);
        frm.submit();
        
    });
</script>



{{-- new filter --}}

<form name="frm" action="">
<div class="col-md-12 pl0 pr0">
    
    
    <div class="n_filter_w">
        {{-- 지역 --}}
        <div class= "n_filter_area">
            <div class="n_filter_t">
                <img src="/images/auction/location.png" alt="">
                <p>지역</p>
            </div>
            <div class="n_filter_sub" id="ftAddr">
                <div class="n_filter_subbox overflow-auto">
                    <ul>
                        <li>부산 전체</li>
                        <li>중구</li>
                        <li>서구</li>
                        <li>동구</li>
                    </ul>
                </div>
                <div class="n_filter_subbox overflow-auto">
                    <ul>
                        <li>전체</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- 용도 --}}
        <div class= "n_filter_use">
            <div class="n_filter_t">
                <img src="/images/auction/use.png" alt="">
                <p>용도</p>
            </div>
            <div class="n_filter_sub" id="ftPurpos">
                <div class="n_filter_subbox overflow-auto">
                    <ul>
                        <li>전체</li>
                        <li>주거용 건물</li>
                        <li>상업용 건물</li>
                        <li>토지</li>
                    </ul>
                </div>
                <div class="n_filter_subbox overflow-auto">
                    <ul>
                        <li><button type="button" class="btn" data-code="0_0" data-parent_code="0">전체</button></li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- 감정가/최저가 --}}
        <div class= "n_filter_price">
            <div class="n_filter_t">
                <img src="/images/auction/price.png" alt="">
                <p>감정가/최저가</p>
            </div>
            <div class="n_filter_subbox">


                <ul>
                    <li class="filt_li">
                        <label for="">최저가</label>
                        <div class="range_container n_range">
                            <div class="form_control">
                                <!-- min -->
                                <div class="form_control_container">
                                    <input class="form_price" type="hidden" name="fromPrice1"
                                        id="fromPrice1" value="" readonly="">
                                    <input class="form_price" type="text"
                                        name="fromPrice1_txt" id="fromPrice1_txt" value="최소"
                                        readonly="">
                                </div>
                                <!-- max -->
                                <div class="form_control_container">
                                    <input class="form_price" type="hidden" name="toPrice1"
                                        id="toPrice1" value="" readonly="">
                                    <input class="form_price" type="text" name="toPrice1_txt"
                                        id="toPrice1_txt" value="최대" readonly="">
                                </div>
                            </div>
                            <div class="sliders_control">
                                <input id="fromPrice1_slider" name="fromPrice1_slider" type="range"
                                    value="0" min="0" max="12" step="1">
                                <input id="toPrice1_slider" name="toPrice1_slider" type="range"
                                    value="12" min="0" max="12" step="1">
                            </div>
                        </div>
                    </li>
                </ul>


                <ul>
                    <li class="filt_li">
                        <label for="">감정가</label>
                        <div class="range_container n_range">
                            <div class="form_control">
                                <!-- min -->
                                <div class="form_control_container">
                                    <input class="form_price" type="hidden" name="fromPrice2"
                                        id="fromPrice2" value="" readonly="">
                                    <input class="form_price" type="text"
                                        name="fromPrice2_txt" id="fromPrice2_txt" value="최소"
                                        readonly="">
                                </div>
                                <!-- max -->
                                <div class="form_control_container">
                                    <input class="form_price" type="hidden" name="toPrice2"
                                        id="toPrice2" value="" readonly="">
                                    <input class="form_price" type="text" name="toPrice2_txt"
                                        id="toPrice2_txt" value="최대" readonly="">
                                </div>
                            </div>
                            <div class="sliders_control">
                                <input id="fromPrice2_slider" name="fromPrice2_slider" type="range"
                                    value="0" min="0" max="12" step="1">
                                <input id="toPrice2_slider" name="toPrice2_slider" type="range"
                                    value="12" min="0" max="12" step="1">
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            
        </div>

        {{-- 물건상태 --}}
        <div class= "n_filter_status">
            <div class="n_filter_t">
                <img src="/images/auction/status.png" alt="">
                <p>물건상태</p>
            </div>
            <div class="n_filter_subbox" id="ftStatus">
                <ul>
                    <li><button type="button" class="btn sel" data-code="0">진행중</button></li>
                    <li><button type="button" class="btn" data-code="1">변경/연기</button></li>
                    <li><button type="button" class="btn" data-code="2">낙찰</button></li>
                    <li><button type="button" class="btn" data-code="3">기각/취하/취소</button></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="n_filter_b">
        <div class="btn_wrap">
            <div id="filter-addr">
                
            </div>
            <div id="filter-purpose">
                
            </div>
            <div id="filter-cost">
                
            </div>
            <div id="filter-status">
                
            </div>
        </div>
        <li class="filt_li filt_bt_wrap n_filt_bt_wrap"> 
            <div class="search_option_button">
                <button type="button" id="resetButton" class="btn btn-block btn-thm btn-thm_w">초기화</button>
            </div>
            <div class="search_option_button">
                <button type="button" id="searchButton" class="btn btn-block btn-thm btn-thm_w">검색하기</button>
            </div>
        </li>
    </div>
</div>
</form>