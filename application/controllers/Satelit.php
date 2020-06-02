<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Satelit extends CI_Controller
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
		$this->db->select('*')->from('tbl_siswa a');
		$this->db->join('tbl_satelit b', 'a.satelit = b.satelit_id', 'left');

		$this->db->where(['b.satelit_id' => $this->input->post('satelit')]);
		$data['siswa'] = $this->db->get()->result_array();

		$this->load->view('admin/v_satelit', $data);
	}
	function list_siswa()
	{
		$this->db->select('*')->from('tbl_siswa a');
		$this->db->join('tbl_satelit b', 'a.satelit = b.satelit_id', 'left');
		$this->db->join('tbl_kelas c', 'a.siswa_kelas_id = c.kelas_id', 'left');
		$this->db->where([

			'b.satelit_id' => $this->input->post('satelit'),
			'a.soft_deleted' => 0,
			'c.kelas_id !=' => 16,

		]);
		$data['siswa'] = $this->db->order_by('kelas_id', 'asc')->get()->result_array();


		// var_dump($data);
		// exit();
		$this->load->view('admin/v_satelit', $data);
	}

	function tambah_satelit()
	{

		$data = array(
			'satelit_nama' => $this->input->post('xsatelit'),
			'satelit_alamat' => $this->input->post('xalamatsatelit'),
			'satelit_pic' => $this->input->post('xpicsatelit'),
			'satelit_notelp' => $this->input->post('xnotelpsatelit'),
			'satelit_email' => $this->input->post('xemailsatelit')
		);
		// var_dump($data);
		// exit();
		$this->db->insert('tbl_satelit', $data);
		echo "<script type='text/javascript'>alert('Satelit Berhasil Ditambahkan');window.location.replace('./satelit');</script>";
		// 		redirect('satelit','refresh');
	}
}
