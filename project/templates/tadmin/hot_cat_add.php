<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view(TPL_FOLDER."header");?>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" >
  <tr>
    <td width="3%" align="left" ><img src="{tpl_path}images/forward.jpg" /></td>
    <td width="97%" align="left" >您现在的位置：<a href="<?php echo my_site_url(CTL_FOLDER.'hot_cat');?>">搜索关键词</a> &gt; 添加关键词 </td>
  </tr>
</table>
<fieldset>
  <legend>添加关键词</legend>
  <form action="<?php echo my_site_url(CTL_FOLDER.'hot_cat/add_record');?>" method="post">
    <table width="100%"  border="0" cellpadding="3" cellspacing="0" style="margin:10px 0">
    <tr>
        <td width="118"><font color="#FF0000">*</font>所属分类：</td>
        <td width="625"><select name="parent_id">
        <option value="0">选择分类</option>
        <?php foreach($cid as $row){?>
        <option value="<?php echo $row->id;?>" <?php if($parent_id == $row->id) echo 'selected';?>><?php echo $row->cat_name;?></option>
        <?php }?>
        </select></td>
      </tr>
      <tr>
        <td width="118"><font color="#FF0000">*</font>搜索关键词：</td>
        <td width="625"><input type="text" size="15" maxlength="30" name="q" dataType="Require" msg="该项必填" /></td>
      </tr>
      <tr>
        <td width="118">淘宝类目ID：</td>
        <td width="625"><input type="text" size="15" maxlength="50" name="cid"  /> 
          <font style="color: #F00"> 必须是淘宝类目ID，可不填，多个ID之间用英文逗号（,）隔开</font></td>
      </tr>
      <tr>
        <td width="118"><font color="#FF0000">*</font>显示关键词：</td>
        <td width="625"><input name="cat_name"  type="text" size="15" dataType="Require" msg="该项必须填写" maxlength="30" /></td>
      </tr>
      <tr>
        <td><font color="#FF0000">*</font>排序号：</td>
        <td><input name="seqorder" type="text" id="seqorder" size="4" value="0" datatype="Integer" msg="该项必须填写数字" /></td>
      </tr>
      <tr>
        <td width="118">&nbsp;</td>
        <td width="625"><input type="button" onClick="subForm(this.form,this)" value="添加" class="button-style" /></td>
      </tr>
    </table>
  </form>
</fieldset>
<?php $this->load->view(TPL_FOLDER."footer");?>