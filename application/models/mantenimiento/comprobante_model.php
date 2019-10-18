<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Comprobante_model extends CI_Model {
 
 public function __construct() {
 parent::__construct();
 }
 
 public function mostrar()
 {
 	$this->db->select('*');
    $this->db->from("tbl_comprobante");
    $query=$this->db->get();      
 	return $query->result();
 }

 public function mostrar_por_id($id)
 {
 	$this->db->select('*');
    
	 $this->db->where('id_comprobante',$id);
    $this->db->from("tbl_comprobante");
    return $this->db->get()->row();
 }

 public function mostrar_comprobante()
 {
 	$this->db->select('*');
    $this->db->from("tbl_comprobante");
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
 public function mostrar_comprobante_comprobante()
 {
 	$this->db->select('*');
    $this->db->from("comprobante_comprobante");
    $query=$this->db->get();      
 	return $query->result();
 }

 function comprobante_add(){
   $detalles = array(
      'comprobante' => $this->input->post('comprobante')      
   );

   if(!$this->db->table_exists('tbl_comprobante')){ //VALIDA SI EXISTE LA TABLA
      return false;
   }
   
   $insert_fun = $this->db->insert('tbl_comprobante',$detalles);
   $insert_id = $this->db->insert_id();
   
   return $insert_id;
   
}
function comprobante_edit(){
		
   $detalles = array(
      'comprobante' => $this->input->post('comprobante')
   );

   if(!$this->db->table_exists('tbl_comprobante')){ //VALIDA SI EXISTE LA TABLA
      return false;
   }

   if(!$this->db->update('tbl_comprobante',$detalles,array('id_comprobante' => $this->input->post('id_comprobante') ))){
      return false;
   }
   
   $update_id = $this->input->post('id_comprobante');
   return $update_id;
   
}
}