<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penilaian extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$akses = $this->session->userdata('akses');

		if ($akses != 3) {
			redirect(site_url('login/logout'));
		}
	}

	public function index()
	{
		$data['kelas'] = $this->db->select('a.id_kelas, b.kelas_nama')->from('tbl_pelajaran a')
			->join('tbl_kelas b', 'a.id_kelas = b.kelas_id', 'left')
			->join('tbl_mapel c', 'a.kd_mapel = c.kd_mapel', 'left')
			->join('tbl_pengajar d', 'a.kd_pengajar = d.id_pengajar', 'left')
			->where(['d.nm_pengajar' => $_SESSION['nama']])
			->group_by('a.id_kelas, b.kelas_nama')
			->get()->result_array();
		$data['mapel'] = $this->db->select('a.kd_mapel, c.nm_mapel')->from('tbl_pelajaran a')
			->join('tbl_kelas b', 'a.id_kelas = b.kelas_id', 'left')
			->join('tbl_mapel c', 'a.kd_mapel = c.kd_mapel', 'left')
			->join('tbl_pengajar d', 'a.kd_pengajar = d.id_pengajar', 'left')
			->where(['d.nm_pengajar' => $_SESSION['nama']])
			->group_by('a.kd_mapel, c.nm_mapel')
			->get()->result_array();

		$this->load->view('pengajar/layout/v_header');
		$this->load->view('pengajar/layout/v_navbar');
		$this->load->view('pengajar/v_penilaian', $data);
	}

	public function view_nilai()
	{
		$kelas = $this->input->post('kelas');
		$mapel = $this->input->post('mapel');

		$pelajaran = $this->db->get_where('tbl_pelajaran', ['id_kelas' => $kelas, 'kd_mapel' => $mapel])->row_array();

		$siswa = $this->db->select('a.user_siswa, b.siswa_nama')->from('tbl_nilai_onclass a')
			->join('tbl_siswa b', 'a.user_siswa = b.siswa_nis', 'left')
			->where(['a.id_pelajaran' => $pelajaran['id_pelajaran']])
			->group_by('a.user_siswa, b.siswa_nama')
			->get()->result_array();
		$n_forum = $this->db->select('a.user_siswa, b.siswa_nama, a.tipe, a.pertemuan_ke, a.nilai')->from('tbl_nilai_onclass a')
			->join('tbl_siswa b', 'a.user_siswa = b.siswa_nis', 'left')
			->where(['a.id_pelajaran' => $pelajaran['id_pelajaran'], 'a.tipe' => 'Forum'])
			->order_by('a.pertemuan_ke asc')
			->get()->result_array();
		$n_tugas = $this->db->select('a.user_siswa, b.siswa_nama, a.tipe, a.pertemuan_ke, a.nilai')->from('tbl_nilai_onclass a')
			->join('tbl_siswa b', 'a.user_siswa = b.siswa_nis', 'left')
			->where(['a.id_pelajaran' => $pelajaran['id_pelajaran'], 'a.tipe' => 'Tugas'])
			->order_by('a.pertemuan_ke asc')
			->get()->result_array();

		$result = array();

		foreach ($siswa as $sis) {
			$data['data'] = array(
				'nis' => $sis['user_siswa'],
				'siswa' => $sis['siswa_nama']
			);

			foreach ($n_forum as $frm) {
				if ($frm['user_siswa'] == $sis['user_siswa']) {
					$data['data']['dt_forum'][] = array(
						'forum' => $frm['pertemuan_ke'],
						'nilai' => $frm['nilai']
					);
				}
			}
			foreach ($n_tugas as $tgs) {
				if ($tgs['user_siswa'] == $sis['user_siswa']) {
					$data['data']['dt_tugas'][] = array(
						'tugas' => $tgs['pertemuan_ke'],
						'nilai' => $tgs['nilai']
					);
				}
			}

			$result[] = $data;
		}

		echo json_encode(['data' => $result]);
		exit;
	}
}
