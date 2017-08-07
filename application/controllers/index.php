<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends QT_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		//判断是否登录
		$power = $this->session->userdata("user_power");
		$this->logid = get_num( $power['logid'] );
		if( $this->logid )
		{
			$data["logid"]   = $this->logid;
			redirect('/accounts');exit;
		}
	}

	function index()
	{
		$this->load->view('users/login',$this->data);
	}
	

	function admin()
	{
		$this->load->view('users/adminlogin',$this->data);
	}
	
	function reg()
	{
		$this->load->view('users/reg',$this->data);
	}

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */