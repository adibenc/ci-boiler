<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Access
{
	public $user;
	/**
	* Constructor
	*/
	function __construct()
	{
		$this->CI =&get_instance();
		$auth = $this->CI->config->item('auth');
		
		$this->CI->load->helper('cookie');
		$this->CI->load->model('user_model');
		
		$this->user_model =& $this->CI->user_model;
	}
	
	/**
	* Cek login user
	*/
	function login($username, $password){
		$result = $this->user_model->get_login_info($username);
		
		if(!$result){
			return false;
		}

		$password = encrypt_url($password);
		if(!($password === $result->password)) {
			return false;
		}

		if($result->foto != null){
			$url_foto = base_url('uploads/foto/').$result->foto;
		} else {
			$url_foto = base_url('assets/img/dummy-img.png');
		}

		$this->CI->session->set_userdata('id', $result->id_user);
		$this->CI->session->set_userdata('email', $result->email);
		$this->CI->session->set_userdata('akses', $result->access);
		$this->CI->session->set_userdata('foto', $url_foto);
		$this->CI->session->set_userdata('nama', $result->nama);

		return TRUE;
	}
	
	/**
	* isLogin?
	*/
	function is_login()
	{
		$d = $this->CI->session->userdata();
		// preout($d);
		$d = $this->CI->session->userdata('id');
		return (!empty($d) ? TRUE : FALSE);
		//return true;
	}
	
	/**
	* Logout
	*/
	function logout()
	{
		$this->CI->session->unset_userdata('id');
		$this->CI->session->unset_userdata('email');
		$this->CI->session->unset_userdata('foto');
		$this->CI->session->unset_userdata('nama');
	}
	
	// Access::abort();
	static function abort(){
		header('HTTP/1.0 403 Forbidden');
	}
}