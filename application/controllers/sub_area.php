<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_area extends CI_Controller {

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
		$this->load->model(array('mantenimiento/sub_area_model'));
 		$this->load->library(array('session','form_validation'));
 		$this->load->helper(array('url','form'));
 		$this->load->database('default');
    }
	public function index()
	{
		$datos["datos"]=$this->sub_area_model->mostrar();
		$this->load->view('layout/header');
		$this->load->view('sub_area/listar',$datos);
		$this->load->view('layout/footer');
	}
	public function registrar()
	{		
		$this->load->view('layout/header');
		$this->load->view('sub_area/registrar');
		$this->load->view('layout/footer');
	}
	public function edit($id=0)
	{
		
		$data['sub_area'] = $this->sub_area_model->mostrar_por_id($id);
		$this->load->view('layout/header');
		$this->load->view('sub_area/editar',$data);
		$this->load->view('layout/footer');
	}

	function sub_area_add(){

		$this->form_validation->set_rules('sub_area','sub_area', 'required');
		
		if($this->form_validation->run() == FALSE)
		{
			echo 'Uno o varios campos son obligatorios.';
			//sleep(3); //TEST DE TIEMPO DE RESPUESTA
		}
		else
		{
			if($qid = $this->sub_area_model->sub_area_add())
			{
				echo 'si_'.$qid;
			}
			else
			{
				echo 'Error en el registro. Comunicate con el administrador.';
			}
		}
	}
	function sub_area_edit(){

		$this->form_validation->set_rules('sub_area','sub_area', 'required');
		
		if($this->form_validation->run() == FALSE)
		{
			echo 'Uno o varios campos son obligatorios.';
			//sleep(3); //TEST DE TIEMPO DE RESPUESTA
		}
		else
		{
			if($qid = $this->sub_area_model->sub_area_edit())
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