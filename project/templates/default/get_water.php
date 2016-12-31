<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php if(isset($query) && $query){
	  foreach($query as $row){?>
<div class="mate-box ks-waterfall">
  <div class="info-wrap">
    <div class="info-img"><a href="<?php echo $row['clickUrl'];?>" target="_blank"><img src="<?php echo $row['mainPic'];?>_240x10000Q90.jpg" alt="<?php echo $row['description'];?>" width="224" ></a>
      <div class="info-detail"><span class="itemnum"><?php echo $row['itemNum'];?>件搭配宝贝</span>
        <div class="thumb-goods" style="display: none;">
          <div class="thumb-mL10 clearfix">
            <?php if($row['itemPics']){
					  $item_pic = explode(',',$row['itemPics']);
					  foreach($item_pic as $v){
					?>
            <a href="<?php echo $row['clickUrl'];?>" target="_blank"><img src="<?php echo $v;?>_72x72xz.jpg" alt="<?php echo $row['description'];?>"></a>
            <?php }}?>
          </div>
        </div>
      </div>
    </div>
    <p class="goods-txt"><?php echo $row['description'];?></p>
    <p class="share-action clearfix"><a href="<?php echo $row['clickUrl'];?>" class="favorite J_favorite" target="_blank">去看看</a></p>
  </div>
  <div class="share-user">
    <p class="user-line"><a href="<?php echo $row['clickUrl'];?>" target="_blank" class="user-img"><img src="<?php echo $row['memberInfoVO']['avatar'];?>" alt="<?php echo $row['memberInfoVO']['name'];?>"></a><em class="uname"><a href="<?php echo $row['clickUrl'];?>" target="_blank"><?php echo $row['memberInfoVO']['name'];?></a></em><span class="daren-icon"></span></p>
  </div>
</div>
<?php }}?>
