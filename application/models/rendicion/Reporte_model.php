<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
    class Reporte_model extends CI_Model {
    
    public function __construct() {
    parent::__construct();
    }
    
    public function mostrar()
    {
        $this->db->select("r.fecha_registro,dc.periodo, round(sum(dc.monto-r.gasto),2) as monto,c.moneda,p.apellido_paterno,p.apellido_materno,p.nombres,
        concat('Descuento por ',r.bloque) as detalle,pr.nombre_proyecto,dc.id_detalle_caja,if(dc.estado=5,'Via web o Normal','Suma de montos') as 'ModoRendicion'
        ,r.bloque");
        $this->db->like('dc.estado',$this->input->post('estado'));
        if($this->input->post('dos_fecha'))
        {
        $this->db->where("r.fecha_registro >=",$this->input->post('fecha_inicio'));
        $this->db->where("r.fecha_registro <=",$this->input->post('fecha_fin'));
        }    else{
        $this->db->where("r.fecha_registro",$this->input->post('fecha_inicio'));
        }
        $this->db->from("tbl_detalle_caja as dc");
        $this->db->join("tbl_rendicion as r ","dc.id_detalle_caja=r.id_detalle_caja");
        $this->db->join("tbl_caja as c ","dc.id_caja=c.id_caja");
        $this->db->join("tbl_persona as p ","c.id_responsable=p.id_persona");
        $this->db->join("tbl_proyecto as pr ","pr.id_proyecto=dc.id_proyecto");
        $this->db->group_by("p.id_persona");
        $this->db->group_by("c.moneda");
        $this->db->group_by("r.fecha_registro");
        $this->db->group_by("r.bloque");
        $this->db->order_by("r.fecha_registro","desc");
        $query=$this->db->get();      
        return $query->result(); 
    }
    function banco_reporte(){
        $this->db->select("b.banco,e.empresa,b.monto_soles,b.monto_dolares");
        $this->db->from("tbl_banco as b");
        $this->db->join("tbl_empresa as e ","e.id_empresa=b.id_empresa");
        $query=$this->db->get();      
        return $query->result();
    }
}