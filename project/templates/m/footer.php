<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="viewport">
  <div class="layout-footer"> <?php echo $this->config->item('sys_site_copyright');?> &nbsp;
    <?php if($this->config->item('sys_is_power') == 1) echo APP_POWER;?>
    <?php echo html_entity_decode($this->config->item('sys_tongji'),ENT_QUOTES);?> </div>
</div>
<div id="J_scrollTop"><a class="upto-top" href="javascript:void(0);" title="回到顶部">回到顶部</a></div>
<script language="javascript">
$(function(){
	$('#J_scrollTop').click(function(){$("html, body").animate({ scrollTop: 0 }, 100);}); 				    var $backToTopFun = function() {
		var st = $(document).scrollTop();
		var winh = $(window).height();
		(st > 0)? $('#J_scrollTop').show(): $('#J_scrollTop').hide();    
		if (!window.XMLHttpRequest) {
			$('#J_scrollTop').css("top", st + winh - 166);    
		}
	};
	$(window).bind("scroll", $backToTopFun);
	$(function() { $backToTopFun(); });
});
</script>
<?php echo get_taodianjin();?>
</body>
</html>