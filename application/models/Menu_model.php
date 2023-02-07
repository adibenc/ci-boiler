<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model {
	public $table			= 'kms_menu';

	function get_menu($position)
	{
		$this->db->join('kms_page','kms_page.id = kms_menu.id_page','left');
		$this->db->where('parent',$position);
		// $this->db->limit(1);
		$query = $this->db->get($this->table);
		return $query->result_array();
	}

}