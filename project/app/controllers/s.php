<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * goods search page
 * @author		soke5
 * @copyright	Copyright (c) 2010 - 2015 搜客淘宝客.
 * @link		http://bbs.soke5.com
 *
 */
class S extends Controller
{
	function S()
	{
		parent::Controller();
		$this->load->library('TopClient','','top');
	}
	
	function index()
	{
		$get = array();
		if(isset($_SERVER['QUERY_STRING'])) parse_str($_SERVER['QUERY_STRING'],$get);
		$data = array(
			'site_title' => $this->config->item('sys_site_title'),
			'total' => 0,
			'paginate' => '',
			'paginate_top' => '',
			'page_no' => 1,
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
		$this->req->setPlatform(1);//链接形式 默认为1 PC
		
		if(! (isset($get['q']) && ! empty($get['q'])) && ! (isset($get['cid']) && ! empty($get['cid']))) 
		{
			if($this->config->item('default_q'))
			{
				$this->req->setQ($this->config->item('default_q'));
				//$get['q'] = $this->config->item('default_q');
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
				
		$page_size = 100;
		$this->req->setPageSize($page_size);
		
		$page_no = (int)$this->uri->segment(2, 0);
		if($page_no == 0) $page_no = 1;
		if($page_no > 100) $page_no = 100;
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
			$data['page_no'] = $page_no;
			$data['page_total'] = $page_total;
			$data['paginate'] = $this->_get_page_nav($page_total,$page_no);
			$data['paginate_top'] = $this->_get_top_nav($page_total,$page_no);
		}
		
		if(isset($get['q']) && $get['q'])
		{
			$data['site_title'] = $get['q'].'-'.$this->config->item('sys_site_title');
		}
		$data['get'] = $get;
		unset($get);
		$this->load->view(TPL_FOLDER.'s',$data);
	}
	
	function _get_page_nav($t,$c)
	{
		$str = '';
		if($t > 1)
		{
			if(isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING']) $q_str = '?'.$_SERVER['QUERY_STRING'];
			else $q_str = ''; 
			if(($s = $c - 4) <= 0) $s = 1;
			if(($e = $c + 4) > $t) $e = $t;
			if($c > 1) $str .= '<a class="pg-prev" href="'.my_site_url(CTL_FOLDER.'s/'.($c-1)).$q_str.'">上一页</a> ';
			else $str .= '<span class="pg-prev">上一页</span> ';
			
			for($i = $s; $i <= $e ; $i++)
			{
				if($i == $c) $str .= ' <span>'.$i.'</span> ';
				else $str .= '<a href="'.my_site_url(CTL_FOLDER.'s/'.$i).$q_str.'">'.$i.'</a> ';
			}
			if($c < $t) $str .= '<a class="pg-next" href="'.my_site_url(CTL_FOLDER.'s/'.($c+1)).$q_str.'">下一页</a> ';
			else $str .= '<span class="pg-next">下一页</span> ';
		}
		return $str;
	}
	
	function _get_top_nav($t,$c)
	{
		$str = '';
		if($t > 1)
		{
			if(isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING']) $q_str = '?'.$_SERVER['QUERY_STRING'];
			else $q_str = ''; 
			if($c > 1) $str .= '<a class="prev" title="上一页" href="'.my_site_url(CTL_FOLDER.'s/'.($c-1)).$q_str.'">&nbsp;</a>';
			else $str .= '<a title="上一页" class="prev-gray">&nbsp;</a>'; 
			if($c < $t) $str .= '<a class="next" title="下一页" href="'.my_site_url(CTL_FOLDER.'s/'.($c+1)).$q_str.'">&nbsp;</a>';
			else $str .= '<a title="下一页" class="next-gray">&nbsp;</a>'; 
		}
		return $str;
	}
}
?>