<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa_model extends CI_Model {

	public function get($id = null){
		if (is_null($id)){
			return $this->db->get('empresa')->result();
		}else{
			$this->db->where('id',$id);
			return $this->db->get('empresa')->result()[0];
		}
	}
	

}

/* End of file empresa_model.php */
/* Location: ./application/models/empresa_model.php */