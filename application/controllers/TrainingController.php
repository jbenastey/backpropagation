<?php

class TrainingController extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model','model');

	}

	public function index(){
		$data = array(
			'inisial' => $this->model->get('inisialisasi')
		);
		$this->load->view('template/header');
		$this->load->view('training/index',$data);
		$this->load->view('template/footer');
	}

	public function hitung(){
		$this->load->view('template/header');
		$this->load->view('training/hitung');
		$this->load->view('template/footer');
	}

	public function prosesHitung(){
		$alpha = $this->input->post('alpha');
		$bagi = $this->input->post('bagi');
		$variasi = $this->input->post('variasi');

		$input = array();
		$hidden = array();
		for ($i = 0; $i< $variasi;$i++){
			for ($j = 0; $j<= 5;$j++){
				$input[($i+1)][$j] = mt_rand() / mt_getrandmax();
			}

			$hidden[$i] = mt_rand() / mt_getrandmax();
		}
		$hidden[$variasi] = mt_rand() / mt_getrandmax();

		$data = array(
			'alpha' => $alpha,
			'jumlah' => $bagi,
			'variasi_hidden' => $variasi,
			'input' => json_encode($input),
			'hidden' => json_encode($hidden)
		);

		$this->model->tambah('inisialisasi',$data);
		redirect('training');
	}
}
