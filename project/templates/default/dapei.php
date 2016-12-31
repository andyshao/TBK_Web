<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view(TPL_FOLDER."header");?>
<style type="text/css">
#infscr-loading {
	bottom:10px;
	left:45%;
	position:absolute;
	text-align:center;
	height:20px;
	line-height:20px;
	z-index:100;
	width:120px;
	margin:0 auto
}
</style>
<div class="con-wrap page-content lis-page">
  <div class="list-main">
    <div class="list-title clearfix">
      <div class="dapei-listnav">
        <div class="nav-tags clearfix">
        <?php foreach($tag as $k=>$v){?>
        <a href="<?php echo my_site_url('dapei/'.$k);?>" <?php if($k == $tagid) echo 'class="current"';?>><?php echo $v;?></a>
        <?php }?></div>
      </div>
    </div>
  </div>
  <div class="ucenter-list-wrap clearfix style-listpage" id="J_dataContent">
    <div class="list-con-inner clearfix style-waterfall inline-waterfall">
      <div class="ks-waterfall-col">
        <?php if(isset($query) && $query){
	  foreach($query as $row){?>
        <div class="mate-box ks-waterfall">
          <div class="info-wrap">
            <div class="info-img"><a rel="nofollow" href="<?php echo $row['clickUrl'];?>" target="_blank"><img src="<?php echo $row['mainPic'];?>_240x10000Q90.jpg" alt="<?php echo $row['description'];?>" width="224" ></a>
              <div class="info-detail"><span class="itemnum"><?php echo $row['itemNum'];?>件搭配宝贝</span>
                <div class="thumb-goods" style="display: none;">
                  <div class="thumb-mL10 clearfix">
                    <?php if($row['itemPics']){
					  $item_pic = explode(',',$row['itemPics']);
					  foreach($item_pic as $v){
					?>
                    <a rel="nofollow" href="<?php echo $row['clickUrl'];?>" target="_blank"><img src="<?php echo $v;?>_72x72xz.jpg" alt="<?php echo $row['description'];?>"></a>
                    <?php }}?>
                  </div>
                </div>
              </div>
            </div>
            <p class="goods-txt"><?php echo $row['description'];?></p>
            <p class="share-action clearfix"><a rel="nofollow" href="<?php echo $row['clickUrl'];?>" class="favorite J_favorite" target="_blank">去看看</a></p>
          </div>
          <div class="share-user">
            <p class="user-line"><a rel="nofollow" href="<?php echo $row['clickUrl'];?>" target="_blank" class="user-img"><img src="<?php echo $row['memberInfoVO']['avatar'];?>" alt="<?php echo $row['memberInfoVO']['name'];?>"></a><em class="uname"><a rel="nofollow" href="<?php echo $row['clickUrl'];?>" target="_blank"><?php echo $row['memberInfoVO']['name'];?></a></em><span class="daren-icon"></span></p>
          </div>
        </div>
        <?php }}?>
      </div>
    </div>
    <div id="infscr-loading"></div>
  </div>
  <div id="more">
  <?php if(isset($paged) && isset($paged['pages']) && $paged['pages'] > 1){?>
  <a href="<?php echo my_site_url('ajax/get_water/'.$tagid);?>?page=2"></a>
  <?php }?>
  </div>
</div>
<script language="javascript">
var isWidescreen = window.screen.width >= 1280;
if(isWidescreen){document.write("<style type='text/css'>.con-wrap{width:1194px;}</style>");}
function item_masonry()
{ 
	$('.mate-box img').load(function(){ 
		$('.ks-waterfall-col').masonry({ 
			itemSelector: '.ks-waterfall',
			columnWidth:224,
			gutterWidth:15								
		});		
	});
		
	$('.ks-waterfall-col').masonry({ 
		itemSelector: '.ks-waterfall',
		columnWidth:224,
		gutterWidth:15								
	});	
}
$(function(){
	function item_callback(){ 		
		$('.mate-box').mouseover(function(){			
			$('.thumb-goods',this).show();
			$('.itemnum',this).hide();
		}).mouseout(function(){			
			$('.thumb-goods',this).hide();	
			$('.itemnum',this).show();
		});		
		item_masonry();	
	}
	item_callback(); 
	$('.mate-box').fadeIn();
	
	$(".ks-waterfall-col").infinitescroll({
		navSelector  	: "#more",
		nextSelector 	: "#more a",
		itemSelector 	: ".mate-box",		
		loading:{
			img: "{tpl_path}images/masonry_loading_1.gif",
			msgText: '',
			finishedMsg: '木有数据...',          		
			finished: function(){
				$("#infscr-loading").hide();
				//$(window).unbind('.infscr');
			}	
		},errorCallback:function(){ 
		
		}		
	},function(newElements){
		var $newElems = $(newElements);
		$('.ks-waterfall-col').masonry('appended', $newElems, false);
		$newElems.fadeIn();
		item_callback();
		return;
	});
});
</script>
<script type="text/javascript" src="{tpl_path}js/jquery.masonry.js"></script>
<script type="text/javascript" src="{tpl_path}js/jquery.infinitescroll.js"></script>
<?php $this->load->view(TPL_FOLDER."footer");?>