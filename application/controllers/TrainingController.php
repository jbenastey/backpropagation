<?php

class TrainingController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model', 'model');
		if (!$this->session->has_userdata('session_id')) {
			redirect(base_url('login'));
		}
	}

	public function index()
	{
		$data = array(
			'inisial' => $this->model->getTraining()
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
		$maxepoch = $this->input->post('max_epoch');
		$koridor = $this->input->post('koridor');

		$cek = $this->model->search($koridor, 'koridor', 'data_koridor');

		if (count($cek) > 0) {
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
				'max_epoch' => $maxepoch,
				'koridor' => $koridor,
				'input' => json_encode($input),
				'hidden' => json_encode($hidden)
			);

			$this->model->tambah('inisialisasi', $data);
			redirect('training');
		} else {
			redirect('training');
		}
	}

	public function lihat($id)
	{
		$data['inisial'] = $this->model->first($id, 'id_in', 'inisialisasi');
		$data['training'] = $this->model->first($id, 'id_inisial', 'bobot_baru');
		$data['bobot'] = $this->model->getOneAkurasi($id);
		$data['akurasi'] = $this->model->getAkurasi1($data['bobot']['id']);
		$this->load->view('template/header');
		$this->load->view('training/lihat', $data);
		$this->load->view('template/footer');
	}

	public function hitungTraining($id)
	{
		$inisial = $this->model->first($id, 'id_in', 'inisialisasi');
		$datas = $this->model->search($inisial['koridor'],'koridor','data_koridor');

		$data = array();
		$jumlah = round(count($datas) * $inisial['jumlah'] / 100);
		for ($i = 0; $i < $jumlah;$i++){
			array_push($data,array(
				'x1n' => $datas[$i]['x1n'],
				'x2n' => $datas[$i]['x2n'],
				'x3n' => $datas[$i]['x3n'],
				'x4n' => $datas[$i]['x4n'],
				'x5n' => $datas[$i]['x5n'],
				'targetn' => $datas[$i]['targetn'],
			));
		}

		$input = json_decode($inisial['input'], true);
		$hidden = json_decode($inisial['hidden'], true);

		$vij = array();
		$wjk = array();
		$mses = 0;

		$epoch = 0;
		for ($a = 0; $a < $inisial['max_epoch']; $a++) {
			if ($mses == 0 || $mses > 0.001) {
				if ($epoch == 0) {
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

							$mse = $e1 * $e1;
							$mses += $mse;
						} else {
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
									array_push($dvij[$i], $dvij[0][$j - 1] * $value['x' . $i . 'n']);
								}
							}

							foreach ($vij as $key2 => $value2) {
								$vij[$key2] = array();
								for ($i = 0; $i < 6; $i++) {
									array_push($vij[$key2], $value2[$i] + $dvij[$i][$key2 - 1]);
								}
							}

							foreach ($wjk as $key2 => $value2) {
								$wjk[$key2] = $value2 + $dwjk[$key2];
							}

							$mse = $e1 * $e1;
							$mses += $mse;
						}
					}
					$mses = $mses / count($data);
				} else {
					foreach ($data as $key => $value) {
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
								array_push($dvij[$i], $dvij[0][$j - 1] * $value['x' . $i . 'n']);
							}
						}

						foreach ($vij as $key2 => $value2) {
							$vij[$key2] = array();
							for ($i = 0; $i < 6; $i++) {
								array_push($vij[$key2], $value2[$i] + $dvij[$i][$key2 - 1]);
							}
						}

						foreach ($wjk as $key2 => $value2) {
							$wjk[$key2] = $value2 + $dwjk[$key2];
						}

						$mse = $e1 * $e1;
						$mses += $mse;
					}
					$mses = $mses / count($data);
				}
				$epoch++;
			} else {
				var_dump('selesai');
			}
//		}
		}
		$training = array(
			'id_inisial' => $inisial['id_in'],
			'input' => json_encode($vij),
			'hidden' => json_encode($wjk),
			'mse' => $mses
		);
		$this->model->tambah('bobot_baru',$training);
//		redirect('training/lihat/'.$inisial['id_in']);

		$bobot = $this->model->first($id, 'id_inisial', 'bobot_baru');
		$datas = $this->model->search($inisial['koridor'], 'koridor', 'data_koridor');
		$max = $this->max($inisial['koridor']);
		$min = $this->min($inisial['koridor']);

		$data = array();
		$jumlah = round(count($datas) * ($inisial['jumlah']) / 100);
		for ($i = 0; $i < $jumlah; $i++) {
			array_push($data, array(
				'x1n' => $datas[$i]['x1n'],
				'x2n' => $datas[$i]['x2n'],
				'x3n' => $datas[$i]['x3n'],
				'x4n' => $datas[$i]['x4n'],
				'x5n' => $datas[$i]['x5n'],
				'targetn' => $datas[$i]['targetn'],
			));
		}

		$input = json_decode($bobot['input'], true);
		$hidden = json_decode($bobot['hidden'], true);

		$hasil = array();
		$denom = array();
		$target = array();
		$hasilp = array();
		$denomp = array();
		$tas = array();
		$mses = 0;

		foreach ($data as $key => $value) {
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
			array_push($hasil, $yk);
			$e1 = $value['targetn'] - $yk;
			array_push($target, $value['targetn']);

			$ta = (($value['targetn'] - 0.1) * (($max - $min) / 0.8)) + $min;
			array_push($tas, round($ta));

			$d = (($yk - 0.1) * (($max - $min) / 0.8)) + $min;
			array_push($denom, $d);

			$mse = $e1 * $e1;
			$mses += $mse;
		}
		$mses = $mses / count($data);

		$enddata = (end($data));
		$datap = array(
			'x1n' => $enddata['x2n'],
			'x2n' => $enddata['x3n'],
			'x3n' => $enddata['x4n'],
			'x4n' => $enddata['x5n'],
			'x5n' => $enddata['targetn'],
			'targetn' => $enddata['x1n'],
		);

		$zinj = array();
		$zj = array();
		foreach ($input as $key2 => $value2) {
			array_push($zinj, ($value2[0] + $datap['x1n'] * $value2[1] + $datap['x2n'] * $value2[2] + $datap['x3n'] * $value2[3] + $datap['x4n'] * $value2[4] + $datap['x5n'] * $value2[5]));
			array_push($zj, (1 / (1 + exp(0 - $zinj[$key2 - 1]))));
		}
		$yink = $hidden[0];
		for ($i = 1; $i < count($hidden); $i++) {
			$yink += ($hidden[$i] * $zj[$i - 1]);
		}
		$yk = 1 / (1 + exp(0 - $yink));
		$hasilp = $yk;

		$d = (($yk - 0.1) * (($max - $min) / 0.8)) + $min;
		$denomp = $d;

		$simpan = array(
			'id_bobot' => $bobot['id'],
			'hasil_prediksi' => json_encode($hasil),
			'denormalisasi' => json_encode($denom),
			'target' => json_encode($target),
			'targeta' => json_encode($tas),
			'mses' => $mses
		);

		$simpanp = array(
			'id_bobot' => $bobot['id'],
			'hasil' => $hasilp,
			'denormalisasi_hasil' => $denomp
		);
//		var_dump($simpanp);

		$this->model->tambah('akurasi',$simpan);
		$this->model->tambah('prediksi',$simpanp);
		redirect('training/lihat/'.$id);

	}

	public function hapus($id){
		$inisial = $this->model->first($id,'id_in','inisialisasi');
		$training = $this->model->getHapusTraining($id);
		$akurasi = $this->model->getAkurasi1($training['id']);

		$this->model->hapus($id,'id_in','inisialisasi');
		$this->model->hapus($id,'id_inisial','bobot_baru');
		$this->model->hapus($training['id'],'id_bobot','akurasi');
		$this->model->hapus($training['id'],'id_bobot','prediksi');

		redirect('training');
	}

	function max($koridor)
	{
		$data = $this->model->searchU($koridor, 'koridor', 'data_koridor');

		$variabel = array(
			'x1' => array(),
			'x2' => array(),
			'x3' => array(),
			'x4' => array(),
			'x5' => array(),
		);
		foreach ($data as $key => $value) {
			array_push($variabel['x1'], $value['x1']);
			array_push($variabel['x2'], $value['x2']);
			array_push($variabel['x3'], $value['x3']);
			array_push($variabel['x4'], $value['x4']);
			array_push($variabel['x5'], $value['x5']);
		}
		return max($variabel['x1']);
	}

	function min($koridor)
	{
		$data = $this->model->searchU($koridor, 'koridor', 'data_koridor');

		$variabel = array(
			'x1' => array(),
			'x2' => array(),
			'x3' => array(),
			'x4' => array(),
			'x5' => array(),
		);
		foreach ($data as $key => $value) {
			array_push($variabel['x1'], $value['x1']);
			array_push($variabel['x2'], $value['x2']);
			array_push($variabel['x3'], $value['x3']);
			array_push($variabel['x4'], $value['x4']);
			array_push($variabel['x5'], $value['x5']);
		}
		return min($variabel['x5']);
	}
}
