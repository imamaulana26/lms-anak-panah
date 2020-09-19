<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notifikasi extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url('login');
			redirect($url);
		};
	}

	function index()
	{
		$nis = $this->session->userdata('username');

		$this->db->select('*')->from('tbl_pengguna a')
			->join('tbl_komen_forum b', 'b.user_komen = a.pengguna_username')
			->join('tbl_materi_forum c', 'b.id_forum = c.id_forum and b.pertemuan = c.pertemuan', 'inner')
			->join('tbl_pelajaran d', ' b.id_forum = d.id_pelajaran')
			->join('tbl_mapel e', ' d.kd_mapel = e.kd_mapel')
			->where(['b.mention' => $nis])->order_by('b.createDate', 'desc');

		$data['komen'] = $this->db->get();

		$this->load->view('siswa/layout/v_header');
		$this->load->view('siswa/layout/v_navbar');
		$this->load->view('siswa/v_notif', $data);
		$this->load->view('siswa/layout/v_footer');
	}
}
