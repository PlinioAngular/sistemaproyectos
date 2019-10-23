<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Rendicion_model extends CI_Model {
 
 public function __construct() {
 parent::__construct();
 }
 
 public function mostrar()
 {
    $this->db->select('r.id_persona,r.apellido_paterno,r.apellido_materno,r.nombres, sum(dc.monto) as total');
    $this->db->where('ca.egreso !=',0);
    $this->db->where('dc.estado',0);
    $this->db->from("tbl_detalle_caja as dc");
    $this->db->join("tbl_caja as ca ","dc.id_caja=ca.id_caja");
    $this->db->join("tbl_persona as r ","ca.id_responsable=r.id_persona");
    $this->db->group_by("r.id_persona");
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

 public function mostrar_persona_detalle($id)
 {
    $this->db->select('dc.id_detalle_caja,r.id_persona,r.apellido_paterno,r.apellido_materno,r.nombres, dc.monto as total');
    $this->db->where('ca.egreso !=',0);
    $this->db->where('dc.estado',0);
    $this->db->where('ca.id_responsable',$id);
    $this->db->from("tbl_detalle_caja as dc");
    $this->db->join("tbl_caja as ca ","dc.id_caja=ca.id_caja");
    $this->db->join("tbl_persona as r ","ca.id_responsable=r.id_persona");
    $query=$this->db->get();      
 	return $query->result();
 }
 public function mostrar_detalle_id_suma($id)
 {
    $this->db->select('r.id_persona,r.apellido_paterno,r.apellido_materno,r.nombres');
    $this->db->where('r.id_persona',$id);
    $this->db->from("tbl_persona as r");
    return $this->db->get()->row();
 }

 public function mostrar_detalle_id($id)
 {
   $this->db->select('au.id_persona as id_auto,au.apellido_paterno as ap_aut,au.apellido_materno as am_aut,au.nombres as nom_aut,dc.id_detalle_caja,
   r.id_persona,r.apellido_paterno,r.apellido_materno,r.nombres, dc.monto,dc.detalle,p.nombre_proyecto,ren.gasto,ren.id_rendicion');
   //$this->db->where('ca.egreso !=',0);
   $this->db->where('dc.id_detalle_caja',$id);
   $this->db->from("tbl_detalle_caja as dc");
   $this->db->join("tbl_caja as ca ","dc.id_caja=ca.id_caja");
   $this->db->join("tbl_persona as r ","ca.id_responsable=r.id_persona");
   $this->db->join("tbl_persona as au ","ca.id_autoriza=au.id_persona");
   $this->db->join("tbl_proyecto as p ","dc.id_proyecto=p.id_proyecto");
   $this->db->join("tbl_rendicion as ren ","dc.id_detalle_caja=ren.id_detalle_caja","left");
    return $this->db->get()->row();
 }

 public function mostrar_detalle_por_id($id)
 {
   $this->db->select('dr.id_detalle_rendicion,dr.fecha,dr.periodo,dr.ruc,c.id_comprobante,c.comprobante,dr.numero_comprobante,dr.serie,
   p.id_proyecto,p.nombre_proyecto,cl.id_clasificacion,cl.clasificacion,t.id_tipo_actividad,t.tipo_actividad,dr.descripcion,dr.cantidad,
   dr.precio');
    $this->db->from("tbl_detalle_rendicion as dr");
    $this->db->where('dc.id_detalle_caja',$id);
    $this->db->join("tbl_proyecto as p ","p.id_proyecto=dr.id_proyecto","left");
    $this->db->join("tbl_clasificacion as cl ","cl.id_clasificacion=dr.id_clasificacion","left");
    $this->db->join("tbl_tipo_actividad as t ","t.id_tipo_actividad=dr.id_tipo_actividad","left");
    $this->db->join("tbl_comprobante as c ","c.id_comprobante=dr.id_comprobante","left");
    $this->db->join("tbl_rendicion as r ","r.id_rendicion=dr.id_rendicion");
    $this->db->join("tbl_detalle_caja as dc ","dc.id_detalle_caja=r.id_detalle_caja");
    $query=$this->db->get();      
 	return $query->result();
 }

 public function mostrar_egresos_rendidos()
 {
    $this->db->select('r.id_persona,r.apellido_paterno,r.apellido_materno,r.nombres, sum(dc.monto) as egreso, sum(ren.gasto) as rendido, 
    (sum(dc.monto)-sum(ren.gasto)) as saldo');
    $this->db->where('ca.egreso !=',0);
    $this->db->from("tbl_detalle_caja as dc");
    $this->db->join("tbl_caja as ca ","dc.id_caja=ca.id_caja");
    $this->db->join("tbl_persona as r ","ca.id_responsable=r.id_persona");
    $this->db->join("tbl_rendicion as ren ","ren.id_detalle_caja=dc.id_detalle_caja",'left');
    $this->db->group_by("r.id_persona");
    $query=$this->db->get();      
 	return $query->result();
 }

 public function mostrar_egresos_rendidos_listado($id)
 {
    $this->db->select('dc.id_detalle_caja,dc.estado,r.id_persona,r.apellido_paterno,r.apellido_materno,r.nombres, dc.monto as egreso, ren.gasto as rendido, 
    (dc.monto-ren.gasto) as saldo,ren.id_rendicion');
    $this->db->where('ca.egreso !=',0);
    $this->db->where('ca.id_responsable',$id);
    $this->db->from("tbl_detalle_caja as dc");
    $this->db->join("tbl_caja as ca ","dc.id_caja=ca.id_caja");
    $this->db->join("tbl_persona as r ","ca.id_responsable=r.id_persona");
    $this->db->join("tbl_rendicion as ren ","ren.id_detalle_caja=dc.id_detalle_caja",'left');
    $query=$this->db->get();      
 	return $query->result();
 }

 function setBloque(){
   $this->db->select('max(bloque)+1 as bloque');
   $this->db->from("tbl_rendicion");
   return $this->db->get()->row()->bloque;
 }

 function rendicion_add(){
    $fecha=$this->input->post('fechas');
    $periodo=$this->input->post('periodos');
    $ruc=$this->input->post('ruc');
    $comprobante=$this->input->post('comprobantes');
    $serie=$this->input->post('serie');
    $numero=$this->input->post('numero');
    $proyecto=$this->input->post('proyectos');
    $clasificacion=$this->input->post('clasificaciones');
    $tipo_actividad=$this->input->post('tipo_actividad');
    $cantidad=$this->input->post('cantidad');
    $precio=$this->input->post('precio');
    $descripcion=$this->input->post('detalles');
   $detalle = array(
      'id_autoriza' => $this->input->post('id_autoriza'),
      'id_registra' =>$this->session->userdata('id'),
      'gasto' => $this->input->post('total'),
      'bloque' => $this->setBloque(),
      'id_detalle_caja' => $this->input->post('id_detalle_caja'),
      'fecha_registro' => date("Y/m/d")
   );

   if(!$this->db->table_exists('tbl_rendicion')){ //VALIDA SI EXISTE LA TABLA
      return false;
   }
   if(count($precio)>0){
   $insert_fun = $this->db->insert('tbl_rendicion',$detalle);
   $insert_id = $this->db->insert_id();
   if($insert_id){
      $insert_id1=$this->add_detalle_rendicion($insert_id,$fecha,$periodo,$proyecto,$ruc,$comprobante,$serie,$numero,$clasificacion,$tipo_actividad,$cantidad,$precio,$descripcion);
      $this->cambio_estado($this->input->post('id_detalle_caja'));
   }
   return $insert_id;
}
else { return false;}
}

function rendicion_add_suma($id_detalle,$inicio,$fin,$bloque){
   $suma=0;   
   $fecha=$this->input->post('fechas');
   $periodo=$this->input->post('periodos');
   $ruc=$this->input->post('ruc');
   $comprobante=$this->input->post('comprobantes');
   $serie=$this->input->post('serie');
   $numero=$this->input->post('numero');
   $proyecto=$this->input->post('proyectos');
   $clasificacion=$this->input->post('clasificaciones');
   $tipo_actividad=$this->input->post('tipo_actividad');
   $cantidad=$this->input->post('cantidad');
   $precio=$this->input->post('precio');
   for($i=$inicio;$i<=$fin;$i++){
      $suma+=round(($precio[$i]*$cantidad[$i]),2);
   }
   $descripcion=$this->input->post('detalles');
  $detalle = array(
     'id_autoriza' => $this->input->post('id_autoriza'),
     'id_registra' =>$this->session->userdata('id'),
     'gasto' => $suma,
     'bloque' => $bloque,
     'id_detalle_caja' => $id_detalle,
     'fecha_registro' => date("Y/m/d")
  );

  if(!$this->db->table_exists('tbl_rendicion')){ //VALIDA SI EXISTE LA TABLA
     return false;
  }if(count($precio)>0){
   $insert_fun = $this->db->insert('tbl_rendicion',$detalle);
   $insert_id = $this->db->insert_id();
   if($insert_id){
      $this->cambio_estado($id_detalle);
      $insert_id1=$this->add_detalle_rendicion_suma($inicio,$fin,$insert_id,$fecha,$periodo,$proyecto,$ruc,$comprobante,$serie,$numero,$clasificacion,$tipo_actividad,$cantidad,$precio,$descripcion);
      
   }
   return $insert_id;
}
else { return false;}

}

function add_detalle_rendicion_suma($inicio,$fin,$id_rendicion,$fecha,$periodo,$proyecto,$ruc,$comprobante,$serie,$numero,$clasificacion,$tipo_actividad,$cantidad,$precio,$descripcion){
   $insert_id=0;
   for($i=$inicio;$i<=$fin;$i++){
   $data = array(
      'id_rendicion' => $id_rendicion,
      'fecha' => $fecha[$i],
      'periodo' => $periodo[$i],
      'id_proyecto' => $proyecto[$i],
      'id_cliente' => 1,
      'id_gerencia' => 1,
      'id_area' => 1,
      'id_sub_area' => 1,
      'id_tipo_actividad' => $tipo_actividad[$i],
      'ruc' => $ruc[$i],
      'id_comprobante' => $comprobante[$i],
      'serie' => $serie[$i],
      'numero_comprobante' => $numero[$i],
      'descripcion' => $descripcion[$i],
      'cantidad' => $cantidad[$i],
      'precio' => $precio[$i],
      'id_clasificacion' => $clasificacion[$i]
   );

   if(!$this->db->table_exists('tbl_detalle_rendicion')){ //VALIDA SI EXISTE LA TABLA
      return false;
   }
   
   $insert_fun = $this->db->insert('tbl_detalle_rendicion',$data);
   $insert_id = $this->db->insert_id(); 
   }
   return $insert_id;
}

function add_detalle_rendicion($id_rendicion,$fecha,$periodo,$proyecto,$ruc,$comprobante,$serie,$numero,$clasificacion,$tipo_actividad,$cantidad,$precio,$descripcion){
   $insert_id=0;
   for($i=0;$i<count($precio);$i++){
   $data = array(
      'id_rendicion' => $id_rendicion,
      'fecha' => $fecha[$i],
      'periodo' => $periodo[$i],
      'id_proyecto' => $proyecto[$i],
      'id_cliente' => 1,
      'id_gerencia' => 1,
      'id_area' => 1,
      'id_sub_area' => 1,
      'id_tipo_actividad' => $tipo_actividad[$i],
      'ruc' => $ruc[$i],
      'id_comprobante' => $comprobante[$i],
      'serie' => $serie[$i],
      'numero_comprobante' => $numero[$i],
      'descripcion' => $descripcion[$i],
      'cantidad' => $cantidad[$i],
      'precio' => $precio[$i],
      'id_clasificacion' => $clasificacion[$i]
   );

   if(!$this->db->table_exists('tbl_detalle_rendicion')){ //VALIDA SI EXISTE LA TABLA
      return false;
   }
   
   $insert_fun = $this->db->insert('tbl_detalle_rendicion',$data);
   $insert_id = $this->db->insert_id(); 
   }
   return $insert_id;
}

function cambio_estado($id_detalle){
   
   $tratamiento=$this->input->post('tratamiento');
   
   $data = array(
      'estado' =>$tratamiento
      
   );

if(!$this->db->table_exists('tbl_detalle_caja')){ //VALIDA SI EXISTE LA TABLA
   return false;
}   

if(!$this->db->update('tbl_detalle_caja',$data,array('id_detalle_caja' => $id_detalle ))){
   return false;
}

$update_id = $this->input->post('id_detalle_caja');
return $update_id;


}

function rendicion_edit(){   
   $update_id2;
   $id_detalle=$this->input->post('id_detalle_rendicion');
   $fecha=$this->input->post('fechas');
    $periodo=$this->input->post('periodos');
    $ruc=$this->input->post('ruc');
    $comprobante=$this->input->post('comprobantes');
    $serie=$this->input->post('serie');
    $numero=$this->input->post('numero');
    $proyecto=$this->input->post('proyectos');
    $clasificacion=$this->input->post('clasificaciones');
    $tipo_actividad=$this->input->post('tipo_actividad');
    $cantidad=$this->input->post('cantidad');
    $precio=$this->input->post('precio');
    $descripcion=$this->input->post('detalles');
   $detalle = array(
      'id_autoriza' => $this->input->post('id_autoriza'),
      'id_registra' =>$this->session->userdata('id'),
      'gasto' => $this->input->post('total'),
      'bloque' => 1,
      'id_detalle_caja' => $this->input->post('id_detalle_caja'),
      'fecha_registro' => date("Y/m/d")
   );

   if(!$this->db->table_exists('tbl_rendicion')){ //VALIDA SI EXISTE LA TABLA
      return false;
   }
   if(count($precio)>0){
      if($this->db->update('tbl_rendicion',$detalle,array('id_rendicion' => $this->input->post('id_rendicion') ))){
         $update_id2=$this->edit_detalle_rendicion($id_detalle,$fecha,$periodo,$proyecto,$ruc,$comprobante,$serie,$numero,$clasificacion,$tipo_actividad,$cantidad,$precio,$descripcion);
         if($this->input->post('tratamiento')>0){
            $this->cambio_estado($this->input->post('id_detalle_caja'));
         }         
      } else{
         return false;
      }
      
      $update_id = $this->input->post('id_rendicion');
      return $update_id;
}  
}

   function edit_detalle_rendicion($id_detalle,$fecha,$periodo,$proyecto,$ruc,$comprobante,$serie,$numero,$clasificacion,$tipo_actividad,$cantidad,$precio,$descripcion){
      $update_id;
      for($i=0;$i<count($precio);$i++){
       $data = array(
      'fecha' => $fecha[$i],
      'periodo' => $periodo[$i],
      'id_proyecto' => $proyecto[$i],
      'id_cliente' => 1,
      'id_gerencia' => 1,
      'id_area' => 1,
      'id_sub_area' => 1,
      'id_tipo_actividad' => $tipo_actividad[$i],
      'ruc' => $ruc[$i],
      'id_comprobante' => $comprobante[$i],
      'serie' => $serie[$i],
      'numero_comprobante' => $numero[$i],
      'descripcion' => $descripcion[$i],
      'cantidad' => $cantidad[$i],
      'precio' => $precio[$i],
      'id_clasificacion' => $clasificacion[$i]
   );

   if(!$this->db->table_exists('tbl_detalle_rendicion')){ //VALIDA SI EXISTE LA TABLA
      return false;
   }   

   if(!$this->db->update('tbl_detalle_rendicion',$data,array('id_detalle_rendicion' => $id_detalle[$i] ))){
      return false;
   }
   
   $update_id = $this->input->post('id_detalle_rendicion');}
   return $update_id;
   }
   function rendiciones_web(){
      $this->db->select('r.id_persona,r.apellido_paterno,r.apellido_materno,r.nombres, sum(dc.monto) as egreso,
       sum(ren.gasto) as rendido, 
    (sum(dc.monto)-sum(ren.gasto)) as saldo,ren.fecha_registro,dc.id_detalle_caja');
    $this->db->where('dc.estado',2);
    $this->db->from("tbl_detalle_caja as dc");
    $this->db->join("tbl_caja as ca ","dc.id_caja=ca.id_caja");
    $this->db->join("tbl_persona as r ","ca.id_responsable=r.id_persona");
    $this->db->join("tbl_rendicion as ren ","ren.id_detalle_caja=dc.id_detalle_caja");
    $this->db->group_by("r.id_persona");
    $query=$this->db->get();      
 	return $query->result();
   }
   function rendiciones_web_detalle($id){
      $this->db->select('if(ren.id_registra=6,"SI",if(ren.id_registra=1072,"SI","NO")) as vb,r.id_persona,r.apellido_paterno,r.apellido_materno,r.nombres, dc.monto as egreso, ren.gasto as rendido, 
    (dc.monto-ren.gasto) as saldo,ren.fecha_registro,dc.id_detalle_caja,ren.id_rendicion');
    $this->db->where('dc.estado',2);
    $this->db->where('r.id_persona',$id);
    $this->db->from("tbl_detalle_caja as dc");
    $this->db->join("tbl_caja as ca ","dc.id_caja=ca.id_caja");
    $this->db->join("tbl_persona as r ","ca.id_responsable=r.id_persona");
    $this->db->join("tbl_rendicion as ren ","ren.id_detalle_caja=dc.id_detalle_caja");
    $query=$this->db->get();      
 	return $query->result();
   }
}