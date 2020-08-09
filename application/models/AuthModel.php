<?php

class AuthModel extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	function cek($data)
	{
		$query = $this->db->get_where('pengguna',$data);
		return $query->row_array();
	}

	public function lihat_semua()
	{
		$this->db->from('pengguna');
		$query = $this->db->get();
		return $query->result_array();
	}


	public function tambah_pengguna($data)
	{
		$this->db->insert('pengguna', $data);
	}

	public function hapus_pengguna($id)
	{
		$this->db->where('pengguna_id', $id);
		$this->db->delete('pengguna');
	}
}
