<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author		Jade Xia
 * @copyright	Copyright (c) 2010 - 2011 天夏网络.
 * @link		http://www.tianxianet.com
 */
class Home extends Controller
{
	function Home()
	{
		parent::Controller();
		$this->load->library('TopClient','','top');
	}
	
	function index()
	{
		if ($this->config->item('sys_cache_time') > 0) $this->output->cache($this->config->item('sys_cache_time'));
		$data = array(
			'site_title' => $this->config->item('sys_site_title')
		);
		
		$this->load->library('top/TbkItemGetRequest','','req');
		$this->req->setFields('title,pict_url,reserve_price,zk_final_price,num_iid,user_type');
		
		$this->req->setPlatform(2);//链接形式 默认为1 PC
		
		if($this->config->item('default_q'))
		{
			$this->req->setQ($this->config->item('default_q'));
		}
		if($this->config->item('default_is_tmall') == 1)
		{
			$this->req->setIsTmall('true');
		}
		if($this->config->item('default_sort'))
		{
			$this->req->setSort($this->config->item('default_sort'));
		}
				
		$page_size = 30;
		$this->req->setPageSize($page_size);
		$page_no = 1;
		$this->req->setPageNo($page_no);
		
		$resp = $this->top->execute($this->req);
		if($resp && isset($resp['results']['n_tbk_item']))
		{
			if(isset($resp['results']['n_tbk_item']['num_iid']))
			$data['query'] = array($resp['results']['n_tbk_item']);
			else $data['query'] = $resp['results']['n_tbk_item'];
		}
		unset($resp);
		$this->load->view(TPL_FOLDER.'home',$data);
	}
}
?>