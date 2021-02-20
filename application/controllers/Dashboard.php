<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		error_reporting(0);
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
		$arr = array();
		$akses = $this->session->userdata('akses');

		if ($akses == 1) {
			$this->load->view('admin/v_dashboard');
		} elseif ($akses == 2) {
			if (isset($_POST['xta'])) {
				$data['tahun'] = $this->db->get_where('tbl_nilai', ['ta' => $this->input->post('xta')])->row_array();
			} else {
				$data['tahun'] = $this->db->select_max('ta')->from('tbl_nilai')->get()->row_array();
			}

			$siswa = $this->db->get_where('tbl_siswa', ['siswa_nis' => $_SESSION['username']])->row_array();
			$mapel = $this->db->select('b.id_pelajaran, c.nm_mapel')
				->from('tbl_nilai_onclass a')
				->join('tbl_pelajaran b', 'a.id_pelajaran = b.id_pelajaran', 'inner')
				->join('tbl_mapel c', 'b.kd_mapel = c.kd_mapel', 'inner')
				->where(['a.user_siswa' => $siswa['siswa_nis']])
				->group_by('b.id_pelajaran, c.nm_mapel')
				->get()->result_array();

			foreach ($mapel as $mpl) {
				$arr[] = array(
					'id_pelajaran' => $mpl['id_pelajaran'],
					'mapel' => $mpl['nm_mapel']
				);
			}

			for ($i = 0; $i < count($arr); $i++) {
				$forum = $this->db->get_where('tbl_nilai_onclass', ['user_siswa' => $siswa['siswa_nis'], 'tipe' => 'Forum', 'id_pelajaran' => $arr[$i]['id_pelajaran']])->result_array();
				foreach ($forum as $frm) {
					$arr[$i]['item']['forum'][] = array(
						'pertemuan' => $frm['pertemuan_ke'],
						'nilai' => $frm['nilai']
					);
				}
			}

			for ($i = 0; $i < count($arr); $i++) {
				$tugas = $this->db->get_where('tbl_nilai_onclass', ['user_siswa' => $siswa['siswa_nis'], 'tipe' => 'Tugas', 'id_pelajaran' => $arr[$i]['id_pelajaran']])->result_array();
				foreach ($tugas as $tgs) {
					$arr[$i]['item']['tugas'][] = array(
						'pertemuan' => $tgs['pertemuan_ke'],
						'nilai' => $tgs['nilai']
					);
				}
			}

			$data['course'] = $arr;

			$this->load->view('siswa/layout/v_header');
			$this->load->view('siswa/layout/v_navbar');
			$this->load->view('siswa/v_dashboard', $data);
			$this->load->view('siswa/layout/v_footer');
		} else {
			$where = $this->db->get_where('tbl_pengajar', ['nm_pengajar'=> $this->session->userdata('nama')])->row_array();
			
			$data['oc'] = $this->db->select('*')->from('tbl_pelajaran a')
				->join('tbl_mapel b', 'a.kd_mapel = b.kd_mapel')
				->join('tbl_kelas c', 'a.id_kelas = c.kelas_id')
				->where(['a.kd_pengajar' => $where['id_pengajar']])
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
	public function penilaian()
	{
		$siswa = $this->db->get_where('tbl_siswa', ['siswa_nis' => $_SESSION['username']])->row_array();
		$mapel = $this->db->select('b.id_pelajaran, c.nm_mapel')
		->from('tbl_nilai_onclass a')
		->join('tbl_pelajaran b', 'a.id_pelajaran = b.id_pelajaran', 'inner')
		->join('tbl_mapel c', 'b.kd_mapel = c.kd_mapel', 'inner')
		->where(['a.user_siswa' => $siswa['siswa_nis']])
			->group_by('b.id_pelajaran, c.nm_mapel')
			->get()->result_array();

		foreach ($mapel as $mpl) {
			$arr[] = array(
				'id_pelajaran' => $mpl['id_pelajaran'],
				'mapel' => $mpl['nm_mapel']
			);
		}

		for ($i = 0; $i < count($arr); $i++) {
			$forum = $this->db->get_where('tbl_nilai_onclass', ['user_siswa' => $siswa['siswa_nis'], 'tipe' => 'Forum', 'id_pelajaran' => $arr[$i]['id_pelajaran']])->result_array();
			foreach ($forum as $frm) {
				$arr[$i]['item']['forum'][] = array(
					'pertemuan' => $frm['pertemuan_ke'],
					'nilai' => $frm['nilai']
				);
			}
		}

		for ($i = 0; $i < count($arr); $i++) {
			$tugas = $this->db->get_where('tbl_nilai_onclass', ['user_siswa' => $siswa['siswa_nis'], 'tipe' => 'Tugas', 'id_pelajaran' => $arr[$i]['id_pelajaran']])->result_array();
			foreach ($tugas as $tgs) {
				$arr[$i]['item']['tugas'][] = array(
					'pertemuan' => $tgs['pertemuan_ke'],
					'nilai' => $tgs['nilai']
				);
			}
		}

		$data['course'] = $arr;

		$this->load->view('siswa/layout/v_header');
		$this->load->view('siswa/layout/v_navbar');
		$this->load->view('siswa/v_penilaian', $data);
		$this->load->view('siswa/layout/v_footer');
	}
}
