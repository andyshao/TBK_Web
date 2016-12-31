<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * goods search page
 * @author		soke5
 * @copyright	Copyright (c) 2010 - 2015 搜客淘宝客.
 * @link		http://bbs.soke5.com
 *
 */
class Dapei extends Controller
{
	function Dapei()
	{
		parent::Controller();
	}
	
	function index()
	{
		$tagid = (int)$this->uri->segment(2,0);
		$this->load->config('pid_config');
		
		$data = array(
			'site_title' => '穿衣搭配-'.$this->config->item('sys_site_title'),
			'tagid' => $tagid,
			'tag' => array(0=>'全部',3001=>'日韩',3002=>'欧美',3003=>'复古',3004=>'学院',3005=>'休闲',3006=>'潮品',3007=>'清新',3008=>'甜美',3009=>'BF风',3010=>'轻熟',3023=>'明星')
		); 
		$resp = $this->_get_url_content('http://ai.taobao.com/style/list.htm',array('pid'=>$this->config->item('ali_pid'),'page'=>'1','pageSize'=>20,'channelId'=>4,'unid'=>199,'tagId'=>$tagid));
		if($resp)
		{
			$resp = json_decode($resp);
			$resp = $this->_get_object_vars_final($resp);
			if(isset($resp['result']['results'])) $data['query'] = $resp['result']['results'];
			if(isset($resp['result']['paged'])) $data['paged'] = $resp['result']['paged'];
		}
		unset($resp);
		$this->load->view(TPL_FOLDER.'dapei',$data);
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