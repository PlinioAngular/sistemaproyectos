<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Principal_model extends CI_Model {
 
 public function __construct() {
 parent::__construct();
 }

 public function egresos(){
   $this->db->select('dc.id_detalle_caja');
   $this->db->from("tbl_detalle_caja as dc");
   $this->db->join("tbl_caja as c ","dc.id_caja=c.id_caja");
   $this->db->where('c.egreso !=',0);
   $query=$this->db->get();      
   return $query->num_rows();
 }

 public function rendidos(){
   $this->db->select('dc.id_detalle_caja');
   $this->db->from("tbl_detalle_caja as dc");
   $this->db->join("tbl_caja as c ","dc.id_caja=c.id_caja");
   $this->db->where('c.egreso !=',0);
   $this->db->where('dc.estado !=',0);
   $this->db->where('dc.estado !=',2);
   $query=$this->db->get();      
   return $query->num_rows();
 }

 public function por_rendir(){
   $this->db->select('dc.id_detalle_caja');
   $this->db->from("tbl_detalle_caja as dc");
   $this->db->join("tbl_caja as c ","dc.id_caja=c.id_caja");
   $this->db->where('c.egreso !=',0);
   $this->db->where('dc.estado',0);
   $query=$this->db->get();      
   return $query->num_rows();
 }

 public function web(){
   $this->db->select('dc.id_detalle_caja');
   $this->db->from("tbl_detalle_caja as dc");
   $this->db->join("tbl_caja as c ","dc.id_caja=c.id_caja");
   $this->db->where('c.egreso !=',0);
   $this->db->where('dc.estado',2);
   $query=$this->db->get();      
   return $query->num_rows();
 }
 
 public function egreso_soles(){
   $this->db->select('if(sum(dc.monto) is null,"0.00",sum(dc.monto)) as egreso');
   $this->db->from("tbl_detalle_caja as dc");
   $this->db->join("tbl_caja as c ","dc.id_caja=c.id_caja");
   $this->db->where('c.egreso !=',0);
   $this->db->where('c.moneda','SOLES');
   $this->db->where('dc.fecha',date('Y-m-d'));
   return  $query=$this->db->get()->row();
 }

 public function egreso_dolares(){
   $this->db->select('if(sum(dc.monto) is null,"0.00",sum(dc.monto)) as egreso');
   $this->db->from("tbl_detalle_caja as dc");
   $this->db->join("tbl_caja as c ","dc.id_caja=c.id_caja");
   $this->db->where('c.egreso !=',0);
   $this->db->where('c.moneda','DOLARES');
   $this->db->where('dc.fecha',date('Y-m-d'));
   return  $query=$this->db->get()->row();
 }

 public function ingreso_soles(){
   $this->db->select('if(sum(dc.monto) is null,"0.00",sum(dc.monto)) as ingreso');
   $this->db->from("tbl_detalle_caja as dc");
   $this->db->join("tbl_caja as c ","dc.id_caja=c.id_caja");
   $this->db->where('c.egreso',0);
   $this->db->where('c.moneda','SOLES');
   $this->db->where('dc.fecha',date('Y-m-d'));
   return  $query=$this->db->get()->row();
 }

 public function ingreso_dolares(){
   $this->db->select('if(sum(dc.monto) is null,"0.00",sum(dc.monto)) as ingreso');
   $this->db->from("tbl_detalle_caja as dc");
   $this->db->join("tbl_caja as c ","dc.id_caja=c.id_caja");
   $this->db->where('c.egreso',0);
   $this->db->where('c.moneda','DOLARES');
   $this->db->where('dc.fecha',date('Y-m-d'));
   return  $query=$this->db->get()->row();
 }

 
}