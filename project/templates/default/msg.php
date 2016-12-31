<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
switch($infotype)
{
	case "yes":
		$icon_src="{tpl_path}images/common/infosuccess.gif";
		break;
	 case "no":
	 	$icon_src="{tpl_path}images/common/infoerror.gif";
		break;
	case "msg":
	 	$icon_src="{tpl_path}images/common/infonotice.gif";
		break;	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站信息提示</title>
<style type="text/css">
a {
	color: #555555;
}
#div_msg{
	font-size:14px;
	width:650px;
	height: auto;
	border:#DFDFDF 1px solid;
	margin-top: 50px;
	margin-right: auto;
	margin-bottom: 0px;
	margin-left: auto;
	padding-bottom: 20px;
}
#div_msg .img_box{
	width:55px;
	height:50px;
	margin-left:20px;
	text-align:center;
	float:left;
}
#div_msg .div_ct{
	margin-left:10px;
	text-align:left;
	float:left;
}
#div_msg .div_ct ul{<?php 
if($infotype=="no") echo "color: #FF0000;";
else echo "color:#006600;";
?>	}
#div_msg .div_ct ul{
	list-style:square;
}
.clear{ clear:both; display:block; width:100%; padding-top:5px}
.header{width:100%; height:25px; vertical-align:middle; text-align:left; font-weight:bold; line-height:25px; background:#E5E5E5; margin-bottom:10px;}
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
    <div class="header"><span style=" padding-left:10px;">提示信息</span></div>
        <div class="img_box"><img src="<?php echo $icon_src;?>"></div>
        <div class="div_ct">
            <ul>
                <?php echo $infos;?>
            </ul>
           <?php if($target == '_self'){?>
            <p style="text-align:center; font-size: 12px">
            5秒后,页面将跳转<span id="counter"></span>... <a href="<?php echo $red_url;?>"  target="<?php echo $target;?>">点击这里返回</a>
            </p>
           <?php }?> 
        </div>
        <div class="clear"></div>
    </div>
</body>
</html>