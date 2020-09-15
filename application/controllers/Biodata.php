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
		$this->load->view('siswa/v_biodata', $data);
		// $this->load->view('siswa/v_biodata copy',$data);
		$this->load->view('siswa/layout/v_footer');
	}

	private function validasi()
	{
		$data = array();
		$data['inputerror'] = array();
		$data['error'] = array();
		$data['status'] = true;

		if ($this->input->post('new_pass') == '') {
			$data['inputerror'][] = 'new_pass';
			$data['error'][] = 'Kode region harus diisi';
			$data['status'] = false;
		}

		if ($data['status'] === false) {
			echo json_encode($data);
			exit();
		}
	}

	function gantiPassword()
	{
		$msg = '';
		$icon = 'error';
		$curr_pass = $this->input->post('current_pass');
		$new_pass = $this->input->post('new_pass');
		$confirm_pass = $this->input->post('confirm_pass');

		$cek = $this->db->get_where('tbl_pengguna', ['pengguna_username' => $this->session->userdata('user')])->row_array();

		if ($cek['pengguna_password'] != md5($curr_pass)) {
			$msg = 'Password yang Anda masukan salah!';
		} else {
			if (empty($new_pass) && empty($confirm_pass)) {
				$msg = 'Password baru belum Anda masukan!';
			} else if ($new_pass !== $confirm_pass) {
				$msg = 'Confirm password harus sama dengan password baru!';
			} else {
				$this->db->update('tbl_pengguna', ['pengguna_password' => md5($confirm_pass)], ['pengguna_username' => $this->session->userdata('user')]);

				$icon = 'success';
				$msg = 'Password berhasil diganti';
			}
		}

		echo json_encode(['icon' => $icon, 'msg' => $msg]);
		exit;
	}
}
