<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Cuenta_model extends CI_Model {
 
    public function __construct() {
    parent::__construct();
    }
    
    public function mostrar()
    {
        $this->db->select('*');
        $this->db->from("tbl_cuenta");
        $query=$this->db->get();      
        return $query->result();
    }

    function cuenta_add(){
        $detalles = array(
           'cuenta' => $this->input->post('cuenta'),
           'descripcion' => $this->input->post('descripcion'),
           'c_bal' => $this->input->post('cierre'),
           'a_debe' => $this->input->post('debe'),
           'a_haber' => $this->input->post('haber'),
           'tipo' => $this->input->post('tipo'),
           'analisis' => $this->input->post('analisis'),
           'centro_costo' => $this->input->post('centro_costo'),
           'presupuesto' => $this->input->post('presupuesto'),
           'nivel' => $this->input->post('nivel'),
           'situacion' => $this->input->post('situacion'),
           'resultado' => $this->input->post('resultado')

        );
     
        if(!$this->db->table_exists('tbl_cuenta')){ //VALIDA SI EXISTE LA TABLA
           return false;
        }
        
        $insert_fun = $this->db->insert('tbl_cuenta',$detalles);
        $insert_id = $this->db->insert_id();
        
        return $insert_id;
        
     }
     function cuenta_edit(){
		
        $detalles = array(
            'cuenta' => $this->input->post('cuenta'),
           'descripcion' => $this->input->post('descripcion'),
           'c_bal' => $this->input->post('cierre'),
           'a_debe' => $this->input->post('debe'),
           'a_haber' => $this->input->post('haber'),
           'tipo' => $this->input->post('tipo'),
           'analisis' => $this->input->post('analisis'),
           'centro_costo' => $this->input->post('centro_costo'),
           'presupuesto' => $this->input->post('presupuesto'),
           'nivel' => $this->input->post('nivel'),
           'situacion' => $this->input->post('situacion'),
           'resultado' => $this->input->post('resultado')
        );
     
        if(!$this->db->table_exists('tbl_cuenta')){ //VALIDA SI EXISTE LA TABLA
           return false;
        }
     
        if(!$this->db->update('tbl_cuenta',$detalles,array('id_cuenta' => $this->input->post('id_cuenta') ))){
           return false;
        }
        
        $update_id = $this->input->post('id_cuenta');
        return $update_id;
        
     }
}  