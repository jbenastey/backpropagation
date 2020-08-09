<?php


class AuthController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('AuthModel');
	}

	public function login()
	{
		if ($this->session->has_userdata('session_id')) {
			$this->session->set_flashdata('alert','sudah_login');
			redirect(base_url());
		}
		if (isset($_POST['login'])) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$data = array(
				'pengguna_username'=>$username,
				'pengguna_password'=>md5($password)
			);
			$cek = $this->AuthModel->cek($data);
			if ($cek != null) {
				$session = array(
					'session_id'=>$cek['pengguna_id'],
					'session_username'=>$cek['pengguna_username'],
					'session_nama'=>$cek['pengguna_nama'],
					'session_password'=>$cek['pengguna_password'],
				);
				$this->session->set_flashdata('alert', 'success_login');
				$this->session->set_userdata($session);
				redirect(base_url());
			}else {
				$this->session->set_flashdata('alert', 'gagalLogin');
				redirect('login');
			}
		}


		$this->load->view('login');
	}
	public function logout(){
		$this->session->sess_destroy();
		$this->session->set_flashdata('alert', 'logout_sukses');
		redirect(base_url('login'));
	}
}
