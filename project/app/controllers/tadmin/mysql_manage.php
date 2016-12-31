<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mysql_manage extends Controller
{
	var $backup_path;
	
	function Mysql_manage()
	{
		parent::Controller();
		$this->load->model("tadmin/com_model");
		$this->com_model->check_is_login();
		$this->load->library('form_validation');
		$this->backup_path="backup/";
	}
	
	function index()
	{
		$this->load->helper("file");
		$this->load->helper("number");
		$file_arr=get_dir_file_info($this->backup_path);
		$data=array(
			"file_list"=>$file_arr,
			"folder_size"=>byte_format(getBytes($this->backup_path))
		);	
		$this->load->view(TPL_FOLDER."mysql_manage_list",$data);
	}
	
	function backup()
	{
		$f_size = $this->input->post('f_size');
		if( ! is_numeric($f_size) || $f_size <= 0) echo_msg('<li>分卷大小设置有误</li>');
		$tables = $this->db->list_tables();
		
		$output = '';
		$newline = "\n";
		$f_name = date('Y_m_d_H_i_s',time());
		$f_num = 1;
		foreach ((array)$tables as $table)
		{
			// Get the table schema
			$query = $this->db->query("SHOW CREATE TABLE `".$this->db->database.'`.`'.$table.'`');

			// No result means the table name was invalid
			if ($query === FALSE)
			{
				continue;
			}

			// Write out the table schema
			$output .= '#'.$newline.'# TABLE STRUCTURE FOR: '.$table.$newline.'#'.$newline.$newline;

			$output .= 'DROP TABLE IF EXISTS '.$table.';'.$newline.$newline;

			$i = 0;
			$result = $query->result_array();
			foreach ($result[0] as $val)
			{
				if ($i++ % 2)
				{
					$output .= $val.';'.$newline.$newline;
				}
			}

			// Grab all the data from the current table
			$query = $this->db->query("SELECT * FROM $table");

			if ($query->num_rows() == 0)
			{
				continue;
			}

			// Fetch the field names and determine if the field is an
			// integer type.  We use this info to decide whether to
			// surround the data with quotes or not

			$i = 0;
			$field_str = '';
			$is_int = array();
			while ($field = mysql_fetch_field($query->result_id))
			{
				// Most versions of MySQL store timestamp as a string
				$is_int[$i] = (in_array(
										strtolower(mysql_field_type($query->result_id, $i)),
										array('tinyint', 'smallint', 'mediumint', 'int', 'bigint'), //, 'timestamp'),
										TRUE)
										) ? TRUE : FALSE;

				// Create a string of field names
				$field_str .= '`'.$field->name.'`, ';
				$i++;
			}

			// Trim off the end comma
			$field_str = preg_replace( "/, $/" , "" , $field_str);


			// Build the insert string
			while ($row = mysql_fetch_assoc($query->result_id))
			{
				$val_str = '';

				$i = 0;
				foreach ($row as $v)
				{
					// Is the value NULL?
					if ($v === NULL)
					{
						$val_str .= 'NULL';
					}
					else
					{
						// Escape the data if it's not an integer
						if ($is_int[$i] == FALSE)
						{
							$val_str .= $this->db->escape($v);
						}
						else
						{
							$val_str .= $v;
						}
					}

					// Append a comma
					$val_str .= ', ';
					$i++;
				}

				// Remove the comma at the end of the string
				$val_str = preg_replace( "/, $/" , "" , $val_str);

				// Build the INSERT string
				$output .= 'INSERT INTO '.$table.' ('.$field_str.') VALUES ('.$val_str.');'.$newline;
				if(strlen($output) >= $f_size * 1000)
				{
					 $this->_save_backup($output,$f_name.'_'.$f_num);
					 $output = '';$f_num++;
				}
			}
		}
		if($output != '')
		{
			$this->_save_backup($output,$f_name.'_'.$f_num);
		}
		echo_msg('<li>数据库备份完毕</li>','','yes');
	}
	
	function _save_backup($data,$fn)
	{
		$this->load->helper('file');
		if (@function_exists('gzencode'))
		{
			write_file($this->backup_path.$fn.'.gz',gzencode($data));
		}
		else if(@function_exists('gzcompress'))
		{
			$this->load->library('zip');
			$this->zip->add_data($fn.'.sql', $data);
			write_file($this->backup_path.$fn.'.zip',$this->zip->get_zip());
		}
		else
		{
			write_file($this->backup_path.$fn.'.sql',$data);
		}
		return TRUE;
	}
	
	function download_database($f_name)
	{
		if($f_name=='')
		{
			return '';
		}
		$this->load->helper("download");
		$data=file_get_contents($this->backup_path.$f_name);
		force_download($f_name,$data);
	}
	
	function delete_backup()
	{
		$f_list=$this->input->post("rd_id");
		if(empty($f_list))
		{
			echo_msg('<li>提交的数据有误</li>','','no');
		}
		foreach($f_list as $f_name)
		{
			@unlink($this->backup_path.$f_name);
		}
		echo_msg('<li>文件删除成功</li>','','yes');
	}
}
?>