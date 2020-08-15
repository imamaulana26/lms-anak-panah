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

	public function add_forum()
	{
		$akses = $this->session->userdata('akses');

		if ($akses == 3) {
			$kd_mapel = $this->input->post('kd_mapel');

			$data = array(
				'id_forum' => $kd_mapel,
				'judul_materi' => $this->input->post('judul_materi'),
				'jns_materi' => $this->input->post('tipe_forum'),
				'isi_materi' => $this->input->post('isi_materi')
			);

			$cek = $this->db->get_where('tbl_materi', ['id_forum' => $kd_mapel]);
			if ($cek->num_rows() > 0) {
				$count = $cek->num_rows() + 1;

				$data['pertemuan'] = $count;

				$this->db->insert('tbl_materi', $data);
			} else {
				$data['pertemuan'] = 1;
				$this->db->insert('tbl_forum', ['fr_id_pelajaran' => $kd_mapel]);

				$this->db->insert('tbl_materi', $data);
			}

			$this->diskusi($kd_mapel);
		}
	}

	public function submit_main()
	{
		$komen = $this->input->post('komentar');
		$id = $this->input->post('id');

		if (!empty($komen)) {
			$data = array(
				'id_forum' => $this->input->post('id_forum'),
				'pertemuan' => $this->input->post('pertemuan'),
				'reply_to' => 0,
				'user_komen' => $this->input->post('user_komen'),
				'isi_komen' => $this->input->post('komentar')
			);

			$this->db->insert('tbl_komentar', $data);

			$this->session->set_flashdata('page', $data['pertemuan']);
			$this->session->set_flashdata('mention', $id);

			redirect(site_url('forum/' . $data['id_forum']));
		}
	}

	public function submit_komen()
	{
		$komen = $this->input->post('komentar');
		$id = $this->input->post('id');

		if (!empty($komen)) {
			$data = array(
				'id_forum' => $this->input->post('id_forum'),
				'pertemuan' => $this->input->post('pertemuan'),
				'reply_to' => $this->input->post('reply_to'),
				'mention' => $this->input->post('mention'),
				'user_komen' => $this->input->post('user_komen'),
				'isi_komen' => $this->input->post('komentar')
			);

			$this->db->insert('tbl_komentar', $data);

			$this->session->set_flashdata('page', $data['pertemuan']);
			$this->session->set_flashdata('mention', $id);

			redirect(site_url('forum/' . $data['id_forum']));
		}
	}

	public function delete_komen($id)
	{
		$data = $this->db->get_where('tbl_komentar', ['id' => $id])->row_array();

		$this->session->set_flashdata('page', $data['pertemuan']);

		$this->db->delete('tbl_komentar', ['id' => $id]);
		$this->db->delete('tbl_komentar', ['reply_to' => $id]);

		redirect(site_url('forum/' . $data['id_forum']));
	}

	public function delete_subkomen($id)
	{
		$data = $this->db->get_where('tbl_komentar', ['id' => $id])->row_array();

		$this->session->set_flashdata('page', $data['pertemuan']);

		$this->db->delete('tbl_komentar', ['id' => $id]);

		redirect(site_url('forum/' . $data['id_forum']));
	}

	public function edit_komen($id)
	{
		# code...
	}
}
