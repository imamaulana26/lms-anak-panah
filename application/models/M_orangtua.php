<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Orangtua extends CI_Model
{

	function get_all_orangtua()
	{
		$hsl = $this->db->query("SELECT * FROM tbl_orangtua");
		return $hsl;
	}
}
