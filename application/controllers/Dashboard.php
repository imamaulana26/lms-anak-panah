<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url('login');
			redirect($url);
		};

		$this->load->model('m_pengunjung');
	}

	function index()
	{
		// $thn = $this->db->get_where('tbl_thn_ajaran',['id_ta'=>$this->input->post('xta')]);

		ob_start('ob_gzhandler');

		if (isset($_POST['xta'])) {
			$data['tahun'] = $this->db->get_where('tbl_nilai', ['ta' => $this->input->post('xta')])->row_array();
		} else {
			$data['tahun'] = $this->db->select_max('ta')->from('tbl_nilai')->get()->row_array();
		}

		if ($this->session->userdata('akses') == '1') {
			$this->load->view('admin/v_dashboard');
		} else {
			$this->load->view('siswa/layout/v_header');
			$this->load->view('siswa/layout/v_navbar');
			$this->load->view('siswa/v_dashboard', $data);
			$this->load->view('siswa/layout/v_footer');
		}
	}

	function pengumuman()
	{
		$this->db->update('tbl_pengumuman', ['pengumuman_deskripsi' => $this->input->post('pengumuman'), 'aktifkan' => $this->input->post('aktiv')], ['pengumuman_id' => 1]);
		echo "<script type='text/javascript'>alert('Pengumuman Diupdate');window.location.replace('./dashboard');</script>";
	}
}
