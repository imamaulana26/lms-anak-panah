<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Live extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url('login');
			redirect($url);
		};
	}

	public function index()
	{
		$this->load->view('siswa/v_live');
	}
}
