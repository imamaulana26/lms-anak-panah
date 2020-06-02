<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_siswa_keluar extends CI_Model
{
	// function get_all_siswa(){
	// 	$hsl=$this->db->query("SELECT tbl_siswa.*,kelas_nama ,agama_nama,tbl_orangtua.* FROM tbl_siswa
	// 		JOIN tbl_kelas ON siswa_kelas_id=kelas_id 
	// 		JOIN tbl_agama ON siswa_agama_id=agama_id 
	// 		JOIN tbl_orangtua on tbl_siswa.siswa_nis=tbl_orangtua.siswa_nis
	// 		WHERE soft_deleted=1");
	// 	// $hsl=$this->db->query("SELECT * FROM tbl_siswa
	// 	// 	WHERE soft_deleted=1");
	// 	return $hsl;
	// }

	var $table = 'tbl_siswa'; // table yang ingin ditampilkan
	var $order = array('a.siswa_id' => 'asc');
	var $id = 'a.siswa_nis';
	var $column_order = array(null, 'a.siswa_nis', 'a.siswa_nama', 'b.kelas_nama', 'a.siswa_email', 'a.siswa_no_telp', 'c.satelit_nama', null);
	var $column_search = array('a.siswa_nis', 'a.siswa_nama', 'b.kelas_nama', 'a.siswa_email', 'a.siswa_no_telp', 'c.satelit_nama');
	function _get_datatable_query()
	{
		$this->db->select('a.siswa_nis, a.siswa_nama, b.kelas_nama, a.siswa_email, a.siswa_no_telp, c.satelit_nama');
		$this->db->from($this->table . ' a');
		$this->db->join('tbl_kelas b', 'a.siswa_kelas_id = b.kelas_id', 'inner');
		$this->db->join('tbl_satelit c', 'a.satelit = c.satelit_id', 'right');
		$this->db->where('a.soft_deleted', '1');
		if (isset($_POST['columns'][2]['search']['value']) and $_POST['columns'][2]['search']['value'] != 'all') {
			$this->db->where('a.siswa_kelas_id', $_POST['columns'][2]['search']['value']);
		}

		$i = 0;
		foreach ($this->column_search as $item) {
			if ($_POST['search']['value']) {
				if ($i === 0) {
					// $this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if (count($this->column_search) - 1 == $i); //$this->db->group_end();
			}
			$i++;
		}

		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatable_query();
		if ($_POST['length'] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
			$query = $this->db->get();
			return $query->result_array();
		}
	}

	function count_filtered()
	{
		$this->_get_datatable_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function get_all_data()
	{
		$this->db->get($this->table);
		return $this->db->count_all_results();
	}

	// datatables server side
}
