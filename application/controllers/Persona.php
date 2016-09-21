<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Persona extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('persona_model');
		$this->load->model('util_model');
		$this->load->model('paises_model');
		$this->load->model('ciudad_model');
		$this->load->model('provincias_model');
		$this->load->model('provincia_ciudad_model');
		$this->load->model('empresa_model');
		$this->load->model('nacionalidad_model');
		$this->load->model('datos_domicilio_model');
	}

	public function index(){
		$this->listar();
	}

	public function listar(){

		$datos['personas'] = $this->persona_model->get();
		$this->_template('persona/listar',$datos);
	}

	public function datos(){
		$id = $this->input->get('id');
		$data['persona'] = $this->persona_model->get($id);
		$this->_template('persona/detalle',$data);

	}

	public function nueva(){
		$this->_template('persona/nueva');
	}

	public function editar(){
		$datos['id'] = $this->input->get('id');
		$this->_template('persona/detalle', $datos);
	}



	private function _template($vista,$data = null){
		$this->util_model->template_view($vista,$data);
	}

	//Guardar una nueva o actualizar una persona
	public function save_ajax(){

		$datos_domicilio = array(
			'barrio' 		=> 	$this->input->post('barrio'),
			'calle' 		=> 	$this->input->post('calle'),
			'numero' 		=> 	$this->input->post('numero'),
			'piso' 			=> 	$this->input->post('piso'),
			'departamento' 	=> 	$this->input->post('departamento'),
			'provincia'		=> 	$this->input->post('provincia'),
			'ciudad' 		=>	$this->input->post('ciudad')
		);

		$datos_persona = array(
			'dni' 				=> $this->input->post('dni'),
			'nombre' 			=> $this->input->post('nombre'),
			'apellido' 			=> $this->input->post('apellido'),
			'segundo_apellido' 	=> $this->input->post('segundo_apellido'),
			'fecha_nacimiento' 	=> $this->input->post('fecha_nacimiento'),
			'lugar_nacimiento'	=> $this->input->post('lugar_nacimiento'),
			'nacionalidad'		=> $this->input->post('nacionalidad'),
			'email' 			=> $this->input->post('email'),
			'telefonos' 		=> $this->input->post('telefonos'),
			'cuit' 				=> $this->input->post('cuit'),
			'empresa' 			=>	$this->input->post('empresa')
		);

		//EXISTE
		if ($this->persona_model->existe($this->input->post('dni'))){
			$this->persona_model->actualizar_persona($datos_persona,$datos_domicilio);			
		}else{ //NO EXISTE
			//guardo el id del domicilio creado
			$id_domicilio_creado = $this->datos_domicilio_model->nuevo_domicilio($datos_domicilio);
			//Guardo la persona
			$datos_persona['domicilio_actual'] = $id_domicilio_creado;
			$this->persona_model->save($datos_persona);
			echo "persona-nueva-guardada";
		}
	}

	

}

/* End of file Persona.php */
/* Location: ./application/controllers/Persona.php */