<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view(TPL_FOLDER."header");?>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" >
  <tr>
    <td width="3%" align="left" ><img src="{tpl_path}images/forward.jpg" /></td>
    <td width="97%" align="left" >您现在的位置：<a href="<?php echo my_site_url(CTL_FOLDER.'top_nav');?>">顶部导航</a> &gt; 修改导航 </td>
  </tr>
</table>
<fieldset>
  <legend>第一步：生成调用链接</legend>
  <form>
    <table width="100%"  border="0" cellpadding="3" cellspacing="0" >
      <tr>
        <td width="110"><font style="color:#F00">*</font>搜索关键词：</td>
        <td width="617"><input type="text" name="q" maxlength="50" size="15" dataType="Require" msg="该项必填" />
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <label>
            <input type="checkbox" name="is_tmall" value="1" />
            天猫商品</label></td>
      </tr>
      <tr>
        <td width="110">淘宝类目ID：</td>
        <td width="617"><input type="text" name="cid" maxlength="50" size="15" /> <font style="color: #F00"> 必须是淘宝类目ID，可不填，多个ID之间用英文逗号（,）隔开</font></td>
      </tr>
      <tr>
        <td width="110">折扣价：</td>
        <td width="617"><input type="text" name="start_price" maxlength="10" size="10" dataType="Currency" msg="格式有误" require="false" />
          元 
          —
          <input type="text" name="end_price" maxlength="10" size="10" dataType="Currency" msg="格式有误" require="false" />
          元</td>
      </tr>
      <tr>
        <td>排序：</td>
        <td><select name="sorts">
            <option value="">选择排序方式</option>
            <?php foreach($this->config->item('sort_type') as $k=>$v){?>
            <option value="<?php echo $k;?>"><?php echo $v;?></option>
            <?php }?>
          </select></td>
      </tr>
      <tr>
        <td width="110">&nbsp;</td>
        <td width="617"><input type="button" name="sbmit" onclick="sub_taobao_form(this.form)" value="生成调用链接" class="button-style" style="width:100px" /></td>
      </tr>
    </table>
  </form>
</fieldset>
<fieldset>
  <legend>第二步：链接相关设置</legend>
  <form action="<?php echo my_site_url(CTL_FOLDER.'top_nav/save_record');?>" method="post">
    <table width="100%"  border="0" cellpadding="3" cellspacing="0" style="margin:10px 0">
      <tr>
        <td width="119"><font color="#FF0000">*</font>导航链接：</td>
        <td width="594"><font style="color:#FF0000">链接可从第一步中生成，也可以直接填写链接，站外链接开头需加上"http://"</font><br />
          <input type="text" size="60" value="<?php echo $edit_data->hplink;?>" maxlength="255" name="hplink" dataType="Require" msg="该项必填" /></td>
      </tr>
      <tr>
        <td width="119"><font color="#FF0000">*</font>导航名称：</td>
        <td width="594"><input name="title" value="<?php echo $edit_data->title;?>" id="title" type="text" size="15" dataType="Require" msg="该项必须填写" maxlength="30" /></td>
      </tr>
      <tr>
        <td width="119"><font color="#FF0000">*</font>目标：</td>
        <td width="594"><select name="target">
            <option value="_blank" <?php if($edit_data->target == '_blank') echo 'selected="selected"';?>>新窗口 (_blank)</option>
            <option value="_self" <?php if($edit_data->target == '_self') echo 'selected="selected"';?>>本窗口 (_self) </option>
          </select></td>
      </tr>
      <tr>
        <td><font color="#FF0000">*</font>排序号：</td>
        <td><input name="seqorder" type="text" size="4" value="<?php echo $edit_data->seqorder;?>" datatype="Integer" msg="该项必须填写数字" /></td>
      </tr>
      <tr>
        <td width="119">&nbsp;</td>
        <td width="594"><input type="button" onClick="subForm(this.form,this)" value="修改" class="button-style2" /></td>
      </tr>
    </table>
    <input type="hidden" name="rd_id" value="<?php echo $edit_data->id;?>" />
  </form>
</fieldset>
<script language="javascript">
function sub_taobao_form(f)
{
	if( ! Validator.Validate(f,3)) return ;
	var q = f.q.value;
	var cid = f.cid.value;
	if($('input[name=is_tmall]:checked').length > 0) var is_tmall = true;
	else var is_tmall = false;
	var start_price = f.start_price.value;
	var end_price = f.end_price.value;
	var sorts = f.sorts.value;
	
	var curl = "<?php echo my_site_url('s');?>?";
	if(q) curl += "q="+encodeURIComponent(q)+'&';
	if(cid) curl += "cid="+encodeURIComponent(cid)+'&';
	if(is_tmall) curl += 'is_tmall=1&';
	if(start_price) curl += "s_price="+encodeURIComponent(start_price)+'&';
	if(end_price) curl += "e_price="+encodeURIComponent(end_price)+'&';
	if(sorts) curl += "sorts="+encodeURIComponent(sorts)+'&';
	
	curl = curl.substr(0,curl.length - 1);
	$('input[name=hplink]').val(curl);
	$('input[name=title]').val(q);
	f.reset();
	document.getElementById('title').focus();
}
</script>
<?php $this->load->view(TPL_FOLDER."footer");?>
