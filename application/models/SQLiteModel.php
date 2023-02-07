<?php

class SQLiteModel extends CI_Model{
    protected $dblite;
    
    function __construct(){
        $this->setDefaultDblite();
    }

    function test(){
        $dbl = $this->getDblite();
        $res = $dbl->select("*")
            ->from("Employee")->get();

        $er = $dbl->error();
        preout($er);
        $res->result();
        preout($res);
    }

	public function getDblite(){
		return $this->dblite;
	}

	public function setDblite($dblite){
		$this->dblite = $dblite;

		return $this;
	}
    
    public function setDefaultDblite(){
		$dbl = $this->load->database("sqlite", true);
        $this->setDblite($dbl);

		return $this;
	}

    public function resetConn(){
		$dbl = $this->load->database("default", true);

        return $this;
    }

    public function now(){
        $row = $this->getDblite()->select("strftime('%Y-%m-%d %H-%M-%S','now') as now")
            ->get()->row();
        return $row->now;
    }
}