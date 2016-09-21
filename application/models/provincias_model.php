<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Provincias_model extends CI_Model {

	public function get($id = null){
		if (is_null($id)){
			return $this->db->get('provincia')->result();
		}else{
			$this->db->where('id',$id);
			return $this->db->get('provincia')->result()[0];
		}
	}

}

/* End of file provincias_model.php */
/* Location: ./application/models/provincias_model.php */