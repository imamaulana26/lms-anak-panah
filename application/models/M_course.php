<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_course extends CI_Model
{

	function get_course()
	{
		$user = $this->session->userdata('username');
		$akses = $this->session->userdata('akses');

		if ($akses == 2) {
			$dt_user = $this->db->get_where('tbl_siswa', ['siswa_nis' => $user])->row_array();

			$data = $this->db->select('*')->from('tbl_pelajaran a')->join('tbl_mapel b', 'a.kd_mapel = b.kd_mapel', 'right')
				->where(['a.id_kelas' => $dt_user['siswa_kelas_id']])->get();
		} else {
			$dt_user = $this->db->select('*')->from('tbl_pengguna a')
				->join('tbl_pengajar b', 'a.pengguna_nama = b.nm_pengajar', 'inner')
				->where(['a.pengguna_username' => $user])->get()->row_array();
			$data = $this->db->select('*')->from('tbl_pelajaran a')
				->join('tbl_mapel b', 'a.kd_mapel = b.kd_mapel', 'right')
				->join('tbl_pengajar c', 'a.kd_pengajar = c.id_pengajar', 'right')
				->join('tbl_kelas d', 'a.id_kelas = d.kelas_id', 'inner')
				->where(['c.id_pengajar' => $dt_user['id_pengajar']])
				->order_by('id_kelas', 'ASC')
				->get();

			// var_dump($data->result_array());
			// die;
		}

		return $data;
	}
}
