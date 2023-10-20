var docURL = {
	uri : document.location.href,q:[],qstr:"",
	_init:function(){
		var urlArr = this.parseURI(this.uri);
		this.url = urlArr.url;
		this.qstr = urlArr.qstr;
	},
	parseURI : function(url){
		var info = {"url":"","qstr":""};
		var uriArr = url.split("?");
		if($.trim(uriArr[1])!=""){
			info.qstr = $.trim(uriArr[1]);
			//this.parseQueryStr($.trim(uriArr[1]));
		}
		info.url = $.trim(uriArr[0]);
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
		if(str!="") qArr = str.split("&");
		for (var i=0;i<qArr.length ;i++ )
		{
			var tmpArr = $.trim(qArr[i]).split("=");
			//this.q.push({"key":tmpArr[0],"value":tmpArr[1]});
			qData[tmpArr[0]] = decodeURIComponent(tmpArr[1]);
		}
		return qData;
	},
	removeQueryStr:function(qkey,addstr){
		this._init();
		var qstr =[];
		var keyArr = qkey.split(",");
		
		this.parseQueryStr(this.qstr);
		for(var i=0;i<this.q.length;i++){
			if(!in_array(keyArr,this.q[i].key)){
				qstr.push(this.q[i].key +"="+ this.q[i].value);
			}
		}

		 var rstr = (qstr.length>0)? qstr.join("&") + addstr: "";
		return rstr;
		
	},
	selectQueryStr:function(qkey,addstr){
		this._init();
		var qstr =[];
		var keyArr = qkey.split(",");
		
		this.parseQueryStr(this.qstr);
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
}
$(document).ready(function(){docURL._init();});