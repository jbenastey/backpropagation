<?php

class TrainingController extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model','model');

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
