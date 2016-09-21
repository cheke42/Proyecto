<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nacionalidad_model extends CI_Model {

	public function get($id = null){
		if (is_null($id)){
			return $this->db->get('paises')->result();
		}else{
			$this->db->where('id',$id);
			return $this->db->get('paises')->result()[0];
		}
	}
	

}

/* End of file nacionalidad_model.php */
/* Location: ./application/models/nacionalidad_model.php */