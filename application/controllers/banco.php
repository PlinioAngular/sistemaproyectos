<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banco extends CI_Controller {

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
		$this->load->model(array('mantenimiento/banco_model'));
 		$this->load->library(array('session','form_validation'));
 		$this->load->helper(array('url','form'));
 		$this->load->database('default');
    }
	public function index()
	{
		$datos["datos"]=$this->banco_model->mostrar();
		$this->load->view('layout/header');
		$this->load->view('banco/listar',$datos);
		$this->load->view('layout/footer');
	}
	public function registrar()
	{	$datos['empresas']=	$this->banco_model->mostrar_empresa();
		$this->load->view('layout/header');
		$this->load->view('banco/registrar',$datos);
		$this->load->view('layout/footer');
	}
	public function edit($id=0)
	{
		
		$data['banco'] = $this->banco_model->mostrar_por_id($id);
		$data['empresas']=	$this->banco_model->mostrar_empresa();
		$this->load->view('layout/header');
		$this->load->view('banco/editar',$data);
		$this->load->view('layout/footer');
	}

	public function mostrar_banco_id(){
		$detalles=array();
		$data= $this->banco_model->mostrar_banco_id();
		echo json_encode($data);
	}

	function banco_add(){

		$this->form_validation->set_rules('banco','banco', 'required');
		$this->form_validation->set_rules('id_empresa','id_empresa', 'required');
		$this->form_validation->set_rules('monto_soles','monto_soles', 'required');
		$this->form_validation->set_rules('monto_dolares','monto_dolares', 'required');

		if($this->form_validation->run() == FALSE)
		{
			echo 'Uno o varios campos son obligatorios.';
			//sleep(3); //TEST DE TIEMPO DE RESPUESTA
		}
		else
		{
			if($qid = $this->banco_model->banco_add())
			{
				echo 'si_'.$qid;
			}
			else
			{
				echo 'Error en el registro. Comunicate con el administrador.';
			}
		}
	}
	function banco_edit(){

		$this->form_validation->set_rules('banco','banco', 'required');
		$this->form_validation->set_rules('id_empresa','id_empresa', 'required');
		$this->form_validation->set_rules('monto_soles','monto_soles', 'required');
		$this->form_validation->set_rules('monto_dolares','monto_dolares', 'required');
		
		if($this->form_validation->run() == FALSE)
		{
			echo 'Uno o varios campos son obligatorios.';
			//sleep(3); //TEST DE TIEMPO DE RESPUESTA
		}
		else
		{
			if($qid = $this->banco_model->banco_edit())
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