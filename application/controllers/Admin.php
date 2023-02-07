<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(__DIR__.'/BaseController.php');

class Admin extends BaseController {
	 
	function __construct(){
		parent:: __construct();
		$this->load->library('template');
		date_default_timezone_set('Asia/Jakarta');
		$this->load->library('access');
		// $this->load->library('MY_Composer');
		$this->config->load('custom');

		logs(presonRet([$_SERVER['HTTP_CLIENT_IP'], $_SESSION, $this->session->userdata(), uri_string()]));

		if(!$this->access->is_login()){
			// show_404();
			Access::abort();
			echo "Access denied";
			exit;
		}
	}

	public function profil()
	{
		$id_user = $this->session->userdata('id');
		$this->template->admin('admin/profil', $data);
	}
	
	public function dashboard()
	{
		$this->template->admin('admin/dashboard', $data);
	}
}