<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view(TPL_FOLDER."header");?>
<div class="viewport" style="padding-top:50px">
  <div class="row_con">
    <h2 style="font-size:12px; font-weight:normal">共找到<strong style="color:#F00"><?php echo format_num($total);?></strong>件相关宝贝</h2>
    <?php if(isset($query) && $query){
	foreach($query as $row){
	$title = replace_s($row['title']);
	  $price = $row['reserve_price'];
	  $rate = 0;
	  if(isset($row['zk_final_price']) && $row['reserve_price'] > $row['zk_final_price'])
	  {
		  $price = $row['zk_final_price'];
		  $rate = round(($row['zk_final_price'] / $row['reserve_price']) * 10,1) ;
	  }	
	?>
    <dl class="list">
      <dt><a rel="nofollow" href="<?php echo my_site_url(CTL_FOLDER.'clk/'.$row['num_iid']);?>" target="_blank"><img src="<?php echo $row['pict_url'].'_100x100.jpg';?>" alt="<?php echo $title;?>" width="100" /></a></dt>
      <dd>
        <p><a rel="nofollow" href="<?php echo my_site_url(CTL_FOLDER.'clk/'.$row['num_iid']);?>" target="_blank"><?php echo $title;?></a> </p>
        <?php if($rate > 0){?>
        <span>¥<?php echo $price;?></span> <del><?php echo $row['reserve_price'];?></del>
        <?php }else{?>
        <span>¥<?php echo $row['reserve_price'];?></span>
        <?php }?>
        <br>
        <?php if($row['user_type'] == 1){?>
        <b><img src="{tpl_path}images/tmall.png" style="vertical-align:middle" alt="去天猫购买" /> 天猫</b>
        <?php }else{?>
        <b><img src="{tpl_path}images/taobao.png" style="vertical-align:middle" alt="去淘宝购买" /> 淘宝</b>
        <?php }?>
        <a rel="nofollow" href="<?php echo my_site_url(CTL_FOLDER.'clk/'.$row['num_iid']);?>" target="_blank" class="btn">去购买</a> </dd>
    </dl>
    <?php }}?>
  </div>
  <?php if( ! isset($query)){?>
  <div id="tips_msg" style="display:block"><?php echo '木有数据了...';?></div>
  <?php }else{?>
  <div id="tips_msg"></div>
  <?php }?>
</div>
<?php if(isset($query) && $query){?>
<script language="javascript">
var page=2;
var loaded = true;
function scroll_load()
{
  var top = $("#tips_msg").offset().top;
  if(loaded && $(this).scrollTop() + $(window).height() + 100 >= $(document).height())
  {
	 $("#tips_msg").html("正在努力加载数据...").show();
	 $.ajax(
	 {
		 type: "GET",
		 dataType: "text",
		 url: "<?php echo site_url(CTL_FOLDER.'ajax/get_product');?>",
		 data: "<?php if(isset($_SERVER['QUERY_STRING'])) echo $_SERVER['QUERY_STRING'];?>&page="+page,
		 success: function(msg)
		 {
			if(msg == "nodata")
			{
				$("#tips_msg").html("木有数据了...");
				loaded=false;
			}
			else
			{
				page++;
				$("#tips_msg").hide();
				$(msg).appendTo('div.row_con');
			}
		 }
	  }
	);
  }
}
$(window).scroll(scroll_load);
</script>
<?php }?>
<?php $this->load->view(TPL_FOLDER."footer");?>
