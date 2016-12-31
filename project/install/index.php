<?php
require("check_install.php");
$is_install=TRUE;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>安装环境检测--搜客淘宝客程序API全自动采集版安装</title>
<link rel="stylesheet" type="text/css" href="style/style.css">
</head>

<body>
<?php include('top.php');?>
<div id="ui-tx-main">
  <div class="ui-tx-left">
    <div class="ui-tx-tab-v">
      <div class="ui-tx-tab-v-active">安装环境检测</div>
      <div>系统配置</div>
      <div>安装完成</div>
	  
		  <div>技术支持：<a href="http://bbs.soke5.com/" target="_blank">搜客淘宝客</a></div>
	   <div>客服：<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=732515587&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:732515587:45" alt="点击这里给我发消息" title="点击这里给我发消息" style="vertical-align:middle"> 732515587</a></div>   
	  
    </div>
  </div>
  <div class="ui-tx-right">
    <fieldset>
    <legend><img src="images/network_server.jpg" style="vertical-align:middle" /> 服务器配置检测</legend>
    <table width="100%" border="0" cellpadding="5" cellspacing="0">
      <tr>
        <td> 操作系统...................................................................................................................<?php echo PHP_OS;?><br />
          PHP 版本.......................................................................................................................... <?php echo PHP_VERSION;?><br />
          是否支持MySQL..........................................................................................................................
          <?php 
		  if( !in_array( 'mysql' , $ms ) )
		  {
		  	$is_install=FALSE;
			echo "<font style='color:#FF0000'>不支持</font>";
		  }
		  else
		  {
		  	echo "支持";
		  } 
		  ?>
          <br />
          GD 扩展..........................................................................................................................
          <?php 
		  if( !in_array( 'gd' , $ms ) )
		  {
		  	echo "<font style='color:#FF0000'>未安装</font>";
		  }
		  else
		  {
		  	echo "已安装";
		  } 
		  ?>
          <br />
          Mbstring扩展..........................................................................................................................
          <?php 
		  if( !in_array( 'mbstring' , $ms ) )
		  {
		  	echo "<font style='color:#FF0000'>未安装</font>";
		  }
		  else
		  {
		  	echo "已安装";
		  } 
		  ?>
        </td>
      </tr>
    </table>
    <div class="clear"></div>
    </fieldset>
    <fieldset>
    <legend><img src="images/goreg_icon.jpg" style="vertical-align:middle" /> 目录权限检测</legend>
    <table width="100%" border="0" cellpadding="5" cellspacing="0">
      <tr>
        <td><?php 
	$list = array('backup','cache','apicache','app/config','uploadfiles','uploadfiles/files','uploadfiles/images');
	foreach( $list as $item )
	{
		echo $item;
?>
          .......................................................................................................................
          <?php 
		  	if(is_really_writable(ROOT.$item))
			{
				echo "<span style='color:#6C4800'>目录可写</span> <br />";
			}
			else
			{
				echo "<span style='color:#6C4800'>目录不可写</span> <br />";
			}
	}
?></td>
      </tr>
    </table>
    <div class="clear"></div>
    </fieldset>
    <div class="ui-tx-bar">
      <?php 
if (!$is_install) echo "<b style='color:#FF0000'>由于您的服务器不满足安装要求，所以程序无法完成安装!</b>";
else echo "<input name=\"button\" type=\"button\" onclick=\"document.location.href='install.php'\" class=\"ui-tx-button\" value=\"下一步\" />";
?>
    </div>
  </div>
  <div class="clear"></div>
</div>
<?php include("copyright.php");?>
</body>
</html>
