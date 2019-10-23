<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipo_actividad extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
    {
		parent::__construct();
		if (!$this->session->userdata("id")) {
			redirect(base_url());
		}
		$this->load->model(array('mantenimiento/tipo_actividad_model'));
 		$this->load->library(array('session','form_validation'));
 		$this->load->helper(array('url','form'));
 		$this->load->database('default');
    }
	public function index()
	{
		$datos["datos"]=$this->tipo_actividad_model->mostrar();
		$this->load->view('layout/header');
		$this->load->view('tipo_actividad/listar',$datos);
		$this->load->view('layout/footer');
	}

	public function ajax(){ 
		$data= $this->tipo_actividad_model->mostrar();
		$pasar=array();
		$i=0;
		foreach($data as $dato){
			$pasar[$i][0]=$dato->id_tipo_actividad;
			$pasar[$i][1]=$dato->tipo_actividad;
			$pasar[$i][2]='<button aria-expanded="false" aria-haspopup="true" class="btn btn dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton1" type="button">Opción</button>
			<div aria-labelledby="dropdownMenuButton1" class="dropdown-menu">
			<a class="dropdown-item" href="'. base_url('tipo_actividad/edit/').$dato->id_tipo_actividad .'" >Editar</a><a class="dropdown-item" href="#">Dar de Baja</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="#">Eliminar</a>
			</div>';
			$i ++;
		}
		$respuesta= array(    
			'data'=>  $pasar);
		echo json_encode($respuesta);
	}

	public function registrar()
	{		
		$this->load->view('layout/header');
		$this->load->view('tipo_actividad/registrar');
		$this->load->view('layout/footer');
	}
	public function edit($id=0)
	{
		
		$data['tipo_actividad'] = $this->tipo_actividad_model->mostrar_por_id($id);
		$this->load->view('layout/header');
		$this->load->view('tipo_actividad/editar',$data);
		$this->load->view('layout/footer');
	}

	function tipo_actividad_add(){

		$this->form_validation->set_rules('tipo_actividad','tipo_actividad', 'required');
		
		if($this->form_validation->run() == FALSE)
		{
			echo 'Uno o varios campos son obligatorios.';
			//sleep(3); //TEST DE TIEMPO DE RESPUESTA
		}
		else
		{
			if($qid = $this->tipo_actividad_model->tipo_actividad_add())
			{
				echo 'si_'.$qid;
			}
			else
			{
				echo 'Error en el registro. Comunicate con el administrador.';
			}
		}
	}
	function tipo_actividad_edit(){

		$this->form_validation->set_rules('tipo_actividad','tipo_actividad', 'required');
		
		if($this->form_validation->run() == FALSE)
		{
			echo 'Uno o varios campos son obligatorios.';
			//sleep(3); //TEST DE TIEMPO DE RESPUESTA
		}
		else
		{
			if($qid = $this->tipo_actividad_model->tipo_actividad_edit())
			{
				echo 'si_'.$qid;
			}
			else
			{
				echo 'Error en el registro. Comunicate con el administrador.';
			}
		}
	}
}