/* https://jscompress.com/ */
var console = window.console || { log: function() {} };
var browser = (function() {
	var userAgent = navigator.userAgent, s = userAgent.toLowerCase();
	var match = /(webkit)[ \/](\w.]+)/.exec(s) || 		  /(opera)(?:.*version)?[ \/](\w.]+)/.exec(s) || 		  /(msie) ([\w.]+)/.exec(s) ||                		  /(mozilla)(?:.*? rv:([\w.]+))?/.exec(s) ||		 [];
	function matchMediaQuery(query) {		return "matchMedia" in window ? matchMedia(query).matches : false; 	}
	opera = window.opera && window.opera.buildNumber;	android = /Android/.test(userAgent);	webkit = /WebKit/.test(userAgent);
	ie = !webkit && !opera && (/MSIE/gi).test(userAgent) && (/Explorer/gi).test(navigator.appName);
	ie = ie && /MSIE (\w+)\./.exec(userAgent)[1];
	ie11 = userAgent.indexOf('Trident/') != -1 && (userAgent.indexOf('rv:') != -1 || navigator.appName.indexOf('Netscape') != -1) ? 11 : false;
	ie12 = (userAgent.indexOf('Edge/') != -1 && !ie && !ie11) ? 12 : false;
	ie = ie || ie11 || ie12;
	gecko = !webkit && !ie11 && /Gecko/.test(userAgent);
	mac = userAgent.indexOf('Mac') != -1;
	iDevice = /(iPad|iPhone)/.test(userAgent);
	fileApi = "FormData" in window && "FileReader" in window && "URL" in window && !!URL.createObjectURL;
	phone = matchMediaQuery("only screen and (max-device-width: 480px)") && (android || iDevice);
	tablet = matchMediaQuery("only screen and (min-width: 800px)") && (android || iDevice);
	windowsPhone = userAgent.indexOf('Windows Phone') != -1;
	if (ie12) {		webkit = false;	}

	return { name: match[1] || "", version: match[2] || "0" ,
		opera: opera,	webkit: webkit,		ie: ie,		gecko: gecko,		mac: mac,		iOS: iDevice,		android: android ,
		documentMode: ie && !ie12 ? (document.documentMode || 7) : 10, fileApi: fileApi, desktop: !phone && !tablet,	windowsPhone: windowsPhone
	};
}());

Object.create = function (o) {    function F() {}    F.prototype = o;    return new F(); }

function isMobile(){
	var mobileKeyWords = new Array('Android', 'iPhone', 'iPod', 'BlackBerry', 'Windows CE', 'SAMSUNG', 'LG', 'MOT', 'SonyEricsson');
	for (var info in mobileKeyWords) {
		if (navigator.userAgent.match(mobileKeyWords[info]) != null) {
			return true;
		}
	}
	return false;
}
var latestFocus = null;var fcsChk = true;
function callLatestFocus(){	latestFocus =(event.srcElement.tagName=="A" || event.srcElement.tagName=="BUTTON" )? $(event.srcElement) : $($(event.srcElement).parents("a,button").get(0)) ;  }

var _userAgent_ = navigator.userAgent;var isIe6 = (/msie 6/i).test(_userAgent_);var isIe7 = (/msie 7/i).test(_userAgent_);var isIe9 = (/msie 9/i).test(_userAgent_); var isComptMode = (/compatible/i).test(_userAgent_);

var docChkTimer = null;var DOC_COMPLET = null;
function docLoading(loadFunc){
	clearTimeout(docChkTimer);
	if(document.readyState=="loaded" || document.readyState=="complete"){
		DOC_COMPLET = true;
		if(loadFunc!=undefined) loadFunc();
	}
	else{
		docChkTimer = setTimeout(function(){docLoading(loadFunc);},500);
	}
}

////낮은 브라우저 사이즈 계산오류 보정
function lowReloadCheck(func,load_obj){
	clearTimeout(load_obj.Timer);
	if(!_isLowBr_) return  true;
	try{
		if(_isLowBr_ && load_obj.cnt < load_obj.limit){
			if($("body").width() > wsize.win.w){
				load_obj.cnt++;
				load_obj.Timer = setTimeout(func,250);

				return false;
			}else{
				load_obj.cnt = 0;
				return true;
			}
		}
		if(load_obj.cnt== load_obj.limit) {
			load_obj.cnt = 0;
		}
		return true;
	}catch(e){
	}

	return true;

}


 function number_format(data)
{

	var tmp = '';
	var number = '';
	var cutlen = 3;
	var comma = ',';
	var i;
   if(parseInt(data)==0) return 0;
	data = String(data);
	len = data.length;
	mod = (len % cutlen);
	k = cutlen - mod;
	for (i=0; i<data.length; i++)
	{
		number = number + data.charAt(i);

		if (i < data.length - 1)
		{
			k++;
			if ((k % cutlen) == 0)
			{
				number = number + comma;
				k = 0;
			}
		}
	}

	return number;
}

function sprintf2(zero,text){
	len = zero.length;
	r_txt = zero + text;
	f_len = r_txt.length;
	s_len = f_len - len;
	r_txt = r_txt.slice(s_len,f_len);
	return r_txt;
}


function getImgReSize(w,imgSize){
	var rSize = {"w":imgSize.w,"h":imgSize.h};

	if(imgSize.w>w){
		rSize.w = w;
		rSize.h = Math.ceil(imgSize.h * (rSize.w /imgSize.w));

	}

	return rSize;
}

//쿠키////////////////////////////////////////////////
function getCookie( name )
{
	var nameOfCookie = name + "=";
	var x = 0;
	while ( x <= document.cookie.length )
	{
		var y = (x+nameOfCookie.length);
		if ( document.cookie.substring( x, y ) == nameOfCookie ) {
			if ( (endOfCookie=document.cookie.indexOf( ";", y )) == -1 )
				endOfCookie = document.cookie.length;
			return unescape( document.cookie.substring( y, endOfCookie ) );
		}
		x = document.cookie.indexOf( " ", x ) + 1;
		if ( x == 0 )
			break;
	}
	return "";
}

function setCookie( name, value, expiredays ){
	var todayDate = new Date();
	todayDate.setDate( todayDate.getDate() + expiredays );
	document.cookie = name + "=" + escape( value ) + "; path=/; expires=" +		todayDate.toGMTString() + ";"
}

///////////////////////////////////////////////////////////

//레이어팝업
function popHide(pop_id){
	if (document.getElementById("chk"+pop_id).checked==true)
	{
		setCookie( pop_id, "done" , 24);
	}
	document.getElementById(pop_id).style.display = "none";
}
function popClose(pop_id){
	if (document.getElementById("chk"+pop_id).checked==true)
	{
		setCookie( pop_id, "done" , 1);
	}
	this.close();
}

function checkPop(pop_id) {
	if ( getCookie(pop_id) != "done" ) {
		document.getElementById(pop_id).style.display = "";
	}else{
		document.getElementById(pop_id).style.display = "none";
	}
}

function setLayerPopup(popId,options){
	var pop = $("#"+popId);
	var pop_cont = $(".popup_layer_body",pop);

	pop.siteLayerPopup(options);
	/*

	pop_cont.css({"width":options.width,"height":options.height});
	console.log(options);
	//options.scroll = 1;
	
	console.log(wsize.win.w );
	if(options.scroll){
		pop_cont.css({"overflow":"scroll"});
	}else{
		pop_cont.css({"overflow":"hidden"});
		$("img",pop_cont).css({"max-width":"100%"});
	}
	*/
	//$(window).resize()
}
$(window).resize(function(){})

function goUrlClose(url){
	try{
	if(window.opener){
		opener.document.location=url;
	}else{
		window.open(url);
	}
		window.close();
	}catch(e){}

}
///////////////////////////////////////////////////////////

var frmWin = {
	close:function(){
		$("body").layerPopup("closeLayerPopup");
	}
}
//아이프레임레이어 열기
function openIframeLayer(url,width,height,page_title,options){
	var cfg = options || {};

	var cfg =$.extend({},{title:page_title,cont_type:"iframe",url:url,"width":width,"height":height},options || {});
	if($("body").data( "layerPopup" )){
		if($("body").layerPopup("state")==true){
			$("body").layerPopup("reload",cfg);
		}else{
			$("body").layerPopup("show");
		}
	}else{
		$("body").layerPopup(cfg);
	}


}
//레이어팝업 열기
function openLayerPage(url,width,height,page_title,options){
	var cfg =$.extend({},{title:page_title,cont_type:"",url:url,"width":width,"height":height},options || {});
	if($("body").data( "layerPopup" )){
		if($("body").layerPopup("state")==true){
			$("body").layerPopup("reload",cfg);
		}else{
			$("body").layerPopup("show");
		}
	}else{
		$("body").layerPopup(cfg);
	}
}

function openLayerPageNew(target,url,width,height,page_title,options){
	if(target==null){
		var target = $("<div></div>").attr("id","layerpop-"+new Date().getTime()).appendTo("body");
	}else if( typeof(target)=="string"){
		var target = $("#" + target );
	}
	var cfg =$.extend({},{title:page_title,cont_type:"",url:url,"width":width,"height":height},options || {});
	if($(target).data( "layerPopup" )){
		if($(target).layerPopup("state")==true){
			$(target).layerPopup("reload",cfg);
		}else{
			$(target).layerPopup("show");
		}
	}else{
		$(target).layerPopup(cfg);
	}

	return $(target);

}


function closeLayer(target){
	if(typeof(target)=="undefined"){
		if($("body").data( "layerPopup" )){
			$("body").layerPopup("close");
		}
	}else{
		if(target.data( "layerPopup" )){
			target.layerPopup("close");
		}

	}
}

//새창 열기
function openWindow(url,width,height,page_title,winName){
	if(winName==undefined) var winName = "";
	var w = window.open(url,winName,"width="+width+",height="+height+",scrollbars=yes");
	w.focus();

}
function openNewWin(url,winName,w,h){
	var w = window.open(url,winName,"width="+w+",height="+h+",scrollbars=yes");
}


function $alert(msg,options){
	var options = $.extend({},{w:300,h:120,"btn_label":"확인","btn":false},options);


	var printMsg = msg.replace(/\b\n\b/i,'<br/>');

	if(options.btn){
		var msgHTML = "<div class='popErrorBox'><div class='popErrorMsg'><div class=''>"+printMsg+"</div><div class='popErrorBtns mg10t'><button type='buttom' class='sp-btn closeBtn'><span>확인</span></button></div></div>";
	}else{
		var msgHTML = printMsg;
	}

	$("body").msgPopup({"message":msgHTML,"width":options.w,"height":options.h});
}
function $alertLoading(msg){


	if(msg==undefined) var msg = "데이터 처리중입니다.";
	var printMsg = msg.replace(/\b\n\b/i,'<br/>');
	var msgHTML = "<div class='popErrorBox'><div class='popErrorMsg'><div class=''><img src='/images/Common/loading_img01.gif' alt=''/> <span id='alertloadingmsg'>"+printMsg+"</span></div></div><div class='popErrorBtns'></div></div>";

	$("body").msgPopup({"message":msgHTML,"width":300,"height":120});

}
function $alertLoadingClose(){

	try{$("body").msgPopup("closeMsgPopup");}catch(e){ }
}

//창크기로 화면 중앙 좌표 구하기
function getWinCenter(w,h){

	var top = parseInt((screen.availHeight)/2-h/2);
	var left = parseInt((screen.availWidth)/2-w/2);
	var obj = {"top":top,"left":left};
	return obj;
}


//아이프레임 리사이징
function setIframeSize(obj,w,h){
		$("#" +obj).width(w).height(h);
		try{resetPageLayout();}catch(e){}
}



//이메일 주소 선택
function email_domain(email_domain,value){
	var f_obj = document.getElementById(email_domain);
	f_obj.value=value;
	if(value=="") f_obj.style.display="";
	else f_obj.style.display="none";
}



function image_window(img)
{
	var _charset = "UTF-8";
	var imgsrc = getDataAttribute(img,"orgsrc");
	var tmpsrc = getDataAttribute(img,"tmp_src");

	if ((typeof(imgsrc)!="undefined" || imgsrc=="") && (typeof(tmpsrc)!="undefined" && tmpsrc!="")){
		imgsrc = tmpsrc;
	}

	var w =getDataAttribute(img,"tmp_width");
	var h = getDataAttribute(img,"tmp_height");
	var winl = (screen.width-w)/2;
	var wint = (screen.height-h)/3;

	if (w >= screen.width) {
		winl = 0;
		h = (parseInt)(w * (h / w));
	}

	if (h >= screen.height) {
		wint = 0;
		w = (parseInt)(h * (w / h));
	}

	var js_url = "<script language='JavaScript1.2'> \n";
		js_url += "<!-- \n";
		js_url += "var ie=document.all; \n";
		js_url += "var nn6=document.getElementById&&!document.all; \n";
		js_url += "var isdrag=false; \n";
		js_url += "var x,y; \n";
		js_url += "var dobj; \n";
		js_url += "function movemouse(e) \n";
		js_url += "{ \n";
		js_url += "  if (isdrag) \n";
		js_url += "  { \n";
		js_url += "    dobj.style.left = nn6 ? tx + e.clientX - x : tx + event.clientX - x; \n";
		js_url += "    dobj.style.top  = nn6 ? ty + e.clientY - y : ty + event.clientY - y; \n";
		js_url += "    return false; \n";
		js_url += "  } \n";
		js_url += "} \n";
		js_url += "function selectmouse(e) \n";
		js_url += "{ \n";
		js_url += "  var fobj      = nn6 ? e.target : event.srcElement; \n";
		js_url += "  var topelement = nn6 ? 'HTML' : 'BODY'; \n";
		js_url += "  while (fobj.tagName != topelement && fobj.className != 'dragme') \n";
		js_url += "  { \n";
		js_url += "    fobj = nn6 ? fobj.parentNode : fobj.parentElement; \n";
		js_url += "  } \n";
		js_url += "  if (fobj.className=='dragme') \n";
		js_url += "  { \n";
		js_url += "    isdrag = true; \n";
		js_url += "    dobj = fobj; \n";
		js_url += "    tx = parseInt(dobj.style.left+0); \n";
		js_url += "    ty = parseInt(dobj.style.top+0); \n";
		js_url += "    x = nn6 ? e.clientX : event.clientX; \n";
		js_url += "    y = nn6 ? e.clientY : event.clientY; \n";
		js_url += "    document.onmousemove=movemouse; \n";
		js_url += "    return false; \n";
		js_url += "  } \n";
		js_url += "} \n";
		js_url += "document.onmousedown=selectmouse; \n";
		js_url += "document.onmouseup=new Function('isdrag=false'); \n";
		js_url += "//--> \n";
		js_url += "</"+"script> \n";

	var settings;

   // if (g4_is_gecko) {
   //     settings  ='width='+(w+10)+',';
  //  } else {
		settings  ='width='+w+',';
		settings +='height='+h+',';
  //  }
	settings +='top='+wint+',';
	settings +='left='+winl+',';
	settings +='scrollbars=no,';
	settings +='resizable=yes,';
	settings +='status=no';


	win=window.open("","image_window",settings);
	win.document.open();
	win.document.write ("<html><head> \n<meta http-equiv='imagetoolbar' CONTENT='no'> \n<meta http-equiv='content-type' content='text/html; charset="+_charset+"'>\n");
	var size = "이미지 사이즈 : "+w+" x "+h;
	win.document.write ("<title>"+size+"</title> \n");
	if(w >= screen.width || h >= screen.height) {
		win.document.write (js_url);
		var click = "ondblclick='window.close();' style='cursor:move' title=' "+size+" \n\n 이미지 사이즈가 화면보다 큽니다. \n 왼쪽 버튼을 클릭한 후 마우스를 움직여서 보세요. \n\n 더블 클릭하면 닫혀요. '";
	}
	else
		var click = "onclick='window.close();' style='cursor:pointer' title=' "+size+" \n\n 클릭하면 닫혀요. '";
	win.document.write ("<style>.dragme{position:relative;}</style> \n");
	win.document.write ("</head> \n\n");
	win.document.write ("<body leftmargin=0 topmargin=0 bgcolor=#dddddd style='cursor:arrow;'> \n");
	win.document.write ("<table width=100% height=100% cellpadding=0 cellspacing=0><tr><td align=center valign=middle><img src='"+imgsrc+"' width='"+w+"' height='"+h+"' border=0 class='dragme' "+click+"></td></tr></table>");
	win.document.write ("</body></html>");
	win.document.close();

	if(parseInt(navigator.appVersion) >= 4){win.window.focus();}

}


function OpenZipSearch(zip_id,addr1_id,addr2_id){



	    daum.postcode.load(function(){
				
try{
		 new daum.Postcode({
            oncomplete: function(data) {
                // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.
                // 우편번호와 주소 정보를 해당 필드에 넣고, 커서를 상세주소 필드로 이동한다.
			try{
						   // document.getElementById(zip_id).value = data.postcode1+"-" + data.postcode2;
							document.getElementById(zip_id).value = data.zonecode;
						   // document.getElementById(addr1_id).value = data.address;

							//전체 주소에서 연결 번지 및 ()로 묶여 있는 부가정보를 제거하고자 할 경우,
							//아래와 같은 정규식을 사용해도 된다. 정규식은 개발자의 목적에 맞게 수정해서 사용 가능하다.
							var addr = data.address.replace(/(\s|^)\(.+\)$|\S+~\S+/g, '');
							document.getElementById(addr1_id).value = addr;

							if(addr2_id!=undefined && addr2_id!=""){

								document.getElementById(addr2_id).focus();
							}else{
								document.getElementById(addr1_id).focus();
							}
			}catch(e){}
						}
					}).open();
}catch(e){
	alert("우편번호 검색창 호출 실패!\n팝업창이 차단되어 있는 경우 팝업차단을 해제해주시기 바랍니다.");
}


	});



}

//글자수 입력길이 미리보기
function viewStrlen(objId1,objId2){
	var obj1 = document.getElementById(objId1);
	var obj2 = document.getElementById(objId2);

	obj2.innerHTML = obj1.value.length;

}
function setDisableLayer(objid,val){
	var obj1 = $("#"+objid+"_box");
	var obj2 = $("#"+objid+"_layer");

	if(val){
		obj2.hide();

	}else{
		obj2.show();

		$(obj2).width(obj1.innerWidth());
		$(obj2).height(obj1.innerHeight() +  parseInt(obj1.css("paddingTop")) + parseInt(obj1.css("paddingBottom")));
	}
}



function toclipboard(str)  {     window.clipboardData.setData('Text',str); }
function copyText(str){
	str.select();
	var clip = str.createTextRange();
	clip.execCommand('copy');
	alert(str.value);
}


function pagePrint(){
	try{
		window.print();
	}catch(e){
		alert("미지원 브라우저입니다.\n웹 브라우저의 인쇄 기능을 이용해주시기 바랍니다.");
	}
}

function file_size(num){
	var n = parseInt(num);
	var n1 = n;
	var u = "KB";

	 if (n < 1048576)	n1 =  n / 1024;
	 else if(n<1073741824) { n1 = n/1048576;  u = "MB"; }
	 else {n1 = n/1073741824 ; u = "GB";}

	n1 = parseInt(n1 * 100)/100;
	return n1 + u;
}


function checkStrlen(v,maxlen){
	if(v.length>=maxlen){
		return false;
	}else{
		return true;
	}
	//alert(v);
//	var obj1 = document.getElementById(objId1);

}



function set_option(obj,idx,t_name,t_value){
	if (obj.length<1) obj.length=1;
	obj.options[idx].text = t_name;
	obj.options[idx].value= t_value;
}

function add_option(obj,t_name,t_value){
	var idx = obj.length;
	obj.length= idx + 1;

	obj.options[idx].text = t_name;
	obj.options[idx].value= t_value;
}
function set_select(obj_id,t_name){
	var obj = document.getElementById(obj_id);
	obj.length = 1;
	obj.options[0].text = t_name;
	obj.options[0].value="";
}

function search_array(arr,str){

	for ( var i=0;i<arr.length;i++ )
	{
		if(arr[i]==str) {
			return i;
		}
	}
	return -1;
}

function remove_array_key(arr, idx){
	var reArr = [];
	for ( var i=0;i<arr.length;i++ )
	{
		if(i!=idx) reArr.push(arr[i]);
	}
	return reArr;

  var narr = $.grep(arr, function(value){
    return value != item;
  });
  return narr;
}

function in_array(arr,str){
	for ( var i=0;i<arr.length;i++ )
	{
		if(arr[i]==str) return true;
	}
	return false;
}
function remove_array(arr, item){
  var narr = $.grep(arr, function(value){
    return value != item;
  });
  return narr;
}

//전체선택
function check_all(obj1,obj2){
	$(obj2).prop("checked",$(obj1).prop("checked"));
}
function SelectAll(form) {
  var fm = form;
  var fme = fm.elements;

  var chkVal = fm.selectall.checked;

  for(i = 0; i < fme.length; i++) {
    if(fme[i].type == "checkbox" && fme[i].name == "chk[]" && fme[i].disabled == false) {
		fme[i].checked = chkVal;
	}
  }
}


function SelectAll2(all,chk) {


 // var chkall = (typeof(all)=="undefined")? fm.selectall : allfrm;
	var chkall = $(all);
	var el = $("[type='checkbox']",chk);
	var fme = el.not(chkall);

	var chkVal =chkall.prop("checked");
	
	 //var chkVal = chkall.checked;

  for(i = 0; i < fme.length; i++) {
    if($(fme[i]).prop("disabled")==false) {
		$(fme[i]).prop("checked",chkVal);
	}
  }
}


//체크된 체크박스 확인
function chk_select(f,chk_name,num){

		if (typeof f!="object") var obj = document.getElementById(f);
		else var obj = f;

		var cnt=0;

		for(var i=0;i < obj.elements.length;i++) {
			var currEl = obj.elements[i];
			if (currEl.getAttribute("type")  =="checkbox" && currEl.name==chk_name && currEl.checked==true ){
				cnt++;
			}
		}
		if (cnt<num) return false;
		else return true;

}
//선택된 값을 문자열로 연결
function make_select_list(frm_obj,select_name,split){
	if(split==undefined || split=="") var split = ",";
	var vals = new Array();
	for(var i = 0;i < frm_obj.elements.length;i++) {
			var currEl = frm_obj.elements[i];
			if (currEl.name==select_name && currEl.checked==true){
				vals.push(currEl.value);
			}
	}
	if(vals.length>0){
		return vals.join(split);
	}else{
		return "";
	}
}
function val_to_array(chk){
	var rArr = [];
	$(chk).each(function(){rArr.push($(this).val());});
	return rArr;
}


function selectOptionDel(list_obj)
{
	if (typeof list_obj!="object") var list_obj = document.getElementById(list_obj);

	if (list_obj.length==0)
	{
		alert("삭제할 항목이 없습니다.");
		return;
	}
	if (list_obj.value=="")
	{
		alert("삭제할 항목을 선택해주세요");
		list_obj.focus();
		return;
	}
	var chk_del_str = "";
	tot_len = list_obj.length;
	for (j=tot_len-1;j>=0;j--)
	{
		if (list_obj.options[j].selected==true)
			list_obj.remove(j);
	}


}




function min_height(obj,h){
	if (obj.readyState!="complete") return "auto";
	if (obj.offsetHeight<h)
	{
		obj.style.height=h + "px";
	}
}

function min_width(obj,w){
	if (obj.readyState!="complete") return "auto";
	if (obj.offsetWidth<w)
	{
		obj.style.width=x + "px";
	}
}


function openLoginPopup(url){
	/*
	$(".pop_windoc").remove();
	loginWin =  new msgPopupWin({w:452,h:222,msgWinDoc:"",setStyle:false,title:"로그인",closeBtns:$(".closeBtn")});

	$(loginWin.bodyPannel).load("/Share/login.php?prcCode=ajax&url=" + encodeURIComponent(document.location.href),function(){
		$("#login_user_id").focus();
		loginWin.setCloseBtns();
	});
	*/


	var cfg = options || {parameter:"prcCode=ajax&url=" + encodeURIComponent(document.location.href)};$("body").layerPopup("closeLayerPopup");
	$("body").layerPopup($.extend({},{title:"로그인",cont_type:"iframe",url:url,"width":452,"height":222},cfg));
}


function imgPreview(etarget,src){
	if($(".imgPreviewArea").length>0){
		$(".imgPreviewArea").remove();
	}else{
		$("body").append("<div class='imgPreviewArea'><img src='"+src+"' width=200/></div>");
		$(".imgPreviewArea").css({"position":"absolute","border":"1px solid #DDD","z-index":"6000","left":($(etarget).offset().left+50) +"px","top":$(etarget).offset().top+"px"});
	}
}
function imgPreviewClose(){

}



function getBrowsertInfo(){
	var $agent = navigator.userAgent;
	var $s = "";
	var $br = {browser:"",browserType:"",browserVer:[]};


    if ((/msie 5.0[0-9]*/i).test($agent))         { $s = "MSIE 5.0"; }
    else if((/msie 5.5[0-9]*/i).test($agent))     { $s = "MSIE 5.5"; }
    else if((/msie 6.0[0-9]*/i).test($agent))     { $s = "MSIE 6.0"; }
    else if((/msie 7.0[0-9]*/i).test($agent))     { $s = "MSIE 7.0"; }
    else if((/msie 8.0[0-9]*/i).test($agent))     { $s = "MSIE 8.0"; }
    else if((/msie 9.0[0-9]*/i).test($agent))     { $s = "MSIE 9.0"; }
	else if((/msie 10.0[0-9]*/i).test($agent))     { $s = "MSIE 10.0"; }
	else if((/windows*/i).test($agent) && (/rv:11.0[0-9]*/i).test($agent))     { $s = "MSIE 11.0"; }
    else if((/msie 4.[0-9]*/i).test($agent))      { $s = "MSIE 4.x"; }
    else if((/firefox/i).test($agent))            { $s = "FireFox"; }
    else if((/safari/i).test($agent))            { $s = "FireFox"; }
    else if((/x11/i).test($agent))                { $s = "Netscape"; }
    else if((/opera/i).test($agent))              { $s = "Opera"; }
    else if((/gec/i).test($agent))                { $s = "Gecko"; }
    else if((/bot|slurp/i).test($agent))          { $s = "Robot"; }
    else if((/internet explorer/i).test($agent))  { $s = "IE"; }
    else if((/mozilla/i).test($agent))            { $s = "Mozilla"; }
    else { $s = ""; }

	$br.browser = $s;

	if((/msie/i).test($s)){
		$br.browserType = "IE";
		$br.browserVer =  $s.replace("MSIE " ,"").split(".");
	}

	return $br;

}


var $wbr =getBrowsertInfo();
var wsize = null;	//윈도우 사이즈 정보
var psize = null;	//컨텐츠 사이즈 정보
var lowIeChk = {	old_w:0,old_h:0 }
function getWindowSizeObj(){
		var sizeObj = {
		scr : {w:screen.width,h:screen.height},
		availscr : {w:screen.availWidth,h:screen.availHeight},
		win : (_isLowBr_)? {w:$(window).width(),h:$(window).height()}	: {w:window.innerWidth,h:window.innerHeight}	//스크롤사이즈 제외(윈도우 8부터 아래버전에서 확인안됨.ㅠㅠ)

	}
	return sizeObj;
}
function getPageSizeObj(){
	var sizeObj = {
		doc : {w:document.documentElement.scrollWidth,h:document.documentElement.scrollHeight},
		scroll : {x:document.documentElement.scrollLeft,y:document.documentElement.scrollTop,top:$(window).scrollTop(),left:$(window).scrollLeft()}	////모바일에서는 안잡힘..
		, header:{h:$("#header-wrap").height()}		, footer:{h:$("#footer-wrap").height() + 1}
	};
	return sizeObj;
}
function getWindowSize(){
	wsize =getWindowSizeObj();
}
function getPageSize(){
	psize = getPageSizeObj();

	printWinSizeInfo();
}

function printWinSizeInfo(){
	var str = "";
//	str +="screen [w : "+wsize.scr.w+", h:"+wsize.scr.h+"]<br/>";
//	str +="availscr [w : "+wsize.availscr.w+", h:"+wsize.availscr.h+"]<br/>";
	str +="window [w : "+wsize.win.w+", h:"+wsize.win.h+"] ";		//스크롤바 포함한 브라우저 윈도우  높이
	str +="doc [w : "+psize.doc.w+", h:"+psize.doc.h+"]<br/>";
//	str +="scrollpos [w : "+psize.scroll.x+", h:"+psize.scroll.y+"]<br/>";
//	str +="scrollpos2 [left : "+psize.scroll.x+", top:"+psize.scroll.y+"]<br/>";
	$("#testBox").html("[" + $wbr.browser +"]" + str +" /" + $(".div-conts").width());
}


function setLowBrowser(){

	$("body").removeClass("isIE7");
	try{
		if($wbr.browserType=="IE" && $wbr.browserVer[0]<=8){
			_isLowBr_ = true;
			$("body").addClass("isIE7");

			$("li").each(function(){
				if($(this).index() ==0) $(this).addClass("is-first");
				if($(this).index() ==($(" > li",$(this).parent()).length -1)) $(this).addClass("is-last");
			});

			/*
			$("a > span").each(function(){
				if( $(this).attr("onclick")==undefined || $(this).attr("onclick")==""){
					$(this).bind("click",function(){
						$($(this).parents("a").get(0)).click();
					});
				}
			});
			*/
		}
	}catch(e){
	}

}

//탭메뉴 설정
function setTabMenu(tab_id,n){
		$("li[id^='" + tab_id + "_btn'] a").click(function(){
			var tabStr = $(this).attr("href");
			var n  = tabStr.replace("#"+tab_id + "_cont","");
			setTabContents(tab_id,n);
			return false;
		});

		if(n>0) setTabContents(tab_id,n);
}

//탭메뉴 컨텐츠 활성
function setTabContents(tab_id,n){
	if(n==undefined || n<1) n = 1;

	//메뉴 활성
	$("[id^='" + tab_id + "_btn']:not(#"+tab_id+"_btn"+n+")").removeClass("over");
	$("#"+tab_id+"_btn"+n).addClass("over");

	//컨텐츠 활성
	$("[id^='" + tab_id + "_cont']:not(#"+tab_id+"_cont"+n+")").hide();
	$("#"+tab_id+"_cont"+n).show();

}


function setBoardTab(obj_id,num,evt){

	var obj = document.getElementById(obj_id);
	var seq = 0;

	var tabs = Array();
	for (i=0; i<obj.childNodes.length; i++){
		if (obj.childNodes[i].tagName=="DL"){
			seq++;
			tabs[seq] = obj.childNodes[i];
		}
	}

	for (i=1; i<tabs.length; i++){
		var titImg = $("dt img",$(tabs[i]));
		if(titImg.length>0){
			var ovImg = $(titImg).attr("ovImg");
			var orgSrc = $(titImg).attr("orgSrc");
		}

		if (i==num){
			if($(tabs[i]).hasClass("isOn")){
				if(evt=="c") {
					if($(".btn-more",$(tabs[i])).get(0).tagName!="A") {
						var bt = $($(".btn-more",$(tabs[i])).get(0));
					}else{
						var bt = $(".btn-more",$(tabs[i]));
					}
					if($(bt).attr("onclick")=="" || $(bt).attr("onclick")==undefined){
					document.location.href=$(bt).attr("href");
					}else{
					bt.click();
					}

				}
			}else{
				$(tabs[i]).addClass("isOn");
			}
			//이미지
			if(ovImg!=undefined && orgSrc!=undefined){
				$(titImg).attr("src",ovImg);
			}

		}
		else{
			$(tabs[i]).removeClass("isOn");
			//이미지
			if(ovImg!=undefined && orgSrc!=undefined){
				$(titImg).attr("src",orgSrc);
			}
		}
	}
}

function setSubTab(obj_id,maxNum,num){

	for(var i=1; i<=maxNum;i++){
		var tab = document.getElementById(obj_id+"_tab"+i);
		var cont =document.getElementById(obj_id+"_cont"+i);
		if(num==i){
			$(tab).addClass("isOver");
			$(cont).show();
		}else{
			$(tab).removeClass("isOver");
			$(cont).hide();
		}
	}
}

function initMainTabBoard(){
	$(".is-tabboard").each(function(){
	var tabBoardId = $(this).attr("id");
	$("dl",$(this)).attr("rel-id",tabBoardId);

	$("dt a",$(this)).each(function(){
		var $dl = $(this).parent().parent();
		var thisBoardId = $dl.attr("rel-id");
		var n = $dl.index() + 1;

		$(this).bind("click",function(){
			if(!_isMobile_) {
				setBoardTab(thisBoardId,n,'c');
			}else{
				setBoardTab(thisBoardId,n,'');
			}
			return false;
		});
		$(this).bind("mouseover",function(){
			setBoardTab(thisBoardId,n,'');
			return false;
		});

		$(this).bind("focus",function(){
			setBoardTab(thisBoardId,n,'');
			return false;
		});

	});
});
}




function addBookmark(url,title){

	if(_isMobile_){
		return true;
	}else{
		try{
			window.external.AddFavorite(url,title);
		}catch(e){
			alert('이 브라우저에서는 즐겨찾기 기능을 사용할 수 없습니다.\n크롬에서는 Ctrl 키와 D 키를 동시에 눌러서 즐겨찾기에 추가할 수 있습니다.');
		}
		return false;
	}


}
//////////////////////////////////////////////////////////////////////////////////////
function resizeImageMap(img){
	img.each(function(){

		var $img = $(this);
		if($img.prop("usemap")){
			var w, h;
			//var w = $(this).attr("org_width")? $(this).attr("org_width") : false;
			//var h = $(this).attr("org_height")? $(this).attr("org_height") : false;

			if (!w || !h) {
				var temp = new Image();
				temp.src = $img.attr('src');
				if (!w)	w = temp.width;
				if (!h)	h = temp.height;
			}

			console.log(w+"/"+h +"=>" + $img.width()+"/" + $img.height());
			var wPercent = $img.width()/w,
				hPercent = $img.height()/h,
				map = $img.attr('usemap').replace('#', ''),
				c = 'coords';

			$('map[name="' + map + '"]').find('area').each(function() {
				var $this = $(this);

				if (!$this.data("o"+c))			$this.data("o"+c, $this.attr(c));

				var coords = $this.data("o"+c).split(',');
				console.log(wPercent);

				//var coords = $this.data(c).split(','),
				var	coordsPercent = new Array(coords.length);

				for (var i = 0; i < coordsPercent.length; ++i) {
					var point = coords[i] * wPercent;

					if (i % 2 === 0) coordsPercent[i] = parseInt( coords[i] * wPercent);
					else coordsPercent[i] = parseInt( coords[i] * hPercent);

				}
				$this.attr(c, coordsPercent.toString());

			});

		}
	});
}
//이미지 사이즈 정보 초기화
function initImgSizeInfo(){

	$("img").each(function(){
		var attr_w = $(this).width();
		var attr_h = $(this).height();

		if($(this).get(0).getAttribute("org_width")!=null) attr_w = $(this).get(0).getAttribute("org_width") ;
		else if($(this).get(0).org_width!=undefined) attr_w = $(this).get(0).org_width;

		if($(this).get(0).getAttribute("org_height")!=null) attr_h = $(this).get(0).getAttribute("org_height") ;
		else if($(this).get(0).org_height!=undefined) attr_h = $(this).get(0).org_height;

		$(this).attr("org_width",attr_w);
		$(this).attr("org_height",attr_h);


		// if($(this).attr("org_width")!=undefined || $(this).attr("org_width")>0   ) $(this).attr("org_width",$(this).width());
		// if($(this).attr("org_height")==undefined || $(this).attr("org_height")>0)  $(this).attr("org_height",$(this).height());

		$(this).data("org_width",attr_w);
		$(this).data("org_height",attr_h);
		$(this).attr("isInit","true");
	});

	$("area").each(function(){
		$(this).data("coords",$(this).attr("coords"));
	});

}

//지정한 가로폭만큼 리사이징
function contImgResize(imgs,limitSize){

	for (i=0;i<imgs.length ;i++ )
	{
		var im = imgs[i];
		var rSize = getImgReSize(limitSize,{"w":$(im).width(),"h":$(im).height()});

		$(im).width(rSize.w);
		$(im).height(rSize.h);

	}
}
//상위객체 가로 크기 구하기
function boundBoxWidth(obj){
	var w = parseInt($(obj).width());
	if(w<1){
		if($($(obj).parent().get(0)).lennth>0){
		w = boundBoxWidth($($(obj).parent().get(0)));
		}else{
			w = 0;
		}
	}
	return w;
}
//상위 객체를 기준으로 크기값 다시 계산
function AutoImgResize(iobj,maxSize){

	if(maxSize==undefined){
		var pObj = $(iobj).parent().get(0);
		//var maxWidth = parseInt($(pObj).width());
		var maxWidth = boundBoxWidth(pObj);
	}else{
		var maxWidth = maxSize;
	}



	var sizeW = $(iobj).attr("w");
	var sizeH =  $(iobj).attr("h");

	if($(iobj).attr("isInit")=="true"){
		sizeW = $(iobj).data("org_width") ;
		sizeH = $(iobj).data("org_height") ;
		 $(iobj).attr("w",sizeW);
		 $(iobj).attr("h",sizeH);
	}


	if($(iobj).attr("w")==undefined || $(iobj).attr("h")==undefined || $(iobj).attr("w")<1 || $(iobj).attr("h")<1){

		var iw = parseInt($(iobj).width());
		var ih = parseInt($(iobj).height());

		if($(iobj).attr("w")==undefined || $(iobj).attr("w")<1){				$(iobj).attr("w",iw);			}
		if($(iobj).attr("h")==undefined || $(iobj).attr("h")<1){				$(iobj).attr("h",ih);			}
	}else{
		var iw = parseInt($(iobj).attr("w"));
		var ih = parseInt($(iobj).attr("h"));
	}



	//alert(iw);
	if(maxWidth>0){
		//if(maxWidth<iw){
			var rSize = getImgReSize2(maxWidth,{"w":iw,"h":ih});
//			alert(rSize.w +":" + rSize.h)
			//if(rSize.w<=iw || rSize.h<=ih){
			$(iobj).width(rSize.w);
			$(iobj).height(rSize.h);
			//}
		//}
	}
}
//전체 이미지에 대한 이미지 가로폭 제한
function resizeImgsMaxWidth(notObj){

	var imgs = $("img:not(.noResize)");
	for (var i=0;i<imgs.length ;i++ )
	{
		AutoImgResize(imgs[i]);
	}

}
//이미지 사이즈 계산
function getImgReSize2(w,imgSize){
	var rSize = {"w":imgSize.w,"h":imgSize.h};

	if(imgSize.w>w){
		rSize.w = w;
		rSize.h = Math.ceil(imgSize.h * (rSize.w /imgSize.w));

	}

	return rSize;
}



function setLowBrowser(){

	$("body").removeClass("isIE7");
	try{
		if($wbr.browserType=="IE" && $wbr.browserVer[0]<=8){
			_isLowBr_ = true;
			$("body").addClass("isIE7");

			$("li").each(function(){
				if($(this).index() ==0) $(this).addClass("is-first");
				if($(this).index() ==($(" > li",$(this).parent()).length -1)) $(this).addClass("is-last");
			});

		}
	}catch(e){
	}

}

function loadCSSFile(url,media){
	var l = document.createElement('link'); l.rel = 'stylesheet'; l.media = media;	l.href =url;
	var h = document.getElementsByTagName('head')[0]; h.parentNode.insertBefore(l, h);
}

function unsetFormStyle(target){
	var targetObj = (target==undefined)? document.documentElement : $(target);
	$("input[type=file]",targetObj).not(".dft-style").each(function(){
			var this_s = this;

			if($(this).parent().hasClass("is-file-sfrm")){
				$(".is-fnm",$(this).parent()).remove();
				$(".is-fbtn",$(this).parent()).remove();
				$(this).unwrap(".is-file-sfrm");
			}


		});


}
// 파일폼 디자인 스타일 변경
// 파일폼 동적 추가시에는 수동 호출 필요
function resetFormStyle(target){


	var targetObj = (target==undefined)? document.documentElement : $(target);

	$("[required]").each(function(){				$(this).removeAttr("required").attr("frequired","required");			});
	$("[readonly]").each(function(){				$(this).addClass("readonly");			});
	if(!_isLowBr_) {

		try{unsetFormStyle(targetObj);}catch(e){}

		$("input.calendar",targetObj).datepicker({});

		
		$("input[type=file]",targetObj).not(".dft-style").each(function(){
			var this_s = this;


			if(!$(this).parent().hasClass("is-file-sfrm")){
				$(this).wrap("<span class='is-file-sfrm'></span>");


			$(this).parent().prepend("<button class='is-fbtn' type='button'><span>파일첨부</span></button><span class='is-fnm no-val' >...</span>");
//			$(this).parent().append("");
			$(".is-fnm",$(this).parent()).attr("tabindex","0");
			$(this).bind("change",function(){
				if($(".is-fnm",$(this).parent()).length>0){
					if(this.value==""){
						$(".is-fnm",$(this).parent()).text("...").removeClass("in-val").addClass("no-val");
					}else{
						$(".is-fnm",$(this).parent()).text(this.value).removeClass("no-val").addClass("in-val");
					}

				}else{
					$(this).parent().prepend("<span class='is-fnm in-val'>"+this.value+"</span>");
				}
			});
				if(this.value!=""){
				if($(".is-fnm",$(this).parent()).length>0){
					if(this.value==""){
						$(".is-fnm",$(this).parent()).text("...").removeClass("in-val").addClass("no-val");
					}else{
						$(".is-fnm",$(this).parent()).text(this.value).removeClass("no-val").addClass("in-val");
					}

				}else{
					$(this).parent().prepend("<span class='is-fnm in-val'>"+this.value+"</span>");
				}


			}


			$(".is-fbtn",$(this).parent()).click(function(){				$(this).parent().find("input[type='file']").click();			});
			$(".is-fnm",$(this).parent()).click(function(){				$(this).parent().find("input[type='file']").click();			});
			}

		});




		$(".a-chk").each(function(){
			var this_s = this;

			if(!$(this).parent().hasClass("is-chk-sfrm")){
				$(this).wrap("<span class='is-chk-sfrm'></span>");
				$(this).parent().prepend("<span class='is-fnm' ></span>");

				$(this).bind("change",function(){

					var chked = $(this).prop("checked")? true:false;
					if(chked)			$(this).parent().addClass("is-checked");
					else $(this).parent().removeClass("is-checked");

					if($(".is-fnm",$(this).parent()).length<1){
						$(this).parent().prepend("<span class='is-fnm'></span>");
					}


				});
				$(".is-fbtn",$(this).parent()).click(function(){				$(this).parent().find("input[type='checkbox']").click();			});
				$(".is-fnm",$(this).parent()).click(function(){				$(this).parent().find("input[type='checkbox']").click();			});
		}
		});


	}

	$(".a-icbt").each(function(){
		if( $(this).prop("ovinit")!=true){
		$(this).prop("ovinit",true);
		$(this).bind("mouseover",function(){
			var toOffset ={top : $(this).offset().top - document.documentElement.scrollTop, left:$(this).offset().left  - document.documentElement.scrollLeft+ ($(this).width()/2)};
			if($(".a-icbt-lbl").length<1){
				$("body").append("<div class='a-icbt-lbl'></div>");
			}
			$(".a-icbt-lbl").text($(this).text()).css({position:"fixed",top:toOffset.top,left:toOffset.left}).show();
			$(".a-icbt-lbl").each(function(){ $(this).css({"margin-left":$(this).outerWidth()/2 * (-1),"margin-top":($(this).outerHeight() * -1)-5}); });
		}).bind("mouseout",function(){
			$(".a-icbt-lbl").hide();
		});
		$(this).bind("focus",function(){$(this).trigger("mouseover");	}).bind("blur",function(){ $(this).trigger("mouseout");});

		}
	});


}





function listToQuerystr(list){
	var str = Array();
	for(var i in list) { 	str.push(i+"="+list[i]);	}
	return str.join("&");
}


function submitPostForm(frmID,aURL,aParam,sflag){
	if(typeof(sflag)=="undefined") var sflag = true;
	$("#tmpFrm_"+frmID).remove();
	var f = $("<form></form>")
		.attr("id","tmpFrm_"+frmID)
		.attr("action",aURL)
		.attr("method","post")
		.attr("enctype","multipart/form-data")
		//var p = new FormData();

	var arr = aParam.split("&");
	for (var i=0;i<arr.length ;i++ )
	{
		var tmp = arr[i].split("=");
		var v = (typeof(tmp[1])!="undefined")? tmp[1] : "";
		$("<input type='hidden' name='"+tmp[0]+"' />").val(v).appendTo(f);
		//p.append(tmp[0],tmp[1]);
	}
	f.appendTo($("body"));
	if(sflag){
		f.submit();
	}

	return $("#tmpFrm_"+frmID).get(0);


}


function getRelativeSize_w(setSize,limitSize){
//	if(limitSize.w > setSize.w ) limitSize.w = setSize.w;

	var wRate = limitSize.w / setSize.w ;
	var toWidth = setSize.w * wRate;
	var toHeight = setSize.h * wRate;
	var toSize = {w:toWidth,h:toHeight};
	return toSize;
}


function getRelativeSize_h(setSize,limitSize){
//	if(limitSize.w > setSize.w ) limitSize.w = setSize.w;

	var hRate = limitSize.h / setSize.h ;
	var toWidth = setSize.w * hRate;
	var toHeight = setSize.h * hRate;
	var toSize = {w:toWidth,h:toHeight};
	return toSize;
}


function setButtonOverEft(btn_wr){
	var $wr = $(btn_wr);

	$("a",$wr).each(function(){
		if($(this).attr("_s")==undefined){
			$(this).attr("_s",true);

			if(!_isMobile_){
			$(this).hover(function(){		$(this).addClass("over");	},function(){
				$(this).removeClass("over");
			});

			}
			$(this).bind("click",function(){

				if($(this).hasClass("is-sel")) $(this).removeClass("is-sel");
				else  $(this).addClass("is-sel");

				$("a",$wr).not($(this)).removeClass("over");
				$("a",$wr).not($(this)).removeClass("is-sel");
				return false;
			});
		}
	});

}
function getDateTimeStr(){
	var date = new Date();
	var timestr = "";

     timestr += date.getMonth() + ""
     timestr += date.getDate() + ""
     timestr += date.getHours() + ""
     timestr += date.getMinutes() + ""
     timestr += date.getSeconds() + ""

	return timestr;

}

function ajaxFormSubmit(f,callbackS,callbackE){

	var $f = $(f);
	var bAsync = true;
	var tDataType = 'text';
	// console.log(f.async);
	if(typeof(f.async) != "undefined" && f.async.value==0) bAsync = false;
	if(typeof(f.dataType) != "undefined" && f.dataType.value!="") tDataType = f.dataType.value;
	var ajaxFrmData = null;

	if(typeof(callbackS)=="undefined")  var callbackS = defaultAjaxFrmSubmitSuccess;

	//파일폼 ajax submit
	try{
		var isTxtFormData = false;

		if( $("[name='prcCode']",$f).length>0) $("[name='prcCode']",$f).val("ajax");
		else $f.append("<input type='hidden' name='prcCode' value='ajax'/>");

		var ajaxFrmData = new FormData(f);


		//에디터 입력 데이터 업데이트
		$("textarea.isEditorText",$f).each(function(){
			var v = $(this).val();
			$(this).val(v);
			ajaxFrmData.set($(this).attr("name"),v);
		});


	}catch(e){
		console.log("defaultFormSubmit" + e);
		var isTxtFormData = true;
		if($("[type='file']",f).length>0){

			var ajaxFrmData = null;


		}else{
			if( $("[name='prcCode']",$f).length>0) $("[name='prcCode']",$f).val("ajax");
			else $f.append("<input type='hidden' name='prcCode' value='ajax'/>");

			var ajaxFrmData = $f.serialize();
		}
		//alert("IE10 상위버전의 브라우저를 이용해주시기 바랍니다.");
	}

	if('noloading' in f === false || f.noloading.value!=1)	$alertLoading();
	if( ajaxFrmData!=null){
		var ajaxCfg = isTxtFormData? {} : {dataType:'text',			processData: false,			contentType: false};
		try{
		$.ajax($.extend({},ajaxCfg,{
			url : $f.attr("action"),data:ajaxFrmData,
			files      : $("[type='file']",f),
			async:bAsync,
			dataType:tDataType,
			type: 'POST',
				success: function (rst) {

document.location.ref="?"

				try{ callbackS(rst);}catch(e){}
				// try{ $alertLoadingClose();}catch(e){}

			   },
			   error: function (jqXHR) {

				 console.log('error');
				 console.log(jqXHR);
				 try{
					   callbackE(jqXHR);
				 }catch(e){
					 alert("Error!! 다시 시도해 주시기바랍니다.");
					 try{ $alertLoadingClose();}catch(e){}
				 }
			   },
			   complete : function() {
				// try{ $alertLoadingClose();}catch(e){}
			  }
		},{}));
		}catch(e){
			alert(e);
		}
		return false;
	}else{
		if( $("[name='prcCode']",$f).length>0)  $("[name='prcCode']",$f).val("");
		$(f).get(0).submit();
		return false;
		//return true;
	}


}

function defaultAjaxFormSubmit(f,callbackS,callbackE){
	return ajaxFormSubmit(f,callbackS,callbackE);
	// var chk = FormCheck(f);
	// if(chk){
	// 	chk = ajaxFormSubmit(f,callbackS,callbackE);
	// }
	// return chk;
}
function defaultAjaxFrmSubmitSuccess(r){
	var rst = $.trim(r).split("|");
	console.log(r);

	if(typeof(rst[1])!="undefined"){
		alert(rst[1]);
	}

	if(rst[0]=="O" ){
		document.location.reload();
	}
	$alertLoadingClose();
}

function defaultSearchFrmSubmit (f){
	var $f = $(f);
	$("select",$f).each(function(){
		if($("option:selected",this).length<1 || $("option:selected",this).val()==""){
			$(this).prop("disabled",true);
		}
	});
	$("input[type='text'], input[type='hidden']",$f).each(function(){
		if($(this).val()==""){
			$(this).prop("disabled",true);
		}
	});
	return true;
}
function	defaultSearchFrmRest (f){
	var $f = $(f);
	$("select,input[type='text']",$f).prop("disabled",true);
	$f.submit();
	return true;

}

var docURL = {
	uri : document.location.href,q:[],qstr:"",
	_init:function(){
		this.uri = document.location.href;
		var urlArr = this.parseURI(this.uri);
		this.url = urlArr.url;
		this.qstr = urlArr.qstr;
		this.anchor = urlArr.anchor;
	},
	parseURI : function(url){
		var info = {"url":"","qstr":"","anchor":""};
		var urlAnchor = url.split("#");
		var uriArr = urlAnchor[0].split("?");
		if($.trim(uriArr[1])!=""){
			info.qstr = $.trim(uriArr[1]);
			//this.parseQueryStr($.trim(uriArr[1]));
		}
		info.url = $.trim(uriArr[0]);
		info.anchor = urlAnchor[1];
		return info;
	},
	 parseQueryStr : function(str){
		this.q = [];
		var qArr = [];
		if(str!="") qArr = str.split("&");
		for (var i=0;i<qArr.length ;i++ )
		{
			var tmpArr = $.trim(qArr[i]).split("=");
			this.q.push({"key":tmpArr[0],"value":tmpArr[1]});
			//docQueryData[tmpArr[0]] = tmpArr[1];
		}
	},
	strToData : function(str){
		
		var qArr = []; var qData = {};

		if(typeof(str)!="undefined" && str!="") qArr = str.split("&");
		for (var i=0;i<qArr.length ;i++ )
		{
			var tmpArr = $.trim(qArr[i]).split("=");
			//this.q.push({"key":tmpArr[0],"value":tmpArr[1]});
			if(tmpArr[0]) 	qData[tmpArr[0]] = decodeURIComponent(tmpArr[1]);
		}
		return qData;
	},
	dataToQuseryStr:function(dt){
		var tmpArr = [];
		for (var k in dt) {
			tmpArr.push(k +"=" + dt[k]);
		}
		return tmpArr.join("&");
	},
	removeQueryStr:function(qkey,addstr,query){
		this._init();
		if(typeof(query)=="undefined") var query = this.qstr;
		var qstr =[];
		var keyArr = qkey.split(",");

		this.parseQueryStr(query);
		for(var i=0;i<this.q.length;i++){
			if(!in_array(keyArr,this.q[i].key)){
				qstr.push(this.q[i].key +"="+ this.q[i].value);
			}
		}

		 var rstr = (qstr.length>0)? qstr.join("&") + addstr: "";
		return rstr;

	},
	selectQueryStr:function(qkey,addstr,query){
		this._init();
		if(typeof(query)=="undefined") var query = this.qstr;
		var qstr =[];
		var keyArr = qkey.split(",");

		this.parseQueryStr(query);
		for(var i=0;i<this.q.length;i++){
			if(in_array(keyArr,this.q[i].key)){
				qstr.push(this.q[i].key +"="+ this.q[i].value);
			}
		}

		 var rstr = (qstr.length>0)? qstr.join("&") + addstr: "";
		return rstr;

	},
	setUrlQuerystr:function(url,qrystr){
		var urlInfo = url.split("?");
		var baseURL = urlInfo[0];
		var baseQry =  (urlInfo[1]!=undefined && urlInfo[1]!="")? urlInfo[1] + "&" + qrystr : qrystr;
		var qryInfo = baseQry.split("&");
		var qry = [];
		for(var i = 0;i<qryInfo.length;i++){
			if(qryInfo[i]!="") qry.push (qryInfo[i]);
		}
		var qstr = qry.length>0? qry.join("&") : "";
		if(qstr!="") baseURL  = baseURL + "?" + qstr;
		return baseURL;
	}
	,getQueryString:function(p){
		this._init();
		var param = this.strToData(this.qstr);

		if(typeof(param[p])!="undefined"){
			return param[p];
		}else return "";

	}
}
$(document).ready(function(){docURL._init();});


String.prototype.trim = function(){   return this.replace(/(^\s*)|(\s*$)/gi, ""); }

String.prototype.replaceAll = function(str1, str2){
  var temp_str = $.trim(this);
  temp_str = temp_str.replace(eval("/" + str1 + "/gi"), str2);
  return temp_str;
}

function strToDateTime(dateStr){
  var dttime =  dateStr.split(" ");
  var dateinfo = dttime[0].trim().split("-");
  var timeinfo = dttime[1].trim().split(":");
  return new Date(dateinfo[0] , dateinfo[1] -1 , dateinfo[2] ,timeinfo[0], timeinfo[1],0) ;

}
function strToDate(dateStr){
  var dateinfo = dateStr.split("-");
  return new Date(dateinfo[0] , dateinfo[1] -1 , dateinfo[2] ) ;
}

// yyyymmdd
function printDate(dateStr, sep){
	var y = dateStr.substr(0,4);
	var m = dateStr.substr(4,2);
	var d = dateStr.substr(6,2);
	var str = y + "년 " + m + "월 " + d + "일";
	if(sep)	str = y + sep + m + sep + d;
	return str;
}

function dateToStr(dt,f){
	var week = ["일","월","화","수","목","금","토"];
	var y = dt.getFullYear();
	var m = dt.getMonth() + 1 ;
	var d = dt.getDate();
	var w = dt.getDay();
	var str =  f;
	str = str.replace("YY",y);
	str = str.replace("MM",sprintf2("00",m));
	str = str.replace("DD",sprintf2("00",d));
	str = str.replace("W",week[w]);
	return str;
  //var dateinfo = dateStr.split("-");
  //return new Date(dateinfo[0] , dateinfo[1] -1 , dateinfo[2]);
}

function dateToTimeStr(t){ 	return sprintf2("00",t.getHours()) +":" + sprintf2("00",t.getMinutes()); }






/////////////////////////////////////////////////////////////////////////////

function viewTextLength(el,to){ 	document.getElementById(to).innerHTML = el.value.length; }
function viewTextSite(el,to){ 	document.getElementById(to).innerHTML = viewTextSite(el.value);}

  // 문자열 길이 구하기....
function calByte(msg) {
   var t;
   var msgLen = 0;

   for(var i = 0; i < msg.length; i++) {
      t = msg.charAt(i);

      if(escape(t).length > 4)
         msgLen += 2;
      else if(t != "\r")
         msgLen++;
   }

   return msgLen;
}

function $alertLoginMessage(msg){
	if(msg==undefined) var msg = "로그인 후 이용가능합니다.";
	var loginURL ="?pCode=login&url=" + encodeURIComponent(document.location.href);
	//$(document).ready(function(){
		var loginFrmWin = new msgPopupWin({w:"300px",h:"200px",setStyle:true,title:"Login Message!",clickClose:false,transparent_bg:true,setCloseBtn:false});
		var printMsg = msg.replace(/\b\n\b/i,'<br/>');
		loginFrmWin.setContents("<div class='popErrorBox'><div class='popErrorMsg'><div class='c pad20t '>"+printMsg+" <div class='c pad20t'><a href='"+loginURL+"' class='cp-btn'><span>로그인</span></a> <button type='button'  onclick='history.go(-1);' class='cg-btn'><span>뒤로</span></button></div></div></div><div class='popErrorBtns'></div></div>");
	//});
}

function trim(v){	return	$.trim(v); }

function goPDFViewerPage(frmID,n){
	//var frm = $("iframe[name='ifrmPDFView"+frmID+"']",document).get(0);
	//var doc = frm;
	eval("ifrmPDFView"+frmID+".window.goPDFPageTo("+n+");");
	/*Full Version
	var iframe1 = document.getElementById("ifrmPDFView"+frmID);
	// Handle the user inputting a floating point number.
	iframe1.contentWindow.PDFViewerApplication.page = n;

	*/
//	doc.goPDFPageTo(n);
}


if(typeof(getDataAttribute)!="function"){
	var getDataAttribute = function (el,fld){
		if(typeof( $(el).attr("data-"+fld)) !="undefined") return  $(el).attr("data-"+fld);
		else return $(el).attr(fld);
	}
}

/////// data-option 처리 /////////
$(document).on("keyup","input[data-option='number']", function() {
	$(this).val($(this).val().replace(/[^0-9]/g,""));
	//this.value = comma(this.value);
});

$(document).on("keyup","input[data-option='money']", function(event) {
	$(this).val($(this).val().replace(/[^0-9,\.]/g,""));
	let v = uncomma(this.value);
	if(v=="") return;
	let tmp = v.split('.');
	v = tmp[0] * 1;
	if(tmp.length > 1){
		v = v + '.' + tmp[1];
	}
	this.value = comma(v);
});

function number_format(data)
{

    var tmp = '';
    var number = '';
    var cutlen = 3;
    var comma = ',';
    var i;
    if(parseInt(data)==0) return 0;
    data = String(data);
    len = data.length;
    mod = (len % cutlen);
    k = cutlen - mod;
    for (i=0; i<data.length; i++)
    {
        number = number + data.charAt(i);

        if (i < data.length - 1)
        {
            k++;
            if ((k % cutlen) == 0)
            {
                number = number + comma;
                k = 0;
            }
        }
    }

    return number;
}

//입력한 문자열 전달
function inputNumberFormat(obj) {
    //obj.value = comma(uncomma(obj.value));

    $(obj).val(function(index, value) {
        return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    });
}

//콤마찍기
function comma(str) {
	str = String(str).split(".");
	if(str.length>1)    return str[0].replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,')+"."+str[1];
	else				return str[0].replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
}

//콤마풀기
function uncomma(str) {
    str = String(str).split(".");
	if(str.length>1)    return str[0].replace(/[^\d]+/g, '')+"."+str[1];
	else				return str[0].replace(/[^\d]+/g, '');
}

// 콜백 함수
function callbackS_CloseAndOpenerReload(r){
	var rst = $.trim(r).split("|");
	console.log(r);

	if(typeof(rst[1])!=="undefined"){
		alert(rst[1]);
	}
	opener.location.reload();
	self.close();
}

function formConfirm(f, str) {
    var $f = $(f);
    if(confirm(str)){
		//$f.submit();
		return true;
	}
	return false;
}

function formConfirmAfterCheck(f, str) {
    var $f = $(f);
    var chk1 = $("#chk_msg1").prop("checked");
    var chk2 = $("#chk_msg2").prop("checked");
    var chk3 = $("#chk_msg3").prop("checked");
    var chk4 = $("#chk_msg4").prop("checked");

    if(chk1 && chk2 && chk3 && chk4){

	}else{
    	alert("메세지를 모두 확인하신 후 가능합니다.");
    	return false;
	}

	return confirm(str);
}

function clock(target_id) {
    let date = new Date();
    let year = date.getFullYear();
    let month = date.getMonth();
    let clockDate = date.getDate();
    let day = date.getDay();
    let week = ['일', '월', '화', '수', '목', '금', '토'];
    let hours = date.getHours();
    let minutes = date.getMinutes();
    let seconds = date.getSeconds();
    if(!target_id) target_id = "clockTarget";
    $("#"+target_id).text("${year}년 ${month + 1}월 ${clockDate}일 (${week[day]}) " +
        "${hours < 10 ? '0${hours}' : hours}:${minutes < 10 ? '0${minutes }' : minutes }:${seconds < 10 ? '0${seconds }' : seconds }");
}
var util = {
	init : function() {
	},
	alertWsize : function() {
		alert( $(window).width() + " / " + $(window).height() );
		// 갤탭 768 * 896
	},
	isPC : function() {
		var filter = "win16|win32|win64|mac|macintel";
		if ( navigator.platform ) {
			if ( filter.indexOf( navigator.platform.toLowerCase() ) < 0 ) {
				return false;
			} else {
				return true;
			}
		}
	},
	isIOS : function() {
		var varUA = navigator.userAgent.toLowerCase();
		if (varUA.indexOf("iphone")>-1||varUA.indexOf("ipad")>-1||varUA.indexOf("ipod")>-1) {
			return true;
		} else {
			return false;
		}
	},
	isAND : function() {
		var varUA = navigator.userAgent.toLowerCase();
		if (varUA.match('android') != null) {
			return true;
		} else {
			return false;
		}
	},
	isNull : function( $obj ) {
		if ( typeof $obj != "undefined" && $obj != null && $obj != "" ) {
			return false;
		} else {
			return true;
		}
	},
	Eraser : function( $obj, type ) {
		if ( type == "hide" ) {
			$obj.hide();
		} else if ( type != "hide" ) {
			$obj.addClass( type );
		}
	},
	conBottomEraser : function( $obj ) {
		$obj.css({ "padding-bottom":0, "margin-bottom":0 });
	},
	getQueryStr : function( paramName ) {
		var _tempUrl = window.location.search.substring(1);	// ** url에서 처음부터 ? 제외 uri
		var returnVal = "";
		if ( _tempUrl == "" ) {
			returnVal = "fail";
		} else if ( _tempUrl.indexOf("&") >= 0 || _tempUrl.indexOf("?") >= 0 ) {
			var _tempArray = _tempUrl.split("&");
			for ( var i=0; i<_tempArray.length; i++ ) {
				var _keyValuePair = _tempArray[i].split("=");
				if ( _keyValuePair[0] == paramName ) {
					returnVal = _keyValuePair[1];
				}
			}
		} else {
			var _tempArray = _tempUrl.split("=");
			if ( _tempArray[0] == paramName )	returnVal = _tempArray[1];
		}
		return returnVal;
	},
	isLang : function() {
		$pageUri = location.href;
		if ( $pageUri.indexOf("/kor/") > 0 ) return "kor";
		else if ( $pageUri.indexOf("/eng/") > 0 ) return "eng";
	},
	getNumberOnly : function(str_txt) {
		val = new String(str_txt);
		var regex = /[^0-9]/g;
		val = val.replace(regex, '');
		return val;
	},
	getHash : function() {
		if (window.location.hash) {
			var hashVal = "";
			var hash = window.location.hash.substring(1);
			if (hash.length === 0) {
				return false;
			} else {
				if ( hash.indexOf("&") >=0 ) {
					hashVal = hash.split("&")[0];
				} else {
					hashVal = hash;
				}
				return hashVal;
			}
		} else {
			return false;
		}
	},
	frontEndTrimming : function( s ) {
		s += ''; // 숫자라도 문자열로 변환
		return s.replace(/^\s*|\s*$/g, '');
	},
	convertTimestamp : function( $obj ) {	// ** 타임스탬프 형식으로 변경.
		var dateTmp;
		var convertTimeStamp;
		if ( typeof $obj == "object" ) {
			var cArrayIdx = 0;
			var convertResult = new Array();
			$.each( $obj, function( index, item ) {
				if(item != null){
					dateTmp = item.split("-");
					convertTimeStamp = dateTmp[1] + "/" + dateTmp[2] + "/" + dateTmp[0];
					convertResult[cArrayIdx] = new Date( convertTimeStamp ).getTime();
					cArrayIdx++;
				}
			});
		} else if ( typeof $obj == "string" ) {
			var convertResult = "";
			dateTmp = $obj.split("-");
			convertTimeStamp = dateTmp[1] + "/" + dateTmp[2] + "/" + dateTmp[0];
			convertResult = new Date( convertTimeStamp ).getTime();
		}
		return convertResult;
	},
	convertDatestring : function( $str ) {	// ** 2019-10-21 형식으로 변경.
		var d = new Date( $str );
		var s = util.leadingZeros(d.getFullYear(), 4) + "-" + util.leadingZeros(d.getMonth() + 1, 2) + "-" + util.leadingZeros(d.getDate(), 2);
		return s;
	},
	leadingZeros : function( n, digits ) {	// ** 리딩제로 형식으로 변경.
		var zero = '';
		n = n.toString();
		if ( n.length < digits ) {
			for ( i=0; i<digits-n.length; i++ )	zero += '0';
		}
		return zero + n;
	}
}

if (!String.prototype.padStart) {
    String.prototype.padStart = function padStart(targetLength,padString) {
        targetLength = targetLength>>0; //truncate if number or convert non-number to 0;
        padString = String((typeof padString !== 'undefined' ? padString : ' '));
        if (this.length > targetLength) {
            return String(this);
        }
        else {
            targetLength = targetLength-this.length;
            if (targetLength > padString.length) {
				console.log(typeof(padString));
                padString += padString.repeat(targetLength/padString.length); //append to original to ensure we are longer than needed
            }
            return padString.slice(0,targetLength) + String(this);
        }
    };
}

function num2han(num) {
	var str = "";

	$.ajax({
        url : '/Share/ajaxFunction.php',
        async: false,
        type : 'get',
        data: {fn:"price_kor",param:num},
        dataType : 'html', //json, html, xml 기타등등
        error : function(response, status, error){ //ajax url 호출 실패
            return;
        },
        success : function(data){
        //ajax url 호출 성공
			console.log(data);
			str = data;
        }
    });

	return str;
	//console.log("num2han");
// 	num = parseInt((num + '').replace(/[^0-9]/g, ''), 10) + '';  // 숫자/문자/돈 을 숫자만 있는 문자열로 변환
//   if(num == '0')
//     return '영';
//   var number = ['영', '일', '이', '삼', '사', '오', '육', '칠', '팔', '구'];
//   var unit = ['', '만', '억', '조'];
//   var smallUnit = ['천', '백', '십', ''];
//   var result = [];  //변환된 값을 저장할 배열
//   var unitCnt = Math.ceil(num.length / 4);  //단위 갯수. 숫자 10000은 일단위와 만단위 2개이다.
//   num = num.padStart(unitCnt * 4, '0')  //4자리 값이 되도록 0을 채운다
//   var regexp = /[\w\W]{4}/g;  //4자리 단위로 숫자 분리
//   var array = num.match(regexp);
//   //낮은 자릿수에서 높은 자릿수 순으로 값을 만든다(그래야 자릿수 계산이 편하다)
//   for(var i = array.length - 1, unitCnt = 0; i >= 0; i--, unitCnt++) {
//     var hanValue = _makeHan(array[i]);  //한글로 변환된 숫자
//     if(hanValue == '')  //값이 없을땐 해당 단위의 값이 모두 0이란 뜻. 
//       continue;
//     result.unshift(hanValue + unit[unitCnt]);  //unshift는 항상 배열의 앞에 넣는다.
//   }
//   //여기로 들어오는 값은 무조건 네자리이다. 1234 -> 일천이백삼십사
//   function _makeHan(text) {
//     var str = '';
//     for(var i = 0; i < text.length; i++) {
//       var num = text[i];
//       if(num == '0')  //0은 읽지 않는다
//         continue;
//       str += number[num] + smallUnit[i];
//     }
//     return str;
//   }
//   return result.join('');
}

//입력값 byte 체크
function OnkeyCnt(msg)
{
	var len = 0;
	var str;

	var count = 0;
	var temp;


	str = new String(msg);

	len = str.length;


	for (k=0 ; k < len ; k++){
		temp = str.charAt(k);
		if (escape(temp).length > 4) {
			count += 1;
		}
		else if (temp == '\r' && str.charAt(k+1) == '\n') { // \r\n일 경우
			count += 1;
		}
		else if (temp != '\n') {
			count += 0.5;
		}
	}

	return count;
}

//글자수 자르기
function CutChar(msg, maxCnt) {
	var len=0;
	var count = 0;
	var temp;
	str = new String(msg);
	len = str.length;


	for(k=0 ; k < len ; k++) {
		temp = str.charAt(k);
		if(escape(temp).length > 4) {
			count += 1;
		}

		else if (temp == '\r' && str.charAt(k+1) == '\n') { // \r\n일 경우
			count += 1;
		}
		else if(temp != '\n') {
			count += 0.5;
		}

		if(count > parseInt(maxCnt) ) {

			str = str.substring(0,k);
			break;
		}
	}
	return str;
}
