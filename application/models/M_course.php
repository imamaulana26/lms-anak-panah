<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_course extends CI_Model
{

	function get_course()
	{
		$user = $this->session->userdata('username');
		$siswa = $this->db->get_where('tbl_siswa', ['siswa_nis' => $user])->row_array();

		$data = $this->db->select('*')->from('tbl_pelajaran a')->join('tbl_mapel b', 'a.kd_mapel = b.kd_mapel', 'right')
			->where(['a.id_kelas' => $siswa['siswa_kelas_id']])->get();
		return $data;
	}
}
