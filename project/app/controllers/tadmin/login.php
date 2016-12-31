<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends Controller
{
	function Login()
	{
		parent::Controller();
		$this->load->database();
		$this->load->model("tadmin/Login_model");
	}
	
	function index()
	{
		$this->load->config('site_config');
		$data = array(
			'site_title' => $this->config->item('sys_site_name')
		);
		$this->load->view(TPL_FOLDER."login",$data);
	}
	
	function logout()
	{
		$this->session->sess_destroy();
		redirect(CTL_FOLDER.'login');
	}

	function check_login()
	{
		if($this->session->userdata("sys_user_name"))
		{
			redirect(CTL_FOLDER."main");
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('user_name','管理员账号','required');
		$this->form_validation->set_rules('password','管理员密码','required');
		
		if($this->form_validation->run()==FALSE) echo_msg(validation_errors());
		if($this->Login_model->check_user($this->input->post("user_name"),md5($this->input->post("password"))))
		{
			redirect(CTL_FOLDER."main");
		}
		else
		{
			echo_msg("<li>管理员账号或者密码有误</li>");
		}
	}
}
?>