
tinymce.PluginManager.add('simpleupload', function(editor) {

	tinymce.activeEditor.settings.file_browser_callback = simpleFileUpload;
	tinymce.activeEditor.settings.file_upload_form_path = "/_Editor/mceEditor/plugins/simpleupload/";

	
	function simpleFileUpload (id, value, type, win) {
		// DEFAULT AS FILE
		urltype=2;
		if (type=='image') { urltype=1; }
		if (type=='media') { urltype=3; }

//		var sCode = (_site_code!=undefined && _site_code!="")? _site_code : "";


		tinymce.activeEditor.windowManager.open({
			title: "File Upload",
			//file: editor.settings.file_upload_form_path+'dialog.php?type='+urltype+'&descending='+descending+sort_by+fldr+crossdomain+'&lang='+editor.settings.language+'&akey='+akey,
			url:  editor.settings.file_upload_form_path + 'upload_form.php?sCode='+getThisConfigSiteCode()+'&type='+urltype,
			width: 360,  
			height: 100,
			resizable: false,
			maximizable: true,
			inline: 1
			},
			{
				upload_folder: "",
				setUrl: function (url) {
					var fieldElm = win.document.getElementById(id);
					fieldElm.value = editor.convertURL(url);

					if ("fireEvent" in fieldElm) {
						fieldElm.fireEvent("onchange")
					} else {
						var evt = document.createEvent("HTMLEvents");
						evt.initEvent("change", false, true);
						fieldElm.dispatchEvent(evt);
					}
					editor.windowManager.close();
				}
		});
	};


});
