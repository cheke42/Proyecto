<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ciudad extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('util_model');
		$this->load->model('ciudad_model');
	}

	public function index()
	{
		$this->listar();
	}

	public function listar(){
		$this->util_model->template_view('ciudad/listar');
	}

	public function ciudad_existe_ajax(){
		$datos['nombre'] = $this->input->post('ciudad');
		if ($this->ciudad_model->existe($datos['nombre'])){
			echo "existe";
		}else{
			$this->ciudad_model->guardar($datos);
		}
	}

	public function obtener_ciudades_ajax(){
		$ciudades = $this->ciudad_model->get();
		echo json_encode($ciudades);
	}

	public function ciudad_por_provincia(){
		$id_provincia = $this->input->post('id');
		echo json_encode($this->ciudad_model->get_ciudades_con_provincia($id_provincia));
	}


}

/* End of file Ciudad.php */
/* Location: ./application/controllers/Ciudad.php */