<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Tipo_actividad_model extends CI_Model {
 
 public function __construct() {
 parent::__construct();
 }
 
 public function mostrar()
 {
 	$this->db->select('*');
    $this->db->from("tbl_tipo_actividad");
    $query=$this->db->get();      
 	return $query->result();
 }

 public function mostrar_por_id($id)
 {
 	$this->db->select('*');
    
	 $this->db->where('id_tipo_actividad',$id);
    $this->db->from("tbl_tipo_actividad");
    return $this->db->get()->row();
 }

 public function mostrar_tipo_actividad()
 {
 	$this->db->select('*');
    $this->db->from("tbl_tipo_actividad");
    $query=$this->db->get();      
 	return $query->result();
 }
 public function mostrar_marca()
 {
 	$this->db->select('*');
    $this->db->from("marca");
    $query=$this->db->get();      
 	return $query->result();
 }
 public function mostrar_color()
 {
 	$this->db->select('*');
    $this->db->from("color");
    $query=$this->db->get();      
 	return $query->result();
 }
 public function mostrar_tipo_actividad_tipo_actividad()
 {
 	$this->db->select('*');
    $this->db->from("tipo_actividad_tipo_actividad");
    $query=$this->db->get();      
 	return $query->result();
 }

 function tipo_actividad_add(){
   $detalles = array(
      'tipo_actividad' => $this->input->post('tipo_actividad')      
   );

   if(!$this->db->table_exists('tbl_tipo_actividad')){ //VALIDA SI EXISTE LA TABLA
      return false;
   }
   
   $insert_fun = $this->db->insert('tbl_tipo_actividad',$detalles);
   $insert_id = $this->db->insert_id();
   
   return $insert_id;
   
}
function tipo_actividad_edit(){
		
   $detalles = array(
      'tipo_actividad' => $this->input->post('tipo_actividad')
   );

   if(!$this->db->table_exists('tbl_tipo_actividad')){ //VALIDA SI EXISTE LA TABLA
      return false;
   }

   if(!$this->db->update('tbl_tipo_actividad',$detalles,array('id_tipo_actividad' => $this->input->post('id_tipo_actividad') ))){
      return false;
   }
   
   $update_id = $this->input->post('id_tipo_actividad');
   return $update_id;
   
}
}