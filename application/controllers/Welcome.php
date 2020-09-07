<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->has_userdata('session_id')) {
			redirect(base_url('login'));
		}
		$this->load->model('Model');
	}
	public function index()
	{
		$prediksi = $this->Model->getPrediksi();
		$target = json_decode(end($prediksi)['targeta']);
		$data = array(
			'mses' => round(end($prediksi)['mses'],5),
			'besok'=> round(end($prediksi)['denormalisasi_hasil']),
			'sekarang'=> end($target),
			'kemaren'=> $target[count($target)-2]
		);
		$this->load->view('template/header');
		$this->load->view('beranda',$data);
		$this->load->view('template/footer');
	}
}
