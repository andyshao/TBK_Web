<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bot_nav extends Controller
{
	function Bot_nav()
	{
		parent::Controller();
		$this->load->model("tadmin/com_model");
		$this->com_model->check_is_login();
		$this->load->library('form_validation');
	}

	function index()
	{
		$data = array(
			'query'		=> $this->common_model->get_records('SELECT id,title,hplink,target,seqorder FROM '.$this->db->dbprefix.'nav WHERE is_top = 0 ORDER BY seqorder DESC,id DESC')
		);
		$this->load->view(TPL_FOLDER."bot_nav",$data);
	}
	
	function add_record_view()
	{
		$this->load->config('sort_type');
		$this->load->view(TPL_FOLDER."bot_nav_add");
	}
	
	function sort_record()
	{
		$this->form_validation->set_rules("rd_id[]","排序项","is_natural_no_zero");
		if($this->form_validation->run()==FALSE) echo_msg(validation_errors());
		
		$rd_id=$this->input->post("rd_id");
		foreach($rd_id as $row)
		{
			$sort_value=$this->input->post("sort".$row)?(int)$this->input->post("sort".$row):0;
			$this->db->update("nav",array('seqorder'=>$sort_value),array('id'=>$row));
		}
		$this->_write_cache();
		echo_msg('<li>记录排序成功.</li>','','yes');
	}
	
	function add_record()
	{
		$this->form_validation->set_rules("title","导航","trim|required");
		$this->form_validation->set_rules("hplink","链接","trim|required");
		$this->form_validation->set_rules("seqorder","排序号","trim|is_natural");
		if($this->form_validation->run() == FALSE) echo_msg(validation_errors());
		
		$data=array(
			'is_top' => 0,
			'title'=>$this->input->post("title",true),
			'hplink'=>$this->input->post("hplink"),
			'target'=>$this->input->post("target"),
			'seqorder'=>$this->input->post("seqorder")
		);
		$this->db->insert("nav",$data);
		$this->_write_cache();
		echo_msg('<li>记录添加成功，你可以继续添加</li>','','yes');
	}
	
	function edit_record()
	{
		$rd_id = (int)$this->uri->segment(4,0);
		$data=array(
			'edit_data'=>$this->common_model->get_record('SELECT * FROM '.$this->db->dbprefix.'nav WHERE id = '.$rd_id)
		);
		$this->load->config('sort_type');
		$this->load->view(TPL_FOLDER."bot_nav_edit",$data);
	}
	
	function save_record()
	{
		$this->form_validation->set_rules("title","导航","trim|required");
		$this->form_validation->set_rules("hplink","链接","trim|required");
		$this->form_validation->set_rules("seqorder","排序号","trim|is_natural");
		$this->form_validation->set_rules("rd_id","记录ID","trim|is_natural_no_zero");
		if($this->form_validation->run()==FALSE) echo_msg(validation_errors());
		
		$data=array(
			'title'=>$this->input->post("title",true),
			'hplink'=>$this->input->post("hplink"),
			'target'=>$this->input->post("target"),
			'seqorder'=>$this->input->post("seqorder")
		);
		$this->db->update("nav",$data,array('id'=>$this->input->post('rd_id')));
		$this->_write_cache();
		echo_msg('<li>记录修改成功.</li>',my_site_url(CTL_FOLDER.'bot_nav'),'yes');
	}
	
	function del_record()
	{
		$this->form_validation->set_rules("rd_id[]","删除的记录","is_natural_no_zero");
		if($this->form_validation->run()==FALSE) echo_msg(validation_errors());
		
		$rd_id = $this->input->post('rd_id');
		$rd_id = implode(',',$rd_id);
		$this->db->simple_query('DELETE FROM '.$this->db->dbprefix.'nav WHERE id IN('.$rd_id.')');
		$this->_write_cache();
		echo_msg('<li>记录删除成功.</li>','','yes');
	}
	
	function re_cache()
	{
		$this->_write_cache();
		echo_msg('<li>缓存生成成功.</li>','','yes');
	}
	
	function _write_cache()
	{
		$query = $this->common_model->get_records('SELECT title,hplink,target FROM '.$this->db->dbprefix.'nav WHERE is_top = 0 ORDER BY seqorder DESC,id DESC');
		save_cache('bot_nav',$query);
		unset($query);
	}
}
?>