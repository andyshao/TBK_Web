<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * goods detail
 * @author		Jade Xia
 * @copyright	Copyright (c) 2010 - 2011 天夏网络.
 * @link		http://www.tianxianet.com
 *
 */
class Ajax extends Controller
{
	function Ajax()
	{
		parent::Controller();
	}
	
	function get_product()
	{
		$get = array();
		if(isset($_SERVER['QUERY_STRING'])) parse_str($_SERVER['QUERY_STRING'],$get);
		$data = array(); 
		
		$this->load->library('TopClient','','top');
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
			}
			if($this->config->item('default_is_tmall') == 1)
			{
				$this->req->setIsTmall('true');
			}
			if($this->config->item('default_sort'))
			{
				$this->req->setSort($this->config->item('default_sort'));
			}
		}
				
		$page_size = 30;$page_no = 1;
		$this->req->setPageSize($page_size);
		if(isset($get['page']) && $get['page'] > 0) $page_no = $get['page'];
		if($page_no > 100) $page_no = 100;
		$this->req->setPageNo($page_no);
		
		$resp = $this->top->execute($this->req);
		if($resp && isset($resp['results']['n_tbk_item']))
		{
			if(isset($resp['results']['n_tbk_item']['num_iid']))
			$data['query'] = array($resp['results']['n_tbk_item']);
			else $data['query'] = $resp['results']['n_tbk_item'];
		}
		unset($get,$resp);
		if(isset($data['query']) && $data['query']) $this->load->view(TPL_FOLDER.'get_product',$data);
		else echo 'nodata';
	}
}
?>