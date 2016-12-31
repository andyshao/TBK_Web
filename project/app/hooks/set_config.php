<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * config hooks
 * @author		soke5
 * @copyright	Copyright (c) 2010 - 2015 搜客淘宝客.
 * @link		http://bbs.soke5.com
 */
class set_config
{
	function set_path()
	{
		global $URI,$CFG;
		$segment = $URI -> segment(1);
		if( $segment == 'tadmin' )
		{
			define('CTL_FOLDER','tadmin/');
			define('TPL_FOLDER','tadmin/');
			define('TPL_PATH',ROOT_PATH.VIEW_PATH.TPL_FOLDER);
		}
		else if( $segment == 'm')
		{
			define('CTL_FOLDER','m/');
			define('TPL_FOLDER','m/');
			define('TPL_PATH',ROOT_PATH.VIEW_PATH.TPL_FOLDER);
			$CFG->load('site_config');
			$CFG->load('mobile_config');
		}
		else
		{
			define('CTL_FOLDER','');
			define('TPL_FOLDER',TPL_FOLDER_NAME.'/');
			define('TPL_PATH',ROOT_PATH.VIEW_PATH.TPL_FOLDER);
			$CFG->load('site_config');
		}
	}
}
?>