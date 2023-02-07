<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(__DIR__.'/BaseController.php');

class Api extends BaseController {
	 
	function __construct()
	{
		parent:: __construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->library('access');
		$this->load->model('BaseModel', "basemodel");
		$this->load->model('ContentModel', "content");

		logs(presonRet([$_SERVER['HTTP_CLIENT_IP'], $_SESSION, $this->session->userdata(), uri_string()]));

		if(!$this->access->is_login()){
			Access::abort();
			exit;
			// redirect("page/denied");
		}
	}
}