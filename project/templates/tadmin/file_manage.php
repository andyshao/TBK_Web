<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view(TPL_FOLDER."header");?>
<table width="100%" border="0" cellpadding="5" cellspacing="0" >
  <tr>
    <td width="3%" align="left" ><img src="{tpl_path}images/forward.jpg" /></td>
    <td width="97%" align="left" >您现在的位置：<a href="<?php echo site_url(CTL_FOLDER."file_manage");?>">文件管理</a> </td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0"  style="margin:5px 0;">
        <tr>
          <td width="41%" height="24" align="left">
          <?php if($pre_path)
		  {
		  ?>
          <img src="{tpl_path}images/file/Back.gif" /> <a href="<?php echo site_url(CTL_FOLDER."file_manage/");?>?f=<?php echo $pre_path;?>" style="color:#FF0000">返回上层文件夹</a>
          <?php
		  }
		  ?>          </td>
          <td width="31%" align="right"><img src="{tpl_path}images/AddFolder.gif" /> <a href="javascript:RqData()">创建文件夹</a></td>
          <td width="28%" align="right"><img src="{tpl_path}images/318.gif" /> 空间占用：<font color="#FF0000"><?php echo $total_size;?></font></td>
        </tr>
    </table>
<form method="post" name="list_form" id="list_form">
  <table width="100%" cellspacing="0" class="widefat">
    <thead>
      <tr>
        <th width="4%" ><input type="checkbox" onclick="check_box(this.form.rd_id)" /></th>
        <th width="40%">文件名称</th>
        <th width="14%">文件类型</th>
        <th width="13%">文件大小</th>
        <th width="13%">修改日期</th>
        <th width="16%">操作</th>
      </tr>
    </thead>
    <tfoot>
    </tfoot>
    <tbody  id="check_box_id">
      <?php 
	  $sys_folder=array(UP_FILES_ROOT.'files/',UP_FILES_ROOT.'images/');
	  foreach($file_list as $f_item)
	  {
	  if(isset($f_item['folder_path']))
	  {
	  	if(in_array($f_item['folder_path'],$sys_folder)){
	  ?>
      <tr>
        <th>&nbsp;</th>
        <td><img src="{tpl_path}images/file/folder.gif" /> <a href="?f=<?php echo urlencode($f_item['folder_path']);?>"><?php echo $f_item['folder_name'];?></a></td>
        <td>系统文件夹</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><a href="javascript:js_copy('<?php echo $f_item['folder_path'];?>')">获取地址</a></td>
      </tr>
      <?php 
	  	}
		else
		{
		?>
        <tr>
        <th><input name="rd_id[]" type="checkbox" id="rd_id" value="<?php echo $f_item['folder_path'];?>"></th>
        <td><img src="{tpl_path}images/file/folder.gif" /> <a href="?f=<?php echo urlencode($f_item['folder_path']);?>"><?php echo $f_item['folder_name'];?></a></td>
        <td>文件夹</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><a href="javascript:js_copy('<?php echo $f_item['folder_path'];?>')">获取地址</a></td>
      </tr>
        <?php 
		}
		
	  }
	  else
	  {
	  ?>
      <tr>
        <th><input name="rd_id[]" type="checkbox" id="rd_id" value="<?php echo $f_item['relative_path'].$f_item['name'];?>"></th>
        <td>
        <?php 
	  $img_ext=array('.jpg','.jpeg','.gif','.jpe','.png','.bmp');
	  if(!in_array(strtolower(strstr($f_item['name'],'.')),$img_ext))
	  {
	  ?>
      <img src="{tpl_path}images/file/<?php echo $f_item['file_icon'];?>" />
      <?php
	  }
	  else
	  {
	  ?>
      <img src="<?php echo ROOT_PATH.$f_item['relative_path'].$f_item['name'];?>" width="60" height="40" border="0" />
      <?php
	  }
	  ?> <?php echo $f_item['name'];?></td>
        <td><?php echo $f_item['mime'];?></td>
        <td><?php echo byte_format($f_item['size']);?></td>
        <td><?php echo date("Y-m-d",$f_item['date']);?></td>
        <td><a href="javascript:js_copy('<?php echo $f_item['relative_path'].$f_item['name'];?>')">获取地址</a> | <a href="{root_path}<?php echo $f_item['relative_path'].$f_item['name'];?>" target="_blank">下载</a></td>
      </tr>
      <?php
	  	}
	  }
	  ?>
    </tbody>
  </table>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td style="padding-top:5px"><select name="action_url" id="action_url" onchange="to_catalog_onChange()">
          <option value="" style="color:#FF0000">-选择操作-</option>
          <option value="<?php echo site_url(CTL_FOLDER."file_manage/copy_to");?>">复制到</option>
          <option value="<?php echo site_url(CTL_FOLDER."file_manage/move_to");?>">剪切到</option>
          <option value="<?php echo site_url(CTL_FOLDER."file_manage/delete_file");?>">删除</option>
        </select>
         &nbsp;
        <span style="display:none" id="to_catalog_span">
        <select name="to_dir" id="to_dir">
        <option value="" style="color:#FF0000">-选择复制/剪切到的路径-</option>
        <?php 
		if($current_path!=UP_FILES_ROOT)
		{
		?>
        <option value="<?php echo UP_FILES_ROOT;?>"><?php echo UP_FILES_ROOT;?></option>
        <?php 
		}
		foreach($all_dir as $value)
		{
		if($value!=$current_path)
		{
		?>
        <option value="<?php echo $value;?>"><?php echo $value;?></option>
        <?php
		}
		}
		?>
      </select>&nbsp;<input type="checkbox" value="1" name="is_over_write" /> 是否覆盖 &nbsp;</span>
      <input name="submit_list_button" type="button" class="button-style2" id="submit_list_button" onclick="submit_list_form(this.form,this)" value="执行操作" />  </td>
    </tr>
  </table>
</form>
<div id="dialog_add" style="display:none; position:relative">
  <form action="<?php echo site_url(CTL_FOLDER."file_manage/create_folder");?>" method="post" name="dialog_add_form" id="dialog_add_form">
    <table width="100%"  border="0" cellpadding="3" cellspacing="0" >
    	<tr>
        <td width="176"><font color="#FF0000">*</font>上级文件夹：</td>
        <td width="793">
        <select name="folder_path" dataType="Require" msg="请选择上层文件夹路径">
        <option value="">选择上层文件夹路径</option>
        <option value="<?php echo UP_FILES_ROOT;?>"><?php echo UP_FILES_ROOT;?></option>
        <?php foreach($all_dir as $value)
		{
		?>
        <option value="<?php echo $value;?>"><?php echo $value;?></option>
        <?php
		}
		?>
        </select>
        </td>
      </tr>
      <tr>
        <td width="176"><font color="#FF0000">*</font>文件夹名称：</td>
        <td width="793"><input Name="folder_name" type="text" Id="folder_name" size="20" dataType="Custom" regexp="^\w+$" msg="文件夹命名有误" title="不能包含有中文">
        </td>
      </tr>
    </table>
  </form>
</div>
<script language="javascript">
function RqData(){
	$('#dialog_add').dialog({  
		hide:'',      
		autoOpen:false,
		width:600,
		height:200,  
		modal:true, //蒙层  
		title:'创建文件夹', 
		close: function(){ 
			document.getElementById("dialog_add_form").reset();
			//$(this).dialog('destroy');
		},  
		overlay: {  
			opacity: 0.5, 
			background: "black"
		},  
		buttons:{  
			'取消':function(){$(this).dialog("close");},
			'创建文件夹':function(){dialog_add();}  
		}
	});
	$('#dialog_add').dialog('open');
}

function dialog_add(){
	var form_ob=document.getElementById("dialog_add_form"); 
	if (!Validator.Validate(form_ob,3)) return false;
	form_ob.submit();
}	

</script>
<br>
<?php $this->load->view(TPL_FOLDER."footer");?>