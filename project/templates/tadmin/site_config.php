<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view(TPL_FOLDER."header");?>
<style type="text/css">
.tdlh td{ line-height:25px}
</style>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" >
  <tr>
    <td width="3%" align="left" ><img src="{tpl_path}images/forward.jpg" /></td>
    <td width="97%" align="left" >您现在的位置：网站配置</td>
  </tr>
</table>
  <form action="<?php echo site_url(CTL_FOLDER."site_config/save_record");?>" method="post" enctype="multipart/form-data">
    <table width="100%" border="0" class="tdlh" cellpadding="5" cellspacing="1" style="margin:10px 0;" bgcolor="#E4E4E4">
      <tr>
        <td width="131" bgcolor="#FFFFFF"><strong><font color="#FF0000">*</font>网站名称：</strong></td>
        <td width="596" bgcolor="#FFFFFF"><input Name="sys_site_name" type="text" size="60" maxlength="50" value="<?php echo $edit_data['sys_site_name'];?>" dataType="Require" msg="该项必须填写" /></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF"><strong><font color="#FF0000">*</font>网站标题：</strong></td>
        <td bgcolor="#FFFFFF" ><input Name="sys_site_title" type="text" size="60" maxlength="80" value="<?php echo $edit_data['sys_site_title'];?>" dataType="Require" msg="该项必须填写" />
          <br>
          该标题将显示在浏览器的标题栏上,不超过80个字符。</td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF"><strong>电脑版LOGO：</strong></td>
        <td bgcolor="#FFFFFF"><img src="{tpl_path}images/loading.gif" rel="<?php echo get_real_path($edit_data['sys_site_logo']);?>" border="0" class="jq_pic_loading" /> <br />
          <input type="text" value="<?php echo $edit_data['sys_site_logo'];?>" name="pic_path1" id="pic_path1" size="25" maxlength="300" />
          <input name="sys_site_logo" type="file" id="sys_site_logo" size="15" dataType="Filter" accept="<?php echo str_replace("|",",",UP_IMAGES_EXT);?>" require="false" msg="格式有误" />
          <input type="button" name="sfbtn" class="button-style2" onclick="GetFileDialog('pic_path1')" value="选择文件" />
          <br>
          图片格式：<?php echo UP_IMAGES_EXT;?></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF"><strong>手机版LOGO：</strong></td>
        <td bgcolor="#FFFFFF"><img src="{tpl_path}images/loading.gif" rel="<?php echo get_real_path($edit_data['m_site_logo']);?>" border="0" class="jq_pic_loading" /> <br />
          <input type="text" value="<?php echo $edit_data['m_site_logo'];?>" name="pic_path2" id="pic_path2" size="25" maxlength="300" />
          <input name="m_site_logo" type="file" id="m_site_logo" size="15" dataType="Filter" accept="<?php echo str_replace("|",",",UP_IMAGES_EXT);?>" require="false" msg="格式有误" />
          <input type="button" name="sfbtn" class="button-style2" onclick="GetFileDialog('pic_path2')" value="选择文件" />
          <br>
          图片格式：<?php echo UP_IMAGES_EXT;?></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF"><strong><font color="#FF0000">*</font>Meta关键字：</strong></td>
        <td bgcolor="#FFFFFF"><input type="text" value="<?php echo $edit_data['sys_site_keyword'];?>" size="60" maxlength="100" dataType="Require" msg="该项必须填写" name="sys_site_keyword" />
          <br>
          关键字之间使用半角逗号（,）分隔，不超过100个字符</td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF"><strong><font color="#FF0000">*</font>Meta描述：</strong></td>
        <td bgcolor="#FFFFFF"><textarea name="sys_site_description" cols="60" rows="5" dataType="Limit" max="200" msg="字数不超过200"><?php echo $edit_data['sys_site_description'] ;?></textarea>
          <br>
          不超过200个字符</td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF"><strong><font color="#FF0000">*</font>网站版权：</strong></td>
        <td bgcolor="#FFFFFF"><input type="text" value="<?php echo $edit_data['sys_site_copyright'];?>" size="60" maxlength="50" dataType="Require" msg="该项必须填写" name="sys_site_copyright" />
          <br>
          例如：© 2010-2015 <a href="http://bbs.soke5.com/"  target="_blank">搜客淘宝客</a> 保留所有权利</td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF"><font color="#FF0000">*</font> <strong>网页数据缓存：</strong></td>
        <td bgcolor="#FFFFFF"><input type="text" name="sys_cache_time" id="sys_cache_time" maxlength="10" size="5" value="<?php echo $edit_data['sys_cache_time'];?>" dataType="Integer" msg="必须填写数字" />
          <input type="button" class="button-style" onclick="clear_cache1()" value="清除缓存" />
          例如填写：10 表示每10分钟更新一次缓存，如果不缓存请填写0</td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF"><font color="#FF0000">*</font> <strong>API数据缓存(分钟)：</strong></td>
        <td bgcolor="#FFFFFF"><input type="text" name="cache_time" id="cache_time" maxlength="10" size="5" value="<?php echo $edit_data['cache_time'];?>" title="例如填写：10 表示每10分钟更新一次缓存，如果不缓存请填写0" dataType="Integer" msg="必须填写数字" />
          <input type="button" class="button-style" onclick="clear_cache()" value="清除缓存" /> 例如填写：10 表示每10分钟更新一次缓存，如果不缓存请填写0</td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF"><font color="#FF0000">*</font><strong style="color:#F00">淘宝API KEY：</strong></td>
        <td bgcolor="#FFFFFF">appkey：<input name="appkey" type="text" size="10" maxlength="20" value="<?php echo $edit_data['appkey']['appkey'];?>" /> &nbsp; secretkey：<input name="secretkey" type="text" size="40" maxlength="50" value="<?php echo $edit_data['appkey']['secretkey'];?>" /> &nbsp; <a href="http://open.taobao.com/" target="_blank">去申请</a></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF"><font color="#FF0000">*</font><strong style="color:#F00">默认搜索关键词：</strong></td>
        <td bgcolor="#FFFFFF"><input Name="default_q" type="text" size="30" maxlength="30" value="<?php echo $edit_data['default_q'];?>" dataType="Require" msg="该项必须填写" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><input type="checkbox" name="default_is_tmall" value="1" <?php if($edit_data['default_is_tmall'] == 1) echo 'checked';?> />天猫商品</label> </td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF"><font color="#FF0000">*</font><strong style="color:#F00">默认排序：</strong></td>
        <td bgcolor="#FFFFFF"><select name="default_sort" dataType="Require" msg="该项必选">
        <option value="">选择排序</option>
        <?php foreach($this->config->item('sort_type') as $k=>$v){?>
        <option value="<?php echo $k;?>" <?php if($edit_data['default_sort'] == $k) echo 'selected';?>><?php echo $v;?></option>
        <?php }?>
        </select></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF"><font color="#FF0000">*</font> <strong>链接模式：</strong></td>
        <td bgcolor="#FFFFFF"><label>
          <input type="radio" name="rd_type" value="1" <?php if($edit_data['rd_type'] == 1) echo 'checked';?> />
          直达淘宝</label>
          &nbsp;&nbsp;&nbsp;&nbsp;
          <label>
            <input type="radio" name="rd_type" value="2" <?php if($edit_data['rd_type'] == 2) echo 'checked';?> />
            链接站内商品详细页</label></td>
      </tr>

      <tr>
        <td bgcolor="#FFFFFF"><strong style="color:#F00">淘点金代码：</strong></td>
        <td bgcolor="#FFFFFF"><textarea cols="75" rows="10" name="taodianjin" dataType="Limit" max="2000" require="false" msg="<br>字符数不能超过2000"><?php echo get_taodianjin();?></textarea> <br><a href="http://www.alimama.com/" target="_blank">申请淘点金</a>
        </td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF"><strong>流量统计：</strong></td>
        <td bgcolor="#FFFFFF"><textarea cols="75" rows="10" name="sys_tongji" dataType="Limit" max="2000" require="false" msg="<br>字符数不能超过2000"><?php echo html_entity_decode($edit_data['sys_tongji'],ENT_QUOTES);?></textarea> <br><a href="http://new.cnzz.com/user/reg.php" target="_blank">CNZZ</a> | <a href="http://www.linezing.com/" target="_blank">量子恒道</a> | <a href="http://tongji.baidu.com/hm-web/welcome/login" target="_blank">百度</a> | <a href="http://count.51yes.com/" target="_blank">51Yes</a></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF"></td>
        <td bgcolor="#FFFFFF"><input type="button" onClick="subForm(this.form,this)" value="修改" class="button-style2" /></td>
      </tr>
    </table>
</form>
<script language="javascript">
function clear_cache() 
{
	if(confirm("确定要清除API数据缓存?"))
	{
		show_message('数据处理中，请稍等...',false);
		$.ajax({
			type: "POST",
			url: "<?php echo site_url(CTL_FOLDER."main/clear_cache"); ?>",
			data:   "rd_id=ttt",
			success: function(msg){ 
				if(msg==1) {
					$("#ui-tx-mark-message").html("缓存清除成功...");
					setTimeout(function(){hide_message();},2000);
				} else {
					$("#ui-tx-mark-message").html("缓存清除失败...");
					setTimeout(function(){hide_message();},2000);
				}
			}
		}); 
	}
}

function clear_cache1() 
{
	if(confirm("确定要清除网页数据缓存?"))
	{
		show_message('数据处理中，请稍等...',false);
		$.ajax({
			type: "POST",
			url: "<?php echo site_url(CTL_FOLDER."main/clear_cache1"); ?>",
			data:   "rd_id=ttt",
			success: function(msg){ 
				if(msg==1) {
					$("#ui-tx-mark-message").html("缓存清除成功...");
					setTimeout(function(){hide_message();},2000);
				} else {
					$("#ui-tx-mark-message").html("缓存清除失败...");
					setTimeout(function(){hide_message();},2000);
				}
			}
		}); 
	}
}
</script>
<?php $this->load->view(TPL_FOLDER."footer");?>
