;(function($, window, document, undefined)
{

	var defaults = {
				title       						: "Notice"												//  레이어 팝업 타이틀
    			, width								: "280"																//  처음 창 크기
	        	, height							: "130"																//  처음 창 크기
	        	, min_width							: "500"																//  구현 안됬음 * 차후, 모바일 지원용
        		, min_height						: "300"																//  구현 안됬음 * 차후, 모바일 지원용
        		, max_width							: "1400"															//  큰창 크기
        		, max_height						: "600"																//  큰창 크기
    			, url								: ""																	//  URL  입력 **** 필수 조건
    			, div_target						: ""
	        	, parameter							: {}																	//  파라미터 입력 시 배열로 입력
        		, top  								: "0"																	//  위치 값
        		, left   							: "0"																	//  위치 값
    			, returnObj							: null																	//  창이 닫혔을때 되돌아가는 객채 **** 필수 조건
    			, UnderReset						: false																//  구현 안됬음
    			, animate_open						: 0//"" 																//  창이 열릴때 속도(애니메이션 효과)
    			, animate_close						: 0//"0"																//  창이 닫힐때 속도(애니메이션 효과)
    			, animate_reload					: 0//"0"																//  구현 안됬음
    			, animate_move						: "slow"															//  창 사이즈 변경시 자동 이동 됨, 이때의 애니메이션 효과

    			, close_button_yn					: true
    			, reload_button_yn					: true
    			, minmaxsize_button_yn				: true
    			, pageOnLoadCallBack				: null

				, message : "Loading..."

				, show_title : true
				, back_click_close			:false
				, scroll_fix : true
        };

    function Plugin( element, options)
    {
        this.content = null;
        this.el = $(element);
        this.options = $.extend({}, defaults, options);
        this.init();

    }

    Plugin.prototype = {

        init: function() {
            var layer = this;
            
            layer.options.min_width  = layer.options.width;
            layer.options.min_height  = layer.options.height;
			
			if(this.isNullOrBlank(layer.org_scroll)){
				layer.org_scroll = {"overflow":$("body").css("overflow-x"),"overflowX":$("body").css("overflow-x"),"overflowY":$("body").css("overflow-y")};
			}
			layer.setScrollFixed();

			if(this.isNullOrBlank(layer.options.returnObj) && !this.isNullOrBlank(latestFocus) ){
				layer.options.returnObj = $(latestFocus);
			}
            
            layer.drawWindow();
            layer.showMsgPopup();
            layer.setWindowResizing();


			layer.pageLoad();           

                    
        }
    
	    , isNullOrBlank : function( val ){

	    	if( typeof(val)=="undefined" || val == null || val == "" ) return true;
	    	else return false;
	    }
	    
	    , drawWindow : function(){
	    	var layer = this;
	    	layer.window = $( "<div class='layout-msgpop-wr' style='display:none;'></div>" );
			layer.back = $("<span class='back'></span>");
	    	layer.con_wrap = $( "<div class='msgpop-wr' tabindex='0'></div>" );
	    	layer.con_head = $( "<div class='msgpop-tit'></div>" );
	    	layer.con_title = $( "<em ></em>" );
	    	layer.con_cont = $( "<div class='msgpop-cont'></div>" );
			

	    	
	    	
	    	layer.setTitle( layer.options.title );
	    	layer.window.prepend(layer.back);
	    	layer.con_head.append( layer.con_title );
	    	layer.con_wrap.append( layer.con_head ).append( layer.con_cont ).append( layer.win_close_btn );
	    	layer.window.append( layer.con_wrap );

			if(this.options.cont_type=="iframe"){
				layer.cont_frame = $("<iframe width='100%' height='98%' frameborder='0' scrolling='yes'></iframe>");
				layer.cont_frame.appendTo(layer.con_cont);
			}

	    	
	    	var btn_cnt = 1;
	    	
	    	// 닫기 버튼 생성
	    	if( layer.options.close_button_yn ){
		    	layer.win_close_btn = $( layer.options.close_button );
		    	layer.con_wrap.append( layer.win_close_btn );
		    	layer.win_close_btn.bind( "click", function(){
		    		layer.closeMsgPopup();
				});
		    	layer.win_close_btn.addClass( "pop-btn-" + btn_cnt );
		    	btn_cnt++;
	    	}
	    	
	    	
	    	// 리로드 버튼 생성
	    	if( layer.options.reload_button_yn ){
		    	layer.win_reload_btn = $( layer.options.reload_button );
		    	layer.con_wrap.append( layer.win_reload_btn );
		    	layer.win_reload_btn.bind( "click", function(){
		    		layer.reload();
				});
		    	layer.win_reload_btn.addClass( "pop-btn-" + btn_cnt );
		    	btn_cnt++;
	    	}
	    	
	    	// 창크키 조절 버튼 생성
	    	if( layer.options.minmaxsize_button_yn ){
		    	layer.win_minsize_btn = $( layer.options.minsize_button );
		    	layer.win_maxsize_btn = $( layer.options.maxsize_button );
		    	layer.con_wrap.append( layer.win_minsize_btn );
		    	layer.con_wrap.append( layer.win_maxsize_btn );
		    	layer.win_minsize_btn.bind( "click", function(){
		    		$( this ).hide();
		    		layer.win_maxsize_btn.show();
		    		layer.options.width  = layer.options.min_width;
		            layer.options.height  = layer.options.min_height;
		    		layer.setWindowResizing();
				});
		    	layer.win_maxsize_btn.bind( "click", function(){
		    		$( this ).hide();
		    		layer.win_minsize_btn.show();
		    		layer.options.width  = layer.options.max_width;
		            layer.options.height  = layer.options.max_height;
		    		layer.setWindowResizing();
				});
		    	layer.win_minsize_btn.addClass( "pop-btn-" + btn_cnt ).hide();
		    	layer.win_maxsize_btn.addClass( "pop-btn-" + btn_cnt );
		    	btn_cnt++;
	    	}

			if(layer.options.back_click_close){
				$(layer.back).bind("click",function(){
					layer.closeMsgPopup();
				});
			}
	    	
	    	// 윈도우 사이즈 변경 이벤트
	    	$(window).resize(function() {
			    if(this.resizeTO) { clearTimeout(this.resizeTO); }
			    this.resizeTO = setTimeout(function() { $(this).trigger('resizeEnd'); }, 100);
			});
			layer.eventListener = {
				"resize":function(){
					layer.moveLayer();
				}
			}
			$(window).on('resizeEnd', layer.eventListener.resize);
	    	
	    	$( document.body ).append( layer.window );
	    }
	    , setScrollFixed:function(){
			var layer = this
			

			//$("body").css("overflow-y","hidden");
		}
	    , setWindowResizing : function(){
	    	var layer = this;
	    	
	    	// 창크기 조절
			// 창 높이 설정
	    	layer.options.option_height = layer.options.height * 1;
	    	layer.options.title_height = layer.con_head.css( "height" ).replace( "px", "" ) * 1;
	    	layer.options.cont_height = ( 1 * layer.con_cont.css( "margin-top" ).replace( "px", "" ) ) + ( 1 * layer.con_cont.css( "margin-bottom" ).replace( "px", "" ) );
	    	layer.options.total_height = layer.options.option_height + layer.options.title_height + layer.options.cont_height;
	    	
	    	layer.getPosition();
	    	
	    	// 지정한 크기보다 창 크기가 작을경우 처리 & 모바일
	    	var auto_with = layer.options.width;
	    	var auto_height = layer.options.total_height;
	    	var auto_cont_height = layer.options.height;
	    	if( $( window ).width() <= layer.options.width )	auto_with = $( window ).width();
	    	if( $( window ).height() <= layer.options.total_height ){
	    		auto_height = $( window ).height();
	    		auto_cont_height = auto_height - ( layer.options.title_height + layer.options.cont_height );
	    	}
	    	
	    	// 창 위치 조절 기본
			layer.con_cont.css( "height", auto_cont_height );
			layer.con_wrap.animate( { 
				"width": auto_with
				, "height": auto_height
				, "top": layer.options.top
				, "left": layer.options.left
			} , layer.options.animate_open );	
			
			// 바디에 스크롤 숨기기
			$( document.body ).css( "overflow", "hidden" );
	    }
	    
	    , setTitle : function( title ){
	    	var layer = this;
	    	var title = title || layer.options.title;
	    	layer.con_title.html( title );
	    }
	    
	    , setContent : function( content ){
	    	var layer = this;
	    	var inner_content = content || "" ;

			layer.con_cont.html( inner_content );

			if(inner_content!=""){
				$(".closeBtn",layer.con_cont).bind("click",function(){
					layer.closeMsgPopup();
				});
			}

	    }
	    
	    , pageLoad : function(){
	    	var layer = this;
	    	
	    	if( !this.isNullOrBlank( layer.options.div_target ) ){
	    		var data = $( layer.options.div_target ).html();
	    		layer.setContent( data );
	    	}else if(!this.isNullOrBlank(layer.options.message)){
				layer.setContent(layer.options.message);

			}else if( !this.isNullOrBlank( layer.options.url ) ){
			
					$.ajax({
						type : "post",
						url : layer.options.url ,
						data: layer.options.parameter ,
						dataType:"text",
						success : function( data ){
							layer.setContent( data );
							if( layer.options.pageOnLoadCallBack != null ){
								layer.options.pageOnLoadCallBack( layer, data );
							}
						},
						error : function( xhr, status, error ) { alert("작업 수행중 오류가 발생했습니다.\n다시 시도해 주세요."); }
					});

	    	}	    	
	    }
	    
	    , showMsgPopup : function (){
	    	var layer = this;

			if(layer.options.scroll_fix){
				$("body").css({"overflow-y":"hidden","overflow-x":"hidden"});
			}
	    	layer.window.show( layer.options.animate_open );
	    	
	    	if( layer.con_cont.find( "select, input[type!=hidden]" ).size() > 0 ){
	    		layer.con_cont.find( "select, input[type!=hidden]" ).first().focus();
	    	}else{
	    		layer.con_wrap.focus();
	    	}
	    	
	    }
	    
	    , closeMsgPopup : function (){
	    	var layer = this;

			if(layer.options.scroll_fix){
				$("body").css({"overflow-x":layer.org_scroll.overflowX,"overflow-y":layer.org_scroll.overflowY});
			}

    		layer.window.hide( layer.options.animate_close, function(){
				//$( layer.options.returnObj ).focus();
				layer.el.removeData( "msgPopup" );
				layer.window.remove();
				$(window).off('resizeEnd',layer.eventListener.resize);

			});
	    }
	    
	    , moveLayer : function(){
	    	var layer = this;
			layer.setWindowResizing();
			layer.con_wrap.animate( { "top": layer.options.top , "left": layer.options.left }, layer.options.animate_move );			
	    }
	    
	    , getPosition : function(){
	    	var layer = this; 
	    	layer.options.top = Math.max( 0, ( ( $( window ).height() - layer.options.total_height ) / 2 ) ) + "px";
	    	layer.options.left = Math.max( 0, ( ( $( window ).width() - layer.options.width ) / 2 ) ) + "px";
	    }
	    
	    , reload : function ( new_option ){
	    	var layer = this;
	    	layer.options = $.extend( {}, layer.options, new_option );
	    	layer.setContent();		// 초기화
	    	layer.setTitle( layer.options.title );
	    	layer.pageLoad();

			
            layer.showMsgPopup();
	    	layer.setWindowResizing();
	    }
	    
    
    };

    $.fn.msgPopup = function( params, a )   {
        var lists  = this,
            retval = this;

        lists.each(function()
        {
        	        	
            var plugin = $(this).data( "msgPopup" );

            if (!plugin ) {
				if((typeof params !== 'string' )){
					$(this).data("msgPopup", new Plugin( this, params));
					$(this).data("msgPopup-id", new Date().getTime());
				}
            } else {
                if (typeof params === 'string' && typeof plugin[params] === 'function' && typeof a === 'undefined' ) {
                    retval = plugin[params]();
                }else if (typeof params === 'string' && typeof plugin[params] === 'function' ){
                	retval = plugin[params]( a );
                }else {
					plugin.reload(params,a);
					
					//retval = plugin["init"](
					//alert("다시 실행하라고");

				}
            }
        });

        return retval || lists;
    };

})(window.jQuery || window.Zepto, window, document);
