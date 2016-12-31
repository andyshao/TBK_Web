<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Common extends Controller
{
	function Common()
	{
		parent::Controller();
	}
	
	function get_validate_code(){
		$data = array(
			'mCheckCodeNum'     =>  4, //验证码位数
			'mCheckImageWidth'  =>  75, //图片宽度
			'mCheckImageHeight' =>  20  //图片高度
		);
        $this->load->library('validate_code',$data);
		$this->validate_code->OutCheckImage();
   	}
}
?>