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
		$this->load->model('m_kontak');
	}

	function index()
	{
		$this->db->update('tbl_inbox', ['inbox_status' => 0], ['inbox_kontak' => $this->session->userdata('username')]);
		// $data['inbox'] = $this->db->get_where('tbl_inbox', ['inbox_kontak' => $this->session->userdata('username')]);
		$this->db->order_by('inbox_id', 'desc');
		$data['inbox'] = $this->db->get_where('tbl_inbox', ['inbox_kontak' => $this->session->userdata('username')]);
		$this->load->view('admin/v_inbox', $data);
	}
}
