<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_forum extends CI_Model
{
	function get_forum($id)
	{
		$forum = $this->db->get_where('tbl_forum', ['fr_id_pelajaran' => $id])->row_array();

		$data = $this->db->select('*')->from('tbl_pelajaran a')->join('tbl_mapel b', 'a.kd_mapel = b.kd_mapel', 'right')
			->where(['a.id_pelajaran' => $forum['fr_id_pelajaran']])->get()->row_array();
		return $data;
	}

	function get_materi($id)
	{
		$data = $this->db->get_where('tbl_materi', ['id_forum' => $id])->result_array();
		return $data;
	}

	// function get_komen($id)
	// {
	// 	$data = $this->db->get_where('tbl_komentar', ['id_forum' => $id])->result_array();
	// 	return $data;
	// }
}