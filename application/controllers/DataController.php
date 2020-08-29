<?php

require FCPATH . 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader;

class DataController extends CI_Controller
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
			'koridor' => $this->model->get('data_koridor'),
			'hapus' => $this->model->getHapusData()
		);
		$this->load->view('template/header');
		$this->load->view('data/index', $data);
		$this->load->view('template/footer');
	}

	public function import()
	{
		if (isset($_POST['upload'])) {
			$upload = $this->model->upload_excel('excel');
			if ($upload['result'] == 'success') {
				$reader = new Reader\Xlsx();
				$reader->setLoadSheetsOnly('koridor');
				$spreadsheet = $reader->load(FCPATH . '/assets/excel/import/' . $upload['file']['file_name']);
				$sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
				foreach ($sheet as $key => $value) {
					if ($key > 1) {
						$data = array(
							'x1' => $value['A'],
							'x2' => $value['B'],
							'x3' => $value['C'],
							'x4' => $value['D'],
							'x5' => $value['E'],
							'target' => $value['F'],
							'koridor' => strval($value['G'])
						);
						$this->model->tambah('data_koridor', $data);
					}
				}
				redirect('data');
			}
		}
	}

	public function normalisasi()
	{
		if (isset($_POST['gas'])) {
			$koridor = $this->input->post('koridor');
			$data = $this->model->searchU($koridor, 'koridor', 'data_koridor');
			$max = $this->max($koridor);
			$min = $this->min($koridor);
			foreach ($data as $key => $value) {
				if ($value['targetn'] == null) {
					$x1 = (0.8) * ($value['x1'] - $min) / ($max - $min) + 0.1;
					$x2 = (0.8) * ($value['x2'] - $min) / ($max - $min) + 0.1;
					$x3 = (0.8) * ($value['x3'] - $min) / ($max - $min) + 0.1;
					$x4 = (0.8) * ($value['x4'] - $min) / ($max - $min) + 0.1;
					$x5 = (0.8) * ($value['x5'] - $min) / ($max - $min) + 0.1;
					$target = (0.8) * ($value['target'] - $min) / ($max - $min) + 0.1;
					$update = array(
						'x1n' => $x1,
						'x2n' => $x2,
						'x3n' => $x3,
						'x4n' => $x4,
						'x5n' => $x5,
						'targetn' => $target,
					);
					$this->model->update($value['id'], 'id', 'data_koridor', $update);
				}
			}
			redirect('data');
		}
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
