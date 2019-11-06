<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contabilidad extends CI_Controller {

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
		}else{
			if($this->session->userdata("rol")=="RENDICION"){
				redirect(base_url('rendicion'));
			}
		}
		$this->load->model(array('caja/caja_model','proyecto/proyecto_model','mantenimiento/persona_model','requerimiento/requerimiento_model'));
 		$this->load->library(array('session','form_validation'));
 		$this->load->helper(array('url','form'));
 		$this->load->database('default');
	}
	public function index(){
		
		$this->load->view('layout/header');
		$this->load->view('contabilidad/compraventa');
		$this->load->view('layout/footer');
    }

    public function caja_banco(){
		
		$this->load->view('layout/header');
		$this->load->view('contabilidad/cajabanco');
		$this->load->view('layout/footer');
    }

}