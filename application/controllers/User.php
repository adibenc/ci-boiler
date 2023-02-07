<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(__DIR__.'/BaseController.php');

class User extends BaseController {
	 
	function __construct()
	{
		parent:: __construct();
		$this->load->library('template');
		date_default_timezone_set('Asia/Jakarta');
		$this->load->library('access');
	}	
}