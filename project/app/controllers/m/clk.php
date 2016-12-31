<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * goods detail
 * @author		Jade Xia
 * @copyright	Copyright (c) 2010 - 2011 天夏网络.
 * @link		http://www.tianxianet.com
 *
 */
class Clk extends Controller
{
		
	function Clk()
	{
		parent::Controller();
	}
	
	function index()
	{
		$rd_id = $this->uri->segment(3,0);
		$data = array('num_iid'=>$rd_id);
		$this->load->config('pid_config');
		$this->load->view(TPL_FOLDER.'clk',$data);
	}
}
?>