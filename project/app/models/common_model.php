<?php if( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class common_model extends Model
{
	function common_model()
	{
		parent::Model();
	}
	
	function get_page_records($arr)
	{
		foreach($arr as $k => $v)
		{
			$$k = $v;
		}
		unset($arr);
		if( ! isset($sql) || ! isset($page_base)) return false;
		if( ! isset($per_page)) $per_page = 15;
		if( ! isset($offset)) $offset = $this->uri->segment(4, 0);
		
		if( ! isset($total_rows))
		{
			$query = mysql_query($sql,$this->db->conn_id);
			$total_rows = mysql_num_rows($query);
			mysql_free_result($query);
		}
		if($total_rows == $offset || $total_rows < $offset)
		{
			$offset=0;
		}
		$this->load->library('pagination');
		$this->pagination->initialize(
			array(
					'base_url'		 => $page_base,
					'total_rows'	 => $total_rows,
					'per_page'		 => $per_page,
					'cur_page'       => $offset
			)
		);
		$query = $this->db->query($sql.' LIMIT '.$offset.' ,'.$per_page);
		$data=array(
			'query'    => $query -> result(),
			'paginate' => $this->pagination->create_links()
		);
		$query->free_result();
		return $data;
	}
	
	function get_pages_records($arr)
	{
		foreach($arr as $k => $v)
		{
			$$k = $v;
		}
		unset($arr);
		if( ! isset($sql) || ! isset($page_base)) return false;
		if( ! isset($per_page)) $per_page = 15;
		if( ! isset($offset)) $offset = $this->uri->segment(4, 0);
		
		if( ! isset($total_rows))
		{
			$query = mysql_query($sql,$this->db->conn_id);
			$total_rows = mysql_num_rows($query);
			mysql_free_result($query);
		}
		if($total_rows == $offset || $total_rows < $offset)
		{
			$offset=0;
		}
		$this->load->library('paginations');
		$this->paginations->initialize(
			array(
					'base_url'		 => $page_base,
					'total_rows'	 => $total_rows,
					'per_page'		 => $per_page,
					'cur_page'       => $offset
			)
		);
		$query = $this->db->query($sql.' LIMIT '.$offset.' ,'.$per_page);
		$data=array(
			'query'    => $query -> result(),
			'paginate' => $this->paginations->create_links()
		);
		$query->free_result();
		return $data;
	}
	
	function get_html_page_records($arr)
	{
		foreach($arr as $k => $v)
		{
			$$k = $v;
		}
		unset($arr);
		if( ! isset($sql) || ! isset($page_base)) return false;
		if( ! isset($per_page)) $per_page = 12;
		if( ! isset($offset)) $offset = 0;
		
		if( ! isset($total_rows))
		{
			$query = mysql_query($sql,$this->db->conn_id);
			$total_rows = mysql_num_rows($query);
			mysql_free_result($query);
		}
		if($total_rows == $offset || $total_rows < $offset)
		{
			$offset=0;
		}
		$this->load->library('htmlpage');
		$this->htmlpage->initialize(
			array(
					'base_url'		 => $page_base,
					'total_rows'	 => $total_rows,
					'per_page'		 => $per_page,
					'para_value'		 => $catalog_id,
					'cur_page'       => $offset
			)
		);
		$query = $this->db->query($sql.' LIMIT '.$offset.' ,'.$per_page);
		$data=array(
			'query'    => $query -> result(),
			'paginate' => $this->htmlpage->create_links()
		);
		$query->free_result();
		return $data;
	}
	
	function get_records($sql,$p=array())
	{
		if(empty($p))
		{
			$query = $this->db->query($sql);
		}
		else
		{
			$query = $this->db->query($sql,$p);
		}
				
		$rs = array();
		if($query->num_rows()>0) $rs = $query->result();
		$query->free_result();
		return $rs;
	}
	
	function get_record($sql,$p=array())
	{
		if(empty($p))
		{
			$query = $this->db->query($sql);
		}
		else
		{
			$query = $this->db->query($sql,$p);
		}
		
		$rs = false;
		if($query->num_rows()>0) $rs = $query->row();
		$query->free_result();
		return $rs;
	}
	
	function sort_record($tb)
	{
		$rd_id=$this->input->post("rd_id");
		if(!is_array($rd_id))
		{
			return FALSE;
		}
		foreach($rd_id as $row)
		{
			$sort_value=$this->input->post("sort".$row)?(int)$this->input->post("sort".$row):0;
			$this->db->update($tb,array('seqorder'=>$sort_value),array('id'=>$row));
		}
		return TRUE;
	}
	
	function del_record($tb)
	{
		$rd_id=$this->input->post("rd_id");
		if( ! is_array($rd_id))
		{
			return FALSE;
		}
		$this->db->where_in("id",$rd_id);
		$this->db->delete($tb);
		return TRUE;
	}
}
?>