<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Area_model extends CI_Model {
 
 public function __construct() {
 parent::__construct();
 }
 
 public function mostrar()
 {
 	$this->db->select('*');
    $this->db->from("tbl_area");
    $query=$this->db->get();      
 	return $query->result();
 }

 public function mostrar_por_id($id)
 {
 	$this->db->select('*');
    
	 $this->db->where('id_area',$id);
    $this->db->from("tbl_area");
    return $this->db->get()->row();
 }

 public function mostrar_area()
 {
 	$this->db->select('*');
    $this->db->from("tbl_area");
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
 public function mostrar_area_area()
 {
 	$this->db->select('*');
    $this->db->from("area_area");
    $query=$this->db->get();      
 	return $query->result();
 }

 function area_add(){
   $detalles = array(
      'area' => $this->input->post('area')      
   );

   if(!$this->db->table_exists('tbl_area')){ //VALIDA SI EXISTE LA TABLA
      return false;
   }
   
   $insert_fun = $this->db->insert('tbl_area',$detalles);
   $insert_id = $this->db->insert_id();
   
   return $insert_id;
   
}
function area_edit(){
		
   $detalles = array(
      'area' => $this->input->post('area')
   );

   if(!$this->db->table_exists('tbl_area')){ //VALIDA SI EXISTE LA TABLA
      return false;
   }

   if(!$this->db->update('tbl_area',$detalles,array('id_area' => $this->input->post('id_area') ))){
      return false;
   }
   
   $update_id = $this->input->post('id_area');
   return $update_id;
   
}
}