<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Empresa_model extends CI_Model {
 
 public function __construct() {
 parent::__construct();
 }
 
 public function mostrar()
 {
 	$this->db->select('*');
    $this->db->from("tbl_empresa");
    $query=$this->db->get();      
 	return $query->result();
 }

 public function mostrar_por_id($id)
 {
 	$this->db->select('*');
    
	 $this->db->where('id_empresa',$id);
    $this->db->from("tbl_empresa");
    return $this->db->get()->row();
 }

 public function mostrar_empresa()
 {
 	$this->db->select('*');
    $this->db->from("tbl_empresa");
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
 public function mostrar_empresa_empresa()
 {
 	$this->db->select('*');
    $this->db->from("empresa_empresa");
    $query=$this->db->get();      
 	return $query->result();
 }

 function empresa_add(){
   $detalles = array(
      'empresa' => $this->input->post('empresa')      
   );

   if(!$this->db->table_exists('tbl_empresa')){ //VALIDA SI EXISTE LA TABLA
      return false;
   }
   
   $insert_fun = $this->db->insert('tbl_empresa',$detalles);
   $insert_id = $this->db->insert_id();
   
   return $insert_id;
   
}
function empresa_edit(){
		
   $detalles = array(
      'empresa' => $this->input->post('empresa')
   );

   if(!$this->db->table_exists('tbl_empresa')){ //VALIDA SI EXISTE LA TABLA
      return false;
   }

   if(!$this->db->update('tbl_empresa',$detalles,array('id_empresa' => $this->input->post('id_empresa') ))){
      return false;
   }
   
   $update_id = $this->input->post('id_empresa');
   return $update_id;
   
}
}