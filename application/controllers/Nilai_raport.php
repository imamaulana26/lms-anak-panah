<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai_raport extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
			$url=base_url('login');
			redirect($url);
		};
	}

	function index(){
		$this->load->view('admin/v_raport');
	}

	function tambah_ta(){
		$ta = $_POST['xta'].'/'.($_POST['xta']+1);
		$sms = $_POST['xsms'];

		$data = array(
			'thn_ajaran'=>$ta,
			'semester'=>$sms
		);
		$this->db->insert('tbl_thn_ajaran', $data);
		redirect('nilai_raport','refresh');
	}

	function update_ta($id){
		// $id=str_replace('-', '/', $ta['thn_ajaran'])
		$result = $this->db->get_where('tbl_thn_ajaran',['id_ta'=>$id])->result_array();
		echo json_encode($result);
		exit;
	}

	function edit_ta(){
		$ta=strip_tags($this->input->post('xta'));
		$sms=strip_tags($this->input->post('xsms'));
		$data=array(
			'tgl_dikeluarkan'=>strip_tags($this->input->post('tgl_dikel')),
			'aktifkan'=>strip_tags($this->input->post('aktiv'))
		);

		// var_dump($data);
		// var_dump($ta);
		// var_dump($sms);
		// exit();
		// var_dump($_POST);
		// exit();
		$this->db->update('tbl_thn_ajaran',$data,array('thn_ajaran' => $ta,'semester' => $sms));
		echo "<script type='text/javascript'>alert('Tahun Ajaran Berhasil Diupdate');window.location.replace('./nilai_raport');</script>";
	}

	function raport_siswa($ta, $sms){

		$data['ta'] = str_replace('-', '/', $ta);
		$data['sms'] = $sms;
		// var_dump($data['ta']);
		// exit();

		$this->db->select('*')->from('tbl_siswa a');
		$this->db->join('tbl_kelas b', 'a.siswa_kelas_id = b.kelas_id', 'left');
		$this->db->where(['b.kelas_id' => $this->input->post('kelas')]);
		$data['siswa'] = $this->db->get()->result_array();


		// var_dump($data);
		// exit();
		$this->load->view('admin/v_list_raport_siswa', $data);
	}

	function data($nis, $ta, $sms){
		$data['nis'] = $nis;
		$data['sms'] = $sms;
		$data['ta'] = str_replace('-', '/', $ta);
		$this->load->view('admin/v_input_nilai', $data);
	}

	function save_raport()
	{	
		// INPUT NILAI RAPORT
		$nis = $_POST['xnis'];
		$kls = $_POST['xkls'];
		$ta = $_POST['xta'];
		$sms = $_POST['xsms'];
		$mapel = $_POST['kd_mapel'];
		$nilai_mapel = $_POST['nilai_mapel'];
		$data = array();

		foreach($mapel as $key => $dt_mapel){ // Kita buat perulangan berdasarkan nis sampai data terakhir
			$data = array(
				'nis_siswa' => $nis,
				'kd_mapel' => $mapel[$key],
				'nilai' => $nilai_mapel[$key],
				'kelas_id' => $kls,
				'ta' => $ta,
				'semester' => $sms
			); 


			$val_nilai = $this->db->get_where('tbl_nilai', ['nis_siswa' => $nis, 'ta' => $ta, 'semester' => $sms, 'kd_mapel' => $data['kd_mapel']]);

			if($val_nilai->num_rows() > 0){
				$this->db->update('tbl_nilai', ['nilai' => $data['nilai'],'kelas_id'=>$data['kelas_id']], ['nis_siswa' => $nis, 'ta' => $ta, 'semester' => $sms, 'kd_mapel' => $data['kd_mapel']]);
			} else {
				$this->db->insert('tbl_nilai', ['nilai' => $data['nilai'],'kelas_id'=>$data['kelas_id'], 'nis_siswa' => $nis, 'ta' => $ta, 'semester' => $sms, 'kd_mapel' => $data['kd_mapel']]);
			}

		}
			// echo "<pre>";
			// var_dump($data);
			// echo "</pre>";
			// exit();

		// INPUT NILAI INDIVIDU
		
		$val_indv = $_POST['val_indv'];
		$nilai_indv = $_POST['nilai_indv'];
		$dt_lama = $_POST['datalama'];

		$nilai = array();

		foreach($val_indv as $n => $val){ // Kita buat perulangan berdasarkan nis sampai data terakhir
			$nilai = array(
				'nis_siswa' => $nis,
				'kegiatan' => $val_indv[$n],
				'nilai' => $nilai_indv[$n],
				'ta' => $ta,
				'semester' => $sms,
				'dt_lama' => $dt_lama[$n]
			);

			// echo "<pre>";
			// var_dump($nilai);
			// echo "</pre>";
			// exit();

			$kondisi = $this->db->get_where('tbl_nilai_indv', ['nis_siswa' => $nis, 'ta' => $ta, 'semester' => $sms, 'kegiatan' => $nilai['dt_lama']]);

			if($nilai['kegiatan'] != ''){
				if($kondisi->num_rows() > 0){
					$this->db->update('tbl_nilai_indv', ['nilai' => $nilai['nilai'], 'kegiatan' => $nilai['kegiatan']], ['nis_siswa' => $nis, 'ta' => $ta, 'semester' => $sms,'kegiatan' => $nilai['dt_lama']]);
				} else {
					$this->db->insert('tbl_nilai_indv', ['nis_siswa' => $nis, 'kegiatan' => $nilai['kegiatan'], 'nilai' => $nilai['nilai'], 'ta' => $ta, 'semester' => $sms]);
				}
			}
		}
			// echo "<pre>";
			// var_dump($nilai);
			// echo "</pre>";
			// exit();


		// INPUT ABSEN
		$absen = array(
			'nis_siswa' => $nis,
			'sakit' => (!empty(strip_tags($this->input->post('sakit')))) ? strip_tags($this->input->post('sakit')) : 0,
			'izin' => (!empty(strip_tags($this->input->post('izin')))) ? strip_tags($this->input->post('izin')) : 0,
			'tanpa_ket' => (!empty(strip_tags($this->input->post('tanpaket')))) ? strip_tags($this->input->post('tanpaket')) : 0,
			'ta' => $ta,
			'semester' => $sms,
		);

		$where = array(
			'nis_siswa' => $nis,
			'ta' => $ta,
			'semester' => $sms,
		);

		// $kondisi1 = $this->db->get_where('tbl_absensi', ['nis_siswa' => $nis, 'ta' => $ta, 'semester' => $sms])->result_array();
		$dt_absen = $this->db->get_where('tbl_absensi', $where);
		if ($dt_absen->num_rows() > 0) {
			$this->db->update('tbl_absensi', $absen , $where);
		} else{
			$this->db->insert('tbl_absensi', $absen);
		}


		// INPUT CATATAN PENTING SISWA
		$catatanpenting = array(
			'nis_siswa' => $nis,
			'sikap' => (!empty(strip_tags($this->input->post('sikap')))) ? strip_tags($this->input->post('sikap')) : 0,
			'kegiatan' => (!empty(strip_tags($this->input->post('kegiatan')))) ? strip_tags($this->input->post('kegiatan')) : 0,
			'tugas' => (!empty(strip_tags($this->input->post('tugas')))) ? strip_tags($this->input->post('tugas')) : 0,
			'ta' => $ta,
			'sms' => $sms,
		);

		$where1 = array(
			'nis_siswa' => $nis,
			'ta' => $ta,
			'sms' => $sms,
		);

		// $kondisi1 = $this->db->get_where('tbl_absensi', ['nis_siswa' => $nis, 'ta' => $ta, 'semester' => $sms])->result_array();
		$dt_catpenting = $this->db->get_where('tbl_catpenting', $where1);
		if ($dt_catpenting->num_rows() > 0) {
			$this->db->update('tbl_catpenting', $catatanpenting , $where1);
		} else{
			$this->db->insert('tbl_catpenting', $catatanpenting);
		}
		

		// INPUT CATATAN SISWA

		$catmur = array(
			'nis_siswa' => $nis,
			'catatan_siswa' => strip_tags($this->input->post('note')),
			'ta' => $ta,
			'semester' => $sms,
		);

		$dt_note = $this->db->get_where('tbl_catmur', $where);
		if ($dt_note->num_rows() > 0) {
			$this->db->update('tbl_catmur', $catmur , $where);
		}
		else{
			$this->db->insert('tbl_catmur', $catmur);
		}
		
		// $sql = $this->db->insert_batch('tbl_nilai', $data); // Panggil fungsi save_batch yang ada di model siswa (SiswaModel.php)        // Cek apakah query insert nya sukses atau gagal 
		if($data){ // Jika sukses
			echo "<script>alert('Raport Berhasil Di Update!');";
			echo "window.location.href = '" . base_url('nilai_raport/raport_siswa/') . str_replace('/', '-', $ta) . '/' . $sms . "';</script>";
		} else { // Jika gagal
			echo "<script>alert('Data gagal disimpan'); window.history.go(-1);</script>";
		}
	}
}