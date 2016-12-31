<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * product and info search page
 * @author		Jade Xia
 * @copyright	Copyright (c) 2010 - 2011 天夏网络.
 * @link		http://www.tianxianet.com
 *
 */
class Cat extends Controller
{
	function Cat()
	{
		parent::Controller();
		$this->load->database();
	}
	
	function index()
	{
		if ($this->config->item('sys_cache_time') > 0) $this->output->cache($this->config->item('sys_cache_time'));
		$data = array(
			'site_title'		=> '商品分类'
		);
		$this->load->view(TPL_FOLDER.'cat',$data); 
	}
}
?>