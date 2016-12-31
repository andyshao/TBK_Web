<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ', 							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 					'ab');
define('FOPEN_READ_WRITE_CREATE', 				'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 			'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*
|--------------------------------------------------------------------------
| Path Constant
|--------------------------------------------------------------------------
|
|
*/
define('ROOT_PATH',str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']));
define('VIEW_PATH','templates/');

define("UP_FILES_ROOT","uploadfiles/");
define('UP_FILES_PATH',UP_FILES_ROOT.'files/');
define('UP_IMAGES_PATH',UP_FILES_ROOT.'images/');
define('UP_FILES_EXT','txt|doc|ppt|xls|swf|jpg|gif|png|zip|rar|pdf|flv');
define('UP_IMAGES_EXT','gif|jpg|png');

/*
|--------------------------------------------------------------------------
| time zone
|--------------------------------------------------------------------------
|
|
*/
define('TIME_ZONE','PRC');

/*
|--------------------------------------------------------------------------
| templates
|--------------------------------------------------------------------------
|
|
*/
define('TPL_FOLDER_NAME','default');

/*
|--------------------------------------------------------------------------
| Application copyright
|--------------------------------------------------------------------------
|
|
*/
define('APP_POWER','技术支持：<a href="http://www.tianxianet.com" target="_blank">天夏网络</a>');
define('APP_VERSION','tx-taokeapi-v1.0');

/* End of file constants.php */
/* Location: ./system/application/config/constants.php */