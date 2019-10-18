<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comprobante extends CI_Controller {

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
		$this->load->model(array('mantenimiento/comprobante_model'));
 		$this->load->library(array('session','form_validation'));
 		$this->load->helper(array('url','form'));
 		$this->load->database('default');
    }
	public function index()
	{
		$datos["datos"]=$this->comprobante_model->mostrar();
		$this->load->view('layout/header');
		$this->load->view('comprobante/listar',$datos);
		$this->load->view('layout/footer');
	}
	public function registrar()
	{		
		$this->load->view('layout/header');
		$this->load->view('comprobante/registrar');
		$this->load->view('layout/footer');
	}
	public function edit($id=0)
	{
		
		$data['comprobante'] = $this->comprobante_model->mostrar_por_id($id);
		$this->load->view('layout/header');
		$this->load->view('comprobante/editar',$data);
		$this->load->view('layout/footer');
	}

	function comprobante_add(){

		$this->form_validation->set_rules('comprobante','comprobante', 'required');
		
		if($this->form_validation->run() == FALSE)
		{
			echo 'Uno o varios campos son obligatorios.';
			//sleep(3); //TEST DE TIEMPO DE RESPUESTA
		}
		else
		{
			if($qid = $this->comprobante_model->comprobante_add())
			{
				echo 'si_'.$qid;
			}
			else
			{
				echo 'Error en el registro. Comunicate con el administrador.';
			}
		}
	}
	function comprobante_edit(){

		$this->form_validation->set_rules('comprobante','comprobante', 'required');
		
		if($this->form_validation->run() == FALSE)
		{
			echo 'Uno o varios campos son obligatorios.';
			//sleep(3); //TEST DE TIEMPO DE RESPUESTA
		}
		else
		{
			if($qid = $this->comprobante_model->comprobante_edit())
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