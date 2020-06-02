<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Biodata extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url('login');
			redirect($url);
		};
		$this->load->helper('tanggal_helper');
	}
	function index()
	{
		$this->load->view('admin/v_biodata_siswa');
	}

	function indexpres_ta()
	{
	}
}
