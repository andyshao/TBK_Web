<?php
if (function_exists("date_default_timezone_set"))
{ 
	date_default_timezone_set("Asia/Shanghai"); //PHP5设定时区, 在PHP4无法使用 
} 
else 
{ 
    putenv("TZ=Asia/Shanghai"); //PHP4设定时区的用法 
}
define( 'ROOT' , dirname( __FILE__ ).'/../' );
header("Content-Type:text/html;charset=utf-8");
if( file_exists('install.lock' ) )
{
	die("<div style='background:#DDEDFB;border:1px solid #0099CC; padding:10px; text-align:center; width:100%; margin:0 auto; color:#FF0000; font-weight:bold; font-size:12px;'>禁止安装！如果要重新安装程序，请先删除install目录下的install.lock文件。</div>");
}
$ms = get_loaded_extensions();
if( !in_array( 'mysql' , $ms ) )
{
	die("<div style='background:#DDEDFB;border:1px solid #0099CC; padding:10px; text-align:center; width:100%; margin:0 auto; color:#FF0000; font-weight:bold; font-size:12px;'>您的服务器不支持mysql，所以程序无法完成安装!。</div>");
}

function is_really_writable($file)
{	
	// If we're on a Unix server with safe_mode off we call is_writable
	if (DIRECTORY_SEPARATOR == '/' AND @ini_get("safe_mode") == FALSE)
	{
		return is_writable($file);
	}

	// For windows servers and safe_mode "on" installations we'll actually
	// write a file then read it.  Bah...
	if (is_dir($file))
	{
		$file = rtrim($file, '/').'/'.md5(rand(1,100));

		if (($fp = @fopen($file, 'ab')) === FALSE)
		{
			return FALSE;
		}

		fclose($fp);
		@chmod($file, 0777);
		@unlink($file);
		return TRUE;
	}
	elseif (($fp = @fopen($file, 'ab')) === FALSE)
	{
		return FALSE;
	}

	fclose($fp);
	return TRUE;
}

function read_file($file)
{
	if ( ! file_exists($file))
	{
		return FALSE;
	}

	if (function_exists('file_get_contents'))
	{
		return file_get_contents($file);		
	}

	if ( ! $fp = @fopen($file, 'rb'))
	{
		return FALSE;
	}
	
	flock($fp, LOCK_SH);

	$data = '';
	if (filesize($file) > 0)
	{
		$data =& fread($fp, filesize($file));
	}

	flock($fp, LOCK_UN);
	fclose($fp);

	return $data;
}

function write_file($path, $data, $mode = 'wb')
{
	if ( ! $fp = @fopen($path, $mode))
	{
		return FALSE;
	}
	
	flock($fp, LOCK_EX);
	fwrite($fp, $data);
	flock($fp, LOCK_UN);
	fclose($fp);	

	return TRUE;
}

function strip_quotes($str)
{
	$f = array('"', "'","\r\n","\r","\n","\t","<",">");
	$r = array('&quot;','','','','','','&lt;','&gt;');
	return str_replace($f, $r, $str);
}
?>
