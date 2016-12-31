<?php
define("ROOT",substr($_SERVER['PHP_SELF'],0,strpos($_SERVER['PHP_SELF'],"install/")));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>程序安装完--搜客淘宝客程序API全自动采集版安装</title>
<link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
<?php include('top.php');?>
<div id="ui-tx-main">
  <div class="ui-tx-left">
    <div class="ui-tx-tab-v">
      <div>安装环境检测</div>
      <div>系统配置</div>
      <div class="ui-tx-tab-v-active">安装完成</div>
	  
	  <div>技术支持：<a href="http://bbs.soke5.com/" target="_blank">搜客淘宝客</a></div>
	   <div>客服：<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=732515587&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:732515587:45" alt="点击这里给我发消息" title="点击这里给我发消息" style="vertical-align:middle"> 732515587</a></div>   
	  
    </div>
  </div>
  <div class="ui-tx-right">
    <fieldset>
    <legend><img src="images/yes.gif" style="vertical-align:middle" /> 程序安装完</legend>
    <table width="100%" cellpadding="3" cellspacing="0" class="list">
      <tr>
        <td width="412" align="left">您现在可以：<a href="<?php echo ROOT;?>" target="_blank">进入网站前台首页</a></td>
        <td width="356" align="left"><a href="<?php echo ROOT."index.php/tadmin/login";?>" target="_blank">进入网站后台</a></td>
      </tr>
    </table>
    <div class="clear"></div>
    </fieldset>
  </div>
  <div class="clear"></div>
</div>
<?php include("copyright.php");?>
</body>
</html>
