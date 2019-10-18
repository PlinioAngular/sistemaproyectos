<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Sub_area_model extends CI_Model {
 
 public function __construct() {
 parent::__construct();
 }
 
 public function mostrar()
 {
 	$this->db->select('*');
    $this->db->from("tbl_sub_area");
    $query=$this->db->get();      
 	return $query->result();
 }

 public function mostrar_por_id($id)
 {
 	$this->db->select('*');
    
	 $this->db->where('id_sub_area',$id);
    $this->db->from("tbl_sub_area");
    return $this->db->get()->row();
 }

 public function mostrar_sub_area()
 {
 	$this->db->select('*');
    $this->db->from("tbl_sub_area");
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
 public function mostrar_sub_area_sub_area()
 {
 	$this->db->select('*');
    $this->db->from("sub_area_sub_area");
    $query=$this->db->get();      
 	return $query->result();
 }

 function sub_area_add(){
   $detalles = array(
      'sub_area' => $this->input->post('sub_area')      
   );

   if(!$this->db->table_exists('tbl_sub_area')){ //VALIDA SI EXISTE LA TABLA
      return false;
   }
   
   $insert_fun = $this->db->insert('tbl_sub_area',$detalles);
   $insert_id = $this->db->insert_id();
   
   return $insert_id;
   
}
function sub_area_edit(){
		
   $detalles = array(
      'sub_area' => $this->input->post('sub_area')
   );

   if(!$this->db->table_exists('tbl_sub_area')){ //VALIDA SI EXISTE LA TABLA
      return false;
   }

   if(!$this->db->update('tbl_sub_area',$detalles,array('id_sub_area' => $this->input->post('id_sub_area') ))){
      return false;
   }
   
   $update_id = $this->input->post('id_sub_area');
   return $update_id;
   
}
}