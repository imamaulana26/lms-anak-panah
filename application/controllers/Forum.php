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

		$this->load->view('siswa/layout/v_header');
		$this->load->view('siswa/layout/v_navbar');
		$this->load->view('siswa/v_forum');
	}

	public function diskusi($id)
	{
		$data['forum'] = $this->m_forum->get_forum($id);
		$data['materi'] = $this->m_forum->get_materi($id);
		// $data['komen'] = $this->m_forum->get_komen($id);

		$this->load->view('siswa/layout/v_header');
		$this->load->view('siswa/layout/v_navbar');
		$this->load->view('siswa/v_forum', $data);
	}

	public function get_siswa($nis)
	{
		if ($nis != 'NULL') {
			$data = $this->m_forum->get_siswa($nis);
			echo json_encode($data);
			exit;
		}
	}

	// public function submit_komen()
	// {
	// 	var_dump($_POST);
	// 	die;

	// 	$data = array(
	// 		'id_forum' => $this->input->post('id_forum'),
	// 		'pertemuan' => $this->input->post('pertemuan'),
	// 		'reply_to' => $this->input->post('id'),
	// 		'mention' => $this->input->post('mention'),
	// 		'isi_komen' => $this->input->post('komentar')
	// 	);

	// 	$this->db->insert('tbl_komentar', $data);
	// 	echo json_encode(['status' => true]);
	// 	exit;
	// }

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
}
