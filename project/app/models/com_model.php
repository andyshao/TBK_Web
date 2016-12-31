<?php if( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Com_model extends Model
{
	var $uri_segnum = 2;
	function Com_model()
	{
		parent::Model();
	}
	
	function _check_login()
	{
		$user_name = $this->session->userdata("shop_user_name");
		$md5_encode_str = $this->session->userdata("shop_user_md5_encode_str");
		$md5_encode_key = $this->config->item('md5_encode_key');
		$query = $this->common_model->get_record('SELECT id FROM '.$this->db->dbprefix."shop_user WHERE user_name = '".$user_name."'");
		if( (! $user_name) ||  (! $md5_encode_str) ||  ($md5_encode_str != md5($user_name.$md5_encode_key)) || (! $query))
		{
			unset($query);
			return FALSE;
		}
		else 
		{
			unset($query);
			return TRUE;
		}
	}
	
	function check_is_login()
	{
		if( ! $this->_check_login())
		{
			$this->destroy_session();
			$url = site_url('login');
			if(isset($_SERVER['HTTP_REFERER']))
			{
				$url = $url.'?url='.urlencode($_SERVER['HTTP_REFERER']);
			}
			echo_msg('<li>登陆超时，或者您还没登陆</li>',$url,'no');
		}
	}
	
	function ajax_check_is_login()
	{
		if( ! $this->_check_login())
		{
			$this->destroy_session();
			diem('nologin');
		}
	}
	
	function destroy_session()
	{
		$this->session->unset_userdata(array(
			'shop_user_id'=>'',
			'shop_last_login_time'=>'',
			'shop_user_name'=>'',
			'shop_user_md5_encode_str'=>''
		));
	}
}
?>