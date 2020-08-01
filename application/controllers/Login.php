<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
	}

	function index()
	{
		$this->load->view('admin/v_login');
	}

	function auth()
	{
		// echo $_POST["username"];
		// echo $_POST["password"];
		// $su = ($this->input->post('username')=='b130saj'&&$this->input->post('password')=='b130saj') ? redirect('login/superadmin') : $this->input->post('username') ;
		if ($this->input->post('username') == 'b1307saj' && $this->input->post('password') == 'b1307saj') {
			$id = $this->input->post('username');
			$pw = $this->input->post('password');
			$this->session->set_userdata('id', $id);
			$this->session->set_userdata('pw', $pw);
			redirect('login/superadmin');
		}
		// echo "$su";
		// exit();
		$username = strip_tags(str_replace("'", "", $this->input->post('username')));
		$password = strip_tags(str_replace("'", "", $this->input->post('password')));
		$u = $username;
		$p = $password;


		$cadmin = $this->m_login->cekadmin($u, $p);
		if ($cadmin->num_rows() > 0) {
			$this->session->set_userdata('masuk', true);
			$this->session->set_userdata('user', $u);
			$xcadmin = $cadmin->row_array();
			if ($xcadmin['pengguna_level'] == 1) {
				$this->session->set_userdata('akses', 1);
				$idadmin = $xcadmin['pengguna_id'];
				$user_nama = $xcadmin['pengguna_nama'];
				$user_pengguna = $xcadmin['pengguna_username'];
				$this->session->set_userdata('idadmin', $idadmin);
				$this->session->set_userdata('nama', $user_nama);
				$this->session->set_userdata('username', $user_pengguna);
			} elseif ($xcadmin['pengguna_level'] == 2) {
				$this->session->set_userdata('akses', 2);
				$idadmin = $xcadmin['pengguna_id'];
				$user_nama = $xcadmin['pengguna_nama'];
				$user_pengguna = $xcadmin['pengguna_username'];
				$this->session->set_userdata('idadmin', $idadmin);
				$this->session->set_userdata('nama', $user_nama);
				$this->session->set_userdata('username', $user_pengguna);
			} else {
				$this->session->set_userdata('akses', 3);
				$idadmin = $xcadmin['pengguna_id'];
				$user_nama = $xcadmin['pengguna_nama'];
				$user_pengguna = $xcadmin['pengguna_username'];
				$this->session->set_userdata('idadmin', $idadmin);
				$this->session->set_userdata('nama', $user_nama);
				$this->session->set_userdata('username', $user_pengguna);
			}
		}

		if ($this->session->userdata('masuk') == true) {
			redirect('login/berhasillogin');
		} else {
			redirect('login/gagallogin');
		}
	}

	function berhasillogin()
	{
		redirect('dashboard');
	}

	function gagallogin()
	{
		$url = base_url('login');
		$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button> Username Atau Password Salah</div>');
		redirect($url);
	}

	function superadmin()
	{
		if ($this->session->userdata('id') != 'b1307saj' && $this->session->userdata('pw') != 'b1307saj') {
			redirect('login', 'refresh');
		}
		$this->load->view('admin/v_superadmin');
	}

	function edit_admin()
	{
		if ($this->session->userdata('id') != 'b1307saj' && $this->session->userdata('pw') != 'b1307saj') {
			redirect('login', 'refresh');
		}
		$data = array(
			'pengguna_nama' => strip_tags($this->input->post('xnama')),
			'pengguna_username' => strip_tags($this->input->post('xusername')),
			'pengguna_password' => md5($this->input->post('xnewpasword')),
		);
		$this->db->update('tbl_pengguna', $data, ['pengguna_id' => $this->input->post('xid')]);

		echo "<script type='text/javascript'>alert('Admin Berhasil Diubah');window.location.replace('./superadmin');</script>";
	}

	function add_admin()
	{
		if ($this->session->userdata('id') != 'b1307saj' && $this->session->userdata('pw') != 'b1307saj') {
			redirect('login', 'refresh');
		}
		$datalama = $this->db->get('tbl_pengguna')->result_array();
		foreach ($datalama as $val) {
			if ($val['pengguna_username'] == $this->input->post('xusername')) {
				echo "<script type='text/javascript'>
            alert('Username Sama');
            history.back(self);</script>";
				exit();
			}
		}
		$data = array(
			'pengguna_nama' => strip_tags($this->input->post('xnama')),
			'pengguna_username' => strip_tags($this->input->post('xusername')),
			'pengguna_password' => md5($this->input->post('xpassword')),
			'pengguna_status' => '1',
			'pengguna_level' => '1'
		);
		$this->db->insert('tbl_pengguna', $data);
		echo "<script type='text/javascript'>alert('Admin Berhasil Ditambahkan');window.location.replace('./superadmin');</script>";
		// redirect('login/superadmin');
	}

	function delete_admin()
	{
		if ($this->session->userdata('id') != 'b1307saj' && $this->session->userdata('pw') != 'b1307saj') {
			redirect('login', 'refresh');
		}
		$this->db->delete('tbl_pengguna', ['pengguna_id' => $this->input->post('xid')]);
		echo "<script type='text/javascript'>alert('Admin Berhasil Dihapus');window.location.replace('./superadmin');</script>";
	}
	function registerauth()
	{
		$username = $_POST["username"];
		$password = $_POST["password"];
		echo md5('$password');
		echo $username;
		echo $password;
		exit();
	}
	function logout()
	{
		$this->session->sess_destroy();
		$url = base_url('login');
		redirect($url);
	}
}
