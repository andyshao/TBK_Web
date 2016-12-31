<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends Controller
{
	function Admin()
	{
		parent::Controller();
		$this->load->model("tadmin/com_model");
		$this->com_model->check_is_login();
		$this->load->model("tadmin/Admin_model");
		$this->load->library('form_validation');
	}
	
	function index()
	{
		$data = array(
			'query'	=> $this->Admin_model->get_records()
		);
		$this->load->view(TPL_FOLDER."admin_list",$data);
	}
	
	function edit_record()
	{
		$rd_id=$this->uri->segment(4,0);
		if(!$rd_id) 
		{
			$tx_msg="<li>ID参数有误.</li>";
			echo_msg($tx_msg);
		}
		$edit_data=$this->Admin_model->get_record($rd_id);
		$data=array(
			'edit_data'=>$edit_data
		);
		$this->load->view(TPL_FOLDER."admin_edit",$data);
	}
	
	function add_record()
	{
		$this->form_validation->set_rules("user_name","管理员账号","trim|required");
		$this->form_validation->set_rules("email","管理员email","trim|valid_email");
		$this->form_validation->set_rules("password","管理员密码","trim|required|matches[c_password]");
		$this->form_validation->set_rules("c_password","确认密码","trim|required");
		$tx_msg="";
		if($this->form_validation->run()==FALSE)
		{
			$tx_msg.=validation_errors();
		}
		if($tx_msg!="")
		{
			echo_msg($tx_msg);
		}
		if($this->Admin_model->add_record())
		{
			
			$tx_msg="<li>记录添加成功.</li>";
			echo_msg($tx_msg,'','yes');
		}
		else
		{
			$tx_msg="<li>记录添加失败,原因可能是该管理员账号已经存在.</li>";
			echo_msg($tx_msg);
		}
	}
	
	function del_record()
	{
		$this->form_validation->set_rules("rd_id[]","删除的记录","is_natural_no_zero");
		if($this->form_validation->run()==FALSE)
		{
			$tx_msg=validation_errors();
			echo_msg($tx_msg);
		}
		if($this->Admin_model->del_record())
		{
			
			$tx_msg="<li>记录删除成功.</li>";
			echo_msg($tx_msg,'','yes');
		}
		else
		{
			$tx_msg="<li>记录删除失败.</li>";
			echo_msg($tx_msg);
		}
	}
	
	function save_record()
	{
		$this->form_validation->set_rules("user_name","管理员账号","trim|required");
		$this->form_validation->set_rules("email","管理员email","trim|valid_email");
		$tx_msg="";
		if($this->form_validation->run()==FALSE)
		{
			$tx_msg.=validation_errors();
		}
		if($tx_msg!="")
		{
			echo_msg($tx_msg);
		}
		if($this->Admin_model->save_record())
		{
			
			$tx_msg="<li>记录修改成功.</li>";
			echo_msg($tx_msg,site_url(CTL_FOLDER."admin"),'yes');
		}
		else
		{
			$tx_msg="<li>记录修改失败,原因可能是该管理员账号已经存在。</li>";
			echo_msg($tx_msg);
		}
	}
	
	function modify_password()
	{
		$this->load->view(TPL_FOLDER."modify_password");
	}
	
	function modify_password_do()
	{
		$this->form_validation->set_rules("old_password","旧密码","trim|required");
		$this->form_validation->set_rules("new_password","新密码","trim|required|matches[c_new_password]");
		$this->form_validation->set_rules("c_new_password","确认密码","trim|required");
		$tx_msg="";
		if($this->form_validation->run()==FALSE)
		{
			$tx_msg.=validation_errors();
		}
		if($tx_msg!="")
		{
			echo_msg($tx_msg);
		}
		if($this->Admin_model->update_password(md5($this->input->post("old_password")),md5($this->input->post("new_password"))))
		{
			$tx_msg="<li>密码修改成功.</li>";
			echo_msg($tx_msg,'','yes');
		}
		else
		{
			$tx_msg="<li>密码修改失败.</li>";
			echo_msg($tx_msg);
		}
	}
}
?>