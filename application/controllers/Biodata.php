<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Biodata extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url('login');
			redirect($url);
		};
		$this->load->helper('tanggal_helper');
	}
	function index()
	{
		// var_dump($this->session->userdata('user'));
		// exit();
		$data['siswa'] = $this->db->select('*')->from('tbl_siswa b')->join('tbl_kelas c', 'b.siswa_kelas_id = c.kelas_id', 'inner')->join('tbl_orangtua d', 'b.siswa_nis = d.siswa_nis', 'inner')->join('tbl_agama e', 'b.siswa_agama_id = e.agama_id', 'inner')->where(['b.siswa_nis' => $this->session->userdata('user')])->get()->row_array();
		$this->load->view('siswa/layout/v_header');
		$this->load->view('siswa/layout/v_navbar');
		$this->load->view('siswa/v_biodata',$data);
		$this->load->view('siswa/layout/v_footer');
	}

	function gantiPassword()
	{
		$this->db->update('tbl_pengguna', ['pengguna_password' => md5($this->input->post('password1'))], ['pengguna_username' => $this->session->userdata('user')]);
		echo "<script type='text/javascript'>alert('Password Diupdate');window.location.replace('./index');</script>";
	}
}
