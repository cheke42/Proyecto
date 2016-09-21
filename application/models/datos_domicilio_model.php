<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datos_domicilio_model extends CI_Model {

	public function save($datos){
		$this->db->insert('datos_domicilio', $datos);
	}

	public function get($id = null){
		if (is_null($id)){
			return $this->db->get('datos_domicilio')->result();
		}else{
			$this->db->where('id',$id);
			return $this->db->get('datos_domicilio')->result()[0];
		}
	}

	public function update($id,$datos){
		print_r($datos);
		$this->db->where('id', $id);
		$this->db->update('datos_domicilio', $datos); 
	}

	public function delete($id){
		$this->db->delete('datos_domicilio', array('id' => $id)); 
	}


	public function nuevo_domicilio($datos){
		$data = array(
			'barrio' => $datos['barrio'],
			'calle' => $datos['calle'],
			'numero' => $datos['numero'],
			'piso' => $datos['piso'],
			'departamento' => $datos['departamento'],
			'provincia_ciudad' => $this->obtener_id_provincia_ciudad($datos)
			);
			$this->db->insert('datos_domicilio', $data);
			return $this->db->insert_id();	
	}

	public function obtener_id_provincia_ciudad($datos){
		$id_provincia_ciudad;
		//chequear si existe provincia_ciudad
		if($this->existe_provincia_ciudad($datos['provincia'],$datos['ciudad'])){
			$id_provincia_ciudad = $this->obtener_provincia_ciudad($datos['provincia'],$datos['ciudad']);
		}else{
			$this->guardar_provincia_ciudad($datos['provincia'],$datos['ciudad']);
			$id_provincia_ciudad = $this->obtener_provincia_ciudad($datos['provincia'],$datos['ciudad']);
			//si no existe, guardarlo en bd, obtenerlo y guardarlo
		}
		return $id_provincia_ciudad;

	}

	public function existe_provincia_ciudad($id_provincia,$id_ciudad){
		$sql = "select * from provincia_ciudad where id_provincia =" . $id_provincia . " and id_ciudad=" . $id_ciudad;
		$query = $this->db->query($sql);
		if($query->num_rows() > 0 ){
			return true;
		}else{
			return false;
		}
	}

	public function obtener_provincia_ciudad($id_provincia,$id_ciudad){
		$sql = "select * from provincia_ciudad where id_provincia = " . $id_provincia . " and id_ciudad =" . $id_ciudad;
		$query = $this->db->query($sql);
		
		return $query->result()[0]->id;
	}

	public function guardar_provincia_ciudad($id_provincia,$id_ciudad){
		$data = array(
			'id_provincia' => $id_provincia,
			'id_ciudad' => $id_ciudad
			);
		$this->db->insert('provincia_ciudad', $data);
	}

}

/* End of file datos_domicilio_model.php */
/* Location: ./application/models/datos_domicilio_model.php */