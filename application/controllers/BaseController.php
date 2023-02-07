<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
// include_once(__DIR__.'/../../helpers/Constants.php');
// include_once(__DIR__.'/../../helpers/SecretConst.php');

class BaseController extends CI_Controller {
	protected $posts;
	protected $gets;
	static $CI;

	function __construct()
	{
		parent:: __construct();
		self::$CI = $this;
		// visitor counter
		$this->load->library("FrontDesk", 'frontdesk');
	}

	public function posts(){
		return $this->input->post();
	}

	public function gets(){
		return $this->input->get();
	}

	public function getRaw(){
		return file_get_contents("php://input");
	}

	public function index(){
		echo "index";
	}

	/**
	 * Response builder for datatable ssp
	 * 
	 */
	public function baseDatatableResponse($query, $functions = null){
		$this->load->library('datatables_ssp');
		$this->load->library('datatables_mdl');
		$baseSql = "select * from (".$query.") data";
		return Datatables_ssp::buildTable($this->datatables_mdl, $_REQUEST, $baseSql, $functions);
	}

	public function withScript($scriptfile = null){
		$scriptfile = $scriptfile === null ? "admin/scripts/dashboard" : $scriptfile;
		return $this->template->setScriptFile($scriptfile);
	}

	public function checkMaintenance($uri = ""){
		// $maintenance = true;
		// $maintenance = in_array($uri, SecretConst::ROUTE_MAINTENANCE);
		$maintenance = in_array($uri, []);

		if($maintenance){
			// to do - alternate mainenance view
			// echo Constants::MSG_MAINTENANCE;
			echo "maintenance";
			exit;
		}
	}

	static function stdJson($success = true, $msg = "", $data = []){
        return [
            "success" => $success,
            "message" => $msg,
            "data" => $data
        ];
    }

    static function json($code, $data = []){
        return self::$CI->output
            ->set_status_header($code)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($data));
	}
	
    static function success($msg = "", $data = []){
		return self::json(200, self::stdJson(true, $msg, $data));
    }

    static function fail($msg = "", $data = [], $code = 400){
		return self::json($code, self::stdJson(false, $msg, $data));
	}
	
	static function userFail($msg = "", $data = []){
        return self::fail($msg, $data, 400);
	}
	
    static function serverFail($msg = "", $data = []){
        return self::fail($msg, $data, 500);
    }
}