<?php


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
}
