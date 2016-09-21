<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ciudad_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get($id = null){
		if (!is_null($id)){

		}else{
			return $this->db->get('ciudad')->result();	
		}
	}

	//verificar si existe el nombre: TRUE o FALSE
		public function existe($nombre){
			$this->db->where('nombre', $nombre);
			$query = $this->db->get('ciudad');
			if($query->num_rows() > 0 ){
				return true;
			}else{
				return false;
			}
		}

		public function guardar($data){
				$datos = array('nombre' => $data['nombre']);
				$this->db->insert('ciudad', $datos);
		}

	public function get_ciudades_con_provincia($id_provincia){
		$sql = "select * from ciudad where provincia_id = '" . $id_provincia . "'";
		return $this->db->query($sql)->result();
	}
	

}

/* End of file ciudad_model.php */
/* Location: ./application/models/ciudad_model.php */