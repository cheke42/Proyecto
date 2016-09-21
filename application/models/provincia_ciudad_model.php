<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Provincia_ciudad_model extends CI_Model {

	public function get($id = null){
		if (is_null($id)){
			return $this->db->get('provincia_ciudad')->result();
		}else{
			$this->db->where('id',$id);
			return $this->db->get('provincia_ciudad')->result()[0];
		}
	}
	

}

/* End of file provincia_ciudad_model.php */
/* Location: ./application/models/provincia_ciudad_model.php */