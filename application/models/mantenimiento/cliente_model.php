<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Cliente_model extends CI_Model {
 
 public function __construct() {
 parent::__construct();
 }
 
 public function mostrar()
 {
 	$this->db->select('*');
    $this->db->from("tbl_cliente");
    $query=$this->db->get();      
 	return $query->result();
 }

 public function mostrar_por_id($id)
 {
 	$this->db->select('*');
    
	 $this->db->where('id_cliente',$id);
    $this->db->from("tbl_cliente");
    return $this->db->get()->row();
 }

 public function mostrar_cliente()
 {
 	$this->db->select('*');
    $this->db->from("tbl_cliente");
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
 public function mostrar_cliente_cliente()
 {
 	$this->db->select('*');
    $this->db->from("cliente_cliente");
    $query=$this->db->get();      
 	return $query->result();
 }

 function cliente_add(){
   $detalles = array(
      'cliente' => $this->input->post('cliente')      
   );

   if(!$this->db->table_exists('tbl_cliente')){ //VALIDA SI EXISTE LA TABLA
      return false;
   }
   
   $insert_fun = $this->db->insert('tbl_cliente',$detalles);
   $insert_id = $this->db->insert_id();
   
   return $insert_id;
   
}
function cliente_edit(){
		
   $detalles = array(
      'cliente' => $this->input->post('cliente')
   );

   if(!$this->db->table_exists('tbl_cliente')){ //VALIDA SI EXISTE LA TABLA
      return false;
   }

   if(!$this->db->update('tbl_cliente',$detalles,array('id_cliente' => $this->input->post('id_cliente') ))){
      return false;
   }
   
   $update_id = $this->input->post('id_cliente');
   return $update_id;
   
}
}