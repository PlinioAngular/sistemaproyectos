<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Clasificacion_model extends CI_Model {
 
 public function __construct() {
 parent::__construct();
 }
 
 public function mostrar()
 {
 	$this->db->select('*');
    $this->db->from("tbl_clasificacion");
    $query=$this->db->get();      
 	return $query->result();
 }

 public function mostrar_por_id($id)
 {
 	$this->db->select('*');
    
	 $this->db->where('id_clasificacion',$id);
    $this->db->from("tbl_clasificacion");
    return $this->db->get()->row();
 }

 public function mostrar_clasificacion()
 {
 	$this->db->select('*');
    $this->db->from("tbl_clasificacion");
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
 public function mostrar_clasificacion_clasificacion()
 {
 	$this->db->select('*');
    $this->db->from("clasificacion_clasificacion");
    $query=$this->db->get();      
 	return $query->result();
 }

 function clasificacion_add(){
   $detalles = array(
      'clasificacion' => $this->input->post('clasificacion')      
   );

   if(!$this->db->table_exists('tbl_clasificacion')){ //VALIDA SI EXISTE LA TABLA
      return false;
   }
   
   $insert_fun = $this->db->insert('tbl_clasificacion',$detalles);
   $insert_id = $this->db->insert_id();
   
   return $insert_id;
   
}
function clasificacion_edit(){
		
   $detalles = array(
      'clasificacion' => $this->input->post('clasificacion')
   );

   if(!$this->db->table_exists('tbl_clasificacion')){ //VALIDA SI EXISTE LA TABLA
      return false;
   }

   if(!$this->db->update('tbl_clasificacion',$detalles,array('id_clasificacion' => $this->input->post('id_clasificacion') ))){
      return false;
   }
   
   $update_id = $this->input->post('id_clasificacion');
   return $update_id;
   
}
}