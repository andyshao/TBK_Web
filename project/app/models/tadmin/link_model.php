<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Link_model extends Model
{
	function Link_model()
	{
		parent::Model();
	}
	function add_record($f_path)
	{
		$data=array(
			'title'=>filter_str($this->input->post("title")),
			'hplink'=>$this->input->post("hplink"),
			'seqorder'=>$this->input->post("seqorder")
		);
		if($f_path['file_path'])
		{
			$data['pic_path']=$f_path['file_path'];
		}
		else
		{
			$data['pic_path']=$this->input->post("pic_path");
		}
		$this->db->insert("link",$data);
		return TRUE;
	}
	
	function get_record($id)
	{
		$query=$this->db->get_where("link",array('id'=>$id));
		if($query->num_rows()>0)
		{
			return $query->row_array();
		}
	}
	
	function sort_record()
	{
		$rd_id=$this->input->post("rd_id");
		if(!is_array($rd_id))
		{
			return FALSE;
		}
		foreach($rd_id as $row)
		{
			$sort_value=$this->input->post("sort".$row)?(int)$this->input->post("sort".$row):0;
			$this->db->update("link",array('seqorder'=>$sort_value),array('id'=>$row));
		}
		return TRUE;
	}
	
	function save_record($f_path)
	{
		$rd_id=$this->input->post("rd_id");
		$data=array(
			'title'=>filter_str($this->input->post("title")),
			'seqorder'=>$this->input->post("seqorder"),
			'hplink'=>$this->input->post("hplink")
		);
		if($f_path['file_path'])
		{
			$data['pic_path']=$f_path['file_path'];
		}
		else
		{
			$data['pic_path']=$this->input->post("pic_path");
		}
		$this->db->update("link",$data,array('id'=>$rd_id));
		return TRUE;
	}
	
	function del_record()
	{
		$rd_id=$this->input->post("rd_id");
		if(!is_array($rd_id))
		{
			return FALSE;
		}
		$this->db->where_in("id",$rd_id);
		$this->db->delete("link");
		if($this->db->affected_rows())
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}
?>