<?php

use Melbahja\Seo\MetaTags;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//
include_once(__DIR__."/BaseTemplate.php");

class Template extends BaseTemplate{
	protected $_ci;
	protected $_baseurl;
	
	function __construct() {
		$this->_ci =&get_instance();
		// $this->metatags = $this->createMeta();
		$this->_baseurl = base_url();
	}

	public function createMeta(){
		$metatags = new MetaTags();
        $metatags->title('perush Agung Republik Indonesia')
            ->description('perush RI adalah')
            ->meta('keywords', 'perush RI')
            ->image($this->_baseurl."assets/img/logo-kejak.png");
        
        return $metatags;
    }

	function setSeoMetas($t="link", $arg=[]){
		// $cleanDesc = substr( htmlentities(arrget($arg, 'desc')) , 0, 160);
		$cleanDesc = substr( strip_tags(arrget($arg, 'desc')) , 0, 160);

		$this->metatags->title(arrget($arg, 'title'))
			->description($cleanDesc);
		$kw = arrget($arg, 'keywords');
		if($kw){
			$this->metatags->meta("keywords", $kw);
		}

		switch($t){
			case "berita":
			break;
			case "link":
			break;
			// home
			default:
		}

		return $this;
	}
	
	function display($template, $data=null){
		$data['_baseurl'] = $this->_baseurl;
		$data['_seometa'] = "meta";
		$data['_script'] = "";
		$data['cekhal'] = $template;

		$arr = $this->parseContent($template, $data);
		$data = array_merge($data, $arr);
		
		$this->_ci->load->view('template/template.php', $data);
		// pr($data);
	}

	function admin($template,$data=null) {
		$data['cekhal'] = $template;
		$data['_baseurl'] = base_url();
		$data['_script'] = "";
		// $data['_content']=$this->_ci->load->view(''.$template,$data,TRUE);
		$arr = $this->parseContent($template, $data);
		$data = array_merge($data, $arr);
		
		$this->_ci->load->view('template/admin.php',$data);
	}

}