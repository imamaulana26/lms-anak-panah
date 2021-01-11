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
		$data['list'] = $this->db->get_where('tbl_pengguna',['pengguna_level '=> 1])->result_array();
		$this->load->view('admin/v_superadmin',$data);
	}

	function list_data()
	{	
		if ($this->input->post('data')==3) {
			$this->db->select('*');
			$this->db->from('tbl_pengguna a');
			$this->db->join('tbl_pengajar b', 'a.pengguna_nama=b.nm_pengajar','inner');
			$this->db->where(['a.pengguna_level' => 3]);
			$data['list'] = $this->db->get()->result_array();
		}
		else{
			$data['list'] = $this->db->get_where('tbl_pengguna',['pengguna_level'=> $this->input->post('data') ])->result_array();
		}
		$this->load->view('admin/v_superadmin',$data);
	}
	function list_hak($id){
		// $data['list'] = $this->db->get_where('tbl_pelajaran',['kd_pengajar'=> $id ])->result_array();
		$this->db->select('*');
		$this->db->from('tbl_pelajaran a');
		$this->db->join('tbl_mapel b', 'a.kd_mapel=b.kd_mapel','inner');
		$this->db->join('tbl_kelas c', 'a.id_kelas=c.kelas_id','left');
		$this->db->where(['a.kd_pengajar' => $id]);
		$data['list'] = $this->db->get()->result_array();

		$data['nama_pengajar'] = $this->db->get_where('tbl_pengajar',['id_pengajar'=> $id ])->row_array();
		
		$this->load->view('admin/v_list_superadmin',$data);
	}
	function hapus_hak(){
		$this->db->update('tbl_pelajaran', ['kd_pengajar' =>NULL],['id_pelajaran'=>$this->input->post('xid')]);
		echo "<script type='text/javascript'>alert('Hak Pengajar Telah Dihapus');window.location.replace('./superadmin');</script>";
	}

	function save_pengajar(){
		$data = array(
			'id_kelas' => strip_tags($this->input->post('xkelas')),
			'kd_mapel' => strip_tags($this->input->post('xmapel')),
		);
		$this->db->update('tbl_pelajaran', ['kd_pengajar' => $this->input->post('xid')],$data);
		echo "<script type='text/javascript'>alert('Hak Pengajar Telah Diberikan');window.location.replace('./superadmin');</script>";
	}



	function edit_admin()
	{
		if ($this->session->userdata('id') != 'b1307saj' && $this->session->userdata('pw') != 'b1307saj') {
			redirect('login', 'refresh');
		}
		$data = array(
			'pengguna_nama' => strip_tags($this->input->post('xnama')),
			'pengguna_username' => strip_tags($this->input->post('xusername')),
			'pengguna_password' => md5($this->input->post('xnewpasword'))
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
			'pengguna_level' => strip_tags($this->input->post('xtype'))
		);

		if ($this->input->post('xtype') == 3) {
			$this->db->insert('tbl_pengajar', ['nm_pengajar'=>strip_tags($this->input->post('xnama'))]);
		}
		$this->db->insert('tbl_pengguna', $data);
		echo "<script type='text/javascript'>alert('Admin Berhasil Ditambahkan');window.location.replace('./superadmin');</script>";
		// redirect('login/superadmin');
	}

	function delete_admin()
	{
		if ($this->session->userdata('id') != 'b1307saj' && $this->session->userdata('pw') != 'b1307saj') {
			redirect('login', 'refresh');
		}

		if ($this->input->post('xhak') == 3) {
			$this->db->delete('tbl_pengajar', ['id_pengajar' => $this->input->post('xipdeng')]);
			$this->db->update('tbl_pelajaran', ['kd_pengajar' => NULL ],['kd_pengajar'=>$this->input->post('xipdeng')]);
		}
		$this->db->delete('tbl_pengguna', ['pengguna_id' => $this->input->post('xid')]);
		echo "<script type='text/javascript'>alert('User Berhasil Dihapus');window.location.replace('./superadmin');</script>";
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
