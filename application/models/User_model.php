<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_model
{
	public $table			= 'kms_user';

	function __construct()
	{
		parent:: __construct();
	}
	
	function get_login_info($username)
	{
		$qry = "
			select * from kms_user
			where email =  ?
			";
		$query = $this->db->query($qry, array($username));
		return ($query->num_rows() > 0) ? $query->row() : FALSE;
	}
	
	function get_password($id)
	{
		$this->db->where('email',$id);
		
		$this->db->limit(1);
		$query = $this->db->get($this->table);
		return ($query->num_rows() > 0) ? $query->row() : FALSE;
	}
	
	function change_password($id, $pass)
	{
		$this->db->where('email',$id);
		return $this->db->update($this->table, array('password' => $pass)); 
	}

}