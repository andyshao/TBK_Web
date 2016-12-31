<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * goods search page
 * @author		Jade Xia
 * @copyright	Copyright (c) 2010 - 2011 天夏网络.
 * @link		http://www.tianxianet.com
 *
 */
class Search extends Controller
{
		
	function Search()
	{
		parent::Controller();
		$this->load->library('TopClient','','top');
	}
	
	function index()
	{
		parse_str($_SERVER['QUERY_STRING'],$get);
		if( ! is_array($get)) $get = array();
		$data = array(
			'site_title' => '商品搜索-'.$this->config->item('sys_site_title'),
			'total' => 0,
			'page_total' => 0
		); 
		
		$this->load->library('top/TbkItemGetRequest','','req');
		$this->req->setFields('title,pict_url,reserve_price,zk_final_price,num_iid,user_type');
		
		if(isset($get['q']) && $get['q'])
		{
			$this->req->setQ($get['q']);
		}
		if(isset($get['cid']) && $get['cid'])
		{
			$this->req->setCat($get['cid']);
		}
		if(isset($get['is_tmall']) && $get['is_tmall'] == 1)
		{
			$this->req->setIsTmall('true');
		}
		if(isset($get['s_price']) && $get['s_price'] > 0)
		{
			$this->req->setStartPrice($get['s_price']);
		}
		if(isset($get['e_price']) && $get['e_price'] > 0)
		{
			$this->req->setEndPrice($get['e_price']);
		}
		if(isset($get['sorts']) && $get['sorts'])
		{
			$this->req->setSort($get['sorts']);
		}
		
		if(! (isset($get['q']) && ! empty($get['q'])) && ! (isset($get['cid']) && ! empty($get['cid']))) 
		{
			if($this->config->item('default_q'))
			{
				$this->req->setQ($this->config->item('default_q'));
				$get['q'] = $this->config->item('default_q');
			}
			if($this->config->item('default_is_tmall') == 1)
			{
				$this->req->setIsTmall('true');
				$get['is_tmall'] = 1;
			}
			if($this->config->item('default_sort'))
			{
				$this->req->setSort($this->config->item('default_sort'));
				$get['sorts'] = $this->config->item('default_sort');
			}
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
		if(isset($resp['total_results']) && $resp['total_results'] > 0)
		{
			$data['total'] = $resp['total_results'];
			$page_total = ceil($resp['total_results'] / $page_size);
			if($page_total > 100) $page_total = 100;
			$data['page_total'] = $page_total;
		}
		
		if(isset($get['q']) && $get['q'])
		{
			$data['site_title'] = $get['q'].'-'.$this->config->item('sys_site_title');
		}
		$data['get'] = $get;
		unset($get);
		$this->load->view(TPL_FOLDER.'search',$data);
	}
}
?>