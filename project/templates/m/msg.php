<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
<title>网站信息提示</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,user-scalable=0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<meta http-equiv="Expires" CONTENT="-1">
<meta http-equiv="Cache-Control" CONTENT="no-cache">
<meta http-equiv="Pragma" CONTENT="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
a {
	color: #555555;
}
#div_msg {
	width:90%;
	margin:0 auto
}
#content {
	font-size:14px;
	border:#DFDFDF 1px solid;
	padding: 20px;
	margin:20px 0
}
#content ul {
	margin:0;
	padding:0;
	list-style:none
}
#content ul li {
	list-style:none;
	line-height:25px
}
</style>
<script language="javascript">
	var i = 5;
	var clock = 0;//5秒后跳转
	function redirect(){
		if(i <= clock) 
		{
			document.location.href='<?php echo $red_url;?>';
			return ;
		}	
		document.getElementById("counter").innerHTML=i;
		i--;
		setTimeout("redirect()",1000);
	}
	<?php if($target == '_self'){?>
	window.onload = function(){redirect();}
	<?php }?>
</script>
</head>

<body>
<div id="div_msg">
  <div id="content">
    <ul>
      <?php echo $infos;?>
      <?php if($target == '_self'){?>
      <li> 5秒后,页面将跳转<span id="counter"></span>... <a href="<?php echo $red_url;?>"  target="<?php echo $target;?>">点击这里返回</a> </li>
      <?php }?>
    </ul>
  </div>
</div>
</body>
</html>