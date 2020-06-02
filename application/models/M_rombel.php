<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_rombel extends CI_Model
{
	// datatables server side
	var $table = 'tbl_siswa'; // table yang ingin ditampilkan
	var $order = array('a.siswa_id' => 'asc');
	var $id = 'a.siswa_nis';
	var $column_order = array(null, 'a.siswa_nis', 'a.siswa_nama', 'b.kelas_nama', 'a.siswa_email', 'a.siswa_no_telp', null);
	var $column_search = array('a.siswa_nis', 'a.siswa_nama', 'b.kelas_nama', 'a.siswa_email', 'a.siswa_no_telp');

	function _get_datatable_query()
	{
		$this->db->select('a.siswa_nis, a.siswa_nama, b.kelas_nama, a.siswa_email, a.siswa_no_telp');
		$this->db->from($this->table . ' a');
		$this->db->join('tbl_kelas b', 'a.siswa_kelas_id = b.kelas_id', 'inner');
		if (isset($_POST['columns'][2]['search']['value']) and $_POST['columns'][2]['search']['value'] != 'all') {
			$this->db->where('a.siswa_nama', $_POST['columns'][2]['search']['value']);
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






	function get_all_siswa()
	{
		$hsl = $this->db->query("SELECT tbl_siswa.*,kelas_nama ,keuangan_nama,agama_nama,tbl_orangtua.* FROM tbl_siswa
			JOIN tbl_kelas ON siswa_kelas_id=kelas_id 
			JOIN tbl_keuangan ON siswa_keuangan_id=keuangan_id 
			JOIN tbl_agama ON siswa_agama_id=agama_id 
			JOIN tbl_orangtua on tbl_siswa.siswa_nis=tbl_orangtua.siswa_nis
			WHERE soft_deleted=1");
		return $hsl;
	}
	function get_all_siswa_lunas()
	{
		$hsl = $this->db->query("SELECT tbl_siswa.*,kelas_nama , keuangan_nama FROM tbl_siswa
			JOIN tbl_kelas ON siswa_kelas_id=kelas_id 
			JOIN tbl_keuangan ON siswa_keuangan_id=keuangan_id 
			WHERE soft_deleted=1 AND siswa_keuangan_id=1 ");
		return $hsl;
	}
	function get_all_siswa_kelas_1()
	{
		$hsl = $this->db->query("SELECT tbl_siswa.*,kelas_nama ,keuangan_nama,agama_nama,tbl_orangtua.* FROM tbl_siswa
			JOIN tbl_kelas ON siswa_kelas_id=kelas_id 
			JOIN tbl_keuangan ON siswa_keuangan_id=keuangan_id 
			JOIN tbl_agama ON siswa_agama_id=agama_id 
			JOIN tbl_orangtua on tbl_siswa.siswa_nis=tbl_orangtua.siswa_nis
			WHERE soft_deleted=1 AND siswa_kelas_id=1 and alumni=0");
		return $hsl;
	}
	function get_all_siswa_kelas_2()
	{
		$hsl = $this->db->query("SELECT tbl_siswa.*,kelas_nama ,keuangan_nama,agama_nama,tbl_orangtua.* FROM tbl_siswa
			JOIN tbl_kelas ON siswa_kelas_id=kelas_id 
			JOIN tbl_keuangan ON siswa_keuangan_id=keuangan_id 
			JOIN tbl_agama ON siswa_agama_id=agama_id 
			JOIN tbl_orangtua on tbl_siswa.siswa_nis=tbl_orangtua.siswa_nis
			WHERE soft_deleted=1 AND siswa_kelas_id=2 and alumni=0");
		return $hsl;
	}
	function get_all_siswa_kelas_3()
	{
		$hsl = $this->db->query("SELECT tbl_siswa.*,kelas_nama ,keuangan_nama,agama_nama,tbl_orangtua.* FROM tbl_siswa
			JOIN tbl_kelas ON siswa_kelas_id=kelas_id 
			JOIN tbl_keuangan ON siswa_keuangan_id=keuangan_id 
			JOIN tbl_agama ON siswa_agama_id=agama_id 
			JOIN tbl_orangtua on tbl_siswa.siswa_nis=tbl_orangtua.siswa_nis
			WHERE soft_deleted=1 AND siswa_kelas_id=3 and alumni=0");
		return $hsl;
	}
	function get_all_siswa_kelas_4()
	{
		$hsl = $this->db->query("SELECT tbl_siswa.*,kelas_nama ,keuangan_nama,agama_nama,tbl_orangtua.* FROM tbl_siswa
			JOIN tbl_kelas ON siswa_kelas_id=kelas_id 
			JOIN tbl_keuangan ON siswa_keuangan_id=keuangan_id 
			JOIN tbl_agama ON siswa_agama_id=agama_id 
			JOIN tbl_orangtua on tbl_siswa.siswa_nis=tbl_orangtua.siswa_nis
			WHERE soft_deleted=1 AND siswa_kelas_id=4 and alumni=0");
		return $hsl;
	}
	function get_all_siswa_kelas_5()
	{
		$hsl = $this->db->query("SELECT tbl_siswa.*,kelas_nama ,keuangan_nama,agama_nama,tbl_orangtua.* FROM tbl_siswa
			JOIN tbl_kelas ON siswa_kelas_id=kelas_id 
			JOIN tbl_keuangan ON siswa_keuangan_id=keuangan_id 
			JOIN tbl_agama ON siswa_agama_id=agama_id 
			JOIN tbl_orangtua on tbl_siswa.siswa_nis=tbl_orangtua.siswa_nis
			WHERE soft_deleted=1 AND siswa_kelas_id=5 and alumni=0");
		return $hsl;
	}
	function get_all_siswa_kelas_6()
	{
		$hsl = $this->db->query("SELECT tbl_siswa.*,kelas_nama ,keuangan_nama,agama_nama,tbl_orangtua.* FROM tbl_siswa
			JOIN tbl_kelas ON siswa_kelas_id=kelas_id 
			JOIN tbl_keuangan ON siswa_keuangan_id=keuangan_id 
			JOIN tbl_agama ON siswa_agama_id=agama_id 
			JOIN tbl_orangtua on tbl_siswa.siswa_nis=tbl_orangtua.siswa_nis
			WHERE soft_deleted=1 AND siswa_kelas_id=6 and alumni=0");
		return $hsl;
	}
	function get_all_siswa_kelas_7()
	{
		$hsl = $this->db->query("SELECT tbl_siswa.*,kelas_nama ,keuangan_nama,agama_nama,tbl_orangtua.* FROM tbl_siswa
			JOIN tbl_kelas ON siswa_kelas_id=kelas_id 
			JOIN tbl_keuangan ON siswa_keuangan_id=keuangan_id 
			JOIN tbl_agama ON siswa_agama_id=agama_id 
			JOIN tbl_orangtua on tbl_siswa.siswa_nis=tbl_orangtua.siswa_nis
			WHERE soft_deleted=1 AND siswa_kelas_id=7 and alumni=0");
		return $hsl;
	}
	function get_all_siswa_kelas_8()
	{
		$hsl = $this->db->query("SELECT tbl_siswa.*,kelas_nama ,keuangan_nama,agama_nama,tbl_orangtua.* FROM tbl_siswa
			JOIN tbl_kelas ON siswa_kelas_id=kelas_id 
			JOIN tbl_keuangan ON siswa_keuangan_id=keuangan_id 
			JOIN tbl_agama ON siswa_agama_id=agama_id 
			JOIN tbl_orangtua on tbl_siswa.siswa_nis=tbl_orangtua.siswa_nis
			WHERE soft_deleted=1 AND siswa_kelas_id=8 and alumni=0");
		return $hsl;
	}
	function get_all_siswa_kelas_9()
	{
		$hsl = $this->db->query("SELECT tbl_siswa.*,kelas_nama ,keuangan_nama,agama_nama,tbl_orangtua.* FROM tbl_siswa
			JOIN tbl_kelas ON siswa_kelas_id=kelas_id 
			JOIN tbl_keuangan ON siswa_keuangan_id=keuangan_id 
			JOIN tbl_agama ON siswa_agama_id=agama_id 
			JOIN tbl_orangtua on tbl_siswa.siswa_nis=tbl_orangtua.siswa_nis
			WHERE soft_deleted=1 AND siswa_kelas_id=9 and alumni=0");
		return $hsl;
	}
	function get_all_siswa_kelas_10()
	{
		$hsl = $this->db->query("SELECT tbl_siswa.*,kelas_nama ,keuangan_nama,agama_nama,tbl_orangtua.* FROM tbl_siswa
			JOIN tbl_kelas ON siswa_kelas_id=kelas_id 
			JOIN tbl_keuangan ON siswa_keuangan_id=keuangan_id 
			JOIN tbl_agama ON siswa_agama_id=agama_id 
			JOIN tbl_orangtua on tbl_siswa.siswa_nis=tbl_orangtua.siswa_nis
			WHERE soft_deleted=1 AND siswa_kelas_id=10 and alumni=0");
		return $hsl;
	}
	function get_all_siswa_kelas_11()
	{
		$hsl = $this->db->query("SELECT tbl_siswa.*,kelas_nama ,keuangan_nama,agama_nama,tbl_orangtua.* FROM tbl_siswa
			JOIN tbl_kelas ON siswa_kelas_id=kelas_id 
			JOIN tbl_keuangan ON siswa_keuangan_id=keuangan_id 
			JOIN tbl_agama ON siswa_agama_id=agama_id 
			JOIN tbl_orangtua on tbl_siswa.siswa_nis=tbl_orangtua.siswa_nis
			WHERE soft_deleted=1 AND siswa_kelas_id=11 and alumni=0");
		return $hsl;
	}
	function get_all_siswa_kelas_12()
	{
		$hsl = $this->db->query("SELECT tbl_siswa.*,kelas_nama ,keuangan_nama,agama_nama,tbl_orangtua.* FROM tbl_siswa
			JOIN tbl_kelas ON siswa_kelas_id=kelas_id 
			JOIN tbl_keuangan ON siswa_keuangan_id=keuangan_id 
			JOIN tbl_agama ON siswa_agama_id=agama_id 
			JOIN tbl_orangtua on tbl_siswa.siswa_nis=tbl_orangtua.siswa_nis
			WHERE soft_deleted=1 AND siswa_kelas_id=12 and alumni=0");
		return $hsl;
	}
	function get_all_siswa_kelas_13()
	{
		$hsl = $this->db->query("SELECT tbl_siswa.*,kelas_nama ,keuangan_nama,agama_nama,tbl_orangtua.* FROM tbl_siswa
			JOIN tbl_kelas ON siswa_kelas_id=kelas_id 
			JOIN tbl_keuangan ON siswa_keuangan_id=keuangan_id 
			JOIN tbl_agama ON siswa_agama_id=agama_id 
			JOIN tbl_orangtua on tbl_siswa.siswa_nis=tbl_orangtua.siswa_nis
			WHERE soft_deleted=1 AND siswa_kelas_id=13 and alumni=0");
		return $hsl;
	}
	function get_all_siswa_kelas_14()
	{
		$hsl = $this->db->query("SELECT tbl_siswa.*,kelas_nama ,keuangan_nama,agama_nama,tbl_orangtua.* FROM tbl_siswa
			JOIN tbl_kelas ON siswa_kelas_id=kelas_id 
			JOIN tbl_keuangan ON siswa_keuangan_id=keuangan_id 
			JOIN tbl_agama ON siswa_agama_id=agama_id 
			JOIN tbl_orangtua on tbl_siswa.siswa_nis=tbl_orangtua.siswa_nis
			WHERE soft_deleted=1 AND siswa_kelas_id=14 and alumni=0");
		return $hsl;
	}
	function get_all_siswa_kelas_15()
	{
		$hsl = $this->db->query("SELECT tbl_siswa.*,kelas_nama ,keuangan_nama,agama_nama,tbl_orangtua.* FROM tbl_siswa
			JOIN tbl_kelas ON siswa_kelas_id=kelas_id 
			JOIN tbl_keuangan ON siswa_keuangan_id=keuangan_id 
			JOIN tbl_agama ON siswa_agama_id=agama_id 
			JOIN tbl_orangtua on tbl_siswa.siswa_nis=tbl_orangtua.siswa_nis
			WHERE soft_deleted=1 AND siswa_kelas_id=15 and alumni=0");
		return $hsl;
	}

	function siswa()
	{
		$hsl = $this->db->query("SELECT tbl_siswa.*,kelas_nama FROM tbl_siswa JOIN tbl_kelas ON siswa_kelas_id=kelas_id ");
		return $hsl;
	}


	function siswa_perpage($offset, $limit)
	{
		$hsl = $this->db->query("SELECT tbl_siswa.*,kelas_nama FROM tbl_siswa JOIN tbl_kelas ON siswa_kelas_id=kelas_id limit $offset,$limit");
		return $hsl;
	}
	function get_all_siswa_out()
	{
		$hsl = $this->db->query("SELECT tbl_siswa.*,kelas_nama FROM tbl_siswa JOIN tbl_kelas ON siswa_kelas_id=kelas_id WHERE soft_deleted=0");


		return $hsl;
	}
}
