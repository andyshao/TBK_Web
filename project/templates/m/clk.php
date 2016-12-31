<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title>数据加载中,请稍等...</title>
<script language="javascript">window.onerror = function(){return true;}</script>
<script type="text/javascript" src="{root_path}js/jquery/jquery.js"></script>
<style type="text/css">
#show{width:70%;  height: 50px;  padding: 10px;  border: 8px solid #E8E9F7;  background-color: white; text-align:center; line-height:50px; vertical-align:middle; overflow:hidden; font-size:16px; margin:0 auto}
</style>
</head>

<body>
<div style=" margin:0 auto; text-align:center; padding:50px 0">
<div id="show"><img src="{tpl_path}images/loading.gif" style="vertical-align:middle;" /> 数据加载中,请稍等...</div>
</div>
<script language="javascript">
function get_et()
{
  var s = new Date(),
  l = +s / 1000 | 0,
  r = s.getTimezoneOffset() * 60,
  p = l + r,
  m = p + (3600 * 8),
  q = m.toString().substr(2, 8).split(""),
  o = [6, 3, 7, 1, 5, 2, 0, 4],
  n = [];
  for (var k = 0; k < o.length; k++) {
	  n.push(q[o[k]])
  }
  n[2] = 9 - n[2];
  n[4] = 9 - n[4];
  n[5] = 9 - n[5];
  return n.join("")
}

function setCookie(j, k)
{
    document.cookie = j + "=" + encodeURIComponent(k.toString()) + "; path=/"
}

function getCookie(l)
{
	var m = (" " + document.cookie).split(";"),
	j = "";
	for (var k = 0; k < m.length; k++) {
		if (m[k].indexOf(" " + l + "=") === 0) {
			j = decodeURIComponent(m[k].split("=")[1].toString());
			break
		}
	}
	return j
}

function get_pgid()
{
  var l = "",
  k = "",
  n,
  o,
  t,
  u,
  s = location,
  m = "",
  q = Math;
  function r(x, z) {
	  var y = "",
	  v = 1,
	  w;
	  v = Math.floor(x.length / z);
	  if (v == 1) {
		  y = x.substr(0, z)
	  } else {
		  for (w = 0; w < z; w++) {
			  y += x.substr(w * v, 1)
		  }
	  }
	  return y
  }
  
 n = (" " + document.cookie).split(";");
  for (o = 0; o < n.length; o++) {
	  if (n[o].indexOf(" cna=") === 0) {
		  k = n[o].substr(5, 24);
		  break
	  }
  }
  
  if (k === "") {
	  cu = (s.search.length > 9) ? s.search: ((s.pathname.length > 9) ? s.pathname: s.href).substr(1);
	  n = document.cookie.split(";");
	  for (o = 0; o < n.length; o++) {
		  if (n[o].split("=").length > 1) {
			  m += n[o].split("=")[1]
		  }
	  }
	  if (m.length < 16) {
		  m += "abcdef0123456789"
	  }
	  k = r(cu, 8) + r(m, 16)
  }
  for (o = 1; o <= 32; o++) {
	  t = q.floor(q.random() * 16);
	  if (k && o <= k.length) {
		  u = k.charCodeAt(o - 1);
		  t = (t + u) % 16
	  }
	  l += t.toString(16)
  }
  setCookie('amvid', l);
  var p = getCookie('amvid');
  if (p) {
	  return p
  }
  return l
}
	
var click_url = 'http://item.taobao.com/item.htm?id=<?php echo $num_iid;?>';
var pid = '<?php echo $this->config->item('ali_pid');?>';
var wt = '0';
var ti = '625';
var tl = '230x45';
var rd = '1';
var ct = encodeURIComponent('itemid=<?php echo $num_iid;?>');
var st = '2';
var rf = encodeURIComponent(document.URL);
var et = get_et();
var pgid = get_pgid();
var v = '2.0';
$(function(){
	$.ajax({
 		url: 'http://g.click.taobao.com/display?cb=?',
    	type: 'GET',    
     	dataType: 'jsonp',
    	jsonp: 'cb', 
    	data: 'pid='+pid+'&wt='+wt+'&ti='+ti+'&tl='+tl+'&rd='+rd+'&ct='+ct+'&st='+st+'&rf='+rf+'&et='+et+'&pgid='+pgid+'&v='+v,
    	success: function(msg) {
			if(msg.code == 200)
			{
				document.location.href = msg.data.items[0].ds_item_click;
			}
			else
			{
				document.location.href = click_url;
			}
		},    
		error: function(msg){    
        	document.location.href = click_url;
		}    
	});  
});
</script>
</body>
</html>
