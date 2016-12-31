<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * goods detail
 * @author		soke5
 * @copyright	Copyright (c) 2010 - 2015 搜客淘宝客.
 * @link		http://bbs.soke5.com
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
		$rd_id = $this->uri->segment(2,0);
		$data = array('num_iid'=>$rd_id);
		$this->load->config('pid_config');
		$this->load->view(TPL_FOLDER.'clk',$data);
	}
}
?>