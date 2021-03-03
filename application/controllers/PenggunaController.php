<?php


class PenggunaController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model');
	}

	public function index()
	{
		$data = array(
			'pengguna' => $this->Model->get('pengguna')
		);
		$this->load->view('template/header');
		$this->load->view('pengguna/index', $data);
		$this->load->view('template/footer');
	}

	public function create(){
		if (isset($_POST['simpan'])){
			$username = $this->input->post('username');
			$nama = $this->input->post('nama');
			$password = $this->input->post('password');
			$dataInsert = array(
				'pengguna_username' => $username,
				'pengguna_nama' => $nama,
				'pengguna_password' => md5($password)
			);
			$this->Model->tambah('pengguna',$dataInsert);
			redirect('pengguna');
		} else {
			$this->load->view('template/header');
			$this->load->view('pengguna/create');
			$this->load->view('template/footer');
		}
	}

	public function edit($id){
		if (isset($_POST['edit'])){
			$username = $this->input->post('username');
			$nama = $this->input->post('nama');
			$password = $this->input->post('password');
			if ($password == null){
				$dataUpdate = array(
					'pengguna_username' => $username,
					'pengguna_nama' => $nama
				);
			} else {
				$dataUpdate = array(
					'pengguna_username' => $username,
					'pengguna_nama' => $nama,
					'pengguna_password' => md5($password)
				);
			}
			$this->Model->update($id,'pengguna_id','pengguna',$dataUpdate);
			redirect('pengguna');
		} else {
			$data = array(
				'pengguna' => $this->Model->first($id,'pengguna_id','pengguna')
			);
			$this->load->view('template/header');
			$this->load->view('pengguna/edit', $data);
			$this->load->view('template/footer');
		}
	}

	public function delete($id){
		$this->Model->hapus($id,'pengguna_id','pengguna');
		redirect('pengguna');
	}

}
