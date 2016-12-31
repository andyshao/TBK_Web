<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view(TPL_FOLDER."header");?>
<form Name="mod_form" id="mod_form" Action="<?php echo site_url(CTL_FOLDER."admin/modify_password_do");?>" method="post" onSubmit="return Validator.Validate(this,3)">
  <table width="100%" cellspacing="0" class="widefat">
    <thead>
      <tr>
        <th colspan="2">修改管理员密码</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td width="13%" align="right"><font color="#FF0000">*</font>旧密码：</td>
        <td width="87%"><input name="old_password" type="password" id="old_password" dataType="Require" msg="该项必须填写" /></td>
      </tr>
      <tr>
        <td align="right"><font color="#FF0000">*</font>新密码：</td>
        <td><input name="new_password" type="password" id="new_password" dataType="SafeString" msg="密码安全度太低" /></td>
      </tr>
      <tr>
        <td align="right"><font color="#FF0000">*</font>确认新密码：</td>
        <td><input name="c_new_password" type="password" id="c_new_password" to="new_password" dataType="Repeat" msg="两次输入的密码不一致" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="submit" name="Submit3" class="button-style2" value="修改" /></td>
      </tr>
    </tbody>
  </table>
</form>
<?php $this->load->view(TPL_FOLDER."footer");?>
