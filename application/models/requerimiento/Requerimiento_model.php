<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Requerimiento_model extends CI_Model {
 
 public function __construct() {
 parent::__construct();
 }
 
 public function mostrar($condicion) {
    $this->db->select('r.id_requerimiento,r.total,p.apellido_paterno,p.apellido_materno,p.nombres,pr.nombre_proyecto,r.fecha,r.estado,p.id_persona');
    $this->db->from("tbl_requerimiento as r");
    $this->db->join("tbl_persona as p ","r.id_solicita=p.id_persona");
    $this->db->join("tbl_proyecto as pr ","pr.id_proyecto=r.id_proyecto");
    if($condicion==1){
      $this->db->where('r.id_solicita',$this->session->userdata('id'));
    }elseif($condicion==2){
      $this->db->where('r.id_autoriza',$this->session->userdata('id'));
      $this->db->where('r.estado',"SOLICITADO");
    }elseif($condicion==3){
      $this->db->where('r.estado',"APROBADO");
    }
    
    
    $query=$this->db->get();      
 	return $query->result();
 }

 public function mostrar_por_id($id)
 {
   $this->db->select('req.id_requerimiento,p.id_proyecto,p.nombre_proyecto,em.id_empresa,em.empresa,req.total,req.estado,
    r.id_persona as id_res,r.nombres as nom_res,r.apellido_materno as am_res,r.apellido_paterno as ap_res,
    au.id_persona as id_aut,au.nombres as nom_aut,au.apellido_materno as am_aut,au.apellido_paterno as ap_aut,
    sol.id_persona as id_reg,sol.nombres as nom_reg,sol.apellido_materno as am_reg,sol.apellido_paterno as ap_reg');
    $this->db->from("tbl_requerimiento as req");
    $this->db->where('md5(req.id_requerimiento)',$id);
    $this->db->join("tbl_empresa as em ","em.id_empresa=req.id_empresa");
    $this->db->join("tbl_persona as r ","req.id_responsable=r.id_persona");
    $this->db->join("tbl_proyecto as p ","req.id_proyecto=p.id_proyecto");
    $this->db->join("tbl_persona as au ","req.id_autoriza=au.id_persona");
    $this->db->join("tbl_persona as sol ","req.id_solicita=sol.id_persona"); 
    return $this->db->get()->row();
 }

 public function mostrar_detalle_por_id($id)
 {
   $this->db->select('*');
    $this->db->from("tbl_detalle_requerimiento as dr");
    $this->db->where('md5(dr.id_requerimiento)',$id);
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
   if(count($fecha_inicio)>0){
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
      'fecha_inicio' => $fecha_inicio[$i],
      'fecha_fin' => $fecha_fin[$i],
      'dni' => $dni[$i],
      'cargo' => 'c',
      'zona' => 'b',
      'datos_trabajador' => $datos[$i],
      'cantidad' => $dias[$i],
      'precio' => $precio[$i],
      'descripcion' => $descripcion[$i]
   );

   if(!$this->db->table_exists('tbl_detalle_requerimiento')){
      return false;
      }
   
   $insert_fun = $this->db->insert('tbl_detalle_requerimiento',$data);
   $insert_id = $this->db->insert_id(); 
   }
return $insert_id;

}

function requerimiento_edit(){
    $id_detalle=$this->input->post('id_detalle_requerimiento');
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
   if(count($id_detalle)>0){

   if($this->db->update('tbl_requerimiento',$detalle,array('id_requerimiento' => $this->input->post('id_requerimiento') ))){
      $update_id2=$this->detalle_requerimiento_edit($id_detalle,$fecha_inicio,$fecha_fin,$dni,$datos,$dias,$precio,$descripcion);
   } else{
      return false;
   }
   
   $update_id = $this->input->post('id_requerimiento');
   return $update_id;}
   else {
      return false;
   }
   
}



function detalle_requerimiento_edit($id_detalle,$fecha_inicio,$fecha_fin,$dni,$datos,$dias,$precio,$descripcion){
      $update_id;
      for($i=0;$i<count($id_detalle);$i++){
      $data = array(
      'id_detalle_requerimiento' => $id_detalle[$i],
      'fecha_inicio' => $fecha_inicio[$i],
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

         if(!$this->db->update('tbl_detalle_requerimiento',$data,array('id_detalle_requerimiento' => $id_detalle[$i] ))){
            return false;
         }
         
         $update_id = $this->input->post('id_detalle_requerimiento');
      }
         return $update_id;
   }

   function cambio_estado($id,$accion){
      $estado="";
      if($accion==1){
         $estado="CANCELADO";
      }elseif($accion==2){
         $estado="APROBADO";
      }elseif($accion==0){
         $estado="SOLICITADO";
      }
      $data = array(
         'estado' =>$estado
         
      );
   
   if(!$this->db->table_exists('tbl_requerimiento')){ //VALIDA SI EXISTE LA TABLA
      return false;
   }   
   
   if(!$this->db->update('tbl_requerimiento',$data,array('id_requerimiento' => $id ))){
      return false;
   }
   
   $update_id = $id;
   return $update_id;
   }

   public function gettoken()
    {
        $this->db->select('*');
        $this->db->from("devices");
        $this->db->where("email","daniel.fernandez@sattelital.com.pe");
        return $this->db->get()->row()->token;

    }
}