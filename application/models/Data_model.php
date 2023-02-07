<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Data_model extends CI_Model {

	public function get_content_home($jenis, $limit)
	{
		$query = 'select 
		c.*,
		msk.cat_name
		from kms_content c 
		left outer join kms_ms_kategori msk on msk.id_cat = c.id_cat 
		where c.id_cat = ? and status = 1
		group by c.id
		order by c.submit_date desc
		limit ? ';
		$output = $this->db->query($query, array($jenis, $limit));

		if($output){
			return $output->result_array();
		}else{
			return [];
		}
		// return $output;
	}

	public function get_video()
	{
		$this->db->limit(1);
		$this->db->where('status',1);
		$this->db->order_by('id','desc');
		$output = $this->db->get('kms_video');
		// $output = $this->db->query($query, array($jenis, $limit));

		if($output){
			return $output->row_array();
		}else{
			return [];
		}
		// return $output;
	}

	public function get_kegiatan($limit = 10)
	{
		$query = 'select 
		*
		from kms_kegiatan
		where status = 1
		order by datekegiatan desc
		limit 3';
		$output = $this->db->query($query);
		return $output;
	}

	public function get_infografis($limit)
	{
		$query = 'select 
		*
		from kms_infografis
		order by created_at desc
		limit ? ';
		$output = $this->db->query($query, array($limit));
		return $output;
	}

	public function getContentPage($number,$offset,$jenis){
		$this->db->select('c.*,
		kms_user.nama,
		msk.cat_name');
		$this->db->join('kms_user', 'kms_user.id_user = c.id_user');
		$this->db->join('kms_ms_kategori msk', 'msk.id_cat = c.id_cat','left outer');
		$this->db->order_by('submit_date','desc');
		$this->db->where('c.id_cat',$jenis);
		$this->db->where('status',1);
		if (($number == '') && ($offset == '')) {
		return $this->db->get('kms_content c')->num_rows();
		} else {
		return $this->db->get('kms_content c',$number,$offset)->result_array();
		}		
	}
	
	public function getContentPage_pencarian($number,$offset,$kata_kunci){
		$this->db->select('c.*,
		kms_user.nama,
		msk.cat_name');
		$this->db->join('kms_user', 'kms_user.id_user = c.id_user');
		$this->db->join('kms_ms_kategori msk', 'msk.id_cat = c.id_cat','left outer');
		$this->db->order_by('submit_date','desc');
		// $this->db->where('c.id_cat',$jenis);
		$this->db->like('judul', $kata_kunci, 'both');
		$this->db->where('status',1);
		if (($number == '') && ($offset == '')) {
		return $this->db->get('kms_content c')->num_rows();
		} else {
		return $this->db->get('kms_content c',$number,$offset)->result_array();
		}		
	}

	public function getVideoPage($number,$offset){
		$this->db->order_by('id','desc');
		$this->db->where('status',1);
		if (($number == '') && ($offset == '')) {
		return $this->db->get('kms_video c')->num_rows();
		} else {
		return $this->db->get('kms_video c',$number,$offset)->result_array();
		}		
	}

	public function getKegiatanPage($number,$offset,$jenis){
		$this->db->select('c.*,
		kms_user.nama');
		$this->db->join('kms_user', 'kms_user.id_user = c.created_by');
		$this->db->order_by('datekegiatan','desc');
		$this->db->where('status',1);
		if (($number == '') && ($offset == '')) {
		return $this->db->get('kms_kegiatan c')->num_rows();
		} else {
		return $this->db->get('kms_kegiatan c',$number,$offset)->result_array();
		}		
	}

	public function getBuronan($number,$offset){
		$this->db->order_by('nama','asc');
		if (($number == '') && ($offset == '')) {
		return $this->db->get('kms_buronan c')->num_rows();
		} else {
		return $this->db->get('kms_buronan c',$number,$offset)->result_array();
		}		
	}

	public function getCountPage($jenis){
		$query = "select count(*) as jml from kms_content kc 
		where id_cat = $jenis and status = 1 ";
		return $this->db->query($query)->row_array();
	}

	public function getCountPage_pencarian($kata_kunci){
		$query = "select count(*) as jml from kms_content kc 
		where judul like '%$kata_kunci%' and status = 1 ";
		return $this->db->query($query)->row_array();
	}

	public function getCountVideo(){
		$query = "select count(*) as jml from kms_video kc 
		where status = 1 ";
		return $this->db->query($query)->row_array();
	}

	public function getCountBuronan(){
		$query = "select count(*) as jml from kms_buronan kc ";
		return $this->db->query($query)->row_array();
	}

}