<?php
class Model extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get($table){
		$this->db->from($table);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function tambah($table,$data){
		$this->db->insert($table,$data);
	}

	public function first($id,$table){
		$this->db->from($table);
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->row_array();
	}
}
