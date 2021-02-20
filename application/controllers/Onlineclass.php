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
				$dt_kelas = $this->db->select('siswa_kelas_id')->from('tbl_siswa')->where(['siswa_nis' => $this->session->userdata('user')])->get()->row_array();
		$data['oc'] = $this->db->select('*')->from('tbl_pelajaran a')
		->join('tbl_mapel b', 'a.kd_mapel = b.kd_mapel')
		->where(['a.id_kelas'=> $dt_kelas['siswa_kelas_id']])
		->get()->result_array();
		$this->load->view('siswa/layout/v_header');
		$this->load->view('siswa/layout/v_navbar');
		$this->load->view('siswa/v_onlineclass', $data );
		$this->load->view('siswa/layout/v_footer');
	}
}
