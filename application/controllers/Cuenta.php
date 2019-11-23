<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuenta extends CI_Controller {

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
		$this->load->model(array('mantenimiento/cuenta_model'));
 		$this->load->library(array('session','form_validation','encryption'));
 		$this->load->helper(array('url','form'));
		 $this->load->database('default');
		 $this->encryption->initialize(array('driver' => 'mcrypt'));
    }
	public function index()
	{
        $datos["datos"]=$this->cuenta_model->mostrar();
		$this->load->view('layout/header');
		$this->load->view('cuenta/listar',$datos);
		$this->load->view('layout/footer');
    }
    public function ajax(){
		$data= $this->cuenta_model->mostrar();
		$pasar=array();
		$i=0;
		foreach($data as $cuenta){
            $pasar[$i][0]='<p>'.$cuenta->id_cuenta.'</p>';
            $pasar[$i][1]='<p>'.$cuenta->cuenta.'</p>';
			$pasar[$i][2]='<p>'.$cuenta->descripcion.'<p>';
			$pasar[$i][3]='<p style="display:none;">'.$cuenta->c_bal.'_'.$cuenta->a_debe.'_'.$cuenta->a_haber.'_'.$cuenta->tipo.'_'.$cuenta->analisis.'_'.
			$cuenta->centro_costo.'_'.$cuenta->presupuesto.'_'.$cuenta->nivel.'_'.$cuenta->situacion.'_'.$cuenta->resultado.'</p><button id="ver" type="button" class="btn btn-info btn-circle btn-sm" ><i class="far fa-eye"></i></button>';
			$i ++;
		} 
		$respuesta= array(    
			'data'=>  $pasar);
		echo json_encode($respuesta);
    }
    function registrar(){
        $this->load->view('layout/header');
		$this->load->view('cuenta/registrar');
		$this->load->view('layout/footer');
	}
	
	function cuenta_add(){

		$this->form_validation->set_rules('cuenta','cuenta', 'required');
		
		if($this->form_validation->run() == FALSE)
		{
			echo 'Verifique todo los campos estén llenados de manera adecuada.';
			//sleep(3); //TEST DE TIEMPO DE RESPUESTA
		}
		else
		{
			if($qid = $this->cuenta_model->cuenta_add())
			{
				echo 'si_'.$qid;
			}
			else
			{
				echo 'Error en el registro. Comunicate con el administrador.';
			}
		}
	}

	function cuenta_edit(){

		$this->form_validation->set_rules('cuenta','cuenta', 'required');
		
		if($this->form_validation->run() == FALSE)
		{
			echo 'Verifique todo los camos estén llenados de manera adecuada.';
			//sleep(3); //TEST DE TIEMPO DE RESPUESTA
		}
		else
		{
			if($qid = $this->cuenta_model->cuenta_edit())
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