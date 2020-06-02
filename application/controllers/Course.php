<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Course extends CI_Controller
{
	public function index()
	{
		ob_start('ob_gzhandler');

		$this->load->view('siswa/layout/v_header');
		$this->load->view('siswa/layout/v_navbar');
		$this->load->view('siswa/v_course');
		$this->load->view('siswa/layout/v_footer');
	}
}
