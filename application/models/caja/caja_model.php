<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Caja_model extends CI_Model {
 
 public function __construct() {
 parent::__construct();
 }
 
 public function mostrar()
 {
    $this->db->select('dc.id_detalle_caja,ca.id_caja,dc.fecha,dc.periodo,p.nombre_proyecto,ba.banco,em.empresa,dc.detalle,t.tipo_actividad,
    cla.clasificacion,r.nombres as nom_res,r.apellido_materno as am_res,r.apellido_paterno as ap_res,
    b.nombres as nom_ben,b.apellido_materno as am_ben,b.apellido_paterno as ap_ben,au.nombres as nom_aut,au.apellido_materno as am_aut,au.apellido_paterno as ap_aut,
    rg.nombres as nom_reg,rg.apellido_materno as am_reg,rg.apellido_paterno as ap_reg,
    p.id_proyecto, dc.monto,dc.detalle, dc.fecha ');
    $this->db->from("tbl_detalle_caja as dc");
    $this->db->join("tbl_caja as ca ","dc.id_caja=ca.id_caja");
    $this->db->join("tbl_banco as ba ","ca.id_banco=ba.id_banco");
    $this->db->join("tbl_empresa as em ","em.id_empresa=ba.id_empresa");
    $this->db->join("tbl_persona as r ","ca.id_responsable=r.id_persona");
    $this->db->join("tbl_persona as b ","ca.id_beneficiario=b.id_persona");
    $this->db->join("tbl_persona as au ","ca.id_autoriza=au.id_persona");
    $this->db->join("tbl_persona as rg ","ca.id_registra=rg.id_persona");    
    $this->db->join("tbl_proyecto as p ","dc.id_proyecto=p.id_proyecto");
    //$this->db->join("tbl_cliente as c ","dc.id_cliente=c.id_cliente");
    //$this->db->join("tbl_gerencia as g ","dc.id_gerencia=g.id_gerencia");
    //$this->db->join("tbl_area as a ","dc.id_area=a.id_area");
    $this->db->join("tbl_clasificacion as cla ","cla.id_clasificacion=dc.id_clasificacion");
    $this->db->join("tbl_tipo_actividad as t ","dc.id_tipo_actividad=t.id_tipo_actividad");
    
    if($this->input->post('dos_fecha'))
    {
      $this->db->where("dc.fecha >=",$this->input->post('fecha_inicio'));
      $this->db->where("dc.fecha <=",$this->input->post('fecha_fin'));
    }    else{
      $this->db->where("dc.fecha",$this->input->post('fecha_inicio'));
    }
    $query=$this->db->get();      
 	return $query->result();
 }

 public function mostrar_por_id($id)
 {
   $this->db->select('ca.id_caja,ba.id_banco,ba.banco,em.id_empresa,em.empresa,
    r.id_persona as id_res,r.nombres as nom_res,r.apellido_materno as am_res,r.apellido_paterno as ap_res,
    b.id_persona as id_ben,b.nombres as nom_ben,b.apellido_materno as am_ben,b.apellido_paterno as ap_ben,
    au.id_persona as id_aut,au.nombres as nom_aut,au.apellido_materno as am_aut,au.apellido_paterno as ap_aut,
    rg.id_persona as id_reg,rg.nombres as nom_reg,rg.apellido_materno as am_reg,rg.apellido_paterno as ap_reg,
    ca.moneda,ca.tipo,ca.egreso,ca.ingreso ');
    $this->db->from("tbl_caja as ca");
    $this->db->where('ca.id_caja',$id);
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
   $this->db->select('dc.id_detalle_caja,dc.periodo,dc.fecha,pr.id_proyecto,pr.nombre_proyecto,dc.lugar,dc.monto,
   dc.detalle,cla.id_clasificacion,cla.clasificacion');
    $this->db->from("tbl_detalle_caja as dc");
    $this->db->where('dc.id_caja',$id);
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

 function caja_add(){
    $ingreso=$this->input->post('ingreso');
    $movimiento='egreso';
    if($ingreso==1){
       $movimiento='ingreso';
    }
    $fechas=$this->input->post('fechas');
    $periodos=$this->input->post('periodos');
    $proyectos=$this->input->post('proyectos');
    $montos=$this->input->post('montos');
    $lugares=$this->input->post('lugares');
    $detalles=$this->input->post('detalles');
    $clasificaciones=$this->input->post('clasificaciones');
   $detalle = array(
      'id_autoriza' => $this->input->post('id_autoriza'),
      'id_registra' =>$this->session->userdata('id'),
      'id_beneficiario' => $this->input->post('id_beneficiario'),
      'id_responsable' => $this->input->post('id_responsable'),
      'id_banco' => $this->input->post('id_banco'),
      $movimiento => $this->input->post('total'),
      'fecha_registro' => date("Y/m/d"),
      'moneda' => $this->input->post('moneda',true),
      'tipo' => $this->input->post('tipo'),
   );

   if(!$this->db->table_exists('tbl_caja')){ //VALIDA SI EXISTE LA TABLA
      return false;
   }
   if(count($montos)>0){
   $insert_fun = $this->db->insert('tbl_caja',$detalle);
   $insert_id = $this->db->insert_id();
   if($insert_id){
      $this->banco_egreso($this->input->post('id_banco'),$this->input->post('moneda'),$this->input->post('total'),$movimiento);
      $insert_id1=$this->add_detalle_caja($insert_id,$fechas,$periodos,$proyectos,$montos,$lugares,$detalles,$clasificaciones);
   }
   return $insert_id;
}
else { return false;}
}

function add_detalle_caja($id_caja,$fecha,$periodo,$proyecto,$monto,$lugar,$detalle,$clasificacion){
   $insert_id=0;
   for($i=0;$i<count($monto);$i++){
   $data = array(
      'id_caja' => $id_caja,
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

   if(!$this->db->table_exists('tbl_detalle_caja')){ //VALIDA SI EXISTE LA TABLA
      return false;
   }
   
   $insert_fun = $this->db->insert('tbl_detalle_caja',$data);
   $insert_id = $this->db->insert_id();
   
   
}
return $insert_id;

}

function caja_edit(){
   $moneda_anterior=$this->input->post('moneda_anterior');
   $banco_anterior=$this->input->post('banco_anterior');
   $id_detalle=$this->input->post('id_detalle_caja');
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

   if(!$this->db->table_exists('tbl_caja')){ //VALIDA SI EXISTE LA TABLA
      return false;
   }
   if(count($montos)>0){

   if($this->db->update('tbl_caja',$detalle,array('id_caja' => $this->input->post('id_caja') ))){
      $this->edit_banco($moneda_anterior,$this->input->post('moneda'),$this->input->post('total_anterior'),$this->input->post('total'),$banco_anterior,$this->input->post('id_banco'),$this->input->post('movimiento_anterior'),$movimiento);
      $update_id2=$this->detalle_caja_edit($id_detalle,$fechas,$periodos,$proyectos,$montos,$lugares,$detalles,$clasificaciones);
   } else{
      return false;
   }
   
   $update_id = $this->input->post('id_caja');
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
function detalle_caja_edit($id_detalle,$fecha,$periodo,$proyecto,$monto,$lugar,$detalle,$clasificacion){
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

   if(!$this->db->table_exists('tbl_detalle_caja')){ //VALIDA SI EXISTE LA TABLA
      return false;
   }   

   if(!$this->db->update('tbl_detalle_caja',$data,array('id_detalle_caja' => $id_detalle[$i] ))){
      return false;
   }
   
   $update_id = $this->input->post('id_detalle_caja');}
   return $update_id;

   
}
}