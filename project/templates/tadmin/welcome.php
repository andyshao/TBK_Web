<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view(TPL_FOLDER."header");?>
<?php if( ! is_author()){?>
<div class="ui-tx-tips-div" style="text-align:center"><img src="{tpl_path}images/no.gif" /> 该程序未经<a href="http://bbs.soke5.com/" target="_blank">搜客淘宝客</a>授权，某些功能将无法使用。<a href="http://bbs.soke5.com/" target="_blank">点击这里获取授权</a></div>
<?php }else{?>
<div class="ui-tx-tips-div" style="color:#111FD8; text-align:center"><img src="{tpl_path}images/yes.gif" /> 该程序为官方正版，请放心使用,多谢您的支持!  技术服务和程序升级进入：<a href="http://bbs.soke5.com/" target="_blank">搜客淘宝客官方网站</a></div>
</div>
<?php }?>
<table width="100%" cellspacing="0" class="widefat">
  <thead>
    <tr>
      <th colspan="2">系统信息</th>
    </tr>
  </thead>
  <tbody id="check_box_id">
    <tr>
      <td height="30"><strong>主机名 (IP：端口)：</strong><?php echo $_SERVER['SERVER_NAME']?>(<?php echo $this->input->ip_address().":".$_SERVER['SERVER_PORT'];?>)</td>
      <td ><strong>程序目录：</strong><?php echo str_replace('templates\tadmin','',dirname(__FILE__));?></td>
    </tr>
    <tr>
      <td height="30" ><strong>Web服务器：</strong><?php echo $_SERVER['SERVER_SOFTWARE']?></td>
      <td ><strong>PHP 运行方式：</strong><?php echo PHP_SAPI?></td>
    </tr>
    <tr>
      <td height="30" ><strong>PHP版本：</strong><?php echo PHP_VERSION?>&nbsp;&nbsp;<span style="color:#999999">(需要 >= PHP4.0.2)</span></td>
      <td ><strong>最大上传限制：</strong><?php echo ini_get('file_uploads') ? ini_get('upload_max_filesize') : '<span style="color:red">Disabled</span>';?></td>
    </tr>
    <tr>
      <td height="30" ><strong>最大执行时间：</strong><?php echo ini_get('max_execution_time')?> seconds</td>
      <td ><strong>远程文件获取：</strong><?php echo ini_get('allow_url_fopen') ? '支持' : '不支持'?>&nbsp;&nbsp;<span style="color:#FF6600">(如果服务器不支持将无法使用该程序)</span></td>
    </tr>
    <tr>
      <td height="30" ><strong>管理员账号：</strong><?php echo $sys_user_name;?></td>
      <td ><strong>上次登陆IP：</strong><?php echo $sys_last_login_ip;?></td>
    </tr>
    <tr>
      <td height="30" ><strong>上次登陆时间：</strong><?php echo $sys_last_login_time;?></td>
      <td ><strong>登陆次数：</strong><?php echo $sys_hits;?></td>
    </tr>
    <tr>
      <td height="30" ><strong>技术团队：</strong><a href="http://bbs.soke5.com" target="_blank" style="color:#FF0000">搜客淘宝客</a> &nbsp;&nbsp; <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=732515587&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:732515587:45" alt="点击这里给我发消息" title="点击这里给我发消息" style="vertical-align:middle"> 732515587</a></td>
      <td ><strong>程序版本：</strong><script type="text/javascript" src="http://bbs.soke5.com/ad/api/789.js"></script> </td>
    </tr>
  </tbody>
</table>
<br />
<table class="widefat" cellspacing="0">
  <thead>
    <tr>
      <th><div class="allbtn" style="width:100px"><span class="ui-icon ui-icon-info"></span> <span>管理帮助信息</span></div></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td align="left"><div class="w_tips">
          <ul>
          <li>建议删除所有的文章测试数据，文章分类可不删除。然后重新采集生成静态页面。</li>
            <li>如果您是第一次使用该网站后台，<a style="color:#dd0000;" href="<?php echo site_url(CTL_FOLDER.'site_config');?>">请先点击这里修改网站信息配置</a>,修改时请严格按照提示填写。记录排序原则：数字大的排前面。 </li>
            <li>如果您是第一次使用该网站后台，请进入页面：管理员设置——>修改密码 修改您的管理邮箱，当忘记管理密码的时候 可以通过该邮箱找回密码。 </li>
            
          </ul>
        </div></td>
    </tr>
  </tbody>
</table>

<table class="widefat" cellspacing="0">
  <thead>
    <tr>
      <th><div class="allbtn" style="width:100px"><span class="ui-icon ui-icon-info"></span> <span>最新官方更新</span></div></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td align="left"><div class="w_tips2">
          <ul>
          <script type="text/javascript" src="http://bbs.soke5.com/ad/api/abc.js"></script> 
          </ul>
        </div></td>
    </tr>
  </tbody>
</table>

<?php $this->load->view(TPL_FOLDER."footer");?>
