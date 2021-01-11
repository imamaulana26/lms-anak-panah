<?php
class Cetak extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url('login');
			redirect($url);
		};
		// $this->load->model('m_evaluasi');

	}

	function bilangan($n)
	{
		$arr = array(1 => 'Satu', 'Dua', 'Tiga', 'Emapt', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas');
		$temp = $arr[$n];

		return $temp;
	}

	function ttl($n)
	{
		$bln = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
		$exp_n = explode('-', $n);

		if ($exp_n[1] > 9) {
			$n = $exp_n[1];
		} else {
			$n = substr($exp_n[1], 1);
		}

		return $exp_n[2] . ' ' . $bln[$n] . ' ' . $exp_n[0];
	}

	// print detail pembiayaan nasabah
	function raport($id, $ta, $sms)
	{
		// var_dump($id);
		$id_admin = $this->session->userdata('idadmin');
		$c = $this->db->select('*')->from('tbl_pengguna a')->join('tbl_siswa b', 'a.pengguna_username = b.siswa_nis', 'inner')->where(['a.pengguna_id' => $id_admin])->get()->row_array();
		if ($id != $c['siswa_nis']) {
			echo "<h1 style='text-align: center;
			margin-top: 50px;
			color: red;'>MAAF ANDA TIDAK BERHAK MELIHAT RAPORT SISWA LAIN</h1>";
			exit();
		}

		$d = $this->db->get_where('tbl_thn_ajaran', ['thn_ajaran' => str_replace('-', '/', $ta), 'semester' => $sms])->row_array();
		// var_dump($d);

		if (empty($d)) {
			echo "<h1 style='text-align: center;
			margin-top: 50px;
			color: red;'>OPPS... ADA KESALAHAN... KEMBALI KE HALAMAN SEBELUMNYA...</h1>";
			exit();
		}
		// var_dump($d);
		// exit();
		global $title;
		$this->load->library('pdf');
		$fpdf = new PDF('P');
		// $title = 'Detail Data Pembiayaan Nasabah';
		// $fpdf->SetTitle($title);
		// $fpdf->AliasNbPages();

		// page break
		$fpdf->AddPage();

		// load data siswa
		$this->db->select('*')->from('tbl_siswa a');
		$this->db->join('tbl_kelas b', 'a.siswa_kelas_id = b.kelas_id', 'inner');
		$this->db->join('tbl_orangtua c', 'a.siswa_nis = c.siswa_nis', 'inner');
		$this->db->join('tbl_agama d', 'a.siswa_agama_id = d.agama_id', 'inner');
		$this->db->where('a.siswa_nis', $id);
		$result = $this->db->get();
		$datlem = $this->db->get('tbl_lembaga')->row_array();

		// load data tahunajaran
		// $this->db->select('*')->from('tbl_thn_ajaran');
		// $this->db->where('thn_ajaran', str_replace('-', '/', $ta));
		// $raportkeluar = $this->db->get()->result_array();
		$raportkeluar_1 = $this->db->get_where('tbl_thn_ajaran', ['thn_ajaran' => str_replace('-', '/', $ta), 'semester' => '1'])->row_array();

		//load data nilai


		// semester2
		$this->db->select('*')->from('tbl_nilai a');
		$this->db->join('tbl_mapel b', 'a.kd_mapel = b.kd_mapel', 'inner');
		$this->db->join('tbl_terbilang c', 'a.nilai = c.id_nilai', 'left');

		$this->db->where(['a.nis_siswa' => $id, 'a.ta' => str_replace('-', '/', $ta), 'a.semester' => 2, 'b.kelompok' => 'A']);
		$dt_nilai_a_2 = $this->db->order_by('a.kd_mapel', 'asc')->get()->result_array();

		$dt_kelas_a_2 = $this->db->select('*')->from('tbl_nilai a')->join('tbl_kelas b', 'a.kelas_id = b.kelas_id', 'left')->where(['a.nis_siswa' => $id, 'a.ta' => str_replace('-', '/', $ta), 'a.semester' => 2])->get()->row_array();

		$this->db->select('*')->from('tbl_nilai a');
		$this->db->join('tbl_mapel b', 'a.kd_mapel = b.kd_mapel', 'inner');
		$this->db->join('tbl_terbilang c', 'a.nilai = c.id_nilai', 'left');
		$this->db->where(['a.nis_siswa' => $id, 'a.ta' => str_replace('-', '/', $ta), 'a.semester' => 2, 'b.kelompok' => 'B']);
		$dt_nilai_b_2 = $this->db->order_by('a.kd_mapel', 'asc')->get()->result_array();

		$this->db->select('*')->from('tbl_nilai a');
		$this->db->join('tbl_mapel b', 'a.kd_mapel = b.kd_mapel', 'inner');
		$this->db->join('tbl_terbilang c', 'a.nilai = c.id_nilai', 'left');
		$this->db->where(['a.nis_siswa' => $id, 'a.ta' => str_replace('-', '/', $ta), 'a.semester' => 2, 'b.kelompok' => 'C']);
		$dt_nilai_c_2 = $this->db->order_by('a.kd_mapel', 'asc')->get()->result_array();

		// load data nilai individu
		$nilaiindiv_2 = $this->db->get_where('tbl_nilai_indv', ['nis_siswa' => $id, 'ta' => str_replace('-', '/', $ta), 'semester' => 2])->result_array();
		// var_dump($nilaiindiv);

		// load data catatan
		$catatan_2 = $this->db->get_where('tbl_catmur', ['nis_siswa' => $id, 'ta' => str_replace('-', '/', $ta), 'semester' => 2])->row_array();

		// load data absensi
		$abs_2 = $this->db->get_where('tbl_absensi', ['nis_siswa' => $id, 'ta' => str_replace('-', '/', $ta), 'semester' => 2])->row_array();
		// load data catatan penting
		$catpen_2 = $this->db->get_where('tbl_catpenting', ['nis_siswa' => $id, 'ta' => str_replace('-', '/', $ta), 'sms' => 2])->row_array();

		$dataketrapor1 = $this->db->select('*')->from('tbl_nilai')->where(['nis_siswa' => $id, 'ta' => str_replace('-', '/', $ta), 'semester' => 1])->get()->row_array();
		$dataketrapor2 = $this->db->select('*')->from('tbl_nilai')->where(['nis_siswa' => $id, 'ta' => str_replace('-', '/', $ta), 'semester' => 2])->get()->row_array();


		if (!empty($dataketrapor1)) {
			$kelas = $dataketrapor1['kelas_id'];
			if ($kelas <= '6') {
				$ket1 = 'Sekolah Dasar';
				$ket2 = 'SD';
			} elseif ($kelas <= '9') {
				$ket1 = 'Sekolah Menengah Pertama ';
				$ket2 = 'SMP';
			} else {
				$ket1 = 'Sekolah Menengah Atas ';
				$ket2 = 'SMA';
			}
		} else if (!empty($dataketrapor2)) {
			$kelas = $dataketrapor2['kelas_id'];
			if ($kelas <= '6') {
				$ket1 = 'Sekolah Dasar';
				$ket2 = 'SD';
			} elseif ($kelas <= '9') {
				$ket1 = 'Sekolah Menengah Pertama ';
				$ket2 = 'SMP';
			} else {
				$ket1 = 'Sekolah Menengah Atas ';
				$ket2 = 'SMA';
			}
		} else {
			echo "RAPORT TAHUN AJARAN " . str_replace('-', '/', $ta) . " BELUM DI ISI";
			exit();
		}
		// load data
		foreach ($result->result_array() as $res) {
			$jenkel = $res['siswa_jenkel'];
			if ($jenkel == 'L') {
				$jenkel = 'Laki-Laki';
			} else {
				$jenkel = 'Perempuan';
			}

			$lebar = $fpdf->SetX($fpdf->GetX() / 2);


			// DATA SISWA
			$nama = $res['siswa_nama'];
			$nis = $res['siswa_nis'] . ' / ' . $res['siswa_nisn'];
			$ttl = $res['siswa_tempat'] . ', ' . $this->ttl($res['siswa_tgl_lahir']);
			// $kls = $res['kelas_nama'];
			// 			$klsnm = explode(' ', $res['kelas_nama']);

			// 			$kls_kick = ''; $kls = '';
			// 			for($i = 0; $i <= count($klsnm)-1; $i++){
			// 				// unset($klsnm[0]);
			// 				if($i < 1){
			// 					$kls_kick .= $klsnm[$i] . ' ';
			// 				}
			// 				else {
			// 					$kls .= $klsnm[$i] . ' ';
			// 				}

			// 			}

			// $kls = implode('', $klsnm);
			// var_dump($kls);
			// exit();
			$agama = $res['agama_nama'];
			$stskel = 'Anak';
			$photo = $res['siswa_photo'];

			$anke = $res['anak_ke'];
			// $almt = $res['siswa_alamat'];
			// $almt_baru = $res['siswa_alamat'];
			if ($res['siswa_alamat'] != null) $almt = $res['siswa_alamat'];
			else $almt = '-';
			$exp = explode(' ', $almt);
			// $itung = strlen($almt);
			// var_dump($itung);

			if ($res['siswa_no_telp'] != null) $notelp = $res['siswa_no_telp'];
			else $notelp = '-';
			if ($res['sekolah_asal'] != null) $sekolah_asal = $res['sekolah_asal'];
			else $sekolah_asal = '-';
			if ($res['ayah_nama'] != null) $nmayah = $res['ayah_nama'];
			else $nmayah = '-';
			if ($res['ibu_nama'] != null) $nmibu = $res['ibu_nama'];
			else $nmibu = '-';
			if ($res['wali_nama'] != null) $nmwali = $res['wali_nama'];
			else $nmwali = '-';
			if ($res['ayah_pekerjaan'] != null) $pkayah = $res['ayah_pekerjaan'];
			else $pkayah = '-';
			if ($res['ibu_pekerjaan'] != null) $pkibu = $res['ibu_pekerjaan'];
			else $pkibu = '-';
			if ($res['no_telp_ibu'] != null) $notelpibu = $res['no_telp_ibu'];
			else $notelpibu = '-';
			if ($res['no_telp_ayah'] != null) $notelpayah = $res['no_telp_ayah'];
			else $notelpayah = '-';
			if ($res['wali_alamat'] != null) $almt_wali = $res['wali_alamat'];
			else $almt_wali = '-';
			$exp_wl = explode(' ', $almt_wali);
			if ($res['wali_notelp'] != null) $notelp_wali = $res['wali_notelp'];
			else $notelp_wali = '-';
			if ($res['wali_pekerjaan'] != null) $pkwali = $res['wali_pekerjaan'];
			else $pkwali = '-';


			// END OF DATA SISWA

			$dikel1 = $this->ttl($raportkeluar_1['tgl_dikeluarkan']);
			// $dikel = $this->ttl($raportkeluar['tgl_dikeluarkan']);
			// DATA LEMBAGA
			$nama_yayasan = $datlem['nm_yayasan'];
			$npsn = $datlem['npsn'];
			$no_ijin = $datlem['no_ijin'];
			$nm_lembaga = $datlem['nm_lembaga'];
			$almt_lembaga = $datlem['almt'];
			$notelp_lembaga = $datlem['notelp'];
			$kdps_lembaga = $datlem['kode_pos'];
			$kel_lembaga = $datlem['kel'];
			$kec_lembaga = $datlem['kec'];
			$kab_lembaga = $datlem['kab'];
			$prov_lembaga = $datlem['prov'];
			$web_lembaga = $datlem['website'];
			$kepsek = $datlem['kepsek'];
			// END OF DATA LEMBAGA

			// DATA NILAI

			// SEMESTER 1

			if (!empty($catatan['catatan_siswa'])) $cat = $catatan['catatan_siswa'];
			else $cat = '-';
			if (!empty($catatan_2['catatan_siswa'])) $cat_2 = $catatan_2['catatan_siswa'];
			else $cat_2 = '-';

			// END OF DATA NILAI

			// DATA ABSENSI

			if (!empty($abs['sakit'])) $sakit = $abs['sakit'];
			else $sakit = '-';
			if (!empty($abs['izin'])) $izin = $abs['izin'];
			else $izin = '-';
			if (!empty($abs['tanpa_ket'])) $tanpaket = $abs['tanpa_ket'];
			else $tanpaket = '-';
			if (!empty($abs_2['sakit'])) $sakit_2 = $abs_2['sakit'];
			else $sakit_2 = '-';
			if (!empty($abs_2['izin'])) $izin_2 = $abs_2['izin'];
			else $izin_2 = '-';
			if (!empty($abs_2['tanpa_ket'])) $tanpaket_2 = $abs_2['tanpa_ket'];
			else $tanpaket_2 = '-';
			// END OF DATA ABSENSI

			// DATA CATATAN PENTING
			// load data catatan penting
			$catpen = $this->db->get_where('tbl_catpenting', ['nis_siswa' => $id, 'ta' => str_replace('-', '/', $ta), 'sms' => 1])->row_array();
			if (!empty($catpen['sikap'])) $sikap = $catpen['sikap'];
			else $sikap = '-';
			if (!empty($catpen['kegiatan'])) $kegiatan = $catpen['kegiatan'];
			else $kegiatan = '-';
			if (!empty($catpen['tugas'])) $tugas = $catpen['tugas'];
			else $tugas = '-';
			// END OF DATA CATATAN PENTING

			

			// HALAMAN PERTAMA
			$fpdf->Image('./assets/images/logo-sap.png', 78, 30, 50);
			// $fpdf->Image('./assets/images/logo-sap.png', 78, 100, 50);

			$fpdf->Ln(100);
			$fpdf->SetFont('Times', 'B', 15);
			$fpdf->Cell($lebar, 6, 'LAPORAN', 0, 1, 'C');
			$fpdf->Cell($lebar, 6, 'HASIL BELAJAR PESERTA DIDIK', 0, 1, 'C');
			$fpdf->Ln(5);
			$fpdf->Cell($lebar, 6, 'PENDIDIKAN KESETARAAN ' . strtoupper($ket1), 0, 1, 'C');
			$fpdf->Cell($lebar, 6, '(' . $ket2 . ')', 0, 1, 'C');

			$fpdf->Ln(80);
			$fpdf->SetFont('Times', 'B', 11);
			$fpdf->Cell($lebar, 6, 'NAMA PESERTA DIDIK', 0, 1, 'C');

			$fpdf->SetFont('Times', 'B', 17);
			$fpdf->Cell($lebar, 6, strtoupper($nama), 0, 1, 'C');
			$str = '';
			for ($i = 1; $i <= strlen($nama) * 2; $i++) {
				$str .= '-';
			}
			$fpdf->Cell($lebar, 6, $str, 0, 1, 'C');

			$fpdf->SetFont('Times', 'B', 11);
			$fpdf->Cell($lebar, 6, 'NIS / NISN', 0, 1, 'C');

			$fpdf->SetFont('Times', 'B', 17);
			$fpdf->Cell($lebar, 6, strtoupper($nis), 0, 1, 'C');
			$str = '';
			for ($i = 1; $i <= strlen($nis) * 2; $i++) {
				$str .= '-';
			}
			$fpdf->SetFont('Times', 'B', 17);
			$fpdf->Cell($lebar, 6, $str, 0, 1, 'C');


			// END OF HALAMAN PERTAMA
			$fpdf->AddPage();
			// HALAMAN KEDUA
			$fpdf->Image('./assets/images/logo-sap.png', 78, 30, 50);

			$fpdf->Ln(100);
			$fpdf->SetFont('Times', 'B', 12);
			$fpdf->Cell($lebar, 6, 'LAPORAN', 0, 1, 'C');
			$fpdf->Ln(5);
			$fpdf->Cell($lebar, 6, 'HASIL BELAJAR PESERTA DIDIK', 0, 1, 'C');
			$fpdf->Ln(5);
			$fpdf->Cell($lebar, 6, 'PENDIDIKAN KESETARAAN ' . strtoupper($ket1), 0, 1, 'C');
			// $fpdf->Cell($lebar, 6, '(SMA)', 1, 1, 'C');
			$fpdf->Ln(5);
			$fpdf->SetFont('Times', 'B', 11);
			$fpdf->Cell($lebar, 4, strtoupper($nama_yayasan), 0, 1, 'C');
			$fpdf->Cell($lebar, 4, 'Nomor Pokok Sekolah Nasional : ' . strtoupper($npsn), 0, 1, 'C');
			$fpdf->Cell($lebar, 4, 'Nomor Ijin Operasional : ' . strtoupper($no_ijin), 0, 1, 'C');

			$fpdf->Ln(8);
			$fpdf->SetX(15);
			$fpdf->Cell(45, 7, 'Nama Satuan Pendidikan', 0, 0, 'L');
			$fpdf->Cell(10, 7, ':', 0, 0, 'C');
			$fpdf->Cell(10, 7, strtoupper($nm_lembaga), 0, 1, 'L');
			$fpdf->SetX(15);
			$fpdf->Cell(45, 7, 'Alamat', 0, 0, 'L');
			$fpdf->Cell(10, 7, ':', 0, 0, 'C');
			$fpdf->Cell(10, 7, $almt_lembaga, 0, 1, 'L');
			$fpdf->SetX(15);
			$fpdf->Cell(45, 7, 'No. Telepon', 0, 0, 'L');
			$fpdf->Cell(10, 7, ':', 0, 0, 'C');
			$fpdf->Cell(10, 7, substr($notelp_lembaga, 0, 4) . '-' . substr($notelp_lembaga, 4), 0, 1, 'L');
			$fpdf->SetX(15);
			$fpdf->Cell(45, 7, 'Kode Pos', 0, 0, 'L');
			$fpdf->Cell(10, 7, ':', 0, 0, 'C');
			$fpdf->Cell(10, 7, $almt_lembaga, 0, 1, 'L');
			$fpdf->SetX(15);
			$fpdf->Cell(45, 7, 'Kelurahan', 0, 0, 'L');
			$fpdf->Cell(10, 7, ':', 0, 0, 'C');
			$fpdf->Cell(10, 7, $kel_lembaga, 0, 1, 'L');
			$fpdf->SetX(15);
			$fpdf->Cell(45, 7, 'Kecamatan', 0, 0, 'L');
			$fpdf->Cell(10, 7, ':', 0, 0, 'C');
			$fpdf->Cell(10, 7, $kec_lembaga, 0, 1, 'L');
			$fpdf->SetX(15);
			$fpdf->Cell(45, 7, 'Kabupaten', 0, 0, 'L');
			$fpdf->Cell(10, 7, ':', 0, 0, 'C');
			$fpdf->Cell(10, 7, $kab_lembaga, 0, 1, 'L');
			$fpdf->SetX(15);
			$fpdf->Cell(45, 7, 'Provinsi', 0, 0, 'L');
			$fpdf->Cell(10, 7, ':', 0, 0, 'C');
			$fpdf->Cell(10, 7, $prov_lembaga, 0, 1, 'L');
			$fpdf->SetX(15);
			$fpdf->Cell(45, 7, 'Website', 0, 0, 'L');
			$fpdf->Cell(10, 7, ':', 0, 0, 'C');
			$fpdf->SetFont('Times', 'U', 11);
			$fpdf->Cell(10, 7, $web_lembaga, 0, 1, 'L');

			// END OF HALAMAN KEDUA
			$fpdf->AddPage();
			// HALAMAN KETIGA
			$fpdf->Ln(30);
			$fpdf->SetFont('Times', 'B', 13);
			$fpdf->Cell($lebar, 6, strtoupper('petunjuk penggunaan'), 0, 1, 'C');
			// $fpdf->SetY(5);
			$fpdf->Ln(10);

			$fpdf->SetFont('Times', 'B', 11);
			$fpdf->SetX(20);
			$fpdf->Cell($lebar, 5, '1.  Buku Laporan Hasil Belajar ini dipergunakan selama peserta didik mengikuti pelajaran di ', 0, 1, 'L');
			$fpdf->SetX(25);
			$fpdf->Cell($lebar, 5, $ket1 . ' (' . $ket2 . ')', 0, 1, 'L');

			$fpdf->Ln(5);
			$fpdf->SetX(20);
			$fpdf->Cell($lebar, 5, '2.  Apabila peserta didik pindah sekolah , buku Laporan Hasil Belajar dibawa oleh peserta didik ', 0, 1, 'L');
			$fpdf->SetX(25);
			$fpdf->Cell($lebar, 5, 'yang bersangkutan untuk dipergunakan sebagai bukti pencapaian kompetensi ', 0, 1, 'L');

			$fpdf->Ln(5);
			$fpdf->SetX(20);
			$fpdf->Cell($lebar, 5, '3.  Apabila buku Laporan Hasil Belajar peserta didik yang bersangkutan hilang, dapat diganti ', 0, 1, 'L');
			$fpdf->SetX(25);
			$fpdf->Cell($lebar, 5, 'dengan buku Laporan Hasil Belajar Pengganti dan diisi dengan nilai-nilai yang dikutip dari', 0, 1, 'L');
			$fpdf->SetX(25);
			$fpdf->Cell($lebar, 5, 'Buku Induk Sekolah Asal peserta didik dan disahkan oleh Kepala Sekolah yang bersangkutan', 0, 1, 'L');

			$fpdf->Ln(5);
			$fpdf->SetX(20);
			$fpdf->Cell($lebar, 5, '4.  Buku Laporan Hasil Belajar peserta didik ini harus dilengkapi dengan pas foto ukuran 3 X 4 cm, ', 0, 1, 'L');
			$fpdf->SetX(25);
			$fpdf->Cell($lebar, 5, 'dan pengisiannya dilakukan oleh Wali Kelas', 0, 1, 'L');

			$fpdf->Ln(5);
			// $fpdf->SetFont('Times', 'B', 9);
			$fpdf->SetX(15);
			$fpdf->Cell($lebar, 6, strtoupper('Keterangan nilai kuantitatif'), 0, 1, 'L');

			$fpdf->Ln(5);
			$fpdf->SetX(15);
			$fpdf->Cell($lebar, 5, 'Nilai Kuantitatif dengan skala 0 - 100 digunakan untuk nilai mata pelajaran.', 0, 1, 'L');
			$fpdf->SetX(15);
			$fpdf->Cell($lebar, 5, 'Contoh Nilai : 74 ditulis dengan huruf tujuh puluh empat', 0, 1, 'L');

			$fpdf->Ln(5);
			// $fpdf->SetFont('Times', 'B', 9);
			$fpdf->SetX(15);
			$fpdf->Cell($lebar, 6, strtoupper('Keterangan nilai kualitatif'), 0, 1, 'L');

			$fpdf->Ln(5);
			$fpdf->SetX(15);
			$fpdf->Cell($lebar, 5, 'Nilai Kualitatif digunakan untuk penilaian pengembangan diri dan perilaku', 0, 1, 'L');

			$fpdf->Ln(5);
			$fpdf->SetX(15);
			$fpdf->Cell($lebar, 7, 'A = Sangat Baik', 0, 1, 'L');
			$fpdf->SetX(15);
			$fpdf->Cell($lebar, 7, 'B = Baik', 0, 1, 'L');
			$fpdf->SetX(15);
			$fpdf->Cell($lebar, 7, 'C = Cukup', 0, 1, 'L');
			$fpdf->SetX(15);
			$fpdf->Cell($lebar, 7, 'D = Kurang', 0, 1, 'L');
			$fpdf->SetX(15);
			$fpdf->Cell($lebar, 7, 'E = Sangat Kurang', 0, 1, 'L');

			$fpdf->Ln(5);
			$fpdf->SetX(15);
			$fpdf->Cell($lebar, 6, strtoupper('Keterangan Tabel nilai'), 0, 1, 'L');

			$fpdf->Ln(5);
			$fpdf->SetX(15);
			$fpdf->Cell(8, 5, '*)', 0, 0, 'L');
			$fpdf->Cell(10, 5, 'Pilihan aspek sesuai kondisi satuan pendidikan.', 0, 1, 'L');
			$fpdf->SetX(15);
			$fpdf->Cell(8, 5, '**)', 0, 0, 'L');
			$fpdf->Cell(10, 5, 'Pilihan mata pelajaran sesuai dengan kondisi satuan pendidikan.', 0, 1, 'L');
			$fpdf->SetX(15);
			$fpdf->Cell(8, 5, '***)', 0, 0, 'L');
			$fpdf->Cell(10, 5, 'Muatan Lokal ditetapkan oleh daerah / satuan pendidikan, maka aspek penilaian raport', 0, 1, 'L');
			$fpdf->Cell(8, 5, '', 0, 0, 'L');
			$fpdf->Cell(10, 5, 'ditetapkan oleh daerah / satuan pendidikan masing-masing.', 0, 1, 'L');
			//END OF HALAMAN KETIGA

			$fpdf->AddPage();
			// HALAMAN KE EMPAT
			$fpdf->Ln(25);
			$fpdf->SetFont('Times', 'B', 10);
			$fpdf->Cell($lebar, 6, strtoupper('keterangan tentang diri peserta didik'), 0, 1, 'C');

			$fpdf->Ln(5);
			$fpdf->SetFont('Times', '', 10);
			$fpdf->SetX(18);
			$fpdf->Cell(5, 6, '1.', 0, 0, 'L');
			$fpdf->Cell(40, 6, 'Nama Siswa (Lengkap)', 0, 0, 'L');
			$fpdf->Cell(5, 6, ':', 0, 0, 'C');
			$fpdf->Cell(20, 6, $nama, 0, 1, 'L');
			$fpdf->SetX(18);
			$fpdf->Cell(5, 6, '2.', 0, 0, 'L');
			$fpdf->Cell(40, 6, 'NIS / NISN', 0, 0, 'L');
			$fpdf->Cell(5, 6, ':', 0, 0, 'C');
			$fpdf->Cell(20, 6, $nis, 0, 1, 'L');
			$fpdf->SetX(18);
			$fpdf->Cell(5, 6, '3.', 0, 0, 'L');
			$fpdf->Cell(40, 6, 'Tempat, Tanggal Lahir', 0, 0, 'L');
			$fpdf->Cell(5, 6, ':', 0, 0, 'C');
			$fpdf->Cell(20, 6, $ttl, 0, 1, 'L');
			$fpdf->SetX(18);
			$fpdf->Cell(5, 6, '4.', 0, 0, 'L');
			$fpdf->Cell(40, 6, 'Jenis Kelamin', 0, 0, 'L');
			$fpdf->Cell(5, 6, ':', 0, 0, 'C');
			$fpdf->Cell(20, 6, $jenkel, 0, 1, 'L');
			$fpdf->SetX(18);
			$fpdf->Cell(5, 6, '5.', 0, 0, 'L');
			$fpdf->Cell(40, 6, 'Agama', 0, 0, 'L');
			$fpdf->Cell(5, 6, ':', 0, 0, 'C');
			$fpdf->Cell(20, 6, $agama, 0, 1, 'L');
			$fpdf->SetX(18);
			$fpdf->Cell(5, 6, '6.', 0, 0, 'L');
			$fpdf->Cell(40, 6, 'Status dalam keluarga', 0, 0, 'L');
			$fpdf->Cell(5, 6, ':', 0, 0, 'C');
			$fpdf->Cell(20, 6, $stskel, 0, 1, 'L');
			$fpdf->SetX(18);
			$fpdf->Cell(5, 6, '7.', 0, 0, 'L');
			$fpdf->Cell(40, 6, 'Anak ke', 0, 0, 'L');
			$fpdf->Cell(5, 6, ':', 0, 0, 'C');
			$fpdf->Cell(20, 6, $anke . ' (' . $this->bilangan($anke) . ')', 0, 1, 'L');
			$fpdf->SetX(18);
			$fpdf->Cell(5, 6, '8.', 0, 0, 'L');
			$fpdf->Cell(40, 6, 'Alamat Siswa', 0, 0, 'L');
			$fpdf->Cell(5, 6, ':', 0, 0, 'C');

			$almt_1 = '';
			$almt_2 = '';
			for ($i = 0; $i <= count($exp) - 1; $i++) {
				if ($i <= 10) {
					$almt_1 .= $exp[$i] . ' ';
				} else {
					$almt_2 .= $exp[$i] . ' ';
				}
			}
			// var_dump($almt_1);

			$fpdf->Cell(20, 6, $almt_1, 0, 1, 'L');

			if (strlen($almt_2) > 0) {
				$fpdf->SetX(68);
				$fpdf->Cell(20, 6, $almt_2, 0, 1, 'L');
			}
			// else{
			// 	$fpdf->SetX(65);
			// 	$fpdf->Cell(20, 6, $almt_2, 0, 1, 'L');
			// }
			// $fpdf->SetX(65);
			// $fpdf->Cell(20, 6, strlen($almt_2), 0, 1, 'L');
			$fpdf->SetX(18);
			$fpdf->Cell(5, 6, '9.', 0, 0, 'L');
			$fpdf->Cell(40, 6, 'Nomor Telpon', 0, 0, 'L');
			$fpdf->Cell(5, 6, ':', 0, 0, 'C');
			$fpdf->Cell(20, 6, $notelp, 0, 1, 'L');
			$fpdf->SetX(18);
			$fpdf->Cell(5, 6, '10.', 0, 0, 'L');
			$fpdf->Cell(40, 6, 'Sekolah Asal', 0, 0, 'L');
			$fpdf->Cell(5, 6, ':', 0, 0, 'C');
			$fpdf->Cell(20, 6, $sekolah_asal, 0, 1, 'L');

			$fpdf->Cell(40, 2, '', 0, 1, 'L');
			$fpdf->SetX(18);
			$fpdf->Cell(5, 6, '', 0, 0, 'L');
			$fpdf->Cell(45, 6, 'NAMA ORANG TUA', 0, 1, 'L');
			$fpdf->SetX(18);
			$fpdf->Cell(5, 6, '11.', 0, 0, 'L');
			$fpdf->Cell(40, 6, 'Nama Ayah', 0, 0, 'L');
			$fpdf->Cell(5, 6, ':', 0, 0, 'C');
			$fpdf->Cell(20, 6, $nmayah, 0, 1, 'L');
			$fpdf->SetX(18);
			$fpdf->Cell(5, 6, '12.', 0, 0, 'L');
			$fpdf->Cell(40, 6, 'Nama Ibu', 0, 0, 'L');
			$fpdf->Cell(5, 6, ':', 0, 0, 'C');
			$fpdf->Cell(20, 6, $nmibu, 0, 1, 'L');
			$fpdf->SetX(18);
			$fpdf->Cell(5, 6, '13.', 0, 0, 'L');
			$fpdf->Cell(40, 6, 'Alamat Orang Tua', 0, 0, 'L');
			$fpdf->Cell(5, 6, ':', 0, 0, 'C');

			$fpdf->Cell(20, 6, $almt_1, 0, 1, 'L');
			if (strlen($almt_2) > 0) {
				$fpdf->SetX(68);
				$fpdf->Cell(20, 6, $almt_2, 0, 1, 'L');
			}
			$fpdf->SetX(18);
			$fpdf->Cell(5, 6, '14.', 0, 0, 'L');
			$fpdf->Cell(40, 6, 'Nomor Telpon', 0, 1, 'L');
			$fpdf->SetX(24);
			$fpdf->Cell(40, 6, 'a. Ayah', 0, 0, 'L');
			$fpdf->Cell(4, 6, ':', 0, 0, 'L');
			$fpdf->Cell(20, 6, $notelpayah, 0, 1, 'L');
			$fpdf->SetX(24);
			$fpdf->Cell(40, 6, 'b. Ibu', 0, 0, 'L');
			$fpdf->Cell(4, 6, ':', 0, 0, 'L');
			$fpdf->Cell(50, 6, $notelpibu, 0, 1, 'L');
			$fpdf->SetX(18);
			$fpdf->Cell(5, 6, '15.', 0, 0, 'L');
			$fpdf->Cell(40, 6, 'Pekerjaan Orang Tua', 0, 1, 'L');
			$fpdf->SetX(24);
			$fpdf->Cell(40, 6, 'a. Ayah', 0, 0, 'L');
			$fpdf->Cell(4, 6, ':', 0, 0, 'L');
			$fpdf->Cell(20, 6, $pkayah, 0, 1, 'L');
			$fpdf->SetX(24);
			$fpdf->Cell(40, 6, 'b. Ibu', 0, 0, 'L');
			$fpdf->Cell(4, 6, ':', 0, 0, 'L');
			$fpdf->Cell(50, 6, $pkibu, 0, 1, 'L');
			$fpdf->SetX(18);
			$fpdf->Cell(5, 6, '16.', 0, 0, 'L');
			$fpdf->Cell(40, 6, 'Nama Wali ', 0, 0, 'L');
			$fpdf->Cell(5, 6, ':', 0, 0, 'C');
			$fpdf->Cell(20, 6, $nmwali, 0, 1, 'L');
			$fpdf->SetX(18);
			$fpdf->Cell(5, 6, '17.', 0, 0, 'L');
			$fpdf->Cell(40, 6, 'Alamat Wali ', 0, 0, 'L');
			$fpdf->Cell(5, 6, ':', 0, 0, 'C');
			$almt_1wl = '';
			$almt_2wl = '';
			for ($i = 0; $i <= count($exp_wl) - 1; $i++) {
				if ($i <= 10) {
					$almt_1wl .= $exp_wl[$i] . ' ';
				} else {
					$almt_2wl .= $exp_wl[$i] . ' ';
				}
			}
			$fpdf->Cell(20, 6, $almt_1wl, 0, 1, 'L');
			$fpdf->SetX(65);
			if (strlen($almt_2wl) > 0) {
				$fpdf->SetX(65);
				$fpdf->Cell(20, 6, $almt_2wl, 0, 1, 'L');
			}
			$fpdf->SetX(18);
			$fpdf->Cell(5, 6, '18.', 0, 0, 'L');
			$fpdf->Cell(40, 6, 'No Telpon Wali', 0, 0, 'L');
			$fpdf->Cell(5, 6, ':', 0, 0, 'C');
			$fpdf->Cell(20, 6, $notelp_wali, 0, 1, 'L');
			$fpdf->SetX(18);
			$fpdf->Cell(5, 6, '19.', 0, 0, 'L');
			$fpdf->Cell(40, 6, 'Pekerjaan Wali', 0, 0, 'L');
			$fpdf->Cell(5, 6, ':', 0, 0, 'C');
			$fpdf->Cell(20, 6, $pkwali, 0, 1, 'L');

			// PHOTO
			$tinggi = (strlen($almt_2) == 0) ? '207' : '220';
			$fpdf->Ln(10);
			if ($photo != null) {
				$fpdf->Image('assets/filesiswa/' . $id . '/' . $photo, 45, $tinggi, 35);
			} else {
				$fpdf->Image('assets/images/default_photo.jpg', 45, $tinggi, 35);
			}
			// $fpdf->Ln(40);
			$fpdf->SetX(120);
			$fpdf->Cell(40, 6, $kab_lembaga . ', ' . $dikel1, 0, 1, 'L');
			$fpdf->SetX(120);
			$fpdf->Image('assets/images/cap.png', 95, $tinggi, 45);
			$fpdf->Image('assets/images/ttd.png', 115, $tinggi, 55);
			$fpdf->Cell(40, 6, 'KEPALA SEKOLAH ANAK PANAH HS', 0, 1, 'L');


			$fpdf->Ln(30);
			$fpdf->SetX(120);
			$fpdf->Cell(40, 6, $kepsek, 0, 0, 'L');
		}

		//END OF HALAMAN KE EMPAT
		$fpdf->AddPage();
		// buat validasi
		$datavalid = $this->db->get_where('tbl_nilai', ['nis_siswa' => $id, 'ta' => str_replace('-', '/', $ta), 'semester' => 1])->row_array();
		$datavalid2 = $this->db->get_where('tbl_nilai', ['nis_siswa' => $id, 'ta' => str_replace('-', '/', $ta), 'semester' => 2])->row_array();
		// var_dump($res['kelas_id']);
		// exit();
		
		$wakel = $this->db->select('wali_kelas')->from('tbl_kelas')->where(['kelas_id' => $res['kelas_id']])->get()->row_array();
		$dtunser = unserialize($wakel['wali_kelas']);
		if (($key = array_search(str_replace('-', '/', $ta), array_column($dtunser, 'ta'))) !== false) {
			$ttdwakel =  $dtunser[$key]['ttd'];
			$nmwakel =  $dtunser[$key]['wakel'];
		}

		

		if (empty($datavalid['semester'])) {
			$fpdf->Cell(30, 6, 'data semester 1 kosong', 0, 0, 'L');
		} else {
			// load data semester 1
			// nilai
			// A
			$this->db->select('*')->from('tbl_nilai a');
			$this->db->join('tbl_mapel b', 'a.kd_mapel = b.kd_mapel', 'inner');
			$this->db->join('tbl_terbilang c', 'a.nilai = c.id_nilai', 'left');

			$this->db->where(['a.nis_siswa' => $id, 'a.ta' => str_replace('-', '/', $ta), 'a.semester' => 1, 'b.kelompok' => 'A']);
			$dt_nilai_a = $this->db->order_by('a.kd_mapel', 'asc')->get()->result_array();

			// B
			$this->db->select('*')->from('tbl_nilai a');
			$this->db->join('tbl_mapel b', 'a.kd_mapel = b.kd_mapel', 'inner');
			$this->db->join('tbl_terbilang c', 'a.nilai = c.id_nilai', 'left');
			$this->db->where(['a.nis_siswa' => $id, 'a.ta' => str_replace('-', '/', $ta), 'a.semester' => 1, 'b.kelompok' => 'B']);
			$dt_nilai_b = $this->db->order_by('a.kd_mapel', 'asc')->get()->result_array();


			// C
			$this->db->select('*')->from('tbl_nilai a');
			$this->db->join('tbl_mapel b', 'a.kd_mapel = b.kd_mapel', 'inner');
			$this->db->join('tbl_terbilang c', 'a.nilai = c.id_nilai', 'left');
			$this->db->where(['a.nis_siswa' => $id, 'a.ta' => str_replace('-', '/', $ta), 'a.semester' => 1, 'b.kelompok' => 'C']);
			$dt_nilai_c = $this->db->order_by('a.kd_mapel', 'asc')->get()->result_array();

			// load data nilai individu
			$nilaiindiv = $this->db->get_where('tbl_nilai_indv', ['nis_siswa' => $id, 'ta' => str_replace('-', '/', $ta), 'semester' => 1])->result_array();
			// load data catatan
			$catatan = $this->db->get_where('tbl_catmur', ['nis_siswa' => $id, 'ta' => str_replace('-', '/', $ta), 'semester' => 1])->row_array();


			// load data absensi
			$abs = $this->db->get_where('tbl_absensi', ['nis_siswa' => $id, 'ta' => str_replace('-', '/', $ta), 'semester' => 1])->row_array();




			$dt_kelas_a = $this->db->select('*')->from('tbl_nilai a')->join('tbl_kelas b', 'a.kelas_id = b.kelas_id', 'left')->where(['a.nis_siswa' => $id, 'a.ta' => str_replace('-', '/', $ta), 'a.semester' => 1])->get()->row_array();
			$klsnm = explode(' ', $dt_kelas_a['kelas_nama']);
			$kls_kick = '';
			$kls = '';
			for ($i = 0; $i <= count($klsnm) - 1; $i++) {
				if ($i < 1) {
					$kls_kick .= $klsnm[$i] . ' ';
				} else {
					$kls .= $klsnm[$i] . ' ';
				}
			}

			// var_dump($dtunser);
			// var_dump($wakels1);
			// die;
			// var_dump($datawakel);
			// exit();
			// $wakel1 = $res['wali_kelas'];

			// end of nilai


			$fpdf->SetFont('Times', '', 10);
			$fpdf->Cell(30, 6, 'Nama Sekolah', 0, 0, 'L');
			$fpdf->Cell(5, 6, ':', 0, 0, 'C');
			$fpdf->Cell(95, 6, 'PKBM Anak Panah HS', 0, 0, 'L');
			$fpdf->Cell(30, 6, 'Kelas', 0, 0, 'L');
			$fpdf->Cell(5, 6, ':', 0, 0, 'C');
			$fpdf->Cell(30, 6, $kls, 0, 1, 'L');
			$fpdf->Cell(30, 6, 'Alamat', 0, 0, 'L');
			$fpdf->Cell(5, 6, ':', 0, 0, 'C');
			$fpdf->Cell(95, 6, 'Kp. Nanggela RT.002 RW.002 Sukmajaya', 0, 0, 'L');
			$fpdf->Cell(30, 6, 'Semester', 0, 0, 'L');
			$fpdf->Cell(5, 6, ':', 0, 0, 'C');
			$fpdf->Cell(30, 6, '1 (Satu)', 0, 1, 'L');
			$fpdf->Cell(30, 6, 'Nama Peserta Didik', 0, 0, 'L');
			$fpdf->Cell(5, 6, ':', 0, 0, 'C');
			$fpdf->Cell(95, 6, $nama, 0, 0, 'L');
			$fpdf->Cell(30, 6, 'Tahun Pelajaran', 0, 0, 'L');
			$fpdf->Cell(5, 6, ':', 0, 0, 'C');
			$fpdf->Cell(30, 6, str_replace('-', '/', $ta), 0, 1, 'L');
			$fpdf->Cell(30, 6, 'NIS / NISN', 0, 0, 'L');
			$fpdf->Cell(5, 6, ':', 0, 0, 'C');
			$fpdf->Cell(95, 6, $nis, 0, 1, 'L');
			$fpdf->Ln(10);

			$fpdf->Cell(10, 10, 'No', 'TLB', 0, 'C');
			$fpdf->Cell(60, 10, 'Mata Pelajaran', 'TLB', 0, 'C');
			$fpdf->Cell(20, 10, 'KKM *)', 'TLB', 0, 'C');
			$fpdf->Cell(70, 5, 'Nilai', 1, 0, 'C');
			$fpdf->Cell(30, 10, 'Deskripsi Belajar', 'TRB', 1, 'C');
			$fpdf->SetXY(100, 49);
			$fpdf->Cell(20, 5, 'Angka', 'RLB', 0, 'C');
			$fpdf->Cell(50, 5, 'Terbilang', 'BR', 0, 'C');

			$fpdf->SetXY(10, 54);
			$fpdf->Cell(10, 5, '', 'TLB', 0, 'C');
			$fpdf->Cell(60, 5, 'KELOMPOK A (Wajib)', 'TLB', 0, 'L');
			$fpdf->Cell(20, 5, '', 'TLB', 0, 'C');
			$fpdf->Cell(20, 5, '', 'TLB', 0, 'C');
			$fpdf->Cell(50, 5, '', 'TLB', 0, 'C');
			$fpdf->Cell(30, 5, '', 1, 1, 'C');

			foreach ($dt_nilai_a as $key => $val) {
				$fpdf->Cell(10, 5, $key + 1, 'TLB', 0, 'C');
				$fpdf->Cell(60, 5, $val['nm_mapel'], 'TLB', 0, 'L');
				$fpdf->Cell(20, 5, 65, 'TLB', 0, 'C');
				$fpdf->Cell(20, 5, $val['nilai'], 'TLB', 0, 'C');
				$fpdf->Cell(50, 5, $val['nilai_terbilang'], 'TLB', 0, 'L');
				$fpdf->Cell(30, 5, $val['nilai'] < 65 ? 'Tidak Terlampaui' : 'Terlampaui', 1, 1, 'L');
			}

			$fpdf->Cell(10, 5, '', 'TLB', 0, 'C');
			$fpdf->Cell(60, 5, 'KELOMPOK B (Wajib)', 'TLB', 0, 'L');
			$fpdf->Cell(20, 5, '', 'TLB', 0, 'C');
			$fpdf->Cell(20, 5, '', 'TLB', 0, 'C');
			$fpdf->Cell(50, 5, '', 'TLB', 0, 'C');
			$fpdf->Cell(30, 5, '', 1, 1, 'C');

			foreach ($dt_nilai_b as $key => $val) {
				$fpdf->Cell(10, 5, $key + 1, 'TLB', 0, 'C');
				$fpdf->Cell(60, 5, $val['nm_mapel'], 'TLB', 0, 'L');
				$fpdf->Cell(20, 5, 65, 'TLB', 0, 'C');
				$fpdf->Cell(20, 5, $val['nilai'], 'TLB', 0, 'C');
				$fpdf->Cell(50, 5, $val['nilai_terbilang'], 'TLB', 0, 'L');
				$fpdf->Cell(30, 5, $val['nilai'] < 65 ? 'Tidak Terlampaui' : 'Terlampaui', 1, 1, 'L');
			}

			if (!empty($dt_nilai_c)) {
				$fpdf->Cell(10, 5, '', 'TLB', 0, 'C');
				$fpdf->Cell(60, 5, 'KELOMPOK C (Peminatan)', 'TLB', 0, 'L');
				$fpdf->Cell(20, 5, '', 'TLB', 0, 'C');
				$fpdf->Cell(20, 5, '', 'TLB', 0, 'C');
				$fpdf->Cell(50, 5, '', 'TLB', 0, 'C');
				$fpdf->Cell(30, 5, '', 1, 1, 'C');
			}
			foreach ($dt_nilai_c as $key => $val) {
				$fpdf->Cell(10, 5, $key + 1, 'TLB', 0, 'C');
				$fpdf->Cell(60, 5, $val['nm_mapel'], 'TLB', 0, 'L');
				$fpdf->Cell(20, 5, 65, 'TLB', 0, 'C');
				$fpdf->Cell(20, 5, $val['nilai'], 'TLB', 0, 'C');
				$fpdf->Cell(50, 5, $val['nilai_terbilang'], 'TLB', 0, 'L');
				$fpdf->Cell(30, 5, $val['nilai'] < 65 ? 'Tidak Terlampaui' : 'Terlampaui', 1, 1, 'L');
			}
			$fpdf->Ln(5);
			$fpdf->Cell(64, 5, 'Catatan Penting Penilaian', 'TLB', 0, 'C');
			$fpdf->Cell(63, 5, 'Nilai', 'TLB', 0, 'C');
			$fpdf->Cell(63, 5, 'Keterangan', 1, 1, 'C');

			$fpdf->Cell(3, 5, '', 'L', 0, 'C');
			$fpdf->Cell(2, 5, '1.', 0, 0, 'L');
			$fpdf->Cell(3, 5, '', 0, 0, 'C');
			$fpdf->Cell(56, 5, 'Budi Pekerti / Sikap', 'RB', 0, 'L');
			$fpdf->Cell(63, 5, $sikap, 'RB', 0, 'C');
			if ($sikap == 0) {
				$ketsikap = "-";
			} else if ($sikap < 85) {
				$ketsikap = "Baik";
			} else {
				$ketsikap = "Sangat Baik";
			}
			$fpdf->Cell(63, 5, $ketsikap, 'TRB', 1, 'L');

			$fpdf->Cell(3, 5, '', 'LT', 0, 'C');
			$fpdf->Cell(2, 5, '2.', 'T', 0, 'L');
			$fpdf->Cell(3, 5, '', 'T', 0, 'C');
			$fpdf->Cell(56, 5, 'Partisipasi Kelas / Kegiatan', 'R', 0, 'L');
			$fpdf->Cell(63, 5, $kegiatan, 'RB', 0, 'C');
			if ($kegiatan == 0) {
				$ketkegiatan = "-";
			} else if ($kegiatan < 85) {
				$ketkegiatan = "Baik";
			} else {
				$ketkegiatan = "Sangat Baik";
			}
			$fpdf->Cell(63, 5, $ketkegiatan, 'RB', 1, 'L');

			$fpdf->Cell(3, 5, '', 'LTB', 0, 'C');
			$fpdf->Cell(2, 5, '3.', 'TB', 0, 'L');
			$fpdf->Cell(3, 5, '', 'TB', 0, 'C');
			$fpdf->Cell(56, 5, 'Penyelesaian Tugas', 'TB', 0, 'L');
			$fpdf->Cell(63, 5, $tugas, 1, 0, 'C');
			if ($tugas == 0) {
				$ketugas = "-";
			} else if ($tugas < 85) {
				$ketugas = "Baik";
			} else {
				$ketugas = "Sangat Baik";
			}
			$fpdf->Cell(63, 5, $ketugas, 'TRB', 1, 'L');

			$fpdf->Ln(5);
			$fpdf->Cell(64, 5, 'Kegiatan Pengembangan Diri', 1, 0, 'C');
			$fpdf->Cell(63, 5, 'Nilai', 'TBR', 0, 'C');
			$fpdf->Cell(63, 5, 'Keterangan', 'TBR', 1, 'C');

			for ($i = 0; $i < 3; $i++) {
				// var_dump($nilaiindiv[$i]['kegiatan']);
				if (!empty($nilaiindiv[$i]['kegiatan'])) $keg = $nilaiindiv[$i]['kegiatan'];
				else $keg = '-';
				if (!empty($nilaiindiv[$i]['nilai'])) $nil = $nilaiindiv[$i]['nilai'];
				else $nil = '-';
				if ($nil <= 0) $ket = '-';
				else if ($nil <= 85) $ket = 'Memuaskan';
				else $ket = 'Sangat Memuaskan';
				$fpdf->Cell(3, 5, '', 'LB', 0, 'C');
				$fpdf->Cell(2, 5, $i + 1, 'B', 0, 'L');
				$fpdf->Cell(3, 5, '', 'B', 0, 'C');
				$fpdf->Cell(56, 5, $keg, 'RB', 0, 'L');
				$fpdf->Cell(63, 5, $nil, 'BR', 0, 'C');
				$fpdf->Cell(63, 5,  $ket, 'BR', 1, 'L');
			}

			//CATATAN
			$fpdf->Ln(5);
			$fpdf->Cell(190, 5, 'CATATAN', 1, 1, 'C');
			$fpdf->SetFont('Times', 'B', 12);
			$fpdf->Cell(190, 10, $cat, 1, 1, 'C');
			$fpdf->SetFont('Times', '', 10);

			// AKHLAK

			$fpdf->Ln(5);
			$fpdf->Cell(80, 5, 'Akhlak dan Kepribadian', 1, 0, 'C');
			$fpdf->Cell(5, 5, '', 0, 0, 'C');
			$fpdf->Cell(105, 5, 'Ketidak Hadiran', 1, 1, 'C');


			$fpdf->Cell(30, 5, ' Akhlak', 'L', 0, 'L');
			$fpdf->Cell(15, 5, ':', 0, 0, 'C');
			$fpdf->Cell(35, 5, 'Baik', 'R', 0, 'L');
			$fpdf->Cell(5, 5, '', 0, 0, 'C');
			$fpdf->Cell(40, 5, ' 1.Sakit', 'LB', 0, 'L');
			$fpdf->Cell(5, 5, ':', 'B', 0, 'C');
			$fpdf->Cell(60, 5, $sakit, 'RB', 1, 'L');

			$fpdf->Cell(30, 5, ' Kepribadian', 'LB', 0, 'L');
			$fpdf->Cell(15, 5, ':', 'B', 0, 'C');
			$fpdf->Cell(35, 5, 'Baik', 'BR', 0, 'L');
			$fpdf->Cell(5, 5, '', 0, 0, 'C');
			$fpdf->Cell(40, 5, ' 2.Izin', 'LB', 0, 'L');
			$fpdf->Cell(5, 5, ':', 'B', 0, 'C');
			$fpdf->Cell(60, 5, $izin, 'RB', 1, 'L');
			$fpdf->Cell(85, 5, '', 0, 0, 'C');
			$fpdf->Cell(40, 5, ' 3.Tanpa Keterangan', 'LB', 0, 'L');
			$fpdf->Cell(5, 5, ':', 'B', 0, 'C');
			$fpdf->Cell(60, 5, $tanpaket, 'RB', 1, 'L');

			// MENGETAHUI

			$fpdf->Ln(10);
			$fpdf->SetX(15);
			$fpdf->Cell(60, 5, 'Mengetahui', 0, 0, 'L');
			$fpdf->Cell(65, 5, '', 0, 0, 'C');
			$fpdf->Cell(60, 5, $kab_lembaga . ', ' . $dikel1, 0, 1, 'L');
			$fpdf->SetX(15);
			$fpdf->Cell(60, 5, 'Orang Tua/Wali', 0, 0, 'L');
			$fpdf->Cell(65, 5, '', 0, 0, 'C');
			$fpdf->Cell(60, 5, 'Wali Kelas', 0, 1, 'L');

			//WALIKELAS
			$fpdf->Cell(50, 25, '', 0, 1, 'L');
			$fpdf->SetX(140);
			// var_dump($dt_kelas_a_2['kelas_id']);
			// exit();
			if ($dt_kelas_a['kelas_id'] <= 6) {
				$tgicap = 210;
				$tgiwakel = 220;
			} else if ($dt_kelas_a['kelas_id'] > 9) {
				$tgicap = 227;
				$tgiwakel = 235;
			} else {
				$tgicap = 215;
				$tgiwakel = 225;
			}
			// sma
			$fpdf->Image('assets/images/cap.png', 105, $tgicap, 45);
			$fpdf->Image('assets/images/ttd-walikelas/' . $ttdwakel, 130, $tgiwakel, 45);

			// $fpdf->Image('assets/images/cap.png', 105, 227, 45);
			// $fpdf->Image('assets/images/ttd-walikelas/'.$wakel1['ttd'], 130, 235, 45);

			$fpdf->Cell(60, 5, $nmwakel, 0, 1, 'L');
		}




		// HALAMAN KE LIMA

		$fpdf->AddPage();
		if (empty($datavalid2['semester'])) {
			$fpdf->Cell(30, 6, 'data semester 2 kosong', 0, 0, 'L');
		} else {
			// $fpdf->Cell(30, 6, 'data semester 2 ada', 0, 0, 'L');
			// load data semester 2
			// nilai
			$this->db->select('*')->from('tbl_nilai a');
			$this->db->join('tbl_mapel b', 'a.kd_mapel = b.kd_mapel', 'inner');
			$this->db->join('tbl_terbilang c', 'a.nilai = c.id_nilai', 'left');
			$this->db->where(['a.nis_siswa' => $id, 'a.ta' => str_replace('-', '/', $ta), 'a.semester' => 2, 'b.kelompok' => 'A']);
			$dt_nilai_a_2 = $this->db->order_by('a.kd_mapel', 'asc')->get()->result_array();

			$this->db->select('*')->from('tbl_nilai a');
			$this->db->join('tbl_mapel b', 'a.kd_mapel = b.kd_mapel', 'inner');
			$this->db->join('tbl_terbilang c', 'a.nilai = c.id_nilai', 'left');
			$this->db->where(['a.nis_siswa' => $id, 'a.ta' => str_replace('-', '/', $ta), 'a.semester' => 2, 'b.kelompok' => 'B']);
			$dt_nilai_b_2 = $this->db->order_by('a.kd_mapel', 'asc')->get()->result_array();

			$this->db->select('*')->from('tbl_nilai a');
			$this->db->join('tbl_mapel b', 'a.kd_mapel = b.kd_mapel', 'inner');
			$this->db->join('tbl_terbilang c', 'a.nilai = c.id_nilai', 'left');
			$this->db->where(['a.nis_siswa' => $id, 'a.ta' => str_replace('-', '/', $ta), 'a.semester' => 2, 'b.kelompok' => 'C']);
			$dt_nilai_c_2 = $this->db->order_by('a.kd_mapel', 'asc')->get()->result_array();

			$dt_kelas_a_2 = $this->db->select('*')->from('tbl_nilai a')->join('tbl_kelas b', 'a.kelas_id = b.kelas_id', 'left')->where(['a.nis_siswa' => $id, 'a.ta' => str_replace('-', '/', $ta), 'a.semester' => 2])->get()->row_array();

			$klsnm = explode(' ', $dt_kelas_a_2['kelas_nama']);
			$kls_kick = '';
			$kls_2 = '';
			for ($i = 0; $i <= count($klsnm) - 1; $i++) {
				if ($i < 1) {
					$kls_kick .= $klsnm[$i] . ' ';
				} else {
					$kls_2 .= $klsnm[$i] . ' ';
				}
			}


			// load data nilai individu
			$nilaiindiv_2 = $this->db->get_where('tbl_nilai_indv', ['nis_siswa' => $id, 'ta' => str_replace('-', '/', $ta), 'semester' => 2])->result_array();

			// load data catatan
			$catatan_2 = $this->db->get_where('tbl_catmur', ['nis_siswa' => $id, 'ta' => str_replace('-', '/', $ta), 'semester' => 2])->row_array();

			// load data absensi
			$abs_2 = $this->db->get_where('tbl_absensi', ['nis_siswa' => $id, 'ta' => str_replace('-', '/', $ta), 'semester' => 2])->row_array();
			// load data catatan penting
			$catpen_2 = $this->db->get_where('tbl_catpenting', ['nis_siswa' => $id, 'ta' => str_replace('-', '/', $ta), 'sms' => 2])->row_array();
			if (!empty($catpen_2['sikap'])) $sikap_2 = $catpen_2['sikap'];
			else $sikap_2 = '-';
			if (!empty($catpen_2['kegiatan'])) $kegiatan_2 = $catpen_2['kegiatan'];
			else $kegiatan_2 = '-';
			if (!empty($catpen_2['tugas'])) $tugas_2 = $catpen_2['tugas'];
			else $tugas_2 = '-';

			$raportkeluar_2 = $this->db->get_where('tbl_thn_ajaran', ['thn_ajaran' => str_replace('-', '/', $ta), 'semester' => '2'])->row_array();
			$dikel2 = $this->ttl($raportkeluar_2['tgl_dikeluarkan']);

			// $wakel2 = $this->db->select('wali_kelas,ttd')->from('tbl_kelas')->where(['kelas_id' => $dt_kelas_a_2['kelas_id']])->get()->row_array();

			// end of data semester 2
			$fpdf->SetFont('Times', '', 10);
			$fpdf->Cell(30, 6, 'Nama Sekolah', 0, 0, 'L');
			$fpdf->Cell(5, 6, ':', 0, 0, 'C');
			$fpdf->Cell(95, 6, 'PKBM Anak Panah HS', 0, 0, 'L');
			$fpdf->Cell(30, 6, 'Kelas', 0, 0, 'L');
			$fpdf->Cell(5, 6, ':', 0, 0, 'C');
			$fpdf->Cell(30, 6, $kls_2, 0, 1, 'L');
			$fpdf->Cell(30, 6, 'Alamat', 0, 0, 'L');
			$fpdf->Cell(5, 6, ':', 0, 0, 'C');
			$fpdf->Cell(95, 6, 'Kp. Nanggela RT.002 RW.002 Sukmajaya', 0, 0, 'L');
			$fpdf->Cell(30, 6, 'Semester', 0, 0, 'L');
			$fpdf->Cell(5, 6, ':', 0, 0, 'C');
			$fpdf->Cell(30, 6, '2' > 1 ? '2 (Dua)' : '1 (Satu)', 0, 1, 'L');
			$fpdf->Cell(30, 6, 'Nama Peserta Didik', 0, 0, 'L');
			$fpdf->Cell(5, 6, ':', 0, 0, 'C');
			$fpdf->Cell(95, 6, $nama, 0, 0, 'L');
			$fpdf->Cell(30, 6, 'Tahun Pelajaran', 0, 0, 'L');
			$fpdf->Cell(5, 6, ':', 0, 0, 'C');
			$fpdf->Cell(30, 6, str_replace('-', '/', $ta), 0, 1, 'L');
			$fpdf->Cell(30, 6, 'NIS / NISN', 0, 0, 'L');
			$fpdf->Cell(5, 6, ':', 0, 0, 'C');
			$fpdf->Cell(95, 6, $nis, 0, 1, 'L');
			$fpdf->Ln(10);

			$fpdf->Cell(10, 10, 'No', 'TLB', 0, 'C');
			$fpdf->Cell(60, 10, 'Mata Pelajaran', 'TLB', 0, 'C');
			$fpdf->Cell(20, 10, 'KKM *)', 'TLB', 0, 'C');
			$fpdf->Cell(70, 5, 'Nilai', 1, 0, 'C');
			$fpdf->Cell(30, 10, 'Deskripsi Belajar', 'TRB', 1, 'C');
			$fpdf->SetXY(100, 49);
			$fpdf->Cell(20, 5, 'Angka', 'RLB', 0, 'C');
			$fpdf->Cell(50, 5, 'Terbilang', 'BR', 0, 'C');

			$fpdf->SetXY(10, 54);
			$fpdf->Cell(10, 5, '', 'TLB', 0, 'C');
			$fpdf->Cell(60, 5, 'KELOMPOK A (Wajib)', 'TLB', 0, 'L');
			$fpdf->Cell(20, 5, '', 'TLB', 0, 'C');
			$fpdf->Cell(20, 5, '', 'TLB', 0, 'C');
			$fpdf->Cell(50, 5, '', 'TLB', 0, 'C');
			$fpdf->Cell(30, 5, '', 1, 1, 'C');
			foreach ($dt_nilai_a_2 as $key => $val) {
				$fpdf->Cell(10, 5, $key + 1, 'TLB', 0, 'C');
				$fpdf->Cell(60, 5, $val['nm_mapel'], 'TLB', 0, 'L');
				$fpdf->Cell(20, 5, 65, 'TLB', 0, 'C');
				$fpdf->Cell(20, 5, $val['nilai'], 'TLB', 0, 'C');
				$fpdf->Cell(50, 5, $val['nilai_terbilang'], 'TLB', 0, 'L');
				$fpdf->Cell(30, 5, $val['nilai'] < 65 ? 'Tidak Terlampaui' : 'Terlampaui', 1, 1, 'L');
			}

			$fpdf->Cell(10, 5, '', 'TLB', 0, 'C');
			$fpdf->Cell(60, 5, 'KELOMPOK B (Wajib)', 'TLB', 0, 'L');
			$fpdf->Cell(20, 5, '', 'TLB', 0, 'C');
			$fpdf->Cell(20, 5, '', 'TLB', 0, 'C');
			$fpdf->Cell(50, 5, '', 'TLB', 0, 'C');
			$fpdf->Cell(30, 5, '', 1, 1, 'C');

			foreach ($dt_nilai_b_2 as $key => $val) {
				$fpdf->Cell(10, 5, $key + 1, 'TLB', 0, 'C');
				$fpdf->Cell(60, 5, $val['nm_mapel'], 'TLB', 0, 'L');
				$fpdf->Cell(20, 5, 65, 'TLB', 0, 'C');
				$fpdf->Cell(20, 5, $val['nilai'], 'TLB', 0, 'C');
				$fpdf->Cell(50, 5, $val['nilai_terbilang'], 'TLB', 0, 'L');
				$fpdf->Cell(30, 5, $val['nilai'] < 65 ? 'Tidak Terlampaui' : 'Terlampaui', 1, 1, 'L');
			}

			if (!empty($dt_nilai_c_2)) {
				$fpdf->Cell(10, 5, '', 'TLB', 0, 'C');
				$fpdf->Cell(60, 5, 'KELOMPOK C (Peminatan)', 'TLB', 0, 'L');
				$fpdf->Cell(20, 5, '', 'TLB', 0, 'C');
				$fpdf->Cell(20, 5, '', 'TLB', 0, 'C');
				$fpdf->Cell(50, 5, '', 'TLB', 0, 'C');
				$fpdf->Cell(30, 5, '', 1, 1, 'C');
			}
			foreach ($dt_nilai_c_2 as $key => $val) {
				$fpdf->Cell(10, 5, $key + 1, 'TLB', 0, 'C');
				$fpdf->Cell(60, 5, $val['nm_mapel'], 'TLB', 0, 'L');
				$fpdf->Cell(20, 5, 65, 'TLB', 0, 'C');
				$fpdf->Cell(20, 5, $val['nilai'], 'TLB', 0, 'C');
				$fpdf->Cell(50, 5, $val['nilai_terbilang'], 'TLB', 0, 'L');
				$fpdf->Cell(30, 5, $val['nilai'] < 65 ? 'Tidak Terlampaui' : 'Terlampaui', 1, 1, 'L');
			}
			$fpdf->Ln(5);
			$fpdf->Cell(64, 5, 'Catatan Penting Penilaian', 'TLB', 0, 'C');
			$fpdf->Cell(63, 5, 'Nilai', 'TLB', 0, 'C');
			$fpdf->Cell(63, 5, 'Keterangan', 1, 1, 'C');

			$fpdf->Cell(3, 5, '', 'L', 0, 'C');
			$fpdf->Cell(2, 5, '1.', 0, 0, 'L');
			$fpdf->Cell(3, 5, '', 0, 0, 'C');
			$fpdf->Cell(56, 5, 'Budi Pekerti / Sikap', 'RB', 0, 'L');
			$fpdf->Cell(63, 5, $sikap_2, 'TRB', 0, 'C');
			if ($sikap_2 == 0) {
				$ketsikap_2 = "-";
			} else if ($sikap_2 < 85) {
				$ketsikap_2 = "Baik";
			} else {
				$ketsikap_2 = "Sangat Baik";
			}
			$fpdf->Cell(63, 5, $ketsikap_2, 'TRB', 1, 'L');

			$fpdf->Cell(3, 5, '', 'LT', 0, 'C');
			$fpdf->Cell(2, 5, '2.', 'T', 0, 'L');
			$fpdf->Cell(3, 5, '', 'T', 0, 'C');
			$fpdf->Cell(56, 5, 'Partisipasi Kelas / Kegiatan', 'R', 0, 'L');
			$fpdf->Cell(63, 5, $kegiatan_2, 'RB', 0, 'C');

			if ($kegiatan_2 == 0) {
				$ketkegiatan_2 = "-";
			} else if ($kegiatan_2 < 85) {
				$ketkegiatan_2 = "Baik";
			} else {
				$ketkegiatan_2 = "Sangat Baik";
			}
			$fpdf->Cell(63, 5, $ketkegiatan_2, 'RB', 1, 'L');

			$fpdf->Cell(3, 5, '', 'LTB', 0, 'C');
			$fpdf->Cell(2, 5, '3.', 'TB', 0, 'L');
			$fpdf->Cell(3, 5, '', 'TB', 0, 'C');
			$fpdf->Cell(56, 5, 'Penyelesaian Tugas', 'TB', 0, 'L');
			$fpdf->Cell(63, 5, $tugas_2, 1, 0, 'C');
			if ($tugas_2 == 0) {
				$ketugas_2 = "-";
			} else if ($tugas_2 < 85) {
				$ketugas_2 = "Baik";
			} else {
				$ketugas_2 = "Sangat Baik";
			}
			$fpdf->Cell(63, 5, $ketugas_2, 'TRB', 1, 'L');
			$fpdf->Ln(5);
			$fpdf->Cell(64, 5, 'Kegiatan Pengembangan Diri', 1, 0, 'C');
			$fpdf->Cell(63, 5, 'Nilai', 'TBR', 0, 'C');
			$fpdf->Cell(63, 5, 'Keterangan', 'TBR', 1, 'C');

			for ($i = 0; $i < 3; $i++) {

				if (!empty($nilaiindiv_2[$i]['kegiatan'])) $keg_2 = $nilaiindiv_2[$i]['kegiatan'];
				else $keg_2 = '-';
				if (!empty($nilaiindiv_2[$i]['nilai'])) $nil_2 = $nilaiindiv_2[$i]['nilai'];
				else $nil_2 = '-';
				if ($nil_2 <= 0) $ket_2 = '-';
				else if ($nil_2 <= 85) $ket_2 = 'Memuaskan';
				else $ket_2 = 'Sangat Memuaskan';
				$fpdf->Cell(3, 5, '', 'LB', 0, 'C');
				$fpdf->Cell(2, 5, $i + 1, 'B', 0, 'L');
				$fpdf->Cell(3, 5, '', 'B', 0, 'C');
				$fpdf->Cell(56, 5, $keg_2, 'RB', 0, 'L');
				$fpdf->Cell(63, 5, $nil_2, 'BR', 0, 'C');
				$fpdf->Cell(63, 5,  $ket_2, 'BR', 1, 'L');
			}

			//CATATAN
			$fpdf->Ln(5);
			$fpdf->Cell(190, 5, 'CATATAN', 1, 1, 'C');
			$fpdf->SetFont('Times', 'B', 12);
			$fpdf->Cell(190, 10, $cat_2, 1, 1, 'C');
			$fpdf->SetFont('Times', '', 10);


			// AKHLAK

			$fpdf->Ln(5);
			$fpdf->Cell(80, 5, 'Akhlak dan Kepribadian', 1, 0, 'C');
			$fpdf->Cell(5, 5, '', 0, 0, 'C');
			$fpdf->Cell(105, 5, 'Ketidak Hadiran', 1, 1, 'C');


			$fpdf->Cell(30, 5, ' Akhlak', 'L', 0, 'L');
			$fpdf->Cell(15, 5, ':', 0, 0, 'C');
			$fpdf->Cell(35, 5, 'Baik', 'R', 0, 'L');
			$fpdf->Cell(5, 5, '', 0, 0, 'C');
			$fpdf->Cell(40, 5, ' 1.Sakit', 'LB', 0, 'L');
			$fpdf->Cell(5, 5, ':', 'B', 0, 'C');
			$fpdf->Cell(60, 5, $sakit_2, 'RB', 1, 'L');


			$fpdf->Cell(30, 5, ' Kepribadian', 'LB', 0, 'L');
			$fpdf->Cell(15, 5, ':', 'B', 0, 'C');
			$fpdf->Cell(35, 5, 'Baik', 'BR', 0, 'L');
			$fpdf->Cell(5, 5, '', 0, 0, 'C');
			$fpdf->Cell(40, 5, ' 2.Izin', 'LB', 0, 'L');
			$fpdf->Cell(5, 5, ':', 'B', 0, 'C');
			$fpdf->Cell(60, 5, $izin_2, 'RB', 1, 'L');
			$fpdf->Cell(85, 5, '', 0, 0, 'C');
			$fpdf->Cell(40, 5, ' 3.Tanpa Keterangan', 'LB', 0, 'L');
			$fpdf->Cell(5, 5, ':', 'B', 0, 'C');
			$fpdf->Cell(60, 5, $tanpaket_2, 'RB', 1, 'L');

			// MENGETAHUI

			$fpdf->Ln(10);
			$fpdf->SetX(15);
			$fpdf->Cell(60, 5, 'Mengetahui', 0, 0, 'L');
			$fpdf->Cell(65, 5, '', 0, 0, 'C');
			$fpdf->Cell(60, 5, $kab_lembaga . ', ' . $dikel2, 0, 1, 'L');
			$fpdf->SetX(15);
			$fpdf->Cell(60, 5, 'Orang Tua/Wali', 0, 0, 'L');
			$fpdf->Cell(65, 5, '', 0, 0, 'C');
			$fpdf->Cell(60, 5, 'Wali Kelas', 0, 1, 'L');

			if ($dt_kelas_a_2['kelas_id'] <= 6) {
				$tgicap2 = 205;
				$tgiwakel2 = 215;
			} else if ($dt_kelas_a_2['kelas_id'] > 9) {
				$tgicap2 = 222;
				$tgiwakel2 = 230;
			} else {
				$tgicap2 = 210;
				$tgiwakel2 = 220;
			}

			//WALIKELAS
			$fpdf->Cell(50, 20, '', 0, 1, 'L');
			$fpdf->SetX(140);
			$fpdf->Image('assets/images/cap.png', 105, $tgicap2, 45);
			$fpdf->Image('assets/images/ttd-walikelas/' . $ttdwakel, 130, $tgiwakel2, 45);
			$fpdf->Cell(60, 5, $nmwakel, 0, 1, 'L');
		}


		// $fpdf->Cell(40, 6, $kab_lembaga.', '.$dikel, 0, 1, 'L');
		// give the name file
		$fpdf->Output('I', 'CF-' . $res['siswa_nama'] . '.pdf');
	}
}
