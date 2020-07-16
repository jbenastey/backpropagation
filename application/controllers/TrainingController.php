<?php

class TrainingController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model', 'model');

	}

	public function index()
	{
		$data = array(
			'inisial' => $this->model->get('inisialisasi')
		);
		$this->load->view('template/header');
		$this->load->view('training/index', $data);
		$this->load->view('template/footer');
	}

	public function hitung()
	{
		$this->load->view('template/header');
		$this->load->view('training/hitung');
		$this->load->view('template/footer');
	}

	public function prosesHitung()
	{
		$alpha = $this->input->post('alpha');
		$bagi = $this->input->post('bagi');
		$variasi = $this->input->post('variasi');

		$input = array();
		$hidden = array();
		for ($i = 0; $i < $variasi; $i++) {
			for ($j = 0; $j <= 5; $j++) {
				$input[($i + 1)][$j] = mt_rand() / mt_getrandmax();
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

		$this->model->tambah('inisialisasi', $data);
		redirect('training');
	}

	public function lihat($id)
	{
		$data['inisial'] = $this->model->first($id, 'id', 'inisialisasi');
		$data['training'] = $this->model->first($id, 'id_inisial', 'bobot_baru');
		$this->load->view('template/header');
		$this->load->view('training/lihat', $data);
		$this->load->view('template/footer');
	}

	public function hitungTraining($id)
	{
		$inisial = $this->model->first($id, 'id', 'inisialisasi');
		$data = $this->model->get('data_koridor');

		$input = json_decode($inisial['input'], true);
		$hidden = json_decode($inisial['hidden'], true);

		$vij = array();
		$wjk = array();
		foreach ($data as $key => $value) {
			if ($key == 0) {
				$zinj = array();
				$zj = array();
				foreach ($input as $key2 => $value2) {
					array_push($zinj, ($value2[0] + $value['x1n'] * $value2[1] + $value['x2n'] * $value2[2] + $value['x3n'] * $value2[3] + $value['x4n'] * $value2[4] + $value['x5n'] * $value2[5]));
					array_push($zj, (1 / (1 + exp(0 - $zinj[$key2 - 1]))));
				}
				$yink = $hidden[0];
				for ($i = 1; $i < count($hidden); $i++) {
					$yink += ($hidden[$i] * $zj[$i - 1]);
				}
				$yk = 1 / (1 + exp(0 - $yink));
				$e1 = $value['targetn'] - $yk;
				$dk = $e1 * $yk * (1 - $yk);
				$dwjk = array(0 => $inisial['alpha'] * $dk);
				foreach ($zj as $key2 => $value2) {
					array_push($dwjk, $inisial['alpha'] * $dk * $value2);
				}

				$dinj = array();
				for ($i = 1; $i < count($hidden); $i++) {
					array_push($dinj, $dk * $hidden[$i]);
				}

				$dj = array();
				for ($i = 0; $i < count($zj); $i++) {
					array_push($dj, $dinj[$i] * $zj[$i] * (1 - $zj[$i]));
				}

				$dvij = array();
				$dvij[0] = array();
				for ($i = 0; $i < count($dj); $i++) {
					array_push($dvij[0], $inisial['alpha'] * $dj[$i]);
				}
				for ($i = 1; $i <= 5; $i++) {
					$dvij[$i] = array();
					for ($j = 1; $j < count($hidden); $j++) {
						array_push($dvij[$i], $dvij[0][$j - 1] * $value['x' . $i . 'n']);
					}
				}

				foreach ($input as $key2 => $value2) {
					$vij[$key2] = array();
					for ($i = 0; $i < 6; $i++) {
						array_push($vij[$key2], $value2[$i] + $dvij[$i][$key2 - 1]);
					}
				}

				foreach ($hidden as $key2 => $value2) {
					array_push($wjk, $value2 + $dwjk[$key2]);
				}
			}
			elseif ($key == 1) {
				$zinj = array();
				$zj = array();
				foreach ($vij as $key2 => $value2) {
					array_push($zinj, ($value2[0] + $value['x1n'] * $value2[1] + $value['x2n'] * $value2[2] + $value['x3n'] * $value2[3] + $value['x4n'] * $value2[4] + $value['x5n'] * $value2[5]));
					array_push($zj, (1 / (1 + exp(0 - $zinj[$key2 - 1]))));
				}

				$yink = $wjk[0];
				for ($i = 1; $i < count($wjk); $i++) {
					$yink += ($wjk[$i] * $zj[$i - 1]);
				}
				$yk = 1 / (1 + exp(0 - $yink));
				$e1 = $value['targetn'] - $yk;
				$dk = $e1 * $yk * (1 - $yk);
				$dwjk = array(0 => $inisial['alpha'] * $dk);
				foreach ($zj as $key2 => $value2) {
					array_push($dwjk, $inisial['alpha'] * $dk * $value2);
				}

				$dinj = array();
				for ($i = 1; $i < count($hidden); $i++) {
					array_push($dinj, $dk * $wjk[$i]);
				}

				$dj = array();
				for ($i = 0; $i < count($zj); $i++) {
					array_push($dj, $dinj[$i] * $zj[$i] * (1 - $zj[$i]));
				}

				$dvij = array();
				$dvij[0] = array();
				for ($i = 0; $i < count($dj); $i++) {
					array_push($dvij[0], $inisial['alpha'] * $dj[$i]);
				}
				for ($i = 1; $i <= 5; $i++) {
					$dvij[$i] = array();
					for ($j = 1; $j < count($hidden); $j++) {
						array_push($dvij[$i], $dvij[0][$j-1] * $value['x'.$i.'n']);
					}
				}

				foreach ($vij as $key2 => $value2) {
					$vij[$key2] = array();
					for ($i = 0; $i < 6; $i++) {
						array_push($vij[$key2], $value2[$i] + $dvij[$i][$key2 - 1]);
					}
				}

				foreach ($wjk as $key2=>$value2){
					$wjk[$key2] = $value2+$dwjk[$key2];
				}
			}
		}
		echo "<pre>";
		print_r($zinj);
		print_r($zj);
		print_r($yink);
		print_r($yk);
		print_r($e1);
		print_r($dk);
		print_r($dwjk);
		print_r($dinj);
		print_r($dj);
		print_r($dvij);
		print_r($vij);
		print_r($wjk);
		echo "</pre>";
	}
}
