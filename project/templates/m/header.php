<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $site_title;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,user-scalable=0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<meta http-equiv="Expires" CONTENT="-1">
<meta http-equiv="Cache-Control" CONTENT="no-cache">
<meta http-equiv="Pragma" CONTENT="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="{tpl_path}style/style.css" />
<script type="text/javascript" src="{root_path}js/jquery/jquery.js"></script>
<script language="javascript">
var js_root_path="<?php echo my_site_url();?>";
function check_submit()
{
	var f = document.getElementById("searchForm");
	if(f.q.value == '' || f.q.value == f.q.defaultValue)
	{
		alert('请输入搜索关键字');
		return false;
	}
	f.submit();
}
</script>
</head>

<body>
<div style="position:fixed; z-index:9999; background:#f5f5f5; width:100%;left:0;top:0">
  <div class="viewport">
    <header class="search-bar">
      <form id="searchForm" method="get" action="<?php echo site_url(CTL_FOLDER.'search');?>">
        <div class="search-bar-tbl">
          <div class="search-bar-cell-1"><a href="<?php echo site_url(CTL_FOLDER.'home');?>" class="logo"><img alt="<?php echo $this->config->item('sys_site_name');?>" src="<?php echo get_real_path($this->config->item('m_site_logo'));?>" /></a></div>
          <div class="search-bar-cell-3"> <a href="<?php echo my_site_url(CTL_FOLDER.'cat');?>" class="menu">分类</a> </div>
          <div class="search-bar-cell-2">
            <div class="search-textfile"> <a id="searchbtn" href="javascript:void(0);" onClick="check_submit()" class="btn-home-search"></a>
              <input type="text" name="q" maxlength="50" value="请输入搜索关键字" onblur="if(this.value == '') this.value = this.defaultValue;" onclick="if(this.value == this.defaultValue) this.value = '';" class="search-textfile-input" />
            </div>
          </div>
        </div>
        <div class="clear"></div>
      </form>
    </header>
  </div>
</div>
