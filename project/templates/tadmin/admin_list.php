<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view(TPL_FOLDER."header");?>
<table width="100%" border="0" cellpadding="5" cellspacing="0" >
  <tr>
    <td width="3%" align="left" ><img src="{tpl_path}images/forward.jpg" /></td>
    <td width="97%" align="left" >您现在的位置：<a href="<?php echo site_url(CTL_FOLDER."admin");?>">管理员列表</a> </td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:5px 0;">
  <tr>
    <td height="24" align="center" ><span style="cursor:pointer" onClick="RqData()"><img src="{tpl_path}images/add.png"> 添加管理员</span></td>
  </tr>
</table>
<form method="post" name="list_form" id="list_form">
  <table width="100%" cellspacing="0" class="widefat">
    <thead>
      <tr>
        <th width="6%"><input type="checkbox" onclick="check_box(this.form.rd_id)" /></th>
        <th width="22%">管理员账号</th>
        <th width="20%">最后登陆IP</th>
        <th width="24%">最后登陆时间</th>
        <th width="17%">登陆次数</th>
        <th width="11%">操作</th>
      </tr>
    </thead>
    <tfoot>
    </tfoot>
    <tbody id="check_box_id">
      <?php foreach($query->result() as $row) {?>
      <tr>
        <td><input name="rd_id[]" type="checkbox" id="rd_id" value="<?php echo $row->id;?>"></td>
        <td><?php echo $row->user_name;?></td>
        <td><?php echo $row->last_login_ip;?></td>
        <td><?php 
		if($row->last_login_time)
		{
			echo date("Y-m-d",$row->last_login_time);
		}
		?></td>
        <td><?php echo $row->hits;?></td>
        <td><a href="<?php echo site_url(CTL_FOLDER."admin/edit_record/".$row->id);?>">修改</a></td>
      </tr>
      <?php }?>
    </tbody>
  </table>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td style="padding-top:5px">
      <select name="action_url" id="action_url">
          <option value="" style="color:#FF0000">-选择操作-</option>
          <option value="<?php echo site_url(CTL_FOLDER."admin/del_record");?>">删除</option>
        </select>
        &nbsp;
        <input type="button" name="submit_list_button" class="button-style2" onclick="submit_list_form(this.form,this)" id="submit_list_button" value="执行操作" />
         </td>
    </tr>
  </table>
</form>
<div id="dialog_add" style="display:none; position:relative">
  <form action="<?php echo site_url(CTL_FOLDER."admin/add_record");?>" method="post" name="dialog_add_form" id="dialog_add_form">
    <table width="100%"  border="0" cellpadding="3" cellspacing="0" >
      <tr>
        <td width="19%"><font color="#FF0000">*</font>管理员账号：</td>
        <td width="81%"><input Name="user_name" type="text" style="width:100px" dataType="Require" msg="该项必须填写">
        </td>
      </tr>
      <tr>
        <td ><font style="color:#FF0000">*</font>管理员密码：</td>
        <td><input type="password" name="password" id="password" style="width:100px" dataType="SafeString" msg="密码安全度太低" /></td>
      </tr>
      <tr>
        <td><font style="color:#FF0000">*</font>密码确认：</td>
        <td><input type="password" name="c_password" to="password" style="width:100px" dataType="Repeat" msg="两次输入的密码不一致" /></td>
      </tr>
    </table>
  </form>
</div>
<script language="javascript">
function RqData(){
	$('#dialog_add').dialog({  
		hide:'',      
		autoOpen:false,
		width:650,
		height:300,  
		modal:true, //蒙层  
		title:'添加管理员', 
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
			'添加管理员':function(){dialog_add();}  
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
<?php $this->load->view(TPL_FOLDER."footer");?>
