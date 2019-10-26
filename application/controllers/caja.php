<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Caja extends CI_Controller {

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
		$this->load->model(array('caja/caja_model','principal/principal_model','mantenimiento/persona_model'));
 		$this->load->library(array('session','form_validation'));
 		$this->load->helper(array('url','form'));
 		$this->load->database('default');
	}
	public function fecha(){
		$data['clientes'] = $this->principal_model->mostrar_cliente();
		$data['clasificaciones'] = $this->principal_model->mostrar_clasificacion();
		$data['gerencias'] = $this->principal_model->mostrar_gerencia();
		$data['areas'] = $this->principal_model->mostrar_area();
		$data['sub_areas'] = $this->principal_model->mostrar_sub_area();
		$data['tipos_actividad'] = $this->principal_model->mostrar_tipo_actividad();
		$data['empresas']=	$this->principal_model->mostrar_empresa();
		$data['bancos']=	$this->principal_model->mostrar_banco();
		$data['comprobantes']=	$this->principal_model->mostrar_comprobante();
		$data['personas']=	$this->persona_model->mostrar();
		$data['proyectos']=	$this->principal_model->mostrar();
		$this->load->view('layout/header');
		$this->load->view('chart/excel',$data);
		$this->load->view('layout/footer');
	}

	public function index()
	{
		$datos["fecha"]=date("Y/m/d");
		$this->load->view('layout/header');
		$this->load->view('caja/listado',$datos);
		$this->load->view('layout/footer');
	}
	public function ajax(){
		$data= $this->caja_model->mostrar();
		$pasar=array();
		$i=0;
		foreach($data as $caja){
			$pasar[$i][0]=$caja->id_detalle_caja;
			$pasar[$i][1]=date('Y-m-d',strtotime($caja->fecha));;
			$pasar[$i][2]=$caja->periodo;
			$pasar[$i][3]=$caja->nombre_proyecto;
			$pasar[$i][4]=$caja->monto;
			$pasar[$i][5]=$caja->detalle;
			$pasar[$i][6]=$caja->banco.' '.$caja->empresa;
			$pasar[$i][7]=$caja->clasificacion;
			$pasar[$i][8]=$caja->ap_res.' '.$caja->am_res.' '.$caja->nom_res;
			$pasar[$i][9]=$caja->ap_ben.' '.$caja->am_ben.' '.$caja->nom_ben;
			$pasar[$i][10]=$caja->ap_aut.' '.$caja->am_aut.' '.$caja->nom_aut;
			$pasar[$i][11]=$caja->ap_reg.' '.$caja->am_reg.' '.$caja->nom_reg;
			$pasar[$i][12]='<button aria-expanded="false" aria-haspopup="true" class="btn btn dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton1" type="button">Opción</button>
			<div aria-labelledby="dropdownMenuButton1" class="dropdown-menu">
			<a class="dropdown-item" href="'.base_url().'caja/edit/'.$caja->id_caja.'" >Editar</a><a class="dropdown-item" href="#">Dar de Baja</a>
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
		$data['clientes'] = $this->principal_model->mostrar_cliente();
		$data['clasificaciones'] = $this->principal_model->mostrar_clasificacion();
		$data['gerencias'] = $this->principal_model->mostrar_gerencia();
		$data['areas'] = $this->principal_model->mostrar_area();
		$data['sub_areas'] = $this->principal_model->mostrar_sub_area();
		$data['tipos_actividad'] = $this->principal_model->mostrar_tipo_actividad();
		$data['empresas']=	$this->principal_model->mostrar_empresa();
		$data['bancos']=	$this->principal_model->mostrar_banco();
		$data['personas']=	$this->persona_model->mostrar();
		$data['proyectos']=	$this->principal_model->mostrar();
		$this->load->view('layout/header');
		$this->load->view('caja/registrar',$data);
		$this->load->view('layout/footer');
	}
	public function edit($id_caja=0)
	{
		$data['clientes'] = $this->principal_model->mostrar_cliente();
		$data['clasificaciones'] = $this->principal_model->mostrar_clasificacion();
		$data['gerencias'] = $this->principal_model->mostrar_gerencia();
		$data['areas'] = $this->principal_model->mostrar_area();
		$data['sub_areas'] = $this->principal_model->mostrar_sub_area();
		$data['tipos_actividad'] = $this->principal_model->mostrar_tipo_actividad();
		$data['empresas']=	$this->principal_model->mostrar_empresa();
		$data['bancos']=	$this->principal_model->mostrar_banco();
		$data['personas']=	$this->persona_model->mostrar();
		$data['proyectos']=	$this->principal_model->mostrar();
		$data["caja"]=$this->caja_model->mostrar_por_id($id_caja);
		$data["detalles_caja"]=$this->caja_model->mostrar_detalle_por_id($id_caja);
		$this->load->view('layout/header');
		$this->load->view('caja/editar',$data);
		$this->load->view('layout/footer');
	}

	function caja_add(){

		//$this->form_validation->set_rules('total','total', 'required');
		$this->form_validation->set_rules('id_banco','id_banco', 'required');
		$this->form_validation->set_rules('id_empresa','id_empresa', 'required');
		$this->form_validation->set_rules('id_responsable','id_responsable', 'required');
		$this->form_validation->set_rules('id_beneficiario','id_beneficiario', 'required');
		$this->form_validation->set_rules('id_autoriza','id_autoriza', 'required');
		$this->form_validation->set_rules('proyectos[]','proyectos[]', 'required');
		$this->form_validation->set_rules('detalles[]','detalles[]', 'required');
		$this->form_validation->set_rules('clasificaciones[]','clasificaciones[]', 'required');
		$this->form_validation->set_rules('montos[]','montos[]', 'required|numeric');
		
		if($this->form_validation->run() == FALSE)
		{
			echo 'Verifique que todo los camos estén llenados de manera adecuada.';
			//sleep(3); //TEST DE TIEMPO DE RESPUESTA
		}
		else
		{
			if($qid = $this->caja_model->caja_add())
			{
				echo 'si_'.$qid;
			}
			else
			{
				echo 'Error en el registro. Comunicate con el administrador.';
			}
		}
	}
	function caja_edit(){

		$this->form_validation->set_rules('id_banco','id_banco', 'required');
		$this->form_validation->set_rules('id_empresa','id_empresa', 'required');
		$this->form_validation->set_rules('id_responsable','id_responsable', 'required');
		$this->form_validation->set_rules('id_beneficiario','id_beneficiario', 'required');
		$this->form_validation->set_rules('id_autoriza','id_autoriza', 'required');
		$this->form_validation->set_rules('proyectos[]','proyectos[]', 'required');
		$this->form_validation->set_rules('detalles[]','detalles[]', 'required');
		$this->form_validation->set_rules('clasificaciones[]','clasificaciones[]', 'required');
		$this->form_validation->set_rules('montos[]','montos[]', 'required');
		
		if($this->form_validation->run() == FALSE)
		{
			echo 'Verifique que todo los camos estén llenados de manera adecuada.';
			//sleep(3); //TEST DE TIEMPO DE RESPUESTA
		}
		else
		{
			if($qid = $this->caja_model->caja_edit())
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
