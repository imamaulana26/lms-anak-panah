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
		$data = array();

		if (isset($_POST['xta'])) {
			$data['tahun'] = $this->db->get_where('tbl_nilai', ['ta' => $this->input->post('xta')])->row_array();
		} else {
			$data['tahun'] = $this->db->select_max('ta')->from('tbl_nilai')->get()->row_array();
		}

		$akses = $this->session->userdata('akses');

		if ($akses == 1) {
			$this->load->view('admin/v_dashboard');
		} elseif ($akses == 2) {
			$data['oc'] = $this->db->select('*')->from('tbl_pelajaran a')
				->join('tbl_mapel b', 'a.kd_mapel = b.kd_mapel')
				->join('tbl_kelas c', 'a.id_kelas = c.kelas_id')
				->where(['a.kd_pengajar' => 2])
				->get()->result_array();

			$this->load->view('siswa/layout/v_header');
			$this->load->view('siswa/layout/v_navbar');
			$this->load->view('siswa/v_dashboard', $data);
			$this->load->view('siswa/layout/v_footer');
		} else {
			$data['oc'] = $this->db->select('*')->from('tbl_pelajaran a')
				->join('tbl_mapel b', 'a.kd_mapel = b.kd_mapel')
				->join('tbl_kelas c', 'a.id_kelas = c.kelas_id')
				->where(['a.kd_pengajar' => 2])
				->get()->result_array();

			$this->load->view('pengajar/layout/v_header');
			$this->load->view('pengajar/layout/v_navbar');
			$this->load->view('pengajar/v_dashboard', $data);
			$this->load->view('pengajar/layout/v_footer');
		}
	}

	function pengumuman()
	{
		$this->db->update('tbl_pengumuman', ['pengumuman_deskripsi' => $this->input->post('pengumuman'), 'aktifkan' => $this->input->post('aktiv')], ['pengumuman_id' => 1]);
		echo "<script type='text/javascript'>alert('Pengumuman Diupdate');window.location.replace('./dashboard');</script>";
	}
}
