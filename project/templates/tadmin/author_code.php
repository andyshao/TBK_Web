<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view(TPL_FOLDER."header");?>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" >
  <tr>
    <td width="3%" align="left" ><img src="{tpl_path}images/forward.jpg" /></td>
    <td width="97%" align="left" >您现在的位置：授权码管理</td>
  </tr>
</table>
<fieldset>
<legend>授权码修改</legend>
  <form method="post" action="<?php echo site_url(CTL_FOLDER.'author_code/save_author_code');?>">
    <table width="100%"  border="0" cellpadding="3" cellspacing="0" >
      <tr>
        <td width="104"><b>授权码</b>：</td>
        <td width="625"><textarea name="author_code" cols="70" rows="3" dataType="Require" msg="<br>授权码必填">搜客淘宝客正版授权认证成功，搜客淘宝客官方网站：http://bbs.soke5.com/</textarea></td>
      </tr>
      <tr>
        <td width="104">&nbsp;</td>
        <td width="625"><input type="button" name="sbmit" onclick="subForm(this.form,this)" value="修改" class="button-style" /></td>
      </tr>
    </table>
</form>
</fieldset>
<?php $this->load->view(TPL_FOLDER."footer");?>
