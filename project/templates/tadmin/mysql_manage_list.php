<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view(TPL_FOLDER."header");?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <td height="30"><table width="100%" border="0" cellpadding="0" cellspacing="0" >
        <tr>
          <td height="30" align="right">空间占用：<font color="#FF0000"><?php echo $folder_size;?></font></td>
        </tr>
    </table></td>
  </tr>
</table>
<br>
<form method="post" name="list_form" id="list_form">
  <table width="100%" cellspacing="0" class="widefat">
    <thead>
      <tr>
        <th width="3%" ><input type="checkbox" onclick="check_box(this.form.rd_id)" /></th>
        <th width="38%">备份文件名</th>
        <th width="26%">备份时间</th>
        <th width="20%">数据库大小</th>
        <th width="13%">操作</th>
      </tr>
    </thead>
    <tfoot>
    </tfoot>
    <tbody  id="check_box_id">
      <?php foreach($file_list as $f_item) {?>
      <tr>
        <th><input name="rd_id[]" type="checkbox" id="rd_id" value="<?php echo $f_item['name'];?>"></th>
        <td><?php echo $f_item['name'];?></td>
        <td><?php echo date("Y-m-d H:i:s",$f_item['date']);?></td>
        <td><?php echo byte_format($f_item['size']);?></td>
        <td><a href="<?php echo site_url(CTL_FOLDER."mysql_manage/download_database/".$f_item['name']);?>">下载数据库</a></td>
      </tr>
      <?php }?>
    </tbody>
  </table>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td style="padding-top:5px"><select name="action_url" id="action_url">
          <option value="" style="color:#FF0000">-选择操作-</option>
          <option value="<?php echo site_url(CTL_FOLDER."mysql_manage/delete_backup");?>">删除</option>
        </select>
        &nbsp;
      <input name="submit_list_button" type="button" class="button-style2" id="submit_list_button" onclick="submit_list_form(this.form,this)" value="执行操作" />  </td>
    </tr>
  </table>
</form>

<br>
<fieldset>
<legend>数据库备份</legend>
<form action="<?php echo site_url(CTL_FOLDER."mysql_manage/backup");?>" method="post">
  <table width="100%" border="0" cellpadding="2" cellspacing="0" style="margin:10px 0">
    <tr>
      <td width="13%" align="left"><font style="color:#FF0000">*</font>分卷大小：</td>
      <td width="87%" align="left"><input name="f_size" type="text" value="51200" maxlength="10" size="10" dataType="Int" msg="格式有误 必须填写数字">
       K</td>
    </tr>
    <tr>
      <td align="left">&nbsp;</td>
      <td align="left"><input type="button" name="sbmit" onClick="subForm(this.form,this)" value="开始备份" class="button-style" /></td>
    </tr>
  </table>
</form>
</fieldset>
<?php $this->load->view(TPL_FOLDER."footer");?>