<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_guru extends CI_Model
{

	function get_all_guru()
	{
		$hsl = $this->db->query("SELECT * FROM tbl_guru WHERE soft_deleted=0");
		return $hsl;
	}
	function get_all_guru_deleted()
	{
		$hsl = $this->db->query("SELECT * FROM tbl_guru WHERE soft_deleted=1");
		return $hsl;
	}

	function simpan_guru($nip, $nama, $jenkel, $tmp_lahir, $tgl_lahir, $mapel, $photo, $file)
	{
		$hsl = $this->db->query("INSERT INTO tbl_guru (guru_nip,guru_nama,guru_jenkel,guru_tmp_lahir,guru_tgl_lahir,guru_mapel,guru_photo,guru_file) VALUES ('$nip','$nama','$jenkel','$tmp_lahir','$tgl_lahir','$mapel','$photo','$file')");
		return $hsl;
	}
	function simpan_guru_tanpa_img($nip, $nama, $jenkel, $tmp_lahir, $tgl_lahir, $mapel, $file)
	{
		$hsl = $this->db->query("INSERT INTO tbl_guru (guru_nip,guru_nama,guru_jenkel,guru_tmp_lahir,guru_tgl_lahir,guru_mapel,guru_file) VALUES ('$nip','$nama','$jenkel','$tmp_lahir','$tgl_lahir','$mapel','$file')");
		return $hsl;
	}

	function update_guru($kode, $nip, $nama, $jenkel, $tmp_lahir, $tgl_lahir, $mapel, $photo)
	{
		$hsl = $this->db->query("UPDATE tbl_guru SET guru_nip='$nip',guru_nama='$nama',guru_jenkel='$jenkel',guru_tmp_lahir='$tmp_lahir',guru_tgl_lahir='$tgl_lahir',guru_mapel='$mapel',guru_photo='$photo' WHERE guru_id='$kode'");
		return $hsl;
	}
	function update_guru_keluar($kode, $nip, $nama, $jenkel, $tmp_lahir, $tgl_lahir, $mapel, $photo)
	{
		$hsl = $this->db->query("UPDATE tbl_guru SET guru_nip='$nip',guru_nama='$nama',guru_jenkel='$jenkel',guru_tmp_lahir='$tmp_lahir',guru_tgl_lahir='$tgl_lahir',guru_mapel='$mapel',guru_photo='$photo',soft_deleted=1 WHERE guru_id='$kode'");
		return $hsl;
	}
	function update_guru_tanpa_img($kode, $nip, $nama, $jenkel, $tmp_lahir, $tgl_lahir, $mapel)
	{
		$hsl = $this->db->query("UPDATE tbl_guru SET guru_nip='$nip',guru_nama='$nama',guru_jenkel='$jenkel',guru_tmp_lahir='$tmp_lahir',guru_tgl_lahir='$tgl_lahir',guru_mapel='$mapel' WHERE guru_id='$kode'");
		return $hsl;
	}
	function hapus_guru($kode)
	{
		$hsl = $this->db->query("DELETE FROM tbl_guru WHERE guru_id='$kode'");
		return $hsl;
	}

	//front-end
	function guru()
	{
		$hsl = $this->db->query("SELECT * FROM tbl_guru");
		return $hsl;
	}
	function guru_perpage($offset, $limit)
	{
		$hsl = $this->db->query("SELECT * FROM tbl_guru limit $offset,$limit");
		return $hsl;
	}
}
