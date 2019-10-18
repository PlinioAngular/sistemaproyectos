<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
		$this->load->model(array('principal/principal_model'));
 		$this->load->library(array('session','form_validation'));
 		$this->load->helper(array('url','form'));
 		$this->load->database('default');
    }
	public function index()
	{
		$datos["datos"]=$this->principal_model->mostrar();
		$this->load->view('layout/header');
		$this->load->view('principal/principal',$datos);
		$this->load->view('layout/footer');
	}
	function api()
{
	// Armamos el string de parámetros a enviar
$postData = http_build_query(array(
    'X-API-KEY' => "CCSat19*/_GrupoSatelitalTelecomunicaciones19*/"
));

$options = array('http' => array(
    'method' => 'POST',
	'header'  => 'X-API-KEY: CCSat19*/_GrupoSatelitalTelecomunicaciones19*/ ' 
));

// Creamos el contexto
$context = stream_context_create($options);

// Enviamos la solicitud
$response = file_get_contents('http://172.16.10.50/restfulcc/api/v1/listadocc', false, $context);
  //$url ='http://localhost/prueba_api/index.php/restserver/test/format/json';
  //$json = file_get_contents($url);
  var_dump($response);
  
}

	public function registrar()
	{
		$data['clientes'] = $this->principal_model->mostrar_cliente();
		$data['gerencias'] = $this->principal_model->mostrar_gerencia();
		$data['areas'] = $this->principal_model->mostrar_area();
		$data['sub_areas'] = $this->principal_model->mostrar_sub_area();
		$data['tipos_actividad'] = $this->principal_model->mostrar_tipo_actividad();
		$this->load->view('layout/header');
		$this->load->view('principal/registrar',$data);
		$this->load->view('layout/footer');
	}
	public function edit($id=0)
	{
		$data['clientes'] = $this->principal_model->mostrar_cliente();
		$data['gerencias'] = $this->principal_model->mostrar_gerencia();
		$data['areas'] = $this->principal_model->mostrar_area();
		$data['sub_areas'] = $this->principal_model->mostrar_sub_area();
		$data['tipos_actividad'] = $this->principal_model->mostrar_tipo_actividad();
		$data['proyecto'] = $this->principal_model->mostrar_por_id($id);
		$this->load->view('layout/header');
		$this->load->view('principal/editar',$data);
		$this->load->view('layout/footer');
	}

	function proyecto_add(){

		$this->form_validation->set_rules('descripcion','descripcion', 'required');
		
		if($this->form_validation->run() == FALSE)
		{
			echo 'Uno o varios campos son obligatorios.';
			//sleep(3); //TEST DE TIEMPO DE RESPUESTA
		}
		else
		{
			if($qid = $this->principal_model->proyecto_add())
			{
				echo 'si_'.$qid;
			}
			else
			{
				echo 'Error en el registro. Comunicate con el administrador.';
			}
		}
	}
	function proyecto_edit(){

		$this->form_validation->set_rules('descripcion','descripcion', 'required');
		
		if($this->form_validation->run() == FALSE)
		{
			echo 'Uno o varios campos son obligatorios.';
			//sleep(3); //TEST DE TIEMPO DE RESPUESTA
		}
		else
		{
			if($qid = $this->principal_model->proyecto_edit())
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
