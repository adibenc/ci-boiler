<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class BaseModel extends CI_model {
	protected $posts;
	protected $gets;
	protected $timestamp = false;
	protected $profiler = [
		"timediff" => 0,
		"endtime" => 0,
		"starttime" => 0,
	];
	public $table,
		$withSession = true;

	function __construct(){
		parent:: __construct();
	}

	public static function getRandomStr($n=5){
		return substr(bin2hex(random_bytes($n*2)), 0, $n);
	}

	public static function slugs($text, $limit = 64){
		// Strip html tags
		$text = substr($text, 0, $limit);
		$text = strip_tags($text);
		$text = preg_replace('~[^\pL\d]+~u', '-', $text);
		setlocale(LC_ALL, 'en_US.utf8');
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		$text = preg_replace('~[^-\w]+~', '', $text);
		$text = trim($text, '-');
		$text = preg_replace('~-+~', '-', $text);
		$text = strtolower($text);
		
		if (empty($text)) {
			return '';
		}
		
		return $text;
	}

	public function checkError(){
		$err = $this->db->error();
		// preout($err);
		if($err['code'] !== "" && $err['code'] != 0){
			preout($err['code']." ".$err['message']);
			throw new \Exception($err['code']." ".$err['message']);
		}
	}

	public function posts(){
		return $this->input->post();
	}

	public function gets(){
		return $this->input->get();
	}

	public function lastInsertId(){
		return $this->db->insert_id();
	}

	public function getLastCreated(){
		return $this->singleData([
			"id" => $this->lastInsertId()
		]);
	}

	public function builder($wheres = []){
		return $this->db->select('*')->from($this->table)
			->where($wheres);
	}

	public function single($tbl, $wheres){
		return $this->db->select('*')->from($tbl)
			->where($wheres)
			->get()->row();
	}

	public function singleData($wheres){
		return $this->db->select('*')->from($this->table)
			->where($wheres)
			->get()->row();
	}

	public function getMulti($wheres){
		return $this->db->select('*')->from($this->table)
			->where($wheres)
			->get()->result();
	}

	public function create($data){
		if($this->timestamp){
			// $data['created_at'] = $this->now();
		}
		$this->db->insert($this->table, $data);
		return $data;
	}

	// p array
	public function createMany($datas){
		if($this->timestamp){
			// $data['created_at'] = $this->now();
		}
		$this->db->insert_batch($this->table, $datas);
		$this->checkError();
		
		return sizeof($datas);
	}

	public function createIfNotExist($data, $bycol, $val){
		$row = $this->singleData([$bycol => $val]);
		if($row){
			$data = null;
		}else{
			$this->db->insert($this->table, $data);
			$this->checkError();
		}
		return $data;
	}

	public function update($data, $where){
		$this->db
			->where($where)
			->update($this->table, $data);
		$this->checkError();

		return $data;
	}

	public function delete($where){
		$data = $this->db
			->where($where)
			->delete($this->table);
		return $data;
	}

	public function withSession($val = true){
		$this->withSession = $val ? true : false;

		return $this;
	}

	/**
	 * 
	 * ci transact wrapper
	 * 
	 * usage
	 * 
	 * 	$this->transact("start");
	 * 	$this->transact("commit");
	 * 	$this->transact("rollback");
	 * 
	 */
	public function transact($t = "start"){
		switch($t){
			case "start":
				$this->db->trans_begin();
			break;
			case "finish":
			case "commit":
				$this->db->trans_commit();
			break;
			case "rollback":
				$this->db->trans_rollback();
			break;
		}

		return $this;
	}

	/**
	 * profiler
	 * 
	 * usage
	 * 
	 * 	$this->profiler("start");
	 * 	$this->profiler("end");
	 * 	$this->profiler("set-diff");
	 * 	$this->profiler("reset");
	 * 
	 */
	public function profiler($t = "start"){
		switch($t){
			case "start":
				$this->profiler['start'] = microtime(true);
			break;
			case "end":
			case "finish":
			case "commit":
				$this->profiler['end'] = microtime(true);
			break;
			case "set-diff":
				$this->profiler["timediff"] =
					$this->profiler['end'] - $this->profiler['start'];
			break;
			case "end-with-diff":
				$this->profiler("end")
					->profiler("set-diff");
			break;
			case "reset":
				$this->profiler = [
					"timediff" => 0,
					"end" => 0,
					"start" => 0,
				];
			break;
		}

		return $this;
	}

	/**
	 * @return string
	 */
	public function now(){
		$now = $this->db->select('now() as now')->get()->row()->now;
		return substr($now, 0, 19);
	}

	/**
	 * @return string
	 */
	public function nowModified($sec = 1){
		$sec = (int) $sec;
		$nowMod = $this->db
		->select("(now() + interval '$sec second') as nowplus")
		->get()->row()->nowplus;

		return substr($nowMod, 0, 19);
	}

	/**
	 * @return string
	 */
	public function lastYear(){
		// 60*60*24*365
		// 31536000
		$year = 31536000;

		return $this->nowModified(-$year);
	}
 
	public function getProfiler(){
		return $this->profiler;
	}

	public function setProfiler($profiler){
		$this->profiler = $profiler;

		return $this;
	}
}