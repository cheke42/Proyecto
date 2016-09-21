<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Provincia_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get($id = null){
		if (is_null($id)){
			return $this->db->get('provincia')->result();
		}else{
			$this->db->where('id',$id);
			return $this->db->get('provincia')->result()[0];
		}
	}
	

}

/* End of file provincia_model.php */
/* Location: ./application/models/provincia_model.php */