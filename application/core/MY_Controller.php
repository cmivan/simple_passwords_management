<?php if (!defined('BASEPATH')) exit('No direct access allowed.');
 
 //公共配置
 class QT_Controller extends CI_Controller {
	
	public $data;
	public $logid = 0;
	
	function __construct(){
		parent::__construct();
		
		//评测应用程序
		//$this->output->enable_profiler(true);
		
		//初始化登录信息
		$this->data = $this->ini_login();
		
		/*初始化SEO设置*/
		$this->data['seo'] = $this->config->item("seo");
		
		//(全局)配置，文件路径
		$this->data["css_url"] = $this->config->item("css_url");
		$this->data["img_url"] = $this->config->item("img_url");
		$this->data["fla_url"] = $this->config->item("fla_url");
		$this->data["js_url"]  = $this->config->item("js_url");
		$this->data["jq_url"]  = $this->config->item("jq_url");
    }
	
	//初始化登录信息
	function ini_login()
	{
		$data = NULL;
		$power = $this->session->userdata("user_power");
		$this->logid = get_num( $power['logid'] );
		if( $this->logid )
		{
			$data["logid"]   = $this->logid;
		}
		return $data;
	}

 }
 
 //公共配置
 class HT_Controller extends QT_Controller {
	 
	 function __construct(){
		parent::__construct();

		//评测应用程序
		//$this->output->enable_profiler(true);
		
		//判断是否登录
		$power = $this->session->userdata("user_power");
		$this->logid = get_num( $power['logid'] );
		if( is_num($this->logid)==false )
		{
			redirect('/index');exit;
		}
    }
	
 }
 
 

/* End of file MY_Controller.php */
/* Location: ./application/libraries/MY_Controller.php */