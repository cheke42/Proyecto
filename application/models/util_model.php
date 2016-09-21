<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Util_model extends CI_Model {

	//Carga la vista con el template
	public function template_view($view,$params = null){
		if (!is_null($params)){
			$this->load->view('template/header',$params);
			$this->load->view($view,$params);
			$this->load->view('template/footer',$params);
		}else{
			$this->load->view('template/header');
			$this->load->view($view);
			$this->load->view('template/footer');	
		}
	}
	

}

/* End of file util_model.php */
/* Location: ./application/models/util_model.php */