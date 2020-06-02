<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_agama extends CI_Model
{

	function get_all_agama()
	{
		$hsl = $this->db->query("SELECT * FROM tbl_agama");
		return $hsl;
	}
}
