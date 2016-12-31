<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view(TPL_FOLDER."header");?>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" >
  <tr>
    <td width="3%" align="left" ><img src="{tpl_path}images/forward.jpg" /></td>
    <td width="97%" align="left" >您现在的位置：<a href="<?php echo site_url(CTL_FOLDER."link");?>">链接列表</a> &gt; 链接修改</td>
  </tr>
</table>
<fieldset>
<legend>链接修改</legend>
<form action="<?php echo site_url(CTL_FOLDER."link/save_record");?>" method="post" enctype="multipart/form-data" name="dialog_edit_form" id="dialog_edit_form">
  <table width="100%"  border="0" cellpadding="3" cellspacing="0" >
    <tr>
      <td width="133"><font color="#FF0000">*</font>链接标题：</td>
      <td width="592"><input Name="title" type="text" Id="title" size="30" value="<?php echo $edit_data['title'];?>" dataType="Require" msg="该项必须填写"></td>
    </tr>
    <tr>
      <td width="133"><font color="#FF0000">*</font>链接地址：</td>
      <td width="592"><input Name="hplink" value="<?php echo $edit_data['hplink'];?>" type="text" Id="hplink" size="45" dataType="Require" msg="该项必须填写"></td>
    </tr>
    <tr>
      <td>上传图片：</td>
      <td><img src="{tpl_path}images/loading.gif" rel="<?php echo get_real_path($edit_data['pic_path']);?>" border="0" class="jq_pic_loading" />
        <br />
         <input type="text" value="<?php echo $edit_data['pic_path'];?>" name="pic_path" id="pic_path" size="25" /> <input name="pic" type="file" id="pic" size="15" dataType="Filter" accept="<?php echo str_replace("|",",",UP_IMAGES_EXT);?>" require="false" msg="文件格式必须是：<?php echo UP_IMAGES_EXT;?>"  title="上传的文件格式必须是：<?php echo UP_IMAGES_EXT;?>,且单个文件不能超过 <?php echo ini_get("upload_max_filesize");?>">  <input type="button" name="sfbtn" class="button-style2" onclick="GetFileDialog('pic_path')" value="选择文件" />   </td>
    </tr>
    <tr>
      <td><font color="#FF0000">*</font>排序号：</td>
      <td><input name="seqorder" type="text" id="seqorder" size="4" value="<?php echo $edit_data['seqorder'];?>"  datatype="Integer" msg="该项必须填写数字" />      </td>
    </tr>
  </table>
  <input name="rd_id" type="hidden" value="<?php echo $edit_data['id'];?>" />
  <input type="button" name="sbmit" style=" margin-left:160px; margin-bottom:10px; margin-top:10px" onclick="subForm(this.form,this)" value="修改" class="button-style2" />
</form>
</fieldset>
<?php $this->load->view(TPL_FOLDER."footer");?>