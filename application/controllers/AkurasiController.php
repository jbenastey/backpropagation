<?php


class AkurasiController extends CI_Controller
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
			'akurasi' => $this->model->getAkurasi()
		);
		$this->load->view('template/header');
		$this->load->view('akurasi/index', $data);
		$this->load->view('template/footer');
	}

	public function lihat($id)
	{
		$data['bobot'] = $this->model->getOneAkurasi($id);
		$data['akurasi'] = $this->model->getAkurasi1($data['bobot']['id']);
		$this->load->view('template/header');
		$this->load->view('akurasi/lihat', $data);
		$this->load->view('template/footer');
	}

	public function hitung($id)
	{
		$inisial = $this->model->first($id, 'id', 'inisialisasi');
		$bobot = $this->model->first($id, 'id_inisial', 'bobot_baru');
		$datas = $this->model->searchU($inisial['koridor'], 'koridor', 'data_koridor');
		$max = $this->max($inisial['koridor']);
		$min = $this->min($inisial['koridor']);

		$data = array();
		$jumlah = round(count($datas) * (100 - $inisial['jumlah']) / 100);
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
			'denormalisasi' => $denomp
		);
//		var_dump($simpanp);

		$this->model->tambah('akurasi',$simpan);
		$this->model->tambah('prediksi',$simpanp);
		redirect('akurasi/lihat/'.$id);

	}

	public function grafik($id)
	{
		$akurasi = $this->model->getAkurasi1($id);
		echo json_encode($akurasi);
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
