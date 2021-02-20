<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_siswa extends CI_Model
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
	var $column_order = array(null, 'a.siswa_nis', 'a.siswa_nama', 'b.kelas_nama', 'a.siswa_email', 'a.siswa_no_telp', 'c.satelit_nama', 'a.soft_deleted', null);
	var $column_search = array('a.siswa_nis', 'a.siswa_nama', 'b.kelas_nama', 'a.siswa_email', 'a.siswa_no_telp', 'c.satelit_nama');
	function _get_datatable_query()
	{
		$this->db->select('a.siswa_nis,a.siswa_photo, a.siswa_nama, b.kelas_nama, a.siswa_email, a.siswa_no_telp, c.satelit_nama, a.soft_deleted');
		$this->db->from($this->table . ' a');
		$this->db->join('tbl_kelas b', 'a.siswa_kelas_id = b.kelas_id', 'inner');
		$this->db->join('tbl_satelit c', 'a.satelit = c.satelit_id', 'right');
		$this->db->where(['a.soft_deleted'=>'0']);
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

	function simpan_siswa($nis, $nama, $jenkel, $kelas, $photo)
	{
		$hsl = $this->db->query("INSERT INTO tbl_siswa  
			(siswa_nis,siswa_nama,siswa_jenkel,siswa_kelas_id,siswa_photo) 
			VALUES ('$nis','$nama','$jenkel','$kelas','$photo')");
		return $hsl;
	}

	function simpan_siswa_tanpa_img($nis, $nisn, $nama, $jenkel, $kelas, $agama, $kewarganegaraan, $alamat, $email, $file, $nmayah, $nikayah, $ttlayah, $ptayah, $kayah, $pnayah, $nmibu, $nikibu, $ttlibu, $ptibu, $kibu, $pnibu, $nmwali, $nikwali, $ttlwali, $ptwali, $kwali, $pnwali)
	{
		$hsl = $this->db->query("INSERT INTO tbl_siswa (siswa_nis,siswa_nisn,siswa_nama,siswa_jenkel,siswa_kelas_id,siswa_agama_id,siswa_kewarganegaraan,siswa_alamat,siswa_email,siswa_dokumen) VALUES ('$nis','$nisn','$nama','$jenkel','$kelas','$agama','$kewarganegaraan','$alamat','$email','$file')");

		$this->db->query("INSERT INTO tbl_orangtua (siswa_nis,ayah_nama,ayah_nik,ayah_ttl,ayah_pendidikan,ayah_pekerjaan,ayah_penghasilan,ibu_nama,ibu_nik,ibu_ttl,ibu_pendidikan,ibu_pekerjaan,ibu_penghasilan,wali_nama,wali_nik,wali_ttl,wali_pendidikan,wali_pekerjaan,wali_penghasilan) VALUES ('$nis','$nmayah','$nikayah','$ttlayah','$ptayah','$kayah','$pnayah','$nmibu','$nikibu','$ttlibu','$ptibu','$kibu','$pnibu','$nmwali','$nikwali','$ttlwali','$ptwali','$kwali','$pnwali')");
		$this->db->query("INSERT INTO tbl_pengguna (pengguna_nama,pengguna_username,pengguna_password) VALUES ('$nama','$nis',md5('$nis'))");
		return $hsl;
	}

	function update_siswa($kode, $nis, $nama, $jenkel, $kelas, $photo)
	{
		$hsl = $this->db->query("UPDATE tbl_siswa SET siswa_nis='$nis',siswa_nama='$nama',siswa_jenkel='$jenkel',siswa_kelas_id='$kelas',siswa_photo='$photo' WHERE siswa_id='$kode'");
		return $hsl;
	}
	function update_siswa_tanpa_img($kode, $nis, $nama, $jenkel, $kelas)
	{
		$hsl = $this->db->query("UPDATE tbl_siswa SET siswa_nis='$nis',siswa_nama='$nama',siswa_jenkel='$jenkel',siswa_kelas_id='$kelas' WHERE siswa_id='$kode'");

		return $hsl;
	}
	function hapus_siswa($kode, $nis)
	{
		$hsl = $this->db->query("DELETE FROM tbl_orangtua where siswa_nis='$nis'");
		$this->db->query("DELETE FROM tbl_siswa WHERE siswa_id='$kode'");
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
	function update_siswa_keluar($kode, $nis)
	{
		$hsl = $this->db->query("UPDATE tbl_siswa SET siswa_nis='$nis',soft_deleted=0 WHERE siswa_id='$kode'");
		$this->db->query("DELETE FROM tbl_pengguna where pengguna_username='$nis'");
		return $hsl;
	}
}
