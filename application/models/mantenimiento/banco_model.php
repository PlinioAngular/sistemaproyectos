<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Banco_model extends CI_Model {
 
 public function __construct() {
 parent::__construct();
 }
 
 public function mostrar()
 {
 	$this->db->select('*');
    $this->db->from("tbl_banco as b");
    $this->db->join("tbl_empresa as e ","e.id_empresa=b.id_empresa");
    $query=$this->db->get();      
 	return $query->result();
 }

 public function mostrar_por_id($id)
 {
 	$this->db->select('*');
    
	 $this->db->where('id_banco',$id);
    $this->db->from("tbl_banco as b");
    $this->db->join("tbl_empresa as e ","e.id_empresa=b.id_empresa");
    return $this->db->get()->row();
 } 

 public function mostrar_banco_id()
 {
 	$this->db->select('*');    
	 $this->db->where('id_empresa',$this->input->post("id"));
    $this->db->from("tbl_banco");    
    $query=$this->db->get();      
 	return $query->result();
 } 

 public function mostrar_empresa()
 {
 	$this->db->select('*');
    $this->db->from("tbl_empresa");
    $query=$this->db->get();      
 	return $query->result();
 }

 function banco_add(){
   $detalles = array(
      'banco' => $this->input->post('banco'),  
      'id_empresa' => $this->input->post('id_empresa'),
      'cuenta_soles' => $this->input->post('cuenta_soles'),
      'cuenta_dolares' => $this->input->post('cuenta_dolares'),
      'monto_soles' => $this->input->post('monto_soles'), 
      'monto_dolares' => $this->input->post('monto_dolares'),
      'cambio' => $this->input->post('cambio'),
      'estado' => "0",
   );

   if(!$this->db->table_exists('tbl_banco')){ //VALIDA SI EXISTE LA TABLA
      return false;
   }
   
   $insert_fun = $this->db->insert('tbl_banco',$detalles);
   $insert_id = $this->db->insert_id();
   
   return $insert_id;
   
}
function banco_edit(){
		
   $detalles = array(
      'banco' => $this->input->post('banco'),  
      'id_empresa' => $this->input->post('id_empresa'),
      'cuenta_soles' => $this->input->post('cuenta_soles'),
      'cuenta_dolares' => $this->input->post('cuenta_dolares'),
      'monto_soles' => $this->input->post('monto_soles'), 
      'monto_dolares' => $this->input->post('monto_dolares'),
      'cambio' => $this->input->post('cambio')
   );

   if(!$this->db->table_exists('tbl_banco')){ //VALIDA SI EXISTE LA TABLA
      return false;
   }

   if(!$this->db->update('tbl_banco',$detalles,array('id_banco' => $this->input->post('id_banco') ))){
      return false;
   }
   
   $update_id = $this->input->post('id_banco');
   return $update_id;
   
}
}