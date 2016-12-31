<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view(TPL_FOLDER."header");?>
<script language="javascript">
var isMobile = {
	Android: function() {
		return navigator.userAgent.match(/Android/i) ? true : false;
	},
	BlackBerry: function() {
		return navigator.userAgent.match(/BlackBerry/i) ? true : false;
	},
	iOS: function() {
		return navigator.userAgent.match(/iPhone|iPad|iPod/i) ? true : false;
	},
	Windows: function() {
		return navigator.userAgent.match(/IEMobile/i) ? true : false;
	},
	any: function() {
		return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Windows());
	}
};
if( isMobile.any() ) 
{
	document.location.href='<?php echo site_url('m/home');?>';
}
</script>
<div class="keyword-box-bg">
  <div class="keyword-box">
    <ul>
      <?php $cat1 = $cat2 = get_cache('hot_cat'); foreach($cat1 as $row1){ if($row1->parent_id == 0){ ?>
      <li><a style="font-weight:bold; font-size:14px" href="<?php echo my_site_url('s');?>?q=<?php echo urlencode($row1->q);?><?php if($row1->cid) echo '&cid='.urlencode($row1->cid);?>"><?php echo $row1->cat_name;?>：</a>
        <?php $i = 1;foreach($cat2 as $row2){ if($row2->parent_id == $row1->id){ ?>
        <a href="<?php echo my_site_url('s');?>?q=<?php echo urlencode($row2->q);?><?php if($row2->cid) echo '&cid='.urlencode($row2->cid);?>"><?php echo $row2->cat_name;?></a>
        <?php if($i >= 5) break; $i++;}}?>
      </li>
      <?php }}?>
    </ul>
  </div>
</div>
<div class="main w1200">
  <div class="s-bar clearfix">
    <ul>
      <li class="l">搜索到与“
        <?php if(isset($get['q'])) echo $get['q'];?>
        ”相关的宝贝 <strong><?php echo format_num($total);?></strong> 件</li>
      <li class="m">
        <form action="<?php echo my_site_url('s');?>" onsubmit="return check_goods_search(this)">
          价格：
          <input type="text" name="s_price" maxlength="10" size="6" <?php if(isset($get['s_price'])){?> value="<?php echo $get['s_price'];?>"<?php }?> class="input-text"  />
          -
          <input type="text" name="e_price" maxlength="10" size="6" <?php if(isset($get['e_price'])){?> value="<?php echo $get['e_price'];?>"<?php }?> class="input-text"  />
          &nbsp;
          <input type="submit" value="搜索" class="input-btn" alt="搜索" />
          <?php if(isset($get['q']) && $get['q']){?>
          <input type="hidden" name="q" value="<?php echo $get['q'];?>" />
          <?php }?>
          <?php if(isset($get['cid']) && $get['cid']){?>
          <input type="hidden" name="cid" value="<?php echo $get['cid'];?>" />
          <?php }?>
          <?php if(isset($get['sorts']) && $get['sorts']){?>
          <input type="hidden" name="sorts" value="<?php echo $get['sorts'];?>" />
          <?php }?>
          <label style=" margin-left:30px">
            <input type="checkbox" name="is_tmall" value="1" onclick="sub_form(this.form)" <?php if(isset($get['is_tmall']) && $get['is_tmall'] == 1) echo 'checked';?> />
            天猫</label>
        </form>
      </li>
      <li class="r">
        <div class="page-tips"> <font style="color:#F00"><?php echo $page_no;?></font> / <?php echo $page_total;?> </div>
        <?php echo $paginate_top;?> </li>
    </ul>
  </div>
  <div class="main pr clear" style="margin-top:10px">
    <ul class="goods-list clear">
      <?php  if(isset($query)){ $i = 1; foreach($query as $row){ $title = replace_s($row['title']); $price = $row['reserve_price']; $rate = 0; if(isset($row['zk_final_price']) && $row['reserve_price'] > $row['zk_final_price']) { $price = $row['zk_final_price']; $rate = round(($row['zk_final_price'] / $row['reserve_price']) * 10,1) ; } ?>
      <li <?php if($i % 4 == 0) echo 'class="last"';?>>
        <div class="list-good buy">
          <div class="good-pic"> <a class="pic-img" href="<?php echo my_site_url('i/'.$row['num_iid']);?>" target="_blank"><img original="<?php echo $row['pict_url'].'_284x284.jpg';?>" alt="<?php echo $title;?>" <?php if($i <= 8){ echo 'class="loading_284 good-pic"';}else{ echo 'class="lazy-load good-pic"';}?> /> </a> </div>
          <h3 class="good-title"><a class="pic-img" href="<?php echo my_site_url('i/'.$row['num_iid']);?>" target="_blank" title="<?php echo $title;?>"><?php echo $title;?></a></h3>
          <div class="good-price"><span class="price-current" ><em>￥</em><?php echo $price;?></span><span class="des-other"><strong></strong>
            <?php if($rate > 0){?>
            <p><span class="price-old"><em>￥</em><?php echo $row['reserve_price'];?></span><span class="discount">(<em><?php echo $rate;?></em>折)</span></p>
            <?php }?>
            </span>
            <div class="btn buy m-buy"><a class="pic-img" href="<?php echo my_site_url('i/'.$row['num_iid']);?>" target="_blank">
              <?php if($row['user_type'] == 1){?>
              <em class="m-icon"></em><span>天猫</span>
              <?php }else{?>
              <em class="t-icon"></em><span>淘宝</span>
              <?php }?>
              </a></div>
          </div>
        </div>
      </li>
      <?php $i++;}}?>
    </ul>
    <div class="page"><em></em>
      <div><?php echo $paginate;?></div>
    </div>
  </div>
</div>
<script language="javascript">
function check_goods_search(o)
{
	var p_s = o.s_price.value;
	var p_e = o.e_price.value;
	var reg = new RegExp(/^\d+(\.\d+)?$/);
	if( ! reg.test(p_s))
	{
		alert('起始价格有误，请重新填写');
		return false;
	}
	if( ! reg.test(p_e))
	{
		alert('结束价格有误，请重新填写');
		return false;
	}
	if(parseInt(p_s) > parseInt(p_e))
	{
		alert('起始价格不能大于结束价格');
		return false;
	}
}
function sub_form(f)
{
	f.submit();
}
$(function(){
	$("img.lazy-load").lazyload({
		placeholder : '{tpl_path}images/alpha.png',
        effect : "fadeIn",
		maxsize : 284
	});
	$("img.loading_284").each(function(){
		LoadImage($(this),$(this).attr("original"),284);
	});
	$.get(js_root_path+'ajax/del_apicache',function(msg){});
});
</script> 
<script src="{tpl_path}js/lazy_load.js" type="text/javascript"></script>
<?php $this->load->view(TPL_FOLDER."footer");?>
