<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_login extends CI_Model
{
	function cekadmin($u, $p)
	{
		$qry = 'select * from tbl_pengguna where pengguna_username="' . $u . '" and pengguna_password=md5("' . $p . '") and pengguna_status="1"';
		$hasil = $this->db->query($qry);
		return $hasil;
	}
}
