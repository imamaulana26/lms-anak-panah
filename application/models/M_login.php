<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_login extends CI_Model
{
	function cekadmin($u, $p)
	{
		$qry = 'select * from tbl_pengguna where pengguna_username="' . $u . '" and pengguna_password=md5("' . $p . '") and pengguna_status="1"';

		$hasil = $this->db->query($qry);
		// var_dump($hasil->row_array());
		// die;
		return $hasil;
	}
	
	function ceksiswa($u)
	{
		$qry = 'select oc,kc,siswa_kelas_id from tbl_siswa where siswa_nis=' . $u;
		$hasil = $this->db->query($qry)->row_array();
		return $hasil;
	}
}
