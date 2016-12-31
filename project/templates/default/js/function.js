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

function subForm(f,e)
{
	if( ! Validator.Validate(f,3)) return;
	e.value = '数据处理中..';
	e.disabled = true;
	f.submit();
}

function AddFavorite(sURL, sTitle)
{
    try
    {
        window.external.addFavorite(sURL, sTitle);
    }
    catch (e)
    {
        try
        {
            window.sidebar.addPanel(sTitle, sURL, "");
        }
        catch (e)
        {
            alert("加入收藏失败，请使用Ctrl+D进行添加");
        }
    }
}

function SetHome(obj,vrl){
	try
	{
		obj.style.behavior='url(#default#homepage)';obj.setHomePage(vrl);
	}
	catch(e)
	{
		if(window.netscape) {
			try 
			{
				netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
			}
			catch (e) 
			{
				alert("您的浏览器拒绝设置主页");
			}
			var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);
			prefs.setCharPref('browser.startup.homepage',vrl);
		 }
	}
}