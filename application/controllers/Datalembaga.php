<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Datalembaga extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url('login');
			redirect($url);
		};
		$this->load->library('upload');
	}


	function index()
	{
		$this->load->view('admin/v_datalembaga');
	}

	function update_lembaga()
	{
		$data = array(
			'nm_lembaga' => strip_tags($this->input->post('nmlembaga')),
			'almt' => strip_tags($this->input->post('alamat')),
			'kode_pos' => strip_tags($this->input->post('kodepos')),
			'kel' => strip_tags($this->input->post('kelurahan')),
			'kec' => strip_tags($this->input->post('kecamatan')),
			'kab' => strip_tags($this->input->post('kabupaten')),
			'prov' => strip_tags($this->input->post('provinsi')),
			'website' => strip_tags($this->input->post('website')),
			'npsn' => strip_tags($this->input->post('npsn')),
			'no_ijin' => strip_tags($this->input->post('nomorijin')),
			'kepsek' => strip_tags($this->input->post('kepsek'))
		);
		$this->db->update('tbl_lembaga', $data, ['id_lembaga' => 1]);
		redirect('datalembaga', 'refresh');
	}
}
