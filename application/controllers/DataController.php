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
		$this->load->model('Model','model');
		if (!$this->session->has_userdata('session_id')) {
			redirect(base_url('login'));
		}
	}

	public function index(){
		$data = array(
			'koridor' => $this->model->get('data_koridor')
		);
		$this->load->view('template/header');
		$this->load->view('data/index',$data);
		$this->load->view('template/footer');
	}

	public function import(){
		if (isset($_POST['upload'])) {
			$upload = $this->model->upload_excel('excel');
			if ($upload['result'] == 'success') {
				$reader = new Reader\Xlsx();
				$reader->setLoadSheetsOnly('koridor');
				$spreadsheet = $reader->load(FCPATH . '/assets/excel/import/' . $upload['file']['file_name']);
				$sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
				var_dump($sheet);
				foreach ($sheet as $key => $value) {
					if ($key>1){
						$data = array(
							'x1' => $value['A'],
							'x2' => $value['B'],
							'x3' => $value['C'],
							'x4' => $value['D'],
							'x5' => $value['E'],
							'target' => $value['F'],
							'koridor' => $value['G']
						);
						$this->model->tambah('data_koridor',$data);
					}
				}
			}
			redirect('data');
		}
	}
}
