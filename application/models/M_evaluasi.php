<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_evaluasi extends CI_Model
{

	function get_all_files()
	{
		$hsl = $this->db->query("SELECT siswa_nis,siswa_nama,siswa_kelas_id,soft_deleted,kelas_nama,tbl_evaluasi.* FROM tbl_evaluasi
			JOIN tbl_kelas ON kelas_siswa=kelas_id
			JOIN tbl_siswa ON nis_siswa=siswa_nis
			WHERE soft_deleted=1");

		return $hsl;
	}
	function get_kelas_1()
	{
		$hsl = $this->db->query("SELECT tbl_siswa.*,kelas_nama,tbl_evaluasi.* FROM tbl_siswa
			JOIN tbl_kelas ON siswa_kelas_id=kelas_id
			JOIN tbl_evaluasi ON nis_siswa=siswa_nis
			WHERE soft_deleted=1 ");
		return $hsl;
	}
	function get_category()
	{
		$query = $this->db->query("SELECT tbl_siswa.*,kelas_nama FROM tbl_siswa
			JOIN tbl_kelas ON siswa_kelas_id=kelas_id
			WHERE soft_deleted=1");
		return $query;
	}

	function get_sub_category($category_id)
	{
		$query = $this->db->get_where('tbl_siswa', array('siswa_kelas_id' => $category_id, 'soft_deleted' => 1));
		return $query;
	}

	function simpan_file($nis, $semester, $file, $kelas)
	{
		$hsl = $this->db->query("INSERT INTO tbl_evaluasi(nis_siswa,semester,upload_gambar,kelas_siswa) VALUES ('$nis','$semester','$file','$kelas')");
		$this->db->query("DELETE c1 FROM tbl_evaluasi c1
			INNER JOIN tbl_evaluasi c2 
			WHERE
			c1.id_evaluasi < c2.id_evaluasi AND 
			c1.semester = c2.semester AND
			c1.nis_siswa = c2.nis_siswa AND
			c1.kelas_siswa = c2.kelas_siswa
			");
		return $hsl;
	}

	// function verifycheck(){
	// 	$hsl=$this->db->query("SELECT *, ROW_NUMBER()OVER(PARTITION BY semester ORDER BY semester) AS RowNumber
	//   FROM tbl_evaluasi ");
	// }
	// function deletedduplicate(){

	function update_file($kode, $judul, $deskripsi, $oleh, $file)
	{
		$hsl = $this->db->query("UPDATE tbl_files SET file_judul='$judul',file_deskripsi='$deskripsi',file_oleh='$oleh',file_data='$file' WHERE file_id='$kode'");
		return $hsl;
	}
	function update_file_tanpa_file($kode, $judul, $deskripsi, $oleh)
	{
		$hsl = $this->db->query("UPDATE tbl_files SET file_judul='$judul',file_deskripsi='$deskripsi',file_oleh='$oleh' WHERE file_id='$kode'");
		return $hsl;
	}
	function hapus_file($kode)
	{
		$hsl = $this->db->query("DELETE FROM tbl_evaluasi WHERE id_evaluasi='$kode'");
		return $hsl;
	}

	function get_file_byid($id)
	{
		$hsl = $this->db->query("SELECT file_id,file_judul,file_deskripsi,DATE_FORMAT(file_tanggal,'%d/%m/%Y') AS tanggal,file_oleh,file_download,file_data FROM tbl_files WHERE file_id='$id'");
		return $hsl;
	}

	//Front-end
	function get_files_home()
	{
		$hsl = $this->db->query("SELECT file_id,file_judul,file_deskripsi,DATE_FORMAT(file_tanggal,'%d/%m/%Y') AS tanggal,file_oleh,file_download,file_data FROM tbl_files ORDER BY file_id DESC limit 7");
		return $hsl;
	}
}
