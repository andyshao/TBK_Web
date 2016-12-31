<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * goods detail
 * @author		soke5
 * @copyright	Copyright (c) 2010 - 2015 搜客淘宝客.
 * @link		http://bbs.soke5.com
 *
 */
class Ajax extends Controller
{
	function Ajax()
	{
		parent::Controller();
	}
	
	function get_related_product()
	{
		$num_iid = $this->uri->segment(3,0);
		$data = array();
		$this->load->library('TopClient','','top');
		$this->load->library('top/TbkItemRecommendGetRequest','','req');
		$this->req->setFields('num_iid,title,pict_url,reserve_price,zk_final_price,user_type');
		$this->req->setNumIid($num_iid);
		$this->req->setRelateType(1);
		$this->req->setCount('12');
		$resp = $this->top->execute($this->req);
		if($resp && isset($resp['results']['n_tbk_item']))
		{
			if(isset($resp['results']['n_tbk_item']['num_iid']))
			$data['query'] = array($resp['results']['n_tbk_item']);
			else $data['query'] = $resp['results']['n_tbk_item'];
		}
		unset($resp);
		$this->load->view(TPL_FOLDER.'get_related_product',$data);
	}
	
	function get_volume()
	{
		$num_iid = $this->uri->segment(3,0);
		$c = get_content('http://s.etao.com/detail/'.$num_iid.'.html');
		$volume = $user_id = 0;
		if($c)
		{
			@preg_match('/<\/span>(\d+)(.*?)<span class=\'list-key list-split\'>/i', $c, $a);
			if(isset($a[1]) && $a[1] > 0) $volume = $a[1];
			
			@preg_match('/sellerId=(\d+)/i', $c, $a);
			if(isset($a[1]) && $a[1] > 0) $user_id = $a[1];
			else
			{
				@preg_match('/userNumId=(\d+)/i', $c, $a);
				if(isset($a[1]) && $a[1] > 0) $user_id = $a[1];
			}
		}
		echo '{"volume":"'.$volume.'","user_id":"'.$user_id.'"}';
	}
	
	function del_apicache()
	{
		$this->load->database();
		$query = $this->common_model->get_record('SELECT create_date FROM '.$this->db->dbprefix.'del_time WHERE id = 1');
		if($query)
		{
			//1天清理一次
			if(($query->create_date + 86400) < time())
			{
				$this->load->helper('file');
				delete_files($this->config->item('apicache_path'),TRUE);
				$this->db->simple_query('UPDATE '.$this->db->dbprefix.'del_time SET create_date = '.time().' WHERE id = 1');
			}
		}
	}
	
	function get_water()
	{
		$get = array();
		if(isset($_SERVER['QUERY_STRING'])) parse_str($_SERVER['QUERY_STRING'],$get);
		$page = 1;
		if(isset($get['page'])) $page = (int)$get['page'];
		$tagid = (int)$this->uri->segment(3,0);
		$this->load->config('pid_config');
		
		$data = array();
		$resp = $this->_get_url_content('http://ai.taobao.com/style/list.htm',array('pid'=>$this->config->item('ali_pid'),'page'=>$page,'pageSize'=>20,'channelId'=>4,'unid'=>199,'tagId'=>$tagid));
		if($resp)
		{
			$resp = json_decode($resp);
			$resp = $this->_get_object_vars_final($resp);
			if(isset($resp['result']['results'])) $data['query'] = $resp['result']['results'];
		}
		unset($resp);
		$this->load->view(TPL_FOLDER.'get_water',$data);
	}
	
	function _get_url_content($url,$postFields)
	{                    
		if(function_exists('curl_init'))
		{
			$header = array();
			$header[]= 'User-Agent:Mozilla/5.0 (Windows NT 5.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36';
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_FAILONERROR, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);  
			curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_REFERER,'http://ai.taobao.com/style/index.htm');
			@curl_setopt($ch,CURLOPT_HTTPHEADER,$header); 
			
			if (is_array($postFields) && 0 < count($postFields))
			{
				$postBodyString = "";
				foreach ($postFields as $k => $v)
				{
					$postBodyString .= "$k=" . urlencode($v) . "&";
				}
				unset($k, $v);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, substr($postBodyString,0,-1));
			}
			$pageContent = @curl_exec($ch);
			curl_close($ch);
			return $pageContent;
		}
		return false;
	}
	
	function _get_object_vars_final($obj)
	{
		if (is_object($obj)) {
			$obj = get_object_vars($obj);
		}
		if (is_array($obj)) {
			foreach ($obj as $key => $value) 
			{
				$obj[$key] = $this->_get_object_vars_final($value);
			}
		}
		return $obj;
	}
}
?>