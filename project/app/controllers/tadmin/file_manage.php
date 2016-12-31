<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class File_manage extends Controller
{
	function File_manage()
	{
		parent::Controller();
		$this->load->model("tadmin/com_model");
		$this->com_model->check_is_login();
		$this->load->library('form_validation');
		$this->load->library('file_lib');
	}
	function index()
	{
		parse_str($_SERVER['QUERY_STRING'],$get);
		if(isset($get['f'])&&$get['f']!='')
		{
			if(strrpos($get['f'],UP_FILES_ROOT)==0)
			{
				$current_path=$get['f'];
			}
			else
			{
				echo_msg('<li>非法操作，您提交的路径有误</li>');
			}
		}
		else
		{
			$current_path=UP_FILES_ROOT;
		}
		if($current_path!=UP_FILES_ROOT)
		{
			$pre_path=rtrim($current_path,"/");
			$pre_path=strrev($pre_path);
			$pre_path=strstr($pre_path,"/");
			$pre_path=strrev($pre_path);
		}
		else
		{
			$pre_path=FALSE;
		}
		$this->load->helper("number");
		$file_list=$this->file_lib->get_dir_file_info($current_path);
		$all_dir=$this->file_lib->get_all_dir(UP_FILES_ROOT);
		$total_size=byte_format(getBytes(UP_FILES_ROOT));
		$data=array(
			'file_list' => $file_list,
			'all_dir' => $all_dir,
			'pre_path' => $pre_path,
			'current_path' => $current_path,
			'total_size' => $total_size
		);
		$this->load->view(TPL_FOLDER."file_manage",$data);
	}
	
	function ajax_get_file()
	{
		$this->load->helper("number");
		$folder_path=$this->input->post("folder_path");
		if($folder_path)
		{
			if(strpos($folder_path,UP_FILES_ROOT)==0)
			{
				$current_path=$folder_path;
			}
			else
			{
				diem("非法路径：".$folder_path);
			}
		}
		else
		{
			$current_path=UP_FILES_ROOT;
		}
		if($current_path!=UP_FILES_ROOT)
		{
			$pre_path=rtrim($current_path,"/");
			$pre_path=strrev($pre_path);
			$pre_path=strstr($pre_path,"/");
			$pre_path=strrev($pre_path);
		}
		else
		{
			$pre_path=FALSE;
		}
		$file_list=$this->file_lib->get_dir_file_info($current_path);
		$data=array(
			'file_list' => $file_list,
			'pre_path' => $pre_path,
			'current_path' => $current_path
		);
		echo $this->load->view(TPL_FOLDER."ajax_get_file",$data,true);
	}
	
	function create_folder()
	{
		$this->form_validation->set_rules("folder_path","上层文件夹路径","trim|required");
		$this->form_validation->set_rules("folder_name","文件夹名","trim|required");
		if($this->form_validation->run()==FALSE)
		{
			$tx_msg=validation_errors();
			echo_msg($tx_msg);
		}
		$folder_path=$this->input->post("folder_path").$this->input->post("folder_name");
		if($this->file_lib->createDir($folder_path))
		{
			$tx_msg="<li>文件夹创建成功.</li>";
			echo_msg($tx_msg,'','yes');
		}
		else
		{
			$tx_msg="<li>文件夹创建失败.</li>";
			echo_msg($tx_msg);
		}
	}
	
	function delete_file()
	{
		$rd_id=$this->input->post("rd_id");
		$sys_folder=array(UP_FILES_ROOT.'files/',UP_FILES_ROOT.'images/',UP_FILES_ROOT.'pack/',UP_FILES_ROOT.'unpack/');
		$flag=FALSE;
		if(!is_array($rd_id))
		{
			echo_msg('<li>提交的数据有误，文件删除失败。</li>');
		}
		foreach($rd_id as $value)
		{
			if(!in_array($value,$sys_folder))
			{
				if(is_dir($value))
				{
					$this->file_lib->unlinkDir($value);
				}
				else
				{
					$this->file_lib->unlinkFile($value);
				}
			}
			else
			{
				$flag=TRUE;
			}
		}
		$tx_msg=$flag?"<li>文件/文件夹删除成功，部分系统文件夹不能删除。</li>":"<li>文件/文件夹删除成功</li>";
		echo_msg($tx_msg,'','yes');
	}
	
	function copy_to()
	{
		$rd_id=$this->input->post("rd_id");
		if(!is_array($rd_id))
		{
			echo_msg('<li>提交的数据有误，该操作终止。</li>');
		}
		$this->form_validation->set_rules("to_dir","复制到的文件夹","trim|required");
		if($this->form_validation->run()==FALSE)
		{
			$tx_msg=validation_errors();
			echo_msg($tx_msg);
		}
		$to_dir=$this->input->post("to_dir");
		foreach($rd_id as $value)
		{
			if(is_dir($value)&&$value!=$to_dir)
			{
				if($this->input->post("is_over_write"))
				{
					$this->file_lib->copyDir($value,$to_dir,TRUE);
				}
				else
				{
					$this->file_lib->copyDir($value,$to_dir);
				}
			}
			else
			{
				$file_arr=explode("/",$value);
				$file_name=end($file_arr);
				if($this->input->post("is_over_write"))
				{
					$this->file_lib->copyFile($value,$to_dir.$file_name,TRUE);
				}
				else
				{
					$this->file_lib->copyFile($value,$to_dir.$file_name);
				}
			}
		}
		echo_msg('<li>文件复制成功</li>','','yes');
	}
	
	function move_to()
	{
		$rd_id=$this->input->post("rd_id");
		if(!is_array($rd_id))
		{
			echo_msg('<li>提交的数据有误，该操作终止。</li>');
		}
		$this->form_validation->set_rules("to_dir","剪切到的文件夹","trim|required");
		if($this->form_validation->run()==FALSE)
		{
			$tx_msg=validation_errors();
			echo_msg($tx_msg);
		}
		$to_dir=$this->input->post("to_dir");
		foreach($rd_id as $value)
		{
			if(is_dir($value)&&$value!=$to_dir)
			{
				if($this->input->post("is_over_write"))
				{
					$this->file_lib->moveDir($value,$to_dir,TRUE);
				}
				else
				{
					$this->file_lib->moveDir($value,$to_dir);
				}
			}
			else
			{
				$file_arr=explode("/",$value);
				$file_name=end($file_arr);
				if($this->input->post("is_over_write"))
				{
					$this->file_lib->moveFile($value,$to_dir.$file_name,TRUE);
				}
				else
				{
					$this->file_lib->moveFile($value,$to_dir.$file_name);
				}
			}
		}
		echo_msg('<li>文件剪切成功</li>','','yes');
	}
}
?>