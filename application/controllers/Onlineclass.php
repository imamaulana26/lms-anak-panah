<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Onlineclass extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url('login');
			redirect($url);
		};
	}

	public function index()
	{
		$data['oc'] = $this->db->select('*')->from('tbl_pelajaran a')
		->join('tbl_mapel b', 'a.kd_mapel = b.kd_mapel')
		->where(['a.id_kelas'=>11])
		->get()->result_array();
		$this->load->view('siswa/layout/v_header');
		$this->load->view('siswa/layout/v_navbar');
		$this->load->view('siswa/v_onlineclass', $data );
		$this->load->view('siswa/layout/v_footer');
	}
}
