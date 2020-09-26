<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Forum extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_forum', 'm_forum');
		$this->load->helper('text');

		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url('login');
			redirect($url);
		};
	}

	public function index()
	{
		ob_start('ob_gzhandler');

		$akses = $this->session->userdata('akses');

		if ($akses == 2) {
			$this->load->view('siswa/layout/v_header');
			$this->load->view('siswa/layout/v_navbar');
			$this->load->view('siswa/v_forum');
		} else {
			$this->load->view('pengajar/layout/v_header');
			$this->load->view('pengajar/layout/v_navbar');
			$this->load->view('pengajar/v_forum');
		}
	}

	private function validasi_forum()
	{
		$data = array();
		$data['inputerror'] = array();
		$data['error'] = array();
		$data['status'] = true;

		if ($this->input->post('judul_materi') == '') {
			$data['inputerror'][] = 'judul_materi';
			$data['error'][] = 'Judul materi harus diisi';
			$data['status'] = false;
		}

		// if ($this->input->post('isi_materi') == '') {
		// 	$data['inputerror'][] = 'isi_materi';
		// 	$data['error'][] = 'Isi materi harus diisi';
		// 	$data['status'] = false;
		// }

		if ($data['status'] === false) {
			echo json_encode($data);
			exit();
		}
	}

	public function diskusi($id)
	{
		$akses = $this->session->userdata('akses');

		$data['forum'] = $this->m_forum->get_forum($id);
		$data['materi'] = $this->m_forum->get_materi($id);
		// $data['komen'] = $this->m_forum->get_komen($id);

		if ($akses == 2) {
			$this->load->view('siswa/layout/v_header');
			$this->load->view('siswa/layout/v_navbar');
			$this->load->view('siswa/v_forum', $data);
		} else {
			$this->load->view('pengajar/layout/v_header');
			$this->load->view('pengajar/layout/v_navbar');
			$this->load->view('pengajar/v_forum', $data);
		}
	}

	public function get_siswa($nis)
	{
		if ($nis != 'NULL') {
			$data = $this->m_forum->get_siswa($nis);
			echo json_encode($data);
			exit;
		}
	}

	function data_id($id)
	{
		$qry = $this->db->get_where('tbl_komen_forum', ['id_forum' => $id])->result_array();
		echo json_encode($qry);
		exit();
	}

	function datafr_id($id)
	{
		$qry = $this->db->get_where('tbl_materi_forum', ['id_forum' => $id])->result_array();
		echo json_encode($qry);
		exit();
	}

	public function tambah_forum($id)
	{
		$this->db->select('*')->from('tbl_pelajaran a')
			->join('tbl_mapel b', 'a.kd_mapel = b.kd_mapel', 'inner')
			->where(['a.id_pelajaran' => $id]);
		$res = $this->db->get()->row_array();

		$data = array(
			'data' => $res
		);

		$this->load->view('pengajar/layout/v_header');
		$this->load->view('pengajar/layout/v_navbar');
		$this->load->view('pengajar/v_tambah_forum', $data);
	}

	public function edit_forum($id)
	{
		$this->db->select('*')->from('tbl_materi_forum a')
			->join('tbl_pelajaran b', 'a.id_forum = b.id_pelajaran', 'left')
			->join('tbl_mapel c', 'b.kd_mapel = c.kd_mapel', 'left')
			->where(['a.id' => $id]);
		$res = $this->db->get()->row_array();

		$data = array(
			'data' => $res
		);

		$this->load->view('pengajar/layout/v_header');
		$this->load->view('pengajar/layout/v_navbar');
		$this->load->view('pengajar/v_edit_forum', $data);
	}

	public function delete_forum($id)
	{
		$data = $this->db->get_where('tbl_materi_forum', ['id' => $id])->row_array();

		$this->db->delete('tbl_materi_forum', ['id' => $id]);
		$this->db->delete('tbl_komen_forum', ['id_forum' => $data['id_forum'], 'pertemuan' => $data['pertemuan']]);
		echo json_encode(['status' => true]);
		exit;
	}

	public function save_forum()
	{
		$this->validasi_forum();

		$akses = $this->session->userdata('akses');

		if ($akses == 3) {
			$kd_mapel = $this->input->post('kd_mapel');

			$data = array(
				'id_forum' => $kd_mapel,
				'judul_materi' => $this->input->post('judul_materi'),
				'jns_materi' => $this->input->post('tipe_forum'),
				'isi_materi' => $this->input->post('isi_materi')
			);

			$cek = $this->db->get_where('tbl_materi_forum', ['id_forum' => $kd_mapel]);
			if ($cek->num_rows() > 0) {
				$count = $cek->num_rows() + 1;

				$data['pertemuan'] = $count;

				$this->db->insert('tbl_materi_forum', $data);
			} else {
				$data['pertemuan'] = 1;
				$this->db->insert('tbl_forum', ['fr_id_pelajaran' => $kd_mapel]);

				$this->db->insert('tbl_materi_forum', $data);
			}

			// $this->diskusi($kd_mapel);
			echo json_encode(['status' => true, 'id' => $data['id_forum']]);
			exit;
		}
	}

	public function update_forum()
	{
		$this->validasi_forum();

		$akses = $this->session->userdata('akses');

		if ($akses == 3) {
			$data = array(
				'judul_materi' => $this->input->post('judul_materi'),
				'jns_materi' => $this->input->post('tipe_forum'),
				'isi_materi' => $this->input->post('isi_materi')
			);

			$this->db->update('tbl_materi_forum', $data, ['id' => $this->input->post('id_fm')]);

			// $this->diskusi($kd_mapel);
			echo json_encode(['status' => true, 'id' => $this->input->post('kd_mapel')]);
			exit;
		}
	}

	public function upd_status($id)
	{
		$msg = '';
		$cek = $this->db->get_where('tbl_materi_forum', ['id' => $id])->row_array();
		if ($cek['status'] == 0) {
			$this->db->update('tbl_materi_forum', ['status' => 1], ['id' => $id]);
			$msg = 'di non-aktifkan';
		} else {
			$this->db->update('tbl_materi_forum', ['status' => 0], ['id' => $id]);
			$msg = 'di aktifkan';
		}
		echo json_encode(['msg' => 'Forum berhasil ' . $msg . '!']);
		exit;
	}




	public function submit_main()
	{
		$komen = $this->input->post('komentar');
		$id = $this->input->post('id');

		if (!empty($_FILES['gambar']['name'])) {
			$config['upload_path'] = './assets/test/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
			$config['max_size'] = '1024'; // max_size in kb
			$config['file_name'] = $_FILES['gambar']['name'];
			$this->load->library('upload', $config);

			// File upload
			if ($this->upload->do_upload('gambar')) {
				// Get data about the file
				$uploadData = $this->upload->data();

				$img = file_get_contents('./assets/test/' . $uploadData['file_name']);

				// Encode the image string data into base64 
				// $data = base64_encode($img); 

				$base_64 = base64_encode($img);
				$this->db->insert('tbl_base64', ['text' => $base_64]);
				unlink('./assets/test/' . $uploadData['file_name']);
				// $baseendoce = base64_decode($base_64);

				// $data = file_get_contents($base_64);

				// fclose( $ifp ); 
				// echo '<img src="data:image/webp;base64,'.$base_64.'" />';
			}
		}

		if (!empty($komen)) {
			$data = array(
				'id_forum' => $this->input->post('id_forum'),
				'pertemuan' => $this->input->post('pertemuan'),
				'reply_to' => 0,
				'user_komen' => $this->input->post('user_komen'),
				'isi_komen' => $this->input->post('komentar')
			);

			$this->db->insert('tbl_komen_forum', $data);

			$cek_log = $this->db->get_where('tbl_log_forum', ['nisn_siswa' => $data['user_komen'], 'id_forum' => $data['id_forum']]);
			if ($cek_log->num_rows() > 0) {
				$log = $cek_log->row_array();
				$exp = explode('::', $log['log_forum']);

				if ($log['log_forum'] != '') {
					if (in_array($data['pertemuan'], $exp)) {
						$isi_log = $log['log_forum'];
					} else {
						$isi_log = $log['log_forum'] . '::' . $data['pertemuan'];
					}
					$this->db->update('tbl_log_forum', ['log_forum' => $isi_log], ['nisn_siswa' => $data['user_komen'], 'id_forum' => $data['id_forum']]);
				} else {
					$this->db->update('tbl_log_forum', ['log_forum' => $data['pertemuan']], ['nisn_siswa' => $data['user_komen'], 'id_forum' => $data['id_forum']]);
				}
			} else {
				$this->db->insert('tbl_log_forum', ['nisn_siswa' => $data['user_komen'], 'id_forum' => $data['id_forum'], 'log_forum' => $data['pertemuan']]);
			}

			$this->session->set_flashdata('page', $data['pertemuan']);
			$this->session->set_flashdata('mention', $id);

			redirect(site_url('forum/' . $data['id_forum']));
		}
	}

	public function submit_komen()
	{
		$komen = $this->input->post('komentar');
		$id = $this->input->post('id');

		if (!empty($_FILES['gambar']['name'])) {
			$config['upload_path'] = './assets/test/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
			$config['max_size'] = '1024'; // max_size in kb
			$config['file_name'] = $_FILES['gambar']['name'];
			$this->load->library('upload', $config);

			// File upload
			if ($this->upload->do_upload('gambar')) {
				// Get data about the file
				$uploadData = $this->upload->data();

				$img = file_get_contents('./assets/test/' . $uploadData['file_name']);

				// Encode the image string data into base64 
				// $data = base64_encode($img); 

				$base_64 = base64_encode($img);
				$this->db->insert('tbl_base64', ['text' => $base_64]);
				unlink('./assets/test/' . $uploadData['file_name']);
				// $baseendoce = base64_decode($base_64);

				// $data = file_get_contents($base_64);

				// fclose( $ifp ); 
				// echo '<img src="data:image/webp;base64,'.$base_64.'" />';
			}
		}

		if (!empty($komen)) {
			$data = array(
				'id_forum' => $this->input->post('id_forum'),
				'pertemuan' => $this->input->post('pertemuan'),
				'reply_to' => $this->input->post('reply_to'),
				'mention' => $this->input->post('mention'),
				'user_komen' => $this->input->post('user_komen'),
				'isi_komen' => $this->input->post('komentar')
			);

			$this->db->insert('tbl_komen_forum', $data);

			$cek_log = $this->db->get_where('tbl_log_forum', ['nisn_siswa' => $data['user_komen'], 'id_forum' => $data['id_forum']]);
			if ($cek_log->num_rows() > 0) {
				$log = $cek_log->row_array();
				$exp = explode('::', $log['log_forum']);

				if ($log['log_forum'] != '') {
					if (in_array($data['pertemuan'], $exp)) {
						$isi_log = $log['log_forum'];
					} else {
						$isi_log = $log['log_forum'] . '::' . $data['pertemuan'];
					}
					$this->db->update('tbl_log_forum', ['log_forum' => $isi_log], ['nisn_siswa' => $data['user_komen'], 'id_forum' => $data['id_forum']]);
				} else {
					$this->db->update('tbl_log_forum', ['log_forum' => $data['pertemuan']], ['nisn_siswa' => $data['user_komen'], 'id_forum' => $data['id_forum']]);
				}
			} else {
				$this->db->insert('tbl_log_forum', ['nisn_siswa' => $data['user_komen'], 'id_forum' => $data['id_forum'], 'log_forum' => $data['pertemuan']]);
			}



			$this->session->set_flashdata('page', $data['pertemuan']);
			$this->session->set_flashdata('mention', $id);

			redirect(site_url('forum/' . $data['id_forum']));
		}
	}

	public function delete_komen($id)
	{
		$data = $this->db->get_where('tbl_komen_forum', ['id' => $id])->row_array();

		$this->session->set_flashdata('page', $data['pertemuan']);

		$this->db->delete('tbl_komen_forum', ['id' => $id]);
		$this->db->delete('tbl_komen_forum', ['reply_to' => $id]);

		echo json_encode([
			'msg' => 'Komentar berhasil dihapus!'
		]);
		exit;
	}

	public function delete_subkomen($id)
	{
		$data = $this->db->get_where('tbl_komen_forum', ['id' => $id])->row_array();

		$this->session->set_flashdata('page', $data['pertemuan']);

		$this->db->delete('tbl_komen_forum', ['id' => $id]);

		echo json_encode([
			'msg' => 'Komentar berhasil dihapus!'
		]);
		exit;
	}


	public function edit_komen($id)
	{
		$this->db->select('*')->from('tbl_komen_forum a')
			->join('tbl_pelajaran b', 'a.id_forum = b.id_pelajaran', 'left')
			->join('tbl_mapel c', 'b.kd_mapel = c.kd_mapel', 'left')
			->where(['a.id' => $id]);
		$res = $this->db->get()->row_array();

		$data = array(
			'title' => 'Forum',
			'data' => $res
		);

		$this->load->view('pengajar/layout/v_header');
		$this->load->view('pengajar/layout/v_navbar');
		$this->load->view('pengajar/v_edit_komen', $data);
	}

	public function update_komen()
	{
		$data = array(
			'isi_komen' => $this->input->post('isi_materi')
		);

		$this->db->update('tbl_komen_forum', $data, ['id' => $this->input->post('id_fm')]);

		echo json_encode(['status' => true, 'id' => $this->input->post('kd_mapel')]);
		exit;
	}
}
