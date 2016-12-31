<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" Content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<Title>网站后台</Title>
<link href="{tpl_path}style/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{root_path}js/jquery/jquery-ui/jquery-ui-1.7.custom.css">
<script type="text/javascript" src="{root_path}js/jquery/jquery.js"></script>
<script type="text/javascript" src="{root_path}js/jquery/jquery-ui/jquery-ui-1.7.custom.min.js"></script>
<script type="text/javascript" src="{root_path}js/validator.js"></script>
<script type="text/javascript" src="{tpl_path}js/function.js"></script>
<script language="javascript">
var onerror_pic_path="{tpl_path}images/none.gif";
var pic_loading_path="{tpl_path}images/loading.gif";
var js_root_path="<?php echo my_site_url();?>";
$(document).ready(function(){
	$(".jq_pic_loading").each(function(){
		LoadImage($(this),$(this).attr("rel"),60);
	});
   $("#check_box_id tr:even").css("background-color","#F7F7F7");
	$("#check_box_id tr").hover(function(){
		$(this).css("background-color","#D9EBF5");
	},function(){
		if($("#check_box_id tr").index($(this))%2==0)
		{
			$(this).css("background-color","#F7F7F7");
		}
		else
		{
			$(this).css("background-color","transparent");
		}
	});
	$(":text,:password,:file,textarea").addClass("inputstyle");
});
</script>
</head>
<body>