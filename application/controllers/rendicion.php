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
		$datos['notificaciones']=$this->rendicion_model->rendiciones_web();
		$this->load->view('layout/header',$datos);
		$this->load->view('rendicion/egresos_por_rendir');
		$this->load->view('layout/footer');
	}

	public function ajax(){ 
		$data= $this->rendicion_model->mostrar();
		$pasar=array();
		$i=0;
		foreach($data as $dato){
			$pasar[$i][0]=$dato->apellido_paterno.' '.$dato->apellido_paterno.' '.$dato->nombres;
			$pasar[$i][1]=$dato->total;
			$pasar[$i][2]='<a href="'. base_url('rendicion/listado_detalle/').$dato->id_persona.'" class="btn btn-info btn-circle btn-sm">
			<i class="far fa-eye"></i></a>';
			$i ++;
		}
		$respuesta= array(    
			'data'=>  $pasar);
		echo json_encode($respuesta);
	}
	
	public function listado_detalle($id)
	{
		$datos['notificaciones']=$this->rendicion_model->rendiciones_web();
		$datos["id"]=$id;
		$this->load->view('layout/header',$datos);
		$this->load->view('rendicion/egresos_por_rendir_detalle',$datos);
		$this->load->view('layout/footer');
	}

	public function ajax_detalle(){ 
		$data= $this->rendicion_model->mostrar_persona_detalle($this->input->post('id'));
		$pasar=array();
		$i=0;
		foreach($data as $dato){
			$pasar[$i][0]='<input name="select[]" class="form-control" type="checkbox" value="'.$dato->id_detalle_caja.'_'.$dato->total.'"  ><input type="hidden" name="id_persona" value="'.$dato->id_persona.'">';
			$pasar[$i][1]=$dato->apellido_paterno.' '.$dato->apellido_paterno.' '.$dato->nombres;
			$pasar[$i][2]=$dato->total;
			$pasar[$i][3]='<a href="'. base_url('rendicion/registrar/').$dato->id_detalle_caja.'" class="btn btn-info btn-circle btn-sm">
			<i class="far fa-eye"></i></a>';
			$i ++;
		}
		$respuesta= array(    
			'data'=>  $pasar);
		echo json_encode($respuesta);
	}

	public function egresos_rendidos()
	{
		$datos['notificaciones']=$this->rendicion_model->rendiciones_web();
		$this->load->view('layout/header',$datos);
		$this->load->view('rendicion/egresos_rendidos');
		$this->load->view('layout/footer');
	}

	public function ajax_rendidos(){ 
		$data= $this->rendicion_model->mostrar_egresos_rendidos();
		$pasar=array();
		$i=0;
		foreach($data as $dato){
			$pasar[$i][0]=$dato->apellido_paterno.' '.$dato->apellido_paterno.' '.$dato->nombres;
			$pasar[$i][1]=$dato->egreso;
			$pasar[$i][2]=$dato->rendido;
			$pasar[$i][3]=$dato->saldo;
			$pasar[$i][4]='<a href="'. base_url('rendicion/egresos_rendidos_detalle/').$dato->id_persona.'" class="btn btn-info btn-circle btn-sm">
			<i class="far fa-eye"></i></a>';
			$i ++;
		}
		$respuesta= array(    
			'data'=>  $pasar);
		echo json_encode($respuesta);
	}

	public function egresos_rendidos_detalle($id)
	{
		$datos['id']=$id;
		$datos['notificaciones']=$this->rendicion_model->rendiciones_web();
		$this->load->view('layout/header',$datos);
		$this->load->view('rendicion/egresos_rendidos_detalle',$datos);
		$this->load->view('layout/footer');
	}

	public function ajax_rendidos_detalle(){ 
		$data= $this->rendicion_model->mostrar_egresos_rendidos_listado($this->input->post('id'));
		$pasar=array();
		$i=0;
		foreach($data as $dato){
			$pasar[$i][0]=$dato->apellido_paterno.' '.$dato->apellido_paterno.' '.$dato->nombres;
			$pasar[$i][1]=$dato->egreso;
			$pasar[$i][2]=$dato->rendido;
			$pasar[$i][3]=$dato->saldo;
			if($dato->estado==0){ 
			$pasar[$i][4]='<a href="'. base_url('rendicion/registrar/').$dato->id_detalle_caja.'" class="btn btn-info btn-circle btn-sm">
			<i class="far fa-eye"></i>';
			} else {  
				$pasar[$i][4]='<a href="'. base_url('rendicion/editar/').$dato->id_detalle_caja.'" class="btn btn-info btn-circle btn-sm">
				<i class="fas fa-edit"></i>';
			}
			$i ++;
		}
		$respuesta= array(    
			'data'=>  $pasar);
		echo json_encode($respuesta);
	}

	public function web()
	{
		$datos['notificaciones']=$this->rendicion_model->rendiciones_web();
		$this->load->view('layout/header',$datos);
		$this->load->view('rendicion/web');
		$this->load->view('layout/footer');
	}

	public function ajax_web(){ 
		$data= $this->rendicion_model->rendiciones_web();
		$pasar=array();
		$i=0;
		foreach($data as $dato){
			$pasar[$i][0]=$dato->apellido_paterno.' '.$dato->apellido_paterno.' '.$dato->nombres;
			$pasar[$i][1]=$dato->egreso;
			$pasar[$i][2]=$dato->rendido;
			$pasar[$i][3]=$dato->saldo;
			$pasar[$i][4]='<a href="'. base_url('rendicion/web_detalle/').$dato->id_persona.'" class="btn btn-info btn-circle btn-sm">
			<i class="far fa-eye"></i></a>';
			$i ++;
		}
		$respuesta= array(    
			'data'=>  $pasar);
		echo json_encode($respuesta);
	}

	public function web_detalle($id)
	{
		$datos["id"]=$id;
		
		$datos['notificaciones']=$this->rendicion_model->rendiciones_web();
		$this->load->view('layout/header',$datos);
		$this->load->view('rendicion/web_detalle',$datos);
		$this->load->view('layout/footer');
	}

	public function ajax_web_detalle(){ 
		$data= $this->rendicion_model->rendiciones_web_detalle($this->input->post('id'));
		$pasar=array();
		$i=0;
		foreach($data as $dato){
			if($dato->vb=="SI"){
				$pasar[$i][0]=$dato->vb.'<input type="hidden" name="vb[]" value="'.$dato->vb.'"><input type="hidden" name="id_detalle_caja[]" value="'.$dato->id_detalle_caja.'"><input type="hidden"  name="id_rendicion[]" value="'.$dato->id_rendicion.'">';
			}else{
				$pasar[$i][0]=$dato->vb;
			}			
			$pasar[$i][1]=$dato->apellido_paterno.' '.$dato->apellido_paterno.' '.$dato->nombres;
			$pasar[$i][2]=$dato->egreso;
			$pasar[$i][3]=$dato->rendido;
			$pasar[$i][4]=$dato->saldo;			
			$pasar[$i][5]='<a href="'. base_url('rendicion/editar/').$dato->id_detalle_caja.'" class="btn btn-info btn-circle btn-sm">
				<i class="fas fa-edit"></i>';
			
			$i ++;
		}
		$respuesta= array(    
			'data'=>  $pasar);
		echo json_encode($respuesta);
	}

	function guardar_estado(){
		$cont=0;
		$id_detalle_caja=$this->input->post('id_detalle_caja');
		$id_rendicion=$this->input->post('id_rendicion');
		$bloque=$this->rendicion_model->setBloque();
		for($i=0;$i<$id_detalle_caja;$i++){
			
			$this->rendicion_model->cambio_fecha($id_rendicion[$i],$bloque);
		
		if($this->rendicion_model->cambio_estado($id_detalle_caja[$i]))
			{
				$cont++;
			}
			
		}
		if($cont>0){
			echo "si_".$cont;

		}
		else{
			echo "Error al actualizar";
		}
	}

	public function suma()
	{
		if($this->input->post('select')){
			$detalles="";
			$suma=0;
			$id=$this->input->post('id_persona');
						
				$dataa=$this->input->post('select');
			if(count($dataa)!=1){	
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
			else{
				echo "<script>alert('No debe sumar solo un monto');</script>";
			$this->listado_detalle($this->input->post('id_persona'));
			}
		}else {
			echo "<script>alert('No seleccionó monto');</script>";
			$this->listado_detalle($this->input->post('id_persona'));
		}
	}
	
	public function bloque(){
		
			$datos = $this->principal_model->mostrar_cliente();
		
		echo json_encode($datos);
	}
	public function completa(){
		$datos['proyectos'] = $this->principal_model->mostrar();
		$this->load->view('layout/header');
		$this->load->view('layout/completa',$datos);
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
		$this->form_validation->set_rules('fechas[]','fechas[]', 'required');
		$this->form_validation->set_rules('periodos[]','periodos[]', 'required');
		$this->form_validation->set_rules('rud[]','ruc[]', 'required');
		$this->form_validation->set_rules('comprobantes[]','comprobantes[]', 'required');
		$this->form_validation->set_rules('serie[]','serie[]', 'required');
		$this->form_validation->set_rules('numero[]','numero[]', 'required');
		$this->form_validation->set_rules('proyectos[]','proyectos[]', 'required');
		$this->form_validation->set_rules('clasificaciones[]','clasificaciones[]', 'required');
		$this->form_validation->set_rules('tipo_actividad[]','tipo_actividad[]', 'required');
		$this->form_validation->set_rules('detalles[]','detalles[]', 'required');
		$this->form_validation->set_rules('cantidad[]','cantidad[]', 'required');
		$this->form_validation->set_rules('precio[]','precio[]', 'required');
		
		if($this->form_validation->run() == FALSE)
		{
			echo 'Verifique que todo los camos estén llenados de manera adecuada.';
			//sleep(3); //TEST DE TIEMPO DE RESPUESTA
		}
		else{
			$bloque=$this->rendicion_model->setBloque();
			$detalles=$this->input->post('id_detalle_caja');
			$filas=$this->input->post('precio');			
			$detalle=explode ("_", $detalles); 
			$datos=round((count($filas))/(count($detalle)-1));
			for($i=0;$i<count($detalle) - 1 ;$i++){
				$inicio=$i*$datos;
				$fin=(($i+1)*$datos)-1;
				if($qid = $this->rendicion_model->rendicion_add_suma($detalle[$i],$inicio,$fin,$bloque))
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
		$this->form_validation->set_rules('id_autoriza','id_autoriza', 'required|numeric');
		$this->form_validation->set_rules('fechas[]','fechas[]', 'required');
		$this->form_validation->set_rules('periodos[]','periodos[]', 'required');
		$this->form_validation->set_rules('rud[]','ruc[]', 'required|numeric');
		$this->form_validation->set_rules('comprobantes[]','comprobantes[]', 'required');
		$this->form_validation->set_rules('serie[]','serie[]', 'required');
		$this->form_validation->set_rules('numero[]','numero[]', 'required');
		$this->form_validation->set_rules('proyectos[]','proyectos[]', 'required');
		$this->form_validation->set_rules('clasificaciones[]','clasificaciones[]', 'required');
		$this->form_validation->set_rules('tipo_actividad[]','tipo_actividad[]', 'required');
		$this->form_validation->set_rules('detalles[]','detalles[]', 'required');
		$this->form_validation->set_rules('cantidad[]','cantidad[]', 'required');
		$this->form_validation->set_rules('precio[]','precio[]', 'required|decimal');
		if($this->form_validation->run() == FALSE)
		{
			echo 'Verifique que todo los camos estén llenados de manera adecuada.';
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
		$this->form_validation->set_rules('fechas[]','fechas[]', 'required');
		$this->form_validation->set_rules('periodos[]','periodos[]', 'required');
		$this->form_validation->set_rules('rud[]','ruc[]', 'required');
		$this->form_validation->set_rules('comprobantes[]','comprobantes[]', 'required');
		$this->form_validation->set_rules('serie[]','serie[]', 'required');
		$this->form_validation->set_rules('numero[]','numero[]', 'required');
		$this->form_validation->set_rules('proyectos[]','proyectos[]', 'required');
		$this->form_validation->set_rules('clasificaciones[]','clasificaciones[]', 'required');
		$this->form_validation->set_rules('tipo_actividad[]','tipo_actividad[]', 'required');
		$this->form_validation->set_rules('detalles[]','detalles[]', 'required');
		$this->form_validation->set_rules('cantidad[]','cantidad[]', 'required');
		$this->form_validation->set_rules('precio[]','precio[]', 'required');
		
		if($this->form_validation->run() == FALSE)
		{
			echo 'Verifique que todo los camos estén llenados de manera adecuada.';
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

	function agregar_detalle(){
		$this->form_validation->set_rules('id_autoriza','id_autoriza', 'required');
		$id_rendicion=$this->input->post('id_rendicion');
		if($this->form_validation->run() == false)
		{
			echo 'Verifique que todo los camos estén llenados de manera adecuada.';
			//sleep(3); //TEST DE TIEMPO DE RESPUESTA
		}
		else
		{
			if($qid = $this->rendicion_model->add_detalle())
			{
				echo 'si_'.$qid;
			}
			else
			{
				echo 'Error en el registro. Comunicate con el administrador.';
			}
		}

	}
	function eliminar_detalle(){
		$this->form_validation->set_rules('id_autoriza','id_autoriza', 'required');
		$id_rendicion=$this->input->post('id_eliminar');
		if($this->form_validation->run() == false)
		{
			echo 'Verifique que todo los camos estén llenados de manera adecuada.';
			//sleep(3); //TEST DE TIEMPO DE RESPUESTA
		}
		else
		{
			if($this->rendicion_model->eliminar_detalle())
			{
				echo 'si_'.$id_rendicion;
			}
			else
			{
				echo 'Error en el registro. Comunicate con el administrador.';
			}
		}

	}
}