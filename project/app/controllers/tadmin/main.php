<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main extends Controller
{
	function Main()
	{
		parent::Controller();
		$this->load->model("tadmin/com_model");
		$this->com_model->check_is_login();
	}
	
	function index()
	{
		$this->load->view(TPL_FOLDER."main");
	}
	
	function top()
	{	
		$this->load->view(TPL_FOLDER."top");
	}
	
	function menu()
	{	
		$this->load->view(TPL_FOLDER."left_menu");
	}
	
	function welcome()
	{	
		$tpl_data=array(
			'sys_user_name'=>$this->session->userdata("sys_user_name"),
			'sys_last_login_time'=>$this->session->userdata("sys_last_login_time"),
			'sys_last_login_ip'=>$this->session->userdata("sys_last_login_ip"),
			'sys_hits'=>$this->session->userdata("sys_hits")
		);
		$this->load->view(TPL_FOLDER."welcome",$tpl_data);
	}
	
	function clear_cache()
	{
		$this->load->helper('file');
		delete_files($this->config->item('apicache_path'),TRUE);
		echo 1;
	}
	
	function clear_cache1()
	{
		$this->load->helper('file');
		delete_files($this->config->item('cache_path'),TRUE);
		echo 1;
	}
}
?>