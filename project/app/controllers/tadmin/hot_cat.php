<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Hot_cat extends Controller
{
	function Hot_cat()
	{
		parent::Controller();
		$this->load->model("tadmin/com_model");
		$this->com_model->check_is_login();
		$this->load->library('form_validation');
	}

	function index()
	{
		$data = array(
			'query'		=> $this->common_model->get_records('SELECT * FROM '.$this->db->dbprefix.'hot_cat ORDER BY seqorder DESC,id DESC')
		);
		$this->load->view(TPL_FOLDER."hot_cat",$data);
	}
	
	function add_record_view($id = 0)
	{
		$data = array(
			'cid'	=> $this->common_model->get_records('SELECT id,cat_name FROM '.$this->db->dbprefix.'hot_cat WHERE parent_id = 0 ORDER BY seqorder DESC,id DESC'),
			'parent_id' => $id
		);
		$this->load->view(TPL_FOLDER."hot_cat_add",$data);
	}
	
	function sort_record()
	{
		$this->form_validation->set_rules("rd_id[]","排序项","is_natural_no_zero");
		if($this->form_validation->run()==FALSE) echo_msg(validation_errors());
		
		$rd_id=$this->input->post("rd_id");
		foreach($rd_id as $row)
		{
			$sort_value=$this->input->post("sort".$row)?(int)$this->input->post("sort".$row):0;
			$this->db->update("hot_cat",array('seqorder'=>$sort_value),array('id'=>$row));
		}
		$this->_write_cache();
		echo_msg('<li>记录排序成功.</li>','','yes');
	}
	
	function add_record()
	{
		$this->form_validation->set_rules("cat_name","关键词","trim|required");
		$this->form_validation->set_rules("q","关键词","trim|required");
		$this->form_validation->set_rules("seqorder","排序号","trim|is_natural");
		$this->form_validation->set_rules("parent_id","上级分类","trim|is_natural");
		if($this->form_validation->run() == FALSE) echo_msg(validation_errors());
		
		$data=array(
			'q'=>$this->input->post("q",true),
			'cat_name'=>$this->input->post("cat_name",true),
			'cid'=>$this->input->post("cid",true),
			'parent_id'=>$this->input->post("parent_id"),
			'seqorder'=>$this->input->post("seqorder")
		);
		$this->db->insert("hot_cat",$data);
		$this->_write_cache();
		redirect(site_url(CTL_FOLDER.'hot_cat/add_record_view/'.$this->input->post("parent_id")));
	}
	
	function edit_record()
	{
		$rd_id = (int)$this->uri->segment(4,0);
		$data=array(
			'edit_data'=>$this->common_model->get_record('SELECT * FROM '.$this->db->dbprefix.'hot_cat WHERE id = '.$rd_id),
			'cid'	=> $this->common_model->get_records('SELECT id,cat_name FROM '.$this->db->dbprefix.'hot_cat WHERE parent_id = 0 ORDER BY seqorder DESC,id DESC')
		);
		$this->load->view(TPL_FOLDER."hot_cat_edit",$data);
	}
	
	function save_record()
	{
		$this->form_validation->set_rules("cat_name","关键词","trim|required");
		$this->form_validation->set_rules("q","关键词","trim|required");
		$this->form_validation->set_rules("seqorder","排序号","trim|is_natural");
		$this->form_validation->set_rules("parent_id","上级分类","trim|is_natural");
		$this->form_validation->set_rules("rd_id","记录ID","trim|is_natural_no_zero");
		if($this->form_validation->run()==FALSE) echo_msg(validation_errors());
		
		$data=array(
			'q'=>$this->input->post("q",true),
			'cat_name'=>$this->input->post("cat_name",true),
			'cid'=>$this->input->post("cid",true),
			'parent_id'=>$this->input->post("parent_id"),
			'seqorder'=>$this->input->post("seqorder")
		);
		$this->db->update("hot_cat",$data,array('id'=>$this->input->post('rd_id')));
		$this->_write_cache();
		echo_msg('<li>记录修改成功.</li>',my_site_url(CTL_FOLDER.'hot_cat'),'yes');
	}
	
	function del_record()
	{
		$this->form_validation->set_rules("rd_id[]","删除的记录","is_natural_no_zero");
		if($this->form_validation->run()==FALSE) echo_msg(validation_errors());
		
		$rd_id = $this->input->post('rd_id');
		$rd_id = implode(',',$rd_id);
		$this->db->simple_query('DELETE FROM '.$this->db->dbprefix.'hot_cat WHERE id IN('.$rd_id.')');
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
		$query = $this->common_model->get_records('SELECT id,cat_name,q,parent_id,cid FROM '.$this->db->dbprefix.'hot_cat ORDER BY seqorder DESC,id DESC');
		save_cache('hot_cat',$query);
		unset($query);
	}
}
?>