// 주소검색창
function openSearchZipcode(){
    new daum.Postcode({
        oncomplete: function(data) {
            // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

            // 각 주소의 노출 규칙에 따라 주소를 조합한다.
            // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
            var addr = ''; // 주소 변수
            var extraAddr = ''; // 참고항목 변수

            //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
            if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                addr = data.roadAddress;
            } else { // 사용자가 지번 주소를 선택했을 경우(J)
                addr = data.jibunAddress;
            }

            // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
            if(data.userSelectedType === 'R'){
                // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                    extraAddr += data.bname;
                }
                // 건물명이 있고, 공동주택일 경우 추가한다.
                if(data.buildingName !== '' && data.apartment === 'Y'){
                    extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                if(extraAddr !== ''){
                    extraAddr = ' (' + extraAddr + ')';
                }
                // 조합된 참고항목을 해당 필드에 넣는다.
                // document.getElementById("sample6_extraAddress").value = extraAddr;
                addr = addr + " " + extraAddr;
            
            } else {
                document.getElementById("address_detail").value = '';
            }

            // 우편번호와 주소 정보를 해당 필드에 넣는다.
            document.getElementById('zip_code').value = data.zonecode;
            document.getElementById("address").value = addr;
            // 커서를 상세주소 필드로 이동한다.
            document.getElementById("address_detail").focus();
        }
    }).open();
}

// 날짜 형식
function dateFormat(date) {
	let dateFormat2 = date.getFullYear() +
		'-' + ( (date.getMonth()+1) <= 9 ? "0" + (date.getMonth()+1) : (date.getMonth()+1) )+
		'-' + ( (date.getDate()) <= 9 ? "0" + (date.getDate()) : (date.getDate()) );
	return dateFormat2;
}

//새창 열기
function openWindow(url,width,height,winName){
	if(winName==undefined) var winName = "";
	var w = window.open(url,winName,"width="+width+",height="+height+",scrollbars=yes");
	w.focus();
}

/**
     * 좌측문자열채우기
     * @params
     *  - str : 원 문자열
     *  - padLen : 최대 채우고자 하는 길이
     *  - padStr : 채우고자하는 문자(char)
     */
function lpad(str, padLen, padStr) {
    if (padStr.length > padLen) {
        console.log("오류 : 채우고자 하는 문자열이 요청 길이보다 큽니다");
        return str;
    }
    str += ""; // 문자로
    padStr += ""; // 문자로
    while (str.length < padLen)
        str = padStr + str;
    str = str.length >= padLen ? str.substring(0, padLen) : str;
    return str;
}

// 스낵바
function sbAlert(msg, type){

    var options = { 
        text:'<img src="/images/snack_chk.png" alt="Icon">', 
        pos: 'bottom-center',
        
    }

    if(type=="warning"){
        options.text = '<img src="/images/warn.png" alt="Icon">';
        options.pos = 'top-center';
    }

    options.actionText = msg;
    
    Snackbar.show(options);
}

// ajax 처리
function doAjax(url, params){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var json = null;
    $.ajax({
        type: 'post',
        async: false,
        url : url,
        data: params,
        dataType: 'json', 
        success: function(jsonData){
            if(jsonData.result==false){
                sbAlert(jsonData.message, 'warning');
            }
            json = jsonData;
        },
        error:function(e){  
            //에러가 났을 경우 실행시킬 코드
            console.log(e);
        }
    });
    return json;
}