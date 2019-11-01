<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proyecto extends CI_Controller {

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
		$this->load->model(array('proyecto/proyecto_model','rendicion/rendicion_model'));
 		$this->load->library(array('session','form_validation'));
 		$this->load->helper(array('url','form'));
 		$this->load->database('default');
    }
	public function index()
	{
		$datos["datos"]=$this->proyecto_model->mostrar();
		$datos["notificaciones"]=$this->rendicion_model->rendiciones_web();
		$this->load->view('layout/header',$datos);
		$this->load->view('proyecto/listado');
		$this->load->view('layout/footer');
	}

	public function ajax(){ 
		$data= $this->proyecto_model->mostrar();
		$pasar=array();
		$i=0;
		foreach($data as $dato){
			$pasar[$i][0]=$dato->nombre_proyecto;
			$pasar[$i][1]=$dato->codigo_proyecto;
			$pasar[$i][2]=$dato->cliente;
			$pasar[$i][3]=$dato->gerencia;
			$pasar[$i][4]=$dato->area;
			$pasar[$i][5]=$dato->sub_area;
			$pasar[$i][6]=$dato->empresa;
			$pasar[$i][7]='<button aria-expanded="false" aria-haspopup="true" class="btn btn dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton1" type="button">Opción</button>
			<div aria-labelledby="dropdownMenuButton1" class="dropdown-menu">
			<a class="dropdown-item" href="'. base_url('proyecto/edit/').$dato->id_proyecto .'" >Editar</a><a class="dropdown-item" href="#">Dar de Baja</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="#">Eliminar</a>
			</div>';
			$i ++;
		}
		$respuesta= array(    
			'data'=>  $pasar);
		echo json_encode($respuesta);
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
$response = file_get_contents('http://172.16.10.20/restfulcc/api/v1/listadocc', false, $context);
  //$url ='http://localhost/prueba_api/index.php/restserver/test/format/json';
  //$json = file_get_contents($url);
  echo json_encode($response);
  
}

	public function registrar()
	{
		$datos["notificaciones"]=$this->rendicion_model->rendiciones_web();
		$data['clientes'] = $this->proyecto_model->mostrar_cliente();
		$data['gerencias'] = $this->proyecto_model->mostrar_gerencia();
		$data['areas'] = $this->proyecto_model->mostrar_area();
		$data['sub_areas'] = $this->proyecto_model->mostrar_sub_area();
		$data['empresas'] = $this->proyecto_model->mostrar_empresa();
		$this->load->view('layout/header',$datos);
		$this->load->view('proyecto/registrar',$data);
		$this->load->view('layout/footer');
	}
	public function edit($id=0)
	{
		$datos["notificaciones"]=$this->rendicion_model->rendiciones_web();
		$data['clientes'] = $this->proyecto_model->mostrar_cliente();
		$data['gerencias'] = $this->proyecto_model->mostrar_gerencia();
		$data['areas'] = $this->proyecto_model->mostrar_area();
		$data['sub_areas'] = $this->proyecto_model->mostrar_sub_area();
		$data['empresas'] = $this->proyecto_model->mostrar_empresa();
		$data['proyecto'] = $this->proyecto_model->mostrar_por_id($id);
		$this->load->view('layout/header',$datos);
		$this->load->view('proyecto/editar',$data);
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
			if($qid = $this->proyecto_model->proyecto_add())
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
			if($qid = $this->proyecto_model->proyecto_edit())
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
