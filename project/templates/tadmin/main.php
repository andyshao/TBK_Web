<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN'
'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<Title>搜客淘宝客程序后台管理系统</Title>
<meta http-equiv="Content-Type" Content="text/html; charset=utf-8">
</head>
<frameset rows="60,*" frameborder="no" border="0" framespacing="0">
  <frame src="<?php echo site_url(CTL_FOLDER."main/top"); ?>" Name="topFrame" scrolling="No" noresize="noresize" Id="topFrame" Title="topFrame" />
  <frameset Id="mframe" cols="180,*" frameborder="no" border="0" framespacing="0">
	  <frame src="<?php echo site_url(CTL_FOLDER."main/menu"); ?>" Name="leftFrame" scrolling="auto" noresize="noresize" Id="leftFrame" Title="leftFrame" />
	  <frame src="<?php echo site_url(CTL_FOLDER."main/welcome"); ?>" Name="main"  scrolling="auto" Id="main" Title="mainFrame" />
	</frameset>
</frameset>
<noframes>
<body>
</body>
</noframes>
</html>