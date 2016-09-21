<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paises_model extends CI_Model {

	public function get($id = null){
		if (is_null($id)){
			return $this->db->get('paises')->result();
		}else{
			$this->db->where('id',$id);
			return $this->db->get('paises')->result()[0];
		}
	}
	

}

/* End of file paises_model.php */
/* Location: ./application/models/paises_model.php */