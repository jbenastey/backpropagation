<?php


class PrediksiController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model');
	}

	public function index()
	{
		$data = array(
			'prediksi' => $this->Model->getPrediksi()
		);
		$this->load->view('template/header');
		$this->load->view('prediksi/index', $data);
		$this->load->view('template/footer');
	}

	public function lihat($id)
	{
		$data['bobot'] = $this->Model->getOneAkurasi($id);
		$data['prediksi'] = $this->Model->getOnePrediksi($data['bobot']['id']);
		$data['akurasi'] = $this->Model->getAkurasi1($data['bobot']['id']);
		$this->load->view('template/header');
		$this->load->view('prediksi/lihat', $data);
		$this->load->view('template/footer');
	}
}
