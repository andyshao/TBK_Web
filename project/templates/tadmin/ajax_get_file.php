<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php if($pre_path){?>
<div class="ajax_get_file_nav"><img src="{tpl_path}images/file/Back.gif" /> <a href="javascript:ReloadFileDialog('<?php echo $pre_path;?>')" style="color:#FF0000">返回上层文件夹</a></div>
<?php } ?>
<div class="ajax_get_file">
  <?php foreach($file_list as $f_item){if(isset($f_item['folder_path'])){?>
  <div> <a title="<?php echo $f_item['folder_name'];?>" href="javascript:ReloadFileDialog('<?php echo $f_item['folder_path'];?>')"> <img src="{tpl_path}images/file/folder.jpg" />
     <p><?php echo $f_item['folder_name'];?></p></a> </div>
  <?php }else{?>
  <div> <a title="<?php echo $f_item['name'];?>" href="javascript:void(0)" onclick="GetFilePath(this)" rel="<?php echo $f_item['relative_path'].$f_item['name'];?>" >
    <?php  $img_ext=array('.jpg','.jpeg','.gif','.jpe','.png','.bmp');
	  if( ! in_array(strtolower(strstr($f_item['name'],'.')),$img_ext))
	  {
	  ?>
    <img src="{tpl_path}images/file/notype.jpg" />
    <?php }else{?>
    <img src="<?php echo ROOT_PATH.$f_item['relative_path'].$f_item['name'];?>" width="80" height="80" border="0" />
    <?php }?>
    <p><?php echo $f_item['name'];?></p></a></div>
  <?php }}?>
  <div class="clear"></div>
</div>