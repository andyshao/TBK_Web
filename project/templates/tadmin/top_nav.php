<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view(TPL_FOLDER."header");?>

<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" >
  <tr>
    <td width="3%" align="left" ><img src="{tpl_path}images/forward.jpg" /></td>
    <td width="97%" align="left" >您现在的位置：<a href="<?php echo site_url(CTL_FOLDER."top_nav");?>">顶部导航</a></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:5px 0;">
  <tr>
    <td width="390" height="24" align="right" ><a href="<?php echo my_site_url(CTL_FOLDER.'top_nav/add_record_view');?>"><img src="{tpl_path}images/add.png">添加导航</a></td>
    <td width="367" align="right"  style="padding-right:10px"><a href="<?php echo my_site_url(CTL_FOLDER.'top_nav/re_cache');?>"><img src="{tpl_path}images/refresh.jpg"  /> 更新缓存</a></td>
  </tr>
</table>
<form method="post" name="list_form" id="list_form">
  <table width="100%" cellspacing="0" class="widefat">
    <thead>
      <tr>
        <th width="4%" ><input type="checkbox" onclick="check_box(this.form.rd_id)" /></th>
        <th width="22%">导航名称</th>
        <th width="42%">链接</th>
        <th width="12%">目标</th>
        <th width="12%">排序</th>
        <th width="8%">操作</th>
      </tr>
    </thead>
    <tbody id="check_box_id">
      <?php foreach($query as $row) {?>
      <tr>
        <td><input name="rd_id[]" type="checkbox" id="rd_id" value="<?php echo $row->id;?>"></td>
        <td><?php echo $row->title;?></td>
        <td><a href="<?php echo $row->hplink;?>" target="_blank"><?php echo $row->hplink;?></a></td>
        <td><?php if($row->target == '_self') echo '本窗口';
		else echo '新窗口';
		?></td>
        <td><input name="sort<?php echo $row->id;?>" value="<?php echo $row->seqorder;?>" type="text" size="2" maxlength="10" dataType="Integer" msg="排序号必须为数字"></td>
        <td><a href="<?php echo site_url(CTL_FOLDER."top_nav/edit_record/".$row->id);?>">修改</a></td>
      </tr>
      <?php }?>
    </tbody>
  </table>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td style="padding-top:5px"><select name="action_url" id="action_url">
          <option value="" style="color:#FF0000">-选择操作-</option>
          <option value="<?php echo site_url(CTL_FOLDER."top_nav/del_record");?>">删除</option>
          <option value="<?php echo site_url(CTL_FOLDER."top_nav/sort_record");?>">排序</option>
        </select>
        &nbsp;
        <input type="button" name="submit_list_button" class="button-style2" onclick="submit_list_form(this.form,this)" id="submit_list_button" value="执行操作" /></td>
    </tr>
  </table>
</form>
<?php $this->load->view(TPL_FOLDER."footer");?>
