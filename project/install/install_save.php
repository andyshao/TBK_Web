<?php
require("check_install.php");
define("ROOT_PATH",substr($_SERVER['PHP_SELF'],0,strpos($_SERVER['PHP_SELF'],"install")));
if(isset($_POST))
{
	foreach($_POST as $k=>$v)
	{
		$$k = strip_quotes($v);
	}
}
unset($_POST);

$error_msg = '';
if( ! isset($hostname) || empty($hostname)) $error_msg.="数据库主机地址不能为空<br>";
if( ! isset($username) || empty($username)) $error_msg.="数据库连接账号不能为空<br>";
if( ! isset($password) || empty($password)) $error_msg.="数据库连接密码不能为空<br>";
if( ! isset($database) || empty($database)) $error_msg.="数据库名不能为空<br>";
if( ! isset($dbprefix) || empty($database)) $error_msg.="数据表前缀不能为空<br>";
if( ! isset($admin_name) || empty($admin_name)) $error_msg.="管理员账号不能为空<br>";
if( ! isset($admin_password) || empty($admin_password)) $error_msg.="管理员密码不能为空<br>";
if( ! isset($time_zone) || empty($time_zone)) $error_msg.="必须选择一个时区<br>";

if($error_msg) die($error_msg.'<a href="install.php">点击这里返回</a>');

$install_data = read_file('data/structure.sql');

if( ! $install_data) die('数据库文件不存在，无法完成安装 <a href="install.php">点击这里返回</a>');

if(!($connect=@mysql_connect( $hostname , $username , $password ) ))
{
	die("数据库连接失败,请确认您使用的数据库帐号和密码是否正确,<a href=\"install.php\">点击这里返回</a>");
}

if(function_exists('mysql_get_server_info'))
{
	$sevinfo = mysql_get_server_info($connect);
	if($sevinfo > '4.0.1') 
	{
		mysql_query( "set names 'utf8'" , $connect );
	}
	
	if($sevinfo >= '5.0.18') 
	{
		 mysql_query("SET sql_mode=''" , $connect );
	}
	
	$unicode_version = ( $sevinfo > '4.1.12' ? true : false );
	if( $unicode_version )
	{
		$sql = "CREATE DATABASE IF NOT EXISTS `{$database}` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
	}
	else
	{
		$sql = "CREATE DATABASE IF NOT EXISTS `{$database}` ";
	}
	mysql_query(trim($sql),$connect);
}

if(!$select=mysql_select_db( $database , $connect ))
{
	die("无法选择数据库,或数据库不存在,<a href=\"install.php\">点击这里返回</a>");
}

//开始安装数据库表结构
//$files = preg_replace( "/([-- ].+[\r|\n]*)/" , '' , $install_data );
$files = preg_replace( "/=\"[^\s]*uploadfiles\//" , "=\"".ROOT_PATH."uploadfiles/" , $install_data);
$files = str_replace("{dbprefix}",$dbprefix,$files);
$sqls = split_sql_file( $files );
//print_r($sqls);
//exit();
foreach( $sqls as $sql )
{
	mysql_query(trim($sql),$connect);
}

if( mysql_errno() != 0 )
{
	echo mysql_error();
	exit();
}

//添加管理员
mysql_query("DELETE FROM {$dbprefix}admin", $connect);
$sql="INSERT INTO `{$dbprefix}admin` (`user_name`,`password`,`hits`,`create_date`) VALUES ('".$admin_name."','".md5($admin_password)."',0,".time().")";
mysql_query( $sql ,$connect );

//安装测试数据
if($install_test_data == 'yes')
{
	$install_data = read_file('data/data.sql');
	if($install_data)
	{
		$files = preg_replace( "/=\"[^\s]*uploadfiles\//" , "=\"".ROOT_PATH."uploadfiles/" , $install_data);
		$files = str_replace("{dbprefix}",$dbprefix,$files);
		$sqls = split_sql_file( $files );
		//print_r($sqls);
		//exit();
		foreach( $sqls as $sql )
		{
			mysql_query(trim($sql),$connect);
		}
	}
}

//修改数据库配置文件
if( ! is_really_writable( ROOT.'app/config/database.php') )
{
	die("数据库配置文件不可写，安装程序无法继续进行。<a href=\"install.php\">点击这里返回</a>");
}
$contents = read_file( ROOT.'app/config/database.php' );
$reg ='/\$db\[\'default\'\]\[\'(.+?)\'\].+?;/is';
preg_match_all( $reg ,$contents , $out  );
if( $out[1] )
{
	$old = $new = array();
	foreach( $out[1] as $k => $v )
	{
		if( isset($$v) )
		{
			$old[] = $out[0][$k];
			$new[] = '$db[\'default\'][\''.$v.'\'] = "'.$$v.'";';
		}
	}
	if( $new )
	{
		$contents = str_replace( $old , $new , $contents );
		write_file( ROOT.'app/config/database.php' , $contents );
	}
}

//修改时区设置
if(is_really_writable( ROOT.'app/config/constants.php'))
{
	$contents = read_file( ROOT.'app/config/constants.php' );
	$reg ='/define\(\'TIME_ZONE\'\,\'(.+?)\'\);/is';
	preg_match_all( $reg ,$contents , $out  );
	if( $out[1] )
	{
		$old = $out[0][0];
		$new = $out[0][0];
		$new = str_replace($out[1][0],$time_zone,$new);
		$contents = str_replace( $old , $new , $contents );
		write_file( ROOT.'app/config/constants.php' , $contents );
	}
}

//写入程序安装锁文件
write_file('install.lock' , 'locked' );

header('Location:finish.php');


function split_sql_file($sql, $delimiter = ';') 
{
	$sql               = trim($sql);
	$char              = '';
	$last_char         = '';
	$ret               = array();
	$string_start      = '';
	$in_string         = FALSE;
	$escaped_backslash = FALSE;

	for ($i = 0; $i < strlen($sql); ++$i) {
		$char = $sql[$i];

		// if delimiter found, add the parsed part to the returned array
		if ($char == $delimiter && !$in_string) {
			$ret[]     = substr($sql, 0, $i);
			$sql       = substr($sql, $i + 1);
			$i         = 0;
			$last_char = '';
		}

		if ($in_string) {
			// We are in a string, first check for escaped backslashes
			if ($char == '\\') {
				if ($last_char != '\\') {
					$escaped_backslash = FALSE;
				} else {
					$escaped_backslash = !$escaped_backslash;
				}
			}
			// then check for not escaped end of strings except for
			// backquotes than cannot be escaped
			if (($char == $string_start)
				&& ($char == '`' || !(($last_char == '\\') && !$escaped_backslash))) {
				$in_string    = FALSE;
				$string_start = '';
			}
		} else {
			// we are not in a string, check for start of strings
			if (($char == '"') || ($char == '\'') || ($char == '`')) {
				$in_string    = TRUE;
				$string_start = $char;
			}
		}
		$last_char = $char;
	} // end for

	// add any rest to the returned array
	if (!empty($sql)) {
		$ret[] = $sql;
	}
	return $ret;
}

?>
