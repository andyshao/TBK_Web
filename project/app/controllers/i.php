<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * goods search page
 * @author		soke5
 * @copyright	Copyright (c) 2010 - 2015 搜客淘宝客.
 * @link		http://bbs.soke5.com
 *
 */
class I extends Controller
{
	function I()
	{
		parent::Controller();
	}
	
	function index()
	{
		$num_iid = $this->uri->segment(2,0);
		$this->load->config('rd_type');
		if($this->config->item('rd_type') == 1) redirect(site_url('clk/'.$num_iid));
		
		$data = array(
			'num_iid' => $num_iid
		);
		$this->load->library('TopClient','','top');
		$this->load->library('top/TbkItemInfoGetRequest','','req');
		$this->req->setFields('title,pict_url,small_images,reserve_price,zk_final_price,user_type,provcity');
		$this->req->setNumIids($num_iid);
		$resp = $this->top->execute($this->req);
		if($resp && isset($resp['results']['n_tbk_item'])) $data['query'] = $resp['results']['n_tbk_item'];
		else redirect(site_url('noitem'));
		unset($resp);
		$data['site_title'] = $data['query']['title'];
		$this->load->view(TPL_FOLDER.'i',$data);
	}
}
?>