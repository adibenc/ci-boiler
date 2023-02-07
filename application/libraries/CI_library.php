<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//

class Ci_library{
    
    protected $_ci;
    
    function __construct()
    {
        $this->_ci =&get_instance();
    }

    function validation($config, $error_message=[]){
        $this->_ci->load->library('form_validation');
		$this->_ci->form_validation->set_error_delimiters('', ',');
        $this->_ci->form_validation->set_message('required', '%s harus diisi');
		$this->_ci->form_validation->set_message('numeric', '%s harus diisi berupa angka');

        foreach($config as $key => $value){
            $this->_ci->form_validation->set_rules($value[0], $value[1], $value[2]);
        }

        foreach($error_message as $key => $value){
            $this->_ci->form_validation->set_message($value[0], $value[1]);
        }

        if($this->_ci->form_validation->run() == FALSE){

			$a = explode(',', validation_errors());
			$response = array('status'=>400,'message'=>$a[0]);
			rest_response(400, $response);

		}else{
            return true;
        }
    }

    function uploads($field_name = 'file', $setting = array())
	{

		$config['encrypt_name'] = true;
		$config['upload_path'] = './uploads/bukti';
		$config['allowed_types'] = 'png|jpg|jpeg|webp';

		foreach($setting as $key => $value){
			$config[$key] = $value;
		}

		if (!file_exists($config['upload_path'])) {
		   mkdir($config['upload_path'], 0755);
		}

		$this->_ci->load->library('upload', $config);
		$this->_ci->upload->initialize($config);
		if (!$this->_ci->upload->do_upload($field_name))
		{
			$a = $this->_ci->upload->display_errors('', '');
			$data = array('status' => 400, 'message' => $a);
		}
		else
		{
			if(is_array($this->_ci->upload->data('file_name'))){
				$detail = $this->_ci->upload->data('file_name');
				$output['name'] = $detail['file_name'];
				$output['size'] = $detail['file_size'];
				$output['file_ext'] = $detail['file_ext'];
			}else{
				$output['name'] = $this->_ci->upload->data('file_name');
				$output['size'] = $this->_ci->upload->data('file_size');
				$output['file_ext'] = $this->_ci->upload->data('file_ext');	
			}
			$data = array('status' => 200, 'message' => 'Upload Success', 'data' => $output);
		}

		return $data;
	}
}

