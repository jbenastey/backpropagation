<?php


class DataController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		$this->load->view('template/header');
		$this->load->view('data/index');
		$this->load->view('template/footer');
	}
}
