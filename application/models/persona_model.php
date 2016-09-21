<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Persona_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('datos_domicilio_model');
	}

	public function get($id = null){
		if (is_null($id)){
			return $this->db->get('persona')->result();
		}else{
			$this->db->where('id',$id);
			return $this->db->get('persona')->result()[0];
		}
	}

	// dni,nombre,apellido,segundo_apellido,fecha_nacimiento,lugar_nacimiento,nacionalidad,email,telefonos,cuil
	public function save($datos){
		$this->db->insert('persona', $datos);
	}

	public function update($id,$datos){
		$this->db->where('id', $id);
		$this->db->update('persona', $datos); 
	}

	public function delete($id){
		$this->db->delete('persona', array('id' => $id)); 
	}

	public function existe($dni){
		$sql = "select * from persona where dni =" . $dni;
		$query = $this->db->query($sql);
		if($query->num_rows() > 0 ){
			return true;
		}else{
			return false;
		}
	}

	public function obtener_id($dni){
		$sql = "select * from persona where dni =" . $dni;
		return $this->db->query($sql)->result()[0]->id;
	}

	public function actualizar_persona($datos_persona,$datos_domicilio){
		$id_persona = $this->obtener_id($datos_persona['dni']);
		$persona = $this->get($id_persona);
		$id_provincia_ciudad;
		if ($persona->domicilio_actual == null){
			$id_provincia_ciudad = $this->datos_domicilio_model->nuevo_domicilio($datos_domicilio);
			$datos_persona['domicilio_actual'] = $id_provincia_ciudad;
			$this->update($id_persona,$datos_persona);
		}else{
			$id_provincia_ciudad = $persona->domicilio_actual;	//ENLACE HASTA EL DATO DEL DOMICILIO
			//REACOMODAR DATOS!
			$domicilio_formateado = array(
				'provincia_ciudad' => $this->datos_domicilio_model->obtener_id_provincia_ciudad($datos_domicilio),
				'departamento' => $datos_domicilio['departamento'],
				'piso' => $datos_domicilio['piso'],
				'numero' => $datos_domicilio['numero'],
				'calle' => $datos_domicilio['calle'],
				'barrio' => $datos_domicilio['barrio']
				);		
			$this->datos_domicilio_model->update($id_provincia_ciudad, $domicilio_formateado);
			$this->update($id_persona,$datos_persona);
		}
	}

	

}

