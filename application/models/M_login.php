<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model
{
    function cekadmin($u, $p)
    {
        $hasil = $this->db->query("select * from tbl_pengguna where pengguna_username='$u' and pengguna_password=md5('$p')");
        return $hasil;
    }
}
