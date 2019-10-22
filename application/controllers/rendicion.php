<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rendicion extends CI_Controller {

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
			if($this->session->userdata("rol")=="CAJA"){
				redirect(base_url('caja'));
			}
		}
		$this->load->model(array('rendicion/rendicion_model','principal/principal_model','mantenimiento/persona_model'));
 		$this->load->library(array('session','form_validation'));
 		$this->load->helper(array('url','form'));
		 $this->load->database('default');
		 
	}
	
	
	public function index()
	{	
		$datos["datos"]=$this->rendicion_model->mostrar();
		$datos['notificaciones']=$this->rendicion_model->rendiciones_web();
		$this->load->view('layout/header',$datos);
		$this->load->view('rendicion/egresos_por_rendir',$datos);
		$this->load->view('layout/footer');
	}
	
	public function listado_detalle($id)
	{
		$datos['notificaciones']=$this->rendicion_model->rendiciones_web();
		$datos["datos"]=$this->rendicion_model->mostrar_persona_detalle($id);
		$this->load->view('layout/header',$datos);
		$this->load->view('rendicion/egresos_por_rendir_detalle',$datos);
		$this->load->view('layout/footer');
	}

	public function egresos_rendidos()
	{
		$datos["datos"]=$this->rendicion_model->mostrar_egresos_rendidos();
		
		$datos['notificaciones']=$this->rendicion_model->rendiciones_web();
		$this->load->view('layout/header',$datos);
		$this->load->view('rendicion/egresos_rendidos',$datos);
		$this->load->view('layout/footer');
	}

	public function web()
	{
		$datos["datos"]=$this->rendicion_model->rendiciones_web();
		
		$datos['notificaciones']=$this->rendicion_model->rendiciones_web();
		$this->load->view('layout/header',$datos);
		$this->load->view('rendicion/web',$datos);
		$this->load->view('layout/footer');
	}

	public function suma()
	{
		$detalles="";
		$suma=0;
		$id=$this->input->post('id_persona');
		$dataa=$this->input->post('select');
		$iparr = explode ("_", $dataa[1]); 
		for($i=0;$i<count($dataa);$i++){
			$iparr = explode ("_", $dataa[$i]); 
			$suma+=$iparr[1];
			$detalles.=$iparr[0]."_";
		}
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
		$data["datos"]=$this->rendicion_model->mostrar_detalle_id_suma($id);
		$data['notificaciones']=$this->rendicion_model->rendiciones_web();
		$data['suma']=$suma;
		$data['seleccionados']=$detalles;
		$this->load->view('layout/header',$data);
		$this->load->view('rendicion/rendicion_suma',$data);
		$this->load->view('layout/footer');
	}

	public function web_detalle($id)
	{
		$datos["datos"]=$this->rendicion_model->rendiciones_web_detalle($id);
		
		$datos['notificaciones']=$this->rendicion_model->rendiciones_web();
		$this->load->view('layout/header',$datos);
		$this->load->view('rendicion/web_detalle',$datos);
		$this->load->view('layout/footer');
	}

	public function egresos_rendidos_detalle($id)
	{
		$datos["datos"]=$this->rendicion_model->mostrar_egresos_rendidos_listado($id);
		
		$datos['notificaciones']=$this->rendicion_model->rendiciones_web();
		$this->load->view('layout/header',$datos);
		$this->load->view('rendicion/egresos_rendidos_detalle',$datos);
		$this->load->view('layout/footer');
	}
	
	public function registrar($id)
	{
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
		$data["datos"]=$this->rendicion_model->mostrar_detalle_id($id);
		$data['notificaciones']=$this->rendicion_model->rendiciones_web();
		$this->load->view('layout/header',$data);
		$this->load->view('rendicion/registrar',$data);
		$this->load->view('layout/footer');
	}

	public function editar($id_rendicion)
	{
		$data['clientes'] = $this->principal_model->mostrar_cliente();
		$data['clasificaciones'] = $this->principal_model->mostrar_clasificacion();
		$data['gerencias'] = $this->principal_model->mostrar_gerencia();
		$data['areas'] = $this->principal_model->mostrar_area();
		$data['sub_areas'] = $this->principal_model->mostrar_sub_area();
		$data['tipos_actividad'] = $this->principal_model->mostrar_tipo_actividad();
		$data['comprobantes']=	$this->principal_model->mostrar_comprobante();
		$data['personas']=	$this->persona_model->mostrar();
		$data['proyectos']=	$this->principal_model->mostrar();
		$data["datos"]=$this->rendicion_model->mostrar_detalle_id($id_rendicion);
		//$data["rendicion"]=$this->rendicion_model->mostrar_por_id($id_rendicion);
		$data["detalles_rendicion"]=$this->rendicion_model->mostrar_detalle_por_id($id_rendicion);
		
		$data['notificaciones']=$this->rendicion_model->rendiciones_web();
		$this->load->view('layout/header',$data);
		$this->load->view('rendicion/editar',$data);
		$this->load->view('layout/footer');
	}

	function rendicion_suma(){
		$this->form_validation->set_rules('id_autoriza','id_autoriza', 'required');
		
		if($this->form_validation->run() == FALSE)
		{
			echo 'Uno o varios campos son obligatorios.';
			//sleep(3); //TEST DE TIEMPO DE RESPUESTA
		}
		else{
			$detalles=$this->input->post('id_detalle_caja');
			$filas=$this->input->post('precio');			
			$detalle=explode ("_", $detalles); 
			$datos=round((count($filas))/(count($detalle)-1));
			for($i=0;$i<count($detalle) - 1 ;$i++){
				$inicio=$i*$datos;
				$fin=(($i+1)*$datos)-1;
				if($qid = $this->rendicion_model->rendicion_add_suma($detalle[$i],$inicio,$fin))
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
	
	function rendicion_add(){

		//$this->form_validation->set_rules('total','total', 'required');
		$this->form_validation->set_rules('id_autoriza','id_autoriza', 'required');
		
		if($this->form_validation->run() == FALSE)
		{
			echo 'Uno o varios campos son obligatorios.';
			//sleep(3); //TEST DE TIEMPO DE RESPUESTA
		}
		else
		{
			if($qid = $this->rendicion_model->rendicion_add())
			{
				echo 'si_'.$qid;
			}
			else
			{
				echo 'Error en el registro. Comunicate con el administrador.';
			}
		}
	}

	function rendicion_edit(){

		$this->form_validation->set_rules('id_autoriza','id_autoriza', 'required');
		
		if($this->form_validation->run() == FALSE)
		{
			echo 'Uno o varios campos son obligatorios.';
			//sleep(3); //TEST DE TIEMPO DE RESPUESTA
		}
		else
		{
			if($qid = $this->rendicion_model->rendicion_edit())
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