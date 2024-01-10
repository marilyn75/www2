(function( factory ) {
	if ( typeof define === "function" && define.amd ) {
		define([ "jquery" ], factory ); // AMD. Register as an anonymous module.
	} else {
		factory( jQuery ); // Browser globals
	}
}(function( $ ) {

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

function FormUploader() {


	//this.err_code 
	this._defaults = {
		debug : false
		, css_url : "/css/common.multiFileUpload.css"
		, upload_url : "/common/multiFileUpload/upload"	//업로드 경로
		, download_url : "/common/multiFileUpload/download"	//업로드 경로
		, delete_url : "/common/multiFileUpload/delete"	//삭제실행 경로

		, upload_form : null

		, post_parameters : {}
		, org_file_items : {}

		
		, limit_max_file_cnt : 1
		, upload_sucess_file_cnt : 0
		, limit_file_size : (1024 *  2 * 1024)	//1개 파일 업로드 제한용량
		, limit_max_file_size : (1024 *  200 * 1024 )//전체 용량 제한


		, upload_form_target:""
		, upload_complete_func : function () {}
		, insert_file_item_end : function () {}
		, upload_call_back_function : null
		, download_call_back_function : null
		, delete_call_back_function : null

		, file_list_target:null
		, item_list_element:"li"
		, auto_upload:false
		, upload_btn_label : "파일 업로드"
		, to_content : false //본문추가 사용
		, use_view_btn:true
		, use_down_btn:true
		, use_file_cont:true
		, use_sort:true
		, label_text : {
			"addcont":"본문추가","view":"보기","delete":"삭제","filecont":"파일설명","download":"다운로드","upload_msg":"업로드 진행중입니다.업로드 완료후 다시 시도하세요","nofile":"파일이 없습니다","close":"닫기","dftimg":"대표사진"}
	};


}

$.extend(FormUploader.prototype, {
	setDefaults: function(settings) {
		
		formuploader_extendRemove( this._defaults, settings || {});
		return this;
	}
	,_initFormUploader:function(target,settings){
		var this_s = this;


		var targetNodeName = target.nodeName.toLowerCase();
		var inline = (targetNodeName === "div" || targetNodeName === "span");

		this.settings = $.extend({}, this._defaults, settings || {});

		this.target = target;
		this.total_file_size = 0;
		this.total_file_cnt = 0;


		
		//스타일 적용
		$( "body" ).prepend( "<link rel='stylesheet' href='"+this.settings.css_url+"' />" );
		$( "body").prepend( "<script type='text/javascript' src='/js/jquery.form.min.js'></script>" );
		
		inst = this._newInst($(target), inline);
		inst.settings = this.settings;
		$.data(target, "fileuploader", inst);

		this._createUploadForm(  inst );

		


		var file_top_info = $("<div></div>");
		file_top_info.addClass("mfu-top");
		file_top_info.appendTo(target);

		var file_selec_btn = $("<button/>");
		file_selec_btn
			.attr("type","button")
			.text(this.settings.upload_btn_label)
			.addClass("mfu-fsel-bt")
			.on("click",function(){

				if(!this_s.fileAPI){
					if( this_s.checkFileUploadState().upload  ){
						alert("업로드 진행중입니다.업로드 완료후 다시 시도하세요");
						return false;
					}else{
						this_s.settings.upload_form.find("[name='mupfile']").click();
					}
				}else{
					$(this_s.target).find("[name='mupfile']").click();

				}

		});
		file_selec_btn.appendTo(file_top_info);


		var file_limit_info =  $("<div></div>");
		file_limit_info.addClass("mfu-limit-info").addClass("info");
		file_limit_info.append("<div class='mfu-fsize-info'>File Size (<span class='mfu-use-size'></span>/<span class='mfu-max-fsize'></span>)</div>");
		file_limit_info.append("<div class='mfu-fcnt-info'>File Count (<span class='mfu-use-cnt'></span>/<span class='mfu-max-cnt'></span>)</div>");

		file_limit_info.appendTo(file_top_info);

		
		this.fileAPI = $("<input type='file'/>").get(0).files !== undefined;
		if(!this.fileAPI){
			//fileAPI 미지원시 자동 업로드 사용
			inst.settings.auto_upload = true;
		}
		
		//업로드 파일 폼 생성
		this._createUploadFileElement(inst);
		


		if(this.settings.file_list_target==null){
			var file_list_target = $("<ul />");
			file_list_target.addClass("mfu-file-list");
			file_list_target.append("<li class='no-file'>선택된 파일이 없습니다.</li>");
			file_list_target.appendTo(target);
			
			if(this.settings.use_sort)		$(file_list_target).sortable({});
			this.settings.file_list_target = file_list_target;

			//this.settings.file_list_target = $("");
		}
		
	
		this._printFileInfoText();

		

		if( inst.settings.org_file_items.length > 0 ){
			for (var ii=0;ii< inst.settings.org_file_items.length; ii++)
			{
				var orgFileData = $.extend({},{"is_org":true,"state":"complete"},inst.settings.org_file_items[ii]);
				//console.log(orgFileData);
				this.addFileInfoItem( inst.settings.file_list_target ,orgFileData , "" );
			}

		}

		$(window).resize(function(){
			this_s._resize();
		});


	}
	,_createUploadFileElement:function(inst){
		var this_s = this;
			//File Selector Form Init
		var file_select_form =  $("<input />");
		file_select_form
			.attr("type","file")
			.attr("multiple","true")
			.addClass("dft-style")
			.css({"visibility":"hidden","width":"1px","height":"1px","overflow":"hidden","position":"absolute","left":"-9999em","top":"-9999em"})
			.attr("name","mupfile");
		file_select_form.bind("change",function(){
			
			if(this.value!="") 	this_s._fileSelect(this);
			
		});
		file_select_form.bind("click",function(){
			
			if(this.value!=""){
				this.value="";
			
			}
			
//			alert(this.value);
			//$(this).attr("value","");
		});

		
		if(this.fileAPI){
			
			file_select_form.appendTo(this_s.target);
		}else{
			
			
			this_s.settings.upload_form.find("[name='mupfile']").remove();
			file_select_form.appendTo(this_s.settings.upload_form);
		}

	}
	,_fileSelect:function(file){
		
		

		//var selfile = ()?

		var	inst = this,
				filedata_list = [],fileform_list = [],
				err = [],
				files = file.files || [{
							name: file.value.replace(/^C:\\fakepath\\/gi,''),
							size: 0,
							type: ((file.value || '').match(/[^\.]+$/i) || [''])[0]
							
						}];
		
		var tmp_total_fsize = this.total_file_size;


		$(files).each(function(fi,sfile){
			var file_err = inst._fileCheck(sfile);

			console.log(inst.total_file_cnt);
			tmp_total_fsize += sfile.size;

			if(file_err){
				err.push(file_err);
				//inst.errMsg[file_err];
			}else if(inst.total_file_cnt>= inst.settings.limit_max_file_cnt){
				err.push(sfile.name +":" + "업로드 제한 갯수("+inst.settings.limit_max_file_cnt+" 개)를 초과하여 추가할 수 없습니다.");
			}else if(tmp_total_fsize >= inst.settings.limit_max_file_size){
				err.push(sfile.name +":" + "업로드 제한 용량("+file_size(inst.settings.limit_max_file_size)+" )을 초과하여 추가할 수 없습니다.");
			}else{
				
				filedata_list.push(sfile);

				//if(!this.fileAPI){sfile = lowfile;}
				//fileform_list.push(lowfile);
				
				inst.addFileInfoItem(inst.settings.file_list_target,sfile,inst.settings.auto_upload);

			}
		});
		
		//파일선택폼 초기화
		file.value="";

		if(err.length>0) this._printErrorMessage(err);
		if(filedata_list.length>0) {
			this.filedata = filedata_list;				
		}
	}
	
	,_fileCheck:function(sfile){
		var inst = this;

		//파일 용량 체크
		if(inst.settings.limit_file_size>0 && sfile.size > inst.settings.limit_file_size){
			return sfile.name +":" + "업로드 제한용량("+file_size(inst.settings.limit_file_size)+") 초과하여 추가할 수 없습니다.";
		}

		//파일 유형 체크
		

		return "";

	}
	,_printErrorMessage:function(errList){
		if(errList.length<1) return;
		alert(errList.join("\n"));
	}

	//본문추가 폼 
	,toggleFileContForm:function($li){


		if($li.hasClass('cont-open')){
			$li.removeClass('cont-open');
			$li.find(".mfu-fcont").stop().animate({"right":"-120%"},300,function(){
				$li.find(".bt-cont").focus();
				$(this).css({"display":"none"});
				$(this).find("input[type='text']").eq(0).focus();
			});
			
		}else{
			
			$(".mfu-file-list li").not($li).removeClass('cont-open');
			$li.addClass('cont-open');
			$li.find(".mfu-fcont").stop().css({"display":"block"}).animate({"right":"-65px"},300,function(){
				$(this).find("input[type='text']").eq(0).focus();
			});			

		}

	}

	//모바일 기능 버튼
	,toggleFileCtrlForm:function($li){
		if($li.hasClass('ctrl-open')){
			$li.removeClass('ctrl-open');
			$li.find(".mfu-ctrls").stop().animate({"right":"-120%"},300,function(){$(this).css({"display":"none"})});
			
		}else{
			$(".mfu-file-list li").removeClass('cont-open');
			
			$(".mfu-file-list li").not($li).removeClass('ctrl-open');
			$(".mfu-file-list li").not($li).each(function(){
				$(this).find(".mfu-ctrls").stop().css({"display":"none"}).animate({"right":"-120%"},300,function(){});
			});
			$li.addClass('ctrl-open');

			$li.find(".mfu-ctrls").stop().css({"display":"block"}).animate({"right":"-65px"},300,function(){
				$(this).find("button,a,input").eq(0).focus();
			});

			//$li.find(".ctrl-open").stop().animate({"right":"-120%"},300,function(){
				
			//});

		}


	}
	,addToContent:function($item){

		var fileext =  $item.data("filedata").type;

		var fileurl = $item.data("filedata").fileViewUrl;
		var fileContText =  $item.find("[name='tmpfile_cont[]']").length>0? $item.find("[name='tmpfile_cont[]']").val() : "";

		if(jQuery.inArray(fileext.trim(),["jpg","gif","png","bmp"]) >=0){
			var to_source = "<img src='"+fileurl+"' alt='"+fileContText+"'/>";

		}else{
			var contText = fileContText? fileContText : $item.data("filedata").orgFileName;
			
			var to_source = "<a href='"+fileurl+"' target='_blank' class='sw-btn'><span>"+contText+"</span></a>";

		}
		inst.settings.to_content_func(to_source);


	}
	
	,addFileInfoItem:function(target,filedata,upload){
		var inst = this;
		var mfu_item_id =  "mfu-item-"+(new Date().getTime());
		
		var fileinfoItem = document.createElement(this.settings.item_list_element);
		
		target.find(".no-file").remove();
		
		

		//본문추가 기능 추가
		var filecont_inputs = null;
		var filecont_bt ;

		if(inst.settings.use_file_cont || inst.settings.to_content){
			filecont_inputs = $("<div class='mfu-fcont'></div>");
			filecont_inputs.append($("<span class='isFileAlt'></span>").append(
				$("<input type='text' class='text' name='tmpfile_cont[]' placeholder='"+inst.settings.label_text["filecont"]+"' value='' hname='"+inst.settings.label_text["filecont"]+"' />").on("keypress",function(){
				if(event.keyCode==13){
					var $item =$($(this).parents(".file-item").get(0)); 
					inst.addToContent($item);
					return false;
				}

			})));
			if(inst.settings.to_content) {
				filecont_inputs.append(
						$("<button type='button' class='bt-add-cont' ><span>"+inst.settings.label_text["addcont"]+"</span></button>")
							.on("click",function(){
								var $item =$($(this).parents(".file-item").get(0)); 
								inst.addToContent($item);
							})

				);
				filecont_bt = $("<button type='button' class='bt-cont'><span>"+inst.settings.label_text["addcont"]+"</span></button>");
			}else{
				filecont_bt = $("<button type='button' class='bt-cont'><span>"+inst.settings.label_text["filecont"]+"</span></button>");
			}



			filecont_bt.hide().on("click",function(){			inst.toggleFileContForm($($(this).parents("li").get(0)));			});

			filecont_inputs.append($("<button type='button' class='bt-cont-close' ><span>"+inst.settings.label_text["close"]+"</span></button>").on("click",function(){	inst.toggleFileContForm($($(this).parents("li").get(0)));	}));

		}



		//컨트럴 버튼
		var ctrlButtons = $("<div class='mfu-ctrls'></div>");
		

		//대표사진 지정기능 추가
		/*
		var dftimg_bt ;

		ctrlButtons.append($("<button type='button' ><span>"+inst.settings.label_text["dftimg"]+"</span></button>").addClass("bt-chkimg").hide().on("click",function(){
			alert("ㅠㅠ");
			var $item =$($(this).parents(".file-item").get(0)); 
			var fileurl = $item.data("filedata").fileViewUrl;
			//window.open(fileurl);
	
		}));
		*/

		

		if(inst.settings.use_file_cont || inst.settings.to_content){
			ctrlButtons.append(filecont_bt);
		}



		if(inst.settings.use_view_btn){
			ctrlButtons.append($("<button type='button' ><span>"+inst.settings.label_text["view"]+"</span></button>").addClass("bt-view").hide().on("click",function(){
				var $item =$($(this).parents(".file-item").get(0)); 
				console.log($item);
				var fileurl = $item.data("filedata").fileViewUrl;
				window.open(fileurl);
		
			}));

		}
		if(inst.settings.use_down_btn){
			ctrlButtons.append($("<button type='button' ><span>"+inst.settings.label_text["download"]+"</span></button>").addClass("bt-down").hide().on("click",function(){
				var $item =$($(this).parents(".file-item").get(0)); 

				if(typeof($item.data("filedata").is_org)!="undefined" &&$item.data("filedata").is_org== true){
					var fileurl = $item.data("filedata").fileDownUrl;
					window.open(fileurl);
				}else{
					var fileurl = inst.settings.tmp_file_down_url($item.data("filedata"));
					window.open(fileurl);
				}
			
		
			}));
		}

		ctrlButtons.append($("<button type='button' ><span>삭제</span></button>").addClass("bt-del").on("click",function(){
				inst.deleteFileInfoItem(inst.target,$($(this).parents(".file-item").get(0)));
		}));



		$(fileinfoItem)
			.addClass("file-item")
			//.addClass("chk-img")
			.attr("id",mfu_item_id)
			.data("sfile",filedata)
			.append("<input type='hidden' name='tmpfile_idx[]' value=''>")
			.append(
				$("<div></div>").addClass("mfu-finfo")
					.append("<span class='isFileTypeIcon'>"+inst.getFileTypeIcon( filedata.name , (typeof(filedata.is_org)!="undefined" && filedata.is_org== true)? "complete":"ing")+"</span>")
					.append("<span class='isImgCheck'></span>")
					.append("<span class='isFileName'>"+filedata.name+"</span>")
					.append(
						$("<div class='isFileInfo'></div>")
						.append("<span class='mfu-fsize'>"+file_size(filedata.size)+"</span>")
						.append("<span class='mfu-state'>"+( filedata.is_org==true ? ( typeof(filedata.upload_date)!="undefined" && filedata.upload_date  !="" ? "Date : "+filedata.upload_date  : ""):"대기")+"</span>")
					)
			)
			

			.append(ctrlButtons);
		
		if(filecont_inputs!=null){
			$(fileinfoItem).append(filecont_inputs);
		}


		$(fileinfoItem)
			.append("<span class='mfu-progress'><span class='bar'></span><span class='txt'></span></span>")	
			.append($("<button type='button'><span>More</span></button>").addClass("bt-ctrl-more").on("click",function(){
				inst.toggleFileCtrlForm($($(this).parents(".file-item").get(0)));
			}));
			

		
		

		if(filedata.is_org) {
			$(fileinfoItem).data("state","complete")
			.data("is_org",filedata.is_org)
			.data("filedata",filedata) 
			.data("sfile",null);

			$(fileinfoItem).find("[name='tmpfile_idx[]']").val("O"+filedata.fidx);
			$(fileinfoItem).find("[name='tmpfile_cont[]']").val(filedata.content || "");
			this.showFileCtrlButtons($(fileinfoItem));
		}

		target.append($(fileinfoItem));

		//기존 파일 일경우
		//if(filedata.is_org
		
		this.total_file_cnt ++;
		this.total_file_size += (filedata.size*1);
		this._printFileInfoText();

		if(upload){
			this.fileUpload(filedata,fileinfoItem);
		}
		
	}
	,deleteFileInfoItem:function(target,item,server_del){
		var fileitem  =(typeof(item)=="string")? $("#" + item) : $(item);

		var filedata = typeof(fileitem.data("filedata"))!="undefined"? fileitem.data("filedata") :  fileitem.data("sfile");

		
		this.total_file_cnt --;
		this.total_file_size -=  (filedata.size*1);

		this._printFileInfoText();

		if(server_del  ){
			this.fileDelete(fileitem.data("filedata"));
		}
		if(fileitem.data("is_org")==true){
			$(target).append($("<input type='hidden' name='del_fidx[]'/>").val(filedata.fidx));
		}

		fileitem.remove();

	
		if($(".file-item",this.settings.file_list_target).length<1){
			this.settings.file_list_target.append($("<li class='no-file'>"+this.settings.label_text.nofile+"</li>"));
		}

	
		
	}
	,uploadCompleteSubmit:function(){

		this.settings.upload_complete_func();

		//alert("Complete!!");

	}
	,checkFileUploadState:function(){
		var inst = this;

		var upload_complete_cnt = 0, upload_waite_cnt=0;

		var filelist = $(".file-item",this.target);

		for (var ii=0;ii<filelist.length ;ii++ )
		{
			
			var $this = $(filelist[ii]);
			//if($this.data("state")
			if( $this.data("is_org")!=true && (typeof($this.data("sfile"))=="undefined" || $this.data("sfile")==null)){
				//alert("업로드 파일 정보가 확인되지 않습니다");
				//break;
			}else{
				if($this.data("state")=="upload"){
					upload_waite_cnt++;
					//break;
				}else if($this.data("state")=="complete"){
					upload_complete_cnt++;
				}else{
					if(this.fileAPI) {inst.fileUpload($this.data("sfile"),$this,true,submitMode);break;}
					else{
						//alert("업로드 대기중이거나 업로드 불가능한 파일이 포함되어있습니다.\n업로드 상태를 확인하신 후 다시 시도해주세요");
						//break;
					}

				}
				//console.log($this.data("state"));
			}
		
		}

		return {"upload": (upload_waite_cnt>0? true:false) };

	}
	,fileUploadAll:function(submitMode){
		if(typeof(submitMode)=="undefined") var submitMode = true;
		var inst = this;

		var upload_complete_cnt = 0, upload_waite_cnt=0;

		//파일 업로드 목록 찾기, 1개씩 업로드
		var filelist = $(".file-item",this.target);

		for (var ii=0;ii<filelist.length ;ii++ )
		{
			
			var $this = $(filelist[ii]);
			//if($this.data("state")
			if( $this.data("is_org")!=true && (typeof($this.data("sfile"))=="undefined" || $this.data("sfile")==null)){
				alert("업로드 파일 정보가 확인되지 않습니다");
				break;
			}else{
				if($this.data("state")=="upload"){
					upload_waite_cnt++;
					break;
				}else if($this.data("state")=="complete"){
					upload_complete_cnt++;
				}else{
					if(this.fileAPI) {inst.fileUpload($this.data("sfile"),$this,true,submitMode);break;}
					else{
						alert("업로드 대기중이거나 업로드 불가능한 파일이 포함되어있습니다.\n업로드 상태를 확인하신 후 다시 시도해주세요");
						break;
					}

				}
				//console.log($this.data("state"));
			}
		
		}

		if(submitMode){
		if(filelist.length==upload_complete_cnt ){
			//$("body").delay(500);
			this.uploadCompleteSubmit(); 
			//setTimeout(function(){ },100);
			
		}else if(upload_waite_cnt>0){
			$alert("업로드중입니다.업로드가 완료될 때까지 기다려주세요");
			//alert("업로드해주세요");
		}
		}
		
		/*
		filelist.each(function(fi,sfile){

			
		});
		*/



	}
	,_createUploadForm:function(inst){
		
		var file_upload_form =$("<form />");
		file_upload_form
			.attr("method","post")
			.attr("enctype","multipart/form-data")
			.attr("action",this.settings.upload_url);

		if(inst.settings.upload_form_target!=""){
			file_upload_form.attr("target",inst.settings.upload_form_target);
		}

		

		// 파라미터로 보낼 기본 파라미터 셋팅
		var parameters = inst.settings.post_parameters;
		if(parameters.length>0){
            file_upload_form.append(
                $("<input/>")
                    .attr("type","hidden")
                    .attr("name",'_token')
                    .attr("value",$("input[name='_token']").val())
            );
			$.each(parameters,function( i, arr ){
				file_upload_form.append(
						$("<input/>")
							.attr("type","hidden")
							.attr("name",arr.name)
							.attr("value",arr.value)
				);
			});


		}

		$("body").append(file_upload_form);
		this.settings.upload_form = file_upload_form;

	}
	,fileUpload:function(file,item,callback,submitMode){	//업로드 시작
		var inst = this;
		

		//inst.settings.upload_form.find("[name='mupfile']").remove();

		if(file.e!=null){
			//alert("fileValue"+$(file.e).val());

			//file.e.attr("name","mupfile").val($(file.e).val());
			//inst.settings.upload_form.append(file.e);
		}

		console.log("fileUploadStart ");

		var fileitem = $(item);
	
		
		$( inst.settings.upload_form ).ajaxForm({

	        beforeSubmit: function (data,form,option) {

				//File Data Add
				try{
					if(inst.fileAPI){
					data.push({name: "mupfile", value: file, type: "file"});
					}else{
					//	return false;
					}
				}catch(e){
					alert(e);
				}
				//업로드 상태 체크
				fileitem.data("state","upload");
				fileitem.find(".mfu-progress").show();
				fileitem.find(".mfu-state").text("업로드중");

				console.log(fileitem.data("filedata"));

				fileitem.find(".isFileTypeIcon").html(inst.getFileTypeIcon( "" ,"ing"));
			

	        },
			uploadProgress: function(event, position, total, percentComplete) {
				console.log("percentComplete : "+percentComplete);
				var percentVal = percentComplete + '%';
				fileitem.find(".mfu-progress").find(".bar").width(percentComplete+"%");
			},

	        success: function(response,status){
				//console.log("call submit success");
console.log(response);
				if(response.indexOf("<")==0){
					//var rstHtml = $(response).find(text();
					var r = {"result":false,"msg":"업로드할 수 없습니다.","size":0};
				}else{
					var r = jQuery.parseJSON(response);
				}
				if(r.result){
					fileitem.data("state","complete");
					fileitem.find(".mfu-state").text("업로드완료");
					inst.setUploadFileInfo(fileitem,r);
					fileitem.find(".isFileTypeIcon").html(inst.getFileTypeIcon( r.orgFileName ,"complete"));


					if(fileitem.find(".mfu-progress").length>0){
						fileitem.find(".mfu-progress").delay(300).hide("fadeOut",function(){

							inst.showFileCtrlButtons(fileitem);
						});
					}else{
						inst.showFileCtrlButtons(fileitem);
					}


				}else{
					fileitem.data("state","error");
					fileitem.find(".mfu-state").html("<span class='cred'>업로드실패</span>");
					fileitem.find(".isFileTypeIcon").html(inst.getFileTypeIcon( "" ,"fail"));
					alert(r.msg);
				
				}

				inst.updateFileItemState(fileitem,r);

				// 파일업로드가 완료되면 사용자가 설정한 함수를 태움
				if( inst.settings.upload_call_back_function != null ){
					inst.settings.upload_call_back_function( inst, fileitem,r, status );
				}
	        },
	        complete : function(param) {

	
//				inst.settings.upload_form.find("[name='mupfile']").remove();
				if(!inst.fileAPI) inst._createUploadFileElement(inst);

				if(typeof(callback)!="undefined" && callback==true){
					if(inst.fileAPI)	{		inst.fileUploadAll(submitMode); }
				}
	        },
	        error: function(r){
				//console.log("submit error" +r.responseText);
	            //에러발생을 위한 code페이지
				fileitem.data("state","fail");
				alert("업로드 에러!" +r.responseText);
				fileitem.find(".mfu-state").text("Error");
	        }                         
	    });
		
		inst.settings.upload_form.submit();
		

	}
	,updateFileItemState:function(fileitem,rst){
		var state = $(fileitem).data("state");
		if(state=="error"){
			fileitem.find(".mfu-progress").stop().hide("fadeOut");
		}else if(state=="upload"){
			fileitem.find(".mfu-progress").stop().show("fadeOut");
		}
		

		if(fileitem.data("sfile").size !=rst.size){
			fileitem.data("sfile").size = rst.size;
			fileitem.find(".mfu-fsize").text(file_size(rst.size));
		}

		this._updateUploadResultFileInfo();
	}
	,setUploadFileInfo:function(fileitem,fileinfo){
		var filedata = $.extend({},{},fileinfo);
		fileitem.data("filedata",filedata);
		fileitem.find("[name='tmpfile_idx[]']").val(fileinfo.fileIdx);
		console.log(filedata);
	}
	,showFileCtrlButtons:function(fileitem){
		if(this.settings.to_content) fileitem.find(".bt-cont").show("fadeIn");
		fileitem.find(".bt-chkimg").show("fadeIn");
		fileitem.find(".bt-view").show("fadeIn");
		fileitem.find(".bt-down").show("fadeIn");

	}
	,_updateFileListInfo:function(){
		var files = $(".file-item");
		
		//var tmp_total_fsize = 

		$(files).each(function(fi,sfile){

			
			var file_err = inst._fileCheck(sfile);

			tmp_total_fsize += sfile.size;

			if(file_err){
				err.push(file_err);
				//inst.errMsg[file_err];
			}else if(inst.total_file_cnt>= inst.settings.limit_max_file_cnt){
				err.push(sfile.name +":" + "업로드 제한 갯수("+inst.settings.limit_max_file_cnt+" 개)를 초과하여 추가할 수 없습니다.");
			}else if(tmp_total_fsize >= inst.settings.limit_max_file_size){
				err.push(sfile.name +":" + "업로드 제한 용량("+file_size(inst.settings.limit_max_file_size)+" )을 초과하여 추가할 수 없습니다.");
			}else{
				
				filedata_list.push(sfile);

				//if(!this.fileAPI){sfile = lowfile;}
				//fileform_list.push(lowfile);
				
				inst.addFileInfoItem(inst.settings.file_list_target,sfile,inst.settings.auto_upload);

			}
		});
		

	}
	,_updateUploadResultFileInfo:function(){
		var inst = this;
		var file_err = [];
		var tmp_file_count = 0; var total_file_count = 0;
		var tmp_total_fsize = 0;var total_fsize = 0;
		$(".file-item").each(function(){
			var sfile = $(this).data("filedata") || $(this).data("sfile") ;

			//파일 체크
			//if(filedata.size>

			var file_err = inst._fileCheck(sfile);

			tmp_total_fsize += (sfile.size*1);

			

			if(file_err){
				err.push(file_err);

			}else if(tmp_file_count >= inst.settings.limit_max_file_cnt){
				err.push(sfile.name +":" + "업로드 제한 갯수("+inst.settings.limit_max_file_cnt+" 개)를 초과하여 추가할 수 없습니다.");
			}else if(tmp_total_fsize >= inst.settings.limit_max_file_size){
				err.push(sfile.name +":" + "업로드 제한 용량("+file_size(inst.settings.limit_max_file_size)+" )을 초과하여 추가할 수 없습니다.");
			}else{
				total_file_count++;
				total_fsize += (sfile.size*1);

			}

			tmp_file_count++;

			
		});
		
		this.total_file_cnt = total_file_count;
		this.total_file_size = total_fsize;

		this._printFileInfoText();

	}
	,_printFileInfoText:function(){

		$(".mfu-use-size",this.target).text(file_size(this.total_file_size));
		$(".mfu-max-fsize",this.target).text(file_size(this.settings.limit_max_file_size));

		$(".mfu-use-cnt",this.target).text(this.total_file_cnt);
		if(this.settings.limit_max_file_cnt>0)	$(".mfu-max-cnt",this.target).text(this.settings.limit_max_file_cnt).show();
		else $(".mfu-max-cnt",this.target).hide();

	}
	, _newInst: function(target, inline) {
		var id = target[0].id.replace(/([^A-Za-z0-9_\-])/g, "\\\\$1"); // escape jQuery meta chars
		return {
				id: id 
				, input: target // associated target
				, inline: inline
			};
	}
	, _getInst: function(target) {
		try {
			return $.data(target, "fileuploader");
		}
		catch (err) {
			throw "Missing instance data for this fileuploader";
		}
	}
	, _get: function(inst, name) {
		return inst.settings[name] !== undefined ?
				inst.settings[name] : this._defaults[name];
	}
	,_resize:function(){
		var w = $(this.target).width();
		//var w = $("body").width();
		//console.log(w);

		if(w>590){
			//$(this.target).find(".mfu-ctrls").stop().css({"display":"block","right":"0"});
		}else{
		}

	}


	, getFileTypeIcon:function(filename,mode){		

		var type = filename.substring(filename.lastIndexOf("."));
		var fileExt = type.toLowerCase().replace(".","");
		var fileIconExtArr ={
			"jpg":"img","jpeg":"img","jpe":"img","gif":"img","bmp":"img","png":"img"
			,"alz":"zip","zip":"zip"
			,"exe":"exe"
			,"psd":"psd"
			,"doc":"word","docx":"word"
			,"ppt":"ppt","pptx":"ppt","pptm":"ppt"
			,"pdf":"pdf"
			,"xls":"xls","xlsx":"xls"
			,"hwp":"hwp"
			,"vod":"vod"
		}
		var ficon = "";
		if(mode=="ing"){
			var ficon = "<img src='/images/Common/ficon/ing.gif' alt='파일 업로드중'/>";
		}else if(mode=="fail"){
			var ficon = "<img src='/images/Common/ficon/fail.png' alt='파일 업로드실패'/>";
		}else{
		
			if(typeof(fileIconExtArr[fileExt])!="undefined"){
				var ficon = "<img src='/images/Common/ficon/"+fileIconExtArr[fileExt]+".gif' alt='"+fileExt+" 파일'/>";
			}else{
				var ficon = "<img src='/images/Common/ficon/doc.gif' alt='"+fileExt+" 파일'/>";
			}
		}
		return ficon;
	}
	
	, setCallback : function( target, noDefault ){
		var inst = this._getInst(target);
		inst.settings.call_back_function = noDefault;
	}
});

function formuploader_extendRemove(target, props) {
	$.extend(target, props);
	for (var name in props) {
		if (props[name] == null) {
			target[name] = props[name];
		}
	}
	return target;
}

$.fn.formuploader = function(options){

console.log("formuploader"+this.length);
	if(this.length<1) return this; //quick fail
	
	var otherArgs = Array.prototype.slice.call(arguments, 1);
	/*if (typeof options === "string" && (  options === "setCallback" ) ) {
		return $.formuploader["_" + options + "_FormUploader"].apply($.formuploader, [this[0]].concat(otherArgs));
	}else
	*/
	if(typeof(options)==="string"){

		console.log([this[0]].concat(otherArgs));
		 return $.formuploader[options].apply($.formuploader, [this[0]].concat(otherArgs));
	}else return this.each(function() {
		$.formuploader._initFormUploader(this, options);
	});
}

$.formuploader = new FormUploader(); // singleton instance
$.formuploader.uuid = new Date().getTime();
$.formuploader.version = "1.01";

var formuploader = $.formuploader;

}));