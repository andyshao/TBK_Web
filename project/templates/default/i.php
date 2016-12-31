<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view(TPL_FOLDER."header");?>
<?php 
	  $price = $query['reserve_price'];
	  $rate = 0;
	  if(isset($query['zk_final_price']) && $query['reserve_price'] > $query['zk_final_price'])
	  {
		  $price = $query['zk_final_price'];
		  $rate = round(($query['zk_final_price'] / $query['reserve_price']) * 10,1) ;
	  }
?>
<link rel="stylesheet" href="{root_path}js/jquery/jqzoom/css/jquery.jqzoom.css" type="text/css" />
<div class="wrap" style="padding:15px 10px">
  <div class="goods_info">
    <div class="goods_info_l">
      <div class="ui-tx-small-pic-list">
        <ul>
          <li><a class="zoomThumbActive" href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php echo $query['pict_url'].'_400x400.jpg';?>',largeimage: '<?php echo $query['pict_url'];?>'}"><img class="act" width="70" height="70" src="<?php echo $query['pict_url'].'_70x70.jpg';?>" alt="<?php echo $query['title'];?>" /></a></li>
          <?php 
		  if(isset($query['small_images']['string'])){
			  foreach($query['small_images']['string'] as $v){
			?>
          <li><a href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php echo $v.'_400x400.jpg';?>',largeimage: '<?php echo $v;?>'}"><img src="<?php echo $v.'_70x70.jpg';?>" width="70" height="70" alt="<?php echo $query['title'];?>" /></a></li>
          <?php }}?>
        </ul>
      </div>
      <div class="goods_info_img"> <a class="jqzoom" rel='gal1' href="<?php echo $query['pict_url'];?>"><img src="<?php echo $query['pict_url'].'_400x400.jpg';?>" width="400" height="400" alt="<?php echo $query['title'];?>" /></a> </div>
    </div>
    <div class="goods_info_r">
      <div class="goods_title"><a href="<?php echo site_url(CTL_FOLDER.'i/'.$num_iid);?>"><?php echo $query['title'];?></a></div>
      <ul>
        <?php if($rate > 0){?>
        <li class="price"><span class="i-discount">折扣价格<em></em></span>￥<b><?php echo $price;?></b>元</li>
        <li class="price">原价：￥<font style=" text-decoration:line-through"><?php echo $query['reserve_price'];?></font>元 (<?php echo $rate;?>折)</li>
        <?php }else{?>
        <li class="price">价格：￥<b><?php echo $price;?></b> 元</li>
        <?php }?>
        <li style="display:none">销量：<span class="cblue fb" id="volume">0</span> 件</li>
        <li>所在地：<?php echo $query['provcity'];?></li>
        <li>商品来源：<?php if($query['user_type'] == 1){?>
        <img src="{tpl_path}images/tmall.png" alt="天猫" /> 天猫
        <?php }else{?>
        <img src="{tpl_path}images/taobao.png" alt="淘宝" /> 淘宝
        <?php }?>
        </li>
      </ul>
      <div class="go_buy"> <a href="<?php echo my_site_url(CTL_FOLDER.'clk/'.$num_iid);?>" target="_blank" rel="nofollow"><img src="{tpl_path}images/go_buy.png" alt="购买商品" /></a> </div>
      <div class="bdsharebuttonbox"><a style=" background:none; padding-left:0">分享到：</a><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a><a href="#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_tieba" data-cmd="tieba" title="分享到百度贴吧"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a></div>
    </div>
    <div class="clear"></div>
    <a name="com"></a>
    <div class="ui-tx-tab-h" style="display:block; clear:both">
      <ul>
        <li class="ui-tx-tab-h-active">宝贝评价</li>
      </ul>
    </div>
    <div id="comment_list">该宝贝暂无评价... </div>
  </div>
  <div class="end_ab_b">
    <h4 class="tit1">您或许还喜欢</h4>
    <ul class="imglist" id="get_related_product" data-url="<?php echo my_site_url('ajax/get_related_product/'.$num_iid);?>">
      数据加载中...
    </ul>
  </div>
  <div class="clear"></div>
</div>
<script type="text/javascript">
<?php if($query['user_type'] == 1){?>
var rate_api = 'http://rate.tmall.com/list_detail_rate.htm?sellerId={user_id}&itemId=<?php echo $num_iid;?>&order=0&forShop=1&append=0&ismore=1&content=0&currentPage={page}&callback=?';
<?php }else{?>
var rate_api = 'http://rate.taobao.com/feedRateList.htm?userNumId={user_id}&auctionNumId=<?php echo $num_iid;?>&siteID=0&rateType=&orderType=sort_weight&showContent=1&currentPageNum={page}&callback=?';
<?php }?>
var com_tpl = '<div class="com_list"><p class="com_text">{com_content}</p><p class="com_user">{com_user} 发表于 {com_date}</p></div>';
$(document).ready(function(){
	$.get($('#get_related_product').attr('data-url'),function(msg){
		$('#get_related_product').html(msg);
	});
	$('.jqzoom').jqzoom({
		zoomType: 'standard',
		lens:true,
		preloadImages: false,
		alwaysOn:false,
		title:false,
		zoomWidth:400,
		zoomHeight:400
	});
	$.ajax({
		url:'<?php echo my_site_url('ajax/get_volume/'.$num_iid);?>',
		dataType:'JSON',
		type:'GET',
		success:function(msg)
		{
			if(typeof(msg.volume) != 'undefined')
			{
				$('#volume').html(msg.volume).parent().show();
				rate_api = rate_api.replace(/\{user\_id\}/,msg.user_id);
				get_comment(1);
			}
		}
	})
});
function get_comment(p)
{
	if( ! p) return;
	$('#comment_list').html('正在努力加载中...');
	var t_url = rate_api.replace(/\{page\}/,p);
	$.getJSON(t_url,function(msg){
		var str = '';
		if(typeof(msg.comments) != 'undefined' && msg.comments != null)
		{
			$.each(msg.comments,function(j,items){
				var t_str = com_tpl.replace(/\{com_content\}/,items.content);
				t_str = t_str.replace(/\{com_user\}/,items.user.nick);
				t_str = t_str.replace(/\{com_date\}/,items.date);
				str = str + t_str;
			});
			str = str + paginate(p,msg.maxPage);
		}
		else if(typeof(msg.rateDetail) != 'undefined')
		{
			$.each(msg.rateDetail.rateList,function(j,items){
				var t_str = com_tpl.replace(/\{com_content\}/,items.rateContent);
				t_str = t_str.replace(/\{com_user\}/,items.displayUserNick);
				t_str = t_str.replace(/\{com_date\}/,items.rateDate);
				str = str + t_str;
			});
			str = str + paginate(p,msg.rateDetail.paginator.lastPage);
		}
		if(str == '') $('#comment_list').html('该宝贝暂无评价...');
		else $('#comment_list').html(str);
	})
}
function paginate(cur_page,total_page)
{
	if(total_page == 0) total_page = 1;
	var page_str = '<div class="ui-tx-page">';
	if(total_page == 1) return '';
	var page_start = cur_page - 4;
	if(page_start <= 0) page_start = 1;
	var page_end = cur_page + 4;
	if(page_end > total_page) page_end = total_page;
	if(cur_page > 1) page_str += '<a href="#com" onclick="get_comment('+(cur_page-1)+')">上一页</a>';
	for(var i = page_start;i <= page_end; i++)
	{
		if(cur_page == i)
		{
			page_str += '<span>'+i+'</span>';
		}
		else
		{
			page_str += '<a href="#com" onclick="get_comment('+i+')">'+i+'</a>';
		}
	}
	if(cur_page < total_page) page_str += '<a href="#com" onclick="get_comment('+(cur_page+1)+')">下一页</a>';
	page_str += '</div>';
	return page_str;
}
</script> 
<script src="{root_path}js/jquery/jqzoom/js/jquery.jqzoom-core.js" type="text/javascript" charset="gb2312"></script> 
<script>
window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"24"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
</script>
<?php $this->load->view(TPL_FOLDER."footer");?>