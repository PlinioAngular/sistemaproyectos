<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Requerimiento_model extends CI_Model {
 
 public function __construct() {
 parent::__construct();
 }
 
 public function mostrar()
 {
    $this->db->select('r.id_requerimiento,r.total,p.apellido_paterno,p.apellido_materno,p.nombres,pr.nombre_proyecto,r.fecha,r.estado');
    $this->db->from("tbl_requerimiento as r");
    $this->db->join("tbl_persona as p ","r.id_solicita=p.id_persona");
    $this->db->join("tbl_proyecto as pr ","pr.id_proyecto=r.id_proyecto");
    $query=$this->db->get();      
 	return $query->result();
 }

 public function mostrar_por_id($id)
 {
   $this->db->select('ca.id_requerimiento,ba.id_banco,ba.banco,em.id_empresa,em.empresa,
    r.id_persona as id_res,r.nombres as nom_res,r.apellido_materno as am_res,r.apellido_paterno as ap_res,
    b.id_persona as id_ben,b.nombres as nom_ben,b.apellido_materno as am_ben,b.apellido_paterno as ap_ben,
    au.id_persona as id_aut,au.nombres as nom_aut,au.apellido_materno as am_aut,au.apellido_paterno as ap_aut,
    rg.id_persona as id_reg,rg.nombres as nom_reg,rg.apellido_materno as am_reg,rg.apellido_paterno as ap_reg,
    ca.moneda,ca.tipo,ca.egreso,ca.ingreso ');
    $this->db->from("tbl_requerimiento as ca");
    $this->db->where('md5(ca.id_requerimiento)',$id);
    $this->db->join("tbl_banco as ba ","ca.id_banco=ba.id_banco");
    $this->db->join("tbl_empresa as em ","em.id_empresa=ba.id_empresa");
    $this->db->join("tbl_persona as r ","ca.id_responsable=r.id_persona");
    $this->db->join("tbl_persona as b ","ca.id_beneficiario=b.id_persona");
    $this->db->join("tbl_persona as au ","ca.id_autoriza=au.id_persona");
    $this->db->join("tbl_persona as rg ","ca.id_registra=rg.id_persona"); 
    return $this->db->get()->row();
 }

 public function mostrar_detalle_por_id($id)
 {
   $this->db->select('dc.id_detalle_requerimiento,dc.periodo,dc.fecha,pr.id_proyecto,pr.nombre_proyecto,dc.lugar,dc.monto,
   dc.detalle,cla.id_clasificacion,cla.clasificacion');
    $this->db->from("tbl_detalle_requerimiento as dc");
    $this->db->where('md5(dc.id_requerimiento)',$id);
    $this->db->join("tbl_proyecto as pr ","pr.id_proyecto=dc.id_proyecto");
    $this->db->join("tbl_clasificacion as cla ","cla.id_clasificacion=dc.id_clasificacion");
    $query=$this->db->get();      
 	return $query->result();
 }

 public function mostrar_cliente()
 {
 	$this->db->select('*');
    $this->db->from("tbl_cliente");
    $query=$this->db->get();      
 	return $query->result();
 }
 public function mostrar_gerencia()
 {
 	$this->db->select('*');
    $this->db->from("tbl_gerencia");
    $query=$this->db->get();      
 	return $query->result();
 }
 public function mostrar_area()
 {
 	$this->db->select('*');
    $this->db->from("tbl_area");
    $query=$this->db->get();      
 	return $query->result();
 }
 public function mostrar_sub_area()
 {
 	$this->db->select('*');
    $this->db->from("tbl_sub_area");
    $query=$this->db->get();      
 	return $query->result();
 }
 public function mostrar_tipo_actividad()
 {
 	$this->db->select('*');
    $this->db->from("tbl_tipo_actividad");
    $query=$this->db->get();      
 	return $query->result();
 }

 function requerimiento_add(){
    
    $fecha_inicio=$this->input->post('fecha_inicio');
    $fecha_fin=$this->input->post('fecha_fin');
    $dni=$this->input->post('dni');
    $datos=$this->input->post('datos');
    $dias=$this->input->post('dias');
    $precio=$this->input->post('precio');
    $descripcion=$this->input->post('descripcion');
   $detalle = array(
      'id_autoriza' => $this->input->post('id_autoriza'),
      'id_solicita' =>$this->session->userdata('id'),
      'id_responsable' => $this->input->post('id_responsable'),
      'id_proyecto' => $this->input->post('id_proyecto'),
      'total' => $this->input->post('total'),
      'fecha' => date("Y/m/d"),
      'id_empresa' => $this->input->post('id_empresa'),
      'periodo' => '10-2019',
      'estado' => 'SOLICITADO'
   );

   if(!$this->db->table_exists('tbl_requerimiento')){ //VALIDA SI EXISTE LA TABLA
      return false;
   }
   if(count($montos)>0){
   $insert_fun = $this->db->insert('tbl_requerimiento',$detalle);
   $insert_id = $this->db->insert_id();
   if($insert_id){
      $insert_id1=$this->add_detalle_requerimiento($insert_id,$fecha_inicio,$fecha_fin,$dni,$datos,$dias,$precio,$descripcion);
   }
   return $insert_id;
}
else { return false;}
}

function add_detalle_requerimiento($id_requerimiento,$fecha_inicio,$fecha_fin,$dni,$datos,$dias,$precio,$descripcion){
   $insert_id=0;
   for($i=0;$i<count($fecha_inicio);$i++){
   $data = array(
      'id_requerimiento' => $id_requerimiento,
      'fecha_inico' => $fecha_inicio[$i],
      'fecha_fin' => $fecha_fin[$i],
      'dni' => $dni[$i],
      'cargo' => 'c',
      'zona' => 'b',
      'datos_trabajador' => $datos[$i],
      'cantidad' => $dias[$i],
      'precio' => $precio[$i],
      'descripcion' => $descripcion[$i]
   );

   if(!$this->db->table_exists('tbl_detalle_requerimiento')){ //VALIDA SI EXISTE LA TABLA
      return false;
   }
   
   $insert_fun = $this->db->insert('tbl_detalle_requerimiento',$data);
   $insert_id = $this->db->insert_id();
   
   
}
return $insert_id;

}

function requerimiento_edit(){
   $moneda_anterior=$this->input->post('moneda_anterior');
   $banco_anterior=$this->input->post('banco_anterior');
   $id_detalle=$this->input->post('id_detalle_requerimiento');
   $ingreso=$this->input->post('ingreso');
    $movimiento='egreso';
    $movimiento2='ingreso';
    if($ingreso==1){
       $movimiento='ingreso';
       $movimiento2='egreso';
    }
    $fechas=$this->input->post('fechas');
    $periodos=$this->input->post('periodos');
    $proyectos=$this->input->post('proyectos');
    $montos=$this->input->post('montos');
    $lugares=$this->input->post('lugares');
    $detalles=$this->input->post('detalles');
    $clasificaciones=$this->input->post('clasificaciones');
    $update_id2;
   $detalle = array(
      'id_autoriza' => $this->input->post('id_autoriza'),
      'id_registra' => $this->session->userdata('id'),
      'id_beneficiario' => $this->input->post('id_beneficiario'),
      'id_responsable' => $this->input->post('id_responsable'),
      'id_banco' => $this->input->post('id_banco'),
      $movimiento => $this->input->post('total'),
      $movimiento2 => 0,
      'fecha_registro' => date("Y/m/d"),
      'moneda' => $this->input->post('moneda'),
      'tipo' => $this->input->post('tipo'),
   );

   if(!$this->db->table_exists('tbl_requerimiento')){ //VALIDA SI EXISTE LA TABLA
      return false;
   }
   if(count($montos)>0){

   if($this->db->update('tbl_requerimiento',$detalle,array('id_requerimiento' => $this->input->post('id_requerimiento') ))){
      $this->edit_banco($moneda_anterior,$this->input->post('moneda'),$this->input->post('total_anterior'),$this->input->post('total'),$banco_anterior,$this->input->post('id_banco'),$this->input->post('movimiento_anterior'),$movimiento);
      $update_id2=$this->detalle_requerimiento_edit($id_detalle,$fechas,$periodos,$proyectos,$montos,$lugares,$detalles,$clasificaciones);
   } else{
      return false;
   }
   
   $update_id = $this->input->post('id_requerimiento');
   return $update_id;}
   else {
      return false;
   }
   
}
function edit_banco($moneda_anterior,$moneda,$monto_anterior,$monto,$banco_anterior,$banco,$movimiento_anterior,$movimiento){
   if($movimiento_anterior==$movimiento){ 
   if($movimiento=="ingreso"){
      $movimiento2="egreso";
   }elseif ($movimiento=="egreso") {
      $movimiento2="ingreso";
   }
   }else{
      if($movimiento=="ingreso"){
         $movimiento2="ingreso";
      }elseif ($movimiento=="egreso") {
         $movimiento2="egreso";
      }
   }

   if($banco_anterior!=$banco){
      $this->banco_egreso($banco_anterior,$moneda_anterior,$monto_anterior,$movimiento2);
      $this->banco_egreso($banco,$moneda,$monto,$movimiento);
   }elseif ($moneda_anterior!=$moneda) {
      $this->banco_egreso($banco_anterior,$moneda_anterior,$monto_anterior,$movimiento2);
      $this->banco_egreso($banco,$moneda,$monto,$movimiento);
   }elseif ($monto_anterior!=$monto) {
      $this->banco_egreso($banco_anterior,$moneda_anterior,$monto_anterior,$movimiento2);
      $this->banco_egreso($banco,$moneda,$monto,$movimiento);
   }elseif ($movimiento_anterior!=$movimiento) {
      $this->banco_egreso($banco_anterior,$moneda_anterior,$monto_anterior,$movimiento2);
      $this->banco_egreso($banco,$moneda,$monto,$movimiento);
   }

}
function banco_egreso($id_banco,$moneda,$monto,$movimiento){
   if($moneda=="SOLES"){
      $cuenta="monto_soles";
   }elseif ($moneda=="DOLARES") {
      $cuenta="monto_dolares";
   }

   if($movimiento=="ingreso"){
      $operacion="+";
   }elseif ($movimiento=="egreso") {
      $operacion="-";
   }

   if(!$this->db->table_exists('tbl_banco')){ //VALIDA SI EXISTE LA TABLA
      return false;
   }
   
   if(!$this->db->query('update tbl_banco set '.$cuenta.'='.$cuenta.$operacion.$monto.' where id_banco='.$id_banco)){
      return false;
   }
   
   $update_id = $this->input->post('id_banco');
   return $update_id;
   
}
function detalle_requerimiento_edit($id_detalle,$fecha,$periodo,$proyecto,$monto,$lugar,$detalle,$clasificacion){
      $update_id;
      for($i=0;$i<count($id_detalle);$i++){
      $data = array(
         'fecha' => $fecha[$i],
         'periodo' => $periodo[$i],
         'id_proyecto' => $proyecto[$i],
         'id_cliente' => 1,
         'id_gerencia' => 1,
         'id_area' => 1,
         'id_sub_area' => 1,
         'id_tipo_actividad' => 1,
         'monto' => $monto[$i],
         'lugar' => $lugar[$i],
         'detalle' => $detalle[$i],
         'id_clasificacion' => $clasificacion[$i]
      );

   if(!$this->db->table_exists('tbl_detalle_requerimiento')){ //VALIDA SI EXISTE LA TABLA
      return false;
   }   

   if(!$this->db->update('tbl_detalle_requerimiento',$data,array('id_detalle_requerimiento' => $id_detalle[$i] ))){
      return false;
   }
   
   $update_id = $this->input->post('id_detalle_requerimiento');}
   return $update_id;

   
}
}