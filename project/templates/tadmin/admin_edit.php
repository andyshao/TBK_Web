<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view(TPL_FOLDER."header");?>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" >
  <tr>
    <td width="3%" align="left" ><img src="{tpl_path}images/forward.jpg" /></td>
    <td width="97%" align="left" >您现在的位置：<a href="<?php echo site_url(CTL_FOLDER."admin");?>">管理员列表</a> &gt; 管理员修改</td>
  </tr>
</table>
<fieldset>
<legend>管理员修改</legend>
<form action="<?php echo site_url(CTL_FOLDER."admin/save_record");?>" method="post" name="dialog_edit_form" id="dialog_edit_form">
 <table width="100%"  border="0" cellpadding="3" cellspacing="0" >
      
      <tr>
        <td width="19%"><font color="#FF0000">*</font>管理员账号：</td>
        <td width="81%"><input Name="user_name" type="text" value="<?php echo $edit_data['user_name'];?>" style="width:100px" dataType="Require" msg="该项必须填写">        </td>
      </tr>
      <tr>
        <td ><font style="color:#FF0000">*</font>管理员密码：</td>
        <td><input type="password" name="password" id="password" style="width:100px" require="false" dataType="SafeString" msg="密码安全度太低" title="不修改请留空" /></td>
      </tr>
      <tr>
        <td><font style="color:#FF0000">*</font>密码确认：</td>
        <td><input type="password" name="c_password" to="password" style="width:100px" require="false" dataType="Repeat" msg="两次输入的密码不一致"  title="不修改请留空" /></td>
      </tr>
    </table>
  <input name="rd_id" type="hidden" value="<?php echo $edit_data['id'];?>" />
  <input type="button" name="sbmit" style=" margin-left:160px; margin-bottom:10px; margin-top:10px" onClick="subForm(this.form,this)" value="修改" class="button-style2" />
</form>
</fieldset>
<?php $this->load->view(TPL_FOLDER."footer");?>