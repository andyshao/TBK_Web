<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" Content="text/html; charset=utf-8" />
<Title>网站顶部</Title>
<link href="/templates/tadmin/style/style.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function get_time()
{
	var t = new Date();
	var tStr = "";
	tStr += t.getFullYear()+"年"+ parseInt(t.getMonth() + 1) +"月"+t.getDate()+"日 ";
	switch(t.getDay())
	{
		case 0 :
			tStr += "星期日";
			break;
		case 1 :
			tStr += "星期一";	
			break;
		case 2 :
			tStr += "星期二";
			break;	
		case 3 :
			tStr += "星期三";
			break;
		case 4 :
			tStr += "星期四";
			break;
		case 5 :
			tStr += "星期五";
			break;	
		case 6 :
			tStr += "星期六";
			break;	
	}
	tStr += " ";
	tStr += t.getHours()+":"+t.getMinutes()+":"+t.getSeconds();
	document.getElementById("CurrTime").innerHTML = '今天是：'+tStr;
}
setInterval("get_time()",1000);
</script>
<style type="text/css">
body {
	margin:0px;
}
</style>

</head>

<body>
<div id="top">
  <div class="logo">
  
    <div class="t-right">
      <div class="t-bat"><a href="/index.php/tadmin/admin/modify_password" target="main"><img src="/templates/tadmin/images/topmodps.jpg" /></a><a href="/index.php/tadmin/main/welcome" target="main"><img src="/templates/tadmin/images/bat01.gif" /></a><a href="/" target="_blank"><img src="/templates/tadmin/images/bat02.gif" /></a><a href="/index.php/tadmin/login/logout" target="_top"><img src="/templates/tadmin/images/bat03.gif" /></a></div>
      <div class="f_r" id="CurrTime"></div>
    </div>
  </div>
</div>
</body>
</html>