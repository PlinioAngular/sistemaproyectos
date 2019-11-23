<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Compra_venta_model extends CI_Model {
 
    public function __construct() {
    parent::__construct();
    }

    function mostrar(){
        $this->db->select('cv.id_compra_venta,cv.tipo_registro,cv.total,estado,fecha_vencimiento,fecha_emision,id_comprobante,numero,serie,total');
        $this->db->from('tbl_compra_venta as cv');
        $query=$this->db->get();      
        return $query->result();
    }

    function mostrar_por_id($id){
        $this->db->select('cv.id_compra_venta,cv.tipo_registro,t.id_tipo_operacion,t.tipo_operacion,cv.cuo,cv.periodo,e.id_empresa,e.empresa,
        c.id_comprobante,c.comprobante,cv.serie,cv.numero,cv.moneda,cv.tipo_cambio,cv.sub_total,cv.igv,cv.total,cv.gravada,cv.isc,cv.glosa,
        cv.numero_detraccion,cv.codigo_detraccion,cv.fecha_detraccion,cv.monto_detraccion,cv.fecha_registro,cv.fecha_emision,cv.fecha_vencimiento');
        $this->db->from('tbl_compra_venta as cv');
        $this->db->join('tbl_tipo_operacion as t','t.id_tipo_operacion=cv.id_tipo_operacion');
        $this->db->join('tbl_empresa as e','e.id_empresa=cv.id_empresa');
        $this->db->join('tbl_comprobante as c','c.id_comprobante=cv.id_comprobante');
        $this->db->where('md5(cv.id_compra_venta)',$id);
        $query=$this->db->get();
        return $query->row();
    }
    function mostrar_detalle_por_id($id){
        $this->db->select('dc.id_detalle_compra_venta,dc.debe,dc.haber,c.cuenta,c.id_cuenta,c.descripcion');
        $this->db->from('tbl_detalle_compra_venta as dc');
        $this->db->join('tbl_cuenta as c','c.id_cuenta=dc.id_cuenta');
        $this->db->where('md5(dc.id_detalle_compra_venta)',$id);
        $query=$this->db->get();
        return $query->result();
    }

    

    function compra_add(){     
        $cuenta=$this->input->post('id_cuenta');
        $debe=$this->input->post('debe');
        $haber=$this->input->post('haber');
       $detalle = array(
          'tipo_registro' => $this->input->post('tipo_registro'),
          'id_tipo_operacion' =>$this->input->post('tipo_operacion'),
          'cuo' => $this->input->post('cuo'),
          'periodo' => $this->input->post('periodo'),
          'fecha_registro' => $this->input->post('fecha_registro'),
          'fecha_emision' =>$this->input->post('fecha_emision'),
          'fecha_vencimiento' => $this->input->post('fecha_vencimiento'),
          'id_empresa' => 11,
          'id_comprobante' => $this->input->post('comprobante'),
          'serie' =>$this->input->post('serie'),
          'numero' => $this->input->post('numero'),
          'moneda' => $this->input->post('moneda'),
          'tipo_cambio' => $this->input->post('tipo_cambio'),
          'sub_total' =>$this->input->post('sub_total'),
          'igv' => $this->input->post('igv'),
          'gravada' => $this->input->post('gravada'),
          'isc' => $this->input->post('isc'),
          'total' =>$this->input->post('total'),
          'glosa' => $this->input->post('glosa'),
          'numero_detraccion ' => $this->input->post('num_detraccion'),
          'fecha_detraccion' => $this->input->post('fecha_detraccion'),
          'codigo_detraccion' =>$this->input->post('cod_detraccion'),
          'monto_detraccion' => $this->input->post('monto_detraccion')
       );
    
       if(!$this->db->table_exists('tbl_compra_venta')){ //VALIDA SI EXISTE LA TABLA
          return false;
       }
       if(count($cuenta)>0){
       $insert_fun = $this->db->insert('tbl_compra_venta',$detalle);
       $insert_id = $this->db->insert_id();
       if($insert_id){
          $insert_id1=$this->add_detalle_compra($insert_id,$cuenta,$debe,$haber);
       }
       return $insert_id;
        }
        else { return false;}
    }
    
    function add_detalle_compra($id_compra,$cuenta,$debe,$haber){
       $insert_id=0;
       for($i=0;$i<count($cuenta);$i++){
       $data = array(
          'id_compra_venta' => $id_compra,
          'id_cuenta' => $cuenta[$i],
          'debe' => $debe[$i],
          'haber' => $haber[$i]
       );
    
       if(!$this->db->table_exists('tbl_detalle_compra_venta')){ //VALIDA SI EXISTE LA TABLA
          return false;
       }
       
       $insert_fun = $this->db->insert('tbl_detalle_compra_venta',$data);
       $insert_id = $this->db->insert_id();
       
       
    }
    return $insert_id;
    
    }

    function compra_venta_edit(){
        $id_detalle=$this->input->post('id_detalle_compra_venta');
        $cuenta=$this->input->post('id_cuenta');
        $debe=$this->input->post('debe');
        $haber=$this->input->post('haber');
         $update_id2;
        $detalle = array(
            'tipo_registro' => $this->input->post('tipo_registro'),
            'id_tipo_operacion' =>$this->input->post('tipo_operacion'),
            'cuo' => $this->input->post('cuo'),
            'periodo' => $this->input->post('periodo'),
            'fecha_registro' => $this->input->post('fecha_registro'),
            'fecha_emision' =>$this->input->post('fecha_emision'),
            'fecha_vencimiento' => $this->input->post('fecha_vencimiento'),
            'id_empresa' => 11,
            'id_comprobante' => $this->input->post('comprobante'),
            'serie' =>$this->input->post('serie'),
            'numero' => $this->input->post('numero'),
            'moneda' => $this->input->post('moneda'),
            'tipo_cambio' => $this->input->post('tipo_cambio'),
            'sub_total' =>$this->input->post('sub_total'),
            'igv' => $this->input->post('igv'),
            'gravada' => $this->input->post('gravada'),
            'isc' => $this->input->post('isc'),
            'total' =>$this->input->post('total'),
            'glosa' => $this->input->post('glosa'),
            'numero_detraccion ' => $this->input->post('num_detraccion'),
            'fecha_detraccion' => $this->input->post('fecha_detraccion'),
            'codigo_detraccion' =>$this->input->post('cod_detraccion'),
            'monto_detraccion' => $this->input->post('monto_detraccion')
        );
     
        if(!$this->db->table_exists('tbl_compra_venta')){ //VALIDA SI EXISTE LA TABLA
           return false;
        }
        if(count($cuenta)>0){     
            if($this->db->update('tbl_compra_venta',$detalle,array('id_compra_venta' => $this->input->post('id_compra_venta') ))){          
            $update_id2=$this->detalle_compra_venta_edit($id_detalle,$cuenta,$debe,$haber);
            } else{
           return false;
        }
        
        $update_id = $this->input->post('id_compra_venta');
        return $update_id;}
        else {
           return false;
        }
        
     }
     function detalle_compra_venta_edit($id_detalle,$cuenta,$debe,$haber){
        $update_id;
        for($i=0;$i<count($id_detalle);$i++){
        $data = array(
            'id_cuenta' => $cuenta[$i],
            'debe' => $debe[$i],
            'haber' => $haber[$i]
        );
  
     if(!$this->db->table_exists('tbl_detalle_compra_venta')){ //VALIDA SI EXISTE LA TABLA
        return false;
     }   
  
     if(!$this->db->update('tbl_detalle_compra_venta',$data,array('id_detalle_compra_venta' => $id_detalle[$i] ))){
        return false;
     }
     
     $update_id = $this->input->post('id_detalle_compra_venta');}
     return $update_id;
  }
  
}