//全选或者取消全选
var checkflag = "false";
function check_box(field) {
	if (checkflag == "false") {
		if(isNaN(field.length)){
			field.checked=true;
		}else{
			for (var i = 0; i < field.length; i++) { 
				field[i].checked = true;
			}
		}
		checkflag = "true"; 
		return "取消全选"; 
	} else {
		if(isNaN(field.length)){
			field.checked=false;
		}else{
			for (var i = 0; i < field.length; i++) { 
				field[i].checked = false; 
			}
		}
		checkflag = "false"; 
		return "选中全部"; 
	}
}
 
/**********************
图片loading效果+自动按比例缩放+支持单图和图片列表
@imgid:jquery 对象
@w:图片缩放的最大尺寸
***********************/
function get_pic_size(ob,w)
{
	var sizes=new Array(0,0);
	if(ob.height>0&&ob.width>0)
	{
		if(ob.width/ob.height>= 1){ 
			if(ob.width>w)
			{
				sizes[0]=w; 
				sizes[1]=(ob.height*w)/ob.width; 
			}
			else
			{ 
				sizes[0]=ob.width;
				sizes[1]=ob.height; 
			} 
		} 
		else
		{ 
			if(ob.height>w)
			{
				sizes[1]=w; 
				sizes[0]=(ob.width*w)/ob.height; 
			}
			else
			{ 
				sizes[0]=ob.width;
				sizes[1]=ob.height; 
			} 
		}
	}
	return sizes;
}
function LoadImage(imgid,val,w){ 
	if(val==""||val=="\/")
	{
		imgid.attr({src: onerror_pic_path, width: 50, height: 38});
		return ;
	}
	
	var img=new Image();
	if(img.complete)
	{
		var img_size=get_pic_size(img,w);
		imgid.attr({src: val, width: img_size[0], height: img_size[1]});
	}
	img.onload=function(){
		var img_size=get_pic_size(img,w);
		imgid.attr({src: val, width: img_size[0], height: img_size[1]});
	}
	img.onerror=function(){imgid.attr({src: onerror_pic_path, width: 50, height: 38});}
	img.src=val;
}

//提交表单
function submit_list_form(f,e){
	var action_ob=document.getElementById("action_url");
	var selected_text=$("#action_url option:selected").text();
	if ($("#check_box_id input:checked").length==0)
	{
		alert("请勾选要操作的项,然后再提交");
		return false;
	}
	if (!Validator.Validate(f,2)) return false;
	if (action_ob.value=="") 
	{
		alert("请选择要执行的操作,然后再提交");
		return false;
	}
	if(selected_text=='转移到分类')
	{
		if($("#to_catalog_id").val()=='')
		{
			alert("请选择要转到的分类,然后再提交");
			return false;
		}
	}
	if(selected_text=='复制到'||selected_text=='剪切到')
	{
		if($("#to_dir").val()=='')
		{
			alert("请选择要复制/剪切到的路径");
			return false;
		}
	}
	if (confirm('确定要执行该操作吗？')){
		f.action=action_ob.value;
		e.value = '数据处理中..';
		e.disabled = true;
		f.submit();
	}
}

//拷贝文本
function js_copy(txt)
{
	if(window.clipboardData) 
	{    
		window.clipboardData.clearData();    
		window.clipboardData.setData("Text", txt);    
	}
	else if(navigator.userAgent.indexOf("Opera") != -1)
	{    
		window.location = txt;   
	} 
	else if (window.netscape) 
	{    
		try {    
			netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");    
		} catch (e) {    
			alert("被浏览器拒绝！\n请在浏览器地址栏输入'about:config'并回车\n然后将'signed.applets.codebase_principal_support'设置为'true'");  
		}    
		var clip = Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);    
		if (!clip)    
		return;   
		var trans = Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);    
		if (!trans)    
		return;    
		trans.addDataFlavor('text/unicode');    
		var str = new Object();    
		var len = new Object();    
		var str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);    
		var copytext = txt;    
		str.data = copytext;    
		trans.setTransferData("text/unicode",str,copytext.length*2);    
		var clipid = Components.interfaces.nsIClipboard;    
		if (!clip)    
		return false;    
		clip.setData(trans,null,clipid.kGlobalClipboard);    
	} 
	alert("链接已经成功拷贝，您可以粘贴到旺旺,QQ,MSN或者邮件发给好友了");    
}

/*弹出选择文件窗口*/
var input_field_id;
function GetFileDialog(ob)
{
	input_field_id=ob;
	show_message('正在获取数据...',false);
	if(!document.getElementById("file_dialog_id"))
	{
		$("<div id=\"file_dialog_id\" style=\"display:none;\"></div>").prependTo("body");
	}
	$.ajax({
		 type: "POST",
		 url: js_root_path+"tadmin/file_manage/ajax_get_file",
		 data: "action=getdata",
		 success: function(msg){
			$("#file_dialog_id").html(msg);
			hide_message();
			$('#file_dialog_id').dialog({  
				hide:'',    
				autoOpen:false,
				width:750,
				height:480,  
				modal:false, //蒙层  
				title:'选择文件', 
				close: function(){ 
					$(this).dialog('destroy');
					$("#file_dialog_id").remove();
					$('select').show();
				},  
				overlay: {  
					opacity: 0.5, 
					background: "black"
				},
				buttons:{  
					'取消':function(){$(this).dialog("close");}
				}
			});
			$('#file_dialog_id').dialog('open');
			$('select').hide();
		 }
	});
}
function ReloadFileDialog(fp)
{
	$("<img src='"+pic_loading_path+"' /> 正在获取数据...").prependTo("#file_dialog_id");
	$.ajax({
		 type: "POST",
		 url: js_root_path+"tadmin/file_manage/ajax_get_file",
		 data: "folder_path="+fp,
		 success: function(msg){
			$("#file_dialog_id").html(msg);
		 },
		 error:function(msg){
			$("#file_dialog_id").html("请求没能完成");
		}
	});
	return ;
}

function GetFilePath(ob)
{
	$("#"+input_field_id).val($(ob).attr("rel"));
	$('#file_dialog_id').dialog('close');
	//return ;
}

function subForm(f,e)
{
	if( ! Validator.Validate(f,3)) return;
	e.value = '数据处理中..';
	e.disabled = true;
	f.submit();
}

function show_message(msg,is_over)
{
	var pos = 0;
	if (window.innerHeight)
	{
		pos = window.pageYOffset;
	}
	else if (document.documentElement && document.documentElement.scrollTop)
	{
		pos = document.documentElement.scrollTop;
	}
	else if (document.body)
	{
		pos = document.body.scrollTop;
	}
	var d_width = $(document).width();
	var mark_width = 350;
	var off_left = d_width / 2 - mark_width / 2;
	var off_top = pos + 200;
	if($('#ui-tx-mark-message').length > 0)
	{
		$('#ui-tx-mark-message').css({left:off_left,top:off_top}).html(msg).show();
	}
	else
	{
		$('<div id="ui-tx-mark-message"></div>').css({left:off_left,top:off_top}).appendTo("body").html(msg).show();
	}
	if(is_over)
	{
		setTimeout(function(){$('#ui-tx-mark-message').remove()},2000);
	}
}

function hide_message()
{
	if($('#ui-tx-mark-message').length > 0)
	{
		$('#ui-tx-mark-message').remove();
	}
}

function openDialog(t,c,w,h)
{
	if($('#ui-tx-cbox').length == 0) $('<div id="ui-tx-cbox"></div>').appendTo("body");
	var b = $('#ui-tx-cbox');
	b.html(c);
	b.dialog({  
		hide:'',      
		autoOpen:false,
		width:w,
		height:h,  
		modal:true,
		title:t, 
		close: function(){ 
			b.dialog('destroy');
		},  
		overlay:{  
			opacity: 0.5, 
			background: "black"
		}
	});
	b.dialog('open');
}

String.prototype.Trim = function()  
{  
	return this.replace(/(^\s*)|(\s*$)/g, "");  
}