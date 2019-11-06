<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Requerimiento extends CI_Controller {

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
		$this->load->model(array('requerimiento/requerimiento_model','proyecto/proyecto_model','mantenimiento/persona_model'));
 		$this->load->library(array('session','form_validation'));
 		$this->load->helper(array('url','form'));
 		$this->load->database('default');
	}
	public function fecha(){
		$data['clientes'] = $this->proyecto_model->mostrar_cliente();
		$data['clasificaciones'] = $this->proyecto_model->mostrar_clasificacion();
		$data['gerencias'] = $this->proyecto_model->mostrar_gerencia();
		$data['areas'] = $this->proyecto_model->mostrar_area();
		$data['sub_areas'] = $this->proyecto_model->mostrar_sub_area();
		$data['tipos_actividad'] = $this->proyecto_model->mostrar_tipo_actividad();
		$data['empresas']=	$this->proyecto_model->mostrar_empresa();
		$data['bancos']=	$this->proyecto_model->mostrar_banco();
		$data['comprobantes']=	$this->proyecto_model->mostrar_comprobante();
		$data['personas']=	$this->persona_model->mostrar();
		$data['proyectos']=	$this->proyecto_model->mostrar();
		$this->load->view('layout/header');
		$this->load->view('chart/excel',$data);
		$this->load->view('layout/footer');
	}

	public function index()
	{
		$datos["fecha"]=date("Y/m/d");
		$datos['condicion']=1;
		$this->load->view('layout/header');
		$this->load->view('requerimiento/listado',$datos);
		$this->load->view('layout/footer');
	}
	public function por_aprobar()
	{
		$datos["fecha"]=date("Y/m/d");
		$datos['condicion']=2;
		$this->load->view('layout/header');
		$this->load->view('requerimiento/listado',$datos);
		$this->load->view('layout/footer');
	}
	public function por_atender()
	{
		$datos["fecha"]=date("Y/m/d");
		$datos['condicion']=3;
		$this->load->view('layout/header');
		$this->load->view('requerimiento/listado',$datos);
		$this->load->view('layout/footer');
	}
	public function ajax(){
		$data= $this->requerimiento_model->mostrar($this->input->post('condicion'));
		$pasar=array();
		$i=0;
		$acciones="";
		foreach($data as $requerimiento){
			if($requerimiento->estado=="SOLICITADO"){
				$acciones='<button aria-expanded="false" aria-haspopup="true" class="btn btn dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton1" type="button">Opción</button>
				<div aria-labelledby="dropdownMenuButton1" class="dropdown-menu">
				<a class="dropdown-item" href="'.base_url().'requerimiento/edit/'.md5($requerimiento->id_requerimiento).'" >Editar</a>
				<button class="dropdown-item" onclick="estado('.$requerimiento->id_requerimiento.',1)" >Cancelar</button>
				<div class="dropdown-divider"></div>
				<button class="dropdown-item" onclick="estado('.$requerimiento->id_requerimiento.',2)" >Aprobar</button>
				</div>';
			}elseif($requerimiento->estado=="APROBADO"){
				$acciones='<button aria-expanded="false" aria-haspopup="true" class="btn btn dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton1" type="button">Opción</button>
				<div aria-labelledby="dropdownMenuButton1" class="dropdown-menu">
				<button class="dropdown-item" onclick="estado('.$requerimiento->id_requerimiento.',1)" >Cancelar</button>
				<div class="dropdown-divider"></div>
				<button class="dropdown-item" onclick="estado('.$requerimiento->id_requerimiento.',3)" >Atender</button>
				</div>';
			}elseif ($requerimiento->estado=="CANCELADO") {
				$acciones='<button aria-expanded="false" aria-haspopup="true" class="btn btn dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton1" type="button">Opción</button>
				<div aria-labelledby="dropdownMenuButton1" class="dropdown-menu">
				<button class="dropdown-item" onclick="estado('.$requerimiento->id_requerimiento.',0)" >Restaurar</button>
				</div>';
			}
            $pasar[$i][0]=$requerimiento->id_requerimiento;
            $pasar[$i][1]=$requerimiento->apellido_paterno.' '.$requerimiento->apellido_materno.' '.$requerimiento->nombres;
			$pasar[$i][2]=date('Y-m-d',strtotime($requerimiento->fecha));
			$pasar[$i][3]=$requerimiento->nombre_proyecto;
			$pasar[$i][4]=$requerimiento->total;
			$pasar[$i][5]=$requerimiento->estado;
			$pasar[$i][6]=$acciones;
			$i ++;
		}
		$respuesta= array(    
			'data'=>  $pasar);
		echo json_encode($respuesta);
	}
	public function registrar()
	{
		$data['clientes'] = $this->proyecto_model->mostrar_cliente();
		$data['clasificaciones'] = $this->proyecto_model->mostrar_clasificacion();
		$data['gerencias'] = $this->proyecto_model->mostrar_gerencia();
		$data['areas'] = $this->proyecto_model->mostrar_area();
		$data['sub_areas'] = $this->proyecto_model->mostrar_sub_area();
		$data['tipos_actividad'] = $this->proyecto_model->mostrar_tipo_actividad();
		$data['empresas']=	$this->proyecto_model->mostrar_empresa();
		$data['bancos']=	$this->proyecto_model->mostrar_banco();
		$data['personas']=	$this->persona_model->mostrar();
		$data['proyectos']=	$this->proyecto_model->mostrar();
		$this->load->view('layout/header');
		$this->load->view('requerimiento/registrar',$data);
		$this->load->view('layout/footer');
	}
	public function edit($id_requerimiento=0)
	{
		$data["requerimiento"]=$this->requerimiento_model->mostrar_por_id($id_requerimiento);
		$data["detalles_requerimiento"]=$this->requerimiento_model->mostrar_detalle_por_id($id_requerimiento);
		if($data['requerimiento']!=null){		
		$data['empresas']=	$this->proyecto_model->mostrar_empresa();
		$data['personas']=	$this->persona_model->mostrar();
		$data['proyectos']=	$this->proyecto_model->mostrar();		
		$this->load->view('layout/header');
		$this->load->view('requerimiento/editar',$data);
		$this->load->view('layout/footer');
		}
		else{
			$this->load->view('layout/header');
			$this->load->view('mensajes/invalido');
			$this->load->view('layout/footer');
		}
	}

	function requerimiento_add(){

		//$this->form_validation->set_rules('total','total', 'required');
		$this->form_validation->set_rules('id_empresa','id_empresa', 'required');
		$this->form_validation->set_rules('id_responsable','id_responsable', 'required');
		$this->form_validation->set_rules('id_autoriza','id_autoriza', 'required');
		$this->form_validation->set_rules('id_proyecto','id_proyecto', 'required');
		
		if($this->form_validation->run() == FALSE)
		{
			echo 'Verifique que todo los campos estén llenados de manera adecuada.';
			//sleep(3); //TEST DE TIEMPO DE RESPUESTA
		}
		else
		{
			if($qid = $this->requerimiento_model->requerimiento_add())
			{
				echo 'si_'.$qid;
			}
			else
			{
				echo 'Error en el registro. Comunicate con el administrador.';
			}
		}
	}
	function requerimiento_edit(){

		$this->form_validation->set_rules('id_empresa','id_empresa', 'required');
		$this->form_validation->set_rules('id_responsable','id_responsable', 'required');
		$this->form_validation->set_rules('id_autoriza','id_autoriza', 'required');
		$this->form_validation->set_rules('id_proyecto','id_proyecto', 'required');
		
		if($this->form_validation->run() == FALSE)
		{
			echo 'Verifique que todo los campos estén llenados de manera adecuada.';
			//sleep(3); //TEST DE TIEMPO DE RESPUESTA
		}
		else
		{
			if($qid = $this->requerimiento_model->requerimiento_edit())
			{
				echo 'si_'.$qid;
			}
			else
			{
				echo 'Error en el registro. Comunicate con el administrador.';
			}
		}
	}

	function estado($id,$accion){	
		
			if($qid=$this->requerimiento_model->cambio_estado($id,$accion))
			{
				echo "<script> location.href='".base_url('requerimiento' )."'; </script>";
			}
			else
			{
				echo 'Error en el registro. Comunicate con el administrador.';
			}
	}
}
