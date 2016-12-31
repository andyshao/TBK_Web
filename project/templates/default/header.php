<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html class="jp-pc w1200" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title><?php echo $site_title;?></title>
<link href="<?php echo ROOT_PATH;?>favicon.ico" type="image/x-icon" rel="shortcut icon" />
<?php if(isset($page_keyword) && $page_keyword!=''){?>
<meta name="keywords" content="<?php echo $page_keyword;?>"/>
<?php }else{?>
<meta name="keywords" content="<?php echo $this->config->item("sys_site_keyword");?>"/>
<?php }?>
<?php if(isset($page_description) && $page_description!=''){?>
<meta name="description" content="<?php echo $page_description;?>"/>
<?php }else{?>
<meta name="description" content="<?php echo $this->config->item("sys_site_description");?>"/>
<?php }?>
<script language="javascript">window.onerror = function(){return true;}</script>
<link type="text/css" rel="stylesheet" href="{tpl_path}style/style.css" />
<script type="text/javascript" src="{root_path}js/jquery/jquery.js"></script>
<script type="text/javascript" src="{tpl_path}js/function.js"></script>
<script language="javascript">
var onerror_pic_path="{tpl_path}images/common/none.gif";
var pic_loading_path="{tpl_path}images/common/loading.gif";
var js_root_path="<?php echo my_site_url();?>";
</script>
</head>

<body>

<div class="site-nav">
  <div class="site-nav-bd">
    <ul class="site-nav-bd-l">
      <li class="menu">
        <div class="menu-hd">欢迎访问 : <?php echo $site_title;?></div>
      </li>
    </ul>
    <ul class="site-nav-bd-r">
      <li class="menu">
        <div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare" style=" padding-top:5px"><a class="bds_qzone"></a> <a class="bds_tsina"></a> <a class="bds_tqq"></a> <a class="bds_renren"></a> <a class="bds_t163"></a><a class="bds_taobao"></a><a class="bds_kaixin001"></a><a class="bds_tsohu"></a><span class="bds_more" style="vertical-align: middle"></span></div>
      </li>
      <li class="site-nav-pipe">|</li>
      <li class="menu">
        <div class="menu-hd"><a href="/">网站首页</a></div>
      </li>
      <li class="menu">
        <div class="menu-hd"><a href="javascript:void(0)" onclick="SetHome(this,'<?php echo base_url();?>')">设为主页</a></div>
      </li>
      <li class="menu">
        <div class="menu-hd"><a href="javascript:void(0)" onclick="AddFavorite('<?php echo base_url();?>', '<?php echo $this->config->item('sys_site_name');?>')">收藏本站</a></div>
      </li>
      <li class="menu">
        <div class="menu-hd"><a href="<?php echo my_site_url('m/home');?>">手机版</a></div>
      </li>
    </ul>
  </div>
</div>



<div class="header">
  <div class="area">
    <div class="logo logo1">
      <div class="fl"><a class="juan-logo fl" href="<?php echo base_url();?>" title="<?php echo $this->config->item('sys_site_name');?>"><img alt="<?php echo $this->config->item('sys_site_name');?>" src="<?php echo get_real_path($this->config->item('sys_site_logo'));?>" /></a></div>
    </div>
    <div class="protection" style="background:url({tpl_path}images/54a1939500fc7.gif) no-repeat;"><a title="每天10点开抢" class="update"></a><a title="职业买手砍价" class="lowest"></a><a title="商品验货质检" class="check"></a></div>
    <div class="search">
      <form name="search" action="<?php echo site_url(CTL_FOLDER.'s');?>" method="get" id="search" onsubmit="if(this.q.value == this.q.defaultValue) this.q.value = '';">
        <span class="search-area fl">
        <input name="q" class="txt" value="懒得找了，我搜..." onblur="if(this.value == '') this.value = this.defaultValue;" onclick="if(this.value == this.defaultValue) this.value = '';" />
        </span>
        <input type="submit" id="k" value="" class="smt fr" />
      </form>
    </div>
  </div>
  <div class="mainNav">
    <div class="nav">
      <ul class="navigation fl">
        <?php  $i = 1;foreach(get_cache('top_nav') as $row){?>
        <li><a style="font-weight:bold" href="<?php echo $row->hplink;?>" target="<?php echo $row->target;?>" title="<?php echo $row->title;?>"><?php echo $row->title;?></a></li>
        <?php  if($i >= 13) break; $i++; }?>
      </ul>
      <div class="state-show fr" > </div>
    </div>
  </div>
</div>