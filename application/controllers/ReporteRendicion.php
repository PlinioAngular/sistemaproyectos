<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReporteRendicion extends CI_Controller {

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
			if($this->session->userdata("rol")=="rendicion"){
				redirect(base_url('rendicion'));
			}
		}
		$this->load->model(array('rendicion/rendicion_model','rendicion/reporte_model'));
 		$this->load->library(array('session','form_validation','encryption'));
 		$this->load->helper(array('url','form'));
		 $this->load->database('default');
		 $this->encryption->initialize(array('driver' => 'mcrypt'));	 
	}
	
	
	public function index()
	{	
        $datos['notificaciones']=$this->rendicion_model->rendiciones_web();
        $datos['estado']=5;
		$this->load->view('layout/header',$datos);
		$this->load->view('reporte/rendicion_vuelto',$datos);
		$this->load->view('layout/footer');
    }

    public function descuento()
	{	
        $datos['notificaciones']=$this->rendicion_model->rendiciones_web();
        $datos['estado']=6;
		$this->load->view('layout/header',$datos);
		$this->load->view('reporte/rendicion_vuelto',$datos);
		$this->load->view('layout/footer');
    }

    public function saldo()
	{	
        $datos['notificaciones']=$this->rendicion_model->rendiciones_web();
        $datos['estado']=4;
		$this->load->view('layout/header',$datos);
		$this->load->view('reporte/rendicion_vuelto',$datos);
		$this->load->view('layout/footer');
    }

    public function reposicion()
	{	
        $datos['notificaciones']=$this->rendicion_model->rendiciones_web();
        $datos['estado']=3;
		$this->load->view('layout/header',$datos);
		$this->load->view('reporte/rendicion_vuelto',$datos);
		$this->load->view('layout/footer');
    }

    public function devolucion()
	{	
        $datos['notificaciones']=$this->rendicion_model->rendiciones_web();
        $datos['estado']=7;
		$this->load->view('layout/header',$datos);
		$this->load->view('reporte/rendicion_vuelto',$datos);
		$this->load->view('layout/footer');
    }

    public function banco()
	{	
        $datos['notificaciones']=$this->rendicion_model->rendiciones_web();
		$this->load->view('layout/header',$datos);
		$this->load->view('reporte/banco',$datos);
		$this->load->view('layout/footer');
    }

    public function ajax(){
		$data= $this->reporte_model->mostrar();
		$pasar=array();
		$i=0;
		foreach($data as $rendicion){
			$pasar[$i][0]=date('Y-m-d',strtotime($rendicion->fecha_registro));;
            $pasar[$i][1]=$rendicion->periodo;
            $pasar[$i][2]=$rendicion->monto;
			$pasar[$i][3]=$rendicion->moneda;			
			$pasar[$i][4]=$rendicion->apellido_paterno.' '.$rendicion->apellido_materno.' '.$rendicion->nombres;
			$pasar[$i][5]=$rendicion->detalle;
			$pasar[$i][6]=$rendicion->nombre_proyecto;
			$pasar[$i][7]=$rendicion->id_detalle_caja;
			$pasar[$i][8]=$rendicion->ModoRendicion;
			$pasar[$i][9]=$rendicion->bloque;
			$i ++;
		}
		$respuesta= array(    
			'data'=>  $pasar);
		echo json_encode($respuesta);
    }

    public function ajax_banco(){
		$data= $this->reporte_model->banco_reporte();
		$pasar=array();
		$i=0;
		foreach($data as $rendicion){
			$pasar[$i][0]=$rendicion->banco;
            $pasar[$i][1]=$rendicion->empresa;
            $pasar[$i][2]=$rendicion->monto_soles;
            $pasar[$i][3]=$rendicion->monto_dolares;	
            $i ++;
		}
		$respuesta= array(    
			'data'=>  $pasar);
		echo json_encode($respuesta);
    }
    
}