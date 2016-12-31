<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Site_config extends Controller
{
	function Site_config()
	{
		parent::Controller();
		$this->load->model("tadmin/com_model");
		$this->com_model->check_is_login();
		$this->load->library('form_validation');
	}
	
	function index()
	{
		$this->load->config("site_config");
		$this->load->config("mobile_config");
		$this->load->config("top_config");
		$this->load->config("sort_type");
		$this->load->config("rd_type");
		$data=array(
			'edit_data' => $this->config->config
		);
		$this->load->view(TPL_FOLDER."site_config",$data);
	}
	
	function save_record()
	{
		$this->form_validation->set_rules("sys_site_name","网站名称","trim|required");
		$this->form_validation->set_rules("sys_site_title","网站标题","trim|required");
		$this->form_validation->set_rules("sys_site_keyword","META关键字","trim|required");
		$this->form_validation->set_rules("sys_site_description","META描述","trim|required");
		$this->form_validation->set_rules("sys_site_copyright","网站版权","trim|required");
		$this->form_validation->set_rules("sys_cache_time","网页缓存周期","integer");
		$this->form_validation->set_rules('cache_time','API数据缓存周期','integer');
		$this->form_validation->set_rules('sys_is_power','技术支持','integer');
		
		$tx_msg="";
		if($this->form_validation->run()==FALSE)
		{
			$tx_msg.=validation_errors();
		}
		$sys_site_logo=do_upload(array('up_path'=>UP_IMAGES_PATH,'form_name'=>"sys_site_logo",'suffix'=>UP_IMAGES_EXT));
		if(!$sys_site_logo['status'])
		{
			$tx_msg.=$sys_site_logo['upload_errors'];
		}
		
		$m_site_logo=do_upload(array('up_path'=>UP_IMAGES_PATH,'form_name'=>"m_site_logo",'suffix'=>UP_IMAGES_EXT));
		if(!$m_site_logo['status'])
		{
			$tx_msg.=$m_site_logo['upload_errors'];
		}

		if($tx_msg!="")
		{
			echo_msg($tx_msg);
		}
		
		$this->load->helper('file');
		$this->load->helper('string');
		$string=read_file(APPPATH.'config/site_config'.EXT);
		$config['sys_site_name'] = strip_quotes($this->input->post("sys_site_name"));
		$config['sys_site_title'] = strip_quotes($this->input->post("sys_site_title"));
		if($sys_site_logo['file_path'])
		{
			$config['sys_site_logo'] = $sys_site_logo['file_path'];
		}
		else
		{
			$config['sys_site_logo'] = strip_quotes($this->input->post("pic_path1"));
		}
		$config['sys_site_keyword'] = strip_quotes($this->input->post("sys_site_keyword"));
		$config['sys_site_description'] = strip_quotes($this->input->post("sys_site_description"));
		$config['sys_site_copyright'] = strip_quotes($this->input->post("sys_site_copyright"));
		$config['sys_cache_time'] = strip_quotes($this->input->post("sys_cache_time"));
		$config['sys_is_power'] = strip_quotes($this->input->post("sys_is_power"));
		$config['sys_tongji'] = $this->_safe_html($this->input->post("sys_tongji"));
		$reg ='/\$config\[\'(.+?)\'\][^\r\n]+/is';
		preg_match_all( $reg ,$string , $out  );
		if( $out[1] )
		{
			$old = $new = array();
			foreach( $out[1] as $k => $v )
			{
				if(isset($config[strtolower($v)]))
				{
					$old[] = $out[0][$k];
					$new[] = '$config[\''.strtolower($v).'\'] = \''.$config[strtolower($v)].'\';';
				}				
			}
			if( $new )
			{
				$string = str_replace( $old , $new , $string );
				write_file(APPPATH.'config/site_config'.EXT, $string);
			}
		}
		unset($config); unset($out);unset($old); unset($new);
		
		$string=read_file(APPPATH.'config/rd_type'.EXT);
		$config['rd_type'] = strip_quotes($this->input->post("rd_type"));
		$reg ='/\$config\[\'(.+?)\'\][^\r\n]+/is';
		preg_match_all( $reg ,$string , $out  );
		if( $out[1] )
		{
			$old = $new = array();
			foreach( $out[1] as $k => $v )
			{
				if(isset($config[strtolower($v)]))
				{
					$old[] = $out[0][$k];
					$new[] = '$config[\''.strtolower($v).'\'] = \''.$config[strtolower($v)].'\';';
				}				
			}
			if( $new )
			{
				$string = str_replace( $old , $new , $string );
				write_file(APPPATH.'config/rd_type'.EXT, $string);
			}
		}
		unset($config); unset($out);unset($old); unset($new);
		
		$string=read_file(APPPATH.'config/mobile_config'.EXT);
		if($m_site_logo['file_path'])
		{
			$config['m_site_logo'] = $m_site_logo['file_path'];
		}
		else
		{
			$config['m_site_logo'] = strip_quotes($this->input->post("pic_path2"));
		}
		$reg ='/\$config\[\'(.+?)\'\][^\r\n]+/is';
		preg_match_all( $reg ,$string , $out  );
		if( $out[1] )
		{
			$old = $new = array();
			foreach( $out[1] as $k => $v )
			{
				if(isset($config[strtolower($v)]))
				{
					$old[] = $out[0][$k];
					$new[] = '$config[\''.strtolower($v).'\'] = \''.$config[strtolower($v)].'\';';
				}				
			}
			if( $new )
			{
				$string = str_replace( $old , $new , $string );
				write_file(APPPATH.'config/mobile_config'.EXT, $string);
			}
		}
		unset($config); unset($out);unset($old); unset($new);
		
		$string=read_file(APPPATH.'config/top_config'.EXT);
		$config['cache_time'] = strip_quotes($this->input->post("cache_time"));
		$config['default_q'] = strip_quotes($this->input->post("default_q"));
		$config['default_sort'] = strip_quotes($this->input->post("default_sort"));
		$config['default_is_tmall'] = $this->input->post("default_is_tmall")?1:0;
		$reg ='/\$config\[\'(.+?)\'\][^\r\n]+/is';
		preg_match_all( $reg ,$string , $out  );
		if( $out[1] )
		{
			//$old = $new = array();
			foreach( $out[1] as $k => $v )
			{
				if(isset($config[strtolower($v)]))
				{
					$old[] = $out[0][$k];
					$new[] = '$config[\''.strtolower($v).'\'] = \''.$config[strtolower($v)].'\';';
				}			
			}
			if( $new)
			{
				$string = str_replace( $old , $new , $string );
			}
		}
		unset($config); unset($out);unset($old); unset($new);
		
		$reg = '/\$config\[\'appkey\'\][^\r\n]+;/is';
		preg_match_all( $reg ,$string , $out  );
		if(isset($out[0][0]))
		{
			$str = '$config[\'appkey\'] = array(';
			$str .= "'appkey'=>'".strip_quotes(trim($this->input->post('appkey')))."','secretkey'=>'".strip_quotes(trim($this->input->post('secretkey')))."'";
			$str .= ');';
			$string = str_replace($out[0][0],$str,$string);
		}
		write_file(APPPATH.'config/top_config'.EXT, $string);
		unset($out);
		
		get_taodianjin($this->input->post('taodianjin'));
		
		$tdj = @preg_replace(array("'([\r\n\t\s]+)'"),array(""), $this->input->post('taodianjin'));
		@preg_match('/pid:"(.*?)"/i', $tdj, $a);
		$pid = '';
		if(isset($a[1]) && $a[1]) $pid = $a[1];
		
		if($pid)
		{
			$string=read_file(APPPATH.'config/pid_config'.EXT);
			$config['ali_pid'] = $pid;
			$reg ='/\$config\[\'(.+?)\'\][^\r\n]+/is';
			preg_match_all( $reg ,$string , $out  );
			if( $out[1] )
			{
				$old = $new = array();
				foreach( $out[1] as $k => $v )
				{
					if(isset($config[strtolower($v)]))
					{
						$old[] = $out[0][$k];
						$new[] = '$config[\''.strtolower($v).'\'] = \''.$config[strtolower($v)].'\';';
					}				
				}
				if( $new )
				{
					$string = str_replace( $old , $new , $string );
					write_file(APPPATH.'config/pid_config'.EXT, $string);
				}
			}
			unset($config); unset($out);unset($old); unset($new);
		}
		
		echo_msg('<li>配置修改成功</li>','','yes');
	}
	
	function _safe_html($str)
	{
		$str = trim($str);
		if (strlen($str) <= 0)
		{
		  return $str;
		}
		$search = array ("/\r\n/","/\r/","/\n/","/\t/");
		$replace = array ('','','','');
		$str = @preg_replace($search, $replace, $str);
		$str = htmlentities($str, ENT_QUOTES);
		return $str;
	}
}
?>