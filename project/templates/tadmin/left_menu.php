<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理菜单</title>
<link rel="stylesheet" href="{root_path}js/jquery/jquery-tree/jquery.treeview.css" />
<link rel="stylesheet" href="{tpl_path}style/style.css">
<script type="text/javascript" src="{root_path}js/jquery/jquery.js"></script>
<script src="{root_path}js/jquery/jquery-tree/jquery.treeview.js" type="text/javascript"></script>
<script language="javascript">
	$(document).ready(function(){
		$("#browser").treeview({
			collapsed: false
		});
	});
</script>
<style type="text/css">
body {
	margin:0px;
}
</style>
</head>

<body>
<ul id="browser" class="filetree">
  </br></br><li><span class="file"><a href="<?php echo site_url(CTL_FOLDER.'site_config');?>" target="main"><strong>网站配置</strong></a></span></li></br>
  <li><span class="file"><a href="<?php echo site_url(CTL_FOLDER.'author_code');?>" target="main"><strong>授权管理</strong></a></span></li></br>
  <li><span class="file"><a href="<?php echo site_url(CTL_FOLDER.'hot_cat');?>" target="main"><strong>搜索关键词</strong></a></span></li></br>
  <li><span class="file"><a href="<?php echo site_url(CTL_FOLDER.'top_nav');?>" target="main"><strong>顶部导航</strong></a></span></li></br>
  <li><span class="file"><a href="<?php echo site_url(CTL_FOLDER.'bot_nav');?>" target="main"><strong>底部导航</strong></a></span></li></br>
  <li><span class="file"><a href="<?php echo site_url(CTL_FOLDER.'link');?>" target="main"><strong>友情链接</strong></a></span></li></br>
  <li><span class="file"><a href="<?php echo site_url(CTL_FOLDER.'mysql_manage');?>" target="main"><strong>数据库备份</strong></a></span></li></br>
  <li><span class="file"><a href="<?php echo site_url(CTL_FOLDER.'admin');?>" target="main"><strong>管理员设置</strong></a></span></li></br>
  <li><span class="file"><a href="<?php echo site_url(CTL_FOLDER.'file_manage');?>" target="main"><strong>文件管理</strong></a></span></li></br>
  <li><span class="file"><a href="http://www.dede168.com"  target="_blank"><strong>程序下载地址</strong></a></span></li></br>
 
</ul>
</body>
</html>