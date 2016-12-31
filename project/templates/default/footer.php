<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="foot">
  <div class="white_bg">
    <div class="foot-con">
      <p>
        <?php  $i = 1; foreach(get_cache('bot_nav') as $row){?>
        <a style="margin: 0 8px" title="<?php echo $row->title;?>" href="<?php echo $row->hplink;?>" target="<?php echo $row->target;?>"><?php echo $row->title;?></a>
        <?php  if($i >= 20) break; $i++; }?>
      </p>
      <p><strong>友情链接：</strong>
<?php foreach(get_cache('link') as $row){?>
        <a style="margin: 0 8px" href="<?php echo $row->hplink;?>" target="_blank" title="<?php echo $row->title;?>"><?php echo $row->title;?></a>
        <?php }?>
      </p>
      <p><?php echo $this->config->item('sys_site_copyright');?>
        技术支持： <a href="http://bbs.soke5.com/" target="_blank">搜客淘宝客</a>
        <?php echo html_entity_decode($this->config->item('sys_tongji'),ENT_QUOTES);?></p>
    </div>
  </div>
</div>
<div class="side_right" style="display:none">
  <div class="con"> <a href="javascript:void(0)" class="trigger go-top">
    <p>回到<br>
      顶部</p>
    <span><i class="icon icon-03"></i></span></a></div>
</div>
<script language="javascript">
$(function(){
	$('div.side_right').click(function(){$("html, body").animate({ scrollTop: 0 }, 50);});
	var $backToTopFun = function() {
		var st = $(document).scrollTop();
		var winh = $(window).height();
		(st > 0)? $('div.side_right').show():$('div.side_right').hide();    
		if ( ! window.XMLHttpRequest) {
			$('div.side_right').css("top", st + winh - 166);    
		}
	};
	$(window).bind("scroll", $backToTopFun);
});
</script> 
<?php echo get_taodianjin();?>
</body>
</html>