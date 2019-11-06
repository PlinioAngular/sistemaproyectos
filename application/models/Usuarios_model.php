<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

	public function login($username, $password){
		$this->db->select("p.nombres,r.rol,p.id_persona");
		$this->db->from("tbl_persona as p");
		$this->db->where("p.dni", $username);
		$this->db->where("p.password", sha1($password));

		$this->db->join("tbl_rol_persona as rp","rp.id_persona=p.id_persona");
		$this->db->join("tbl_rol as r","rp.id_rol=r.id_rol");
		$resultados = $this->db->get("tbl_persona");
		if ($resultados->num_rows() > 0) {
			return $resultados->row();
		}
		else{
			return false;
		}
	} 
}
