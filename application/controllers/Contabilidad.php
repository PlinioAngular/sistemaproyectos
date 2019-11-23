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
		$this->load->model(array('mantenimiento/cuenta_model','proyecto/proyecto_model',
		'mantenimiento/tipo_operacion_model','mantenimiento/comprobante_model','rendicion/compra_venta_model'));
 		$this->load->library(array('session','form_validation'));
 		$this->load->helper(array('url','form'));
 		$this->load->database('default');
	}
	public function index(){
		$this->load->view('layout/header');
		$this->load->view('contabilidad/compraventa/listado');
		$this->load->view('layout/footer');
	}

	public function ajax(){ 
		$data= $this->compra_venta_model->mostrar();
		$pasar=array();
		$i=0;
		foreach($data as $dato){
			$pasar[$i][0]=$dato->id_compra_venta;
			$pasar[$i][1]=$dato->tipo_registro;
			$pasar[$i][2]=$dato->total;
			$pasar[$i][3]=$dato->estado;
			$pasar[$i][4]='<button aria-expanded="false" aria-haspopup="true" class="btn btn dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton1" type="button">Opción</button>
			<div aria-labelledby="dropdownMenuButton1" class="dropdown-menu">
			<a class="dropdown-item" href="'. base_url('contabilidad/editar/').md5($dato->id_compra_venta).'" >Editar</a><a class="dropdown-item" href="#">Dar de Baja</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="#">Eliminar</a>
			</div>';
			$i ++;
		}
		$respuesta= array(    
			'data'=>  $pasar);
		echo json_encode($respuesta);
	}

	public function ajaxDocumentos(){ 
		$data= $this->compra_venta_model->mostrar();
		$pasar=array();
		$i=0;
		foreach($data as $dato){
			$pasar[$i][0]=date("y-m-d",strtotime($dato->fecha_emision));
			$pasar[$i][1]=date("y-m-d",strtotime($dato->fecha_emision));
			$pasar[$i][2]=date("y-m-d",strtotime($dato->fecha_vencimiento));
			$pasar[$i][3]=$dato->id_comprobante;
			$pasar[$i][4]=$dato->serie.'-'.$dato->numero;
			$pasar[$i][5]=$dato->total;
			$pasar[$i][6]='<input type="checkbox" name="select" id="select">';
			$i ++;
		}
		$respuesta= array(    
			'data'=>  $pasar);
		echo json_encode($respuesta);
	}

	public function registrar(){
		$datos['operaciones']=$this->tipo_operacion_model->mostrar();
		$datos['cuentas']=$this->cuenta_model->mostrar();
		$datos['comprobantes']=$this->comprobante_model->mostrar();
		$datos['proyectos']=$this->proyecto_model->mostrar_cc();
		$this->load->view('layout/header');
		$this->load->view('contabilidad/compraventa/compraventa',$datos);
		$this->load->view('layout/footer');
	}

	public function editar($id){
		$datos['operaciones']=$this->tipo_operacion_model->mostrar();
		$datos['cuentas']=$this->cuenta_model->mostrar();
		$datos['comprobantes']=$this->comprobante_model->mostrar();
		$datos['compraventa']=$this->compra_venta_model->mostrar_por_id($id);
		$datos['detalles']=$this->compra_venta_model->mostrar_detalle_por_id($id);
		$this->load->view('layout/header');
		$this->load->view('contabilidad/compraventa/editar',$datos);
		$this->load->view('layout/footer');
	}


    public function caja_banco(){
		$datos['operaciones']=$this->tipo_operacion_model->mostrar();
		$datos['cuentas']=$this->cuenta_model->mostrar();
		$datos['comprobantes']=$this->comprobante_model->mostrar();
		$datos['proyectos']=$this->proyecto_model->mostrar_cc();
		$this->load->view('layout/header');
		$this->load->view('contabilidad/cajabanco',$datos);
		$this->load->view('layout/footer');
	}
	
	function compra_add(){

		//$this->form_validation->set_rules('total','total', 'required');
		$this->form_validation->set_rules('tipo_registro','tipo_registro', 'required');
		$this->form_validation->set_rules('tipo_operacion','tipo_operacion', 'required');
		$this->form_validation->set_rules('cuo','cuo', 'required');
		$this->form_validation->set_rules('periodo','periodo', 'required');
		$this->form_validation->set_rules('fecha_registro','fecha_registro', 'required');
		$this->form_validation->set_rules('fecha_emision','fecha_emision', 'required');
		$this->form_validation->set_rules('fecha_vencimiento','fecha_vencimiento', 'required');
		$this->form_validation->set_rules('comprobante','comprobante', 'required');
		$this->form_validation->set_rules('serie','serie', 'required');
		$this->form_validation->set_rules('numero','numero', 'required');
		$this->form_validation->set_rules('moneda','moneda', 'required');
		$this->form_validation->set_rules('tipo_cambio','tipo_cambio', 'required');
		$this->form_validation->set_rules('sub_total','sub_total', 'required');
		$this->form_validation->set_rules('igv','igv', 'required');
		$this->form_validation->set_rules('gravada','gravada', 'required');
		$this->form_validation->set_rules('isc','isc', 'required');
		$this->form_validation->set_rules('total','total', 'required');
		$this->form_validation->set_rules('glosa','glosa', 'required');
		$this->form_validation->set_rules('num_detraccion','num_detraccion', 'required');		
		$this->form_validation->set_rules('fecha_detraccion','fecha_detraccion', 'required');
		$this->form_validation->set_rules('cod_detraccion','cod_detraccion', 'required');
		$this->form_validation->set_rules('monto_detraccion','monto_detraccion', 'required');
		$this->form_validation->set_rules('id_cuenta[]','id_cuenta[]', 'required');
		$this->form_validation->set_rules('debe[]','debe[]', 'required');
		$this->form_validation->set_rules('haber[]','haber[]', 'required');
		
		if($this->form_validation->run() == FALSE)
		{
			echo 'Verifique que todo los campos estén llenados de manera adecuada.';
			//sleep(3); //TEST DE TIEMPO DE RESPUESTA
		}
		else
		{
			if($qid = $this->compra_venta_model->compra_add())
			{
				echo 'si_'.$qid;
			}
			else
			{
				echo 'Error en el registro. Comunicate con el administrador.';
			}
		}
	}
	function compra_edit(){

		$this->form_validation->set_rules('tipo_registro','tipo_registro', 'required');
		$this->form_validation->set_rules('tipo_operacion','tipo_operacion', 'required');
		$this->form_validation->set_rules('cuo','cuo', 'required');
		$this->form_validation->set_rules('periodo','periodo', 'required');
		$this->form_validation->set_rules('fecha_registro','fecha_registro', 'required');
		$this->form_validation->set_rules('fecha_emision','fecha_emision', 'required');
		$this->form_validation->set_rules('fecha_vencimiento','fecha_vencimiento', 'required');
		$this->form_validation->set_rules('comprobante','comprobante', 'required');
		$this->form_validation->set_rules('serie','serie', 'required');
		$this->form_validation->set_rules('numero','numero', 'required');
		$this->form_validation->set_rules('moneda','moneda', 'required');
		$this->form_validation->set_rules('tipo_cambio','tipo_cambio', 'required');
		$this->form_validation->set_rules('sub_total','sub_total', 'required');
		$this->form_validation->set_rules('igv','igv', 'required');
		$this->form_validation->set_rules('gravada','gravada', 'required');
		$this->form_validation->set_rules('isc','isc', 'required');
		$this->form_validation->set_rules('total','total', 'required');
		$this->form_validation->set_rules('glosa','glosa', 'required');
		$this->form_validation->set_rules('num_detraccion','num_detraccion', 'required');		
		$this->form_validation->set_rules('fecha_detraccion','fecha_detraccion', 'required');
		$this->form_validation->set_rules('cod_detraccion','cod_detraccion', 'required');
		$this->form_validation->set_rules('monto_detraccion','monto_detraccion', 'required');
		$this->form_validation->set_rules('id_cuenta[]','id_cuenta[]', 'required');
		$this->form_validation->set_rules('debe[]','debe[]', 'required');
		$this->form_validation->set_rules('haber[]','haber[]', 'required');
		
		if($this->form_validation->run() == FALSE)
		{
			echo 'Verifique que todo los camos estén llenados de manera adecuada.';
			//sleep(3); //TEST DE TIEMPO DE RESPUESTA
		}
		else
		{
			if($qid = $this->compra_venta_model->compra_venta_edit())
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