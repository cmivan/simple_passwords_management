<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*loader��չ����*/

class MY_Loader extends CI_Loader
{
	//��������û���̨view
	function view_wuser($view, $vars = array(), $return = FALSE)
	{
		$CI = &get_instance();
		return $this->view($CI->config->item("w_url").$view, $vars, $return);
	}	 
}
/* End of file Loader.php */
/* Location: ./system/core/Loader.php */
