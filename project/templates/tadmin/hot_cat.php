<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view(TPL_FOLDER."header");?>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" >
  <tr>
    <td width="3%" align="left" ><img src="{tpl_path}images/forward.jpg" /></td>
    <td width="97%" align="left" >您现在的位置：<a href="<?php echo site_url(CTL_FOLDER."hot_cat");?>">搜索关键词</a></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:5px 0;">
  <tr>
    <td width="390" height="24" align="right" ><a href="<?php echo my_site_url(CTL_FOLDER.'hot_cat/add_record_view');?>"><img src="{tpl_path}images/add.png">添加</a></td>
    <td width="367" align="right"  style="padding-right:10px"><a href="<?php echo my_site_url(CTL_FOLDER.'hot_cat/re_cache');?>"><img src="{tpl_path}images/refresh.jpg"  /> 更新缓存</a></td>
  </tr>
</table>
<form method="post" name="list_form" id="list_form">
  <table width="100%" cellspacing="0" class="widefat">
    <thead>
      <tr>
        <th width="5%" ><input type="checkbox" onclick="check_box(this.form.rd_id)" /></th>
        <th width="29%">搜索关键词</th>
        <th width="17%">淘宝类目ID</th>
        <th width="30%">显示关键词</th>
        <th width="12%">排序</th>
        <th width="7%">操作</th>
      </tr>
    </thead>
    <tbody id="check_box_id">
      <?php $cat = $query;
	  foreach($query as $row) {
		  if($row->parent_id == 0){
	?>
      <tr>
        <td><input name="rd_id[]" type="checkbox" id="rd_id" value="<?php echo $row->id;?>"></td>
        <td><a href="<?php echo my_site_url('s');?>?q=<?php echo urlencode($row->q);?>" target="_blank"><?php echo $row->q;?></a></td>
        <td><?php echo $row->cid;?></td>
        <td><a href="<?php echo my_site_url('s');?>?q=<?php echo urlencode($row->q);?>" target="_blank"><?php echo $row->cat_name;?></a></td>
        <td><input name="sort<?php echo $row->id;?>" value="<?php echo $row->seqorder;?>" type="text" size="2" maxlength="10" dataType="Integer" msg="排序号必须为数字"></td>
        <td><a href="<?php echo site_url(CTL_FOLDER."hot_cat/edit_record/".$row->id);?>">修改</a></td>
      </tr>
      <?php foreach($cat as $row1){
		 if($row1->parent_id == $row->id){?>
         <tr>
        <td><input name="rd_id[]" type="checkbox" id="rd_id" value="<?php echo $row1->id;?>"></td>
        <td style="padding-left:20px">|--<a href="<?php echo my_site_url('s');?>?q=<?php echo urlencode($row1->q);?>" target="_blank"><?php echo $row1->q;?></a></td>
        <td><?php echo $row1->cid;?></td>
        <td><a href="<?php echo my_site_url('s');?>?q=<?php echo urlencode($row1->q);?>" target="_blank"><?php echo $row1->cat_name;?></a></td>
        <td><input name="sort<?php echo $row1->id;?>" value="<?php echo $row1->seqorder;?>" type="text" size="2" maxlength="10" dataType="Integer" msg="排序号必须为数字"></td>
        <td><a href="<?php echo site_url(CTL_FOLDER."hot_cat/edit_record/".$row1->id);?>">修改</a></td>
      </tr>
      <?php }}?>
      <?php }}?>
    </tbody>
  </table>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td style="padding-top:5px"><select name="action_url" id="action_url">
          <option value="" style="color:#FF0000">-选择操作-</option>
          <option value="<?php echo site_url(CTL_FOLDER."hot_cat/del_record");?>">删除</option>
          <option value="<?php echo site_url(CTL_FOLDER."hot_cat/sort_record");?>">排序</option>
        </select>
        &nbsp;
        <input type="button" name="submit_list_button" class="button-style2" onclick="submit_list_form(this.form,this)" id="submit_list_button" value="执行操作" /></td>
    </tr>
  </table>
</form>
<?php $this->load->view(TPL_FOLDER."footer");?>
