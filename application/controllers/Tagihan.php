<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tagihan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url('login');
			redirect($url);
		};
		$this->load->model('m_pengguna');
	}

	public function index()
	{
		$data['list'] = $this->db->get('tbl_tagihan')->result_array();

		$this->load->view('admin/v_tagihan', $data);
	}

	function tambah_tagihan()
	{
		$data = array(
			'jns_tagihan' => strip_tags($this->input->post('jns_tagihan')),
			'nom_tagihan' => strip_tags($this->input->post('nom_tagihan'))
		);

		$this->db->insert('tbl_tagihan', $data);
		// echo "<script>alert('Penambahan Berhasil');</script>";
		$this->session->set_flashdata('msg', 'success');
		redirect('tagihan', 'refresh');
	}

	function edit_tagihan_submit()
	{
		$data = array(
			'nom_tagihan' => strip_tags($this->input->post('nom_tagihan')),
			'sts_tagihan' => strip_tags($this->input->post('sts'))
		);

		$this->db->update('tbl_tagihan', $data, ['id_tagihan' => $this->input->post('id_tagihan')]);

		$this->session->set_flashdata('msg', 'info');
		redirect('tagihan', 'refresh');
	}
}
