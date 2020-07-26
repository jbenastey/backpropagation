<?php


class AkurasiController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model','model');

	}
	public function index(){
		$data = array(
			'akurasi' => $this->model->getAkurasi()
		);
		$this->load->view('template/header');
		$this->load->view('akurasi/index',$data);
		$this->load->view('template/footer');
	}

	public function lihat($id){
		$data = array(
			'bobot' => $this->model->getOneAkurasi($id),
			'akurasi' => $this->model->getAkurasi1($id)
		);
		$this->load->view('template/header');
		$this->load->view('akurasi/lihat',$data);
		$this->load->view('template/footer');
	}

	public function hitung($id){

	}
}
