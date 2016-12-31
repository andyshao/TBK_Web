<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
if(isset($query)){
	foreach($query as $row){
	  $price = $row['reserve_price'];
	  $rate = '无';
	  if(isset($row['zk_final_price']) && $row['reserve_price'] > $row['zk_final_price'])
	  {
		  $price = $row['zk_final_price'];
		  $rate = round(($row['zk_final_price'] / $row['reserve_price']) * 10,1) ;
	  }
?>
<li><a href="<?php echo my_site_url('i/'.$row['num_iid']);?>" title="<?php echo $row['title'];?>"><img src="<?php echo $row['pict_url'].'_180x180.jpg';?>" alt="<?php echo $row['title'];?>" /> </a>
  <p class="tc"><span class="cred fb"><?php echo format_curren($price);?></span>&nbsp;&nbsp;&nbsp;&nbsp;(<?php echo $rate;?>折)</p>
  <p class="tc"><a href="<?php echo my_site_url('i/'.$row['num_iid']);?>" title="<?php echo $row['title'];?>"><?php echo strcut($row['title'],15);?></a></p>
</li>
<?php }}?>
