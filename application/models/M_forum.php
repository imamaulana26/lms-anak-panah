<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_forum extends CI_Model
{
	function get_forum($id)
	{
		$data = $this->db->select('*')->from('tbl_pelajaran a')->join('tbl_mapel b', 'a.kd_mapel = b.kd_mapel', 'right')
			->where(['a.id_pelajaran' => $id])->get()->row_array();
		return $data;
	}

	function get_materi($id)
	{
		$data = $this->db->get_where('tbl_materi_forum', ['id_forum' => $id])->result_array();
		return $data;
	}

	function get_komen($id)
	{
		$data = $this->db->get_where('tbl_komen_forum', ['id_forum' => $id])->result_array();
		return $data;
	}

	function get_siswa($nis)
	{
		$data = $this->db->get_where('tbl_siswa', ['siswa_nis' => $nis])->row_array();
		return $data;
	}
}
