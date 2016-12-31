<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ajax extends Controller
{
	function Ajax()
	{
		parent::Controller();
		$this->load->model("tadmin/com_model");
	}
}
?>