<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Persona_model extends CI_Model {
 
 public function __construct() {
 parent::__construct();
 }
 
 public function mostrar()
 {
 	$this->db->select('*');
    $this->db->from("tbl_persona");
    $query=$this->db->get();      
 	return $query->result();
 }

 public function getPersona($valor){
   $this->db->select("*");
   $this->db->from("tbl_persona");
   $this->db->like("apellido_paterno",$valor);
   $resultados = $this->db->get();
   return $resultados->result_array();
}

 public function mostrar_por_id($id)
 {
 	$this->db->select('*');
    
	 $this->db->where('id_persona',$id);
    $this->db->from("tbl_persona");
    return $this->db->get()->row();
 }

 public function mostrar_persona()
 {
 	$this->db->select('*');
    $this->db->from("tbl_persona");
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
 public function mostrar_persona_persona()
 {
 	$this->db->select('*');
    $this->db->from("persona_persona");
    $query=$this->db->get();      
 	return $query->result();
 }

 function persona_add(){
   $detalles = array(
      'apellido_paterno' => strtoupper($this->input->post('apellido_paterno')),
      'apellido_materno' => strtoupper($this->input->post('apellido_materno')) ,
      'nombres' => strtoupper($this->input->post('nombres')), 
      'dni' => $this->input->post('dni') ,
      'fecha_nacimiento' => $this->input->post('fecha_nacimiento'),
      'password'=> sha1($this->input->post('dni'))       
   );

   if(!$this->db->table_exists('tbl_persona')){ //VALIDA SI EXISTE LA TABLA
      return false;
   }
   
   $insert_fun = $this->db->insert('tbl_persona',$detalles);
   $insert_id = $this->db->insert_id();
   
   return $insert_id;
   
}
function persona_edit(){
		
   $detalles = array(
      'apellido_paterno' => strtoupper($this->input->post('apellido_paterno')),
      'apellido_materno' => strtoupper($this->input->post('apellido_materno')) ,
      'nombres' => strtoupper($this->input->post('nombres')), 
      'dni' => $this->input->post('dni') ,
   );

   if(!$this->db->table_exists('tbl_persona')){ //VALIDA SI EXISTE LA TABLA
      return false;
   }

   if(!$this->db->update('tbl_persona',$detalles,array('id_persona' => $this->input->post('id_persona') ))){
      return false;
   }
   
   $update_id = $this->input->post('id_persona');
   return $update_id;
   
}
}