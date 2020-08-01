<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Course extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('M_course', 'm_course');
	}

	public function index()
	{
		ob_start('ob_gzhandler');

		$akses = $this->session->userdata('akses');

		$data['course'] = $this->m_course->get_course();

		if ($akses == 2) {
			$this->load->view('siswa/layout/v_header');
			$this->load->view('siswa/layout/v_navbar');
			$this->load->view('siswa/v_course', $data);
			$this->load->view('siswa/layout/v_footer');
		} else {
			$this->load->view('pengajar/layout/v_header');
			$this->load->view('pengajar/layout/v_navbar');
			$this->load->view('pengajar/v_course', $data);
			$this->load->view('pengajar/layout/v_footer');
		}
	}
}
