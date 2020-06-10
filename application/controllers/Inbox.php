<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inbox extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url('login');
			redirect($url);
		};
	}

	function index()
	{
		// $this->db->update('tbl_inbox', ['inbox_status' => 0], ['inbox_kontak' => $this->session->userdata('username')]);
		// $data['inbox'] = $this->db->get_where('tbl_inbox', ['inbox_kontak' => $this->session->userdata('username')]);

		$nis = $this->session->userdata('username');
		$this->db->select('*')->from('tbl_inbox')->where('inbox_kontak', $nis)->order_by('inbox_tanggal', 'desc');
		$data['inbox'] = $this->db->get();

		$this->load->view('siswa/layout/v_header');
		$this->load->view('siswa/layout/v_navbar');
		$this->load->view('siswa/v_messege', $data);
		$this->load->view('siswa/layout/v_footer');
	}

	public function updateStatus($id)
	{
		$this->db->update('tbl_inbox', ['inbox_status' => 0], ['inbox_id' => $id]);
		$sumMail = $this->db->select_sum('inbox_status')->from('tbl_inbox')->where('inbox_kontak', $this->session->userdata('username'))->get()->row_array();
		
		$data = array(
			'status' => true,
			'mail' => $sumMail['inbox_status']
		);

		echo json_encode($data);
		exit;
	}
}
