<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Notificacion_model extends CI_Model {
 
    public function __construct() {
    parent::__construct();
    }
 
    public function token()
    {
        $this->db->select('*');
        $this->db->from("devices");
        $this->db->where("email",$this->input->post('email'));
        return $this->db->get()->row()->token;

    }
}