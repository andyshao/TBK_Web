<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" Content="text/html; charset=utf-8" />

<title><?php echo $site_title;?></title>
<link href="{tpl_path}style/login_style.css" rel="stylesheet" />
<META content="text/html; charset=utf-8" http-equiv=Content-Type><LINK 
rel=stylesheet type=text/css href="/templates/tadmin/images/style.css">

</head>

<body>



<STYLE type=text/css>.tbk {
	COLOR: #fc3
}
</STYLE>

<META name=GENERATOR content="MSHTML 8.00.6001.23588"></HEAD>
<BODY class=login_body>
<DIV class=login_hd>
<DIV class=login_hd_main><SPAN class=login_logo></SPAN><SPAN 
class=login_slogan>搜客淘宝客程序API自动更新自动采集版本</SPAN> 
<DIV class=login_nav><A class=tbk 
href="/">网站首页</A>&nbsp;|&nbsp; <A 
href="http://bbs.soke5.com/" target="_blank">官方网站地址</A>&nbsp;|&nbsp; 搜客淘宝客官方网站提供技术支持</A> 
</DIV>
</DIV></DIV>
<DIV class=login_wrap>
<DIV class=login_box>
 <form method="post" action="<?php echo site_url(CTL_FOLDER."login/check_login"); ?>" onsubmit="return Validator.Validate(this,2)">
<DIV class=login_funbox><INPUT class=login_ipt type=text value=输入用户名 name=user_name dataType=Require> 
<INPUT class=login_ipt type=password value=password name=password dataType=Require> </DIV>
<DIV class=login_funbox> 
<a class=forgotpw target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=732515587&site=qq&menu=yes" ><img border="0" src="http://wpa.qq.com/pa?p=2:732515587:45" alt="点击这里给我发消息" title="点击这里给我发消息" style="vertical-align:middle">732515587</a>  <A class=tbk 
href="/" target="_blank">进入网站首页</A>&nbsp;&nbsp; </DIV>
<DIV class=login_funbox><BUTTON class=loginbtn type=submit>登陆</BUTTON> 
</DIV></FORM></DIV>
<DIV class=footer>
<DIV class=footer_main><A href="http://bbs.soke5.com/" 
target=_blank>搜客淘宝客官方网站</A>版权所有&nbsp;©&nbsp;2011-2015 
</DIV></DIV></DIV>




</body>
</html>