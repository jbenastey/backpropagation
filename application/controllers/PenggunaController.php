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
}
