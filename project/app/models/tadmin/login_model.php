<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login_model extends Model
{
	function Login_model()
	{
		parent::Model();
	}
	
	function check_user($user_name,$password)
	{
		$this->db->where('user_name',$user_name);
		$this->db->where('password',$password);
		$query=$this->db->get("admin");
		if($query->num_rows>0)
		{
			$row=$query->row();
			$data=array(
				'last_login_ip'=>$this->input->ip_address(),
				'last_login_time'=>time(),
				'hits'=>$row->hits+1
			);
			$this->db->where('user_name',$user_name);
			$this->db->update('admin',$data);
			$row->last_login_time = $row->last_login_time?$row->last_login_time:time();
			$row->last_login_ip = $row->last_login_ip?$row->last_login_ip:$this->input->ip_address();
			
			$session_data=array(
				'sys_user_id'=>$row->id,
				'sys_user_name'=>$row->user_name,
				'sys_md5_encode_str'=>md5($row->user_name.$this->config->item('md5_encode_key')),
				'sys_last_login_time'=>date("Y-m-d H:i:s",$row->last_login_time),
				'sys_last_login_ip'=>$row->last_login_ip,
				'sys_hits'=>$data['hits']
			);
			$this->session->set_userdata($session_data);
			return true;
		}
		else
		{
			return false;
		}
	}
}
?>