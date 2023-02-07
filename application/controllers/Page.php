<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(__DIR__.'/BaseController.php');

class Page extends BaseController {
	 
	function __construct() {
		parent:: __construct();
		
		$this->load->library('template');
		$this->load->library('access');
	}

	function index() {
		$this->template->display("home");
	}
}