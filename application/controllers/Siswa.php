<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url('login');
			redirect($url);
		};
		$this->load->model('m_siswa');
		$this->load->model('m_pengguna');
		$this->load->model('m_kelas');
		$this->load->model('m_agama');
		$this->load->model('m_orangtua');
		$this->load->model('m_keuangan');
		$this->load->library('upload');
	}


	function index()
	{
		$this->load->view('admin/v_siswa');
	}

	function online_class()
	{
		$row = array();
		$peserta = array();
		$sql = $this->db->get_where('tbl_kelas', ['kelas_id <' => 16])->result_array();
		
		foreach ($sql as $sql) {
			$qry = $this->db->get_where('tbl_siswa', ['siswa_kelas_id' => $sql['kelas_id']])->result_array();
			
			$peserta['kelas'] = $sql['kelas_nama'];
			$siswa = array();
			foreach ($qry as $val) {
				array_push(
					$siswa,
					array(
						'nis' => $val['siswa_nis'],
						'nama' => $val['siswa_nama'],
						'onclass' => $val['oc']
					)
				);
			}
			$peserta['siswa'] = $siswa;
			$row[] = $peserta;
		}
		// var_dump($row);
		// die;
				
		$data['li_peserta'] = $row;

		$this->load->view('admin/v_online_class', $data);
	}

	function save_online_class()
	{
		$this->db->update('tbl_siswa', ['oc' => 0], ['oc' => 1]);

		$peserta = $this->input->post('peserta[]');

		foreach ($peserta as $key => $val) {
			$this->db->update('tbl_siswa', ['oc' => 1], ['siswa_nis' => $val]);
		}

		redirect(site_url('siswa/online_class'));
	}
	

	public function list_siswa()
	{
		$list = $this->m_siswa->get_datatables();
		$data = array();
		$no = 1;
		foreach ($list as $li) {
			$row = array();
			$row[] = $no++;
			$row[] = $li['siswa_nis'];
			$row[] = $li['siswa_nama'];
			$row[] = $li['kelas_nama'];
			$row[] = $li['siswa_email'];
			$row[] = $li['siswa_no_telp'];
			$row[] = $li['satelit_nama'];
			// $aksi = '<center><a href="javascript:void(0)" title="Edit Siswa" onclick="edit_siswa(' . "'" . $li['siswa_nis'] . "'" . ')"><i class="fa fa-fw fa-edit"></i></a> ';
			// $aksi .= '<a href="javascript:void(0)" title="Keluarkan Siswa" onclick="delete_siswa(' . "'" . $li['siswa_nis'] . "'" . ')"><i class="fa fa-fw fa-trash"></i></a> ';
			// $aksi .= '<br><a href="keuangan"><i class="fa fa-fw fa-dollar"></i></a> ';
			// $aksi .= ' <a href="javascript:void(0)" title="Detail Siswa" onclick="detail_siswa(' . "'" . $li['siswa_nis'] . "'" . ')"><i class="fa fa-fw fa-user"></i></a></center>';

			$aksi = '<a href="' . site_url('siswa/edit_siswa/' . $li['siswa_nis']) . '" class="label label-success col-md-12"><i class="fa fa-fw fa-edit"></i> Edit Siswa</a><br>';
			$aksi .= '<a href="javascript:delete_siswa(' . "'" . $li['siswa_nis'] . "'" . ',' . "'" . $li['siswa_nama'] . "'" . ')" class="label label-danger col-md-12"><i class="fa fa-fw fa-trash"></i>Keluarkan Siswa</a><br>';
			$aksi .= '<a href="javascript:void(0)" class="label label-info col-md-12" onclick="detail_siswa(' . "'" . $li['siswa_nis'] . "'" . ')"><i class="fa fa-fw fa-info"></i> Detail Siswa</a><br>';
			$aksi .= '<a href="javascript:void(0)" class="label label-warning col-md-12" onclick="send_msg(' . "'" . $li['siswa_nis'] . "'" . ')"><i class="fa fa-fw fa-envelope-o"></i> Send Massage</a>';
			$row[] = $aksi;

			$data[] = $row;
		}

		$output = array(
			'draw' => intval($_POST['draw']),
			'recordsTotal' => $this->m_siswa->get_all_data(),
			'recordsFiltered' => $this->m_siswa->count_filtered(),
			'data' => $data
		);
		echo json_encode($output);
		exit;
	}

	function save_msg()
	{
		$data = array(
			'inbox_kontak' => $this->input->post('nis'),
			'inbox_pesan' => $this->input->post('pesan')
		);
		$this->db->insert('tbl_inbox', $data);
		echo json_encode(['status' => true]);
		exit();
	}

	function get_siswa($nis)
	{
		$data = $this->db->get_where('tbl_siswa', ['siswa_nis' => $nis])->row_array();
		echo json_encode($data);
		exit;
	}

	function add_siswa()
	{
		$data['kelas'] = $this->m_kelas->get_all_kelas();
		$data['agama'] = $this->m_agama->get_all_agama();

		$page = 'admin/v_add_siswa';

		$this->load->view($page, $data);
	}

	function delete_siswa($id)
	{
		// var_dump($id); exit();
		$this->db->update('tbl_siswa', ['soft_deleted' => '1'], ['siswa_nis' => $id]);

		redirect('siswa', 'refresh');
	}

	function detail_siswa($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_siswa a');
		$this->db->join('tbl_orangtua b', 'a.siswa_nis=b.siswa_nis', 'inner');
		$this->db->join('tbl_agama c', 'a.siswa_agama_id=c.agama_id', 'left');
		$this->db->join('tbl_kelas d', 'a.siswa_kelas_id=d.kelas_id', 'left');
		$this->db->join('tbl_satelit e', 'a.satelit=e.satelit_id', 'left');
		$this->db->where(['a.siswa_nis' => $id, 'a.soft_deleted' => '0']);

		$result = $this->db->get()->row_array();
		echo json_encode($result);
		exit;
	}

	function edit_siswa($nis)
	{
		$sql = "select * from tbl_siswa a ";
		$sql .= "left join tbl_orangtua b on a.siswa_nis = b.siswa_nis ";
		$sql .= "inner join tbl_kelas c on a.siswa_kelas_id = c.kelas_id ";
		$sql .= "inner join tbl_agama d on a.siswa_agama_id = d.agama_id ";
		$sql .= "inner join tbl_satelit e on a.satelit = e.satelit_id ";
		$sql .= "where a.siswa_nis = '" . $nis . "' and a.soft_deleted = '0'";

		$dt = $this->db->query($sql)->row_array();

		$data = array(
			// siswa
			'satelit' => $dt['satelit_id'],
			'nama' => $dt['siswa_nama'],
			'anak' => $dt['anak_ke'],
			'nis' => $dt['siswa_nis'],
			'nisn' => $dt['siswa_nisn'],
			'sekolah' => $dt['sekolah_asal'],
			'no_telp' => $dt['siswa_no_telp'],
			'tmpt_lahir' => $dt['siswa_tempat'],
			'tgl_lahir' => $dt['siswa_tgl_lahir'],
			'jenkel' => $dt['siswa_jenkel'],
			'kelas' => $dt['siswa_kelas_id'],
			'foto' => $dt['siswa_photo'],
			'agama' => $dt['siswa_agama_id'],
			'email' => $dt['siswa_email'],
			'file' => $dt['siswa_dokumen'],
			'kwn' => strtoupper($dt['siswa_kewarganegaraan']),
			'alamat' => $dt['siswa_alamat'],
			// ayah
			'nama_ayah' => $dt['ayah_nama'],
			'nik_ayah' => $dt['ayah_nik'],
			'tmpt_lahir_ayah' => $dt['ayah_tempat'],
			'tgl_lahir_ayah' => $dt['ayah_tanggal'],
			'pend_ayah' => $dt['ayah_pendidikan'],
			'kerja_ayah' => $dt['ayah_pekerjaan'],
			'gaji_ayah' => $dt['ayah_penghasilan'],
			'notelp_ayah' => $dt['no_telp_ayah'],
			'email_ayah' => $dt['email_ayah'],
			// ibu
			'nama_ibu' => $dt['ibu_nama'],
			'nik_ibu' => $dt['ibu_nik'],
			'tmpt_lahir_ibu' => $dt['ibu_tempat'],
			'tgl_lahir_ibu' => $dt['ibu_tanggal'],
			'pend_ibu' => $dt['ibu_pendidikan'],
			'kerja_ibu' => $dt['ibu_pekerjaan'],
			'gaji_ibu' => $dt['ibu_penghasilan'],
			'notelp_ibu' => $dt['no_telp_ibu'],
			'email_ibu' => $dt['email_ibu'],
			// wali
			'nama_wali' => $dt['wali_nama'],
			'nik_wali' => $dt['wali_nik'],
			'tmpt_lahir_wali' => $dt['wali_tempat'],
			'tgl_lahir_wali' => $dt['wali_tanggal'],
			'pend_wali' => $dt['wali_pendidikan'],
			'kerja_wali' => $dt['wali_pekerjaan'],
			'gaji_wali' => $dt['wali_penghasilan'],
			'alamat_wali' => $dt['wali_alamat'],
			'telp_wali' => $dt['wali_notelp']
		);

		$this->load->view('admin/v_edit_siswa', $data);
	}

	function simpan_siswa()
	{
		$nis = strip_tags($this->input->post('xnis'));

		if ((file_exists('./assets/filesiswa/' . $nis)) && (is_dir('./assets/filesiswa/' . $nis))) {
			echo "<script>alert('NIS Sudah Ada!'); window.history.back();</script>";
		} else {
			// var_dump($_FILES); exit();
			for ($i = 0; $i <= 1; $i++) {
				if ($_FILES['file' . $i]['error'] > 0) {
					$this->session->set_flashdata('msg', 'info');
					// header("location:javascript://history.go(-1)");
					echo "<script>alert('Size not allowed!'); window.history.back();</script>";
					return;
				}
			}

			if ($_FILES['file0']['type'] == 'application/pdf') {
				$this->session->set_flashdata('msg', 'info');
				// header("location:javascript://history.go(-1)");
				echo "<script>alert('File foto harus berformat JPG/PNG'); window.history.back();</script>";
				return;
			}
			mkdir('./assets/filesiswa/' . $nis);

			$dt_siswa = array(
				'siswa_nis' => $nis,
				'siswa_nisn' => strip_tags($this->input->post('xnisn')),
				'siswa_nama' => strip_tags($this->input->post('xnama')),
				'siswa_jenkel' => strip_tags($this->input->post('xjenkel')),
				'siswa_tempat' => strip_tags($this->input->post('xtmpatlahirsiswa')),
				'siswa_tgl_lahir' => $this->input->post('tgl_lahirsiswa'),
				'siswa_agama_id' => strip_tags($this->input->post('xagama')),
				'siswa_kewarganegaraan' => strip_tags($this->input->post('xkewarganegaraan')),
				'siswa_alamat' => strip_tags($this->input->post('xalamat')),
				'siswa_email' => strip_tags($this->input->post('xemail')),
				'siswa_no_telp' => strip_tags($this->input->post('xnotelpsiswa')),
				'siswa_kelas_id' => strip_tags($this->input->post('xkelas')),
				'anak_ke' => strip_tags($this->input->post('xanke')),
				'sekolah_asal' => strip_tags($this->input->post('xsekolahasal')),
				'satelit' => strip_tags($this->input->post('xsatelit')),
			);
			$dt_ortu = array(
				'siswa_nis' => $nis,
				'ayah_nama' => strip_tags($this->input->post('xnamaayah')),
				'ayah_nik' => strip_tags($this->input->post('xnikayah')),
				'ayah_tempat' => strip_tags($this->input->post('xtmpayah')),
				'ayah_tanggal' => $this->input->post('tgl_lahirayah'),
				'ayah_pendidikan' => strip_tags($this->input->post('xptayah')),
				'ayah_pekerjaan' => strip_tags($this->input->post('xkayah')),
				'ayah_penghasilan' => strip_tags($this->input->post('xpnayah')),
				'no_telp_ayah' => strip_tags($this->input->post('xnotelpayah')),
				'email_ayah' => strip_tags($this->input->post('xemailayah')),
				'ibu_nama' => strip_tags($this->input->post('xnamaibu')),
				'ibu_nik' => strip_tags($this->input->post('xnikibu')),
				'ibu_tempat' => strip_tags($this->input->post('xtmpibu')),
				'ibu_tanggal' => $this->input->post('tgl_lahiribu'),
				'ibu_pendidikan' => strip_tags($this->input->post('xptibu')),
				'ibu_pekerjaan' => strip_tags($this->input->post('xkibu')),
				'ibu_penghasilan' => strip_tags($this->input->post('xpnibu')),
				'no_telp_ibu' => strip_tags($this->input->post('xnotelpibu')),
				'email_ibu' => strip_tags($this->input->post('xemailibu')),
				'wali_nama' => strip_tags($this->input->post('xnamawali')),
				'wali_nik' => strip_tags($this->input->post('xnikwali')),
				'wali_tempat' => strip_tags($this->input->post('xtmpwali')),
				'wali_tanggal' => $this->input->post('tgl_lahirwali'),
				'wali_pendidikan' => strip_tags($this->input->post('xptwali')),
				'wali_pekerjaan' => strip_tags($this->input->post('xkwali')),
				'wali_penghasilan' => strip_tags($this->input->post('xpnwali')),
				'wali_alamat' => strip_tags($this->input->post('xwalialamat')),
				'wali_notelp' => strip_tags($this->input->post('xnotelpwali')),
			);
			$dt_pengguna = array(
				'pengguna_nama' => strip_tags($this->input->post('xnama')),
				'pengguna_username' => $nis,
				'pengguna_password' => md5($nis),
				'pengguna_status' => '1',
				'pengguna_level' => '2',
			);


			$config = array(
				'upload_path' => './assets/filesiswa/' . $nis,
				'allowed_types' => 'jpg|jpeg|png|pdf'
				// 'max_size' => '2000'
			);

			$this->upload->initialize($config);

			for ($i = 0; $i <= 1; $i++) {
				if ($_FILES['file' . $i]['name']) {

					$this->upload->do_upload('file' . $i);
					$dt_upload = $this->upload->data();

					if ($dt_upload['is_image'] === true) {
						$config['image_library'] = 'gd2';
						$config['source_image'] = './assets/filesiswa/' . $nis . '/' . $dt_upload['file_name'];
						$config['create_thumb'] = FALSE;
						$config['maintain_ratio'] = FALSE;
						$config['quality'] = '60%';
						$config['width'] = 230;
						$config['height'] = 250;
						$config['new_image'] = './assets/filesiswa/' . $nis . '/' . $dt_upload['file_name'];
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();

						$dt_siswa['siswa_photo'] = $dt_upload['file_name'];
					} else {
						$dt_siswa['siswa_dokumen'] = $dt_upload['file_name'];
					}
				} else {
					echo "Gagal upload dokumen";
					return;
				}
			}

			$this->db->insert('tbl_siswa', $dt_siswa);
			$this->db->insert('tbl_orangtua', $dt_ortu);
			$this->db->insert('tbl_pengguna', $dt_pengguna);

			redirect('siswa', 'refresh');
		}
	}

	function update_siswa()
	{
		// var_dump($_FILES);
		// exit();
		$nis = strip_tags($this->input->post('xnis'));

		$dt_siswa = array(
			// 'siswa_nis' => $nis,
			// 'siswa_nisn' => strip_tags($this->input->post('xnisn')),
			'siswa_nama' => strip_tags($this->input->post('xnama')),
			'siswa_jenkel' => strip_tags($this->input->post('xjenkel')),
			'siswa_tempat' => strip_tags($this->input->post('xtmpatlahirsiswa')),
			'siswa_tgl_lahir' => $this->input->post('tgl_lahirsiswa'),
			'siswa_agama_id' => strip_tags($this->input->post('xagama')),
			'siswa_kewarganegaraan' => strip_tags($this->input->post('xkewarganegaraan')),
			'siswa_alamat' => strip_tags($this->input->post('xalamat')),
			'siswa_email' => strip_tags($this->input->post('xemail')),
			'siswa_no_telp' => strip_tags($this->input->post('xnotelpsiswa')),
			'siswa_kelas_id' => strip_tags($this->input->post('xkelas')),
			'anak_ke' => strip_tags($this->input->post('xanke')),
			'sekolah_asal' => strip_tags($this->input->post('xsekolahasal')),
			'satelit' => strip_tags($this->input->post('xsatelit')),
		);

		$dt_ortu = array(
			// 'siswa_nis' => $nis,
			'ayah_nama' => strip_tags($this->input->post('xnamaayah')),
			'ayah_nik' => strip_tags($this->input->post('xnikayah')),
			'ayah_tempat' => strip_tags($this->input->post('xtmpayah')),
			'ayah_tanggal' => $this->input->post('tgl_lahirayah'),
			'ayah_pendidikan' => strip_tags($this->input->post('xptayah')),
			'ayah_pekerjaan' => strip_tags($this->input->post('xkayah')),
			'ayah_penghasilan' => strip_tags($this->input->post('xpnayah')),
			'no_telp_ayah' => strip_tags($this->input->post('xnotelpayah')),
			'email_ayah' => strip_tags($this->input->post('xemailayah')),
			'ibu_nama' => strip_tags($this->input->post('xnamaibu')),
			'ibu_nik' => strip_tags($this->input->post('xnikibu')),
			'ibu_tempat' => strip_tags($this->input->post('xtmpibu')),
			'ibu_tanggal' => $this->input->post('tgl_lahiribu'),
			'ibu_pendidikan' => strip_tags($this->input->post('xptibu')),
			'ibu_pekerjaan' => strip_tags($this->input->post('xkibu')),
			'ibu_penghasilan' => strip_tags($this->input->post('xpnibu')),
			'no_telp_ibu' => strip_tags($this->input->post('xnotelpibu')),
			'email_ibu' => strip_tags($this->input->post('xemailibu')),
			'wali_nama' => strip_tags($this->input->post('xnamawali')),
			'wali_nik' => strip_tags($this->input->post('xnikwali')),
			'wali_tempat' => strip_tags($this->input->post('xtmpwali')),
			'wali_tanggal' => $this->input->post('tgl_lahirwali'),
			'wali_pendidikan' => strip_tags($this->input->post('xptwali')),
			'wali_pekerjaan' => strip_tags($this->input->post('xkwali')),
			'wali_penghasilan' => strip_tags($this->input->post('xpnwali')),
			'wali_alamat' => strip_tags($this->input->post('xwalialamat')),
			'wali_notelp' => strip_tags($this->input->post('xnotelpwali')),
		);

		$config = array(
			'upload_path' => './assets/filesiswa/' . $nis,
			'allowed_types' => 'jpg|jpeg|png|pdf'
			// 'max_size' => '2000'
		);

		$this->upload->initialize($config);
		$getsql = $this->db->get_where('tbl_siswa', ['siswa_nis' => $nis])->row_array();
		$dt_ptlama = $getsql["siswa_photo"];
		$dt_flama = $getsql["siswa_dokumen"];

		// var_dump($dt_ptlama);
		// exit();

		for ($i = 0; $i <= 1; $i++) {
			if ($_FILES['file' . $i]['name']) {
				if ($_FILES['file' . $i]['error'] > 0) {
					$this->session->set_flashdata('msg', 'info');
					// header("location:javascript://history.go(-1)");
					echo "<script>alert('Size not allowed!'); window.history.back();</script>";
					return;
				} else {
					// $path='./assets/filesiswa/'.$nis.'/'.$dt_ptlama;
					// exit();

					$this->upload->do_upload('file' . $i);
					$dt_upload = $this->upload->data();

					if ($dt_upload['is_image'] === true) {
						$config['image_library'] = 'gd2';
						$config['source_image'] = './assets/filesiswa/' . $nis . '/' . $dt_upload['file_name'];
						$config['create_thumb'] = FALSE;
						$config['maintain_ratio'] = FALSE;
						$config['quality'] = '60%';
						$config['width'] = 230;
						$config['height'] = 250;
						$config['new_image'] = './assets/filesiswa/' . $nis . '/' . $dt_upload['file_name'];
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();

						unlink('./assets/filesiswa/' . $nis . '/' . $dt_ptlama);
						// exit();
						$dt_siswa['siswa_photo'] = $dt_upload['file_name'];
					} else {
						unlink('./assets/filesiswa/' . $nis . '/' . $dt_flama);
						$dt_siswa['siswa_dokumen'] = $dt_upload['file_name'];
					}
				}
			}
		}

		$this->db->update('tbl_siswa', $dt_siswa, ['siswa_nis' => $nis]);
		$this->db->update('tbl_orangtua', $dt_ortu, ['siswa_nis' => $nis]);
		// exit();

		redirect('siswa', 'refresh');
	}
}
