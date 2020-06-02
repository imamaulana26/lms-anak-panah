<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Evaluasi extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url('login');
			redirect($url);
		};
		$this->load->model('m_evaluasi');
		$this->load->model('m_pengguna');
		$this->load->library('upload');
		$this->load->helper('download');
	}


	function index()
	{

		// $x['data']=$this->m_evaluasi->get_all_files();
		// $x['kelas1']=$this->m_evaluasi->get_kelas_1();

		$this->load->view('admin/v_evaluasi');
	}
}
