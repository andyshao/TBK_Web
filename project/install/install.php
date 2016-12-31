<?php
require("check_install.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>系统配置--搜客淘宝客程序API全自动采集版安装</title>
<link rel="stylesheet" type="text/css" href="style/style.css">
<script type="text/javascript" src="../js/validator.js"></script>
<script language="javascript"> 
function subForm(f,e)
{
	if( ! Validator.Validate(f,3)) return;
	e.value = '数据处理中..';
	e.disabled = true;
	f.submit();
}
</script>
</head>

<body>
<?php include('top.php');?>
<div id="ui-tx-main">
  <div class="ui-tx-left">
    <div class="ui-tx-tab-v">
      <div>安装环境检测</div>
      <div class="ui-tx-tab-v-active">系统配置</div>
      <div>安装完成</div>
	  
	  	  <div>技术支持：<a href="http://bbs.soke5.com/" target="_blank">搜客淘宝客</a></div>
	   <div>客服：<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=732515587&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:732515587:45" alt="点击这里给我发消息" title="点击这里给我发消息" style="vertical-align:middle"> 732515587</a></div>   
	  
    </div>
  </div>
  <div class="ui-tx-right">
    <form action="install_save.php" method="post">
      <fieldset>
      <legend><img src="images/database.gif" style="vertical-align:middle" /> MySQL数据库设置</legend>
      <table border="0" cellpadding="5" cellspacing="0">
        <tr>
          <td width="194" align="left"><font style="color:#FF0000">*</font>数据库主机：</td>
          <td width="494" align="left"><input type="text" name="hostname"  value="localhost"  dataType="Require" msg="该项必须填写" class="ui-tx-input" title="mysql数据库服务器地址,一般为localhost"  style="width:150px" maxlength="100" />
          </td>
        </tr>
        <tr>
          <td width="194" align="left"><font style="color:#FF0000">*</font>用户名：</td>
          <td align="left"><input type="text" name="username" class="ui-tx-input" dataType="Require" msg="该项必须填写" title="连接mysql数据库的用户名" style="width:150px" maxlength="100"  /></td>
        </tr>
        <tr>
          <td width="194" height="36" align="left"><font style="color:#FF0000">*</font>密码：</td>
          <td align="left"><input type="password" class="ui-tx-input" name="password"  dataType="Require" msg="该项必须填写" title="连接mysql数据库的密码" maxlength="100" style="width:150px"  /></td>
        </tr>
        <tr>
          <td width="194" align="left"><font style="color:#FF0000">*</font>数据库名：<br />
          </td>
          <td align="left"><input type="text" class="ui-tx-input" name="database"  value="" id="database" dataType="Require" msg="该项必须填写"  title="如果数据库不存在且该用户具有创建数据库的权限，则自动创建数据库,否则您需要手动创建。" maxlength="100"  style="width:150px"  />
          </td>
        </tr>
        <tr>
          <td align="left"><font style="color:#FF0000">*</font>数据表前缀：</td>
          <td align="left"><input type="text" name="dbprefix" class="ui-tx-input"  value="tk_" dataType="Custom" regexp="^\w+$" maxlength="10" msg="格式有误，只能是字母数字或下划线"  title="建议修改，字母开头然后跟个下划线"  style="width:150px"  />
          </td>
        </tr>
      </table>
      <div class="clear"></div>
      </fieldset>
      <fieldset>
      <legend><img src="images/gologin_icon.jpg" style="vertical-align:middle" /> 管理员设置</legend>
      <table width="100%" border="0" cellpadding="5" cellspacing="0">
        <tr>
          <td width="194" align="left"><font style="color:#FF0000">*</font>管理员账号：</td>
          <td width="568" align="left"><input type="text" name="admin_name"  class="ui-tx-input" value="" id="admin_name" dataType="Require" msg="该项必须填写" maxlength="20" title="后台管理员登陆帐号"  style="width:150px" /></td>
        </tr>
        <tr>
          <td width="194" align="left"><font style="color:#FF0000">*</font>管理员密码：</td>
          <td align="left"><input type="password" name="admin_password" class="ui-tx-input" id="admin_password" dataType="SafeString" msg="密码安全度太低" maxlength="20" title="后台管理员登陆密码"  style="width:150px" /></td>
        </tr>
        <tr>
          <td width="194" align="left"><font style="color:#FF0000">*</font>密码确认：</td>
          <td align="left"><input type="password" class="ui-tx-input" name="c_admin_password" id="c_admin_password" to="admin_password" dataType="Repeat" maxlength="20" msg="两次输入的密码不一致"  style="width:150px" /></td>
        </tr>
      </table>
      <div class="clear"></div>
      </fieldset>
      <fieldset>
      <legend><img src="images/tips.jpg" style="vertical-align:middle" /> 其他杂项</legend>
      <table width="100%" border="0" cellpadding="5" cellspacing="0">
        <tr>
          <td width="197" align="left"><font style="color:#FF0000">*</font>设置时区：</td>
          <td width="565" align="left"><select name="time_zone">
            <option value="PRC" selected="selected">中华人民共和国</option>
            <option value="Asia/Shanghai" >亚洲，中国，上海</option>
            <option value="Asia/Taipei" >亚洲，中国，台北</option>
            <option value="Asia/Chongqing" >亚洲，中国，重庆</option>
            <option value="Asia/Harbin" >亚洲，中国，哈尔滨</option>
            <option value="Asia/Urumqi" >亚洲，中国，乌鲁木齐</option>
            <option value="Asia/Hong_Kong" >亚洲，中国，香港</option>
            <option value="Asia/Macau" >亚洲，中国，澳门</option>
            <option value="Asia/Singapore" >亚洲，新加坡</option>
            <option value="Asia/Seoul" >亚洲，韩国，首尔</option>
            <option value="Asia/Tokyo" >亚洲，日本，东京</option>
            <option value="Europe/Berlin" >欧洲，德国，柏林</option>
            <option value="Europe/Dublin" >欧洲，德国，都柏林</option>
            <option value="Europe/Paris" >欧洲，法国，巴黎</option>
   </select></td>
        </tr>
        <tr>
          <td width="197" align="left"><font style="color:#FF0000">*</font>安装测试数据：</td>
          <td align="left"><input type="checkbox" name="install_test_data" value="yes" checked="checked" /></td>
        </tr>
      </table>
      <div class="clear"></div>
      </fieldset>
      <table width="100%" border="0" cellpadding="5" cellspacing="0">
        <tr>
          <td width="197" align="left">&nbsp;</td>
          <td width="565" align="left"><input name="btns" type="button" onclick="subForm(this.form,this)" class="ui-tx-button" value="开始安装" /> &nbsp;&nbsp;&nbsp;&nbsp; <input name="button" type="button" onclick="document.location.href='index.php'" class="ui-tx-button2" value="上一步" /></td>
        </tr>
      </table>
    </form>
  </div>
  <div class="clear"></div>
</div>
<?php include("copyright.php");?>
</body>
</html>
