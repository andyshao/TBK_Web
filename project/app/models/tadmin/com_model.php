<?php if( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Com_model extends Model
{
	function Com_model()
	{
		parent::Model();
		$this->load->database();
	}
	
	function check_is_login()
	{
		if( ! $this->_check_login()) 
		{
			echo_msg('<li>登陆超时，或者您还没登陆</li>',site_url(CTL_FOLDER.'login'),'no','_top');
		}
	}
	
	function _check_login()
	{
		$user_name = $this->session->userdata("sys_user_name");
		$md5_encode_str = $this->session->userdata("sys_md5_encode_str");
		$md5_encode_key = $this->config->item('md5_encode_key');
		if( (! $user_name) ||  (! $md5_encode_str) ||  ($md5_encode_str != md5($user_name.$md5_encode_key))) 
		{
			$this->session->sess_destroy();
			return FALSE;
		} else return TRUE;
	}
}
?>