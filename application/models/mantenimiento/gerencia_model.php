<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Gerencia_model extends CI_Model {
 
 public function __construct() {
 parent::__construct();
 }
 
 public function mostrar()
 {
 	$this->db->select('*');
    $this->db->from("tbl_gerencia");
    $query=$this->db->get();      
 	return $query->result();
 }

 public function mostrar_por_id($id)
 {
 	$this->db->select('*');
    
	 $this->db->where('id_gerencia',$id);
    $this->db->from("tbl_gerencia");
    return $this->db->get()->row();
 }

 public function mostrar_tipo()
 {
 	$this->db->select('*');
    $this->db->from("tbl_gerencia");
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
 public function mostrar_tipo_gerencia()
 {
 	$this->db->select('*');
    $this->db->from("tipo_gerencia");
    $query=$this->db->get();      
 	return $query->result();
 }

 function gerencia_add(){
   $detalles = array(
      'gerencia' => $this->input->post('gerencia')      
   );

   if(!$this->db->table_exists('tbl_gerencia')){ //VALIDA SI EXISTE LA TABLA
      return false;
   }
   
   $insert_fun = $this->db->insert('tbl_gerencia',$detalles);
   $insert_id = $this->db->insert_id();
   
   return $insert_id;
   
}
function gerencia_edit(){
		
   $detalles = array(
      'gerencia' => $this->input->post('gerencia')
   );

   if(!$this->db->table_exists('tbl_gerencia')){ //VALIDA SI EXISTE LA TABLA
      return false;
   }

   if(!$this->db->update('tbl_gerencia',$detalles,array('id_gerencia' => $this->input->post('id_gerencia') ))){
      return false;
   }
   
   $update_id = $this->input->post('id_gerencia');
   return $update_id;
   
}
}