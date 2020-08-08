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

	public function first($id,$key,$table){
		$this->db->from($table);
		$this->db->where($key,$id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function search($id,$key,$table){
		$this->db->from($table);
		$this->db->where($key,$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getAkurasi(){
		$this->db->from('inisialisasi');
		$this->db->join('bobot_baru','bobot_baru.id_inisial = inisialisasi.id');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getOneAkurasi($id){
		$this->db->from('inisialisasi');
		$this->db->join('bobot_baru','bobot_baru.id_inisial = inisialisasi.id');
		$this->db->where('id_inisial',$id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function getAkurasi1($id){
		$this->db->from('akurasi');
		$this->db->join('bobot_baru','bobot_baru.id = akurasi.id_bobot');
		$this->db->where('id_bobot',$id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function searchU($id,$key,$table){
		$this->db->from($table);
		$this->db->where($key,$id);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function max(){
		$this->db->select_max('x1', 'x2', 'x3', 'x4', 'x5');
		$query = $this->db->get('data_koridor');
		return $query->row_array();
	}

	public function min(){
		$this->db->select_min('x1', 'x2', 'x3', 'x4', 'x5');
		$query = $this->db->get('data_koridor');
		return $query->row_array();
	}
}
